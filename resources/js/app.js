import './bootstrap';

import Alpine from 'alpinejs';
import './bootstrap';
import 'bootstrap';
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css"; // Import Flatpickr styles


window.Alpine = Alpine;

Alpine.start();



// Initialize Flatpickr on specific input field
flatpickr(".timePicker", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i",  // 24-hour format
    time_24hr: true     // Forces 24-hour time picker
});
