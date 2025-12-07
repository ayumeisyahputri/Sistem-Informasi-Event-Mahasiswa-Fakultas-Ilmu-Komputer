document.addEventListener('DOMContentLoaded', function() {

    function updateNotifBadge() {
        fetch('/notifikasi/countUnread')
            .then(res => res.json())
            .then(data => {
                const badge = document.getElementById('notif-badge');
                badge.textContent = data.count;

                // Badge SELALU terlihat
                badge.style.display = "inline-block";

                // Kalau 0, warnanya jadi abu-abu
                if (data.count == 0) {
                    badge.style.background = "#888";   // abu
                } else {
                    badge.style.background = "red";    // unread merah
                }
            });
    }

    updateNotifBadge();
    setInterval(updateNotifBadge, 60000); // update tiap 1 menit
});