<? include$_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$report_idx = trim(sqlfilter($_REQUEST['report_idx']));

$comment_cnt_query = "SELECT COUNT(*) AS comment_cnt FROM report_comments WHERE report_idx=".$report_idx;
$comment_cnt_result = mysqli_query($gconnet, $comment_cnt_query);
$comment_cnt = mysqli_fetch_assoc($comment_cnt_result);

$comment_query = "SELECT mom.*, (SELECT real_name FROM member_info WHERE idx=mom.member_idx ) AS member_name, (SELECT file_chg FROM member_info WHERE idx=mom.member_idx ) AS file_chg, (SELECT user_id FROM member_info WHERE idx=mom.member_idx ) AS user_id  FROM report_comments AS mom WHERE mom.report_idx=".$report_idx." AND mom.parent_idx=0  ";
$comment_res = mysqli_query($gconnet, $comment_query);
?>
<? while ($r = mysqli_fetch_assoc($comment_res)) { ?>
    <li class="reply_item user_box" >
        <div class="reply_inner" id="div_<?=$r['comment_idx']?>" >
            <div class="prf_box">
                <?if ($r['file_chg'] == "") {?>
                <?}else {?>
                    <img src="../thumb/thumb.php?src=../upload_file/member/<?= $r['file_chg'] ?>&size=<500" alt="">
                <?}?>
            </div>
            <div class="info_box ">
                <div class="reply_top">
                    <p class="name"><?= $r['member_name'] ?></p>
                    <p class="reply_txt"><?= $r['comment_txt'] ?></p>
                </div>
                <div class="etc_info">
                    <p><?= date("m월 d일 h:i", strtotime($r['wdate'])) ?></p>
                    <button type="button" onclick="$('.item_reply_input').hide(); $('.item_replay_main').show(); $('#comment_box_<?= $r['idx'] ?>').toggle() " >답글 달기</button>
                </div>
            </div>
            <?
            $select = "SELECT COUNT(*) cnt FROM comment_likes WHERE comment_idx=".$r['idx']." AND member_idx=".$_SESSION['user_access_idx'];
            $select_result = mysqli_query($gconnet, $select);
            $select_row = mysqli_fetch_assoc($select_result);
            $cnt = $select_row['cnt'];
            ?>
            <button type="button" class="like_btn <?=$cnt > 0 ? 'on':'';?>" id="comment_like_<?=$r['idx']?>" onclick=" commentLikeClicked(<?=$r['idx']?>); "  >
                <span style="margin-left: 30px;" id="comment_cnt_<?=$r['idx']?>" ><?=$cnt?></span>
            </button>
            <!-- button type="button" class="like_btn" onclick="commentLikeClicked(<?=$r['idx']?>);" ></button -->
        </div>
        <?
        $son_comment_query = "SELECT son.*,
                                                            (SELECT real_name FROM member_info WHERE idx=son.member_idx ) AS member_name,
                                                            (SELECT file_chg FROM member_info WHERE idx=son.member_idx ) AS file_chg,
                                                            (SELECT user_id FROM member_info WHERE idx=son.member_idx ) AS user_id
                                                            FROM report_comments AS son
                                                            WHERE parent_idx=".$r['idx']." ORDER BY seq ASC " ;

        $son_comment_result = mysqli_query($gconnet, $son_comment_query);
        ?>
        <ul>
            <div class="item_reply_input" id="comment_box_<?=$r['idx']?>" style="display: none;" >
                <div class="prf_box">
                    <img src="../thumb/thumb.php?src=../upload_file/member/<?= $profile_img_assoc["file_chg"] ?>&size=<300" alt="">
                </div>
                <div class="input_box">
                    <form action="write_comment_action.php" method="post" name="frm">
                        <input type="text" name="content_txt" required>
                        <input type="hidden" name="report_idx" id="report_idx" value="<?= $report_idx ?>">
                        <input type="hidden" name="parent_idx" id="parent_idx" value="<?=$r['idx']?>">
                        <button type="submit">게시</button>
                    </form>
                </div>
            </div>
            <? while($son=mysqli_fetch_assoc($son_comment_result)) {?>
                <li class="reply_item user_box" >
                    <div class="reply_inner" id="div_<?=$son['comment_idx']?>" >
                        <div class="prf_box">
                            <?if ($son['file_chg'] == "") {?>
                            <?}else {?>
                                <img src="../thumb/thumb.php?src=../upload_file/member/<?= $son['file_chg'] ?>&size=<500" alt="">
                            <?}?>
                        </div>
                        <div class="info_box ">
                            <div class="reply_top">
                                <p class="name"><?= $son['member_name'] ?></p>
                                <p class="reply_txt"><?= $son['comment_txt'] ?></p>
                            </div>
                            <div class="etc_info">
                                <p><?= date("m월 d일 h:i", strtotime($son['wdate'])) ?></p>
                                <button type="button" onclick="$('.item_reply_input').hide(); $('.item_replay_main').show(); $('#comment_box_<?= $son['idx'] ?>').toggle() " >답글 달기</button>
                            </div>
                        </div>
                        <?
                        $select = "SELECT COUNT(*) cnt FROM comment_likes WHERE comment_idx=".$son['idx']." AND member_idx=".$_SESSION['user_access_idx'];
                        $select_result = mysqli_query($gconnet, $select);
                        $select_row = mysqli_fetch_assoc($select_result);
                        $cnt = $select_row['cnt'];
                        ?>
                        <button type="button" class="like_btn  <?=$cnt > 0 ? 'on':'';?>"  id="comment_like_<?=$son['idx']?>"  onclick=" commentLikeClicked(<?=$son['idx']?>); "  >
                            <span style="margin-left: 30px;" id="comment_cnt_<?=$son['idx']?>" ><?=$cnt?></span>
                        </button>
                        <!-- button type="button" class="like_btn" onclick=" commentLikeClicked(<?=$son['idx']?>); " ></button -->
                    </div>
                    <div class="item_reply_input" id="comment_box_<?=$son['idx']?>" style="display: none;" >
                        <div class="prf_box">
                            <img src="../thumb/thumb.php?src=../upload_file/member/<?= $profile_img_assoc["file_chg"] ?>&size=<300" alt="">
                        </div>
                        <div class="input_box">
                            <form action="write_comment_action.php" method="post" name="frm">
                                <input type="text" name="content_txt" required>
                                <input type="hidden" name="report_idx" id="report_idx" value="<?= $report_idx?>">
                                <input type="hidden" name="parent_idx" id="parent_idx" value="<?= $r['idx'] ?>">
                                <input type="hidden" name="comment_to" id="comment_to" value="<?= $son['idx'] ?>">
                                <input type="hidden" name="seq" id="seq" value="<?=$son['seq']?>">
                                <button type="submit">게시</button>
                            </form>
                        </div>
                    </div>
                </li>
                <?
            }?>
        </ul>
    </li>

    <?
}?>