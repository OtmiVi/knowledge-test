<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    protected $user;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();
            return $next($request);
        }); 
    }

    public function index(){
        $item = $this->user;
        return view('teacher.index', compact('item'));
    }
}
