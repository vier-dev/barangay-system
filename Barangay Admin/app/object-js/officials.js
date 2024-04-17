
$(document).ready(function(){

    showOfficial();

    //initializing data table
    let table = new DataTable("#myTable", {
        
        //adjust the number of data shown in each page
        pageLength:6,

        columnDefs:[{
            targets:0,
            className: 'image-center'
        }]
    });

    //function to preview image
    $("input.image").change(function() {
        var file = this.files[0];
        var url = URL.createObjectURL(file);
        $(this).closest(".row").find(".preview_img").attr("src", url);
      });

    
    // for fetching/showing data to tb from db
    function showOfficial(){

        $.ajax({
            url: "serverOfficials.php?action=fetchData",
            method: "POST",
            dataType: "JSON",
            success: function(response) {
                var data = response.data;
                table.clear().draw();
                $.each(data, function(index, value) {
                    table.row.add([
                        '<img src="uploads/' + value.image + '" style="width:35px;height:35px;border:2px solid gray;border-radius:50%;object-fit:cover;">',
                        value.name,
                        value.gender,
                        value.position,
                        '<Button type="button" class="btn editBtn" value="' + value.official_id + '"><i class="fa-regular fa-pen-to-square fa-lg" style="color: #1B9C85;"></i></Button>' +
                        '<Button type="button" class="btn deleteBtn" value="' + value.official_id + '"><i class="fa-regular fa-trash-can fa-lg" style="color: #e11919;"></i></Button>' +
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
            url: "serverOfficials.php?action=insertData",
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

                    showOfficial();
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
            url: 'serverOfficials.php?action=fetchSingle',
            method: 'POST',
            dataType: 'JSON',
            data: {
                id: id
            },
            success: function(response) {
                var data = response.data;
                $("#updateForm #id").val(data.official_id);
                $("#updateForm input[name='name']").val(data.name);
                $("#updateForm input[name='birthday']").val(data.birthday);
                $("#updateForm input[name='address']").val(data.address);
                $("#updateForm select[name='position']").val(data.position);
                $("#updateForm #description").val(data.description);
                $('#updateForm .preview_img').attr('src', 'uploads/' + data.image + "");
                $('#updateForm #image_old').val(data.image);

                if (data.gender === "Male") {
                    $("#updateForm input[name='gender'][value='Male']").attr("checked", true);
                  } else if(data.gender === "Female") {
                    $("#updateForm input[name='gender'][value='Female']").attr("checked", true);          
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
            url: "serverOfficials.php?action=updateData",
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

                    showOfficial();
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
                url: 'serverOfficials.php?action=deleteData',
                method: 'POST',
                dataType: 'JSON',
                data :{id, delete_image},
                success: function(response) {
                    if (response.statusCode == 200) {

                        showOfficial();

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


    // for brgy captain side

    
    showCaptain();

    // for fetching/showing data to tb from db
    function showCaptain(){

        $.ajax({
            url: "serverOfficials.php?action=fetchCaptain",
            method: "GET",
            dataType: "JSON",
            success: function(response) {

                var data = response.data;
                const container = $('#card-container');
                container.empty();

                if(data && data.length > 0) {
                    const value = data[0];
                    const card = $('<div/>').addClass('card').addClass('border-0').attr('style', 'width: auto;');
                    const cardBody = $('<div/>').addClass('card-body');
                    const img = $('<img/>').addClass('card-img-top').attr('src', 'uploads/' + value.image).attr('style', 'width: 180px; height: 180px; border-radius:50%; object-fit: cover; display:absolute; margin: 1.4rem auto;');
                    const cardTitle = $('<h5/>').addClass('card-title').text(`Hon. ${value.name}`).attr('style', 'text-align:center;');
                    const cardText = $('<p/>').addClass('card-text').text(value.position).attr('style', 'text-align:center;');

                    cardBody.append(cardTitle, cardText);
                    card.append(img, cardBody);
                    container.append(card);

                }
            }
        });
    }

    
    // for inserting data to db
    $("#insertCaptainForm").on("submit", function(e) {
        $("#insertCaptainBtn").attr("disabled", "disabled");
        e.preventDefault();

        $.ajax({
            url: "serverOfficials.php?action=insertCaptain",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) 
            {

                var response = JSON.parse(response);

                if (response.statusCode == 200) {
                    $("#canvasCaptain").offcanvas("hide");
                    $("#insertCaptainBtn").removeAttr("disabled");
                    $("#insertCaptainForm")[0].reset();
                    $(".preview_img").attr("src", "images/user-preview.png");
                    $("#successToast").toast("show");
                    $("#successMsg").html(response.message);

                    showCaptain();
                } 
              
                else if(response.statusCode == 500) {
                    $("#canvasCaptain").offcanvas("hide");
                    $("#insertCaptainBtn").removeAttr("disabled");
                    $("#insertCaptainForm")[0].reset();
                    $(".preview_img").attr("src", "images/user-preview.png");
                    $("#errorToast").toast("show");
                    $("#errorMsg").html(response.message);
                } 
              
                else if(response.statusCode == 400) {

                    $("#insertCaptainBtn").removeAttr("disabled");
                    $("#errorToast").toast("show");
                    $("#errorMsg").html(response.message);
                }
            }
        });
    });







});