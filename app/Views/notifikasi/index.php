<div class="notif-container">
    <h2>Notifikasi</h2>

    <?php if(empty($notif)): ?>
        <p>Tidak ada notifikasi.</p>
    <?php else: ?>
        <ul class="notif-list">
            <?php foreach($notif as $n): ?>
                <li class="<?= $n['status_baca'] == 'unread' ? 'unread' : '' ?>">
                    <div><?= esc($n['pesan']) ?></div>

                    <span class="tanggal">
                        <?= date('d M Y H:i', strtotime($n['tanggal'])) ?>
                    </span>

                    <div class="notif-actions">
                        <a class="btn btn-sm btn-primary"
                           href="/notifikasi/markRead/<?= $n['id_notifikasi'] ?>">
                           Tandai dibaca
                        </a>

                        <a class="btn btn-sm btn-danger"
                           href="/notifikasi/delete/<?= $n['id_notifikasi'] ?>"
                           onclick="return confirm('Hapus notifikasi?')">
                           Hapus
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>