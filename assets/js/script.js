/* ============================================================
   TaskManager — Global Scripts
   ============================================================ */

(function () {
    'use strict';

    // Auto-dismiss flash alerts after 4 seconds
    document.addEventListener('DOMContentLoaded', function () {
        const alerts = document.querySelectorAll('#flash-container .alert');
        alerts.forEach(function (alert) {
            setTimeout(function () {
                const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            }, 4000);
        });
    });

})();
