<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <title>Document</title>

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

        /* Styling dasar untuk navigasi agar terlihat rapi */
        .nav-menu {
            list-style: none;
            display: flex;
            gap: 2rem;
            /* Memberi jarak antar menu */
            align-items: center;
        }

        /* Wajib: Mengatur posisi parent dropdown */
        .dropdown {
            position: relative;
            padding-bottom: 1px;

        }

        /* Styling untuk submenu yang tersembunyi */
        .dropdown-menu {
            display: none;
            /* 1. Sembunyikan menu secara default */
            position: absolute;
            /* 2. Atur posisi agar "melayang" di bawah parent */
            top: 100%;
            /* Posisikan persis di bawah menu "Kategori" */
            left: 0;
            background-color: white;
            list-style: none;
            padding: 10px 0;
            /* margin-top: 10px;  */
            min-width: 180px;
            /* Lebar minimum dropdown */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            z-index: 100;
            /* Pastikan menu muncul di atas konten lain */
        }

        /* Tampilkan submenu ketika parent di-hover */
        /* 3. Tampilkan menu saat di-hover */
        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown.show .dropdown-toggle {
            background-color: #f1f1f1;
            border-radius: 5px;
        }

        /* Styling untuk link di dalam dropdown */
        .dropdown-menu li a {
            color: #333;
            padding: 12px 20px;
            display: block;
            /* Membuat link memenuhi lebar li */
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        /* Efek hover untuk link di dalam dropdown */
        .dropdown-menu li a:hover {
            background-color: #f5f5f5;
            color: #2c5530;
            /* Warna hijau khas Anda */
        }

        /* Styling untuk ikon panah */
        .dropdown-toggle .fa-chevron-down {
            font-size: 0.8em;
            margin-left: 5px;
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
            transition: transform 0.1s linear;
        }

        .hero-icon {
            font-size: 4rem;
            color: #ff8c42;
            margin-bottom: 1rem;
            display: block;
            text-align: center;
        }

        /* === SECTIONS (GENERAL) === */
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

        /* === FEATURES SECTION === */
        .features {
            padding: 6rem 0;
            background: #ffffff;
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

        /* === VISI MISI SECTION === */
        .visimisi {
            padding: 6rem 0;
            background: #f8f9fa;
        }

        .visimisi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start;
        }

        .visimisi-card {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
        }

        .visimisi-card h3 {
            font-size: 1.8rem;
            color: #2c5530;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .visimisi-card h3 .fa {
            color: #ff8c42;
        }

        .visimisi-card p,
        .visimisi-card li {
            color: #555;
            font-size: 1.05rem;
        }

        .visimisi-card ul {
            list-style: none;
            padding-left: 0;
        }

        .visimisi-card ul li {
            margin-bottom: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .visimisi-card ul li .fa-check-circle {
            color: #28a745;
            margin-top: 5px;
        }

        /* === KERJASAMA SECTION (NEW) === */
        .kerjasama {
            padding: 6rem 0;
            background: #ffffff;
        }

        .kerjasama-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .kerjasama-card {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-top: 4px solid #ff8c42;
            /* Different color for emphasis */
        }

        .kerjasama-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .kerjasama-icon {
            font-size: 3rem;
            color: #2c5530;
            margin-bottom: 1rem;
        }

        .kerjasama-card h3 {
            font-size: 1.3rem;
            color: #2c5530;
            margin-bottom: 1rem;
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

        /* === FAQ SECTION === */
        .faq {
            padding: 6rem 0;
            background: #ffffff;
            /* Changed background for alternating colors */
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .faq-item {
            background: white;
            border-radius: 10px;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .faq-question {
            width: 100%;
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            background: none;
            border: none;
            text-align: left;
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
        }

        .faq-question .icon {
            transition: transform 0.3s ease;
        }

        .faq-answer {
            padding: 0 1.5rem 1.5rem 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease, padding 0.4s ease;
        }

        .faq-answer p {
            color: #555;
            margin: 0;
        }

        .faq-item.active .faq-question .icon {
            transform: rotate(45deg);
        }

        /* === CONTACT SECTION & MAP === */
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

        #locationMap {
            height: 450px;
            width: 100%;
            border-radius: 15px;
            border: 3px solid white;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            z-index: 1;
        }

        /* === FOOTER === */
        .footer {
            background: #1a1a1a;
            color: white;
            text-align: center;
            padding: 2rem 0;
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

        .map-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
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

        /* === RESPONSIVE STYLES === */
        @media (max-width: 992px) {

            .hero-container,
            .contact-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-content {
                order: 2;
            }

            .hero-visual {
                order: 1;
                margin-bottom: 2rem;
            }

            .cta-buttons {
                justify-content: center;
            }

            .visimisi-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .nav-menu {
                display: none;
                /* Simplification for this example */
            }

            .hero-content h1 {
                font-size: 2.5rem;
            }

            .map-section {
                grid-template-columns: 1fr;
            }

            .modal-content {
                padding: 20px;
            }

            .modal-header h2 {
                font-size: 1.5rem;
            }

            .contact-content {
                gap: 2rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img src="{{ asset('images/logomojas.jpg') }}" alt="Logo MOJAS Batam"
                        style="height: 50px; width: auto;">
                    <span>MOJAS BATAM</span>
                </div>
            </a>
            <ul class="nav-menu">
                <li><a href="/">Beranda</a></li>
                <li><a href="#tarif">Tarif</a></li>
                <li><a href="#kerjasama">Kerjasama</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        Kategori <i class="fas fa-chevron-down"></i> </a>

                    <ul class="dropdown-menu">
                        <li><a href="/kegiatan">Kegiatan</a></li>
                        <li><a href="/rental">Rental</a></li>
                        <li><a href="/armada">Armada</a></li>
                        <li><a href="/sekolah">Sekolah</a></li>
                    </ul>
                </li>
                <li><a href="/login" class="admin-btn"><i class="fas fa-user-shield"></i> Login</a></li>
            </ul>
        </div>
    </nav>
</body>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {

        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });

        const navbar = document.querySelector('.navbar');
        if (navbar) {
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

        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');
            question.addEventListener('click', () => {
                const isActive = item.classList.contains('active');
                faqItems.forEach(i => {
                    i.classList.remove('active');
                    i.querySelector('.faq-answer').style.maxHeight = 0;
                });
                if (!isActive) {
                    item.classList.add('active');
                    answer.style.maxHeight = answer.scrollHeight + 'px';
                }
            });
        });

        const officeCoords = [1.1160, 104.0385];
        const locationMap = L.map('locationMap').setView(officeCoords, 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(locationMap);
        L.marker(officeCoords).addTo(locationMap).bindPopup(
                '<b>PT. MOJAS BATAM</b><br>Perumahan Anggrek Sari Blok F8 no.11, Batam ')
            .openPopup();

        const modal = document.getElementById("orderModal");
        const closeBtn = modal.querySelector(".close");
        const pesanBtns = document.querySelectorAll(".pesan-btn");

        let modalMapsInitialized = false;
        let mapAsal, mapTujuan;

        function initializeModalMaps() {
            if (modalMapsInitialized) return;

            mapAsal = L.map("mapAsal").setView([1.0456, 104.0305], 12);
            mapTujuan = L.map("mapTujuan").setView([1.0456, 104.0305], 12);

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap"
            }).addTo(mapAsal);
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap"
            }).addTo(mapTujuan);

            mapAsal.on("click", e => {
                if (markerAsal) markerAsal.setLatLng(e.latlng);
                else markerAsal = L.marker(e.latlng).addTo(mapAsal);
                document.getElementById("alamatAsal").value =
                    `${e.latlng.lat.toFixed(5)}, ${e.latlng.lng.toFixed(5)}`;
                updateSimulasi();
            });

            mapTujuan.on("click", e => {
                if (markerTujuan) markerTujuan.setLatLng(e.latlng);
                else markerTujuan = L.marker(e.latlng).addTo(mapTujuan);
                document.getElementById("alamatTujuan").value =
                    `${e.latlng.lat.toFixed(5)}, ${e.latlng.lng.toFixed(5)}`;
                updateSimulasi();
            });

            modalMapsInitialized = true;
        }

        let markerAsal = null,
            markerTujuan = null;

        pesanBtns.forEach(btn => {
            btn.addEventListener("click", function() {
                modal.style.display = "flex";
                initializeModalMaps();
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
            const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 *
                Math.PI / 180) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
            return R * (2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a)));
        }

        function hitungTarif(jarak) {
            const hariEfektif = 20;
            let oneWay = 0;
            if (jarak <= 3) {
                oneWay = 400000;
            } else {
                oneWay = Math.round(jarak * hariEfektif * 7000);
            }
            return {
                oneWay,
                twoWay: oneWay * 2
            };
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

            const url = `https://wa.me/6281268712321?text=${encodeURIComponent(pesan)}`;
            window.open(url, "_blank");
        });
    });
</script>

</html>
