<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherDisciplineController extends TeacherController
{
    private function haveDiscipline($disciplineId){
        foreach($this->user->disciplines as $discipline){
            if($discipline->id == $disciplineId){
                return;
            }
        }
        return redirect()
            ->to('teacher')
            ->withErrors(['message' => 'Ви не маєте доступу до даної дисципліни'])
            ->send();
    }

    public function show($id){
        $this->haveDiscipline($id);

        $item = Discipline::find($id);
        return view('teacher.disciplines.show', compact('item'));
    }
}
