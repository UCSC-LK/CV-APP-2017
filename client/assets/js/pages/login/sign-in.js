var domain = "../../";

function ajaxSend(params) {
    $.ajax({
        type: "POST",
        url: domain + "login",
        data: params,
        dataType: "json",
        success: function (response) {
            if (response.success == true) {
                document.getElementById("sign_in").reset();
                // sessionStorage.setItem('jwt_token', response.token);
                localStorage.jwt_token = response.token;
                homeRedirect();
            } else {
                $("#respond").hide().html('<div class="alert bg-red" >' + response.msg + '</div>').slideDown("slow");
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status, error);
        }

    });

}

function getToken() {
    // return sessionStorage.getItem('jwt_token');
    return localStorage.jwt_token;
}

function isLoggedIn() {
    var token = getToken();
    var payload;

    if (token) {
        payload = token.split('.')[1];
        payload = window.atob(payload);
        payload = JSON.parse(payload);

        return payload.exp > Date.now() / 1000;
    } else {
        return false;
    }
}

function currentUser() {
    var token = getToken();
    var payload = token.split('.')[1];
    payload = window.atob(payload);
    payload = JSON.parse(payload);
    return {
        _id: payload._id,
        isfirst: payload.isfirst,
        usertype: payload.usertype,
        name: payload.name
    };
}

function homeRedirect() {
    user_info = currentUser();

    if (user_info.usertype == 0) {
        window.location.replace('./views/student');
    } else if (user_info.usertype == 1) {
        window.location.replace('./views/company');
    } else if (user_info.usertype == 99) {
        window.location.replace('./views/super_user');
    } else {
        alert("Invalid User");
        // sessionStorage.removeItem('jwt_token');
        localStorage.removeItem("jwt_token");
    }
}

if (isLoggedIn()) {
    homeRedirect();
}

// custom validation
$(function () {
    $('#sign_in').validate({
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
        }
    });
});

var loginForm = $("#sign_in");

$('#loginButton').click(function (e) {
    console.log("clicked");
    if (loginForm.valid()) {
        e.preventDefault();
        var loginData = {
            username: $("input[name=username]").val(),
            password: $("input[name=password]").val()
        };
        ajaxSend(loginData, "userLogin");
    }
});
