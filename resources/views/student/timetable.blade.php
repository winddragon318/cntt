@extends('layouts.student')

@section('content')
<div class="timetable-page">
    <div class="tt-header">
        <h4 class="mb-0 fw-bold">Lịch học / Lịch thi</h4>
    </div>

    <div class="tt-control card border-0 shadow-sm mb-3">
        <div class="card-body">
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                <div class="d-flex gap-2 align-items-center flex-wrap">
                    <select id="yearSelect" class="form-select form-select-sm control-select"></select>
                    <select id="weekSelect" class="form-select form-select-sm control-select"></select>
                </div>
                <div class="view-switch" role="group" aria-label="View mode">
                    <button class="view-btn active" data-view="day">Ngày</button>
                    <button class="view-btn" data-view="week">Tuần</button>
                    <button class="view-btn" data-view="month">Tháng</button>
                </div>
            </div>
            <div id="weekDays" class="week-days mt-3"></div>
        </div>
    </div>

    <div id="scheduleList" class="schedule-list"></div>
</div>

<template id="scheduleCardTemplate">
    <div class="schedule-card">
        <div class="schedule-main">
            <div class="course-name"></div>
            <div><span>Tiết:</span> <strong class="period"></strong></div>
            <div><span>Giờ:</span> <strong class="time"></strong></div>
            <div><span>Phòng:</span> <strong class="room"></strong></div>
            <div><span>Giảng viên:</span> <strong class="teacher"></strong></div>
        </div>
    </div>
</template>

<script>
(() => {
    const scheduleList = document.getElementById('scheduleList');
    const weekDays = document.getElementById('weekDays');
    const yearSelect = document.getElementById('yearSelect');
    const weekSelect = document.getElementById('weekSelect');
    const viewBtns = document.querySelectorAll('.view-btn');
    const cardTemplate = document.getElementById('scheduleCardTemplate');

    let events = [];
    let currentView = 'week';
    const today = new Date();
    let selectedDate = new Date(today);

    function formatDateISO(date) {
        const y = date.getFullYear();
        const m = String(date.getMonth() + 1).padStart(2, '0');
        const d = String(date.getDate()).padStart(2, '0');
        return `${y}-${m}-${d}`;
    }

    function startOfWeek(date) {
        const d = new Date(date);
        const day = d.getDay();
        const diff = day === 0 ? -6 : 1 - day;
        d.setDate(d.getDate() + diff);
        d.setHours(0, 0, 0, 0);
        return d;
    }

    function getWeekDates(baseDate) {
        const start = startOfWeek(baseDate);
        return Array.from({ length: 7 }, (_, i) => {
            const d = new Date(start);
            d.setDate(start.getDate() + i);
            return d;
        });
    }

    function getWeekNumber(date) {
        const tmp = new Date(Date.UTC(date.getFullYear(), date.getMonth(), date.getDate()));
        const dayNum = tmp.getUTCDay() || 7;
        tmp.setUTCDate(tmp.getUTCDate() + 4 - dayNum);
        const yearStart = new Date(Date.UTC(tmp.getUTCFullYear(), 0, 1));
        return Math.ceil((((tmp - yearStart) / 86400000) + 1) / 7);
    }

    function renderWeekDays() {
        const labels = ['Th 2', 'Th 3', 'Th 4', 'Th 5', 'Th 6', 'Th 7', 'CN'];
        const days = getWeekDates(selectedDate);
        weekDays.innerHTML = '';

        days.forEach((date, idx) => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'day-item' + (formatDateISO(date) === formatDateISO(selectedDate) ? ' active' : '');
            btn.innerHTML = `<small>${labels[idx]}</small><strong>${String(date.getDate()).padStart(2, '0')}</strong>`;
            btn.addEventListener('click', () => {
                selectedDate = date;
                renderWeekDays();
                renderSchedules();
            });
            weekDays.appendChild(btn);
        });
    }

    function renderSchedules() {
        const selectedISO = formatDateISO(selectedDate);
        let filtered = [];

        if (currentView === 'day') {
            filtered = events.filter(item => item.date === selectedISO);
        } else if (currentView === 'week') {
            const weekSet = new Set(getWeekDates(selectedDate).map(d => formatDateISO(d)));
            filtered = events.filter(item => weekSet.has(item.date) && item.date === selectedISO);
        } else {
            const y = selectedDate.getFullYear();
            const m = selectedDate.getMonth();
            filtered = events.filter(item => {
                const d = new Date(item.date);
                return d.getFullYear() === y && d.getMonth() === m;
            });
        }

        scheduleList.innerHTML = '';

        if (!filtered.length) {
            const empty = document.createElement('div');
            empty.className = 'empty-box';
            empty.innerHTML = `Không có dữ liệu vào ngày <strong>${selectedISO}</strong>`;
            scheduleList.appendChild(empty);
            return;
        }

        filtered.forEach(item => {
            const node = cardTemplate.content.cloneNode(true);
            node.querySelector('.course-name').textContent = item.course_name;
            node.querySelector('.period').textContent = item.period;
            node.querySelector('.time').textContent = item.time;
            node.querySelector('.room').textContent = item.classroom;
            node.querySelector('.teacher').textContent = item.teacher_names || 'Chưa cập nhật';
            scheduleList.appendChild(node);
        });
    }

    function bindControls() {
        viewBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                viewBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                currentView = btn.dataset.view;
                renderSchedules();
            });
        });

        yearSelect.addEventListener('change', () => {
            const y = Number(yearSelect.value);
            selectedDate.setFullYear(y);
            renderWeekDays();
            renderSchedules();
        });

        weekSelect.addEventListener('change', () => {
            const w = Number(weekSelect.value);
            const y = Number(yearSelect.value);
            const firstDay = new Date(y, 0, 1 + (w - 1) * 7);
            selectedDate = startOfWeek(firstDay);
            renderWeekDays();
            renderSchedules();
        });
    }

    function setupSelectors() {
        const currentYear = today.getFullYear();
        for (let y = currentYear - 1; y <= currentYear + 1; y++) {
            const option = new Option(String(y), String(y), y === currentYear, y === currentYear);
            yearSelect.add(option);
        }
        for (let w = 1; w <= 53; w++) {
            const option = new Option(`Tuần ${w}`, String(w), w === getWeekNumber(today), w === getWeekNumber(today));
            weekSelect.add(option);
        }
    }

    async function init() {
        setupSelectors();
        bindControls();
        renderWeekDays();

        const res = await fetch("{{ route('student.api.timetable-events') }}");
        events = await res.json();
        renderSchedules();
    }

    init();
})();
</script>

<style>
    .tt-header {
        background: #0d6efd;
        color: #fff;
        border-radius: 12px;
        padding: 12px 16px;
        margin-bottom: 12px;
    }
    .control-select {
        min-width: 110px;
    }
    .view-switch {
        display: inline-flex;
        background: #f1f5f9;
        border-radius: 10px;
        overflow: hidden;
    }
    .view-btn {
        border: 0;
        background: transparent;
        padding: 7px 14px;
        color: #64748b;
        font-weight: 600;
    }
    .view-btn.active {
        background: #0d6efd;
        color: #fff;
    }
    .week-days {
        display: grid;
        grid-template-columns: repeat(7, minmax(0, 1fr));
        gap: 8px;
    }
    .day-item {
        border: 1px solid #dbe3ef;
        background: #fff;
        border-radius: 10px;
        padding: 8px 4px;
        display: flex;
        flex-direction: column;
        align-items: center;
        color: #334155;
    }
    .day-item.active {
        background: #0d6efd;
        border-color: #0d6efd;
        color: #fff;
    }
    .schedule-card {
        border: 1px solid #d5e3f5;
        border-left: 5px solid #10b981;
        border-radius: 12px;
        padding: 12px;
        margin-bottom: 12px;
        background: #fff;
    }
    .course-name {
        font-weight: 700;
        font-size: 1.05rem;
        margin-bottom: 8px;
    }
    .schedule-main div {
        margin-bottom: 4px;
        color: #64748b;
    }
    .schedule-main strong {
        color: #0f172a;
    }
    .empty-box {
        text-align: center;
        background: #fff;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        padding: 30px 12px;
        color: #475569;
    }

    /* PC */
    @media (min-width: 1025px) {
        .tt-control .card-body {
            padding: 16px 18px;
        }
    }
    /* iPad */
    @media (min-width: 768px) and (max-width: 1024px) {
        .tt-header h4 { font-size: 1.2rem; }
        .week-days { gap: 6px; }
    }
    /* Mobile */
    @media (max-width: 767px) {
        .tt-header { border-radius: 10px; padding: 10px 12px; }
        .tt-header h4 { font-size: 1.15rem; }
        .tt-control .card-body { padding: 12px; }
        .control-select { min-width: 95px; font-size: 0.86rem; }
        .view-btn { padding: 6px 10px; font-size: 0.86rem; }
        .week-days { gap: 5px; }
        .day-item { border-radius: 8px; padding: 7px 2px; }
        .course-name { font-size: 0.98rem; }
        .schedule-main div { font-size: 0.92rem; }
    }
</style>
@endsection

