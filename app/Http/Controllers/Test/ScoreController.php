<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public static function getUserAvarage($userId, $disciplineId)
    {
        $score = Score::where('user_id', $userId)->where('discipline_id', $disciplineId);
        dd($score);
    }
}
