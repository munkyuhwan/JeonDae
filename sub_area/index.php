<? include $_SERVER['DOCUMENT_ROOT']."/include/head.php" ?>
<?

$idx = trim(sqlfilter($_REQUEST['idx']));
$query = "SELECT cover_img, profile_img, category_name  FROM report_categories WHERE idx=".$idx;
$result = mysqli_query($gconnet, $query);
$row = mysqli_fetch_assoc($result);

if ($_SESSION['user_access_idx']!='') {
    $subscribe_query = "SELECT COUNT(*) AS cnt  FROM subscribe_list WHERE category_idx=" . $idx . " AND member_idx=" . $_SESSION['user_access_idx'];
    $sub_res = mysqli_query($gconnet, $subscribe_query);
    $sub_assoc = mysqli_fetch_assoc($sub_res);
    $subscribe_cnt = $sub_assoc['cnt'];
}

?>
<script type="application/javascript">
    var page = 0;
    var block = 5;

    function loadData() {
        $.ajax({
            url:"get_data.php",
            data:{"page":page, "block":block, "category_idx":'<?=$idx?>', "type":"report"},
            method:"POST",
            success:function(response) {
                if (response != "" ) {
                    $('#report_list').append(response);
                    $(".pop_call").on("click", function () {
                        var name = $(this).attr("data-pop");
                        $(".popup." + name).fadeIn();
                        $(".mask").fadeIn();
                        $("html").addClass("scroll_no");
                        $(".snb").removeClass("snb_on");
                        //swiper.update();
                    });
                    page++;
                }
            },
            error:function(error) {

            }
        })
    }

    /*
    $(window).on("scroll", function() {
        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();
        if ( (scrollHeight - scrollPosition) / scrollHeight === 0) {
            loadData();
        }
    });
    */

</script>
<body onload="loadMainData(); ">
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php" ?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php" ?>
    <section class="main_section">
        <h2 class="hidden">지역 메인</h2>
        <div class="area_tlt">
            <div class="area_img">
                <img src="../upload_file/category_cover/<?=$row['cover_img']?>" alt="지역 이미지">
            </div>
            <div class="area_inner">
                <p class="area_logo"><img src="../upload_file/category_profile/<?=$row['profile_img']?>" alt="원 이미지"></p>
                <span><?=$row['category_name']?></span>
                <?if (intval($subscribe_cnt) <= 0 ) {?>
                    <form action="do_subscribe.php" name="frm" method="post" target="_fra_admin"  >
                        <input type="hidden" name="category_idx" value="<?=$idx?>">
                        <button type="submit" class="subs_btn blue_btn" >구독</button>
                    </form>
                <?}?>
            </div>
        </div>
        <div class="list_wrap popular">
            <p class="desc">이 구역의 인기글은 나야 :)</p>
            <div class="swiper-container2" id="main_list">
            </div>
            <a href="../main3?sub_idx=<?=$idx?>" class="more_btn">더보기</a>
        </div>
        <div class="list_wrap">
            <ul id="report_list" >
            </ul>
        </div>
        <a href="../sub_write" class="post_write_btn"></a>
    </section>
</div>
<script>
    function loadMainData() {
        $.ajax({
            url:"get_main_list.php",
            data:{"page":page, "block":block, "category_idx":<?=$idx?>, "type":"top"},
            method:"POST",
            success:function(response) {

                $('#main_list').append( response );

                swiper = new Swiper('.swiper-container2',{
                    effect: "slide",
                    loop: true,
                    pagination : { // 페이징 설정
                        el : '.swiper-pagination',
                        clickable : true, // 페이징을 클릭하면 해당 영역으로 이동, 필요시 지정해 줘야 기능 작동
                    },
                    navigation:{ nextEl: ".slide_next_btn", prevEl: ".slide_prev_btn" },
                    autoplay: { delay: 3000 },
                    on:{ slideChange: function(){
                        $(".main_visual").removeClass("bounce");
                        setTimeout(function() {
                            $(".main_visual").addClass("bounce")  }, 200);
                        }
                    },
                });
                console.log(  )

                swiper.update();
            },
            error:function(error) {

            }
        })
    }
</script>

<script>
    function addCommentField(comment_idx, report_idx, img) {
        var str = " <div class=\"item_reply_input\"  id=\"write_comment_report_"+comment_idx+"\">";
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

        var innerComment = document.getElementById("write_comment_report_"+comment_idx)
        if ( innerComment != null) {
            $("#write_comment_report_"+comment_idx).remove()
            $('#main_comment_report_'+report_idx).show();
        }else {
            console.log(str)
            $('#div_report_' + comment_idx).after(str);
            $('#main_comment_report_'+report_idx).hide();
        }
    }

    function addInnerCommentField(parent_idx, comment_idx, report_idx, img) {
        var str = " <div class=\"item_reply_input\"  id=\"write_comment_report_"+parent_idx+"_"+comment_idx+"\">";
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

        var innerComment = document.getElementById("write_comment_report_"+parent_idx+"_"+comment_idx)
        if ( innerComment != null) {
            $("#write_comment_report_"+parent_idx+"_"+comment_idx).remove()
            $('#main_comment_report_'+report_idx).show();
        }else {
            $('#div_report_'+parent_idx+'_' + comment_idx).after(str);
            $('#main_comment_report_'+report_idx).hide();
        }
    }


</script>
<? include $_SERVER['DOCUMENT_ROOT']."/include/gnb.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/etc_popup.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/share_pop.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/img_popup.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/footer.php"?>
</body>

<script>
    $(window).scroll(function (e) {
        if ( Math.ceil($(window).innerHeight() + $(window).scrollTop()) >= $("body").height()) {
            //do stuff
            console.log("► End of scroll");
            getList();
        }
    });
</script>
</html>

<!--

-->