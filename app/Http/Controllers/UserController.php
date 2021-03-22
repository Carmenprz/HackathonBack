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

    public function destroyTask(int $user_id, int $task_id) 
    {

        DB::table('task_user')
            ->where('user_id', $user_id)
            ->where('task_id', $task_id)
            ->delete();

        return response()->json(['message' => 'tarea eliminada correctamente'], 202);
    }
}
