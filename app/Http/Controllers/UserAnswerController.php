<?php

namespace App\Http\Controllers;

use App\Models\user_answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request);

        $request->validate([
            'interne_user_id' => 'integer' ,
            'externe_user_id' => 'integer',
            'quiz_id' => 'required|integer',
            'possible_answer_id' => 'required|integer',
            'question_id' => 'required|integer',
        ]);

        // $answer = new user_answer;
        // $answer->interne_user_id = $request->interne_user_id;
        // $answer->externe_user_id = $request->externe_user_id;
        // $answer->quiz_id = $request->quiz_id;
        // $answer->possible_answer_id = $request->input('possible_answer_id');
        // $answer->question_id = $request->$request->question_id;
        // // $answer->question_id = $request->input('questions_id');
        // $answer->save();
       
        $selectedAnswers = collect($request->possible_answer_id)->map(function ($possible_answer_id) use ($request) {
            return [
                'interne_user_id' => $request->interne_user_id,
                'externe_user_id' => $request->externe_user_id,
                'quiz_id' => $request->quiz_id,
                'possible_answer_id' => $request->possible_answer_id,
                'questioan_id' => $request->question_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });
   
        DB::table('user_answer')->insert($selectedAnswers->toArray());
        return redirect()->route('/')->with('Vous venez de soumettre vos réponses');
    }

    /**
     * Display the specified resource.
     */
    public function show(user_answer $user_answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user_answer $user_answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user_answer $user_answer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user_answer $user_answer)
    {
        //
    }
}
