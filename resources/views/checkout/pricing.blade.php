@extends('layouts.app')

@section('content')

<section class="pricing-wrapper">

    {{-- HERO --}}
    <div class="pricing-header">
        <h1>Sukseskan Event Kamu Bersama <span>LOKET</span></h1>
        <p>Pilih biaya transparan & hitung potensi pendapatan event kamu</p>
    </div>

    {{-- PRICING CARD --}}
    <div class="pricing-box">
        <h2>Biaya Penjualan Tiket</h2>

        <div class="pricing-list">
            <div class="pricing-item">
                <div>
                    <h4>E-Wallet & Credit Card</h4>
                    <p>GoPay, ShopeePay, LinkAja, Credit Card</p>
                </div>
                <span>3.5%</span>
            </div>

            <div class="pricing-item">
                <div>
                    <h4>Bank & Retail</h4>
                    <p>VA BCA, Transfer Bank, Indomaret, dll</p>
                </div>
                <span>3.5%</span>
            </div>
        </div>

        <p class="note">*Biaya dapat berubah sesuai metode pembayaran</p>
    </div>

    {{-- CALCULATOR --}}
    <div class="calculator-box">
        <h2>Kalkulator Pendapatan Event</h2>

        <div class="calc-form">
            <input type="number" id="price" placeholder="Harga Tiket (Rp)">
            <input type="number" id="qty" placeholder="Jumlah Tiket">
        </div>

        <button onclick="calculate()">Hitung Pendapatan</button>

        <div class="calc-result">
            <div>
                <p>Total Penjualan</p>
                <h3 id="total">Rp 0</h3>
            </div>
            <div>
                <p>Biaya (3.5%)</p>
                <h3 id="fee">Rp 0</h3>
            </div>
            <div>
                <p>Pendapatan Bersih</p>
                <h3 id="net">Rp 0</h3>
            </div>
        </div>
    </div>

</section>

<script>
function formatRupiah(num) {
    return "Rp " + Number(num).toLocaleString("id-ID");
}

function calculate() {
    let price = document.getElementById('price').value || 0;
    let qty = document.getElementById('qty').value || 0;

    let total = price * qty;
    let fee = total * 0.035;
    let net = total - fee;

    document.getElementById('total').innerText = formatRupiah(total);
    document.getElementById('fee').innerText = formatRupiah(fee);
    document.getElementById('net').innerText = formatRupiah(net);
}
</script>

@endsection





<style>
    body {
    font-family: Arial, sans-serif;
    background: #f5f7fa;
    margin: 0;
}

.pricing-container {
    max-width: 900px;
    margin: auto;
    padding: 40px 20px;
}

.header {
    text-align: center;
    margin-bottom: 30px;
}

.header h1 {
    font-size: 28px;
    color: #222;
}

.header p {
    color: #666;
}

.pricing-card {
    background: #fff;
    border-radius: 10px;
    padding: 25px;
    margin-bottom: 30px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.pricing-item {
    border-bottom: 1px solid #eee;
    padding: 15px 0;
}

.pricing-item h4 {
    margin: 0;
}

.pricing-item span {
    color: #ff5a5f;
    font-weight: bold;
}

.note {
    font-size: 12px;
    color: #777;
    margin-top: 15px;
}

.calculator {
    background: #fff;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.form-group {
    margin-bottom: 15px;
}

input {
    width: 100%;
    padding: 10px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

button {
    width: 100%;
    padding: 12px;
    background: #ff5a5f;
    border: none;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
}

button:hover {
    background: #e14b50;
}

.result {
    margin-top: 20px;
    font-size: 16px;
}

</style>
</html>




