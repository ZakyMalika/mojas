<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        /* armada */
        /* === Fleet Section (Armada Kami) === */
        .fleet-section {
            padding: 80px 0;
            background-color: #f9f9f9;
            /* Sedikit berbeda dari putih untuk kontras */
        }

        .fleet-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .car-card {
            background-color: #ffffff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.07);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .car-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
        }

        .car-image-container {
            position: relative;
            height: 220px;
        }

        .car-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .car-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #ff8c42, #ff6b1a);
            color: white;
            padding: 6px 12px;
            font-size: 0.8rem;
            font-weight: 600;
            border-radius: 20px;
            box-shadow: 0 2px 10px rgba(255, 107, 26, 0.5);
        }

        .car-details {
            padding: 25px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            /* Membuat konten ini mengisi sisa ruang */
        }

        .car-details h3 {
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .car-description {
            font-size: 0.95rem;
            color: #666;
            line-height: 1.6;
            flex-grow: 1;
            /* Mendorong tombol ke bawah */
        }

        .car-features {
            list-style: none;
            padding: 0;
            margin: 20px 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            color: #555;
        }

        .car-features li {
            display: flex;
            align-items: center;
        }

        .car-features li i {
            color: #2c5530;
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .car-details .btn-primary {
            width: 100%;
            text-align: center;
            padding: 12px 0;
            margin-top: auto;
            /* Selalu menempel di bagian bawah card */
        }

        /* === Responsive for Fleet Section === */
        @media (max-width: 768px) {
            .fleet-grid {
                grid-template-columns: 1fr;
            }
        }

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

        /* === FAQ SECTION (IMPROVED) === */
        .faq {
            padding: 6rem 0;
            background: #f8f9fa;
        }

        .faq-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .faq-item {
            border-bottom: 1px solid #e0e0e0;
        }

        .faq-item:last-child {
            border-bottom: none;
            /* Hilangkan border untuk item terakhir */
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
            transition: background-color 0.3s ease;
        }

        .faq-question .icon {
            transition: transform 0.3s ease;
            flex-shrink: 0;
            /* Mencegah ikon menyusut */
            margin-left: 1rem;
        }

        .faq-answer {
            padding: 0 1.5rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease-out, padding 0.4s ease-out;
        }

        .faq-answer p {
            color: #555;
            padding-bottom: 1.5rem;
            margin: 0;
            line-height: 1.7;
        }

        /* === STYLING SAAT FAQ AKTIF/TERBUKA === */
        .faq-item.active .faq-question {
            background-color: #f7f7f7;
            color: #2c5530;
            /* Warna hijau khas Anda */
        }

        .faq-item.active .faq-question .icon {
            transform: rotate(180deg);
            /* Putar ikon panah ke atas */
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
    <title>Document</title>

</head>

<body>
    <x-dashboard.navbar />

      {{-- main --}}
    <section class="fleet-section" id="armada">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2 >Armada Pilihan Kami 🚗</h2>
                <p>Kami menyediakan berbagai pilihan mobil MPV yang terawat, bersih, dan siap mengantar Anda dengan
                    nyaman.</p>
            </div>

            <div class="fleet-grid">
                <div class="car-card" data-aos="fade-up">
                    <div class="car-image-container">
                        <img src="https://img.cintamobil.com/2022/04/11/F03gT50g/avanza-2019-putih-1-9a74.jpg"
                            alt="Toyota Avanza Putih">
                        <div class="car-badge">Paling Laris</div>
                    </div>
                    <div class="car-details">
                        <h3>Toyota Avanza</h3>
                        <p class="car-description">Pilihan ideal untuk keluarga atau perjalanan grup kecil dengan
                            efisiensi bahan bakar yang baik.</p>
                        <ul class="car-features">
                            <li><i class="fas fa-users"></i> 6 Penumpang</li>
                            <li><i class="fas fa-suitcase-rolling"></i> 2 Koper Besar</li>
                            <li><i class="fas fa-cogs"></i> Manual</li>
                            <li><i class="fas fa-snowflake"></i> Full AC</li>
                        </ul>
                        <a href="#rental" class="btn-primary">Pesan Sekarang</a>
                    </div>
                </div>

                <div class="car-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="car-image-container">
                        <img src="{{ asset('images/mojas1.jpg') }}" alt="Logo MOJAS Batam"
                       >
                    </div>
                    <div class="car-details">
                        <h3>Mitsubishi Xpander</h3>
                        <p class="car-description">Menawarkan kenyamanan premium dengan interior yang luas dan desain
                            modern.</p>
                        <ul class="car-features">
                            <li><i class="fas fa-users"></i> 6 Penumpang</li>
                            <li><i class="fas fa-suitcase-rolling"></i> 3 Koper Besar</li>
                            <li><i class="fas fa-cogs"></i> Otomatis</li>
                            <li><i class="fas fa-snowflake"></i> Full AC</li>
                        </ul>
                        <a href="#rental" class="btn-primary">Pesan Sekarang</a>
                    </div>
                </div>

                <div class="car-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="car-image-container">
                        <img src="{{ asset('images/mojas2.jpg') }}" alt="Logo MOJAS Batam"
                            alt="Mitsubishi Xpander Putih">
                    </div>
                    <div class="car-details">
                        <h3>Mitsubishi Xpander</h3>
                        <p class="car-description">Menawarkan kenyamanan premium dengan interior yang luas dan desain
                            modern.</p>
                        <ul class="car-features">
                            <li><i class="fas fa-users"></i> 6 Penumpang</li>
                            <li><i class="fas fa-suitcase-rolling"></i> 3 Koper Besar</li>
                            <li><i class="fas fa-cogs"></i> Otomatis</li>
                            <li><i class="fas fa-snowflake"></i> Full AC</li>
                        </ul>
                        <a href="#rental" class="btn-primary">Pesan Sekarang</a>
                    </div>
                </div>

                <div class="car-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="car-image-container">
                        <img src="{{ asset('images/logomojas.jpg') }}" alt="Logo MOJAS Batam"
                       >
                    </div>
                    <div class="car-details">
                        <h3>Suzuki Ertiga</h3>
                        <p class="car-description">Kombinasi sempurna antara gaya, kenyamanan, dan performa yang handal
                            di segala medan.</p>
                        <ul class="car-features">
                            <li><i class="fas fa-users"></i> 6 Penumpang</li>
                            <li><i class="fas fa-suitcase-rolling"></i> 2 Koper Besar</li>
                            <li><i class="fas fa-cogs"></i> Manual</li>
                            <li><i class="fas fa-snowflake"></i> Full AC</li>
                        </ul>
                        <a href="#rental" class="btn-primary">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <x-dashboard.tarif />

    <x-dashboard.kerjasama />
    <hr style="margin: 0; border: none; height: 3px; background: #eee; margin-left: 100px; margin-right: 100px;">

  
    <x-dashboard.faq />

    <x-dashboard.kontak />

    <x-dashboard.footer />

    {{-- footer --}}
    <x-dashboard.footer />
</body>

</html>
