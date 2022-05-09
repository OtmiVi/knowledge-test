<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentCreateRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Group;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GroupUser;

class AdminStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = User::where('user_type', 'student')->orderBy('name')->paginate(10);
        return view('admin.students.index', compact('items'));
    }

    public function search(Request $request){
        $name = $request->name;
        $items = User::where('user_type', 'student')->where('name', 'LIKE', "%{$name}%")->orderBy('name')->paginate(10);
        return view('admin.students.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $groups = Group::all();
        $item = User::find($id);
        if($item){
            return view('admin.students.create', compact('item', 'groups'));
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
    public function store(StudentCreateRequest $request)
    {
        $data = $request->input();

        $item = (new GroupUser())->create($data);
        
        if($item){
            return redirect()
                ->route('admin.students.show', $data['user_id'])
                ->with(['success' => "Студент доданий до групи"]);
        }else{
            return back()
                ->withInput()
                ->withErrors(['message' => "Невдале створення"]);
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
        $item = User::find($id);
        return view('admin.students.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $groups = Group::all();
        $item = User::find($id);
        if($item){
            return view('admin.students.edit', compact('item', 'groups'));
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
    public function update(StudentUpdateRequest $request, $id)
    {

        $data = $request->input();
        $item = User::find($id);

        $item->name = $data['name'];
        $item->email = $data['email'];
        $item->save();

        $group = GroupUser::where('user_id', $item->id)->update(['group_id' => $data['group_id']]);
        
        if($item || $group){
            return redirect()
                ->route('admin.students.show', $id)
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
        $item = GroupUser::where('user_id', $id);
        $item->delete();

        $user = User::find($id);
        $user->user_type = NULL;
        $user->save();

        if($item && $user){
            return redirect()
                ->route('admin.students.index')
                ->with(['success' => 'Успішно оновлено']);
        }else{
            return back()->withErrors(['message' => 'Не вдалось видалити']);
        }
    }
}
