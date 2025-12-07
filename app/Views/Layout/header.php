<!doctype html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Event Mahasiswa</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="navbar">
    <div class="logo">Event Mahasiswa</div>
    <div class="menu">
        <a href="/dashboard">Dashboard</a>
        <a href="/event">Event</a>
        <a href="/pendaftaran">Pendaftaran</a>
        <a href="/notifikasi">Notifikasi</a>
        <a href="/mahasiswa">Mahasiswa</a>
        <a href="/logout">Logout</a>
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
