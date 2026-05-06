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
        titleEl.style.fontWeight = 'bold';
        titleEl.style.fontSize = '13px';
        titleEl.style.whiteSpace = 'normal';
        titleEl.innerHTML = arg.event.title + '<br><small>Ca: ' + (arg.event.extendedProps.ca || 'chưa chọn') + '</small>';

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
    #calendar {
        max-width: 100%;
        margin: 0 auto;
        height: 700px;
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
    }
</style>
@endsection
