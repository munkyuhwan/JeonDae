<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?

$query = "SELECT main.category_name, main.idx, main.cover_img, main.profile_img ".
" FROM report_categories AS main, subscribe_list AS subscribe ".
" WHERE subscribe.category_idx=main.idx AND subscribe.member_idx=".$_SESSION['user_access_idx']." GROUP BY subscribe.category_idx ";
$result = mysqli_query($gconnet,$query);


?>
<body>
<div class="wrapper">
    <header>
        <div class="header grd_bg sub">
            <h1>구독관리</h1>
            <a class="back_btn" href="javascript:history.go(-1)"></a>
        </div>
    </header>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>

    <section class="main_section">
        <div class="subs_list">
            <ul>
                <?while($row = mysqli_fetch_assoc($result)) {?>
                    <li class="item">
                        <div class="item_top">
                            <div class="subs_img">
                                <img src="../thumb/thumb.php?src=../upload_file/category_profile/<?=$row['profile_img']?>" alt="">
                            </div>
                            <h2 class="subs_tlt"><?=$row['category_name']?> 대신 전해 드립니다</h2>
                            <?
                            $subscribe_query = "SELECT COUNT(*) AS cnt FROM subscribe_list WHERE member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$row['idx'];
                            $subscribe_result = mysqli_query($gconnet, $subscribe_query);
                            $subscribe_row = mysqli_fetch_assoc($subscribe_result);
                            ?>
                            <button type="button">구독중</button>
                        </div>
                        <div class="item_mid tag_type">
                            <h3 class="hidden">구독 카테고리</h3>
                            <ul>
                                <?
                                $report_sub_query = "SELECT * FROM report_sub_categories WHERE del_yn='N' AND report_idx=".$row['idx'];
                                $sub_cat_result = mysqli_query($gconnet, $report_sub_query);
                                ?>
                                <?while($cat_row = mysqli_fetch_assoc($sub_cat_result) ) {?>
                                    <?
                                    $check_subscribe = "SELECT COUNT(*) AS cnt FROM subscribe_list WHERE member_idx=".$_SESSION['user_access_idx']." AND sub_category_idx=".$cat_row['idx'];
                                    $check_result = mysqli_query($gconnet, $check_subscribe);
                                    $check_row = mysqli_fetch_assoc($check_result);
                                    ?>
                                    <li><input type="checkbox" id="subs<?=$cat_row['idx']?>" <?= intval($check_row['cnt'])>0 ? "checked":"" ?> ><label for="subs1<?=$cat_row['idx']?>"><?=$cat_row['sub_name']?></label></li>
                                <?}?>
                            </ul>
                        </div>
                        <div class="item_bot">
                            <h4>클린 지수 설정</h4>
                            <div class="clean_level">
                                <p class="level1">
                                    <input type="radio" name="subs_clean_<?=$row['idx']?>" id="lv1_<?=$row['idx']?>" checked><label for="lv1_<?=$row['idx']?>"><span>클린</span></label>
                                </p>
                                <p class="level2">
                                    <input type="radio" name="subs_clean_<?=$row['idx']?>" id="lv2_<?=$row['idx']?>"><label for="lv2_<?=$row['idx']?>"><span>중간</span></label>
                                </p>
                                <p class="level3">
                                    <input type="radio" name="subs_clean_<?=$row['idx']?>" id="lv3_<?=$row['idx']?>"><label for="lv3_<?=$row['idx']?>"><span>없음</span></label>
                                </p>
                                <div class="clean_bar"></div>
                            </div>
                        </div>
                    </li>
                <?}?>
                <!-- li class="item">
                    <div class="item_top">
                        <div class="subs_img">
                            <img src="images/img_sample1.png" alt="">
                        </div>
                        <h2 class="subs_tlt">광진구 대신 전해 드립니다</h2>
                        <button type="button">구독중</button>
                    </div>
                    <div class="item_mid tag_type">
                        <h3 class="hidden">구독 카테고리</h3>
                        <ul>
                            <li><input type="checkbox" id="subs1"><label for="subs1">일상</label></li>
                            <li><input type="checkbox" id="subs2"><label for="subs2">중고거래</label></li>
                            <li><input type="checkbox" id="subs3"><label for="subs3">알바</label></li>
                            <li><input type="checkbox" id="subs4"><label for="subs4">동호회</label></li>
                            <li><input type="checkbox" id="subs5"><label for="subs5">인디밴드</label></li>
                            <li><input type="checkbox" id="subs6"><label for="subs6">20대</label></li>
                            <li><input type="checkbox" id="subs7"><label for="subs7">30대</label></li>
                            <li><input type="checkbox" id="subs8"><label for="subs8">40대</label></li>
                            <li><input type="checkbox" id="subs9"><label for="subs9">심야영화</label></li>
                            <li><input type="checkbox" id="subs10"><label for="subs10">기타</label></li>
                        </ul>
                    </div>
                    <div class="item_bot">
                        <h4>클린 지수 설정</h4>
                        <div class="clean_level">
                            <p class="level1">
                                <input type="radio" name="subs_clean" id="lv1" checked><label for="lv1"><span>클린</span></label>
                            </p>
                            <p class="level2">
                                <input type="radio" name="subs_clean" id="lv2"><label for="lv2"><span>중간</span></label>
                            </p>
                            <p class="level3">
                                <input type="radio" name="subs_clean" id="lv3"><label for="lv3"><span>없음</span></label>
                            </p>
                            <div class="clean_bar"></div>
                        </div>
                    </div>
                </li>
                <li class="item">
                    <div class="item_top">
                        <div class="subs_img">
                            <img src="images/img_sample1.png" alt="">
                        </div>
                        <h2 class="subs_tlt">광진구 대신 전해 드립니다</h2>
                        <button type="button">구독중</button>
                    </div>
                    <div class="item_mid tag_type">
                        <h3 class="hidden">구독 카테고리</h3>
                        <ul>
                            <li><input type="checkbox" id="subs1"><label for="subs1">일상</label></li>
                            <li><input type="checkbox" id="subs2"><label for="subs2">중고거래</label></li>
                            <li><input type="checkbox" id="subs3"><label for="subs3">알바</label></li>
                            <li><input type="checkbox" id="subs4"><label for="subs4">동호회</label></li>
                            <li><input type="checkbox" id="subs5"><label for="subs5">인디밴드</label></li>
                            <li><input type="checkbox" id="subs6"><label for="subs6">20대</label></li>
                            <li><input type="checkbox" id="subs7"><label for="subs7">30대</label></li>
                            <li><input type="checkbox" id="subs8"><label for="subs8">40대</label></li>
                            <li><input type="checkbox" id="subs9"><label for="subs9">심야영화</label></li>
                            <li><input type="checkbox" id="subs10"><label for="subs10">기타</label></li>
                        </ul>
                    </div>
                    <div class="item_bot">
                        <h4>클린 지수 설정</h4>
                        <div class="clean_level">
                            <p class="level1">
                                <input type="radio" name="subs_clean" id="lv1" checked><label for="lv1"><span>클린</span></label>
                            </p>
                            <p class="level2">
                                <input type="radio" name="subs_clean" id="lv2"><label for="lv2"><span>중간</span></label>
                            </p>
                            <p class="level3">
                                <input type="radio" name="subs_clean" id="lv3"><label for="lv3"><span>없음</span></label>
                            </p>
                            <div class="clean_bar"></div>
                        </div>
                    </div>
                </li -->
            </ul>
        </div>

    </section>
</div>
</body>
</html>

<!--

-->