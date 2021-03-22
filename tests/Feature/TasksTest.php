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

    public function test_create_task() 
    {
        $this->withoutExceptionHandling();

        $admin = User::factory()->create(['is_admin' => true]); 

        $data = [
            'name' => 'lavarse los dientes',
            'date' => 2021-03-23,
            'hour' => '12:00 - 13:00',
            'repetition_frequency' => 0,
            'advice' => 'sfhetb',
            'end_message' => 'sfnbegd',
        ];

        $response = $this->ActingAs($admin)->postJson('/api/tasks', $data);

        $response->assertStatus(201)->assertJsonFragment(['name' => 'lavarse los dientes']);

        $this->assertDatabaseHas('tasks', $data);
    }

    public function test_delete_a_task() 
    {
        $this->withExceptionHandling();
        $admin = User::factory()->create(['is_admin' => true]); 
        $user = User::factory()->create(['id' => 2]);

        $task = Task::factory()->create(); 
        
        DB::table('task_user')
        ->insert(['task_id'=>1, 'user_id'=>2]);

        $response = $this->ActingAs($admin)->deleteJson('/api/user/'. $user->id .'/tasks/' . $task->id);

        $response->assertStatus(202)->assertJsonFragment(['message' => 'tarea eliminada correctamente']);
        $this->assertDatabaseCount('task_user', 0);
    }



}
