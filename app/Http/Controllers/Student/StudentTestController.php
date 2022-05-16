<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\Test;
use App\Models\TestAnswer;
use Illuminate\Http\Request;

class StudentTestController extends StudentController
{
    private $test;

    private function haveTest($testId){
        $this->test = Test::findOrFail($testId);
        $this->haveDiscipline($this->test->discipline_id);
    }

    public function open($id){
        $this->haveTest($id);
        $item = $this->test;
        return view('student.tests.open', compact('item'));
    }

    public function show($id){
        $this->haveTest($id);
        $item = $this->test;
        return view('student.tests.show', compact('item'));
    } 

    public function calculateScore(Request $request){

        $data = $request->input();
        $this->test = Test::findOrFail($data['test_id']);
        $correctCount = 0;

        foreach($data['answers'] as $userAnswer){
            $answer = TestAnswer::findOrFail($userAnswer);
            if($answer->right){
                $correctCount++;
            }
        }
        $questionsCount = $this->test->questions->count();
        $score = 0;
        $score = $correctCount * 100;
        $score /= $questionsCount;

        $result = [
            'test_id' => $this->test->id,
            'user_id' => $this->user->id,
            'group_id' => $this->user->group[0]->id,
            'discipline_id' => $this->test->discipline->id,
            'score' => (int)$score,
        ];

        $item = (new Score())->create($result);

        if($item){
            return redirect()
                ->route('student.disciplines.show', $this->test->discipline->id);
        }else{
            return back()
                ->withInput()
                ->withErrors(['message' => "Невдале Завершення тесту"]);
            }
    }
}