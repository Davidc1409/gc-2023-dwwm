$("form").submit((event) => { 
    event.preventDefault(); 

    $.ajax({
        url: "../php/register.php", 
        type: "POST", 
        dataType: "json", 
        data: { 
            email: $("#email").val(),
            username: $("#username").val(),
            firstname: $("#firstname").val(),
            lastname: $("#lastname").val(),
            pwd: $("#pwd").val(),
            birthdate: $("#birthdate").val(),
        },
        success: (res) => {
            if (res.success) window.location.replace("../login/login.html"); 
            else alert(res.error); 
        }
    });
});