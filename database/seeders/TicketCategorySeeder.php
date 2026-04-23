<?php

namespace Database\Seeders;

use App\Models\TicketCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Technical Support',
                'slug' => 'technical-support',
                'description' => 'Masalah teknis dengan aplikasi atau website',
            ],
            [
                'name' => 'Billing & Payment',
                'slug' => 'billing-payment',
                'description' => 'Pertanyaan tentang tagihan, pembayaran, dan invoice',
            ],
            [
                'name' => 'Account & Access',
                'slug' => 'account-access',
                'description' => 'Masalah login, reset password, dan akses akun',
            ],
            [
                'name' => 'General Inquiry',
                'slug' => 'general-inquiry',
                'description' => 'Pertanyaan umum tentang layanan kami',
            ],
            [
                'name' => 'Feature Request',
                'slug' => 'feature-request',
                'description' => 'Saran fitur baru atau improvement',
            ],
            [
                'name' => 'Bug Report',
                'slug' => 'bug-report',
                'description' => 'Laporan bug atau error yang ditemukan',
            ],
        ];

        foreach ($categories as $category) {
            TicketCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
