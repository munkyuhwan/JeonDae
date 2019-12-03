<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
/*
$block = 10;
$scroll_num = 0;
$query = "SELECT report.idx AS report_idx, report.wdate, report.content_text, report.report_hashtag, report.likes, (SELECT COUNT(*) AS cnt FROM report_comments WHERE report_idx=report.idx) AS comment_cnt,  member.real_name, member.file_chg  FROM report_list AS report, member_info AS member WHERE report.del_yn='N' AND report.member_idx=member.idx ";
$query_limit .= $query." LIMIT ".($block*$scroll_num)." , ".$block ;
$result = mysqli_query($gconnet,$query_limit);

$cnt_result = mysqli_query($gconnet,$query);
$cnt = mysqli_fetch_all($cnt_result);
$num = count($cnt);
*/
// publ
?>
<script>
    var page = 0;
    var block = 10;
    function getList() {

        $.ajax({
            url:"get_list.php",
            cache:true,
            data:{"page":page,"block":block},
            success:function(response) {

                try {
                    var res = JSON.parse(response)
                }catch (e) {
                    $("#main_list").append(response);
                    page++;
                }

            },
            error:function(error) {

            }
        })
    }
    getList();
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