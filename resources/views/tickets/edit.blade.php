@extends('layouts.app')

@section('title', 'Edit Ticket - ' . $ticket->ticket_number)

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- Header --}}
            <div class="mb-4">
                <h2 class="fw-bold mb-1">Edit Ticket</h2>
                <p class="text-muted">
                    <code class="text-primary">{{ $ticket->ticket_number }}</code> - Update informasi ticket Anda
                </p>
            </div>

            {{-- Form Card --}}
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <form action="{{ route('tickets.update', $ticket) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-4">
                            <label for="title" class="form-label fw-semibold">
                                Title <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   class="form-control rounded-2 @error('title') is-invalid @enderror"
                                   placeholder="Ringkas masalah Anda"
                                   value="{{ old('title', $ticket->title) }}"
                                   required>
                            @error('title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div class="mb-4">
                            <label for="category_id" class="form-label fw-semibold">
                                Category <span class="text-muted">(Optional)</span>
                            </label>
                            <select id="category_id" 
                                    name="category_id" 
                                    class="form-select rounded-2 @error('category_id') is-invalid @enderror">
                                <option value="">Select a category...</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $ticket->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Priority --}}
                        <div class="mb-4">
                            <label for="priority" class="form-label fw-semibold">
                                Priority <span class="text-danger">*</span>
                            </label>
                            <div class="d-flex gap-2 flex-wrap">
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           id="priority_low" 
                                           name="priority" 
                                           value="low"
                                           {{ old('priority', $ticket->priority) === 'low' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="priority_low">
                                        🟢 Low
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           id="priority_medium" 
                                           name="priority" 
                                           value="medium"
                                           {{ old('priority', $ticket->priority) === 'medium' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="priority_medium">
                                        🟡 Medium
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           id="priority_high" 
                                           name="priority" 
                                           value="high"
                                           {{ old('priority', $ticket->priority) === 'high' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="priority_high">
                                        🔴 High
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" 
                                           type="radio" 
                                           id="priority_urgent" 
                                           name="priority" 
                                           value="urgent"
                                           {{ old('priority', $ticket->priority) === 'urgent' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="priority_urgent">
                                        ⚫ Urgent
                                    </label>
                                </div>
                            </div>
                            @error('priority')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-4">
                            <label for="description" class="form-label fw-semibold">
                                Description <span class="text-danger">*</span>
                            </label>
                            <textarea id="description" 
                                      name="description" 
                                      class="form-control rounded-2 @error('description') is-invalid @enderror"
                                      rows="6"
                                      placeholder="Jelaskan masalah Anda secara detail."
                                      required>{{ old('description', $ticket->description) }}</textarea>
                            <small class="text-muted d-block mt-2">
                                Min 10 karakter
                            </small>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Alert --}}
                        <div class="alert alert-info rounded-2 mb-4">
                            <i class="bi bi-info-circle"></i> 
                            Anda hanya dapat mengedit ticket dengan status "Open" atau "Pending"
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('tickets.show', $ticket) }}" class="btn btn-light rounded-2">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary rounded-2">
                                <i class="bi bi-check-circle"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
