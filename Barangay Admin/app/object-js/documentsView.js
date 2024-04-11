$(document).ready(function(){

    showDocumentHistory();

    let table = new DataTable("#viewTable", {
        pageLength: 6,
    
        columnDefs: [
                {
                    targets: 4,
                        //color data for status
                        render: function (data) {
                        if(data === 'Approved') {
                             return `<span style="color: green;"> ${data} </span>`;
                        } else {
                             return data;
                        }
                    },
                },
            ],
        });

        

    //Extracting data from URL parameters
    var data = {};
    var queryString = window.location.search.substring();
    var queryParams = queryString.split("&");

    for (var i = 0; i < queryParams.length; i++) 
    {
        var param = queryParams[i].split("=");
        var key = param[0];
        var value = param[1];
        data[key] = decodeURIComponent(value).replace(/\+/g, " ");
    }

    $("#id").val(data.document_id);
    $("#name").val(data.name);
    $("#subject").val(data.subject);
    $("#date").val(data.date);
    $("#purpose").val(data.purpose);
    $("#status").val(data.status);


    function showDocumentHistory() {

        $.ajax({
            url: 'serverDocuments.php?action=showDocumentHistory',
            method: 'GET',
            dataType: 'JSON',
            success: function(response){

                var data = response.data;
                table.clear().draw();

                $.each(data, function(index, value) {
                    table.row
                    .add([
                        value.name,
                        value.subject,
                        value.purpose,
                        value.date,
                        value.status,
                    ])
                    .draw(false);
                });
            }
        });
    }
})
