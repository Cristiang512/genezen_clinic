import './bootstrap';     // Mantén la importación de bootstrap si la necesitas
import Alpine from 'alpinejs';
import flatpickr from "flatpickr";  // Importa Flatpickr
import 'flatpickr/dist/flatpickr.css';  // Importa el archivo CSS de Flatpickr

window.Alpine = Alpine;

Alpine.start();

// Inicializa Flatpickr en los campos de entrada de hora (por ejemplo, para citas)
document.addEventListener("DOMContentLoaded", function() {
    flatpickr("#horaCita", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K",  // Formato de 12 horas con AM/PM
    });
});
