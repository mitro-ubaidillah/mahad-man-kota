/**
 * Smart City Scene - Auto Day/Night Toggle
 */
document.addEventListener('DOMContentLoaded', function () {
    var scene = document.getElementById('animated-bg');
    if (!scene) return;

    // Auto toggle setiap 12 detik
    var isNight = false;

    // Set awal berdasarkan waktu lokal
    var hour = new Date().getHours();
    if (hour >= 18 || hour < 6) {
        isNight = true;
        scene.classList.remove('day');
        scene.classList.add('night');
    }

    function toggle() {
        isNight = !isNight;
        if (isNight) {
            scene.classList.remove('day');
            scene.classList.add('night');
        } else {
            scene.classList.remove('night');
            scene.classList.add('day');
        }
    }

    setInterval(toggle, 12000);
});
