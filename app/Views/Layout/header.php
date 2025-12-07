<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Event Mahasiswa</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/notifikasi.js"></script>
</head>

<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 10px;">
      
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Konfirmasi Logout</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        Apakah Anda yakin ingin logout?
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="/logout" class="btn btn-danger">Logout</a>
      </div>

    </div>
  </div>
</div>

<body>
<div class="navbar">
    <div class="logo">Event Mahasiswa</div>
    <div class="menu">
        <a href="/dashboard">Dashboard</a>
        <a href="/event">Event</a>
        <a href="/pendaftaran">Pendaftaran</a>

        <a href="/notifikasi">
            Notifikasi <span class="badge" id="notif-badge">0</span>
        </a>

        <a href="/mahasiswa">Mahasiswa</a>

        <!-- Logout modal trigger -->
        <a href="#" class="logout-btn" data-bs-toggle="modal" data-bs-target="#logoutModal">
            Logout
        </a>
    </div>
</div>

<div class="container">
<?php if(session()->getFlashdata('error')): ?>
    <div class="notif-box" style="border-left-color:#ff3b3b;">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('success')): ?>
    <div class="notif-box" style="border-left-color:#00a651;">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>