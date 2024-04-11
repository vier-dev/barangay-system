
$(document).ready(function(){

    showResidence();

    //initializing data table
    let table = new DataTable("#myTable", {
        
        //adjust the number of data shown in each page
        pageLength:6,

        
        columnDefs: [
            {
                targets:0,
                width: '70px',
                className: 'image-center'
            },
            {
                targets:2,
                width: '150px'
            },
            {
                targets:3,
                width: '150px'
            },
            {
                targets: 4,
                //color data for status
                render: function (data) {
                    if(data === 'Rented') 
                    {
                        return `<span style="color: red;"> ${data} </span>`;
                    }
                    else if(data === 'Permanent') 
                    {
                        return `<span style="color: green;"> ${data} </span>`;
                    }
                    else 
                    {
                        return data;
                    }
                },
                width: '150px'
            },
        ]
    });

    //function to preview image
    $("input.image").change(function() {
        var file = this.files[0];
        var url = URL.createObjectURL(file);
        $(this).closest(".row").find(".preview_img").attr("src", url);
      });

    
    // for fetching/showing data to tb from db
    function showResidence(){

        $.ajax({
            url: "serverResidence.php?action=fetchData",
            method: "POST",
            dataType: "JSON",
            success: function(response) {
                var data = response.data;
                table.clear().draw();
                $.each(data, function(index, value) {
                    table.row.add([
                        '<img src="uploads/' + value.image + '" style="width:35px;height:35px;border:2px solid gray;border-radius:50%;object-fit:cover;">',
                        value.full_name,
                        value.social_status,
                        value.phone,
                        value.resident_status,
                        '<Button type="button" class="btn readBtn" value="' + value.resident_id + '" style="color: #154dd1;">View</Button>' +
                        '<Button type="button" class="btn editBtn" value="' + value.resident_id + '"><i class="fa-regular fa-pen-to-square fa-lg" style="color: #1B9C85;"></i></Button>' +
                        '<Button type="button" class="btn deleteBtn" value="' + value.resident_id + '"><i class="fa-regular fa-trash-can fa-lg" style="color: #e11919;"></i></Button>' +
                        '<input type="hidden" class="delete_image" value="' + value.image + '">'
                    ]).draw(false);
                });
            }
        });
    }


    
    // for inserting data to db
    $("#insertForm").on("submit", function(e) {
        $("#insertBtn").attr("disabled", "disabled");
        e.preventDefault();

        $.ajax({
            url: "serverResidence.php?action=insertData",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) 
            {

                var response = JSON.parse(response);

                if (response.statusCode == 200) {
                    $("#modalRegisterUser").modal("hide");
                    $("#insertBtn").removeAttr("disabled");
                    $("#insertForm")[0].reset();
                    $(".preview_img").attr("src", "images/user-preview.png");
                    $("#successToast").toast("show");
                    $("#successMsg").html(response.message);

                    showResidence();
                } 
              
                else if(response.statusCode == 500) {
                    $("#modalRegisterUser").modal("hide");
                    $("#insertBtn").removeAttr("disabled");
                    $("#insertForm")[0].reset();
                    $(".preview_img").attr("src", "images/user-preview.png");
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


    //function to fetch each data on row from tb
    $('#myTable').on("click", ".editBtn", function() {
        var id = $(this).val();

        $.ajax({
            url: 'serverResidence.php?action=fetchSingle',
            method: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            success: function(response) {
                var data = response.data;
                $("#updateForm #id").val(data.resident_id);
                $("#updateForm input[name='full_name']").val(data.full_name);
                $("#updateForm input[name='birthday']").val(data.birthday);
                $("#updateForm input[name='address']").val(data.address);
                $("#updateForm input[name='phone']").val(data.phone);
                $("#updateForm select[name='social_status']").val(data.social_status);
                $("#updateForm select[name='religion']").val(data.religion);
                $("#updateForm .preview_img").attr("src", "uploads/" + data.image + "");
                $("#updateForm #image_old").val(data.image);

                if (data.gender === "Male") {
                    $("#updateForm input[name='gender'][value='Male']").attr("checked", true);
                  } else if(data.gender === "Female") {
                    $("#updateForm input[name='gender'][value='Female']").attr("checked", true);          
                  }

                  if (data.resident_status === "Rented") {
                    $("#updateForm input[name='resident_status'][value='Rented']").attr("checked", true);
                  } else if(data.resident_status === "Permanent") {
                    $("#updateForm input[name='resident_status'][value='Permanent']").attr("checked", true);          
                  }

                $('#modalUpdateUser').modal('show');
            }
        });
    });



    // function to update data in database
    $("#updateForm").on("submit", function(e) {
        $("#updateBtn").attr("disabled", "disabled");
        e.preventDefault();

        $.ajax({
            url: "serverResidence.php?action=updateData",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {

                var response = JSON.parse(response);

                if (response.statusCode == 200) {

                    $("#modalUpdateUser").modal("hide");
                    $("#updateBtn").removeAttr("disabled");
                    $("#updateForm")[0].reset();
                    $(".preview_img").attr("src", "images/user-preview.png");
                    $("#successToast").toast("show");
                    $("#successMsg").html(response.message);

                    showResidence();
                } 
                
                else if(response.statusCode == 500) {

                    $("#modalUpdateUser").modal("hide");
                    $("#updateBtn").removeAttr("disabled");
                    $("#updateForm")[0].reset();
                    $(".preview_img").attr("src", "images/user-preview.png");
                    $("#errorToast").toast("show");
                    $("#errorMsg").html(response.message);
                } 
                
                else if(response.statusCode == 400) {

                    $("#updateBtn").removeAttr("disabled");
                    $("#errorToast").toast("show");
                    $("#errorMsg").html(response.message);
                }
            }
        });
    });


    // function to delete data
    $('#myTable').on('click', '.deleteBtn', function(){
    
        $('#modalDeleteUser').modal('show');

        var id = $(this).val();
        var delete_image = $(this).closest("td").find(".delete_image").val();
        
        $(document).on('click', '#delete', function(){

            $.ajax({
                url: 'serverResidence.php?action=deleteData',
                method: 'POST',
                dataType: 'JSON',
                data :{id, delete_image},
                success: function(response) {
                    if (response.statusCode == 200) {

                        showResidence();

                        $('#modalDeleteUser').modal('hide');
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


    //for viewing data
    //redirecting data to form on another page
    $('#myTable').on('click', '.readBtn', function() {
        var id = $(this).val();

        $.ajax({
            url: 'serverResidence.php?action=viewData',
            method: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            success: function(response) {

                var response = response.data;
                
                // Redirect to the target page with fetched data as URL parameters
                const queryString = $.param(response);
                window.location.href = 'residenceView.php?id=' + queryString;

            }
        });
    });
});