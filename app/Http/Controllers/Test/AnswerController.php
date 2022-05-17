<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\TestAnswer;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    public static function create($answer, $right, $question)
    {
        $answer = (new TestAnswer())
            ->create([
                'answer' => $answer,
                'right' => $right,
                'test_question_id' => $question,
            ]);
        if(!$answer){
            return back()
                ->withInput()
                ->withErrors(['message' => "Невдале додавання відповіді"]);
        }
    }

    public static function destroy($id)
    {
        $item = TestAnswer::findOrFail($id);
        $item->delete();

        if($item){
            return back()
            ->with(['success' => 'Видалено успішно']);
        }else{
            return back()->withErrors(['message' => 'Не вдалось видалити']);
        } 
    }
}
