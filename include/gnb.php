<?
$hashtag_query = "SELECT * FROM user_hashtags WHERE member_idx=".$_SESSION['user_access_idx']." LIMIT 0,3";
$hashtag_result = mysqli_query($gconnet, $hashtag_query);

$local_appr = "SELECT local, area_appr_yn, uni, file_chg, user_id FROM member_info WHERE idx=".$_SESSION['user_access_idx'];
$local_res = mysqli_query($gconnet, $local_appr);
$local = mysqli_fetch_assoc($local_res);
?>
<div class="snb">
    <div class="snb_wrap">
        <div class="snb_top user_wrap">
            <div class="user_img">
                <?if($local['file_chg'] == "") {?>
                    <img src="http://graph.facebook.com/<?=$local['user_id']?>/picture?type=normal" alt="유저 사진">
                <?}else {?>
                    <img src="../upload_file/member/<?=$local['file_chg']?>" alt="유저 사진">
                <?}?>
            </div>
            <div class="user_name">
                <?=$_SESSION['user_access_name']?>
            </div>
            <div class="user_tag">

                <?while($hashtag_row = mysqli_fetch_assoc($hashtag_result) ) { ?>
                    <button type="button"><?=$hashtag_row['hash_tag']?></button>
                <?}?>
            </div>
            <div class="user_certi">
                <?if($local['uni'] != 0) {?>
                    <span class="certi1 on" >인증완료</span>
                <?}else {?>
                    <span class="certi1" onclick="location.href='../sub_certi1'; " >학교인증</span>
                <?}?>
                <?if($local['area_appr_yn'] == 'Y') {?>
                    <span class="certi2 on" >인증완료</span>
                <?}else {?>
                    <span class="certi2 on" onclick="location.href='../sub_certi2'; " >지역인증</span>
                <?}?>
            </div>
        </div>
        <div class="snb_mid">
            <ul>
                <li class="snb_menu1"><a href="../sub_mypage1"><p><img src="../images/icon_snb_menu1.png" width="16" alt=""></p> 내가 제보한 글</a></li>
                <li class="snb_menu2"><a href="../sub_mypage2"><p><img src="../images/icon_snb_menu2.png" width="10" alt=""></p> 스크랩 한 글</a></li>
                <li class="snb_menu3"><a href="../sub_mypage3"><p><img src="../images/icon_snb_menu3.png" width="15" alt=""></p> 구독관리</a></li>
                <li class="snb_menu4"><a href="../sub_mypage4"><p><img src="../images/icon_snb_menu4.png" width="15" alt=""></p> 일반설정</a></li>
            </ul>
        </div>
        <button type="button" class="snb_close"></button>
    </div>
</div>