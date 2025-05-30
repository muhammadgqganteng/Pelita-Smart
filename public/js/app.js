import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
const agendaData = {
    '2025-05-06': ['Ujian Matematika', 'Presentasi Proyek RPL'],
    '2025-05-10': ['Kegiatan Pramuka', 'Pengumpulan Tugas Sejarah'],
    '2025-05-12': ['Rapat OSIS'],
};

function formatDateKey(year, month, day) {
    return `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
}

function updateAgenda(day) {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const dateKey = formatDateKey(year, month, day);
    const list = document.getElementById('agenda-list');

    const agenda = agendaData[dateKey];

    if (agenda && agenda.length > 0) {
        list.innerHTML = agenda.map(item => `<li>${item}</li>`).join('');
    } else {
        list.innerHTML = '<li>Tidak ada agenda</li>';
    }
}

function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    const firstDayOfMonth = new Date(year, month, 1);
    const lastDayOfMonth = new Date(year, month + 1, 0);
    const totalDays = lastDayOfMonth.getDate();
    const firstDayIndex = firstDayOfMonth.getDay();

    currentMonthYear.textContent = new Intl.DateTimeFormat('id-ID', {
        month: 'long',
        year: 'numeric',
    }).format(currentDate);

    let days = '';

    for (let x = firstDayIndex; x > 0; x--) {
        days += `<div class="empty">${''}</div>`;
    }

    for (let i = 1; i <= totalDays; i++) {
        const isToday =
            year === new Date().getFullYear() &&
            month === new Date().getMonth() &&
            i === new Date().getDate();

        days += `<div class="${isToday ? 'today' : ''}" data-day="${i}">${i}</div>`;
    }

    const remainingDays = 7 - ((firstDayIndex + totalDays) % 7);
    if (remainingDays < 7) {
        for (let j = 0; j < remainingDays; j++) {
            days += `<div class="empty"></div>`;
        }
    }

    daysContainer.innerHTML = days;

    // Event click untuk setiap tanggal
    document.querySelectorAll('.days div:not(.empty)').forEach(dayEl => {
        dayEl.addEventListener('click', () => {
            const day = parseInt(dayEl.dataset.day);
            updateAgenda(day);
        });
    });

    // Default: tampilkan agenda hari ini
    if (year === new Date().getFullYear() && month === new Date().getMonth()) {
        updateAgenda(new Date().getDate());
    } else {
        document.getElementById('agenda-list').innerHTML = '<li>Tidak ada agenda</li>';
    }
}
