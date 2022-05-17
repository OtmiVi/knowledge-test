<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public static function store($data)
    {
        $test = (new Test())->create($data);
        
        if($test){
            foreach($data['questions'] as $testQuestion){
                QuestionController::crete($testQuestion, $test->id);
            }
            $userType = Auth::user()->user_type;
            return redirect()
                ->route($userType.'.disciplines.show', $data['discipline_id'])
                ->with(['success' => "Тест доданий"])
                ->send();
        }else{
            return back()
            ->withInput()
            ->withErrors(['message' => "Невдале додавання тесту"]);
        }
    }

    public static function update($data, $testId)
    {
        $item = Test::findOrFail($testId);
        $item->delete();
        if($item){
            self::store($data);
        }else{
            return back()->withErrors(['message' => 'Не вдалось оновити']);
        }
    }

    public static function destroy($id)
    {
        $userType = Auth::user()->user_type;
        $item = Test::findOrFail($id);
        $disciplineId = $item->discipline_id;
        $item->delete();

        if($item){
            return redirect()
                ->route($userType.'.disciplines.show', $disciplineId)
                ->with(['success' => "Тест видалений"])
                ->send();
        }else{
            return back()->withErrors(['message' => 'Не вдалось видалити']);
        }
    }
}
