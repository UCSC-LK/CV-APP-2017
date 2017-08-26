$(function () {
    $('#sign_in').validate({
        highlight: function (input) {
            console.log(input);
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
            console.log("valid");
            // ajaxSend(loginData,"userLogin");
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
        }
    });
});

var loginForm = $("#sign_in");

$('#loginButton').click(function(e){
  if (loginForm.valid()){
    e.preventDefault();
    var loginData = loginForm.serialize();
    ajaxSend(loginData,"userLogin");
  }
});


function ajaxSend(params,action){
    $.ajax({
        type: "POST",
        url: "../../../application/controllers/userLoginRegistration/login.php",
        data : params+"&action="+action,
        dataType: "json",
        success: function(response){
            switch (action){
                case "userLogin":
                    if(response.success == 1){
                        document.getElementById("sign_in").reset();
                        window.location.replace(response.id);
                    }else{
                        $("#respond").hide().html('<div class="alert bg-red" >'+ response.id+ '</div>').slideDown("slow");
                    }
                    break;
            }

        },
        error: function(xhr, status, error){
            console.log(xhr);
            console.log(status,error);
        }

    });

}
