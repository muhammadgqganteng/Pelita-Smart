// const currentMonthYear = document.getElementById('current-month-year');
// const daysContainer = document.querySelector('.days');
// const prevMonthBtn = document.getElementById('prev-month');
// const nextMonthBtn = document.getElementById('next-month');

// let currentDate = new Date();

// function renderCalendar() {
//     const year = currentDate.getFullYear();
//     const month = currentDate.getMonth();

//     const firstDayOfMonth = new Date(year, month, 1);
//     const lastDayOfMonth = new Date(year, month + 1, 0);
//     const totalDays = lastDayOfMonth.getDate();
//     const firstDayIndex = firstDayOfMonth.getDay(); // 0 (Minggu) - 6 (Sabtu)

//     const prevLastDay = new Date(year, month, 0).getDate();
//     const nextFirstDay = 1;

//     currentMonthYear.textContent = new Intl.DateTimeFormat('id-ID', { month: 'long', year: 'numeric' }).format(currentDate);

//     let days = '';

//     // Hari-hari dari bulan sebelumnya (untuk mengisi kekosongan di awal bulan)
//     for (let x = firstDayIndex; x > 0; x--) {
//         days += `<div class="empty">${prevLastDay - x + 1}</div>`;
//     }

//     // Hari-hari dari bulan ini
//     for (let i = 1; i <= totalDays; i++) {
//         const isToday = year === new Date().getFullYear() && month === new Date().getMonth() && i === new Date().getDate();
//         days += `<div class="${isToday ? 'today' : ''}">${i}</div>`;
//     }   

//     // Hari-hari dari bulan berikutnya (untuk mengisi kekosongan di akhir bulan)
//     const remainingDays = 7 - ((firstDayIndex + totalDays) % 7);
//     if (remainingDays < 7) {
//         for (let j = 0; j < remainingDays; j++) {
//             days += `<div class="empty">${nextFirstDay + j}</div>`;
//         }
//     }

//     daysContainer.innerHTML = days;
// }

// function prevMonth() {
//     currentDate.setMonth(currentDate.getMonth() - 1);
//     renderCalendar();
// }

// function nextMonth() {
//     currentDate.setMonth(currentDate.getMonth() + 1);
//     renderCalendar();
// }

// prevMonthBtn.addEventListener('click', prevMonth);
// nextMonthBtn.addEventListener('click', nextMonth);

// // Render kalender saat halaman pertama kali dimuat
// renderCalendar();
