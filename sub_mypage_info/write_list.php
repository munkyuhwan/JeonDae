<?
$write_cnt_query = "SELECT COUNT(*) AS cnt FROM report_list WHERE complete_yn='Y' AND del_yn='N' AND member_idx=".$_SESSION['user_access_idx'];
$write_cnt_result = mysqli_query($gconnet, $write_cnt_query);
$cnt_row = mysqli_fetch_assoc($write_cnt_result);
?>
<p class="cnt_row"><span><?=$cnt_row['cnt']?></span>개의 글이 있습니다.</p>
<ul id="write_list">
</ul>

