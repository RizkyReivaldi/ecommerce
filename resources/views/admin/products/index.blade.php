@extends('layouts.admin')

@section('title', 'Data Produk')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Produk</h3>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
                            <i class="bi bi-plus-circle me-2"></i>Tambah Produk
                        </a>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Nama Produk</th>
                                        <th>Gambar</th>
                                        <th class="text-center">Kategori</th>
                                        <th class="text-center">Harga</th>
                                        <th class="text-center">Stok</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>
                                            <img src="{{  $product->image_url }}" alt="" width="100">
                                        </td>
                                        <td class="text-center">{{ $product->category->name }}</td>
                                        <td class="text-center">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $product->stock }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm rounded-1 btn-warning">
                                                Edit
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-sm rounded-1 btn-secondary">
                                                View
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn rounded-1 btn-sm btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-muted">Belum ada produk.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
