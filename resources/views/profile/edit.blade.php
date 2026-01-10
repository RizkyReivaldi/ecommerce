@extends('layouts.app')

@section('content')

<style>
    /* ===== PROFILE PAGE STYLE ===== */
    .profile-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(0,0,0,.05);
        overflow: hidden;
    }

    .profile-card .card-header {
        background: #fff;
        font-weight: 600;
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f1f1f1;
    }

    .profile-card .card-body {
        padding: 1.5rem;
    }

    .profile-title {
        font-weight: 700;
        letter-spacing: -.3px;
    }

    .section-icon {
        width: 36px;
        height: 36px;
        background: #f8f9fa;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: .75rem;
    }

    .danger-card {
        border: 1px solid #f1b0b7;
        background: #fff5f6;
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            {{-- Judul --}}
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="profile-title mb-0">Profil Saya</h3>
                @include('partials.tombolKembali')
            </div>

            {{-- Alert --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- 1. Avatar --}}
            <div class="card profile-card mb-4">
                <div class="card-header d-flex align-items-center">
                    <div class="section-icon">
                        <i class="bi bi-person-circle"></i>
                    </div>
                    Foto Profil
                </div>
                <div class="card-body">
                    @include('profile.partials.update-avatar-form')
                </div>
            </div>

            {{-- 2. Informasi Profil --}}
            <div class="card profile-card mb-4">
                <div class="card-header d-flex align-items-center">
                    <div class="section-icon">
                        <i class="bi bi-info-circle"></i>
                    </div>
                    Informasi Profil
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- 3. Update Password --}}
            <div class="card profile-card mb-4">
                <div class="card-header d-flex align-items-center">
                    <div class="section-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                    Update Password
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- 4. Akun Terhubung --}}
            <div class="card profile-card mb-4">
                <div class="card-header d-flex align-items-center">
                    <div class="section-icon">
                        <i class="bi bi-link-45deg"></i>
                    </div>
                    Akun Terhubung
                </div>
                <div class="card-body">
                    @include('profile.partials.connected-accounts')
                </div>
            </div>

            {{-- 5. Hapus Akun --}}
            <div class="card danger-card profile-card">
                <div class="card-header text-danger d-flex align-items-center">
                    <div class="section-icon bg-danger text-white">
                        <i class="bi bi-trash"></i>
                    </div>
                    Hapus Akun
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
