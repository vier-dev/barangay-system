$(document).ready(function () {

  showBlotter();

  let table = new DataTable("#viewTable", {
    pageLength: 6,

    columnDefs: [
        {
            targets: 4,
                //color data for status
                render: function (data) {
                if (data === "Settled") {
                return `<span style="color: green;"> ${data} </span>`;
                } else if (data === "Active") {
                return `<span style="color: red;"> ${data} </span>`;
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

    $("#id").val(data.resident_id);
    $("#full_name").val(data.full_name);
    $("#gender").val(data.gender);
    $("#birthday").val(data.birthday);
    $("#address").val(data.address);
    $("#social_status").val(data.social_status);
    $("#phone").val(data.phone);
    $("#religion").val(data.religion);
    $("#resident_status").val(data.resident_status);

    // Set the src attribute of the image element
    $("#preview_img").attr("src", "uploads/" + data.image);

    
    //blotter history
    function showBlotter() {
      $.ajax({
        url: "serverResidence.php?action=blotterHistory",
        dataType: "JSON",
        success: function (response) {
          
          var data = response.data;
          table.clear().draw();
  
          $.each(data, function (index, value) {
            table.row
              .add([
                value.defendant,
                value.complainant,
                value.blotter_accusation,
                value.date_filed,
                value.blotter_status
              ])
              .draw(false);
          });
        },
      });
    }
});
