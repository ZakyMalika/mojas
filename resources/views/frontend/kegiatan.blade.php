<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Armada Driver</title>
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

</body>
</html>