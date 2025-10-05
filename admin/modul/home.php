<?php
// Get statistics from database
include "config/koneksi.php";

date_default_timezone_set('Asia/Makassar'); // WITA


// Count total mahasiswa
$query_mahasiswa = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM peserta_magang");
$total_mahasiswa = mysqli_fetch_assoc($query_mahasiswa)['total'];

// Count active mahasiswa
$query_aktif = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM peserta_magang WHERE status = 'Aktif'");
$total_aktif = mysqli_fetch_assoc($query_aktif)['total'];

// Count surat balasan
$query_surat = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM balasan_surat");
$total_surat = mysqli_fetch_assoc($query_surat)['total'];

// Count sertifikat
$query_sertifikat = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM data_sertifikat");
$total_sertifikat = mysqli_fetch_assoc($query_sertifikat)['total'];

// Count ulasan
$query_ulasan = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM testimoni");
$total_ulasan = mysqli_fetch_assoc($query_ulasan)['total'];

// Recent activities (last 5 entries)
$query_recent = mysqli_query($koneksi, "
    SELECT pm.*, sb.nama_bidang 
    FROM peserta_magang pm 
    LEFT JOIN sub_bidang sb ON pm.id_bidang = sb.id_bidang 
    ORDER BY pm.id_mahasiswa DESC 
    LIMIT 5
");
?>

<!-- Welcome Section -->
<div class="welcome-section">
    <h1><i class="fas fa-tachometer-alt"></i> Dashboard Admin</h1>
    <p>Selamat datang di Panel Admin PLN UID Sulselrabar. Kelola data magang dengan mudah dan efisien.</p>
</div>

<!-- Statistics Cards -->
<div class="row">
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="dashboard-card">
            <div class="dashboard-card-icon primary">
                <i class="fas fa-users"></i>
            </div>
            <h3><?php echo $total_mahasiswa; ?></h3>
            <p>Total Mahasiswa Magang</p>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="dashboard-card">
            <div class="dashboard-card-icon success">
                <i class="fas fa-user-check"></i>
            </div>
            <h3><?php echo $total_aktif; ?></h3>
            <p>Mahasiswa Aktif</p>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="dashboard-card">
            <div class="dashboard-card-icon warning">
                <i class="fas fa-envelope"></i>
            </div>
            <h3><?php echo $total_surat; ?></h3>
            <p>Surat Balasan</p>
        </div>
    </div>
    
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="dashboard-card">
            <div class="dashboard-card-icon danger">
                <i class="fas fa-certificate"></i>
            </div>
            <h3><?php echo $total_sertifikat; ?></h3>
            <p>Sertifikat Diterbitkan</p>
        </div>
    </div>
</div>

<!-- Quick Actions and Recent Activity -->
<div class="row">
    <!-- Quick Actions -->
    <div class="col-lg-6 mb-4">
        <div class="card-modern">
            <div class="card-header">
                <i class="fas fa-bolt"></i> Aksi Cepat
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <a href="?halaman=mahasiswa&hal=tambahdata" class="btn btn-primary-modern btn-block">
                            <i class="fas fa-user-plus"></i> Tambah Mahasiswa
                        </a>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <a href="?halaman=mahasiswa" class="btn btn-success-modern btn-block">
                            <i class="fas fa-envelope-open-text"></i> Kelola Surat & Files
                        </a>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <a href="?halaman=ulasan-mhs" class="btn btn-warning-modern btn-block">
                            <i class="fas fa-star"></i> Lihat Ulasan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="col-lg-6 mb-4">
        <div class="card-modern">
            <div class="card-header">
                <i class="fas fa-clock"></i> Aktivitas Terbaru
            </div>
            <div class="card-body">
                <?php if (mysqli_num_rows($query_recent) > 0): ?>
                    <div class="recent-activities">
                        <?php while ($recent = mysqli_fetch_assoc($query_recent)): ?>
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="activity-content">
                                    <strong>Mahasiswa Baru</strong><br>
                                    <small class="text-muted">
                                        Bidang: <?php echo $recent['nama_bidang'] ?? 'Tidak diketahui'; ?> | 
                                        Status: <span class="badge-modern badge-<?php echo strtolower($recent['status']) == 'aktif' ? 'success' : (strtolower($recent['status']) == 'selesai' ? 'info' : 'warning'); ?>">
                                            <?php echo $recent['status']; ?>
                                        </span>
                                    </small>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted mb-0"><i class="fas fa-info-circle"></i> Belum ada aktivitas terbaru</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- System Information -->
<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card-modern">
            <div class="card-header">
                <i class="fas fa-info-circle"></i> Informasi Sistem
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6">
                        <h6><i class="fas fa-calendar"></i> Tanggal Hari Ini</h6>
                        <p class="mb-3"><?php echo date('d F Y'); ?></p>
                        
                        <h6><i class="fas fa-clock"></i> Waktu Server</h6>
                        <p class="mb-3" id="server-time"><?php echo date('H:i:s'); ?> WITA</p>
                    </div>
                    <div class="col-sm-6">
                        <h6><i class="fas fa-database"></i> Status Database</h6>
                        <p class="mb-3">
                            <span class="badge-modern badge-success">
                                <i class="fas fa-check-circle"></i> Terhubung
                            </span>
                        </p>
                        
                        <h6><i class="fas fa-star"></i> Total Ulasan</h6>
                        <p class="mb-3"><?php echo $total_ulasan; ?> ulasan dari peserta magang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4 mb-4">
        <div class="card-modern">
            <div class="card-header">
                <i class="fas fa-sign-out-alt"></i> Keluar Sistem
            </div>
            <div class="card-body text-center">
                <p class="mb-3">Sudah selesai mengelola data?</p>
                <a href="logout.php" class="btn btn-danger-modern" onclick="return confirm('Yakin ingin logout?')">
                    <i class="fas fa-sign-out-alt"></i> Logout Sekarang
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.activity-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid #e9ecef;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #3498db 0%, #5dade2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    margin-right: 1rem;
    font-size: 0.9rem;
}

.activity-content {
    flex: 1;
}

.recent-activities {
    max-height: 300px;
    overflow-y: auto;
}
</style>

<script>
// Ambil timestamp server saat halaman dimuat (sudah WITA karena timezone PHP diset)
const serverEpochMs = <?php echo (new DateTime('now', new DateTimeZone('Asia/Makassar')))->getTimestamp() * 1000; ?>;

// Mulai dari waktu server (bukan waktu PC user) supaya sinkron
let now = new Date(serverEpochMs);

function pad2(n){ return n.toString().padStart(2, '0'); }

function renderClock() {
  const hh = pad2(now.getHours());
  const mm = pad2(now.getMinutes());
  const ss = pad2(now.getSeconds());
  const el = document.getElementById('server-time');
  if (el) el.textContent = `${hh}:${mm}:${ss} WITA`;
}

// Render awal
renderClock();

// Update tiap 1 detik (tambah 1000 ms ke waktu “server” lokal kita)
setInterval(() => {
  now = new Date(now.getTime() + 1000);
  renderClock();
}, 1000);
</script>
