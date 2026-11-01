@extends('layouts.app')

@section('title', 'Add New Task')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white fw-semibold">
                    Add New Task
                </div>
                <div class="card-body">

                    <!-- action = the store() route, method = POST -->
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf  <!-- CSRF protection token (required for all POST forms) -->

                        <div class="mb-3">
                            <label for="title" class="form-label">Task Title <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}"
                                   placeholder="e.g. Submit project report"
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
                                      class="form-control @error('description') is-invalid @enderror"
                                      placeholder="Add more details about the task">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save Task</button>
                        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
