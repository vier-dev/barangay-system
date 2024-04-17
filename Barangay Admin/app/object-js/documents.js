$(document).ready(function () {

    showQueries();

    let table = new DataTable("#documentTable", {

        "order": [[ 0, "DESC" ]],

        columnDefs: [{
            targets: 0,
            render: function(data) {
                if(data === 'Pending') {
                    return `<span style="color: red; "> ${data} </span>`;
                } 
                else if(data === 'On Process') {
                    return `<span style="color: orange;"> ${data} </span>`;
                }
                else if(data === 'Approved') {
                    return `<span style="color: green;"> ${data} </span>`;
                }
            }
        }]
    });

    function showQueries() {
        $.ajax({
            url: "serverDocuments.php?action=fetchData",
            method: "POST",
            dataType: "json",
            success: function(response) {
                var data = response.data;
                table.clear().draw();

                $.each(data, function(index, value) {
                    table.row
                    .add([
                        value.status,
                        value.name,
                        value.subject,
                        value.purpose,
                        value.date,
                        '<Button type="button" class="btn viewBtn" value="' + value.document_id + '"style="color: #154dd1;">View</Button>' +
                        '<Button type="button" class="btn editBtn" value="' + value.document_id + '"><i class="fa-regular fa-pen-to-square fa-lg" style="color: #1B9C85;"></i></Button>' +
                        '<Button type="button" class="btn deleteBtn" value="' + value.document_id + '"><i class="fa-regular fa-trash-can fa-lg" style="color: #e11919;"></i></Button>',
                      ]).draw(false);
                });
            }
        });
    }


    // function to insert data to database
    $("#insertForm").on("submit", function(e) {
    $("#insertBtn").attr("disabled", "disabled");
    e.preventDefault();

    $.ajax({
        url: "serverDocuments.php?action=insertData",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) 
        {

            var response = JSON.parse(response);

            if (response.statusCode == 200) {
                $("#modalAdd").modal("hide");
                $("#insertBtn").removeAttr("disabled");
                $("#insertForm")[0].reset();
                $("#successToast").toast("show");
                $("#successMsg").html(response.message);

                showQueries();
            } 
        
            else if(response.statusCode == 500) {
                $("#modalAdd").modal("hide");
                $("#insertBtn").removeAttr("disabled");
                $("#insertForm")[0].reset();
                $("#errorToast").toast("show");
                $("#errorMsg").html(response.message);
            } 
        
            else if(response.statusCode == 400) {

                $("#insertBtn").removeAttr("disabled");
                $("#errorToast").toast("show");
                $("#errorMsg").html(response.message);
            }
        }
    });
});


    $('#documentTable').on('click', '.editBtn', function(){

        var id = $(this).val();

        $.ajax({
            url: "serverDocuments.php?action=fetchSingle",
            method: "POST",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(response) {
                var data = response.data;

                $("#updateForm #id").val(data.document_id);
                $("#updateForm select[name='name']").val(data.name);
                $("#updateForm select[name='subject']").val(data.subject);
                $("#updateForm input[name='date']").val(data.date);
                $("#updateForm #purpose").val(data.purpose);

                if (data.status === "Pending") {
                    $("#updateForm input[name='status'][value='Pending']").attr("checked", true);
                } else if(data.status === "On Process") {
                    $("#updateForm input[name='status'][value='On Process']").attr("checked", true);          
                } else if(data.status === "Approved") {
                    $("#updateForm input[name='status'][value='Approved']").attr("checked", true);          
                }

                if (data.document_fee === "25") {
                    $("#updateForm input[name='fee'][value='25']").attr("checked", true);
                } else if(data.document_fee === "50") {
                    $("#updateForm input[name='fee'][value='50']").attr("checked", true);          
                } else if(data.document_fee === "75") {
                    $("#updateForm input[name='fee'][value='75']").attr("checked", true);          
                } else if(data.document_fee === "100") {
                    $("#updateForm input[name='fee'][value='100']").attr("checked", true);          
                } else if(data.document_fee === "125") {
                    $("#updateForm input[name='fee'][value='125']").attr("checked", true);          
                } else if(data.document_fee === "150") {
                    $("#updateForm input[name='fee'][value='150']").attr("checked", true);          
                }
                $("#modalUpdate").modal("show");
            }
        })
    })


    // function to update data in database
    $("#updateForm").on("submit", function(e) {
        $("#updateBtn").attr("disabled", "disabled");
        e.preventDefault();
        $.ajax({
            url: "serverDocuments.php?action=updateData",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {

                var response = JSON.parse(response);

                if (response.statusCode == 200) {

                  $("#modalUpdate").modal("hide");
                  $("#updateBtn").removeAttr("disabled");
                  $("#updateForm")[0].reset();
                  $("#successToast").toast("show");
                  $("#successMsg").html(response.message);

                  showQueries();

                } else if(response.statusCode == 500) {

                  $("#modalUpdate").modal("hide");
                  $("#updateBtn").removeAttr("disabled");
                  $("#updateForm")[0].reset();
                  $("#errorToast").toast("show");
                  $("#errorMsg").html(response.message);

                } else if(response.statusCode == 400) {

                  $("#updateBtn").removeAttr("disabled");
                  $("#errorToast").toast("show");
                  $("#errorMsg").html(response.message);
                }
            }
        });
    });


    // function to delete data
    $('#documentTable').on('click', '.deleteBtn', function(){
    
        $('#modalDelete').modal('show');

        var id = $(this).val();
        
        $(document).on('click', '#delete', function(){

            $.ajax({
                url: 'serverDocuments.php?action=deleteData',
                method: 'POST',
                dataType: 'JSON',
                data :{id, id},
                success: function(response) {
                    if (response.statusCode == 200) {

                        showQueries();

                        $('#modalDelete').modal('hide');
                        $("#successToast").toast("show");
                        $("#successMsg").html(response.message);

                    } else if(response.statusCode == 500) {

                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);
                    }
                }
            });
        });
    });

    
    //for printing data
    //redirecting data to form on another page
    $('#documentTable').on('click', '.viewBtn', function() {
        var id = $(this).val();

        $.ajax({
            url: 'serverDocuments.php?action=viewData',
            method: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            success: function(response) {

                var response = response.data;
                
                // Redirect to the target page with fetched data as URL parameters
                var queryString = $.param(response);
                window.location.href = 'documentsView.php?id=' + queryString;

            }
        });
    });
})