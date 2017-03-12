<script>

    $(document).ready(function () {

        $('#calendar').fullCalendar({
            defaultDate: '<?php echo date("Y-m-d"); ?>',
            editable: false,
            eventLimit: false,
            events: [
            <?php foreach ($tasks as $task): ?>
                {
                    title: '<?php echo $task['name']; ?>',
                    url: '<?php echo base_url() . 'task/' . $task['id'] ?>',
                    start: '<?php echo $task['date_start']; ?>',
                    end: '<?php echo $task['date_stop']; ?>'
                },
            <?php endforeach; ?>
            ]
        });

    });

</script>
<div id='calendar'></div>

