<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\QuizResult;
use App\Models\QuizSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Start or resume a quiz session.
     */
    public function start()
    {
        $user = Auth::user();

        // Look for an existing incomplete session
        $session = QuizSession::where('user_id', $user->id)
            ->where('completed', false)
            ->latest()
            ->first();

        if (!$session) {
            // Build a new set of questions: at least 1 per category
            $categories = ['Art', 'History', 'Geography', 'Science', 'Sports'];
            $questionIds = [];

            foreach ($categories as $cat) {
                $q = Question::where('category', $cat)->inRandomOrder()->first();
                if ($q) {
                    $questionIds[] = $q->id;
                }
            }

            // Add extra random questions until we have at least 10 total
            $extra = Question::whereNotIn('id', $questionIds)
                ->inRandomOrder()
                ->take(max(0, 10 - count($questionIds)))
                ->pluck('id')
                ->toArray();

            $questionIds = array_merge($questionIds, $extra);
            shuffle($questionIds);

            $session = QuizSession::create([
                'user_id'      => $user->id,
                'question_ids' => $questionIds,
                'completed'    => false,
            ]);
        }

        return redirect()->route('quiz.show', $session->id);
    }

    /**
     * Display the quiz questions.
     */
    public function show(QuizSession $quizSession)
    {
        // Only owner can see their session
        if ($quizSession->user_id !== Auth::id()) {
            abort(403);
        }

        if ($quizSession->completed) {
            return redirect()->route('quiz.results', $quizSession->id);
        }

        $questions = Question::with('answers')
            ->whereIn('id', $quizSession->question_ids)
            ->get()
            ->sortBy(fn($q) => array_search($q->id, $quizSession->question_ids))
            ->values();

        return view('quiz.show', compact('quizSession', 'questions'));
    }

    /**
     * Submit the quiz.
     */
    public function submit(Request $request, QuizSession $quizSession)
    {
        if ($quizSession->user_id !== Auth::id()) {
            abort(403);
        }

        if ($quizSession->completed) {
            return redirect()->route('quiz.results', $quizSession->id);
        }

        // Validate: all questions must be answered
        $questionIds = $quizSession->question_ids;
        $answers = $request->input('answers', []);   // [question_id => answer_id]

        foreach ($questionIds as $qid) {
            if (!isset($answers[$qid])) {
                return back()->withErrors(['answers' => 'Необходимо ответить на все вопросы.']);
            }
        }

        $user = Auth::user();

        foreach ($questionIds as $qid) {
            $answerId = $answers[$qid];
            $answer = Answer::findOrFail($answerId);

            // Security: make sure the answer belongs to the question
            if ($answer->question_id != $qid) {
                abort(422);
            }

            $isCorrect = $answer->is_correct;

            QuizResult::create([
                'quiz_session_id' => $quizSession->id,
                'user_id'         => $user->id,
                'question_id'     => $qid,
                'answer_id'       => $answerId,
                'is_correct'      => $isCorrect,
            ]);

            if ($isCorrect) {
                $question = Question::find($qid);
                $user->xp += $question->xp;
            }

            $question = Question::find($qid);
            $user->updateCategoryScore($question->category, $isCorrect);
        }

        $user->save();

        $quizSession->completed = true;
        $quizSession->save();

        return redirect()->route('quiz.results', $quizSession->id);
    }

    /**
     * Show results page.
     */
    public function results(QuizSession $quizSession)
    {
        if ($quizSession->user_id !== Auth::id()) {
            abort(403);
        }

        $results = QuizResult::where('quiz_session_id', $quizSession->id)
            ->with('question', 'answer')
            ->get();

        $total   = $results->count();
        $correct = $results->where('is_correct', true)->count();

        // Per category
        $categories = ['Art', 'History', 'Geography', 'Science', 'Sports'];
        $byCategory = [];
        foreach ($categories as $cat) {
            $catResults        = $results->filter(fn($r) => $r->question->category === $cat);
            $byCategory[$cat]  = [
                'correct' => $catResults->where('is_correct', true)->count(),
                'total'   => $catResults->count(),
            ];
        }

        return view('quiz.results', compact('quizSession', 'results', 'total', 'correct', 'byCategory'));
    }
}