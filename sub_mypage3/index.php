<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
$query = "SELECT main.category_name, main.idx, main.cover_img, main.profile_img ".
" FROM report_categories AS main, subscribe_list AS subscribe ".
" WHERE subscribe.category_idx=main.idx AND subscribe.member_idx=".$_SESSION['user_access_idx']." GROUP BY subscribe.category_idx ";
$result = mysqli_query($gconnet,$query);
?>
<script type="application/javascript">
    function updateCleanIndex(categoryIdx, cleanIndex) {
        $.ajax({
            url:"update_clean_index.php",
            data:{"categoryIdx":categoryIdx,"cleanIdx":cleanIndex},
            success:function(response) {
                try {
                    var res = JSON.parse(response);
                    if(res.result==true) {
                        toast(res.msg)
                    }
                }catch (e) {

                }
            },
            error:function(error) {

            }
        })
    }

    function cancelSubscribe(idx) {
        if( confirm("구독 취소를 하시겠습니까?") ) {
            $.ajax({
                url: "../main2/subscribe.php",
                method: "POST",
                data: {"idx": idx, "sub_yn": false},
                success: function (response) {
                    try{
                        var res = JSON.parse(response);

                        if (res.result == "success") {
                            alert("구독이 취소되었습니다.");
                            location.reload();
                        }

                    }catch (e) {

                    }
                },
                error: function (err) {

                }
            })
        }
    }

    function hashtagSelection(idx, category_idx) {

        $.ajax({
            url:"delete_sub_cat.php",
            data:{"idx":idx,"category_idx":category_idx},
            success:function(response) {
                try{
                    var res = JSON.parse(response);

                    if (res.result == "success") {
                        //alert("해시태그 구독이 취소되었습니다.");
                        location.reload();
                    }

                }catch (e) {

                }
            },
            error:function(error) {

            }
        })

    }

</script>
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
                                <img src="../upload_file/category_profile/<?=$row['profile_img']?>" alt="">
                            </div>
                            <h2 class="subs_tlt"><?=$row['category_name']?> 대신 전해 드립니다</h2>
                            <?
                            $subscribe_query = "SELECT COUNT(*) AS cnt FROM subscribe_list WHERE member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$row['idx'];
                            $subscribe_result = mysqli_query($gconnet, $subscribe_query);
                            $subscribe_row = mysqli_fetch_assoc($subscribe_result);
                            ?>
                            <button type="button" onclick="cancelSubscribe('<?=$row['idx']?>')" >구독중</button>
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
                                    <li>
                                        <input type="checkbox" id="subs1<?=$cat_row['idx']?>" <?= intval($check_row['cnt'])>0 ? "checked":"" ?> onclick="hashtagSelection('<?=$cat_row['idx']?>','<?=$row['idx']?>')" >
                                        <label for="subs1<?=$cat_row['idx']?>">
                                            <?=$cat_row['sub_name']?>
                                        </label>
                                    </li>
                                <?}?>
                            </ul>
                        </div>
                        <div class="item_bot">
                            <h4>클린 지수 설정</h4>
                            <?
                            $clean_query = "SELECT * FROM user_clean_index WHERE member_idx=".$_SESSION['user_access_idx']." AND category_idx=".$row['idx'];
                            $clean_result = mysqli_query($gconnet, $clean_query);
                            $clean_index = mysqli_fetch_assoc($clean_result);
                            ?>
                            <div class="clean_level">
                                <p class="level1">
                                    <input type="radio" name="subs_clean_<?=$row['idx']?>" value="2" onclick="updateCleanIndex(<?=$row['idx']?>, '2')" <?=$clean_index['clean_index']=='2'?"checked":""?> id="lv1_<?=$row['idx']?>"><label for="lv1_<?=$row['idx']?>"><span>클린</span></label>
                                </p>
                                <p class="level2">
                                    <input type="radio" name="subs_clean_<?=$row['idx']?>" value="1" onclick="updateCleanIndex(<?=$row['idx']?>, '1')" <?=$clean_index['clean_index']=='1'?"checked":""?> id="lv2_<?=$row['idx']?>"><label for="lv2_<?=$row['idx']?>"><span>중간</span></label>
                                </p>
                                <p class="level3">
                                    <input type="radio" name="subs_clean_<?=$row['idx']?>" value="0" onclick="updateCleanIndex(<?=$row['idx']?>, '0')" <?=$clean_index['clean_index']=='0'?"checked":""?> id="lv3_<?=$row['idx']?>"><label for="lv3_<?=$row['idx']?>"><span>없음</span></label>
                                </p>
                                <div class="clean_bar"></div>
                            </div>
                        </div>
                    </li>
                <?}?>
            </ul>
        </div>

    </section>
</div>
</body>
</html>

<!--

-->