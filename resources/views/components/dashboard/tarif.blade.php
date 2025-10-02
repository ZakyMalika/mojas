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
                    <div class="form-group alasan-section">
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
                    </div>
                    
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
// === KODE FAQ DENGAN USABILITY LEBIH BAIK ===
const faqItems = document.querySelectorAll('.faq-item');

faqItems.forEach(item => {
    const questionButton = item.querySelector('.faq-question');
    const answerDiv = item.querySelector('.faq-answer');

    questionButton.addEventListener('click', () => {
        const isActive = item.classList.contains('active');
        item.classList.toggle('active');
        questionButton.setAttribute('aria-expanded', !isActive);
        answerDiv.style.maxHeight = !isActive ? answerDiv.scrollHeight + 'px' : 0;
    });
});

// === MAP LOKASI KANTOR ===
const officeCoords = [1.1160, 104.0385];
const locationMap = L.map('locationMap').setView(officeCoords, 15);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(locationMap);
L.marker(officeCoords).addTo(locationMap).bindPopup(
    '<b>PT. MOJAS BATAM</b><br>Perumahan Anggrek Sari Blok F8 no.11, Batam '
).openPopup();

// === MODAL PESAN & SIMULASI TARIF ===
const modal = document.getElementById("orderModal");
const closeBtn = modal.querySelector(".close");
const pesanBtns = document.querySelectorAll(".pesan-btn");

let modalMapsInitialized = false;
let mapAsal, mapTujuan;
let markerAsal = null, markerTujuan = null;

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

// === EVENT LISTENER UNTUK TOMBOL PESAN ===
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

// === CLOSE MODAL ===
closeBtn.addEventListener("click", () => modal.style.display = "none");
window.addEventListener("click", e => {
    if (e.target == modal) modal.style.display = "none";
});

// === HITUNG JARAK DAN TARIF ===
function hitungJarak(lat1, lon1, lat2, lon2) {
    const R = 6371;
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
              Math.cos(lat1 * Math.PI / 180) *
              Math.cos(lat2 * Math.PI / 180) *
              Math.sin(dLon / 2) * Math.sin(dLon / 2);
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

// === KIRIM KE WHATSAPP ===
// Fungsi untuk form pendaftaran
function showDaftarForm() {
    document.getElementById('daftarModal').style.display = 'flex';
}

function closeDaftarModal() {
    document.getElementById('daftarModal').style.display = 'none';
}

// Tambahkan event listener untuk counter karakter
document.getElementById('alasanTambahan').addEventListener('input', function() {
    const maxLength = 200;
    const currentLength = this.value.length;
    document.getElementById('charCount').textContent = currentLength;
    
    if (currentLength > maxLength) {
        this.value = this.value.substring(0, maxLength);
        document.getElementById('charCount').textContent = maxLength;
    }
});

function kirimPendaftaran() {
    const namaPendaftar = document.getElementById('namaPendaftar').value;
    const namaAnak = document.getElementById('namaAnak').value;
    const asalSekolah = document.getElementById('asalSekolah').value;
    
    // Mengumpulkan alasan yang dipilih
    const alasanCheckboxes = document.querySelectorAll('.alasan-checkbox:checked');
    const alasanTerpilih = Array.from(alasanCheckboxes).map(cb => cb.nextElementSibling.textContent);
    const alasanTambahan = document.getElementById('alasanTambahan').value;

    // Validasi form
    if (!namaPendaftar || !namaAnak || !asalSekolah) {
        alert('Mohon lengkapi Nama Orang Tua, Nama Anak, dan Asal Sekolah!');
        return;
    }

    if (alasanTerpilih.length === 0) {
        alert('Mohon pilih setidaknya satu alasan mendaftar!');
        return;
    }

    // Format pesan WhatsApp
    let pesan = `Halo, saya ingin mendaftar layanan antar jemput MOJAS BATAM.\n\n` +
        `*Data Pendaftaran:*\n` +
        `-------------------\n` +
        `*Nama Orang Tua:* ${namaPendaftar}\n` +
        `*Nama Anak:* ${namaAnak}\n` +
        `*Asal Sekolah:* ${asalSekolah}\n\n` +
        `*Alasan Mendaftar:*\n`;
    
    // Menambahkan alasan yang dipilih
    alasanTerpilih.forEach((alasan, index) => {
        pesan += `${index + 1}. ${alasan}\n`;
    });

    // Menambahkan alasan tambahan jika ada
    if (alasanTambahan.trim()) {
        pesan += `\n*Alasan Tambahan:*\n${alasanTambahan}\n\n`;
    } else {
        pesan += '\n';
    }
        `Mohon informasi lebih lanjut mengenai prosedur pendaftaran. Terima kasih.`;

    // Buka WhatsApp dengan pesan yang sudah diformat
    const whatsappURL = `https://wa.me/6281268712321?text=${encodeURIComponent(pesan)}`;
    window.open(whatsappURL, '_blank');
    
    // Tutup modal setelah mengirim
    closeDaftarModal();
}

// Tutup modal jika user mengklik di luar modal
window.onclick = function(event) {
    const daftarModal = document.getElementById('daftarModal');
    if (event.target == daftarModal) {
        daftarModal.style.display = "none";
    }
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
</script>
