<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOJAS BATAM - Layanan Antar Jemput Siswa Terpercaya</title>
        <link rel="icon" type="image/png" href="{{ asset('images/logomojas.jpg') }}">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <style>
        /* Hamburger Menu Styles */
        .hamburger-menu {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 22px;
            cursor: pointer;
            z-index: 1003;
            position: relative;
        }

        .hamburger-menu span {
            display: block;
            width: 100%;
            height: 3px;
            background: #2c5530;
            transition: all 0.3s ease;
            border-radius: 3px;
        }

        .hamburger-menu.active span:nth-child(1) {
            transform: rotate(45deg) translate(7px, 7px);
        }

        .hamburger-menu.active span:nth-child(2) {
            opacity: 0;
        }

        .hamburger-menu.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }

        /* Mobile Navigation */
        .mobile-nav {
            position: fixed;
            top: 0;
            left: -100%;
            width: 85%;
            height: 100vh;
            background: #ffffff;
            z-index: 1001;
            padding: 20px;
            transition: all 0.4s ease;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            padding-top: calc(70px + 0.5rem);
        }

        .mobile-nav.active {
            left: 0;
        }

        .mobile-nav .nav-menu {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            padding: 0;
            margin: 0;
            list-style: none;
        }

        .mobile-nav .nav-menu li {
            margin: 0;
            padding: 0;
        }

        .mobile-nav-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #eee;
            margin-bottom: 20px;
            margin-top: -10px;
        }

        .mobile-nav-header img {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .mobile-nav-header h3 {
            font-weight: 600;
            font-size: 1.5rem;
        }

        .mobile-nav .nav-menu a {
            font-size: 1.1rem;
            padding: 12px 0;
            display: flex;
            align-items: center;
            gap: 12px;
            color: #1a4023;
            font-weight: 500;
            text-decoration: none;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease;
        }

        .mobile-nav .nav-menu a i {
            width: 24px;
            text-align: center;
            color: #ff8c42;
        }

        .mobile-nav .nav-menu a:hover {
            color: #ff8c42;
            padding-left: 10px;
        }

        /* Mobile dropdown styles */
        .mobile-nav .mobile-dropdown {
            position: relative;
        }

        .mobile-nav .mobile-dropdown-menu {
            display: none;
            background: rgba(44, 85, 48, 0.05);
            margin: 5px 15px;
            border-radius: 8px;
            overflow: hidden;
        }

        .mobile-nav .mobile-dropdown-menu.active {
            display: block;
        }

        .mobile-nav .mobile-dropdown-menu li a {
            padding: 12px 20px;
            font-size: 14px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .mobile-nav .mobile-dropdown-menu li:last-child a {
            border-bottom: none;
        }

        .mobile-nav .mobile-dropdown-toggle i.fa-chevron-down {
            margin-left: 5px;
            transition: transform 0.2s ease;
        }

        .mobile-nav .mobile-dropdown-toggle.active i.fa-chevron-down {
            transform: rotate(180deg);
        }

        .mobile-nav .admin-btn {
            margin-top: 20px;
            text-align: center;
            padding: 12px 25px;
            border-radius: 25px;
            background: linear-gradient(135deg, #2c5530, #4a7c59);
            color: white;
            display: inline-block;
            width: 100%;
        }

        .mobile-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            display: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            backdrop-filter: blur(2px);
        }

        .mobile-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .container {
                padding: 0 1.5rem;
            }

            .hero-content h1 {
                font-size: 3rem;
                padding: 0 1rem;
            }

            .hero-visual img {
                max-width: 90%;
                margin: 0 auto;
                display: block;
            }
        }

        @media (max-width: 992px) {
            .hero-container {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 2rem;
            }

            .hero-content {
                order: 2;
            }

            .hero-visual {
                order: 1;
            }

            .cta-buttons {
                justify-content: center;
            }

            .visimisi-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .features-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .contact-content {
                grid-template-columns: 1fr;
                gap: 3rem;
            }

            .reviews-display {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                padding: 0.8rem 1rem;
            }

            .navbar .nav-menu {
                display: none;
            }

            .navbar .hamburger-menu {
                display: flex;
            }

            /* Tampilkan nav-menu khusus di mobile-nav */
            .mobile-nav .nav-menu {
                display: flex;
            }

            .mobile-nav {
                width: 85%;
            }

            .mobile-nav .nav-menu a {
                padding: 12px 0;
                font-weight: 500;
                color: #1a4023;
                font-size: 1.1rem;
            }

            .hero-content {
                padding: 2rem 1rem;
            }

            .hero-content h1 {
                font-size: 2.5rem;
                margin-bottom: 1rem;
            }

            .hero-content p {
                font-size: 1.1rem;
                padding: 0 1rem;
            }

            .hero-features {
                flex-direction: column;
                gap: 1rem;
                padding: 0 1rem;
            }

            .section-title {
                padding: 0 1rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .features-grid {
                grid-template-columns: 1fr;
                padding: 0 1rem;
                gap: 1.5rem;
            }

            .pricing-card {
                padding: 1.5rem;
                margin: 0 1rem;
            }

            .modal-content {
                padding: 20px;
                margin: 10px;
                max-height: 90vh;
            }

            .alasan-checkboxes {
                grid-template-columns: 1fr;
            }

            .map-section {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .services-grid {
                grid-template-columns: 1fr;
                padding: 0 1rem;
            }

            .cta-buttons {
                padding: 0 1rem;
            }
        }

        @media (max-width: 576px) {
            .hero-content h1 {
                font-size: 2rem;
                line-height: 1.3;
                padding: 0 1rem;
                margin-bottom: 1rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
                padding: 0 1rem;
            }

            .hero-feature-item {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .hero-features {
                display: grid;
                grid-template-columns: 1fr;
                gap: 0.75rem;
                padding: 0 1rem;
            }

            .cta-buttons {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
                text-align: center;
            }

            .pricing-table {
                font-size: 0.9rem;
            }

            .modal-header h2 {
                font-size: 1.5rem;
            }
        }

        .review-section {
            background: #897f7f;
            padding: 30px 20px;
            text-align: center;
            border-top: 2px solid #ddd;
        }

        .review-section h2 {
            margin-bottom: 15px;
            font-size: 22px;
        }

        .review-form {
            max-width: 600px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .review-form input,
        .review-form textarea {
            padding: 10px;
            border: 1px solid #ffffff;
            border-radius: 8px;
            font-size: 14px;
            width: 100%;
        }

        .review-form button {
            background: #0077cc;
            color: rgb(219, 217, 217);
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 15px;
            transition: background 0.3s;
        }

        .review-form button:hover {
            background: #005fa3;
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
            left: 0;
            right: 0;
            width: 100%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            z-index: 1002;
            transition: all 0.3s ease;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            height: 70px;
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

        /* Dropdown styles */
        .nav-menu .dropdown {
            position: relative;
        }

        .nav-menu .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background: #fff;
            min-width: 200px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            padding: 8px 0;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
        }

        .nav-menu .dropdown:hover .dropdown-menu {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .nav-menu .dropdown-menu li {
            margin: 0;
            padding: 0;
        }

        .nav-menu .dropdown-menu li a {
            padding: 10px 20px;
            display: block;
            color: #333;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .nav-menu .dropdown-menu li a:hover {
            background-color: rgba(44, 85, 48, 0.1);
            color: #2c5530;
            padding-left: 25px;
        }

        .nav-menu .dropdown-menu li a::after {
            display: none;
        }

        .nav-menu .dropdown-toggle i {
            margin-left: 5px;
            font-size: 12px;
            transition: transform 0.2s ease;
        }

        .nav-menu .dropdown:hover .dropdown-toggle i {
            transform: rotate(180deg);
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
            min-height: 100vh;
            background: linear-gradient(135deg, #2c5530 0%, #4a7c59 50%, #ff8c42 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding-top: 70px;
            margin-top: 0;
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
            line-height: 1.2;
            font-weight: 800;
            letter-spacing: -0.5px;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.95);
            margin-bottom: 2rem;
            line-height: 1.6;
            max-width: 600px;
        }

        .hero-features {
            display: flex;
            gap: 2rem;
            margin-bottom: 2.5rem;
        }

        .hero-feature-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.75rem 1.25rem;
            border-radius: 50px;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .hero-feature-item:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .hero-feature-item i {
            color: #ff8c42;
            font-size: 1.2rem;
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
        section:not(.hero) {
            padding-top: calc(2rem + 70px);
            margin-top: -70px;
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

        /* === REVIEW SECTION === */
        .review-section {
            background: linear-gradient(135deg, #2c5530 0%, #4a7c59 100%);
            padding: 60px 20px;
            color: white;
        }

        .review-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .review-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .review-header h2 {
            font-size: 2.5rem;
            color: white;
            margin-bottom: 15px;
        }

        .review-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.1rem;
        }

        .review-form {
            max-width: 600px;
            margin: 0 auto 40px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .rating {
            display: flex;
            justify-content: center;
            gap: 10px;
            font-size: 30px;
            padding: 20px 0;
        }

        .rating i {
            color: #ffd700;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .rating i:hover {
            transform: scale(1.2);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .review-form input,
        .review-form textarea {
            width: 100%;
            padding: 12px 15px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 8px;
            margin-top: 8px;
            font-size: 16px;
            color: #333;
            transition: all 0.3s ease;
        }

        .review-form input:focus,
        .review-form textarea:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.5);
        }

        .review-form button {
            width: 100%;
            padding: 15px;
            background: #ff8c42;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .review-form button:hover {
            background: #ff6b1a;
            transform: translateY(-2px);
        }

        .reviews-display {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 40px;
        }

        .review-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .review-card:hover {
            transform: translateY(-5px);
        }

        .review-card-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .reviewer-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #ff8c42;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 20px;
            color: white;
        }

        .reviewer-info h4 {
            margin: 0;
            color: white;
        }

        .reviewer-info .review-date {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
        }

        .review-rating {
            color: #ffd700;
            margin: 10px 0;
        }

        .review-rating .fa-star {
            color: #ddd;
            transition: color 0.2s ease;
        }

        .review-rating .fa-star.filled {
            color: #ffd700;
        }

        .review-content {
            color: rgba(255, 255, 255, 0.9);
            font-style: italic;
            line-height: 1.6;
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

        /* Styling untuk checkbox alasan */
        .alasan-checkboxes {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .alasan-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            background: #f8f9fa;
            border-radius: 8px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .alasan-item:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .alasan-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .alasan-item label {
            margin: 0;
            cursor: pointer;
            font-weight: 500;
            color: #495057;
            flex: 1;
        }

        .textarea-counter {
            text-align: right;
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 5px;
        }

        .submit-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            margin-top: 20px;
            padding: 15px;
            font-size: 1.1rem;
            background: #25D366;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background: #128C7E;
            transform: translateY(-2px);
        }

        .submit-btn i {
            font-size: 1.2rem;
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

        .alasan-section {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #e9ecef;
        }

        .alasan-checkboxes {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .alasan-item {
            background: white;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .alasan-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            border-color: #2c5530;
        }

        .alasan-checkbox {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            accent-color: #2c5530;
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

        /* Small Device Optimizations */
        @media (max-width: 576px) {
            .hero-content h1 {
                font-size: 1.8rem;
                line-height: 1.3;
                padding: 0 0.5rem;
                margin-bottom: 1rem;
            }

            .hero-subtitle {
                font-size: 1rem;
                padding: 0 1rem;
                margin-bottom: 1.5rem;
            }

            .hero-feature-item {
                padding: 0.8rem 1rem;
                font-size: 0.9rem;
                justify-content: center;
                background: rgba(255, 255, 255, 0.15);
            }

            .hero-features {
                display: grid;
                grid-template-columns: 1fr;
                gap: 0.75rem;
                padding: 0 1rem;
                margin-bottom: 2rem;
            }

            .cta-buttons {
                flex-direction: column;
                gap: 1rem;
                padding: 0 1rem;
            }

            .btn-primary,
            .btn-secondary {
                width: 100%;
                text-align: center;
                font-size: 0.95rem;
                padding: 0.8rem 1.5rem;
            }

            .pricing-table {
                font-size: 0.9rem;
                margin: 0 -1rem;
                width: calc(100% + 2rem);
            }

            .modal-header h2 {
                font-size: 1.5rem;
            }

            .section-title h2 {
                font-size: 1.8rem;
                line-height: 1.3;
            }

            .section-title p {
                font-size: 0.95rem;
                padding: 0 1rem;
            }

            .feature-card {
                padding: 1.5rem;
            }

            .feature-card h3 {
                font-size: 1.2rem;
                margin-bottom: 0.8rem;
            }

            .visimisi-card {
                padding: 1.5rem;
            }

            .visimisi-card h3 {
                font-size: 1.5rem;
            }

            .hero-visual img {
                width: 85%;
                border-radius: 15px;
            }

            .mobile-nav {
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img src="{{ asset('images/logomojas.jpg') }}" alt="Logo MOJAS Batam"
                        style="height: 50px; width: auto;">
                    <span>MOJAS BATAM</span>
                </div>
            </a>

            <!-- Hamburger Menu -->
            <div class="hamburger-menu" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <!-- Desktop Menu -->
            <ul class="nav-menu">
                <li><a href="/">Beranda</a></li>
                <li><a href="#tarif">Tarif</a></li>
                <li><a href="#kerjasama">Kerjasama</a></li>
                <li><a href="#faq">FAQ</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle">
                        Kategori <i class="fas fa-chevron-down"></i>
                    </a>
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

    <!-- Mobile Navigation -->
    <div class="mobile-nav">
        <div class="mobile-nav-header">
            <img src="{{ asset('images/logomojas.jpg') }}" alt="MOJAS BATAM"
                style="width: 80px; height: 80px; border-radius: 10px; margin-bottom: 20px;">
            <h3>MOJAS BATAM</h3>
        </div>
        <ul class="nav-menu">
            <li><a href="/" onclick="closeMobileMenu()">
                    <i class="fas fa-home"></i> Beranda
                </a></li>
            <li><a href="#tarif" onclick="closeMobileMenu()">
                    <i class="fas fa-tag"></i> Tarif
                </a></li>
            <li><a href="#kerjasama" onclick="closeMobileMenu()">
                    <i class="fas fa-handshake"></i> Kerjasama
                </a></li>
            <li><a href="#faq" onclick="closeMobileMenu()">
                    <i class="fas fa-question-circle"></i> FAQ
                </a></li>
            <li><a href="#kontak" onclick="closeMobileMenu()">
                    <i class="fas fa-phone"></i> Kontak
                </a></li>
            <li class="mobile-dropdown">
                <a href="#" class="mobile-dropdown-toggle" onclick="toggleMobileDropdown(this)">
                    <i class="fas fa-th-list"></i> Kategori
                    <i class="fas fa-chevron-down"></i>
                </a>
                <ul class="mobile-dropdown-menu">
                    <li><a href="/kegiatan">Kegiatan</a></li>
                    <li><a href="/rental">Rental</a></li>
                    <li><a href="/armada">Armada</a></li>
                    <li><a href="/sekolah">Sekolah</a></li>
                </ul>
            </li>
            <li><a href="/login" class="admin-btn">
                    <i class="fas fa-user-shield"></i> Login
                </a></li>
        </ul>
    </div>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-overlay" onclick="closeMobileMenu()"></div>

    <section id="home" class="hero">
        <div class="hero-container">
            <div class="hero-content" data-aos="fade-right">
                <h1>Layanan Antar Jemput<br>Siswa Terpercaya</h1>
                <p class="hero-subtitle">Solusi transportasi yang aman, nyaman, dan tepat waktu untuk putra-putri Anda
                    di Area Batam. Dipercaya oleh ratusan keluarga sejak 2024.</p>
                <div class="hero-features">
                    <div class="hero-feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>100% Aman</span>
                    </div>
                    <div class="hero-feature-item">
                        <i class="fas fa-clock"></i>
                        <span>Tepat Waktu</span>
                    </div>
                    <div class="hero-feature-item">
                        <i class="fas fa-user-tie"></i>
                        <span>Driver Profesional</span>
                    </div>
                </div>
                <div class="cta-buttons">
                    <a href="/rental" class="btn-primary">
                        <i class="fas fa-car"></i>
                        <span>Lihat Layanan</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="#kontak" class="btn-secondary">
                        <i class="fas fa-phone"></i>
                        <span>Hubungi Kami</span>
                    </a>
                </div>
            </div>

            <!-- Bagian hero-visual yang telah diubah -->
            <div class="hero-visual" data-aos="fade-left"
                style="display: flex; justify-content: center; align-items: center;">
                <img src="{{ asset('images/logomojas.jpg') }}" alt="Logo MOJAS Batam"
                    style="
                    max-width: 400px; /* Lebar maksimum gambar agar tidak terlalu besar di layar lebar */
                    width: 100%;      /* Membuat gambar responsif */
                    height: auto;     /* Tinggi menyesuaikan secara otomatis */
                    border-radius: 20px; /* Sudut sedikit membulat agar lebih modern */
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); /* Efek bayangan halus untuk membuatnya menonjol */
                 ">
            </div>
        </div>
    </section>

    <section id="visimisi" class="visimisi">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Visi & Misi Kami</h2>
                <p>Tujuan dan komitmen kami dalam memberikan pelayanan terbaik.</p>
            </div>
            <div class="visimisi-grid">
                <div class="visimisi-card" data-aos="fade-right">
                    <h3><i class="fa fa-bullseye"></i> Visi</h3>
                    <p>Menjadi penyedia layanan transportasi siswa terdepan dan terpercaya di Batam, yang
                        menjadi mitra andalan bagi orang tua dan sekolah dalam mendukung kelancaran dan kesuksesan
                        pendidikan.</p>
                </div>
                <div class="visimisi-card" data-aos="fade-left">
                    <h3><i class="fa fa-tasks"></i> Misi</h3>
                    <ul>
                        <li><i class="fas fa-check-circle"></i>Menyelenggarakan layanan antar jemput yang
                            mengutamakan Kepercayaan, Keamanan, Kenyamanan, dan Ketepatan Waktu.</li>
                        <li><i class="fas fa-check-circle"></i>Memberikan kemudahan bagi orang tua dengan
                            sistem transportasi door to door yang aman dan dapat dipantau.</li>
                        <li><i class="fas fa-check-circle"></i>Menyediakan armada yang terawat dan pengemudi
                            profesional untuk menjamin keselamatan siswa.</li>
                        <li><i class="fas fa-check-circle"></i>Membangun kemitraan strategis yang saling
                            menguntungkan dengan pihak sekolah.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="layanan" class="features">
        <div class="container">
            <div class="section-title" data-aos="fade-up">
                <h2>Mengapa Memilih MOJAS BATAM?</h2>
                <p>Kami berkomitmen pada prinsip "Kepercayaan, Keamanan, Kenyamanan dan Ketepatan Waktu".
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100"><i
                        class="fas fa-shield-alt feature-icon"></i>
                    <h3>Kepercayaan</h3>
                    <p>Siswa selalu diantar-jemput antara rumah-sekolah, memberikan ketenangan bagi orang
                        tua.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="200"><i
                        class="fas fa-lock feature-icon"></i>
                    <h3>Keamanan</h3>
                    <p>Driver berpengalaman, menaati lalu lintas, dan memantau keselamatan siswa selama
                        perjalanan.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="300"><i
                        class="fas fa-heart feature-icon"></i>
                    <h3>Kenyamanan</h3>
                    <p>Mobil ber-AC, bersih, dan tidak berdesakan dengan kapasitas maksimal 6 siswa per
                        mobil.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="400"><i
                        class="fas fa-clock feature-icon"></i>
                    <h3>Ketepatan Waktu</h3>
                    <p>Disiplin driver dan rute terencana menjamin siswa tiba di tujuan tepat waktu.</p>
                </div>
                <div class="feature-card" data-aos="fade-up" data-aos-delay="500"><i
                        class="fas fa-map-marker-alt feature-icon"></i>
                    <h3>Door to Door</h3>
                    <p>Layanan antar jemput langsung dari rumah ke sekolah dan sebaliknya dengan sistem
                        tracking.</p>
                </div>
            </div>
        </div>
    </section>


    <x-dashboard.tarif />

    <x-dashboard.kerjasama />
    <hr style="margin: 0; border: none; height: 3px; background: #eee; margin-left: 100px; margin-right: 100px;">


    <x-dashboard.faq />

    <!-- Bagian Ulasan -->
    <section class="review-section">
        <div class="review-container">
            <div class="review-header">
                <h2>Ulasan Pelanggan</h2>
                <p>Apa kata mereka tentang layanan MOJAS BATAM?</p>
            </div>

            <form class="review-form" id="reviewForm" action="{{ route('reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="rating" id="ratingInput" value="5">

                <div class="rating">
                    <i class="fas fa-star" data-rating="1"></i>
                    <i class="fas fa-star" data-rating="2"></i>
                    <i class="fas fa-star" data-rating="3"></i>
                    <i class="fas fa-star" data-rating="4"></i>
                    <i class="fas fa-star" data-rating="5"></i>
                </div>

                <div class="form-group">
                    <input type="text" name="nama" placeholder="Nama Anda" required>
                </div>

                <div class="form-group">
                    <textarea name="ulasan" rows="4" placeholder="Bagikan pengalaman Anda menggunakan layanan kami..." required></textarea>
                </div>

                <button type="submit">Kirim Ulasan</button>
            </form>

            <div class="reviews-display" id="reviewsDisplay">
                @forelse($reviews as $review)
                    <div class="review-card" data-aos="fade-up">
                        <div class="review-card-header">
                            <div class="reviewer-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="reviewer-info">
                                <h4>{{ $review->nama }}</h4>
                                <span class="review-date">{{ $review->formatted_date }}</span>
                            </div>
                        </div>
                        <div class="review-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $review->rating ? 'filled' : '' }}"></i>
                            @endfor
                        </div>
                        <p class="review-content">"{{ $review->ulasan }}"</p>
                    </div>
                @empty
                    <div class="no-reviews">
                        <p>Belum ada ulasan. Jadilah yang pertama memberikan ulasan!</p>
                    </div>
                @endforelse

                @if ($reviews->count() >= 6)
                    <div class="load-more-reviews">
                        <button type="button" id="loadMoreReviews" class="btn-load-more">
                            Lihat Ulasan Lainnya
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <x-dashboard.kontak />


    <x-dashboard.footer />

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
                        <div id="mapAsal"
                            style="height: 250px; width: 100%; border-radius: 8px; border: 1px solid #ddd;"></div>
                        <input type="text" id="alamatAsal" readonly placeholder="Koordinat asal"
                            style="margin-top: 10px; text-align: center;">
                    </div>
                    <div class="map-container">
                        <label>Pilih Lokasi Antar (Tujuan)</label>
                        <div id="mapTujuan"
                            style="height: 250px; width: 100%; border-radius: 8px; border: 1px solid #ddd;"></div>
                        <input type="text" id="alamatTujuan" readonly placeholder="Koordinat tujuan"
                            style="margin-top: 10px; text-align: center;">
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
        // Mobile Menu Functions
        function toggleMobileMenu() {
            const hamburger = document.querySelector('.hamburger-menu');
            const mobileNav = document.querySelector('.mobile-nav');
            const overlay = document.querySelector('.mobile-overlay');

            hamburger.classList.toggle('active');
            mobileNav.classList.toggle('active');
            overlay.classList.toggle('active');

            // Prevent body scrolling when menu is open
            if (mobileNav.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        }

        function closeMobileMenu() {
            const hamburger = document.querySelector('.hamburger-menu');
            const mobileNav = document.querySelector('.mobile-nav');
            const overlay = document.querySelector('.mobile-overlay');

            hamburger.classList.remove('active');
            mobileNav.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close mobile menu when window is resized to desktop size
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                closeMobileMenu();
            }
        });

        // Mobile dropdown toggle
        function toggleMobileDropdown(element) {
            event.preventDefault();
            const dropdownMenu = element.nextElementSibling;
            const dropdownIcon = element.querySelector('.fa-chevron-down');

            // Toggle the active class on the dropdown menu
            dropdownMenu.classList.toggle('active');
            element.classList.toggle('active');

            // Close other open dropdowns
            const allDropdowns = document.querySelectorAll('.mobile-dropdown-menu');
            const allToggles = document.querySelectorAll('.mobile-dropdown-toggle');

            allDropdowns.forEach(dropdown => {
                if (dropdown !== dropdownMenu && dropdown.classList.contains('active')) {
                    dropdown.classList.remove('active');
                }
            });

            allToggles.forEach(toggle => {
                if (toggle !== element && toggle.classList.contains('active')) {
                    toggle.classList.remove('active');
                }
            });
        }

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

            // === KODE FAQ DENGAN USABILITY LEBIH BAIK ===
            const faqItems = document.querySelectorAll('.faq-item');

            faqItems.forEach(item => {
                const questionButton = item.querySelector('.faq-question');
                const answerDiv = item.querySelector('.faq-answer');

                questionButton.addEventListener('click', () => {
                    // Cek status item saat ini (apakah sedang aktif/terbuka)
                    const isActive = item.classList.contains('active');

                    // Toggle class 'active' pada .faq-item
                    item.classList.toggle('active');

                    // Update atribut ARIA untuk aksesibilitas
                    questionButton.setAttribute('aria-expanded', !isActive);

                    // Atur max-height untuk animasi buka-tutup
                    if (!isActive) {
                        // Jika tidak aktif (akan dibuka), set max-height sesuai tinggi konten
                        answerDiv.style.maxHeight = answerDiv.scrollHeight + 'px';
                    } else {
                        // Jika sudah aktif (akan ditutup), kembalikan max-height ke 0
                        answerDiv.style.maxHeight = 0;
                    }
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
                    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(lat1 * Math.PI / 180) *
                        Math.cos(lat2 *
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

                // Inisialisasi sistem rating
                const ratingStars = document.querySelectorAll('.rating i');
                let selectedRating = 0;

                ratingStars.forEach(star => {
                    star.addEventListener('mouseover', function() {
                        const rating = this.getAttribute('data-rating');
                        updateStars(rating);
                    });

                    star.addEventListener('mouseout', function() {
                        updateStars(selectedRating);
                    });

                    star.addEventListener('click', function() {
                        selectedRating = this.getAttribute('data-rating');
                        updateStars(selectedRating);
                    });
                });

                function updateStars(rating) {
                    ratingStars.forEach(star => {
                        const starRating = star.getAttribute('data-rating');
                        if (starRating <= rating) {
                            star.style.color = '#ffd700';
                        } else {
                            star.style.color = 'rgba(255, 255, 255, 0.3)';
                        }
                    });
                }

                // Form submission
                document.getElementById('reviewForm').addEventListener('submit', function(e) {
                    e.preventDefault();

                    if (selectedRating === 0) {
                        alert('Mohon berikan rating bintang!');
                        return;
                    }

                    // Set rating value ke hidden input
                    document.getElementById('ratingInput').value = selectedRating;

                    // Ambil data form
                    const formData = new FormData(this);
                    const nama = formData.get('nama');
                    const ulasan = formData.get('ulasan');
                    const rating = selectedRating;

                    // Kirim via AJAX
                    fetch(this.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Gunakan data review dari server
                                const reviewData = data.review;
                                const newReviewHtml = createReviewElement(
                                    reviewData.nama,
                                    reviewData.ulasan,
                                    reviewData.rating,
                                    reviewData.formatted_date
                                );

                                // Cari container reviews
                                const reviewsContainer = document.getElementById(
                                    'reviewsDisplay');
                                const noReviewsMessage = reviewsContainer.querySelector(
                                    '.no-reviews');

                                // Hapus pesan "belum ada ulasan" jika ada
                                if (noReviewsMessage) {
                                    noReviewsMessage.remove();
                                }

                                // Tambahkan review baru di bagian atas
                                reviewsContainer.insertAdjacentHTML('afterbegin',
                                newReviewHtml);

                                // Reset form
                                this.reset();
                                selectedRating = 0;
                                updateStars(0);

                                // Tampilkan notifikasi sukses
                                showSuccessNotification(
                                    'Terima kasih atas ulasan Anda! Ulasan berhasil ditambahkan.'
                                    );

                                // Scroll ke review yang baru ditambahkan
                                setTimeout(() => {
                                    const newReview = reviewsContainer.querySelector(
                                        '.review-card');
                                    newReview.scrollIntoView({
                                        behavior: 'smooth',
                                        block: 'center'
                                    });
                                    newReview.style.border = '2px solid #4CAF50';
                                    setTimeout(() => {
                                        newReview.style.border = '';
                                    }, 3000);
                                }, 100);
                            } else {
                                alert('Terjadi kesalahan: ' + data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert(
                            'Terjadi kesalahan saat menyimpan ulasan. Silakan coba lagi.');
                        });
                });

                // Fungsi untuk membuat elemen review baru
                function createReviewElement(nama, ulasan, rating, tanggal) {
                    let starsHtml = '';
                    for (let i = 1; i <= 5; i++) {
                        starsHtml += `<i class="fas fa-star ${i <= rating ? 'filled' : ''}"></i>`;
                    }

                    return `
                        <div class="review-card new-review" data-aos="fade-up">
                            <div class="review-card-header">
                                <div class="reviewer-avatar">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="reviewer-info">
                                    <h4>${nama}</h4>
                                    <span class="review-date">${tanggal}</span>
                                </div>
                            </div>
                            <div class="review-rating">
                                ${starsHtml}
                            </div>
                            <p class="review-content">"${ulasan}"</p>
                        </div>
                    `;
                }

                // Fungsi untuk menampilkan notifikasi sukses
                function showSuccessNotification(message) {
                    // Buat elemen notifikasi
                    const notification = document.createElement('div');
                    notification.className = 'success-notification';
                    notification.innerHTML = `
                        <div class="notification-content">
                            <i class="fas fa-check-circle"></i>
                            <span>${message}</span>
                        </div>
                    `;

                    // Style notifikasi
                    notification.style.cssText = `
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        background: #4CAF50;
                        color: white;
                        padding: 15px 20px;
                        border-radius: 8px;
                        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                        z-index: 9999;
                        transform: translateX(400px);
                        transition: transform 0.3s ease;
                        max-width: 350px;
                    `;

                    // Tambahkan ke body
                    document.body.appendChild(notification);

                    // Animasi masuk
                    setTimeout(() => {
                        notification.style.transform = 'translateX(0)';
                    }, 100);

                    // Hapus setelah 5 detik
                    setTimeout(() => {
                        notification.style.transform = 'translateX(400px)';
                        setTimeout(() => {
                            document.body.removeChild(notification);
                        }, 300);
                    }, 5000);
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
                    const urlAsal =
                        `https://www.google.com/maps?q=${coordsAsal.lat},${coordsAsal.lng}`;
                    const urlTujuan =
                        `https://www.google.com/maps?q=${coordsTujuan.lat},${coordsTujuan.lng}`;

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
        });
    </script>
</body>

</html>
