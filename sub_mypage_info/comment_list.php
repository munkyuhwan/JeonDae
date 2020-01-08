<?
$comment_cnt_query = "SELECT COUNT(*) AS cnt FROM report_comments AS comm, report_list AS report, member_info AS member WHERE comm.member_idx=".$idx." AND comm.report_idx=report.idx AND comm.member_idx=member.idx ";
$comment_cnt_result = mysqli_query($gconnet, $comment_cnt_query);
$comment_cnt_row = mysqli_fetch_assoc($comment_cnt_result);

?>
<p class="cnt_row"><span><?=$comment_cnt_row['cnt']?></span>개의 댓글이 있습니다.</p>
<ul id="comment_list">
</ul>
<script>
    var commentPage=0;
    var commentBlock=5;
    function getCommentList() {
        $.ajax({
            url:"get_comment_list.php",
            data:{"page":commentPage,"block":commentBlock},
            method:"POST",
            success:function(response) {
                if (response.toString() != "") {
                    $("#comment_list").append(response)
                    commentPage += commentBlock;
                }
            },
            error:function(error) {

            }
        })
    }
</script>