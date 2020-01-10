<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
$query = "SELECT COUNT(*) AS cnt FROM scrab_list AS scrab, report_list AS report WHERE 1 ";
$where = " AND scrab.member_idx=".$_SESSION['user_access_idx']." ";
$where .= " AND scrab.report_idx = report.idx ";
$result = mysqli_query($gconnet, $query.$where);
$row = mysqli_fetch_assoc($result);
?>
<script>
    var page = 0;
    var block = 10;

    function loadData() {
        $.ajax({
            url:"get_data.php",
            data:{"page":page, "block":block},
            method:"POST",
            success:function(response) {
                $('#report_list').append(response);
                $(".pop_call").on("click",function(){
                    console.log("pop call")
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


    function setCommentList(reportIdx) {
        $.ajax({
            url:"../include/get_comment_list.php",
            data:{"report_idx":reportIdx},
            success:function(response) {
                $("#comment_list_"+reportIdx).html(response);
            },
            error:function(error) {

            }
        })
    }
</script>
<body onload="loadData()">
<div class="wrapper">

    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    
    <section class="main_section">
        <p class="scrap_cnt">스크랩 한 글수 <span><?=$row['cnt']?></span>개</p>
        <div class="list_wrap">
            <ul id="report_list">

            </ul>
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