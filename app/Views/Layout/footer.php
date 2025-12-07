</div> <!-- end container -->

<footer style="text-align:center; padding:20px; color:#777;">
    &copy; <?= date('Y') ?> Sistem Informasi Event Mahasiswa
</footer>

<!-- BOOTSTRAP JS (perlu untuk modal di header) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- GLOBAL JS OPTIONAL -->
<?php if (file_exists(FCPATH . 'js/global.js')): ?>
<script src="/js/global.js"></script>
<?php endif; ?>

</body>
</html>