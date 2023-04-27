const urlParams = new URLSearchParams(window.location.search);
let user = JSON.parse(localStorage.getItem("user"));
let select = "select_all";

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
$.ajax({
    url: "../php/articles.php", 
    type: "GET", 
    dataType: "json", 
    data: { 
        choice: select
    },
    success: (res) => {
        if (res.success) { 
            res.articles.forEach(art => { 
                if(art.carousel && art.carousel!=0){
                    const div_item_carousel=$("<div></div>")
                    if(art.carousel==1){
                        div_item_carousel.addClass("carousel-item active carousel-picture-size");
                        div_item_carousel.attr("id", "article_"+art.id);
                    }
                    else{
                        div_item_carousel.addClass("carousel-item carousel-picture-size");
                        div_item_carousel.attr("id", "article_"+art.id);
                    }
                    const a_link_carousel=$("<a></a>");
                    const img_carousel=$("<img>").attr("src",art.media_content);
                    img_carousel.addClass("d-block w-100 img-fluid");
                    const div_carousel_caption=$("<div></div>");
                    div_carousel_caption.addClass("carousel-caption d-none d-md-block carousel-box-color p-5 caption-size");
                    const title_carousel=$("<h5></h5>").text(art.articles_name);
                    title_carousel.addClass("text-start");
                    const desc_carousel=$("<p></p>").text(art.summary);
                    desc_carousel.addClass("text-start");
                    div_carousel_caption.append(title_carousel,desc_carousel);
                    a_link_carousel.append(img_carousel,div_carousel_caption);
                    div_item_carousel.append(a_link_carousel);
                    $(".carousel-inner").append(div_item_carousel);
                }

                if(art.feature){
                    const a_link_top_news=$("<a></a>").addClass("text-decoration-none text-black");
                    a_link_top_news.attr("id","article_"+art.id)
                    a_link_top_news.attr("href","articles.html?article="+art.id);
                    const figure_top_news=$("<figure></figure>").addClass("border-2 text-center articles-color");
                    const img_top_news=$("<img>").attr("src",art.media_content);
                    img_top_news.addClass("figure-img img-fluid");
                    const figcaption_top_news=$("<figcaption></figcaption>").text(art.figcaption);
                    figcaption_top_news.addClass("figure-caption poppins-reg text-white pb-2");
                    const h5_top_news=$("<h5></h5>").text(art.articles_name);
                    const summary_top_news=$("<p></p>").text(art.summary);
                    const posted_date= new Date(art.created_at);
                    const format_posted_date=new Intl.DateTimeFormat("fr-fr",{dateStyle:"short"}).format(posted_date);
                    const created_at_article=$("<p></p>").text("Posté le "+format_posted_date+" par "+art.fullname);
                    figure_top_news.append(img_top_news,figcaption_top_news);
                    a_link_top_news.append(figure_top_news,h5_top_news,summary_top_news,created_at_article);
                    $("#top_news_"+art.feature).append(a_link_top_news);
                }

                if(!art.feature && (!art.carousel || art.carousel==0)) {
                    const card_container=$("<div></div>");
                    card_container.addClass("col-md-4 mt-5");
                    const a_link_card=$("<a></a>");
                    a_link_card.addClass("text-decoration-none poppins-reg text-black");
                    a_link_card.attr("href","articles.html?article="+art.id);
                    const card_div=$("<div></div>");
                    card_div.addClass("card mb-3");
                    const card_img_div=$("<div></div>");
                    card_img_div.addClass("z-3");
                    const card_img=$("<img>").attr("src",art.media_content);
                    card_img.addClass("img-fluid rounded-bottom-2");
                    const card_shape1=$("<div></div>");
                    card_shape1.addClass("rounded-square1");
                    const card_shape2=$("<div></div>");
                    card_shape2.addClass("rounded-square2");
                    const text_card=$("<p></p>").text(art.articles_name);
                    text_card.addClass("poppins-extrabold text-center mb-4");
                    card_img_div.append(card_img);
                    card_div.append(card_img_div,card_shape1,card_shape2);
                    a_link_card.append(card_div,text_card);
                    card_container.append(a_link_card);
                    $("#row_card").append(card_container);
                }
            });
        } else alert(res.error);
    }
});