<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\DB;


class TasksTest extends TestCase
{
    use RefreshDatabase;
    public function test_get_all_tasks_from_one_user()
    {
        $this->withoutExceptionHandling();
        $admin = User::factory()->create(['is_admin' => true]);

        $user = User::factory()->create(['id' => 2]);

        $task = Task::factory()->create(); 
        
        DB::table('task_user')
        ->insert(['task_id'=>1, 'user_id'=>2]);

        $response = $this->ActingAs($admin)->getJson('/api/user/'. $user->id .'/tasks');

        $this->assertDatabaseCount('task_user', 1)
            ->assertDatabaseHas('task_user', ['task_id'=>1, 'user_id'=>2]);

        $response->assertJsonFragment(['name' => $task->name]);

    }
}
