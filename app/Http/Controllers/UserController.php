<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show(int $id) {
        $user = User::find($id);
        $userTasks = $user->tasks()->get();
        return response()->json($userTasks, 200);
    }


}
