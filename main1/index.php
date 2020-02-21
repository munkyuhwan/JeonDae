<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?

//echo "<br><br><br><br>";
//echo $_SESSION['user_access_idx'];

?>
<script>
    var page = 0;
    var block = 5;
    function getList() {
        console.log("get list")
        $.ajax({
            url:"get_list.php",
            cache:true,
            <?if (trim(sqlfilter($_REQUEST['category_idx'])) !='' ) {?>
                data:{"page":page,"block":block,"category":'<?=trim(sqlfilter($_REQUEST['category_idx']))?>'},
            <?}else {?>
                data:{"page":page,"block":block},
            <?}?>
            success:function(response) {
                try {
                    var res = JSON.parse(response)

                }catch (e) {
                    $("#main_list").append(response);

                    $(".pop_call").on("click",function(){
                        var name = $(this).attr("data-pop");
                        $(".popup."+name).fadeIn();
                        $(".mask").fadeIn();
                        $("html").addClass("scroll_no");
                        $(".snb").removeClass("snb_on");
                    });


                    page++;
                }

            },
            error:function(error) {
                console.log(error)
            }
        })
    }
    getList();
    /*
    $(window).on("scroll", function() {
        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();

        if ( (scrollHeight - scrollPosition) / scrollHeight === 0) {
            getList();
        }
    });
    */

</script>
<script>
    function addCommentField(comment_idx, report_idx, img) {
        var str = " <div class=\"item_reply_input\"  id=\"write_comment_"+comment_idx+"\">";
        str += "    <div class=\"prf_box\">";
        str +=  "       <img src=\"../upload_file/member/"+img+"\" alt=\"\">";
        str += "    </div>"
        str += "    <div class=\"input_box\">"
        str += "        <form action=\"write_comment_action.php\" method=\"post\" name=\"frm\">"
        str +=     "        <input type=\"text\" name=\"content_txt\" required>"
        str +=  "           <input type=\"hidden\" name=\"parent_idx\" id=\"parent_idx\" value=\""+comment_idx+"\">"
        str +=   "          <input type=\"hidden\" name=\"report_idx\" id=\"report_idx\" value=\""+report_idx+"\">"
        str +=    "         <button type=\"submit\">게시</button>"
        str +=     "    </form>"
        str +=   "  </div>"
        str +=" </div>"
        $('.item_reply_input').hide();

        var innerComment = document.getElementById("write_comment_"+comment_idx)
        if ( innerComment != null) {
            $("#write_comment_"+comment_idx).remove()
            $('#main_comment_'+report_idx).show();
        }else {
            $('#div_' + comment_idx).after(str);
            $('#main_comment_'+report_idx).hide();
        }
    }

    function addInnerCommentField(parent_idx, comment_idx, report_idx, img) {
        var str = " <div class=\"item_reply_input\"  id=\"write_comment_"+parent_idx+"_"+comment_idx+"\">";
        str += "    <div class=\"prf_box\">";
        str +=  "       <img src=\"../upload_file/member/"+img+"\" alt=\"\">";
        str += "    </div>"
        str += "    <div class=\"input_box\">"
        str += "        <form action=\"write_comment_action.php\" method=\"post\" name=\"frm\">"
        str +=     "        <input type=\"text\" name=\"content_txt\" required>"
        str +=  "           <input type=\"hidden\" name=\"parent_idx\" id=\"parent_idx\" value=\""+parent_idx+"\">"
        str +=   "          <input type=\"hidden\" name=\"report_idx\" id=\"report_idx\" value=\""+report_idx+"\">"
        str +=    "         <button type=\"submit\">게시</button>"
        str +=     "    </form>"
        str +=   "  </div>"
        str +=" </div>"
        $('.item_reply_input').hide();

        var innerComment = document.getElementById("write_comment_"+parent_idx+"_"+comment_idx)
        if ( innerComment != null) {
            $("#write_comment_"+parent_idx+"_"+comment_idx).remove()
            $('#main_comment_'+report_idx).show();
        }else {
            $('#div_' + parent_idx + '_' + comment_idx).after(str);
            $('#main_comment_' + report_idx).hide();
        }

    }


</script>
<body>
<div class="wrapper"  onscroll="console.log('scrolling wrapper')" >
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section" onscroll="console.log('scrolling section')" >
        <div class="list_wrap" onscroll="console.log('scrolling div')" >
            <ul id="main_list"  onscroll="console.log('scrolling ul')" >
            </ul>
        </div>
        <a href="../sub_write" class="post_write_btn"></a>
    </section>
</div>
<script>
    $(window).scroll(function (e) {
        if (isScrolledBottom(e)) {
            getList();
        }

    });
</script>
<? include $_SERVER['DOCUMENT_ROOT']."/include/gnb.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/etc_popup.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/img_popup.php" ?>
<?include $_SERVER['DOCUMENT_ROOT']."/include/share_pop.php"?>
<?include $_SERVER['DOCUMENT_ROOT']."/include/footer.php"?>
</body>
</html>

<!--

-->