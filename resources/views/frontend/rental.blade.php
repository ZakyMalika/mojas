<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rental Car</title>
     <style>
         /* === NAVBAR === */
        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #2c5530;
            text-decoration: none;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
        }

        .nav-menu a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-menu a:hover {
            color: #2c5530;
        }

        .nav-menu a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: #2c5530;
            transition: width 0.3s ease;
        }

        .nav-menu a:hover::after {
            width: 100%;
        }

        /* === BUTTONS === */
        .admin-btn {
            background: linear-gradient(135deg, #2c5530, #4a7c59);
            color: white !important;
            padding: 0.7rem 1.5rem;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(44, 85, 48, 0.3);
        }

        .admin-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(44, 85, 48, 0.4);
        }

        .btn-primary {
            background: linear-gradient(135deg, #ff8c42, #ff6b1a);
            color: white;
            padding: 1rem 2rem;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(255, 140, 66, 0.4);
            cursor: pointer;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(255, 140, 66, 0.6);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 1rem 2rem;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: white;
        }

        /* === Rental Section === */
.rental-section {
    padding: 120px 0 80px 0; /* Memberi ruang dari navbar */
    background: #fff;
}

.section-header {
    text-align: center;
    margin-bottom: 50px;
}

.section-header h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c5530;
    margin-bottom: 10px;
}

.section-header p {
    font-size: 1.1rem;
    color: #666;
    max-width: 700px;
    margin: 0 auto;
}

.rental-content-wrapper {
    display: flex;
    gap: 40px;
    align-items: flex-start;
}

/* === Booking Form (Kolom Kiri) === */
.booking-form-container {
    flex: 1 1 40%;
}

.form-card {
    background: #ffffff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
}

.form-card h3 {
    text-align: center;
    margin-bottom: 25px;
    font-size: 1.8rem;
    color: #333;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: #555;
}

.form-group label i {
    margin-right: 8px;
    color: #2c5530;
}

.form-group input {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.form-group input:focus {
    outline: none;
    border-color: #2c5530;
    box-shadow: 0 0 0 3px rgba(44, 85, 48, 0.1);
}

.form-row {
    display: flex;
    gap: 20px;
}

.form-row .form-group {
    width: 100%;
}

.btn-primary.full-width {
    width: 100%;
    padding: 15px;
    font-size: 1.1rem;
    margin-top: 10px;
}


/* === Pricing Info (Kolom Kanan) === */
.pricing-info-container {
    flex: 1 1 55%;
}

.info-box {
    background: linear-gradient(135deg, #2c5530, #4a7c59);
    color: white;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 30px;
}

.info-box h4 {
    margin-top: 0;
    font-size: 1.4rem;
}

.pricing-info-container h4 {
    font-size: 1.5rem;
    color: #ffffff;
    margin-bottom: 20px;
}

.pricing-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-bottom: 30px;
}

.price-card {
    background: #fdfdfd;
    border: 1px solid #eee;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s;
    position: relative;
}

.price-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.09);
}

.price-card.featured {
    border-color: #ff8c42;
    border-width: 2px;
}

.featured-badge {
    position: absolute;
    top: -28px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(135deg, #ff8c42, #ff6b1a);
    color: white;
    padding: 5px 15px;
    font-size: 0.8rem;
    font-weight: 700;
    border-radius: 20px;
}


.price-header {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.price-header h5 {
    margin: 0;
    font-size: 1.2rem;
    color: #333;
}

.currency-flag {
    font-size: 1.5rem;
}

.price-value {
    font-size: 2.2rem;
    font-weight: 700;
    color: #2c5530;
}

.price-value sup {
    font-size: 1.2rem;
    font-weight: 500;
    top: -1em;
}

.price-note {
    font-size: 0.9rem;
    color: #777;
}

.inclusions-box {
    background: #f5f8f6;
    border-left: 4px solid #2c5530;
    padding: 25px;
    border-radius: 8px;
}

.inclusions-box h5 {
    margin-top: 0;
    font-size: 1.2rem;
    font-weight: 600;
}

.inclusions-box ul {
    list-style: none;
    padding: 0;
    margin: 15px 0;
}

.inclusions-box ul li {
    margin-bottom: 10px;
    color: #555;
}

.inclusions-box ul li i {
    color: #28a745;
    margin-right: 10px;
}

/* === Responsive Design === */
@media (max-width: 992px) {
    .rental-content-wrapper {
        flex-direction: column;
    }
}

@media (max-width: 576px) {
    .section-header h2 {
        font-size: 2rem;
    }
    .pricing-grid {
        grid-template-columns: 1fr;
    }
    .form-row {
        flex-direction: column;
        gap: 0;
    }
}
    </style>
</head>
<body>
    <x-dashboard.navbar />

    {{-- main --}}
   <main class="rental-section" id="tarif">
    <div class="container">
        <div class="section-header">
            <h2>Rental Mobil Harian di Batam</h2>
            <p>Layanan rental mobil plus pengemudi untuk kebutuhan perjalanan bisnis, wisata, atau pribadi Anda.</p>
        </div>

        <div class="rental-content-wrapper">
            <div class="booking-form-container" data-aos="fade-right">
                <div class="form-card">
                    <h3>Pesan Perjalanan Anda</h3>
                    {{-- ID form diubah menjadi "bookingForm" untuk dihubungkan ke JavaScript --}}
                    <form id="bookingForm">
                        <div class="form-group">
                            <label for="pickup-location"><i class="fas fa-map-marker-alt"></i> Lokasi Penjemputan</label>
                            <input type="text" id="pickup-location" name="pickup_location" placeholder="Contoh: Hotel Harmoni One" required>
                        </div>
                        <div class="form-group">
                            <label for="destination"><i class="fas fa-route"></i> Tujuan Utama</label>
                            <input type="text" id="destination" name="destination" placeholder="Contoh: Nagoya Hill Mall, Jembatan Barelang" required>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="pickup-date"><i class="fas fa-calendar-alt"></i> Tanggal</label>
                                <input type="date" id="pickup-date" name="pickup_date" required>
                            </div>
                            <div class="form-group">
                                <label for="pickup-time"><i class="fas fa-clock"></i> Waktu</label>
                                <input type="time" id="pickup-time" name="pickup_time" required>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="phone-number"><i class="fab fa-whatsapp"></i> Nomor WhatsApp Anda</label>
                            <input type="tel" id="phone-number" name="phone_number" placeholder="Contoh: 081234567890" required>
                        </div>
                        <button type="submit" class="btn-primary full-width">Pesan via WhatsApp</button>
                    </form>
                </div>
            </div>

            <div class="pricing-info-container" data-aos="fade-left">
                <div class="info-box">
                    <h4>Armada MPV Nyaman</h4>
                    <p>Kami menyediakan mobil MPV seperti Avanza, Xenia, atau Ertiga yang bersih, ber-AC, dan nyaman untuk maksimal 6 penumpang.</p>
                </div>
                
                {{-- Durasi diubah menjadi 12 Jam --}}
                <h4>Paket Harga Spesial (Durasi 12 Jam)</h4>
                <div class="pricing-grid">
                    <div class="price-card">
                        <div class="price-header">
                            <span class="currency-flag">🇮🇩</span>
                            <h5>Indonesia</h5>
                        </div>
                        <div class="price-value"><sup>Rp</sup>850.000</div>
                        {{-- Diubah --}}
                        <div class="price-note">/ 12 Jam</div>
                    </div>

                    <div class="price-card featured">
                         <div class="featured-badge">Paling Populer</div>
                        <div class="price-header">
                            <span class="currency-flag">🇸🇬</span>
                            <h5>Singapura</h5>
                        </div>
                        <div class="price-value"><sup>S$</sup>70</div>
                        {{-- Diubah --}}
                        <div class="price-note">/ 12 Hours</div>
                    </div>

                    <div class="price-card">
                        <div class="price-header">
                            <span class="currency-flag">🇲🇾</span>
                            <h5>Malaysia</h5>
                        </div>
                        <div class="price-value"><sup>RM</sup>245</div>
                        {{-- Diubah --}}
                        <div class="price-note">/ 12 Jam</div>
                    </div>
                </div>

                <div class="inclusions-box">
                    <h5>Harga Sudah Termasuk:</h5>
                    <ul>
                        <li><i class="fas fa-check-circle"></i> Mobil MPV + AC</li>
                        <li><i class="fas fa-check-circle"></i> Pengemudi Profesional</li>
                        <li><i class="fas fa-check-circle"></i> Bensin (BBM)</li>
                        <li><i class="fas fa-check-circle"></i> Biaya Parkir & Tol</li>
                    </ul>
                    {{-- Diubah --}}
                    <small>*Harga tidak termasuk tiket masuk tempat wisata dan biaya overtime (jika melebihi 12 jam).</small>
                </div>
            </div>
        </div>
    </div>
</main>
     
    <x-dashboard.kerjasama />
    <hr style="margin: 0; border: none; height: 3px; background: #eee; margin-left: 100px; margin-right: 100px;">


    <x-dashboard.faq />

    <x-dashboard.kontak />

    <x-dashboard.footer />

</body><script>
document.addEventListener('DOMContentLoaded', function() {
    // Ganti dengan nomor WhatsApp tujuan Anda (gunakan format internasional tanpa '+' atau '0')
    // Contoh: 6281234567890 untuk nomor Indonesia
    const whatsAppNumber = '6282371562766'; 

    const bookingForm = document.getElementById('bookingForm');

    bookingForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form submit secara normal

        // Ambil data dari setiap input
        const pickupLocation = document.getElementById('pickup-location').value;
        const destination = document.getElementById('destination').value;
        const pickupDate = document.getElementById('pickup-date').value;
        const pickupTime = document.getElementById('pickup-time').value;
        const userPhone = document.getElementById('phone-number').value;

        // Format tanggal agar lebih mudah dibaca
        const date = new Date(pickupDate);
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        const formattedDate = date.toLocaleDateString('id-ID', options);

        // Buat template pesan WhatsApp
        const message = `
*Pemesanan Rental Mobil - MOJAS Batam*

Halo, saya ingin memesan layanan rental mobil. Berikut detailnya:

Lokasi Jemput: *${pickupLocation}*
Tujuan Utama: *${destination}*
Tanggal Jemput: *${formattedDate}*
Waktu Jemput: *${pickupTime}*

Nomor WhatsApp saya: *${userPhone}*

Mohon konfirmasi ketersediaan dan instruksi selanjutnya. Terima kasih.
        `;

        // Encode pesan untuk URL
        const encodedMessage = encodeURIComponent(message.trim());

        // Buat URL WhatsApp
        const whatsappURL = `https://api.whatsapp.com/send?phone=${whatsAppNumber}&text=${encodedMessage}`;

        // Buka WhatsApp di tab baru
        window.open(whatsappURL, '_blank');
    });
});
</script>
</html>