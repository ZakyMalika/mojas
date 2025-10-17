    

<section id="kerjasama" class="kerjasama">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Kerjasama & Mitra</h2>
            <p>Bergabunglah dengan lebih dari 50+ sekolah yang telah mempercayai layanan kami</p>
        </div>

        <!-- Partnership Benefits -->
        <div class="partnership-benefits">
            <div class="benefit-card" data-aos="fade-up" data-aos-delay="100">
                <div class="benefit-header">
                    <div class="benefit-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Mitra Terpercaya</h3>
                </div>
                <p>Telah melayani banyak siswa dengan tingkat kepuasan pelanggan 90%</p>
            </div>

            <div class="benefit-stats">
                <div class="stat-item" data-aos="fade-up" data-aos-delay="150">
                    <div class="stat-value">20+</div>
                    <div class="stat-label">Sekolah Mitra</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-value">50+</div>
                    <div class="stat-label">Siswa Terlayani</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="250">
                    <div class="stat-value">90%</div>
                    <div class="stat-label">Tingkat Kepuasan</div>
                </div>
            </div>
        </div>

        <!-- Partnership Features -->
        <div class="kerjasama-grid">
            <div class="kerjasama-card featured" data-aos="fade-up" data-aos-delay="100">
                <div class="card-icon">
                    <i class="fas fa-coins"></i>
                </div>
                <div class="card-content">
                    <h3>Skema Bagi Hasil Menarik</h3>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Komisi bulanan yang kompetitif</li>
                        <li><i class="fas fa-check"></i> Pembayaran tepat waktu</li>
                        <li><i class="fas fa-check"></i> Sistem perhitungan transparan</li>
                    </ul>
                </div>
            </div>

            <div class="kerjasama-card featured" data-aos="fade-up" data-aos-delay="200">
                <div class="card-icon">
                    <i class="fas fa-bus-alt"></i>
                </div>
                <div class="card-content">
                    <h3>Dukungan Acara Sekolah</h3>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Tarif khusus untuk acara sekolah</li>
                        <li><i class="fas fa-check"></i> Armada modern dan nyaman</li>
                        <li><i class="fas fa-check"></i> Driver profesional berpengalaman</li>
                    </ul>
                </div>
            </div>

            <div class="kerjasama-card featured" data-aos="fade-up" data-aos-delay="300">
                <div class="card-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="card-content">
                    <h3>Layanan Fleksibel</h3>
                    <ul class="feature-list">
                        <li><i class="fas fa-check"></i> Jadwal antar-jemput yang fleksibel</li>
                        <li><i class="fas fa-check"></i> Pelayanan 24/7</li>
                        <li><i class="fas fa-check"></i> Dukungan pelanggan responsif</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="partnership-cta" data-aos="fade-up">
            <div class="cta-content">
                <h3>Tertarik Menjadi Mitra?</h3>
                <p>Dapatkan informasi lengkap tentang program kemitraan kami</p>
            </div>
            <div class="cta-buttons">
                <a href="{{ asset('pdf/mojas.pdf') }}" target="_blank" class="btn-primary">
                    <i class="fas fa-file-pdf"></i> 
                    <span>Download Proposal</span>
                </a>
                <a href="#kontak" class="btn-secondary">
                    <i class="fas fa-handshake"></i>
                    <span>Hubungi Tim Kami</span>
                </a>
            </div>
        </div>
    </div>

    <style>
        .kerjasama {
            padding: 6rem 0;
            background: #f8f9fa;
        }

        .partnership-benefits {
            margin: 3rem 0;
        }

        .benefit-card {
            background: #2c5530;
            color: white;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            margin-bottom: 2rem;
            box-shadow: 0 10px 30px rgba(44, 85, 48, 0.2);
        }

        .benefit-header {
            margin-bottom: 1.5rem;
        }

        .benefit-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .benefit-icon i {
            font-size: 2rem;
            color: #ff8c42;
        }

        .benefit-card h3 {
            font-size: 1.8rem;
            margin: 0;
        }

        .benefit-card p {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .benefit-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }

        .stat-item {
            text-align: center;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .stat-item:hover {
            transform: translateY(-5px);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c5530;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: #666;
            font-size: 1.1rem;
        }

        .kerjasama-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin: 4rem 0;
        }

        .kerjasama-card.featured {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .kerjasama-card.featured:hover {
            transform: translateY(-10px);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            background: rgba(44, 85, 48, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .card-icon i {
            font-size: 1.5rem;
            color: #2c5530;
        }

        .card-content h3 {
            font-size: 1.4rem;
            color: #2c5530;
            margin-bottom: 1rem;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .feature-list li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            color: #666;
        }

        .feature-list li i {
            color: #28a745;
            font-size: 0.9rem;
        }

        .partnership-cta {
            background: linear-gradient(135deg, #2c5530 0%, #4a7c59 100%);
            padding: 3rem;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 4rem;
            box-shadow: 0 15px 40px rgba(44, 85, 48, 0.2);
        }

        .cta-content {
            color: white;
        }

        .cta-content h3 {
            font-size: 1.8rem;
            margin: 0 0 0.5rem;
        }

        .cta-content p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin: 0;
        }

        .cta-buttons {
            display: flex;
            gap: 1rem;
        }

        @media (max-width: 992px) {
            .benefit-stats {
                grid-template-columns: repeat(2, 1fr);
            }

            .kerjasama-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .partnership-cta {
                flex-direction: column;
                text-align: center;
                gap: 2rem;
            }
        }

        @media (max-width: 768px) {
            .benefit-stats {
                grid-template-columns: 1fr;
            }

            .kerjasama-grid {
                grid-template-columns: 1fr;
            }

            .cta-buttons {
                flex-direction: column;
                width: 100%;
            }

            .cta-buttons a {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</section>