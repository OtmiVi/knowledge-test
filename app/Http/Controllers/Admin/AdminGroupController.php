<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Http\Requests\GroupCreateRequest;
use App\Http\Requests\GroupUpdateRequest;


class AdminGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Group::orderBy('name')->paginate(10);
        return view('admin.groups.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.groups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupCreateRequest $request)
    {
        $data = $request->input();

        $item = (new Group())->create($data);

        if($item){
            return redirect()
                ->route('admin.groups.index')
                ->with(['success' => 'Додано успішно']);
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
        $item = Group::findOrFail($id);
        return view('admin.groups.show', compact('item'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Group::findOrFail($id);

        if($item){
            return view('admin.groups.edit', compact('item'));
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
    public function update(GroupUpdateRequest $request, $id)
    {
        $item = Group::findOrFail($id);

        $item->fill($request->input())->save();
        
        if($item){
            return redirect()
                ->route('admin.groups.index')
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
        $item = Group::findOrFail($id);
        $item->delete();

        if($item){
            return redirect()
            ->route('admin.groups.index')
            ->with(['success' => 'Видалено успішно']);
        }else{
            return back()->withErrors(['message' => 'Не вдалось видалити']);
        }
        
    }
}
