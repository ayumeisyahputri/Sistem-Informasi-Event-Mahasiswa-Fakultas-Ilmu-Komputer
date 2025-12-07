document.addEventListener('DOMContentLoaded', function () {

    
    // Confirm delete generic
    
    document.querySelectorAll('.btn-delete, .delete-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {
            if (!confirm("Apakah Anda yakin ingin menghapus?")) {
                e.preventDefault();
            }
        });
    });

    
    // Auto-hide notification box
    
    const notifBoxes = document.querySelectorAll('.notif-box');
    notifBoxes.forEach(box => {
        setTimeout(() => {
            box.style.opacity = "0";
            box.style.transition = "0.5s";
            setTimeout(() => box.remove(), 500);
        }, 3500);
    });

    
    // Modal logout (Bootstrap)
    const logoutBtn = document.querySelector('.logout-btn');

    if(logoutBtn){
        logoutBtn.addEventListener('click', function(e){
            // biar tidak pindah link
            e.preventDefault();
        });
    }
});