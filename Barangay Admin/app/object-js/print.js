$(document).ready(function () {
    
    let backBtn = document.querySelector("#back");
    let printBtn = document.querySelector("#print");

    backBtn.addEventListener("click", function () {
        window.location.href = "blotter.php";
    });

    printBtn.addEventListener("click", function () {
        window.print();
    });


    // extracting data from url parameters
    var data = {};
    var queryString = window.location.search.substring();
    var queryParams = queryString.split('&');

    for (var i = 0; i < queryParams.length; i++) 
    {
        var param = queryParams[i].split('=');
        var key = param[0];
        var value = param[1];
        data[key] = decodeURIComponent(value).replace(/\+/g, " ");
    }

    $('#id').val(data.blotter_id);
    $('#defendant').val(data.defendant);
    $('#defendant_greetings').val(data.defendant);
    $('#complainant').val(data.complainant);
    $('#complainant_bottom').val(data.complainant);
    $('#blotter_accusation').val(data.blotter_accusation);
    $('#incident_date').val(data.incident_date);
    $('#date_filed').val(data.date_filed);
    $('#blotter_status').val(data.blotter_status);

});
