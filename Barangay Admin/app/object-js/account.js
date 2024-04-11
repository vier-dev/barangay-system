$('.phone').on('input', function(){
    this.value = this.value.replace(/[^0-9.]/g, '');
});

$(document).ready(function(){

    showUser();

    //initializing data table
    let table = new DataTable("#myTable", {
        
        //adjust the number of data shown in each page
        pageLength:6,

        columnDefs: [{
            targets: 3,
            render: function (data) {
                if(data === 'Admin') 
                {
                    return `<span style="color: #FF0060;"> ${data} </span>`;
                }
                else if(data === 'Staff') 
                {
                    return `<span style="color: #1B9C85;"> ${data} </span>`;
                }
                else 
                {
                    return data;
                }
            }
        }]
    });

      // function to insert data to database
    $("#insertForm").on("submit", function(e) {
        $("#insertBtn").attr("disabled", "disabled");
        e.preventDefault();
    
        $.ajax({
            url: "serverAccount.php?action=insertData",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) 
            {

                var response = JSON.parse(response);

                if (response.statusCode == 200) {
                    $("#modaRegisterUser").modal("hide");
                    $("#insertBtn").removeAttr("disabled");
                    $("#insertForm")[0].reset();
                    $("#successToast").toast("show");
                    $("#successMsg").html(response.message);
                    showUser();
                } 
            
                else if(response.statusCode == 500) {
                    $("#modaRegisterUser").modal("hide");
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

    
    // for fetching/showing data to tb from db
    function showUser(){

        $.ajax({
            url: "serverAccount.php?action=fetchData",
            method: "",
            dataType: "json",
            success: function(response) {
                var data = response.data;
                table.clear().draw();
                $.each(data, function(index, value) {
                    table.row.add([
                        value.id,
                        value.name,
                        value.email,
                        value.user_type,
                        `<Button type="button" class="btn editBtn" value=" ${value.id} "><i class="fa-regular fa-pen-to-square fa-lg" style="color: #1B9C85;"></i></Button>` +
                        `<Button type="button" class="btn deleteBtn" value=" ${value.id} "><i class="fa-regular fa-trash-can fa-lg" style="color: #e11919;"></i></Button>`,
                    ]).draw(false);
                });
            }
        });
    }

    
    //function to fetch each data on row from tb
    $("#myTable").on("click", ".editBtn", function() {
        var id = $(this).val();
        $.ajax({
            url: 'serverAccount.php?action=fetchSingle',
            type: "POST",
            dataType: "json",
            data: {
              id: id
            },
            success: function(response) {
                var data = response.data;
                $("#updateForm #id").val(data.id);
                $("#updateForm input[name='name']").val(data.name);
                $("#updateForm input[name='age']").val(data.age);
                $("#updateForm input[name='phone']").val(data.phone);
                $("#updateForm input[name='address']").val(data.address);
                $("#updateForm input[name='email']").val(data.email);
                $("#updateForm select[name='user_type']").val(data.user_type);

                $('#modalUpdateUser').modal('show');
            }
        });
    });


    // function to update data in database
    $("#updateForm").on("submit", function(e) {
        $("#updateBtn").attr("disabled", "disabled");
        e.preventDefault();
        $.ajax({
            url: "serverAccount.php?action=updateData",
            type: "POST",
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
                  $("#successToast").toast("show");
                  $("#successMsg").html(response.message);

                  showUser();

                } else if(response.statusCode == 500) {

                  $("#modalUpdateUser").modal("hide");
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
    $('#myTable').on('click', '.deleteBtn', function(){
    
        $('#modalDeleteUser').modal('show');

        var id = $(this).val();
        
        $(document).on('click', '#delete', function(){

            $.ajax({
                url: 'serverAccount.php?action=deleteData',
                method: 'POST',
                dataType: 'JSON',
                data :{id, id},
                success: function(response) {
                    if (response.statusCode == 200) {

                        showUser();
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
});