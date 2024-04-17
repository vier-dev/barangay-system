$(document).ready(function () {
  
  showBlotter();
  showArchive();

  //initialize table
  let table = new DataTable("#myTable", {
    columnDefs: [
      {
        targets: 5,
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

  // for fetching/showing data to tb from db
  function showBlotter() {
    $.ajax({
      url: "serverBlotter.php?action=fetchData",
      dataType: "JSON",
      success: function (response) {
        
        var data = response.data;
        table.clear().draw();

        $.each(data, function (index, value) {
          table.row
            .add([
              value.blotter_id,
              value.defendant,
              value.complainant,
              value.incident_date,
              value.blotter_accusation,
              value.blotter_status,
              `<Button type="button" class="btn printBtn" value="${value.blotter_id}"><i class="fa fa-print fa-lg" style="color:  #154dd1;"></i></Button>` +
              `<Button type="button" class="btn editBtn" value="${value.blotter_id}"><i class="fa-regular fa-pen-to-square fa-lg" style="color: #1B9C85;"></i></Button>` +
              '<Button type="button" class="btn deleteBtn" value="' + value.blotter_id + '"><i class="fa-regular fa-trash-can fa-lg" style="color: #e11919;"></i></Button>',
            ])
            .draw(false);
        });
      },
    });
  }

  // insert form
  // for inserting data to db
  $("#insertForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "serverBlotter.php?action=insertData",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (response) {
        var response = JSON.parse(response);

        if (response.statusCode == 200) {
          $("#modalOpen").modal("hide");
          $("#insertForm")[0].reset();
          $("#insertBtn").removeAttr("disabled");
          $("#successToast").toast("show");
          $("#successMsg").html(response.message);

          showBlotter();

        } else if (response.statusCode == 500) {
          $("#modalOpen").modal("hide");
          $("#insertForm")[0].reset();
          $("#insertBtn").removeAttr("disabled");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
          
        } else if (response.statusCode == 400) {
          $("#insertBtn").removeAttr("disabled");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        }
      },
    });
  });

  //function to fetch each data on row from tb
  $("#myTable").on("click", ".editBtn", function () {
    var id = $(this).val();

    $.ajax({
      url: "serverBlotter.php?action=fetchSingle",
      method: "POST",
      dataType: "JSON",
      data: {
        id: id,
      },
      success: function (response) {
        var data = response.data;

        $("#updateForm #id").val(data.blotter_id);
        $("#updateForm #defendant").val(data.defendant);
        $("#updateForm #complainant").val(data.complainant);
        $("#updateForm #accusation").val(data.blotter_accusation);
        $("#updateForm input[name='incident_date']").val(data.incident_date);
        $("#updateForm input[name='date_file']").val(data.date_filed);
        $("#updateForm #status").val(data.blotter_status);

        $("#modalUpdate").modal("show");

      },
    });
  });

  // function to update data in database
  $("#updateForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "serverBlotter.php?action=updateData",
      method: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (response) {
        var response = JSON.parse(response);

        if (response.statusCode == 200) {
          $("#modalUpdate").modal("hide");
          $("#updateForm")[0].reset();
          $("#updateBtn").removeAttr("disabled");
          $("#successToast").toast("show");
          $("#successMsg").html(response.message);

          showBlotter();
        } else if (response.statusCode == 500) {
          $("#modalUpdate").modal("hide");
          $("#updateForm")[0].reset();
          $("#updateBtn").removeAttr("disabled");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        } else if (response.statusCode == 400) {
          $("#updateBtn").removeAttr("disabled");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        }
      },
    });
  });

  // function to delete data
  $("#myTable").on("click", ".deleteBtn", function () {
    $("#modalDelete").modal("show");

    var id = $(this).val();

    $(document).on("click", "#delete", function () {
      $.ajax({
        url: "serverBlotter.php?action=deleteData",
        method: "POST",
        dataType: "JSON",
        data: { id, id },
        success: function (response) {
          if (response.statusCode == 200) {
            showBlotter();

            $("#modalDelete").modal("hide");
            $("#successToast").toast("show");
            $("#successMsg").html(response.message);
          } else if (response.statusCode == 500) {
            $("#errorToast").toast("show");
            $("#errorMsg").html(response.message);
          }
        },
      });
    });
  });


  // function to print data
  $("#myTable").on("click", ".printBtn", function () {

    var id = $(this).val();

      $.ajax({
        url: "serverBlotter.php?action=printData",
        method: 'POST',
        dataType: 'JSON',
        data: {
            id: id
        },
        success: function(response) {

            var response = response.data;
            
            // Redirect to the target page with fetched data as URL parameters
            var queryString = $.param(response);
            window.location.href = 'blotterPrint.php?id=' + queryString;

        }
    });
  });
});



// for archive data
//initialize archive table
let table = new DataTable("#archiveTable", {
  //adjust the number of data shown in each page
  pageLength: 6,

  columnDefs: [
    {
      targets: 5,
      //color data for status
      render: function (data) {
        if (data === "Settled") {
          return `<span style="color: green;"> ${data} </span>`;
        } else {
          return data;
        }
      },
    },
  ],
});

// for fetching/showing archive data to tb from db
function showArchive() {
  $.ajax({
    url: "serverBlotter.php?action=fetchArchiveData",
    method: "POST",
    dataType: "JSON",
    success: function (response) {
      var data = response.data;
      table.clear().draw();

      $.each(data, function (index, value) {
        table.row
          .add([
            value.blotter_id,
            value.defendant,
            value.complainant,
            value.blotter_accusation,
            value.date_filed,
            value.blotter_status,
          ])
          .draw(false);
      });
    },
  });
}
