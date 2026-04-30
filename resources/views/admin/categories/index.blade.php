@extends('layouts.admin')

@section('title', 'Manajemen Kategori')

@push('styles')
<style>
    .table img {
        object-fit: cover;
    }
    .modal-content {
        border-radius: 16px;
    }
</style>
@endpush

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <div>
            <h5 class="mb-0">Manajemen Kategori</h5>
            <small>Kelola kategori produk</small>
        </div>
        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
            + Tambah Kategori
        </button>
    </div>

    <div class="card-body">
        @if($categories->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Kategori</th>
                            <th class="text-center">Slug</th>
                            <th class="text-center">Produk</th>
                            <th class="text-center">Status</th>
                            <th class="text-end">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($category->image)
                                        <img src="{{ Storage::url($category->image) }}"
                                             class="rounded me-2"
                                             width="40" height="40"
                                             style="object-fit: cover">
                                    @else
                                        <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" 
                                             style="width:40px;height:40px">
                                            <i class="bi bi-folder"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="fw-bold">{{ $category->name }}</div>
                                        <small class="text-muted">ID: {{ $category->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <small class="text-muted">{{ $category->slug }}</small>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info">{{ $category->products_count ?? 0 }}</span>
                            </td>
                            <td class="text-center">
                                @if($category->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <button type="button" 
                                        class="btn btn-sm btn-warning edit-btn"
                                        data-id="{{ $category->id }}"
                                        data-name="{{ $category->name }}"
                                        data-description="{{ $category->description ?? '' }}"
                                        data-active="{{ $category->is_active ? '1' : '0' }}">
                                    <i class="bi bi-pencil"></i> Edit
                                </button>

                                <form action="{{ route('admin.categories.destroy', $category) }}"
                                      method="POST"
                                      class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger delete-btn">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $categories->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-folder2-open" style="font-size: 48px; color: #ccc;"></i>
                <h5 class="mt-3 text-muted">Belum ada kategori</h5>
                <p class="text-muted">Klik tombol "Tambah Kategori" untuk membuat kategori pertama</p>
            </div>
        @endif
    </div>
</div>


@section('modals')

{{-- CREATE MODAL --}}
<div class="modal fade" id="createModal" tabindex="-1" data-bs-backdrop="true" data-bs-keyboard="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" required placeholder="Contoh: Elektronik">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi kategori..."></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    <small class="text-muted">Maksimal 1MB (JPG, PNG, JPEG)</small>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="is_active" class="form-check-input" value="1" checked>
                    <label class="form-check-label">Aktifkan kategori</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- EDIT MODAL --}}
<div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="true" data-bs-keyboard="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-header">
                <h5 class="modal-title">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="edit_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" id="edit_description" class="form-control" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar Baru</label>
                    <input type="file" name="image" id="edit_image" class="form-control" accept="image/*">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
                </div>
                <div class="form-check">
                    <input type="checkbox" name="is_active" id="edit_active" class="form-check-input" value="1">
                    <label class="form-check-label">Aktif</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Edit functionality
    const editButtons = document.querySelectorAll('.edit-btn');
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    const editForm = document.getElementById('editForm');
    
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const description = this.dataset.description || '';
            const isActive = this.dataset.active;
            
            editForm.action = `/admin/categories/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description;
            document.getElementById('edit_active').checked = (isActive === '1');
            document.getElementById('edit_image').value = '';
            
            editModal.show();
        });
    });

    // Delete functionality
    const deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                this.closest('form').submit();
            }
        });
    });

    // ✅ FIX: remove stuck backdrop
    document.addEventListener('hidden.bs.modal', function () {
        document.body.classList.remove('modal-open');
        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
    });
});
</script>

@endsection