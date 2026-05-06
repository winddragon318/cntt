@extends('layouts.teacher')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Lịch giảng dạy tổng thể</h6>
            <span class="badge badge-info">Dữ liệu từ Excel đã Import</span>
        </div>
        <div class="card-body">
            <!-- Khu vực hiển thị Calendar -->
            <div id="calendar"></div>
        </div>
    </div>
</div>

<!-- Thêm thư viện FullCalendar -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    console.log(calendarEl);
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'timeGridWeek,listWeek'
        },
        locale: 'vi',
        buttonText: {
            today: 'Hôm nay',
            week: 'Tuần',
            list: 'Danh sách'
        },
        allDaySlot: false,
        expandRows: true,
        contentHeight: 620,
        slotMinTime: '07:00:00',
        slotMaxTime: '22:00:00',
        slotDuration: '05:00:00',
        slotLabelContent: function(arg) {
            const hour = arg.date.getHours();
            if (hour === 7) return { html: '<b>Ca sáng</b>' };
            if (hour === 12) return { html: '<b>Ca chiều</b>' };
            if (hour === 17) return { html: '<b>Ca tối</b>' };
            return { html: '' };
        },
        events: "/teacher/api/calendar-events",

        eventContent: function(arg) {
        let titleEl = document.createElement('div');
        titleEl.style.fontWeight = '700';
        titleEl.style.fontSize = '13px';
        titleEl.style.color = '#111111';
        titleEl.style.whiteSpace = 'normal';
        titleEl.innerHTML =
            (arg.event.extendedProps.course_name || arg.event.title) +
            '<br><small style="color:#111111;font-weight:700;">Lớp: ' + (arg.event.extendedProps.class_name || 'Chưa có lớp') + '</small>';

        return { domNodes: [titleEl] };
    },
        eventClick: function(info) {
            alert('Buổi thứ: ' + info.event.extendedProps.stt +
                  '\nCa: ' + (info.event.extendedProps.ca || 'Chưa chọn') +
                  '\nNội dung: ' + info.event.extendedProps.content +
                  '\nTổng giờ dạy: ' + info.event.extendedProps.hours);
        }
    });
    calendar.render();
});
</script>

<style>
    /* PC (>= 1025px) */
    #calendar {
        max-width: 100%;
        margin: 0 auto;
        height: 720px;
    }
    .fc-event { cursor: pointer; }
    .fc-event-title {
        white-space: normal !important;
        word-wrap: break-word;
        font-size: 0.85em;
        font-weight: 500;
        padding: 2px;
    }
    .fc-timegrid-slot-label-cushion {
        font-weight: 700;
        color: #1e3a8a;
    }
    .fc-timegrid-event {
        border-radius: 6px !important;
        background: #dbeafe !important;
        border: 1px solid #60a5fa !important;
        color: #111111 !important;
    }

    /* iPad (768px - 1024px) */
    @media (min-width: 768px) and (max-width: 1024px) {
        #calendar {
            height: 640px;
        }
        .fc .fc-toolbar {
            flex-wrap: wrap;
            gap: 8px;
        }
        .fc .fc-toolbar-title {
            font-size: 1rem;
        }
        .fc .fc-button {
            padding: 0.25rem 0.45rem;
            font-size: 0.8rem;
        }
    }

    /* Mobile (<= 767px) */
    @media (max-width: 767px) {
        #calendar {
            height: 560px;
        }
        .fc .fc-toolbar {
            align-items: flex-start;
        }
        .fc .fc-toolbar-chunk {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        .fc .fc-toolbar-title {
            font-size: 0.95rem;
        }
        .fc-timegrid-slot-label-cushion {
            font-size: 12px;
        }
        .fc-timegrid-event .fc-event-main,
        .fc-timegrid-event .fc-event-title {
            font-size: 12px !important;
            line-height: 1.25;
        }
        .fc .fc-scroller {
            -webkit-overflow-scrolling: touch;
        }
    }
</style>
@endsection
