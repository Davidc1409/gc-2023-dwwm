let user = JSON.parse(localStorage.getItem("user"));
if (user){
    $("#btn-connect").addClass("d-none");
    $.ajax({
        url:"/gc-2023-DWWM/php/user.php",
        type: "GET",
        dataType: "json",
        data:{
            choice: "select_id_users",
            id: user.id
        },
        success:(res) => {
            if(res.success){
                $("#profil-avatar").attr("src","/gc-2023-DWWM"+res.user.avatar);
                $("#link-update").attr("href","../user_update/user_update.html?id="+res.user.id)
            }
        }
    })
    if(user.user_rights==1){
        const li=$("<li></li>");
        const link=$("<a></a>").text("Admin");
        link.attr("href", "../admin/articles/articles_dashboard.html");
        link.addClass("dropdown-item");
        li.append(link);
        $("#dropdown-profil-update").after(li);

    }
}