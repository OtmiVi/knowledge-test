<?php

namespace App\Http\Controllers\Student;

use App\Models\Discipline;
use App\Models\Score;

class StudentDisciplineController extends StudentController
{

    public function show($id){
        $this->haveDiscipline($id);

        $score = Score::where('discipline_id', $id)
            ->where('user_id', $this->user->id)
            ->pluck('score', 'test_id');

        $item = Discipline::find($id);
        return view('student.disciplines.show', compact('item', 'score'));
    }
}
