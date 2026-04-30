@extends('layouts.app')

@section('title', 'Buat Event')

@section('content')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div class="container py-5">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        {{-- ================= LEFT BUILDER ================= --}}
        <div class="col-lg-8">

            <form id="eventForm" method="POST" action="{{ route('catalog.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- STEP NAV --}}
                <div class="d-flex gap-2 mb-4">
                    <div class="step active" data-step="1">Info</div>
                    <div class="step" data-step="2">Jadwal</div>
                    <div class="step" data-step="3">Tiket</div>
                    <div class="step" data-step="4">Publish</div>
                </div>

                {{-- ================= STEP 1 ================= --}}
                <div class="step-content" id="step-1">

                    <div class="card p-4 mb-4">
                        <h5 class="fw-bold mb-3">Informasi Event</h5>

                        {{-- Nama Event --}}
                        <div class="mb-3">
                            <input id="eventName" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nama Event" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="mb-3">
                            <input id="slug" type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" placeholder="Slug (auto)" value="{{ old('slug') }}">
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div class="mb-3">
                            <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                <option value="" disabled selected>Pilih kategori</option>
                                @foreach($categories as $c)
                                    <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Harga Dasar (untuk produk tanpa tiket) --}}
                        <div class="mb-3">
                            <label class="form-label">Harga Dasar (Rp)</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="0" value="{{ old('price', 0) }}">
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Stok --}}
                        <div class="mb-3">
                            <label class="form-label">Stok (akan dihitung otomatis jika tiket ditambahkan)</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" placeholder="0" value="{{ old('stock', 0) }}">
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Berat --}}
                        <div class="mb-3">
                            <label class="form-label">Berat (gram)</label>
                            <input type="number" name="weight" class="form-control @error('weight') is-invalid @enderror" placeholder="1000" value="{{ old('weight', 1000) }}">
                            @error('weight')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Deskripsi (Quill) --}}
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Event</label>
                            <div id="editor" style="height:150px;"></div>
                            <input type="hidden" name="description" id="desc" value="{{ old('description') }}">
                            @error('description')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        {{-- Banner Event --}}
                        <div class="mb-3">
                            <label>Banner Event</label>
                            <input type="file" name="banner" class="form-control mb-2 @error('banner') is-invalid @enderror" id="bannerInput" accept="image/*">
                            @error('banner')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <img id="bannerPreview" class="w-100 rounded d-none">
                        </div>

                        {{-- Gallery Images --}}
                        <div class="mb-3">
                            <label>Gambar Produk (Gallery)</label>
                            <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" multiple accept="image/*">
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('images.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- ================= STEP 2 ================= --}}
                <div class="step-content d-none" id="step-2">

                    <div class="card p-4 mb-4">
                        <h5 class="fw-bold">Jadwal</h5>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai Event</label>
                            <input type="datetime-local" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date') }}">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai Event</label>
                            <input type="datetime-local" name="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date') }}">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <h6>Lokasi</h6>

                        <select id="locationType" class="form-select mb-2">
                            <option value="offline">Offline</option>
                            <option value="online">Online</option>
                        </select>

                        <input type="text" name="location" id="locationInput" class="form-control @error('location') is-invalid @enderror" placeholder="Nama tempat" value="{{ old('location') }}">
                        @error('location')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                </div>

                {{-- ================= STEP 3 ================= --}}
                <div class="step-content d-none" id="step-3">

                    <div class="card p-4 mb-4">
                        <h5 class="fw-bold">Tiket</h5>

                        <div id="tickets"></div>

                        <button type="button" onclick="addTicket()" class="btn btn-outline-primary mt-2">
                            + Tambah Tiket
                        </button>
                    </div>

                </div>

                {{-- ================= STEP 4 ================= --}}
                <div class="step-content d-none" id="step-4">

                    <div class="card p-4">
                        <h5 class="fw-bold">Publish</h5>

                        <select name="status" class="form-select mb-3 @error('status') is-invalid @enderror" required>
                            <option value="publish" selected>Publish</option>
                            <option value="draft">Simpan Draft</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div class="form-check form-switch">
                            <input type="checkbox" name="is_featured" class="form-check-input" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label>Jadikan Unggulan</label>
                        </div>

                    </div>

                </div>

{{-- NAV --}}
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" onclick="prevStep()" class="btn btn-secondary" id="prevBtn">Kembali</button>
                    <button type="button" onclick="nextStep()" class="btn btn-primary" id="nextBtn">Lanjut</button>
                    <button type="submit" id="submitBtn" class="btn btn-success d-none">Publish</button>
                </div>

            </form>
        </div>

        {{-- ================= RIGHT SUMMARY ================= --}}
        <div class="col-lg-4">
            <div class="card p-4 sticky-top" style="top:100px">
                <h5 class="fw-bold">Preview Event</h5>

                <img id="previewBanner" class="w-100 rounded mb-3 d-none">

                <h6 id="previewName">Nama Event</h6>
                <p class="text-muted small" id="previewDate">Tanggal belum diisi</p>

                <hr>

                <div id="ticketPreview"></div>
            </div>
        </div>

    </div>
</div>

<style>
.step { padding:6px 12px; background:#eee; border-radius:20px; cursor:pointer; }
.step.active { background:#0d6efd; color:white; }
</style>

<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<script>
let step = 1;
function showStep(){
    document.querySelectorAll('.step-content').forEach(el=>el.classList.add('d-none'));
    document.getElementById('step-'+step).classList.remove('d-none');

    document.querySelectorAll('.step').forEach(el=>el.classList.remove('active'));
    document.querySelector(`.step[data-step="${step}"]`).classList.add('active');

    document.getElementById('submitBtn').classList.toggle('d-none', step!==4);
    document.getElementById('nextBtn').classList.toggle('d-none', step===4);
    document.getElementById('prevBtn').classList.toggle('d-none', step===1);
}
function nextStep(){ if(step<4) step++; showStep(); }
function prevStep(){ if(step>1) step--; showStep(); }
showStep();

{{-- QUILL --}}
let quill = new Quill('#editor',{theme:'snow'});

// Load old description if exists
let oldDesc = document.getElementById('desc').value;
if(oldDesc){
    quill.root.innerHTML = oldDesc;
}

document.getElementById('eventForm').onsubmit=function(){
    document.getElementById('desc').value=quill.root.innerHTML;
};

{{-- SLUG AUTO --}}
document.getElementById('eventName').addEventListener('input',function(){
    let slug = this.value.toLowerCase().replace(/[^a-z0-9]+/g,'-').replace(/^-|-$/g,'');
    document.getElementById('slug').value = slug;
    document.getElementById('previewName').innerText = this.value || 'Nama Event';
});

{{-- BANNER PREVIEW --}}
document.getElementById('bannerInput').addEventListener('change',e=>{
    let file=e.target.files[0];
    if(!file) return;
    let url=URL.createObjectURL(file);

    document.getElementById('bannerPreview').src=url;
    document.getElementById('bannerPreview').classList.remove('d-none');

    document.getElementById('previewBanner').src=url;
    document.getElementById('previewBanner').classList.remove('d-none');
});

{{-- TICKETS --}}
let ticketIndex = 0;
function addTicket(){
    let html=`
    <div class="border p-3 mb-2 rounded ticket-item" data-index="${ticketIndex}">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <strong>Tiket #${ticketIndex + 1}</strong>
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.ticket-item').remove()">Hapus</button>
        </div>
        <input type="text" name="tickets[${ticketIndex}][name]" placeholder="Nama Tiket" class="form-control mb-2">
        <input type="number" name="tickets[${ticketIndex}][price]" placeholder="Harga" class="form-control mb-2" min="0">
        <input type="number" name="tickets[${ticketIndex}][stock]" placeholder="Kuota" class="form-control mb-2" min="0">
        <input type="datetime-local" name="tickets[${ticketIndex}][start]" class="form-control mb-2">
        <input type="datetime-local" name="tickets[${ticketIndex}][end]" class="form-control">
    </div>`;
    document.getElementById('tickets').insertAdjacentHTML('beforeend',html);
    ticketIndex++;
}
</script>

@endsection

