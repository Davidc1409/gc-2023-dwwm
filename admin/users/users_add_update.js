const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get("id"); 
const insert=urlParams.get("insert");

function insertArticle(username, firstname, lastname, email, birthdate, pwd, avatar) {
    const fd = new FormData();
    fd.append('choice', "add_user");
    fd.append('username', username);
    fd.append('firstname', firstname);
    fd.append('lastname', lastname);
    fd.append("email",email);
    fd.append("birthdate", birthdate);
    fd.append("pwd",pwd);
    fd.append("avatar", avatar);

    $.ajax({
        url: "../../php/admin/users.php", 
        type: "POST",
        dataType: "json",        
        data: fd,
        contentType: false,
        processData: false,
        cache: false,
        success: (res) => {
        if(res.success){
            window.location.replace("users_dashboard.html");
        } 
        else {
            alert(res.error);
        }
        }
    });
}

if(id){

    $("#pwd").addClass("d-none");
    $("#pwd_label").addClass("d-none");

    $.ajax({
        url: "../../php/admin/users.php",
        type: "POST", 
        dataType: "json", 
        data: { 
            choice: "select_id_users",
            id
        },
        success: (res) => {
            if (res.success) {
                $("#update_container h2").text("Mise à jour de l'utilisateur " + res.user.username);
                $("#username").val(res.user.username);
                $("#firstname").val(res.user.firstname);
                $("#lastname").val(res.user.lastname);
                $("#email").val(res.user.email);
                $("#birthdate").val(res.user.birthdate);
            } else alert(res.error);
        }
    });
    
    $("form").submit(event => {
        event.preventDefault();
    
        const form_data = new FormData();
        form_data.append("choice", "update_users_info");
        form_data.append("id", id);
        form_data.append("username", $("#username").val());
        form_data.append("firstname", $("#firstname").val());
        form_data.append("lastname", $("#lastname").val());
        form_data.append("email", $("#email").val());
        form_data.append("birthdate", $("#birthdate").val());
        form_data.append("avatar", $('#avatar')[0].files[0]);
    
        $.ajax({
            url: "../../php/admin/users.php",
            type: "POST",
            dataType: "json",
            data: form_data,
            contentType: false,
            processData: false,
            cache: false,
            success: (res) => {
                if (res.success){
                    window.location.replace("users_dashboard.html");
                } 
                else alert(res.error); 
            }
        });
    });

}

else if(insert){
    $("form").submit((event) => {    
        event.preventDefault();
    
        const username = $("#username").val();
        const firstname = $("#firstname").val();
        const lastname = $("#lastname").val();
        const email = $("#email").val();
        const birthdate = $("#birthdate").val();
        const pwd = $("#pwd").val();
        const avatar = $('#avatar')[0].files[0];
    
        insertArticle(username, firstname, lastname, email, birthdate, pwd, avatar);
    });

}


