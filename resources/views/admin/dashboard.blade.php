@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<style>
.dashboard-card {
    transition: transform .25s ease, box-shadow .25s ease;
}
.dashboard-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(0, 0, 0, 0.08);
}
.chart-wrapper {
    min-height: 310px;
}
.order-list-item {
    transition: transform .2s ease, background-color .2s ease;
}
.order-list-item:hover {
    transform: translateX(3px);
    background-color: #f8fbff;
}
.dashboard-summary-card {
    border-radius: 32px;
    transition: transform .25s ease, box-shadow .25s ease;
}
.dashboard-summary-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 45px rgba(13, 110, 253, 0.12);
}
.dashboard-task-card {
    border: 1px solid #e7efff;
    border-radius: 24px;
    transition: transform .25s ease, box-shadow .25s ease;
}
.dashboard-task-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 40px rgba(13, 110, 253, 0.08);
}
.dashboard-tile {
    border-radius: 24px;
    border: 1px solid #eef3fb;
    background: #fff;
    transition: transform .25s ease, box-shadow .25s ease;
}
.dashboard-tile:hover {
    transform: translateY(-3px);
    box-shadow: 0 18px 34px rgba(13, 110, 253, 0.08);
}
.dashboard-topbar {
    min-height: 110px;
    border-radius: 32px;
    background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
    border: 1px solid #e5ecfb;
}
.dashboard-tag {
    border-radius: 999px;
    background: rgba(13, 110, 253, 0.08);
    color: #0d6efd;
}
</style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="row g-4 mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 dashboard-card dashboard-topbar p-4">
                    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                        <div>
                            <h2 class="fw-bold mb-1">Admin Dashboard</h2>
                            <p class="text-muted mb-0">Pantau penjualan, pesanan, dan performa toko sekaligus dukungan dari satu tampilan.</p>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <a href="{{ route('admin.tickets.dashboard') }}" class="btn btn-outline-primary rounded-pill">Support Tickets</a>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-primary rounded-pill">Lihat Pesanan</a>
                            <span class="dashboard-tag px-3 py-2">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 dashboard-task-card p-4 h-100">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <h6 class="fw-semibold mb-2">Verifikasi Nomor Ponsel</h6>
                            <p class="text-muted mb-3">Aktifkan notifikasi dan keamanan akun.</p>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 rounded-pill">Verifikasi</span>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm rounded-pill">Lanjut</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 dashboard-task-card p-4 h-100">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <h6 class="fw-semibold mb-2">Lengkapi Informasi Legal</h6>
                            <p class="text-muted mb-3">Pastikan data legal siap untuk audit.</p>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 rounded-pill">Verifikasi</span>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm rounded-pill">Perbarui</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 dashboard-task-card p-4 h-100">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div>
                            <h6 class="fw-semibold mb-2">Lengkapi Informasi Dasar</h6>
                            <p class="text-muted mb-3">Pastikan profil admin sudah lengkap.</p>
                        </div>
                        <span class="badge bg-primary bg-opacity-10 text-primary py-2 px-3 rounded-pill">Verifikasi</span>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm rounded-pill">Perbarui</a>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm dashboard-summary-card p-4 h-100">
                    <small class="text-uppercase text-muted">Total Pendapatan</small>
                    <h3 class="fw-bold mt-3 text-success">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h3>
                    <p class="text-muted mb-0">Pendapatan semua toko.</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm dashboard-summary-card p-4 h-100">
                    <small class="text-uppercase text-muted">Perlu Diproses</small>
                    <h3 class="fw-bold mt-3 text-warning">{{ $stats['pending_orders'] }}</h3>
                    <p class="text-muted mb-0">Pesanan menunggu konfirmasi.</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm dashboard-summary-card p-4 h-100">
                    <small class="text-uppercase text-muted">Stok Menipis</small>
                    <h3 class="fw-bold mt-3 text-danger">{{ $stats['low_stock'] }}</h3>
                    <p class="text-muted mb-0">Produk yang perlu restock.</p>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm dashboard-summary-card p-4 h-100">
                    <small class="text-uppercase text-muted">Total Produk</small>
                    <h3 class="fw-bold mt-3 text-primary">{{ $stats['total_products'] }}</h3>
                    <p class="text-muted mb-0">Item terdaftar di toko.</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm h-100 rounded-4 dashboard-card">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="card-title mb-0">Grafik Penjualan (7 Hari)</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-wrapper">
                            <canvas id="revenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm h-100 rounded-4 dashboard-card">
                    <div class="card-header bg-white py-3 border-0">
                        <h5 class="card-title mb-0">Pesanan Terbaru</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach($recentOrders as $order)
                                <div class="list-group-item order-list-item d-flex justify-content-between align-items-center px-4 py-3 rounded-4 mb-2 border-0 bg-white shadow-sm">
                                    <div>
                                        <div class="fw-bold text-primary">#{{ $order->order_number }}</div>
                                        <small class="text-muted">{{ $order->user->name }}</small>
                                    </div>
                                    <div class="text-end">
                                        <div class="fw-bold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</div>
                                        <span class="badge rounded-pill {{ $order->payment_status == 'paid' ? 'bg-success bg-opacity-10 text-success' : 'bg-secondary bg-opacity-10 text-secondary' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer bg-white text-center py-3 border-0">
                        <a href="{{ route('admin.orders.index') }}" class="text-decoration-none fw-bold">Lihat Semua Pesanan &rarr;</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm mt-4 rounded-4 dashboard-card">
            <div class="card-header bg-white py-3 border-0">
                <h5 class="card-title mb-0">Produk Terlaris</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    @foreach($topProducts as $product)
                        <div class="col-6 col-md-2 text-center">
                            <div class="card h-100 border-0 rounded-4 shadow-sm">
                                <img src="{{ $product->image_url }}" class="card-img-top rounded-top" style="max-height: 100px; object-fit: cover;">
                                <div class="card-body py-3 px-2">
                                    <h6 class="card-title text-truncate mb-1" style="font-size: 0.9rem">{{ $product->name }}</h6>
                                    <small class="text-muted">{{ $product->sold }} terjual</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartCanvas = document.getElementById('revenueChart');
        if (chartCanvas) {
            const ctx = chartCanvas.getContext('2d');
            const labels = {!! json_encode($revenueChart->pluck('date')) !!};
            const data = {!! json_encode($revenueChart->pluck('total')) !!};

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Pendapatan (Rp)',
                        data: data,
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13, 110, 253, 0.12)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: true,
                        pointRadius: 4,
                        pointHoverRadius: 6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { borderDash: [2, 4] },
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID', { notation: 'compact' }).format(value);
                                }
                            }
                        },
                        x: {
                            grid: { display: false }
                        }
                    }
                }
            });
        }
    </script>
@endsection
