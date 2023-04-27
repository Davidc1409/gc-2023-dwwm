const urlParams = new URLSearchParams(window.location.search); 
const id = urlParams.get("id"); 
const insert=urlParams.get("insert");

function insertArticle(name, text_content, picture,article_display) {
    const fd = new FormData();
    fd.append('choice', "insert_articles");
    fd.append('articles_name', name);
    fd.append('text_content', text_content);
    fd.append('media_content', picture);
    fd.append('articles_display', article_display);
    $.ajax({
        url: "../../php/admin/articles.php", 
        type: "POST", 
        dataType: "json",     
        data: fd,
        contentType: false,
        processData: false,
        cache: false,
        success: (res) => {
        if(res.success) window.location.replace("articles_dashboard.html"); 
        else alert(res.error);
        }
    });
}


tinymce.init({
    selector: '#text_content',
    height: 500,

        menubar: false,

        plugins: [

           'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',

           'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',

           'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'

        ],

        toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
});

if(id){
    $.ajax({
        url: "../../php/admin/articles.php",
        type: "GET", 
        dataType: "json", 
        data: { 
            choice: "select_id_articles",
            id
        },
        success: (res) => {
            if (res.success) {
                $("#update_container h2").text("Mise à jour de l'article " + res.article.articles_name);
                $("#articles_name").val(res.article.articles_name);
                $("#text_content").val(tinymce.activeEditor.setContent(res.article.text_content));
            } else alert(res.error); 
        }
    });
    
    $("form").submit(event => {
        event.preventDefault();
        const form_data = new FormData();
        form_data.append("choice", "update_articles");
        form_data.append("id", id);
        form_data.append("articles_name", $("#articles_name").val());
        form_data.append("text_content", tinymce.activeEditor.getContent({format: 'text'}));
        form_data.append("media_content", $('#picture')[0].files[0]);
    
        $.ajax({
            url: "../../php/admin/articles.php",
            type: "POST", 
            dataType: "json", 
            data: form_data,
            contentType: false,
            processData: false,
            cache: false,
            success: (res) => {
                if (res.success){
                    window.location.replace("articles_dashboard.html"); 
                } 
                else alert(res.error); 
            }
        });
    });

}

else if(insert){
    
    
    $("form").submit((event) => {    
        event.preventDefault();
        const name = $("#articles_name").val(); 
        const text_content = tinymce.activeEditor.getContent({format: 'text'}); 
        const picture = $('#picture')[0].files[0];
        const article_display = tinymce.activeEditor.getContent();
        insertArticle(name, text_content, picture,article_display);
    });

}


