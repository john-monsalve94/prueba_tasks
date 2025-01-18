<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateTaskTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanCreateTask()
    {
        $user = User::factory()->create();

        $taskData = [
            'title'=>'newTask',
            'description'=>'aaaaaabbbbb',
            'status'=>'pending',
            'user_id'=>$user->id
        ];

        $response = $this->actingAs($user)->post('/api/tasks',$taskData);

        $this->assertDatabaseHas('tasks',[
            'title'=>$taskData['title'],
            'description'=>$taskData['description'],
            'status'=>$taskData['status'],
            'user_id'=>$taskData['user_id']
        ]);
        $response->assertStatus(201);
    }

    public function testCanNotCreateTask()
    {
        $user = User::factory()->create();
    
        $taskData = [
            'title' => 'new',           
            'description' => 'aaaaaabbbbb',  
            'status' => 'pendin',         
            'user_id' => 99999,          
        ];
    

        $response = $this->actingAs($user)->post('/api/tasks', $taskData);    
        $this->assertDatabaseMissing('tasks', [
            'title' => $taskData['title'],
            'description' => $taskData['description'],
            'status' => $taskData['status'],
            'user_id' => $taskData['user_id'],
        ]);
    }

    public function testCanDelete()
    {
        $user = User::factory()->create();

        $taskData = [
            'title'=>'newTask',
            'description'=>'aaaaaabbbbb',
            'status'=>'pending',
            'user_id'=>$user->id
        ];

        $task = Task::create($taskData);

        $response = $this->actingAs($user)->delete('/api/tasks/'.$task->id);
        
        $this->assertDatabaseMissing('tasks',['id'=>$task->id]);

    }
}
