<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
$mywrite_query="SELECT COUNT(*) AS cnt FROM report_list WHERE member_idx=".$_SESSION['user_access_idx']." AND complete_yn='Y' AND del_yn='N' ";
$mywrite_result = mysqli_query($gconnet, $mywrite_query);
$mywrite_cnt = mysqli_fetch_assoc($mywrite_result);

$mycomment_query = "SELECT COUNT(*) AS cnt FROM report_comments WHERE member_idx=".$_SESSION['user_access_idx'];
$mycomment_result = mysqli_query($gconnet, $mycomment_query);
$mycomment_cnt = mysqli_fetch_assoc($mycomment_result);
?>
<script>
    var page=0;
    var block=10;

    function getWriteList() {
        $.ajax({
            url:'list_template.php',
            data:{"page":page, "block":block},
            success:function(response) {
                $('#myWrite').html(response);
                $(".pop_call").on("click",function(){

                    var name = $(this).attr("data-pop");
                    $(".popup."+name).fadeIn();
                    $(".mask").fadeIn();
                    $("html").addClass("scroll_no");
                    $(".snb").removeClass("snb_on");
                });
            },
            error:function(error) {

            }
        })
    }
    function getCommentList() {
        $.ajax({
            url:'comment_template.php',
            data:{"page":page, "block":block},
            success:function(response) {
                $('#myComment').html(response);
            },
            error:function(error) {

            }
        })
    }


</script>
<body onload="getWriteList()">
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>

    <section class="main_section">
        <div class="tab_menu my_tab">
            <button tpye="button" class="on" onclick="getWriteList()">작성한 글 <span><?=$mywrite_cnt['cnt']?></span></button>
            <button tpye="button" class="" onclick="getCommentList()">작성한 댓글 <span><?=$mycomment_cnt['cnt']?></span></button>
        </div>
        <div class="tab_con">
            <div class="list_wrap" style="display:block;">
                <ul id="myWrite">
                </ul>
            </div>
            <div class="list_wrap mylist"  style="display: block;">
                <ul id="myComment">
                </ul>
            </div>
        </div>
    </section>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/include/gnb.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/etc_popup.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/img_popup.php" ?>
<? include $_SERVER['DOCUMENT_ROOT']."/include/share_pop.php"?>

</body>
</html>

<!--

-->