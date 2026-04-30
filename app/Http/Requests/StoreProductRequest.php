<?php
// app/Http/Requests/StoreProductRequest.php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreProductRequest extends FormRequest
{
    /**
     * Tentukan apakah user diizinkan membuat request ini.
     */
    public function authorize(): bool
    {
        // Siapa pun yang sudah login boleh membuat event/public product.
        return Auth::check();
    }

    /**
     * Aturan validasi untuk data yang dikirim.
     */
    public function rules(): array
    {
        return [
            // category_id harus ada di tabel categories kolom id
            'category_id' => ['required', 'exists:categories,id'],

            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            // Harga minimal 1000 rupiah
            'price' => ['nullable', 'numeric', 'min:0'],

            'slug' => ['nullable', 'string', 'max:255', 'unique:products,slug'],

            // Harga diskon (opsional), tapi jika diisi:
            // 1. Harus numeric
            // 2. Minimal 0
            // 3. Harus KURANG DARI ('lt' = less than) harga asli (price)
            'discount_price' => ['nullable', 'numeric', 'min:0', 'lt:price'],

            'stock' => ['nullable', 'integer', 'min:0'],
            'weight' => ['required', 'integer', 'min:1'], // Berat minimal 1 gram

            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],

            // Validasi Array Gambar
            // 'images' harus berupa array
            // Maksimal 10 file sekaligus
            'images' => ['nullable', 'array', 'max:10'],

            // Validasi TIAP item di dalam array images
            // 'images.*' artinya "setiap file di dalam array images"
            'images.*' => [
                'image', // Harus berupa file gambar
                'mimes:jpg,png,webp', // Ekstensi yang diperbolehkan
                'max:2048' // Maksimal 2MB per file (2048 KB)

                
            ],
            // EVENT FIELDS (add below your current rules)

            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],

            'location' => ['nullable', 'string', 'max:255'],

            // tickets comes as array from frontend
            'tickets' => ['nullable', 'array'],

            // validate each ticket field (tickets[0][name], tickets[0][price], etc.)
            'tickets.*.name' => ['required_with:tickets', 'string', 'max:255'],
            'tickets.*.price' => ['required_with:tickets', 'numeric', 'min:0'],
            'tickets.*.stock' => ['required_with:tickets', 'integer', 'min:0'],
            'tickets.*.start' => ['nullable', 'date'],
            'tickets.*.end' => ['nullable', 'date'],

            'banner' => ['nullable', 'image', 'mimes:jpg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'images.*.image' => 'File harus berupa gambar.',
            'images.*.mimes' => 'Ekstensi file harus jpg, png, atau webp.',
            'images.*.max' => 'Ukuran file maksimal 2MB.',
            'images.max' => 'Maksimal 10 file gambar.',
            'category_id.exists' => 'Kategori tidak ditemukan.',
            'name.required' => 'Nama produk harus diisi.',
            'weight.required' => 'Berat produk harus diisi.',
            'stock.required' => 'Stok produk harus diisi.',
            'category_id.required' => 'Kategori produk harus dipilih.',
        ];
    }

    /**
     * Persiapkan data sebelum validasi dijalankan.
     * Berguna untuk normalisasi data.
     */
    protected function prepareForValidation(): void
    {
        // Checkbox di HTML kadang tidak mengirim value jika tidak dicentang (atau kirim string "on").
        // Kita paksa konversi jadi boolean true/false agar database menerima nilai yang benar (1/0).
        $this->merge([
            'is_active' => $this->boolean('is_active'),
            'is_featured' => $this->boolean('is_featured'), 

            'slug' => $this->slug ?? ($this->name ? Str::slug($this->name) : null),
        ]);
    }
}
