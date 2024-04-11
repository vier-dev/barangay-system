$('.phone').on('input', function(){
  this.value = this.value.replace(/[^0-9.]/g, '');
});


$(document).ready(function(){
  // function to insert data to database
  $("#insertForm").on("submit", function(e) {
    $("#insertBtn").attr("disabled", "disabled");
    e.preventDefault();
    
      $.ajax({
        url: "serverRegister.php?action=insertData",
        method: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(response) 
        {

            var response = JSON.parse(response);

            if (response.statusCode == 200) {
                $("#insertBtn").removeAttr("disabled");
                $("#insertForm")[0].reset();
                $("#successToast").toast("show");
                $("#successMsg").html(response.message);
            } 
          
            else if(response.statusCode == 500) {

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
})



