<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kegiatan Mojas</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logomojas.jpg') }}">

    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    
    <style>
/* == STYLING UNTUK SECTION KEGIATAN == */
        .kegiatan-section {
            padding: 6rem 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: #2c5530;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .section-title p {
            font-size: 1.1rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto;
        }

        /* == STRUKTUR GRID UNTUK KARTU KEGIATAN == */
        .kegiatan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
        }

        /* Responsive styles for grid */
        @media screen and (max-width: 768px) {
            .kegiatan-grid {
                grid-template-columns: 1fr;
                padding: 0 1rem;
            }
            .section-title h2 {
                font-size: 2rem;
            }
            .section-title p {
                font-size: 1rem;
                padding: 0 1rem;
            }
            .kegiatan-section {
                padding: 4rem 0;
            }
        }

        @media screen and (min-width: 769px) and (max-width: 1024px) {
            .kegiatan-grid {
                grid-template-columns: repeat(2, 1fr);
                padding: 0 1.5rem;
            }
        }

        /* == STYLING KARTU KEGIATAN == */
        .activity-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden; /* Penting untuk menjaga gambar tetap di dalam border-radius */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .activity-card .card-image-container {
            overflow: hidden; /* Kontainer untuk efek zoom pada gambar */
        }
        
        .activity-card img {
            width: 100%;
            height: 220px;
            object-fit: cover; /* Memastikan gambar terisi penuh tanpa distorsi */
            transition: transform 0.4s ease;
        }

        .activity-card .card-content {
            padding: 1.5rem;
        }

        .activity-card .card-category {
            display: inline-block;
            background-color: rgba(255, 140, 66, 0.1); /* Warna oranye transparan */
            color: #ff8c42; /* Warna oranye */
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .activity-card h3 {
            font-size: 1.4rem;
            color: #2c5530;
            margin-top: 0;
            margin-bottom: 0.75rem;
        }

        .activity-card .card-description {
            color: #555;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .activity-card .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: #888;
            font-size: 0.9rem;
        }
        
        .activity-card .card-footer .read-more-link {
            color: #2c5530;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s ease;
        }
        
        .activity-card .card-footer .read-more-link:hover {
            color: #ff8c42;
        }

        /* == EFEK INTERAKTIF (HOVER) == */
        .activity-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }
        
        .activity-card:hover img {
            transform: scale(1.05); /* Efek zoom pada gambar saat di-hover */
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
            z-index: 1001;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            transition: all 0.3s ease-in-out;
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

        /* Hamburger Menu */
        .hamburger {
            display: none;
            cursor: pointer;
            z-index: 1001;
        }

        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            margin: 5px 0;
            background: #2c5530;
            transition: all 0.3s ease-in-out;
        }

        /* Responsive Styles */
        @media screen and (max-width: 768px) {
            .hamburger {
                display: block;
            }

            .nav-menu {
                position: fixed;
                left: -100%;
                top: 0;
                flex-direction: column;
                background: rgba(255, 255, 255, 0.98);
                width: 100%;
                height: 100vh;
                padding-top: 80px;
                text-align: center;
                transition: 0.3s;
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
                z-index: 1000;
            }

            .nav-menu.active {
                left: 0;
            }

            .nav-menu li {
                margin: 1.5rem 0;
            }

            .hamburger.active span:nth-child(1) {
                transform: translateY(8px) rotate(45deg);
            }

            .hamburger.active span:nth-child(2) {
                opacity: 0;
            }

            .hamburger.active span:nth-child(3) {
                transform: translateY(-8px) rotate(-45deg);
            }
        }

        /* Tablet Styles */
        @media screen and (min-width: 769px) and (max-width: 1024px) {
            .nav-container {
                padding: 0 1.5rem;
            }

            .nav-menu {
                gap: 1.5rem;
            }
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
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            position: relative;
            overflow: hidden;
        }

        .btn-primary i.fa-arrow-right {
            transition: transform 0.3s ease;
            font-size: 0.9rem;
        }

        .btn-primary:hover i.fa-arrow-right {
            transform: translateX(3px);
        }

        .btn-primary::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transform: translate(-50%, -50%) scale(0);
            border-radius: 50px;
            transition: transform 0.4s ease;
        }

        .btn-primary:hover::after {
            transform: translate(-50%, -50%) scale(1.5);
            opacity: 0;
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

        /* === PRICING SECTION === */
        .pricing {
            padding: 6rem 0;
            background: #f8f9fa;
            /* Changed background for alternating colors */
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

        /* === MODAL === */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
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
            overflow-y: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c5530;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #2c5530;
            box-shadow: 0 0 0 2px rgba(44, 85, 48, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
            font-family: inherit;
        }

        /* Styling untuk modal pendaftaran */
        .daftar-modal .modal-content {
            max-width: 600px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }

        .registration-form {
            padding: 30px;
        }

        .registration-form .modal-header {
            border-bottom: 2px solid #2c5530;
            margin-bottom: 25px;
        }

        .registration-form .modal-header h2 {
            color: #2c5530;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .registration-form .form-group {
            margin-bottom: 25px;
        }

        .registration-form label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #2c5530;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .registration-form label i {
            color: #ff8c42;
        }

        .registration-form input,
        .registration-form textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .registration-form input:focus,
        .registration-form textarea:focus {
            border-color: #2c5530;
            box-shadow: 0 0 0 3px rgba(44, 85, 48, 0.1);
            outline: none;
        }

        .textarea-counter {
            text-align: right;
            color: #6c757d;
            font-size: 0.85rem;
            margin-top: 5px;
        }

        .submit-btn {
            background: #25D366 !important;
            color: white !important;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 1.1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .submit-btn:hover {
            background: #128C7E !important;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(37, 211, 102, 0.2);
        }

        /* Animasi untuk modal */
        .daftar-modal {
            animation: modalFade 0.3s ease;
        }

        @keyframes modalFade {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
    </style>
</head>
<body>
    {{-- nav --}}
    <x-dashboard.navbar />

{{-- main content --}}
<main>
    <section id="kegiatan" class="kegiatan-section">
        <div class="container">
            <div class="section-title">
                <h2>Galeri Kegiatan MOJAS</h2>
                <p>Kami tidak hanya menyediakan transportasi, tapi juga menjadi bagian dari perjalanan pendidikan anak Anda. Lihat momen-momen kami di lapangan.</p>
            </div>

            <div class="kegiatan-grid">

                <div class="activity-card">
                    <div class="card-image-container">
                        <img src="{{ asset('images/mojas1.jpg') }}" alt="Antar Jemput Siswa Harian">
                    </div>
                    <div class="card-content">
                        <span class="card-category">Rutin</span>
                        <h3>Antar Jemput Harian</h3>
                        <p class="card-description">Layanan utama kami memastikan siswa tiba di sekolah dengan aman dan tepat waktu setiap hari, memberikan ketenangan bagi orang tua.</p>
                        <div class="card-footer">
                            <span><i class="fas fa-clock"></i> Setiap Hari Sekolah</span>
                           
                        </div>
                    </div>
                </div>

                <div class="activity-card">
                    <div class="card-image-container">
                        <img src="{{ asset('images/mojas2.jpg') }}" alt="Kegiatan Field Trip Sekolah">
                    </div>
                    <div class="card-content">
                        <span class="card-category">Acara Khusus</span>
                        <h3>Dukungan Field Trip Sekolah</h3>
                        <p class="card-description">Kami siap menjadi mitra transportasi untuk berbagai kegiatan di luar sekolah seperti kunjungan edukasi, study tour, dan acara lainnya.</p>
                        <div class="card-footer">
                            <span><i class="fas fa-bus"></i> Sesuai Permintaan</span>
                           
                        </div>
                    </div>
                </div>

                <div class="activity-card">
                    <div class="card-image-container">
                        <img src="{{ asset('images/mojas3.jpg') }}" alt="Layanan Antar Jemput Ekstrakurikuler">
                    </div>
                    <div class="card-content">
                        <span class="card-category">Fleksibel</span>
                        <h3>Layanan Ekstrakurikuler</h3>
                        <p class="card-description">Jadwal yang fleksibel memungkinkan kami untuk menyediakan layanan antar jemput bagi siswa yang mengikuti kegiatan ekstrakurikuler sore hari.</p>
                        <div class="card-footer">
                            <span><i class="fas fa-calendar-alt"></i> Jadwal Fleksibel</span>
                            
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</main>

    <x-dashboard.tarif />

    <x-dashboard.kerjasama />
    <hr style="margin: 0; border: none; height: 3px; background: #eee; margin-left: 100px; margin-right: 100px;">


    <x-dashboard.faq />

    <x-dashboard.kontak />

    <x-dashboard.footer />

    <!-- AOS Animation Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        // Initialize AOS
        document.addEventListener("DOMContentLoaded", function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        });
    </script>

</body>
</html>