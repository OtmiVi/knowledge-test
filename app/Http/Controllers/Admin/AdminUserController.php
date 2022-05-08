<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(){
        $items = User::orderBy('name')->paginate(10);
        return view('admin.users.index', compact('items'));
    }

    public function search(Request $request){
        $name = $request->name;
        $user_type = $request->user_type;
        
        if($user_type != "all"){
            $items = User::where('user_type', $user_type)
                ->where('name', 'LIKE', "%{$name}%")
                ->orderBy('name')
                ->paginate(10);
        }else{
            $items = User::where('name', 'LIKE', "%{$name}%")
                ->orderBy('name')
                ->paginate(10);
        }
        
        return view('admin.users.index', compact('items'));
    }

    public function create(){
        return view('admin.users.create');
    }

    public function store(UserCreateRequest $request){
        $data = $request->input();

        $item = (new User())->create($data);
        if($item){
            return redirect()
                ->route('admin.users.index')
                ->with(['success' => 'Додано успішно']);
        }else{
            return back()
                ->withInput()
                ->withErrors(['message' => "Невдале створення"]);
        }
    }

    public function show($id){
        $item = User::findOrFail($id);

        return view('admin.users.show', compact('item'));
    }

    public function edit($id){
        $item = User::findOrFail($id);

        if($item){
            return view('admin.users.edit', compact('item'));
        }else{
            return back()->withErrors(['message' => 'Не вдалось знайти']);
        }
    }

    public function update(UserUpdateRequest $request, $id){
        $item = User::find($id);
        $item->fill($request->input())->save();
        
        if($item){
            return back()
                ->with(['success' => 'Успішно оновлено']);
        }else{
            return back()
                ->withInput()
                ->withErrors(['message' => 'Не оновлено']);
        }
    }

    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        if($item){
            return back()
            ->with(['success' => 'Видалено успішно']);
        }else{
            return back()->withErrors(['message' => 'Не вдалось видалити']);
        }
        
    }
}
