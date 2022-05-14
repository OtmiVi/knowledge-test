<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestAnswer;
use App\Models\TestQuestion;
use Illuminate\Http\Request;

class TeacherTestController extends Controller
{
    public function create($discipline)
    {
        return view('teacher.tests.create', compact('discipline'));
    }

    public function store(Request $request){
        $data = $request->input();
        $test = (new Test())->create($data);
        
        if($test){
            foreach($data['questions'] as $testQuestion){
                $question = (new TestQuestion())
                    ->create([
                        'question' => $testQuestion['question'],
                        'test_id' => $test->id,
                    ]);
                if($question){
                    $isRight = $testQuestion['right'] ?? 0;
                    for($i = 0; $i < count($testQuestion['answers']); $i++){
                        $right = false;
                        if($isRight == $i){
                            $right = true;
                        }
                        $answer = (new TestAnswer())
                            ->create([
                                'answer' => $testQuestion['answers'][$i],
                                'right' => $right,
                                'test_question_id' => $question->id,
                            ]);
                        if(!$answer){
                            return back()
                                ->withInput()
                                ->withErrors(['message' => "Невдале додавання відповідів"]);
                        }
                    }
                }else{
                    return back()
                        ->withInput()
                        ->withErrors(['message' => "Невдале додавання запитань"]);
                }
            }
            return redirect()
                ->route('teacher.disciplines.show', $data['discipline_id'])
                ->with(['success' => "Тест доданий"]);
        }else{
            return back()
            ->withInput()
            ->withErrors(['message' => "Невдале додавання тесту"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Test::findOrFail($id);
        return view('teacher.tests.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Test::findOrFail($id);

        if($item){
            return view('teacher.tests.edit', compact('item'));
        }else{
            return back()->withErrors(['message' => 'Не вдалось знайти']);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateTest(Request $request, $test)
    {
        $data = $request->input();
        $item = Test::findOrFail($test);
        $item->delete();

        if($item){
            $test = (new Test())->create($data);
            
            if($test){
                foreach($data['questions'] as $testQuestion){
                    $question = (new TestQuestion())
                        ->create([
                            'question' => $testQuestion['question'],
                            'test_id' => $test->id,
                        ]);
                    if($question){
                        $isRight = $testQuestion['right'] ?? 0;
                        for($i = 0; $i < count($testQuestion['answers']); $i++){
                            $right = false;
                            if($isRight == $i){
                                $right = true;
                            }
                            $answer = (new TestAnswer())
                                ->create([
                                    'answer' => $testQuestion['answers'][$i],
                                    'right' => $right,
                                    'test_question_id' => $question->id,
                                ]);
                            if(!$answer){
                                return back()
                                    ->withInput()
                                    ->withErrors(['message' => "Невдале додавання відповідів"]);
                            }
                        }
                    }else{
                        return back()
                            ->withInput()
                            ->withErrors(['message' => "Невдале додавання запитань"]);
                    }
                }
                return redirect()
                    ->route('teacher.disciplines.show', $data['discipline_id'])
                    ->with(['success' => "Тест доданий"]);
    
            }else{
                return back()
                ->withInput()
                ->withErrors(['message' => "Невдале додавання тесту"]);
            }
        }else{
            return back()->withErrors(['message' => 'Не вдалось оновити']);
        }
    }
    public function changeVisible($id){
        $item = Test::findOrFail($id);
        if($item->visible){
            $item->visible = false;
        }else{
            $item->visible = true;
        }
        $item->save();
        return back()
            ->with(['success' => "Тест оновлено"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Test::findOrFail($id);
        $item->delete();

        if($item){
            return back()
            ->with(['success' => 'Видалено успішно']);
        }else{
            return back()->withErrors(['message' => 'Не вдалось видалити']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyQuestion($id)
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroynAswer($id)
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
