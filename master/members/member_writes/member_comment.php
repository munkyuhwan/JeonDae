<table class="table table-borderless">
    <tbody>
    <?
    $comment_query = "SELECT comm.comment_txt, comm.idx, report.content_text, report.report_hashtag, report.idx AS report_idx, member.file_chg, member.real_name FROM report_comments AS comm, report_list AS report, member_info AS member WHERE comm.member_idx=".$idx." AND comm.report_idx=report.idx AND comm.member_idx=member.idx ";
    $comment_result = mysqli_query($gconnet, $comment_query);
    ?>
    <?while ($rows = mysqli_fetch_assoc($comment_result)) {?>
        <tr>
            <td>
                <div class="card" >
                    <div class="card-header table" >
                        <div style="display: table-cell; " >
                            <img width="40" src="../../upload_file/member/<?=$rows['file_chg']?>" ><?=$rows['real_name']?> <?=$rows['report_idx']?>번째 제보 | <?=$rows['report_hashtag']?>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="sorting_1">
                            <?=$rows['comment_txt']?>
                        </p>
                    </div>
                </div>
            </td>
        </tr>
    <?}?>
    </tbody>
</table>
