@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white fw-semibold">
                    Edit Task #{{ $task->id }}
                </div>
                <div class="card-body">

                    <!-- action = update() route, method POST + @method('PUT') -->
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')  <!-- tells Laravel this is an update (PUT) request -->

                        <div class="mb-3">
                            <label for="title" class="form-label">Task Title <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $task->title) }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description (optional)</label>
                            <textarea name="description"
                                      id="description"
                                      rows="4"
                                      class="form-control @error('description') is-invalid @enderror">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Update Task</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
