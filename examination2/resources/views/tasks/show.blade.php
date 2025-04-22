@extends('layout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow border-0 rounded-4">
                    <div
                        class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                        <h4 class="mb-0">
                            <i class="bi bi-journal-text me-2"></i>{{ $task->title }}
                        </h4>
                        @if ($task->is_completed)
                            <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Completed</span>
                        @else
                            <span class="badge bg-warning text-dark"><i class="bi bi-clock me-1"></i> Pending</span>
                        @endif
                        <a href="{{ route('tasks.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i>Back to Tasks
                        </a>
                    </div>
                    <div class="card-body">
                        <p class="text-muted mb-2">
                            <i class="bi bi-calendar-event me-1"></i>
                            {{ \Carbon\Carbon::parse($task->created_at)->format('F j, Y') }}
                        </p>
                        <p class="fs-5">{{ $task->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection