<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/include/toast_msg.php"; // 공통함수 인클루드 ?>
<?
$report_idx = trim(sqlfilter($_REQUEST['idx']));

$query = "SELECT report.idx AS report_idx, report.category AS categrory_idx, report.content_text, report.report_hashtag, report.bad_report, report.view_cnt, report.wdate ";
$query .= " ,report.likes, (SELECT COUNT(*) FROM report_comments WHERE report_idx=report.idx AND del_yn='N') AS comment_cnt ";
$query .= " ,member.file_chg, member.real_name ";

$query .= "FROM report_list AS report ,  member_info AS member ";

$query .= " WHERE report.member_idx=member.idx AND report.idx=".$report_idx;

$result = mysqli_query($gconnet, $query);
$data = mysqli_fetch_assoc($result);

$view_cnt = $data['view_cnt'];
$img_query = "SELECT * FROM report_additional_files WHERE report_idx=".$report_idx;
$img_result = mysqli_query($gconnet, $img_query);
$img_num = mysqli_num_rows($img_result);

$img_arr = array();
while($img_r = mysqli_fetch_assoc($img_result)) {
    array_push($img_arr, $img_r);
}


//조회수 추가

$checkIp = "SELECT COUNT(*) cnt FROM view_host WHERE ip_addr='".$_SERVER['HTTP_HOST']."'";
$checkIpResult = mysqli_query($gconnet, $checkIp);
$checkIpRow = mysqli_fetch_assoc($checkIpResult);
$ipCnt = $checkIpRow['cnt'];

if (intval($ipCnt)<=0) {
    $update = "UPDATE report_list SET view_cnt=" . (intval($view_cnt) + 1) . " WHERE idx=" . $report_idx;
    $update_result = mysqli_query($gconnet, $update);

    $insert_ip = "INSERT INTO view_host SET ip_addr='".$_SERVER['HTTP_HOST']."'";
    $insert_ip_result = mysqli_query($gconnet, $insert_ip);
}
checkPopular($report_idx, $gconnet);

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=medium-dpi">
    <meta name="format-detection" content="telephone=no, address=no, email=no">
    <title> 전대전 - 전국대신전해드립니다  </title>
    <link rel="stylesheet" type="text/css" href="../css/reset.css?ver=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="../css/style.css?ver=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="../css/notosans.css?ver=<?=time()?>">
    <link rel="stylesheet" type="text/css" href="../css/swiper.css?ver=<?=time()?>">

    <script type="text/javascript" src="../js/jquery-1.12.0.min.js?ver=<?=time()?>"></script>
    <script type="text/javascript" src="../js/main.js?ver=<?=time()?>"></script>
    <script src="//developers.kakao.com/sdk/js/kakao.min.js" ></script>
    <script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
    <script type="text/javascript" src="../js/swiper.min.js"></script>
    <script type="text/javascript" src="../js/functions.js?ver=<?=time()?>"></script>

    <meta property="fb:app_id" content="966680140341971" />
    <meta property="og:title" content="전대전 "/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="https://djund.com/main1/?idx=<?=$report_idx?>"/>
    <meta property="og:description" content="<?= nl2br($data['content_text']) ?>"/>
    <meta property="og:image" content="https://djund.com/upload_file/report/<?= $img_arr[0]["report_file_name"] ?>"/>

</head>
<style>
    .main_content {
        overflow: hidden;
        text-overflow: ellipsis;
        word-wrap: break-word;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
</style>

<body>
<div class="wrapper">
    <? include $_SERVER['DOCUMENT_ROOT']."/include/header.php"?>
    <? include $_SERVER['DOCUMENT_ROOT']."/include/main_nav.php"?>
    <section class="main_section">
        <div class="list_wrap">
            <ul id="main_list">
                <?// while ($row = mysqli_fetch_assoc($result)) { ?>
                <li class="item">
                    <div class="item_top user_box">
                        <div class="prf_box">
                            <img src="../upload_file/member/<?= $data['file_chg'] ?>" alt="">
                        </div>
                        <div class="info_box ">
                            <p class="name"><?= $data['real_name'] ?></p>
                            <div class="etc_info">
                                <p><?= date("m월 d일 h:i", strtotime($data['wdate'])) ?></p>
                                <p><?= $data['report_idx'] ?>번째 제보</p>
                                <? $hashtags = explode(",", $data['report_hashtag']) ?>
                                <? foreach ($hashtags as $v) { ?>
                                    <button type="button"><?= $v ?></button>
                                    <?
                                } ?>
                            </div>
                        </div>
                        <button type="button" class="pop_call" data-pop="post_pop" onclick="openEtcPopup(<?= $data['report_idx'] ?>)" ></button>
                    </div>
                    <div class="item_mid">
                        <div class="text_box" >
                            <p id="content_detail" class="main_content" style="display: -webkit-box;" >
                                <?= nl2br($data['content_text']) ?>
                            </p>
                        </div>
                        <button type="button" class="more_btn" onclick="$('#content_detail').css('display','inline'); $(this).css('display','none') " >
                            ...더보기
                        </button>
                        <? if (($img_num) > 0) { ?>
                            <div class="img_wrap">
                                <div class="flex_wrap">
                                    <? if (($img_num) == 1) { ?>
                                        <div class="flex2_wrap item1">
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[0]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[0]["report_file_name"] ?>" alt="">
                                            </a>
                                        </div>

                                    <? } else if (($img_num) == 2) { ?>
                                        <div class="flex2_wrap item1">
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[0]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[0]["report_file_name"] ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="flex2_wrap item1">
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[1]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[1]["report_file_name"] ?>" alt="">
                                            </a>
                                        </div>
                                    <? } else if (($img_num) == 3) { ?>
                                        <div class="flex2_wrap item2">
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[0]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[0]["report_file_name"] ?>" alt="">
                                            </a>
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[1]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[1]["report_file_name"] ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="flex2_wrap item1">
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[2]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[2]["report_file_name"] ?>" alt="">
                                            </a>
                                        </div>
                                    <? } else if (($img_num) == 4) { ?>
                                        <div class="flex2_wrap item2">
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[0]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[0]["report_file_name"] ?>" alt="">
                                            </a>
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[1]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[1]["report_file_name"] ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="flex2_wrap item2">
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[2]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[2]["report_file_name"] ?>" alt="">
                                            </a>
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[3]["idx"] ?>')">
                                                <img src="../upload_file/report/<?= $img_arr[3]["report_file_name"] ?>" alt="">
                                            </a>
                                        </div>
                                    <? } else if (($img_num) == 5) { ?>
                                        <div class="flex2_wrap item2">
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[0]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[0]["report_file_name"] ?>" alt="">
                                            </a>
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[1]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[1]["report_file_name"] ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="flex2_wrap item3">
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[2]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[2]["report_file_name"] ?>" alt="">
                                            </a>
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[3]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[3]["report_file_name"] ?>" alt="">
                                            </a>
                                            <a href="javascript:setImages('<?= $data['report_idx']?>','<?=$data['likes']?>','<?=$data['comment_cnt']?>','<?= $img_arr[4]["idx"] ?>')" class="pop_call" data-pop="img_pop">
                                                <img src="../upload_file/report/<?= $img_arr[4]["report_file_name"] ?>" alt="">
                                            </a>
                                        </div>
                                        <?
                                    } ?>
                                </div>
                            </div>
                            <?
                        } ?>
                        <div class="btn_box">
                            <button type="button" class="like_btn" id="like_btn_<?=$row['report_idx']?>" onclick="likeClick(<?= $data['report_idx'] ?>)" ><?= $data['likes'] ?></button>
                            <span class="reply_cnt"><?= $data['comment_cnt'] ?></span>
                        </div>
                    </div>
                    <div class="item_bot">
                        <div class="reply_list">
                            <?
                            $comment_query = "SELECT report.comment_txt, report.idx AS comment_idx, report.parent_idx, report.wdate, (SELECT real_name FROM member_info WHERE idx=report.member_idx ) AS member_name, (SELECT file_chg FROM member_info WHERE idx=report.member_idx ) AS file_chg  FROM report_comments AS report WHERE report.del_yn='N' AND parent_idx=0 AND report.report_idx=" . $data['report_idx'] . " ORDER BY idx DESC ";
                            $comment_res = mysqli_query($gconnet, $comment_query);
                            ?>
                            <button type="button" class="reply_all">댓글 <span><?= $data['comment_cnt'] ?></span>개 모두 보기</button>
                            <ul>
                                <? while ($r = mysqli_fetch_assoc($comment_res)) { ?>

                                    <li class="reply_item user_box" >
                                        <div class="reply_inner" >
                                            <div class="prf_box">
                                                <?if($r['file_chg']=="") {?>
                                                <?}else {?>
                                                    <img src="../upload_file/member/<?= $r['file_chg'] ?>" alt="">
                                                <?}?>
                                            </div>
                                            <div class="info_box ">
                                                <div class="reply_top">
                                                    <p class="name"><?= $r['member_name'] ?></p>
                                                    <p class="reply_txt"><?= $r['comment_txt'] ?></p>
                                                </div>
                                                <div class="etc_info">
                                                    <p><?= date("m월 d일 h:i", strtotime($r['wdate'])) ?></p>
                                                    <button type="button" onclick="$('#write_comment_<?=$data['report_idx']?>').appendTo('#comment_<?= $data['report_idx']."_".$r['comment_idx']?>'); " >답글 달기</button>
                                                </div>
                                            </div>
                                            <button type="button" class="like_btn" ></button>
                                        </div>
                                        <div id="comment_<?=$data['report_idx']."_".$r['comment_idx'] ?>" ></div>
                                        <?
                                        $sub_comment_query = "SELECT report.comment_txt, report.idx AS comment_idx, report.parent_idx, report.wdate, (SELECT real_name FROM member_info WHERE idx=report.member_idx ) AS member_name,(SELECT file_chg FROM member_info WHERE idx=report.member_idx ) AS file_chg  FROM report_comments AS report WHERE report.del_yn='N' AND parent_idx=" . $r['comment_idx'] . " ORDER BY idx DESC LIMIT 0,2";
                                        $sub_comment_res = mysqli_query($gconnet, $sub_comment_query);
                                        ?>
                                        <? if (mysqli_num_rows($sub_comment_res) > 0) { ?>
                                            <ul>
                                                <? while ($sub_row = mysqli_fetch_assoc($sub_comment_res)) { ?>
                                                    <li class="reply_item user_box" >
                                                        <div class="reply_inner">
                                                            <div class="prf_box">
                                                                <?if($r['file_chg']=="") {?>
                                                                <?}else {?>
                                                                    <img src="../upload_file/member/<?= $sub_row['file_chg'] ?>" alt="">
                                                                <?}?>
                                                            </div>
                                                            <div class="info_box ">
                                                                <div class="reply_top"><p
                                                                        class="name"><?= $sub_row['member_name'] ?></p>
                                                                    <p class="reply_txt"><?= $sub_row['comment_txt'] ?></p>
                                                                </div>
                                                                <div class="etc_info">
                                                                    <p><?= date("m월 d일 h:i", strtotime($sub_row['wdate'])) ?></p>
                                                                    <button type="button" >답글 달기</button>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="like_btn"></button>
                                                        </div>
                                                    </li>
                                                    <?
                                                    if (mysqli_num_rows($sub_comment_res) > 2) {
                                                        break;
                                                    }
                                                    ?>
                                                <?} ?>
                                            </ul>
                                        <?} ?>
                                    </li>
                                <?} ?>
                            </ul>
                        </div>
                    </div>
                    <?if ($_SESSION['user_access_idx'] != "") {?>
                        <div class="item_reply_input" id="write_comment_<?=$data['report_idx']?>">
                            <div class="prf_box">
                                <img src="<?= $profile_img ?>" alt="">
                            </div>
                            <div class="input_box">
                                <form action="write_comment_action.php" method="post" name="frm">
                                    <input type="text" name="content_txt" required>
                                    <input type="hidden" name="report_idx" id="report_idx" value="<?= $data['report_idx'] ?>">
                                    <input type="hidden" name="parent_idx" id="parent_idx">
                                    <button type="submit">게시</button>
                                </form>
                            </div>
                        </div>
                    <?}?>
                </li>
                <?//}?>
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