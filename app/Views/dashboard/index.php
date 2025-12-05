<h2>Dashboard</h2>

<div class="card">
    <h3>Ringkasan</h3>
    <p>Jumlah Event: <?= esc($count_events) ?></p>
    <p>Jumlah Pendaftaranmu: <?= esc($count_pendaftaran) ?></p>
</div>

<div class="card">
    <h3>Notifikasi Terbaru</h3>
    <?php if(empty($notifikasi)): ?>
        <p>Tidak ada notifikasi.</p>
    <?php else: ?>
        <?php foreach($notifikasi as $n): ?>
            <div class="notif-box">
                <div><?= esc($n['pesan']) ?></div>
                <div class="notif-date"><?= esc($n['tanggal']) ?></div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
