<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Models\Test;
use Illuminate\Http\Request;

class TeacherJournalController extends Controller
{
    public function show($id){
        $item = Test::findOrFail($id);
        $scores = Score::where('test_id', $item->id)->get();

        return view('teacher.journals.show', compact('scores', 'item'));
    }
}
