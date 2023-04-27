if (user.user_rights == 0) window.location.replace("../../articles/articles.html");

 function createRow(users_array, insert = false) {
     users_array.forEach(el => {
         const tr = $("<tr></tr>"); 
         tr.attr("id", "tr_" + el.id) 
 
         const username = $("<td></td>").text(el.username);
         const firstname = $("<td></td>").text(el.firstname); 
         const lastname = $("<td></td>").text(el.lastname);
         const email =$("<td></td>").text(el.email);
         const avatar = $("<td></td>");
         avatar.addClass("col-3");
         let img = "Aucune image";
         if (el.avatar){
            img = $("<img>").attr("src", "../" + el.avatar);
            img.addClass("img-fluid");
        } 
         avatar.append(img);
         
         const updatectn = $("<td></td>");
         const a = $("<a></a>").text("Modifier");
        //  a.html("<i class='fa fa-pencil' aria-hidden='true'></i>"); // J'ajoute un texte au lien
         a.attr("href", "users_add_update.html?id=" + el.id);
         a.addClass("btn col");
         updatectn.append(a); 
 
         const delctn = $("<td></td>");
         const delbtn = $("<button></button>").text("Supprimer"); 
        //  delbtn.html("<i class='fa fa-trash' aria-hidden='true'></i>"); // J'ajoute le contenu du bouton, ici une icone de poubelle
         delbtn.addClass("btn col"); 
         
         delbtn.click(() => {
             wantToDelete(el.id);
         });
         delctn.append(delbtn);
 
         tr.append(username,firstname, lastname, email,avatar, updatectn, delctn);
         if (insert) $("tbody").prepend(tr);
         else $("tbody").append(tr);
     });
 
    //  $("td").addClass("text-left overflow-hidden col-2"); // J'ajoute une classe à tous les td
 }
 
 function wantToDelete(id) {
     if (confirm("Voulez-vous vraiment supprimer l'utilisateur ?")) {
         $.ajax({
             url: "../../php/admin/users.php",
             type: "POST", 
             dataType: "json", 
             data: { 
                 choice: "delete_users",
                 id
             },
             success: () => {
                 $("#tr_" + id).remove();
             }
         });
     }
 }
 
 $.ajax({
     url: "../../php/admin/users.php", 
     type: "GET",
     dataType: "json", 
     data: { 
         choice: "select_users"
     },
     success: (res) => {
         createRow(res.user); 
     }
 });