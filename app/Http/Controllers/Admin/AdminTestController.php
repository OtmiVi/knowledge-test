<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class AdminTestController extends Controller
{
    public function create()
    {
        return view('admin.test.create');
    }

    public function store(Request $request){
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $item = Test::find($id);
        return view('admin.test.show', compact('item'));
    }

}
