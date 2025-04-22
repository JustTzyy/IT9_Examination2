@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-4 p-4">
                    <div class="card-body">

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                            <h4 class="mb-0">📋 All Tasks</h4>
                            <a href="{{ route('tasks.create') }}" class="btn btn-primary"
                                onclick="return confirm('Are you sure you want to create a new task?')">
                                <i class="bi bi-plus-circle me-1"></i> Create New Task
                            </a>
                        </div>

                        @if ($tasks->isEmpty())
                            <div class="alert alert-warning mt-4 text-center">
                                <i class="bi bi-info-circle me-1"></i> No Task available.
                            </div>
                        @else
                            <div class="table-responsive mt-3">
                                <table class="table table-hover align-middle shadow-sm rounded-3">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Status</th>
                                            <th scope="col" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td>{{ $task->id }}</td>
                                                <td class="fw-semibold">{{ $task->title }}</td>
                                                <td>{{ $task->description}}</td>
                                                <td>
                                                    <form action="{{ route('tasks.toggleStatus', $task->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <div class="form-check form-switch d-flex align-items-center">
                                                            <input class="form-check-input" type="checkbox"
                                                                onchange="this.form.submit()" name="is_completed" {{ $task->is_completed ? 'checked' : '' }}>
                                                            <label class="ms-2">
                                                                {{ $task->is_completed ? 'Completed' : 'Pending' }}
                                                            </label>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('tasks.show', $task) }}"
                                                            class="btn btn-sm btn-outline-info"
                                                            onclick="return confirm('Do you want to view this task?')" title="View">
                                                            <i class="bi bi-eye"></i>
                                                        </a>

                                                        <a href="{{ route('tasks.edit', $task) }}"
                                                            class="btn btn-sm btn-outline-warning"
                                                            onclick="return confirm('Proceed to edit this task?')" title="Edit">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </a>

                                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('Are you sure you want to delete this task?')"
                                                                title="Delete">
                                                                <i class="bi bi-trash-fill"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection