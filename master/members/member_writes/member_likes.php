<table class="table table-borderless">
    <tbody>
    <?
    $like_query = "SELECT likes.idx, report.content_text, report.report_hashtag, report.idx AS report_idx, report.report_hashtag, member.file_chg, member.real_name  FROM report_likes AS likes, report_list AS report, member_info AS member WHERE likes.member_idx=".$idx." AND likes.report_idx=report.idx AND report.member_idx=member.idx ";
    $like_result = mysqli_query($gconnet, $like_query);
    ?>
    <?while ($rows = mysqli_fetch_assoc($like_result)) {?>
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
                            <?=$rows['content_text']?>
                        </p>
                    </div>
                </div>
            </td>
        </tr>
    <?}?>
    </tbody>
</table>
