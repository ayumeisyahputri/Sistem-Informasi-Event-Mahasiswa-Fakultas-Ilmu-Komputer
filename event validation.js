document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('eventForm') || document.getElementById('eventEditForm');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        const name = form.querySelector('input[name="nama_event"]').value.trim();
        const tanggal = form.querySelector('input[name="tanggal_event"]').value;
        const kapasitas = parseInt(form.querySelector('input[name="kapasitas"]').value, 10);

        let errors = [];

        if (!name || name.length < 3) errors.push('Nama event minimal 3 karakter.');
        if (!tanggal) errors.push('Tanggal event harus diisi.');
        else {
            const today = new Date();
            const eventDate = new Date(tanggal + 'T00:00:00');
            if (eventDate < new Date(today.getFullYear(), today.getMonth(), today.getDate())) {
                errors.push('Tanggal event harus hari ini atau di masa depan.');
            }
        }
        if (!Number.isInteger(kapasitas) || kapasitas <= 0) errors.push('Kapasitas harus angka > 0.');

        if (errors.length) {
            e.preventDefault();
            alert('Periksa form:\n- ' + errors.join('\n- '));
            return false;
        }
    });
});
