<div class="container">
    <div class="row my-5">
        <div class="col-md-10 mx-auto">
            <div class="row my-5">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach ($tasks as $task)
                                    <li wire:key="{{$task->id}}" class="list-group-item d-flex justify-content-between align-items-center">
                                        <p @class(['text-decoration-line-through' => $task->done])>
                                            {{ str($task->body)->words(6) }}
                                        </p>
                                        <div class="dropdown ms-auto">
                                            <i class="fa-solid fa-ellipsis-vertical"
                                                data-bs-toggle="dropdown"></i>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <span class="dropdown-item"
                                                        style="cursor: pointer"  
                                                        wire:click="editTask({{$task->id}})"
                                                    >
                                                        <i class="fas fa-edit text-warning"></i> 
                                                    </span>
                                                </li>
                                                <li>
                                                    <span class="dropdown-item"
                                                        style="cursor: pointer"   
                                                        wire:click="deleteTask({{$task->id}})" 
                                                        wire:confirm="Are you sure you want to delete this task ?"
                                                    >
                                                        <i class="fas fa-trash text-danger"></i> 
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="mt-3 d-flex justify-content-center">
                                {{ $tasks->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <textarea 
                                name="body" cols="30" rows="10"
                                wire:model="body"
                                placeholder="Start typing..."
                                class="form-control @error('body') is-invalid @enderror"></textarea>
                            @error('body')
                                <div class="invalid-feedback">
                                    {{ $message }}    
                                </div>   
                            @enderror
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-between">
                            @if ($updating)
                                @if (!$taskToUpdate->done)
                                    <div 
                                        wire:click="taskDone()"
                                        class="btn btn-sm btn-success">
                                        <i class="fas fa-check-double"></i>
                                    </div>
                                @endif
                                <div>
                                    <button 
                                        wire:click="clearData()"
                                        class="btn btn-sm btn-primary">
                                        <i class="fas fa-arrow-left"></i>
                                    </button>
                                    <button 
                                        wire:click="updateTask({{$taskToUpdate->id}})"
                                        class="btn btn-sm btn-warning mx-1">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </div>
                            @else
                                <button 
                                    wire:click="saveTask()"
                                    class="btn btn-sm btn-dark">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

