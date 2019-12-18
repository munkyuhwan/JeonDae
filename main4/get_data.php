<? include $_SERVER['DOCUMENT_ROOT']."/pro_inc/include_default.php";?>
<?
$query = "SELECT alarm.* FROM alarm_list AS alarm WHERE alarm.member_idx=".$_SESSION['user_access_idx']." ";
$result = mysqli_query($gconnet, $query);

?>
<?while ( $row = mysqli_fetch_assoc($result) ) {?>
    <?
    if ($row['alarm_type'] == "PUBL") {
        $detail_query = "SELECT report.content_text, categories.category_name, categories.profile_img, report.wdate FROM report_list AS report, report_categories AS categories ";
        $detail_query .= "  WHERE report.category=categories.idx ";
        $detail_query .= " AND report.idx=" . $row['report_idx'];

        $detail_result = mysqli_query($gconnet, $detail_query);
        $detail_row = mysqli_fetch_assoc($detail_result);

        $alarm_title = $detail_row['category_name'];
        $alarm_content = $detail_row['content_text'];
        ?>
        <li class="item">
            <div class="alrim_type type1"> <!-- ���� -->
                <img src="../upload_file/category_profile/<?=$detail_row['profile_img']?>" alt="">
            </div>
            <div class="tlt">�� ������ [<span><?=$alarm_title?></span>]�� ����Ǿ����ϴ�.</div>
            <div class="desc"><?=$alarm_content?> </div>
            <div class="date"><?=date("m�� d�� H:i", strtotime($detail_row['wdate']))?></div>
        </li>

    <?} else if ($row['alarm_type'] == "LIKE") {?>
        <?
        $detail_query = "SELECT content_text, likes, wdate FROM report_list WHERE idx=".$row['report_idx'];
        $detail_result = mysqli_query($gconnet, $detail_query);
        $detail_row = mysqli_fetch_assoc($detail_result);
        ?>
        <li class="item">
            <div class="alrim_type type2"> <!-- ���ƿ� -->
                <img src="../images/icon_heart.png" alt="" width="32">
            </div>
            <div class="tlt">�� ������ <span><?=$detail_row['likes']?>��</span>�� ������ ����մϴ�.</div>
            <div class="desc"><?=$detail_row['content_text']?></div>
            <div class="date"><?=date("m�� d�� H:i", strtotime($detail_row['wdate']))?></div>
        </li>
    <?}else if ($row['alarm_type'] == "TOP") {?>
        <?
        $detail_query = "SELECT content_text, wdate FROM report_list WHERE idx=".$row['report_idx'];
        $detail_result = mysqli_query($gconnet, $detail_query);
        $detail_row = mysqli_fetch_assoc($detail_result);
        ?>
        <li class="item">
            <div class="alrim_type type3"> <!-- �α��� -->
                <img src="../images/icon_popular.png" alt="" width="20">
            </div>
            <div class="tlt">�� ������ �α� �Խù��� ��ϵǾ����ϴ�!</div>
            <div class="desc"><?=$detail_row['content_text']?></div>
            <div class="date"><?=date("m�� d�� H:i", strtotime($detail_row['wdate']))?></div>
        </li>
    <?}?>
<?}?>