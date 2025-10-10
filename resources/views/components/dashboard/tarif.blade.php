<section id="tarif" class="pricing">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Layanan & Tarif</h2>
            <p>Tarif kompetitif dengan layanan berkualitas tinggi</p>
        </div>
        <div class="pricing-wrapper" data-aos="zoom-in" data-aos-delay="100">
            <div class="pricing-card">
                <h4 class="table-heading">Rincian Biaya Berdasarkan Jarak</h4>
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
                <div style="text-align: center; margin-top: 40px;">
                    <button class="btn-primary daftar-btn" onclick="showDaftarForm()">Daftar Sekarang</button>
                </div>
            </div>
        </div>
        <hr>
        <div class="section-title" data-aos="fade-up" style="margin-top: 50px;">
            <h2>Layanan Lainnya</h2>
            <p>Fleksibel untuk setiap kebutuhan Anda</p>
        </div>
        <div class="services-grid" data-aos="fade-up" data-aos-delay="100">
            <div class="service-card">
                <div class="service-icon">⚡</div>
                <h3>Insidental</h3>
                <p>Butuh antar jemput mendadak? Layanan ini siap membantu Anda saat dibutuhkan.</p>
                <div class="service-price">Tarif Sesuai Jarak & Waktu</div>
            </div>
            <div class="service-card">
                <div class="service-icon">🎉</div>
                <h3>Acara Khusus</h3>
                <p>Transportasi untuk acara sekolah seperti kunjungan edukasi atau kegiatan ekstra
                    kurikuler.</p>
                <div class="service-price">Hubungi Kami Untuk Penawaran</div>
            </div>
        </div>
        <div style="text-align: center; margin-top: 40px;">
            <button class="btn-primary pesan-btn">Pesan & Simulasi Tarif</button>
        </div>
    </div>

    <!-- Form Modal Pendaftaran -->
    <div id="daftarModal" class="modal daftar-modal">
        <div class="modal-content registration-form">
            <div class="modal-header">
                <h2><i class="fas fa-user-plus"></i> Form Pendaftaran</h2>
                <span class="close" onclick="closeDaftarModal()">&times;</span>
            </div>
            <div class="modal-body">
                <div class="form-section">
                    <div class="form-group">
                        <label for="namaPendaftar"><i class="fas fa-user"></i> Nama Orang Tua:</label>
                        <input type="text" id="namaPendaftar" placeholder="Masukkan nama lengkap Anda" required>
                    </div>
                    <div class="form-group">
                        <label for="namaAnak"><i class="fas fa-child"></i> Nama Anak:</label>
                        <input type="text" id="namaAnak" placeholder="Masukkan nama lengkap anak" required>
                    </div>
                    <div class="form-group">
                        <label for="asalSekolah"><i class="fas fa-school"></i> Asal Sekolah:</label>
                        <input type="text" id="asalSekolah" placeholder="Masukkan nama sekolah" required>
                    </div>
                    {{--  --}}
                    {{-- <div class="form-group alasan-section">
                        <label><i class="fas fa-clipboard-list"></i> Alasan Mendaftar:</label>
                        <div class="alasan-checkboxes">
                            <div class="alasan-item">
                                <input type="checkbox" id="alasan1" class="alasan-checkbox">
                                <label for="alasan1">Kesibukan Kerja</label>
                            </div>
                            <div class="alasan-item">
                                <input type="checkbox" id="alasan2" class="alasan-checkbox">
                                <label for="alasan2">Tidak Memiliki Kendaraan</label>
                            </div>
                            <div class="alasan-item">
                                <input type="checkbox" id="alasan3" class="alasan-checkbox">
                                <label for="alasan3">Jarak Rumah ke Sekolah Jauh</label>
                            </div>
                            <div class="alasan-item">
                                <input type="checkbox" id="alasan4" class="alasan-checkbox">
                                <label for="alasan4">Keamanan dan Kenyamanan Anak</label>
                            </div>
                        </div>
                    </div> --}}
                    
                    <div class="form-group">
                        <label for="alasanTambahan"><i class="fas fa-comment-alt"></i> Alasan Tambahan (Opsional):</label>
                        <textarea id="alasanTambahan" rows="3" 
                            placeholder="Ceritakan alasan lain mengapa Anda memilih layanan kami..."></textarea>
                        <div class="textarea-counter">
                            <span id="charCount">0</span>/200 karakter
                        </div>
                    </div>

                    <button class="btn-primary submit-btn" onclick="kirimPendaftaran()">
                        <i class="fab fa-whatsapp"></i> Kirim Pendaftaran via WhatsApp
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="orderModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Formulir Pemesanan & Simulasi</h2>
                <span class="close">×</span>
            </div>

            <div class="modal-body">
                <div class="form-section">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" placeholder="Masukkan nama lengkap">

                    <label for="alamat" style="margin-top: 15px;">Tujuan Layanan</label>
                    <input type="text" id="alamat" placeholder="Masukkan Tujuan Layanan">

                    <label for="sekolah" style="margin-top: 15px;">Nomer Telepon:</label>
                    <input type="number" id="sekolah" placeholder="Masukkan Nomer Telepon Anda">
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


<script>
function showDaftarForm() {
    document.getElementById('daftarModal').style.display = 'flex';
}

function closeDaftarModal() {
    document.getElementById('daftarModal').style.display = 'none';
}

// === Counter karakter alasan tambahan ===
document.getElementById('alasanTambahan').addEventListener('input', function() {
    const maxLength = 200;
    const currentLength = this.value.length;
    document.getElementById('charCount').textContent = currentLength;

    if (currentLength > maxLength) {
        this.value = this.value.substring(0, maxLength);
        document.getElementById('charCount').textContent = maxLength;
    }
});

// === Kirim Form Pendaftaran via WhatsApp ===
function kirimPendaftaran() {
    const namaPendaftar = document.getElementById('namaPendaftar').value.trim();
    const namaAnak = document.getElementById('namaAnak').value.trim();
    const asalSekolah = document.getElementById('asalSekolah').value.trim();
    const alasanTambahan = document.getElementById('alasanTambahan').value.trim();

    // Validasi wajib isi
    if (!namaPendaftar || !namaAnak || !asalSekolah) {
        alert('Mohon lengkapi Nama Orang Tua, Nama Anak, dan Asal Sekolah!');
        return;
    }

    // Format pesan WhatsApp
    let pesan = `Halo, saya ingin mendaftar layanan antar jemput MOJAS BATAM.\n\n` +
        `*Data Pendaftaran:*\n` +
        `-------------------\n` +
        `*Nama Orang Tua:* ${namaPendaftar}\n` +
        `*Nama Anak:* ${namaAnak}\n` +
        `*Asal Sekolah:* ${asalSekolah}\n`;

    if (alasanTambahan) {
        pesan += `\n*Alasan Tambahan:*\n${alasanTambahan}\n`;
    }

    pesan += `\nMohon informasi lebih lanjut mengenai prosedur pendaftaran. Terima kasih.`;

    // Buka WhatsApp
    const whatsappURL = `https://wa.me/6281268712321?text=${encodeURIComponent(pesan)}`;
    window.open(whatsappURL, '_blank');

    closeDaftarModal();
}

// Tutup modal jika user klik di luar modal
window.onclick = function(event) {
    const daftarModal = document.getElementById('daftarModal');
    if (event.target == daftarModal) {
        daftarModal.style.display = "none";
    }
};
</script>
