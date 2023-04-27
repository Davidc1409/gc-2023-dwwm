
 if (user.user_rights == 0) window.location.replace("../../articles/articles.html");

 function createRow(articles_array, insert = false) {
     articles_array.forEach(el => {
         const tr = $("<tr></tr>"); 
         tr.attr("id", "tr_" + el.id) 
 
         const name = $("<td></td>").text(el.articles_name);
         const desc = $("<td></td>").text(el.text_content); 
         const imagectn = $("<td></td>");
         imagectn.addClass("col-3");
         let img = "Aucune image";
         if (el.media_content) img = $("<img>").attr("src", "../" + el.media_content); img.addClass("img-fluid")
         imagectn.append(img);
         
         const updatectn = $("<td></td>");
         const a = $("<a></a>").text("Modifier"); 
        //  a.html("<i class='fa fa-pencil' aria-hidden='true'></i>"); 
         a.attr("href", "articles_add_update.html?id=" + el.id); 
         a.addClass("btn col"); 
         updatectn.append(a); 
 
         const delctn = $("<td></td>");
         const delbtn = $("<button></button>").text("Supprimer"); 
        //  delbtn.html("<i class='fa fa-trash' aria-hidden='true'></i>"); 
         delbtn.addClass("btn col"); 
         
         
         delbtn.click(() => {
             wantToDelete(el.id);
         });
         delctn.append(delbtn);
 
         tr.append(name,desc, imagectn, updatectn, delctn); 
         if (insert) $("tbody").prepend(tr); 
         else $("tbody").append(tr); 
     });
 
    //  $("td").addClass("text-left overflow-hidden col-2");
 }
 
 function wantToDelete(id) {
     if (confirm("Voulez-vous vraiment supprimer l'article ?")) {
         $.ajax({
             url: "../../php/admin/articles.php", 
             type: "POST", 
             dataType: "json", 
             data: { 
                 choice: "delete_articles",
                 id
             },
             success: () => {
                 $("#tr_" + id).remove(); 
             }
         });
     }
 }
 
 $.ajax({
     url: "../../php/admin/articles.php", 
     type: "GET", 
     dataType: "json", 
     data: { 
         choice: "select_articles"
     },
     success: (res) => {
         createRow(res.articles); 
     }
 });
