
    $(document).ready(function(){
        $("a li.back_p").hover(function(){
            $(this).css("backgorund","red")
        })
    })
        $(document).ready(function(){
            $("li.user_news").click(function(){
                $('#frame_content').attr('src','user_news.php')
            })
        })