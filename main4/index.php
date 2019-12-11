<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
$query = "SELECT * FROM alarm_list WHERE member_idx=".$_SESSION['user_access_idx'];
$result = mysqli_query($gconnet, $query);
?>
<body>
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section">
        <div class="alrim_wrap">
            <ul>
                <?while ( $row = mysqli_fetch_assoc($result) ) {?>
                    <?
                    if ($row['alarm_type'] == "PUBL") {
                        $detail_query = "SELECT report.content_text, categories.category_name, categories.profile_img, report.wdate FROM report_list AS report, report_categories AS categories ";
                        $detail_query .= "  WHERE report.category=categories.idx ";
                        $detail_query .= " AND report.idx=" . $row['report_idx'];

                        $detail_result = mysqli_query($gconnet, $detail_query);
                        $detail_row = mysqli_fetch_assoc($detail_result);

                        $alarm_title = $detail_row['category_name'];
                        $alarm_content = $detail_row['content_text'];
                        ?>
                        <li class="item">
                            <div class="alrim_type type1"> <!-- 발행 -->
                                <img src="../upload_file/category_profile/<?=$detail_row['profile_img']?>" alt="">
                            </div>
                            <div class="tlt">내 제보가 [<span><?=$alarm_title?></span>]에 발행되었습니다.</div>
                            <div class="desc"><?=$alarm_content?> </div>
                            <div class="date"><?=date("m월 d일 H:i", strtotime($detail_row['wdate']))?></div>
                        </li>

                    <?} else if ($row['alarm_type'] == "LIKE") {?>
                        <?
                        $detail_query = "SELECT content_text, likes, wdate FROM report_list WHERE idx=".$row['report_idx'];
                        $detail_result = mysqli_query($gconnet, $detail_query);
                        $detail_row = mysqli_fetch_assoc($detail_result);
                        ?>
                        <li class="item">
                            <div class="alrim_type type2"> <!-- 좋아요 -->
                                <img src="../images/icon_heart.png" alt="" width="32">
                            </div>
                            <div class="tlt">내 제보를 <span><?=$detail_row['likes']?>명</span>이 마음에 들어합니다.</div>
                            <div class="desc"><?=$detail_row['content_text']?></div>
                            <div class="date"><?=date("m월 d일 H:i", strtotime($detail_row['wdate']))?></div>
                        </li>
                    <?}else if ($row['alarm_type'] == "TOP") {?>
                        <?
                        $detail_query = "SELECT content_text, wdate FROM report_list WHERE idx=".$row['report_idx'];
                        $detail_result = mysqli_query($gconnet, $detail_query);
                        $detail_row = mysqli_fetch_assoc($detail_result);
                        ?>
                        <li class="item">
                            <div class="alrim_type type3"> <!-- 인기등록 -->
                                <img src="../images/icon_popular.png" alt="" width="20">
                            </div>
                            <div class="tlt">내 제보가 인기 게시물에 등록되었습니다!</div>
                            <div class="desc"><?=$detail_row['content_text']?></div>
                            <div class="date"><?=date("m월 d일 H:i", strtotime($detail_row['wdate']))?></div>
                        </li>
                    <?}?>
                <?}?>
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
