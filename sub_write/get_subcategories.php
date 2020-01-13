<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<?
$categoryIdx = trim(sqlfilter($_REQUEST['category_idx']));

$query = "SELECT * FROM report_sub_categories WHERE report_idx=".$categoryIdx." AND del_yn='N' ";
$result = mysqli_query($gconnet, $query);

$response = array();

?>
<? while($row = mysqli_fetch_assoc($result)) {?>
    <li>
        <input type="radio" name="subcategories[]" value="<?=$row['sub_name']?>"  id="subcategory_<?=$row['idx']?>" >
        <label for="subcategory_<?=$row['idx']?>">
            <?=$row['sub_name']?>
        </label>
    </li>
<?}?>
