<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherAddDisciplineRequest;
use App\Http\Requests\TeacherUpdateRequest;
use App\Models\Discipline;
use App\Models\DisciplineUser;
use App\Models\TeacherDescription;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::where('user_type', 'teacher')->orderBy('name')->paginate(10);
        return view('admin.teachers.index', compact('items'));
    }

    public function search(Request $request){
        $name = $request->name;
        $items = User::where('user_type', 'teacher')->where('name', 'LIKE', "%{$name}%")->orderBy('name')->paginate(10);
        return view('admin.teachers.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addDiscipline($id)
    {
        $disciplines = Discipline::all();
        $item = User::findOrFail($id);

        if($item){
            return view('admin.teachers.addDiscipline', compact('item', 'disciplines'));
        }else{
            return back()->withErrors(['message' => 'Не вдалось знайти']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeacherAddDisciplineRequest $request)
    {
        $data = $request->input();
        $user = User::findOrFail($data['user_id']);


        $item = true;
        foreach($user->disciplines as $discipline){
            if($discipline->id == $data['discipline_id']) $item = false;
        }
        if($item){
            $item = (new DisciplineUser())->create($data);
        }
        
        if($item){
            return redirect()
                ->route('admin.teachers.addDiscipline', $data['user_id'])
                ->with(['success' => "Предмет доданий"]);
        }else{
            return back()
                ->withInput()
                ->withErrors(['message' => "Невдале додавання"]);
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
        $item = User::findOrFail($id);
        return view('admin.teachers.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::findOrFail($id);
        return view('admin.teachers.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherUpdateRequest $request, $id)
    {
        $data = $request->input();
        $item = User::findOrFail($id);

        $item->name = $data['name'];
        $item->email = $data['email'];
        $item->save();

        $description = TeacherDescription::where('user_id', $item->id)
            ->update([
                'position' => $data['position'],
                'description' => $data['description']
            ]);
        
        if($item || $description){
            return redirect()
                ->route('admin.teachers.show', $id)
                ->with(['success' => 'Успішно оновлено']);
        }else{
            return back()
                ->withInput()
                ->withErrors(['message' => 'Не оновлено']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = DisciplineUser::where('user_id', $id);
        $item->delete();

        $user = User::findOrFail($id);
        $user->user_type = NULL;
        $user->save();

        if($item && $user){
            return redirect()
                ->route('admin.teachers.index')
                ->with(['success' => 'Успішно оновлено']);
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
    public function destroyDiscipline($id, $discipline){
        $item = DisciplineUser::where('user_id', $id)
            ->where('discipline_id', $discipline);
        $item->delete();

        if($item){
            return back()->with(['success' => 'Успішно видалено']);
        }else{
            return back()->withErrors(['message' => 'Не вдалось видалити']);
        }
    }
}
