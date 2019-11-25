
<div class="snb">
    <div class="snb_wrap">
        <div class="snb_top user_wrap">
            <div class="user_img">
                <img src="../thumb/thumb.php?src=../upload_file/member/<?=$_SESSION['profile_img']?>&size=400x300" alt="유저 사진">
            </div>
            <div class="user_name">
                <?=$_SESSION['user_access_name']?>
            </div>
            <div class="user_tag">
                <?
                $hashtag_query = "SELECT * FROM user_hashtags WHERE member_idx=".$_SESSION['user_access_idx']." LIMIT 0,3";
                $hashtag_result = mysqli_query($gconnet, $hashtag_query);
                ?>
                <?while($hashtag_row = mysqli_fetch_assoc($hashtag_result) ) { ?>
                    <button type="button"><?=$hashtag_row['hash_tag']?></button>
                <?}?>
            </div>
            <div class="user_certi">
                <span class="certi1" onclick="location.href='../sub_certi1'; " >학교인증</span>
                <span class="certi2 on">지역인증</span>
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