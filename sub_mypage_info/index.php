<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<? include $_SERVER['DOCUMENT_ROOT'] . "/include/spinner.php" ?>
<?

$idx = $_SESSION['user_access_idx'];
$query = "SELECT * FROM member_info WHERE idx=".$idx;
$result = mysqli_query($gconnet,$query);
$row = mysqli_fetch_assoc($result);

$current_year = date('Y',time());


// 회원 제보함 구독 리스트
$main_category = "SELECT subscribe.category_idx, report.category_name FROM subscribe_list AS subscribe, report_categories AS report WHERE subscribe.member_idx=".$idx." AND subscribe.category_idx=report.idx GROUP BY subscribe.category_idx ";
$main_cat_result = mysqli_query($gconnet, $main_category);

// 해시태그
$hashtag_query = "SELECT subscribe.category_idx, sub_cat.sub_name, sub_cat.idx FROM subscribe_list AS subscribe, report_sub_categories AS sub_cat WHERE subscribe.member_idx=".$idx." AND subscribe.sub_category_idx=sub_cat.idx ";
$hastag_result = mysqli_query($gconnet, $hashtag_query);



?>
<body>

<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/gnb.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section">
        <div class="myinfo_wrap">
            <form name="frm" action="edit_action.php" method="post" enctype="multipart/form-data" >
                <div class="user_wrap">
                    <div class="user_img_wrap">
                        <div class="user_img">
                            <?if($row['file_chg'] != "") {?>
                                <img id="profile_img" src="../upload_file/member/<?=$row['file_chg']?>" alt="유저 사진">
                            <?}?>
                        </div>
                        <input type="file" name="profile_img" id="img_change" onchange="imageSelected(event)" >
                        <label for="img_change" class="img_change_btn"></label>
                    </div>
                </div>
                <div class="info_row">
                    <p class="info_tlt">이름</p>
                    <div class="info_con name_con"><input type="text" name="user_name" class="" value="<?=$_SESSION['user_access_name']?>"></div>
                </div>
                <div class="user_certi">
                    <?if($row['uni'] != 0) {?>
                        <span class="certi1 on" >인증완료</span>
                    <?}else {?>
                        <span class="certi1" onclick="location.href='../sub_certi1'; " >학교인증</span>
                    <?}?>

                    <?if($row['area_appr_yn'] == 'Y') {?>
                        <span class="certi2 on" >인증완료</span>
                    <?}else {?>
                        <span class="certi2 on" onclick="location.href='../sub_certi2'; " >지역인증</span>
                    <?}?>                </div>
                <div class="info_row">
                    <p class="info_tlt">성별</p>
                    <div class="info_con gender">
                        <input type="radio" id="check_male" value="M" <?=$row['gender']=='M' ? "checked":"" ?> name="gender">
                        <label for="check_male">남</label>
                        <input type="radio" id="check_female" value="F" <?=$row['gender']=='F' ? "checked":"" ?>  name="gender">
                        <label for="check_female">녀</label>
                    </div>
                </div>
                <div class="info_row">
                    <p class="info_tlt">연령</p>
                    <div class="info_con">
                        <div class="select_div">
                            <select name="year_birth" id="">
                                <?for($i=$current_year;$i>1950;$i--) {?>
                                    <option value="<?=$i?>" <?=$i==$row['birthday'] ? "selected":"" ?> ><?=$i?></option>
                                <?}?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="info_row">
                    <p class="info_tlt">가입일</p>
                    <div class="info_con">
                        <?=date("Y.m.d", strtotime($row['wdate']) )?>
                    </div>
                </div>
                <div class="info_row">
                    <p class="info_tlt">관심해시태그</p>
                    <div class="info_con">
                        <div class="selected_tag">
                            <?
                            $selected_sub_cat = array();
                            while($sub_cat_row = mysqli_fetch_assoc($hastag_result)) {?>
                                <? array_push($selected_sub_cat, $sub_cat_row["idx"]) ?>
                                <span>#<?=$sub_cat_row["sub_name"]?></span>
                            <?}?>
                             <button type="button" class="tag_arrow"></button>
                        </div>
                        <div class="tag_type">
                            <ul>
                                <? while($main_cat_row = mysqli_fetch_assoc($main_cat_result) ) {?>
                                    <?
                                    $sub_query = "SELECT * FROM report_sub_categories WHERE report_idx=".$main_cat_row['category_idx'];
                                    $sub_query_res = mysqli_query($gconnet, $sub_query);
                                    ?>
                                    <?while ($sub_row = mysqli_fetch_assoc($sub_query_res)) {?>
                                        <li>
                                            <input type="checkbox" name="hashtags[]" id="subs<?=$sub_row['idx']?>" value="<?=$sub_row['idx']?>" <?= in_array($sub_row['idx'],$selected_sub_cat) ? "checked":"" ?> >
                                            <label for="subs<?=$sub_row['idx']?>">
                                                <?=$sub_row['sub_name']?>
                                            </label>
                                        </li>
                                    <?}?>
                               <?}?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="info_row">
                    <p class="info_tlt">구독정보</p>
                    <div class="info_con subs_info">
                        <?
                        $main_cat_result = mysqli_query($gconnet, $main_category);
                        $i=0;
                        ?>
                        <? while( $main_cat_row = mysqli_fetch_assoc($main_cat_result) ) {?>
                            <span>
                                <?=$main_cat_row['category_name'] ?><?= $i<(mysqli_num_rows($main_cat_result)-1) ? ",":"" ?>
                            </span>
                        <?$i++;}?>
                    </div>
                </div>
                <div class="info_row">
                    <p class="info_tlt">클린필터</p>
                    <div class="info_con">
                        <div class="clean_level">
                            <p class="level1">
                                <input type="radio" name="subs_clean" value="2" id="lv1" <?=$row['clean_filter'] == 2 ? "checked":"" ?> ><label for="lv1"><span>클린</span></label>
                            </p>
                            <p class="level2">
                                <input type="radio" name="subs_clean" value="1" id="lv2" <?=$row['clean_filter'] == 1 ? "checked":"" ?> ><label for="lv2"><span>중간</span></label>
                            </p>
                            <p class="level3">
                                <input type="radio" name="subs_clean" value="0" id="lv3" <?=$row['clean_filter'] == 0 ? "checked":"" ?> ><label for="lv3"><span>없음</span></label>
                            </p>
                            <div class="clean_bar"></div>
                        </div>
                    </div>
                </div>
                <div class="info_row btn_row">
                    <button type="submit" class="blue_btn" >저장</button><button type="button">취소</button>
                </div>
            <form>
        </div>

            <div class="mylist">
            <div class="tab_menu">
                <button type="button" onclick="getWriteList()" id="write_list_tab" class="on">작성한 글</button>
                <button type="button" onclick="getCommentList()" id="comment_list_tab"  >작성한 댓글</button>
                <button type="button" onclick="getLikeList()" id="like_list_tab" >좋아요한 글</button>
            </div>
            <div class="tab_con">
                <div class="con1" style="display:block">
                    <? include "write_list.php"?>
                </div>
                <div class="con2">
                    <? include "comment_list.php"?>
                </div>
                <div class="con3">
                    <? include "likes_list.php"?>
                </div>
            </div>

    </section>
</div>

<script type="application/javascript">
    $(document).ready(function() {
        getWriteList()
    })

    $(window).on("scroll", function() {
        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();
        if ((scrollHeight - scrollPosition) / scrollHeight === 0) {

            if ($("#write_list_tab").attr("class") == "on" ) {
                if (writePage > 0) {
                    getWriteList()
                }
            }
            else if ($("#comment_list_tab").attr("class") == "on" ) {
                if (commentPage > 0) {
                    getCommentList()
                }
            }
            else if ($("#like_list_tab").attr("class") == "on" ) {
                if (likePage > 0) {
                    getLikeList()
                }
            }

        }
    });

    function imageSelected(event) {
        var reader = new FileReader;
        reader.onload = function() {
            $("#profile_img").attr("src",reader.result);
        };
        reader.readAsDataURL(event.target.files[0]);
    }

</script>
</body>
</html>

<!--

-->