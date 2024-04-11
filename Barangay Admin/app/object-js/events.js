$(document).ready(function(){

    // for scheduling events

    var calendar;
    var events = [];

    if (!!scheds) {
        Object.keys(scheds).map(key => {
            var row = scheds[key]
            events.push({ id: row.id, title: row.title, start: row.start_date, end: row.end_date });
        });
    }

    calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        headerToolbar: {
            left: 'prev,next today',
            right: 'dayGridMonth,dayGridWeek,list',
            center: 'title',
        },
        navLinks: true,
        businessHours: true,
        selectable: true,
        events: events,
        eventClick: function(info) {
            var _details = $('#event-details-modal')
            var id = info.event.id
            if (!!scheds[id]) {
                _details.find('#title').text(scheds[id].title)
                _details.find('#description').text(scheds[id].description)
                _details.find('#start').text(scheds[id].sdate)
                _details.find('#end').text(scheds[id].edate)
                _details.find('#edit,#delete').attr('data-id', id)
                _details.modal('show')
            } else {
                alert("Event is undefined");
            }
        },
        editable: true
    });

    calendar.render();

    // Form reset listener
    $('#schedule-form').on('reset', function() {
        $(this).find('input:hidden').val('')
        $(this).find('input:visible').first().focus()
    });

    // Edit Button
    $('#edit').click(function() {
        var id = $(this).attr('data-id')
        if (!!scheds[id]) {
            var _form = $('#schedule-form')
            console.log(String(scheds[id].start_date), String(scheds[id].start_date).replace(" ", "\\t"))
            _form.find('[name="id"]').val(id)
            _form.find('[name="title"]').val(scheds[id].title)
            _form.find('[name="description"]').val(scheds[id].description)
            _form.find('[name="start_date"]').val(String(scheds[id].start_date).replace(" ", "T"))
            _form.find('[name="end_date"]').val(String(scheds[id].end_date).replace(" ", "T"))
            $('#event-details-modal').modal('hide')
            _form.find('[name="title"]').focus()
        } else {
            alert("Event is undefined");
        }
    });

    // Delete Button / Deleting an Event
    $('#delete').on('click', function() {
        var id = $(this).attr('data-id');

        if (!!scheds[id]) {
            var _conf = confirm("Are you sure to delete this scheduled event?");
            if (_conf === true) {
                location.href = "./serverScheduleDelete.php?id=" + id;
            }
        } else {
            alert("Event is undefined");
        }
    });



    // for announcement section

    showAnnouncement();

    let table = new DataTable('#announcementTable', {
        //adjust the number of data shown in each page
        pageLength:4
    });

    function showAnnouncement() {
        $.ajax({
            url: 'serverAnnouncement.php?action=fetchData',
            method: "",
            dataType: "JSON",
            success: function (response) {

                var data = response.data;
                table.clear().draw();


                $.each(data, function (index, value) {
                    table.row
                      .add([
                        value.announcement_title,
                        value.announcement_description,
                        value.announcement_date
                    ])
                    .draw(false);
                });
            }
        });
    }


    $('#announcement-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: "serverAnnouncement.php?action=saveAnnouncement",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
              var response = JSON.parse(response);

                if (response.statusCode == 200) {
                    $("#announcement-form")[0].reset();
                    $("#insertBtn").removeAttr("disabled");
                    $("#successToast").toast("show");
                    $("#successMsg").html(response.message);
          
                    showAnnouncement();

                } else if (response.statusCode == 500) {

                    $("#announcement-form")[0].reset();
                    $("#insertBtn").removeAttr("disabled");
                    $("#errorToast").toast("show");
                    $("#errorMsg").html(response.message);

                } else if (response.statusCode == 400) {

                    $("#insertBtn").removeAttr("disabled");
                    $("#errorToast").toast("show");
                    $("#errorMsg").html(response.message);
                }
            }
        });
    });

});