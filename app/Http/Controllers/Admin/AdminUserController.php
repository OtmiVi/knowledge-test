<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function showAll(){
        $items = User::orderBy('name')->paginate(10);
        return view('admin.users.showAll', compact('items'));
    }
}
