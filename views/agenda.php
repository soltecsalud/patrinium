<!DOCTYPE html>
<html>
<head>
  <link href='fullcalendar/main.css' rel='stylesheet' />
  <script src='fullcalendar/main.js'></script>
  <!-- ... otras inclusiones ... -->
  <link href='https://unpkg.com/fullcalendar/main.min.css' rel='stylesheet' />
  <script src='https://unpkg.com/fullcalendar/main.min.js'></script>
  <!-- ... más scripts ... -->
  <script>

    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        initialDate: '2024-04-11',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: [
          // Array de eventos o URL desde donde cargarlos
        ]
      });

      calendar.render();
    });

  </script>
</head>
<body>

  <div id='calendar'></div>

</body>
</html>
