<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\TestQuestion;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public static function crete($testQuestion, $testId)
    {
        $question = (new TestQuestion())
        ->create([
            'question' => $testQuestion['question'],
            'test_id' => $testId,
        ]);
        if($question){
            $isRight = $testQuestion['right'] ?? 0;
            for($i = 0; $i < count($testQuestion['answers']); $i++){
                $right = false;
                if($isRight == $i){
                    $right = true;
                }
                AnswerController::create($testQuestion['answers'][$i], $right, $question->id);
            }
        }else{
            return back()
                ->withInput()
                ->withErrors(['message' => "Невдале додавання запитань"]);
        }
    }

    public static function destroy($id)
    {
        $item = TestQuestion::findOrFail($id);
        $item->delete();

        if($item){
            return back()
            ->with(['success' => 'Видалено успішно']);
        }else{
            return back()->withErrors(['message' => 'Не вдалось видалити']);
        } 
    }
}
