<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;

class StudentGroupController extends StudentController
{
    public function index(){
        $groupId = $this->user->group[0]->id;

        $item = Group::findOrFail($groupId);

        return view('student.groups.index', compact('item'));
    }
}
