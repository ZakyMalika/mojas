<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOJAS BATAM - Layanan Antar Jemput Siswa Terpercaya</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        /* Navbar */
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

        /* Hero Section */
        .hero {
            height: 100vh;
            background: linear-gradient(135deg, #2c5530 0%, #4a7c59 50%, #ff8c42 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="70" r="2.5" fill="rgba(255,255,255,0.1)"/></svg>');
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }

            100% {
                transform: translateY(0px) rotate(360deg);
            }
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            z-index: 2;
            position: relative;
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: bold;
            color: white;
            margin-bottom: 1.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero-content p {
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
            line-height: 1.8;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
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

        .hero-visual {
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        .hero-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: bounce 3s infinite ease-in-out;
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .hero-icon {
            font-size: 4rem;
            color: #ff8c42;
            margin-bottom: 1rem;
            display: block;
            text-align: center;
        }

        /* Features Section */
        .features {
            padding: 6rem 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

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
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-top: 4px solid #2c5530;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
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

        /* Pricing Section */
        /* Section wrapper */
        .pricing {
            padding: 60px 20px;
            background: #fafafa;
            text-align: center;
        }

        .section-title h2 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .section-title p {
            color: #666;
            margin-bottom: 30px;
        }

        /* Card */
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
        }

        .pricing-title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 1.2rem;
            text-align: center;
        }

        /* Table */
        .pricing-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        .pricing-table th,
        .pricing-table td {
            border: 1px solid #e74c3c;
            padding: 0.8rem;
            text-align: center;
        }

        .pricing-table th {
            background: #fff176;
            font-weight: 600;
            font-size: 15px;
        }

        .pricing-table td {
            font-size: 14px;
        }

        /* Button */
        .btn-container {
            display: flex;
            justify-content: center;
        }

        .btn-primary {
            background: #e74c3c;
            color: #fff;
            padding: 0.7rem 1.5rem;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s ease;
            font-size: 15px;
        }

        .btn-primary:hover {
            background: #c0392b;
        }

        /* Contact Section */
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

        /* Footer */
        .footer {
            background: #1a1a1a;
            color: white;
            text-align: center;
            padding: 2rem 0;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .nav-menu {
                display: none;
            }

            .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2rem;
            }

            .hero-content h1 {
                font-size: 2.5rem;
            }

            .contact-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .cta-buttons {
                justify-content: center;
            }
        }

        /* Tablet (max-width: 992px) */
        @media (max-width: 992px) {
            .nav-container {
                padding: 0 1rem;
            }

            .hero-container {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }

            .features-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }

            .contact-content {
                grid-template-columns: 1fr;
            }

            .pricing-card {
                padding: 1.5rem;
            }
        }

        /* Mobile (max-width: 576px) */
        @media (max-width: 576px) {
            .logo {
                font-size: 1.4rem;
            }

            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-content p {
                font-size: 1rem;
            }

            .cta-buttons {
                flex-direction: column;
                gap: 0.8rem;
            }

            .hero-card {
                padding: 1.2rem;
            }

            /* Pricing table responsive */
            .pricing-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .pricing-table table {
                min-width: 500px;
            }

            .feature-card {
                padding: 1.5rem;
            }

            .contact-info h2 {
                font-size: 1.8rem;
            }

            .whatsapp-btn {
                padding: 0.8rem 1.2rem;
                font-size: 14px;
            }
        }


        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #2c5530;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4a7c59;
        }

        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            max-width: 450px;
            width: 90%;
            text-align: center;
            position: relative;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-content input {
            width: 100%;
            padding: 0.7rem;
            margin: 0.5rem 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 1.5rem;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <i class="fas fa-bus"></i> MOJAS BATAM
            </a>
            <ul class="nav-menu">
                <li><a href="#home">Beranda</a></li>
                <li><a href="#layanan">Layanan</a></li>
                <li><a href="#tarif">Tarif</a></li>
                <li><a href="#tentang">Tentang</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <li><a href="#" class="admin-btn"><i class="fas fa-user-shield"></i> Admin</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-container">
            <div class="hero-content" data-aos="fade-right">
                <h1>Layanan Antar Jemput Siswa Terpercaya</h1>
                <p>Memberikan solusi transportasi yang aman, nyaman, dan tepat waktu untuk putra-putri Anda. Dengan
                    armada MPV modern dan driver berpengalaman, kami siap melayani kebutuhan transportasi sekolah di
                    Area Batam.</p>
                <div class="cta-buttons">
                    <a href="#layanan" class="btn-primary">
                        <i class="fas fa-car"></i> Lihat Layanan
                    </a>
                    <a href="#kontak" class="btn-secondary">
                        <i class="fas fa-phone"></i> Hubungi Kami
                    </a>
                </div>
            </div>
            <div class="hero-visual" data-aos="fade-left">
                <div class="hero-card">
                    <i class="fas fa-school hero-icon"></i>
                    <h3 style="color: white; margin-bottom: 1rem;">20 Unit Armada MPV</h3>
                    <p style="color: rgba(255,255,255,0.8);">Kapasitas maksimal 6 siswa per mobil dengan fasilitas AC
                        dan tracking perjalanan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="layanan" class="features">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Mengapa Memilih MOJAS BATAM?</h2>
                <p>Kami berkomitmen memberikan layanan terbaik dengan prinsip "Kepercayaan, Keamanan, Kenyamanan dan
                    Ketepatan Waktu"</p>
            </div>
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <i class="fas fa-shield-alt feature-icon"></i>
                    <h3>Kepercayaan</h3>
                    <p>Siswa-siswi selalu diantar-jemput antara rumah-sekolah sehingga orangtua dapat mempercayakan
                        putra-putrinya pada kami.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <i class="fas fa-lock feature-icon"></i>
                    <h3>Keamanan</h3>
                    <p>Driver amanah, berpengalaman, menaati tata tertib lalu lintas, dan memantau keselamatan anak
                        selama di perjalanan.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <i class="fas fa-heart feature-icon"></i>
                    <h3>Kenyamanan</h3>
                    <p>Driver sopan santun, tidak merokok, mobil ber-AC, tempat duduk nyaman, dan kapasitas maksimal 6
                        siswa per mobil.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <i class="fas fa-clock feature-icon"></i>
                    <h3>Ketepatan Waktu</h3>
                    <p>Kedisiplinan driver dan pengaturan waktu serta rute yang terencana baik untuk menjamin ketepatan
                        waktu.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                    <i class="fas fa-map-marker-alt feature-icon"></i>
                    <h3>Door to Door</h3>
                    <p>Layanan antar jemput langsung dari rumah ke sekolah dan sebaliknya dengan sistem tracking
                        perjalanan.</p>
                </div>
                {{-- <div class="feature-card" data-aos="fade-up" data-aos-delay="600">
                    <i class="fas fa-handshake feature-icon"></i>
                    <h3>Sharing Profit</h3>
                    <p>Memberikan nilai tambah Rp 50.000,- per siswa kepada sekolah sebagai bentuk kerjasama yang
                        menguntungkan.</p>
                </div> --}}
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section id="tarif" class="pricing">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Simulasi Pembayaran Per Siswa</h2>
                <p>Tarif kompetitif dengan layanan berkualitas tinggi</p>
            </div>

            <div class="pricing-wrapper" data-aos="zoom-in" data-aos-delay="100">
                <div class="pricing-card">
                    <h3 class="pricing-title">Daftar Tarif</h3>

                    <table class="pricing-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jarak (km)</th>
                                <th>One Way</th>
                                <th>Two Way</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>± 1-3</td>
                                <td>Rp 400.000</td>
                                <td>Rp 800.000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>± 4</td>
                                <td>Rp 560.000</td>
                                <td>Rp 1.120.000</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>± 5</td>
                                <td>Rp 700.000</td>
                                <td>Rp 1.400.000</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>± 6</td>
                                <td>Rp 840.000</td>
                                <td>Rp 1.680.000</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>± 7</td>
                                <td>Rp 980.000</td>
                                <td>Rp 1.960.000</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>± 8</td>
                                <td>Rp 1.120.000</td>
                                <td>Rp 2.240.000</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="btn-container">
                        <button class="btn-primary pesan-btn">Pesan Sekarang</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Pemesanan -->
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h3>Form Pemesanan</h3>
            <input type="text" id="nama" placeholder="Nama Anda" required>
            <input type="text" id="alamat" placeholder="Alamat" required>
            <input type="text" id="sekolah" placeholder="Nama Sekolah" required>

            <label style="margin-top:10px; font-weight:bold;">Alamat Asal</label>
            <input type="text" id="alamatAsal" placeholder="Klik di peta asal" readonly>
            <div id="mapAsal" style="height:200px; margin-bottom:10px; border-radius:8px;"></div>

            <label style="margin-top:10px; font-weight:bold;">Alamat Tujuan</label>
            <input type="text" id="alamatTujuan" placeholder="Klik di peta tujuan" readonly>
            <div id="mapTujuan" style="height:200px; margin-bottom:10px; border-radius:8px;"></div>

            <label style="margin-top:10px; font-weight:bold;">Simulasi Pembayaran</label>
            <div id="simulasi" style="background:#f7f7f7; padding:10px; border-radius:8px; margin-top:5px;">
                <p>Silakan pilih lokasi asal & tujuan di peta</p>
            </div>

            <button id="kirimWA" class="btn-primary" style="margin-top:1rem;">Kirim ke WhatsApp</button>
        </div>
    </div>


    <!-- Contact Section -->
    <section id="kontak" class="contact">
        <div class="container">
            <div class="contact-content">
                <div class="contact-info" data-aos="fade-right">
                    <h2>Hubungi Kami</h2>
                    <div class="contact-item">
                        <i class="fas fa-user contact-icon"></i>
                        <div>
                            <h4>Penanggung Jawab</h4>
                            <p>Eri Febrian</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt contact-icon"></i>
                        <div>
                            <h4>Alamat</h4>
                            <p>Perumahan Anggrek Sari Blok F8 no.11, Batam</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone contact-icon"></i>
                        <div>
                            <h4>WhatsApp</h4>
                            <p>0812-6871-2321</p>
                        </div>
                    </div>
                    <a href="https://wa.me/6281268712321" class="whatsapp-btn" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                        Chat WhatsApp
                    </a>
                </div>
                <div class="hero-visual" data-aos="fade-left">
                    <div class="hero-card">
                        <i class="fas fa-users hero-icon"></i>
                        <h3 style="color: white; margin-bottom: 1rem;">Siap Melayani</h3>
                        <p style="color: rgba(255,255,255,0.8); margin-bottom: 2rem;">Tim profesional kami siap
                            memberikan konsultasi dan pelayanan terbaik untuk kebutuhan transportasi sekolah Anda.</p>
                        <div style="display: flex; justify-content: space-around; text-align: center;">
                            <div>
                                <div style="font-size: 2rem; color: #ff8c42; font-weight: bold;">20</div>
                                <div style="font-size: 0.9rem; opacity: 0.8;">Unit Armada</div>
                            </div>
                            <div>
                                <div style="font-size: 2rem; color: #ff8c42; font-weight: bold;">6</div>
                                <div style="font-size: 0.9rem; opacity: 0.8;">Max Siswa/Mobil</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <x-admin.footer />

    <!-- Leaflet CSS & JS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 100) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 2px 30px rgba(0,0,0,0.15)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.1)';
            }
        });

        // Smooth scroll for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add loading animation
        window.addEventListener('load', function() {
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease-in-out';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });

        // Add hover effects to pricing cards
        document.querySelectorAll('.pricing-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.05) rotate(1deg)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1) rotate(0deg)';
            });
        });

        // Add floating animation to hero visual
        const heroCard = document.querySelector('.hero-card');
        let floatDirection = 1;

        setInterval(() => {
            const currentTransform = heroCard.style.transform;
            const currentY = currentTransform.includes('translateY') ?
                parseFloat(currentTransform.match(/translateY\(([^)]+)\)/)[1]) : 0;

            const newY = currentY + (floatDirection * 2);

            if (Math.abs(newY) > 20) {
                floatDirection *= -1;
            }

            heroCard.style.transform = `translateY(${newY}px)`;
        }, 100);


        // darisini
        const modal = document.getElementById("orderModal");
        const closeBtn = document.querySelector(".close");

        // Open modal
        document.querySelectorAll(".pesan-btn").forEach(btn => {
            btn.addEventListener("click", function() {
                modal.style.display = "flex";
                setTimeout(() => {
                    mapAsal.invalidateSize();
                    mapTujuan.invalidateSize();
                }, 300);
            });
        });

        // Close modal
        closeBtn.addEventListener("click", () => modal.style.display = "none");
        window.addEventListener("click", e => {
            if (e.target == modal) modal.style.display = "none";
        });

        // Leaflet Maps (pusat Batam)
        const mapAsal = L.map("mapAsal").setView([1.0456, 104.0305], 12);
        const mapTujuan = L.map("mapTujuan").setView([1.0456, 104.0305], 12);
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "© OpenStreetMap"
        }).addTo(mapAsal);
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "© OpenStreetMap"
        }).addTo(mapTujuan);

        let markerAsal = null,
            markerTujuan = null;

        // Fungsi hitung jarak (haversine)
        function hitungJarak(lat1, lon1, lat2, lon2) {
            const R = 6371;
            const dLat = (lat2 - lat1) * Math.PI / 180;
            const dLon = (lon2 - lon1) * Math.PI / 180;
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                Math.sin(dLon / 2) * Math.sin(dLon / 2);
            return R * (2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)));
        }

        // Hitung tarif
        function hitungTarif(jarak) {
            const hariEfektif = 80;
            let oneWay = 0;
            if (jarak <= 3) oneWay = 400000;
            else if (jarak < 10) oneWay = Math.round(jarak * hariEfektif * 7000);
            else oneWay = Math.round(jarak * hariEfektif * 6000);
            return {
                oneWay,
                twoWay: oneWay * 2
            };
        }

        // Update simulasi
        function updateSimulasi() {
            if (!markerAsal || !markerTujuan) return;
            const a = markerAsal.getLatLng();
            const t = markerTujuan.getLatLng();
            const jarak = hitungJarak(a.lat, a.lng, t.lat, t.lng);
            const tarif = hitungTarif(jarak);
            document.getElementById("simulasi").innerHTML = `
    <p><b>Jarak:</b> ${jarak.toFixed(2)} km</p>
    <p><b>One Way:</b> Rp ${tarif.oneWay.toLocaleString("id-ID")}</p>
    <p><b>Two Way:</b> Rp ${tarif.twoWay.toLocaleString("id-ID")}</p>
  `;
        }

        // Event pilih asal & tujuan
        mapAsal.on("click", e => {
            if (markerAsal) markerAsal.setLatLng(e.latlng);
            else markerAsal = L.marker(e.latlng).addTo(mapAsal);
            document.getElementById("alamatAsal").value = `${e.latlng.lat.toFixed(5)}, ${e.latlng.lng.toFixed(5)}`;
            updateSimulasi();
        });

        mapTujuan.on("click", e => {
            if (markerTujuan) markerTujuan.setLatLng(e.latlng);
            else markerTujuan = L.marker(e.latlng).addTo(mapTujuan);
            document.getElementById("alamatTujuan").value =
                `${e.latlng.lat.toFixed(5)}, ${e.latlng.lng.toFixed(5)}`;
            updateSimulasi();
        });

        // Kirim ke WA
        document.getElementById("kirimWA").addEventListener("click", () => {
            const nama = document.getElementById("nama").value;
            const alamat = document.getElementById("alamat").value;
            const sekolah = document.getElementById("sekolah").value;
            const asal = document.getElementById("alamatAsal").value;
            const tujuan = document.getElementById("alamatTujuan").value;
            const simulasi = document.getElementById("simulasi").innerText;

            if (!nama || !alamat || !sekolah || !asal || !tujuan) {
                alert("Harap isi semua data!");
                return;
            }

            const pesan =
                `Halo, saya ingin memesan layanan.\n\nNama: ${nama}\nAlamat: ${alamat}\nSekolah: ${sekolah}\n\nAsal: ${asal}\nTujuan: ${tujuan}\n\n${simulasi}`;
            const url = `https://wa.me/6281268712321?text=${encodeURIComponent(pesan)}`;
            window.open(url, "_blank");
        });
    </script>
</body>

</html>
