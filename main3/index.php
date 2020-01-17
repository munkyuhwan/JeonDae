<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<script>
    var page = 0;
    var block = 5;
    function getList() {

        $.ajax({
            url:"get_list.php",
            method:"POST",
            data:{"page":page,"block":block,"sub_idx":'<?=$_REQUEST['sub_idx']?>' },
            success:function(response) {
                console.log(response)
                if (response!="") {
                    $("#main_list").append(response);
                    $(".pop_call").on("click", function () {
                        var name = $(this).attr("data-pop");
                        $(".popup." + name).fadeIn();
                        $(".mask").fadeIn();
                        $("html").addClass("scroll_no");
                        $(".snb").removeClass("snb_on");
                    });
                    page++;
                }

            },
            error:function(error) {

            }
        })
    }
    getList();
    $(window).on("scroll", function() {
        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();
        if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
            getList();
        }
    });

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
            $('#div_'+parent_idx+'_' + comment_idx).after(str);
            $('#main_comment_'+report_idx).hide();
        }
    }


</script>
<body>
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section">
        <div class="list_wrap">
            <ul id="main_list">
            </ul>
        </div>
        <a href="../sub_write" class="post_write_btn"></a>
    </section>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/include/gnb.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/etc_popup.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/img_popup.php" ?>
<?include $_SERVER['DOCUMENT_ROOT']."/include/share_pop.php"?>

</body>
</html>

<!--

-->