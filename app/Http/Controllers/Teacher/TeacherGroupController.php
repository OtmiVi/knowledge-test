<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Discipline;
use App\Models\Group;
use App\Models\Score;
use Illuminate\Http\Request;

class TeacherGroupController extends Controller
{
    public function show($disciplineId, $groupId){
        $item = Group::findOrFail($groupId);
        $discipline = Discipline::findOrFail($disciplineId);

        return view('teacher.groups.show', compact('discipline', 'item'));
    }
}
