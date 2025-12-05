<h2>Notifikasi</h2>

<?php if(empty($notif)): ?>
    <p>Tidak ada notifikasi.</p>
<?php else: ?>
    <?php foreach($notif as $n): ?>
        <div class="notif-box">
            <div><?= esc($n['pesan']) ?></div>
            <div class="notif-date"><?= esc($n['tanggal']) ?></div>
            <div style="margin-top:8px;">
                <a class="btn btn-danger" href="/notifikasi/delete/<?= $n['id_notifikasi'] ?>" onclick="return confirm('Hapus notifikasi?')">Hapus</a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
