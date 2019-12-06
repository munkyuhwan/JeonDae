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
                    <li class="item">
                        <div class="alrim_type type1"> <!-- 발행 -->
                            <img src="../images/img_sample2.jpg" alt="">
                        </div>
                        <div class="tlt">내 제보가 [<span>광진구 대신 전해드립니다</span>]에 발행되었습니다.</div>
                        <div class="desc">얼마전에 구리시로 이사온 24살 남자입니다.
                            이사온지 얼마 안돼서 친구도 없고 맨날 심심해서 혼자 피시방
                            만 다니는데 같이 다닐 친구필요해요 ㅠ  남자여자 상관없고
                            좋아요 누르면 달려갑니다!  </div>
                        <div class="date">8월 20일 오후 6:18</div>
                    </li>
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

<!--

-->