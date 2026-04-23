@extends('layouts.app')

@section('title', 'Create Ticket')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            {{-- Header --}}
            <div class="mb-4">
                <h2 class="fw-bold mb-1">Create New Ticket</h2>
                <p class="text-muted">Jelaskan masalah Anda dengan detail agar dapat ditangani dengan lebih cepat</p>
            </div>

            {{-- Form Card --}}
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <form action="{{ route('tickets.store') }}" method="POST">
                        @csrf

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
                                   value="{{ old('title') }}"
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
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                           {{ old('priority') === 'low' ? 'checked' : '' }}>
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
                                           {{ old('priority', 'medium') === 'medium' ? 'checked' : '' }}>
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
                                           {{ old('priority') === 'high' ? 'checked' : '' }}>
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
                                           {{ old('priority') === 'urgent' ? 'checked' : '' }}>
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
                                      placeholder="Jelaskan masalah Anda secara detail. Semakin detail semakin baik kami dapat membantu."
                                      required>{{ old('description') }}</textarea>
                            <small class="text-muted d-block mt-2">
                                Min 10 karakter
                            </small>
                            @error('description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('tickets.index') }}" class="btn btn-light rounded-2">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary rounded-2">
                                <i class="bi bi-check-circle"></i> Create Ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tips --}}
            <div class="card border-0 bg-light rounded-3 mt-4">
                <div class="card-body p-4">
                    <h6 class="fw-semibold mb-3">
                        <i class="bi bi-lightbulb text-warning"></i> Tips untuk Ticket Lebih Baik
                    </h6>
                    <ul class="mb-0 ps-3 small">
                        <li>Gunakan judul yang jelas dan deskriptif</li>
                        <li>Jelaskan langkah-langkah yang Anda lakukan sebelum masalah terjadi</li>
                        <li>Sertakan pesan error jika ada</li>
                        <li>Sebutkan perangkat atau browser yang Anda gunakan</li>
                        <li>Tentukan prioritas dengan akurat agar dapat ditangani lebih cepat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
