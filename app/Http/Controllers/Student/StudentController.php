<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    protected $user;

    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();
            return $next($request);
        }); 
    }
    protected function haveDiscipline($disciplineId){
        foreach($this->user->group[0]->disciplines as $discipline){
            if($discipline->id == $disciplineId){
                return;
            }
        }
        return redirect()
            ->to('student')
            ->withErrors(['message' => 'Ви не маєте доступу до даної дисципліни'])
            ->send();
    }

    public function index(){
        $item = $this->user;
        return view('student.index', compact('item'));
    }
}
