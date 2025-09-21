<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOJAS BATAM - Layanan Antar Jemput Siswa Terpercaya</title>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        /* === GENERAL & SETUP === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

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
        
        /* FIX: Consolidated .btn-primary style to use the orange theme consistently */
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

        .whatsapp-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #25D366;
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            margin-top: 2rem;
            transition: all 0.3s ease;
        }

        .whatsapp-btn:hover {
            background: #22c55e;
            transform: translateY(-2px);
        }
        
        /* === HERO SECTION === */
        .hero {
            height: 100vh;
            background: linear-gradient(135deg, #2c5530 0%, #4a7c59 50%, #ff8c42 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-container {
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            z-index: 2;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            color: white;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-content p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .hero-visual {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hero-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.1s linear; /* For JS animation */
        }
        
        .hero-icon {
            font-size: 4rem;
            color: #ff8c42;
            margin-bottom: 1rem;
            display: block;
            text-align: center;
        }

        /* === SECTIONS (FEATURES, PRICING, CONTACT) === */
        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: #2c5530;
            margin-bottom: 1rem;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        .features {
            padding: 6rem 0;
            background: #f8f9fa;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-top: 4px solid #2c5530;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .feature-icon {
            font-size: 3rem;
            color: #ff8c42;
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            font-size: 1.3rem;
            color: #2c5530;
            margin-bottom: 1rem;
        }
        
        .pricing {
            padding: 6rem 0;
            background: #fafafa;
        }

        .pricing-wrapper {
            display: flex;
            justify-content: center;
        }

        .pricing-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 2rem;
            max-width: 700px;
            width: 100%;
            transition: transform 0.3s ease-in-out;
        }
        
        .pricing-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.2rem;
            text-align: center;
            color: #2c5530;
        }

        .pricing-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        .pricing-table th,
        .pricing-table td {
            border: 1px solid #ddd;
            padding: 0.8rem;
            text-align: center;
        }

        .pricing-table th {
            background: #f8f9fa;
            font-weight: 600;
        }
        
        .pricing-card .pricing-subtitle {
            font-size: 1rem;
            color: #6c757d;
            margin-top: -10px;
            margin-bottom: 25px;
            text-align: center;
        }

        .pricing-card .features-list {
            list-style: none;
            padding: 0;
            margin: 0 auto 30px auto;
            text-align: left;
            max-width: 400px;
        }

        .pricing-card .features-list li {
            margin-bottom: 12px;
        }

        .pricing-card .table-heading {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: #343a40;
            text-align: center;
        }

        hr {
            border: 0;
            height: 1px;
            background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0));
            margin: 60px 0;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .service-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        .service-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 600;
            color: #2c5530;
        }

        .service-card p {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .service-price {
            font-weight: 700;
            color: #ff8c42;
            font-size: 1.1rem;
        }
        
        .contact {
            padding: 6rem 0;
            background: linear-gradient(135deg, #2c5530 0%, #4a7c59 100%);
            color: white;
        }

        .contact-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .contact-info h2 {
            font-size: 2.5rem;
            margin-bottom: 2rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .contact-icon {
            font-size: 1.5rem;
            color: #ff8c42;
            width: 50px;
            text-align: center;
        }

        /* === FOOTER === */
        .footer {
            background: #1a1a1a;
            color: white;
            text-align: center;
            padding: 2rem 0;
        }
        
        /* === MODAL (FIXED) === */
.modal {
    display: none; /* Disembunyikan secara default */
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; /* Memungkinkan scroll jika konten panjang */
    background-color: rgba(0, 0, 0, 0.6);
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.modal-content {
    background-color: #fff;
    padding: 25px 30px;
    border-radius: 15px;
    width: 100%;
    max-width: 900px;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
    position: relative;
    max-height: 95vh;
    overflow-y: auto; /* Scroll di dalam modal jika perlu */
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: 1px solid #eee;
    padding-bottom: 15px;
}

.modal-header h2 {
    margin: 0;
    font-size: 1.8rem;
    color: #2c5530;
}

.close {
    color: #aaa;
    font-size: 35px;
    font-weight: bold;
    cursor: pointer;
    line-height: 1;
}
.close:hover,
.close:focus {
    color: #000;
}

/* Penataan Form */
.modal-body {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-section label {
    display: block;
    margin-bottom: 5px;
    font-weight: 600;
    color: #555;
}

.form-section input[type="text"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
}

/* Penataan Peta */
.map-section {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Dua kolom untuk peta */
    gap: 20px;
}

.map-container {
    flex: 1;
}
.map-container label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    text-align: center;
}

/* Penataan Simulasi */
.simulation-section {
    margin-top: 10px;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 8px;
    text-align: center;
}

.simulation-section h3 {
    margin-top: 0;
    margin-bottom: 15px;
    color: #2c5530;
}

#simulasi p {
    margin: 5px 0;
    font-size: 1.1rem;
}

#kirimWA {
    width: 100%;
    padding: 15px;
    margin-top: 15px;
    font-size: 1.1rem;
}

/* Responsif untuk layar kecil (HP) */
@media (max-width: 768px) {
    .map-section {
        grid-template-columns: 1fr; /* Peta akan bertumpuk ke bawah */
    }
    .modal-content {
        padding: 20px;
    }
    .modal-header h2 {
        font-size: 1.5rem;
    }
}

    </style>
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-bus"></i> MOJAS BATAM
            </a>
            <ul class="nav-menu">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#layanan">Layanan</a></li>
                <li><a href="#tarif">Tarif</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <li><a href="/login" class="admin-btn"><i class="fas fa-user-shield"></i> Login</a></li>
            </ul>
        </div>
    </nav>

    <section id="home" class="hero">
        <div class="hero-container">
            <div class="hero-content" data-aos="fade-right">
                <h1>Layanan Antar Jemput Siswa Terpercaya</h1>
                <p>Solusi transportasi yang aman, nyaman, dan tepat waktu untuk putra-putri Anda di Area Batam.</p>
                <div class="cta-buttons">
                    <a href="#layanan" class="btn-primary"><i class="fas fa-car"></i> Lihat Layanan</a>
                    <a href="#kontak" class="btn-secondary"><i class="fas fa-phone"></i> Hubungi Kami</a>
                </div>
            </div>
            <div class="hero-visual" data-aos="fade-left">
                <div class="hero-card">
                    <i class="fas fa-school hero-icon"></i>
                    <h3 style="color: white; margin-bottom: 1rem; text-align: center;">20 Unit Armada MPV</h3>
                    <p style="color: rgba(255,255,255,0.8); text-align: center;">Kapasitas maksimal 6 siswa per mobil dengan fasilitas AC dan tracking perjalanan.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="layanan" class="features">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Mengapa Memilih MOJAS BATAM?</h2>
                <p>Kami berkomitmen pada prinsip "Kepercayaan, Keamanan, Kenyamanan dan Ketepatan Waktu".</p>
            </div>
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100"><i class="fas fa-shield-alt feature-icon"></i><h3>Kepercayaan</h3><p>Siswa selalu diantar-jemput antara rumah-sekolah, memberikan ketenangan bagi orang tua.</p></div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200"><i class="fas fa-lock feature-icon"></i><h3>Keamanan</h3><p>Driver berpengalaman, menaati lalu lintas, dan memantau keselamatan siswa selama perjalanan.</p></div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300"><i class="fas fa-heart feature-icon"></i><h3>Kenyamanan</h3><p>Mobil ber-AC, bersih, dan tidak berdesakan dengan kapasitas maksimal 6 siswa per mobil.</p></div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400"><i class="fas fa-clock feature-icon"></i><h3>Ketepatan Waktu</h3><p>Disiplin driver dan rute terencana menjamin siswa tiba di tujuan tepat waktu.</p></div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="500"><i class="fas fa-map-marker-alt feature-icon"></i><h3>Door to Door</h3><p>Layanan antar jemput langsung dari rumah ke sekolah dan sebaliknya dengan sistem tracking.</p></div>
            </div>
        </div>
    </section>

    <section id="tarif" class="pricing">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Layanan & Tarif</h2>
                <p>Tarif kompetitif dengan layanan berkualitas tinggi</p>
            </div>
            <div class="pricing-wrapper" data-aos="zoom-in" data-aos-delay="100">
                <div class="pricing-card">
                    <h3 class="pricing-title">Paket Antar Jemput Sekolah</h3>
                    <p class="pricing-subtitle">Layanan bulanan yang aman, nyaman, dan tepat waktu.</p>
                    <ul class="features-list">
                        <li>✅ Armada bersih, nyaman, dan ber-AC</li>
                        <li>✅ Driver profesional dan berpengalaman</li>
                        <li>✅ Penjemputan dan pengantaran tepat waktu</li>
                        <li>✅ Keamanan dan keselamatan terjamin</li>
                        <li>✅ Tersedia pilihan One Way & Two Way</li>
                    </ul>
                    <h4 class="table-heading">Rincian Biaya Berdasarkan Jarak</h4>
                    <table class="pricing-table">
                        <thead><tr><th>No</th><th>Jarak (km)</th><th>One Way</th><th>Two Way</th></tr></thead>
                        <tbody>
                            <tr><td>1</td><td>± 1-3</td><td>Rp 400.000</td><td>Rp 800.000</td></tr>
                            <tr><td>2</td><td>± 4</td><td>Rp 560.000</td><td>Rp 1.120.000</td></tr>
                            <tr><td>3</td><td>± 5</td><td>Rp 700.000</td><td>Rp 1.400.000</td></tr>
                            <tr><td>4</td><td>± 6</td><td>Rp 840.000</td><td>Rp 1.680.000</td></tr>
                            <tr><td>5</td><td>± 7</td><td>Rp 980.000</td><td>Rp 1.960.000</td></tr>
                            <tr><td>6</td><td>± 8</td><td>Rp 1.120.000</td><td>Rp 2.240.000</td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="section-title" data-aos="fade-up" style="margin-top: 50px;">
                <h2>Layanan Lainnya</h2>
                <p>Fleksibel untuk setiap kebutuhan Anda</p>
            </div>
            <div class="services-grid" data-aos="fade-up" data-aos-delay="100">
               
                <div class="service-card">
                    <div class="service-icon">⚡</div><h3>Insidental</h3><p>Butuh antar jemput mendadak? Layanan ini siap membantu Anda saat dibutuhkan.</p><div class="service-price">Tarif Sesuai Jarak & Waktu</div>
                </div>
                <div class="service-card">
                    <div class="service-icon">🎉</div><h3>Acara Khusus</h3><p>Transportasi untuk acara sekolah seperti field trip, perlombaan, atau acara kelompok.</p><div class="service-price">Hubungi Kami Untuk Penawaran</div>
                </div>
            </div>
            <div style="text-align: center; margin-top: 40px;">
                <button class="btn-primary pesan-btn">Pesan & Simulasi Tarif</button>
            </div>
        </div>
    </section>

    <section id="kontak" class="contact">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info" data-aos="fade-right">
                    <h2>Hubungi Kami</h2>
                    <div class="contact-item"><i class="fas fa-user contact-icon"></i><div><h4>Penanggung Jawab</h4><p>Eri Febrian</p></div></div>
                    <div class="contact-item"><i class="fas fa-map-marker-alt contact-icon"></i><div><h4>Alamat</h4><p>Perumahan Anggrek Sari Blok F8 no.11, Batam</p></div></div>
                    <div class="contact-item"><i class="fas fa-phone contact-icon"></i><div><h4>WhatsApp</h4><p>0812-6871-2321</p></div></div>
                    <a href="https://wa.me/6282371562766" class="whatsapp-btn" target="_blank"><i class="fab fa-whatsapp"></i> Chat WhatsApp</a>
                </div>
                <div class="hero-visual" data-aos="fade-left">
                    <div class="hero-card"><i class="fas fa-users hero-icon"></i><h3 style="color: white; text-align: center; margin-bottom: 1rem;">Siap Melayani</h3><p style="color: rgba(255,255,255,0.8); margin-bottom: 2rem; text-align: center;">Tim kami siap memberikan konsultasi dan pelayanan terbaik untuk Anda.</p></div>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2025 CV. MOJAS BATAM. All Rights Reserved.</p>
    </footer>

   <div id="orderModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Formulir Pemesanan & Simulasi</h2>
            <span class="close">×</span>
        </div>

        <div class="modal-body">
            <div class="form-section">
                <label for="nama">Nama Siswa:</label>
                <input type="text" id="nama" placeholder="Masukkan nama lengkap siswa">
                
                <label for="alamat" style="margin-top: 15px;">Alamat Rumah:</label>
                <input type="text" id="alamat" placeholder="Masukkan alamat lengkap">

                <label for="sekolah" style="margin-top: 15px;">Nama Sekolah:</label>
                <input type="text" id="sekolah" placeholder="Masukkan nama sekolah">
            </div>

            <div class="map-section">
                <div class="map-container">
                    <label>Pilih Lokasi Jemput (Asal)</label>
                    <div id="mapAsal" style="height: 250px; width: 100%; border-radius: 8px; border: 1px solid #ddd;"></div>
                    <input type="text" id="alamatAsal" readonly placeholder="Koordinat asal" style="margin-top: 10px; text-align: center;">
                </div>
                <div class="map-container">
                    <label>Pilih Lokasi Antar (Tujuan)</label>
                    <div id="mapTujuan" style="height: 250px; width: 100%; border-radius: 8px; border: 1px solid #ddd;"></div>
                    <input type="text" id="alamatTujuan" readonly placeholder="Koordinat tujuan" style="margin-top: 10px; text-align: center;">
                </div>
            </div>

            <div class="simulation-section">
                <h3>Hasil Simulasi</h3>
                <div id="simulasi">
                    <p>Pilih lokasi di peta untuk melihat hasil.</p>
                </div>
                <button id="kirimWA" class="btn-primary">Kirim Pesanan via WhatsApp</button>
            </div>
        </div>
    </div>
</div>
    
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // FIX: Consolidated all JavaScript into one DOMContentLoaded listener
        document.addEventListener("DOMContentLoaded", function() {

            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });

            // Navbar scroll effect
            const navbar = document.querySelector('.navbar');
            if(navbar) {
                window.addEventListener('scroll', function() {
                    if (window.scrollY > 50) {
                        navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                        navbar.style.boxShadow = '0 2px 30px rgba(0,0,0,0.1)';
                    } else {
                        navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                        navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.1)';
                    }
                });
            }

            // Smooth scroll for navigation links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });

            // Floating animation for hero visual
            const heroCard = document.querySelector('.hero-card');
            if (heroCard) {
                let y = 0;
                let direction = 1;
                setInterval(() => {
                    y += direction * 0.1;
                    if (y > 10 || y < -10) {
                        direction *= -1;
                    }
                    heroCard.style.transform = `translateY(${y}px)`;
                }, 10);
            }

            // ===================================
            // MODAL AND MAP LOGIC
            // ===================================
            const modal = document.getElementById("orderModal");
            const closeBtn = modal.querySelector(".close");
            const pesanBtns = document.querySelectorAll(".pesan-btn");

            const mapAsal = L.map("mapAsal").setView([1.0456, 104.0305], 12);
            const mapTujuan = L.map("mapTujuan").setView([1.0456, 104.0305], 12);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap"
            }).addTo(mapAsal);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap"
            }).addTo(mapTujuan);

            let markerAsal = null, markerTujuan = null;

            pesanBtns.forEach(btn => {
                btn.addEventListener("click", function() {
                    modal.style.display = "flex";
                    setTimeout(() => {
                        mapAsal.invalidateSize();
                        mapTujuan.invalidateSize();
                    }, 10);
                });
            });
            
            closeBtn.addEventListener("click", () => modal.style.display = "none");
            window.addEventListener("click", e => {
                if (e.target == modal) modal.style.display = "none";
            });

            function hitungJarak(lat1, lon1, lat2, lon2) {
                const R = 6371;
                const dLat = (lat2 - lat1) * Math.PI / 180;
                const dLon = (lon2 - lon1) * Math.PI / 180;
                const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
                return R * (2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)));
            }

            // FIX: Corrected 'hariEfektif' and logic based on user confirmation
            function hitungTarif(jarak) {
                const hariEfektif = 20;
                let oneWay = 0;
                if (jarak <= 3) {
                    oneWay = 400000;
                } else if (jarak >= 10) {
                    oneWay = Math.round(jarak * hariEfektif * 6000);
                } else {
                    oneWay = Math.round(jarak * hariEfektif * 7000);
                }
                return { oneWay, twoWay: oneWay * 2 };
            }

            function updateSimulasi() {
                if (!markerAsal || !markerTujuan) return;
                const a = markerAsal.getLatLng();
                const t = markerTujuan.getLatLng();
                const jarak = hitungJarak(a.lat, a.lng, t.lat, t.lng);
                const tarif = hitungTarif(jarak);
                document.getElementById("simulasi").innerHTML = `
                    <p><b>Jarak:</b> ${jarak.toFixed(2)} km</p>
                    <p><b>One Way:</b> Rp ${tarif.oneWay.toLocaleString("id-ID")}</p>
                    <p><b>Two Way:</b> Rp ${tarif.twoWay.toLocaleString("id-ID")}</p>`;
            }

            mapAsal.on("click", e => {
                if (markerAsal) markerAsal.setLatLng(e.latlng);
                else markerAsal = L.marker(e.latlng).addTo(mapAsal);
                document.getElementById("alamatAsal").value = `${e.latlng.lat.toFixed(5)}, ${e.latlng.lng.toFixed(5)}`;
                updateSimulasi();
            });

            mapTujuan.on("click", e => {
                if (markerTujuan) markerTujuan.setLatLng(e.latlng);
                else markerTujuan = L.marker(e.latlng).addTo(mapTujuan);
                document.getElementById("alamatTujuan").value = `${e.latlng.lat.toFixed(5)}, ${e.latlng.lng.toFixed(5)}`;
                updateSimulasi();
            });
            
            // FIX: Using the correct WhatsApp function that sends Google Maps URLs
            document.getElementById("kirimWA").addEventListener("click", () => {
                const nama = document.getElementById("nama").value;
                const alamat = document.getElementById("alamat").value;
                const sekolah = document.getElementById("sekolah").value;
                const simulasi = document.getElementById("simulasi").innerText;

                if (!nama || !alamat || !sekolah) {
                    alert("Harap isi Nama, Alamat, dan Sekolah!");
                    return;
                }
                if (!markerAsal || !markerTujuan) {
                    alert("Harap pilih Lokasi Asal dan Tujuan di peta!");
                    return;
                }

                const coordsAsal = markerAsal.getLatLng();
                const coordsTujuan = markerTujuan.getLatLng();
                const urlAsal = `https://www.google.com/maps?q=${coordsAsal.lat},${coordsAsal.lng}`;
                const urlTujuan = `https://www.google.com/maps?q=${coordsTujuan.lat},${coordsTujuan.lng}`;

                const pesan = `Halo, saya ingin memesan layanan antar jemput.\n\n` +
                    `*Nama Siswa:* ${nama}\n` +
                    `*Alamat Rumah:* ${alamat}\n` +
                    `*Nama Sekolah:* ${sekolah}\n\n` +
                    `*Lokasi Jemput (Asal):*\n${urlAsal}\n\n` +
                    `*Lokasi Antar (Tujuan):*\n${urlTujuan}\n\n` +
                    `*Hasil Simulasi:*\n${simulasi}`;
                
                const url = `https://wa.me/6282371562766?text=${encodeURIComponent(pesan)}`;
                window.open(url, "_blank");
            });
        });
    </script>
</body>
</html>