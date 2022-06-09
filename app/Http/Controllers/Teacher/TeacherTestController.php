<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Test\AnswerController;
use App\Http\Controllers\Test\QuestionController;
use App\Http\Controllers\Test\TestController;
use App\Models\Test;
use Illuminate\Http\Request;

class TeacherTestController extends Controller
{
    public function create($discipline)
    {
        return view('teacher.tests.create', compact('discipline'));
    }

    public function store(Request $request){
        $data = $request->input();
        TestController::store($data);
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
        TestController::update($data, $test);
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
        TestController::destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyQuestion($id)
    {
        QuestionController::destroy($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroynAswer($id)
    {
        AnswerController::destroy($id);
    }

}
