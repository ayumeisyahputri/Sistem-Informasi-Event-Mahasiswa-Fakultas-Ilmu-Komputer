<h2><?= esc($event['nama_event']) ?></h2>
<p><?= esc($event['deskripsi']) ?></p>
<p>Penyelenggara: <?= esc($event['penyelenggara']) ?></p>
<p>Deadline: <?= esc($event['deadline_pendaftaran']) ?></p>

<?php if(session()->get('role') != 'admin'): ?>
    <a class="btn btn-primary" href="/pendaftaran/create/<?= $event['id_event'] ?>">Daftar Event</a>
<?php endif; ?>
