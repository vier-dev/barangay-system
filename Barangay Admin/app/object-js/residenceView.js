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
      const full_name = $('#full_name').val();
        
      $.get( 'serverResidenceView.php?=refreshBlotterHistory', { full_name: full_name }, function(results) {
        const tbody = $("#viewTable tbody")
        tbody.empty();

        for(var i = 0; i<results.length; i++) {
          var item = results[i]
          tbody.append("<tr>" +
          "<td>" + item.defendant + "</td>" +
          "<td>" + item.complainant + "</td>" +
          "<td>" + item.blotter_date + "</td>" +
          "<td>" + item.blotter_accusation + "</td>" +
          "<td>" + item.blotter_status + "</td>" +
          "</tr>")
        }
      })
    }

    // // Handle click event for refresh button
    // $('#refreshBtn').click(function() {
    //   // Retrieve blotter data from server-side script
    //   const full_name = $('#full_name').val();
        
    //   $.get( '/blotter', { full_name: full_name }, function(results) {
    //     const tbody = $("#viewTable tbody")
    //     tbody.empty();

    //     for(var i = 0; i<results.length; i++) {
    //       var item = results[i]
    //       tbody.append("<tr>" +
    //       "<td>" + item.blotter_date + "</td>" +
    //       "<td>" + item.blotter_accusation + "</td>" +
    //       "</tr>")
    //     }
    //   })
    //});

    


});
