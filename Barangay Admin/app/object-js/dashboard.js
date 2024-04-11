$(document).ready(function() {

    showAnnouncements();
    showPendingQueries();

    let documentTable = new DataTable("#documentTable", {
        pageLength: 4,

        columnDefs: [{
            targets: 4,
            render: function(data) {
                if(data === 'Pending') {
                    return `<span style="color: red; "> ${data} </span>`;
                } 
                else if(data === 'On Process') {
                    return `<span style="color: orange;"> ${data} </span>`;
                }
            }
        }]
    });

    function showPendingQueries() {
        $.ajax({
            url: "serverDashboard.php?action=fetchPending",
            method: "POST",
            dataType: "JSON",
            success: function (response) {
            var data = response.data;
            documentTable.clear().draw();

                $.each(data, function(index, value) {
                    documentTable.row
                    .add([
                        value.date,
                        value.name,
                        value.subject,
                        value.purpose,
                        value.status
                      ]).draw(false);
                });
            }
        });
    }


    // for announcement
    let announcementTable = new DataTable("#announcementTable", {
        pageLength: 4,
    });

    function showAnnouncements() {
        $.ajax({
            url: "serverDashboard.php?action=fetchAnnouncement",
            dataType: "JSON",
            success: function (response) {
            var data = response.data;
            announcementTable.clear().draw();

                $.each(data, function(index, value) {
                    announcementTable.row
                    .add([
                        value.announcement_date,
                        value.announcement_title
                      ]).draw(false);
                });
            }
        });
    }
})