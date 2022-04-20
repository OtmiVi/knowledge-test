<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discipline;
use App\Models\DisciplineGroup;
use App\Models\Group;
use Illuminate\Http\Request;

class AdminDisciplineGroupController extends Controller
{


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input();
        $discipline = Discipline::find($data['discipline_id']);


        $item = true;
        foreach($discipline->group as $group){
            if($group->id == $data['group_id']) $item = false;
        }
        if($item){
            $item = (new DisciplineGroup())->create($data);
        }
        
        if($item){
            return redirect()
                ->route('admin.disciplinesgroups.show', $data['discipline_id'])
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
        $groups = Group::all();
        $item = Discipline::find($id);
        return view('admin.disciplinegroup.show', compact('groups', 'item'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $group)
    {
        $item = DisciplineGroup::where('discipline_id', $id)
            ->where('group_id', $group);
        $item->delete();

        if($item){
            return back()->with(['success' => 'Успішно видалено']);
        }else{
            return back()->withErrors(['message' => 'Не вдалось видалити']);
        }
        
    }
}
