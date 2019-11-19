    <table class="table table-borderless">
        <tbody>
        <?
        $report_query = "SELECT report.idx AS report_idx, report.content_text, report.report_hashtag, member.real_name, member.file_chg  FROM report_list AS report, member_info AS member WHERE report.del_yn='N' AND report.member_idx=member.idx AND report.member_idx=".$idx;
        $report_result = mysqli_query($gconnet, $report_query);
        ?>
        <?while ($rows = mysqli_fetch_assoc($report_result)) {?>
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
