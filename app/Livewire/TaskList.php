<?php

namespace App\Livewire;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;

class TaskList extends Component
{
    use WithPagination;
    
    #[Validate('required', message: 'Please provide the content of the task.')]
    public $body = '';
    public $taskToUpdate = null;
    public $updating = false;

    public function saveTask()
    {
        $validated = $this->validate();
        Task::create($validated);
        $this->clearData();
    }

    public function editTask(Task $task)
    {
        $this->resetValidation();
        $this->body = $task->body;
        $this->taskToUpdate = $task;
        $this->updating = true;
    }

    public function updateTask()
    {
        $validated = $this->validate();
        $this->taskToUpdate->update($validated);
        $this->clearData();
    }

    public function taskDone()
    {
        $this->taskToUpdate->update([
            'done' => 1
        ]);
        $this->clearData();
    }

    public function deleteTask(Task $task)
    {
        $task->delete();
        $this->clearData();
    }

    public function clearData()
    {
        $this->body = '';
        if($this->updating) {
            $this->taskToUpdate = null;
            $this->updating = false;
        }
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.task-list', [
            'tasks' => Task::latest()->simplePaginate(3)
        ]);
    }
}
