<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Discipline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDisciplineController extends StudentController
{

    public function show($id){
        $this->haveDiscipline($id);

        $item = Discipline::find($id);
        return view('student.disciplines.show', compact('item'));
    }
}
