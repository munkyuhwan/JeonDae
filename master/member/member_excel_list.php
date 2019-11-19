<? include "../../pro_inc/include_default.php"; // ERP 와 독립적인 DB 커넥션

$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);
$v_sect = sqlfilter($_REQUEST['v_sect']); // 회원, 지점
$s_gubun = sqlfilter($_REQUEST['s_gubun']); // 일반, VIP
$s_level = sqlfilter($_REQUEST['s_level']); // 회원등급
$s_gender = sqlfilter($_REQUEST['s_gender']); // 성별
$s_sect1 = trim(sqlfilter($_REQUEST['s_sect1'])); // 로그인 구분
$s_sect2 = trim(sqlfilter($_REQUEST['s_sect2'])); // 추천인 (지점) 별
$s_cnt = trim(sqlfilter($_REQUEST['s_cnt'])); // 목록 갯수 
$s_order = trim(sqlfilter($_REQUEST['s_order'])); // 목록 정렬 
################## 파라미터 조합 #####################
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&keyword='.$keyword.'&v_sect='.$v_sect.'&s_gubun='.$s_gubun.'&s_level='.$s_level.'&s_gender='.$s_gender.'&s_sect1='.$s_sect1.'&s_sect2='.$s_sect2.'&s_cnt='.$s_cnt.'&s_order='.$s_order;

$where = " and memout_yn != 'Y' and memout_yn != 'S' ";
//$where .= " and member_gubun = '".$s_gubun."' ";

if($s_gubun == "NOR"){
	$member_sect_str = "일반";
} elseif($s_gubun == "SPE"){
	$member_sect_str = "VVIP 멤버십";
}

if(!$pageNo){
	$pageNo = 1;
}

if(!$s_cnt){
	$s_cnt = 10; // 기본목록 10개
}

if(!$s_order){
	$s_order = 1; 
}

if($v_sect){
	$where .= "and member_type = '".$v_sect."'";
}

if($s_gubun){
	$where .= " and member_gubun = '".$s_gubun."' ";
}

if($s_level){
	$where .= " and user_level = '".$s_level."' ";
}

if($s_gender){
	$where .= " and gender = '".$s_gender."' ";
}

if($s_sect1){
	$where .= " and login_ok = '".$s_sect1."' ";
}

if($s_sect2){
	$where .= " and chuchun_idx = '".$s_sect2."' ";
}

if ($field && $keyword){
	$where .= "and ".$field." like '%".$keyword."%'";
}

$pageScale = $s_cnt;  
$start = ($pageNo-1)*$pageScale;

$StarRowNum = (($pageNo-1) * $pageScale);
$EndRowNum = $pageScale;

if($s_order == 1){
	$order_by = " order by wdate desc ";
} elseif($s_order == 2){
	$order_by = " order by wdate asc ";
} elseif($s_order == 3){
	$order_by = " order by user_name asc ";
} elseif($s_order == 4){
	$order_by = " order by user_name desc ";
}

$query = "select *,(select com_name from member_info where 1 and member_type='PAT' and idx=a.chuchun_idx) as recom_name,(select payment_sect from order_member where 1 and idx=a.payment_idx) as payment_sect from member_info a where 1 ".$where.$order_by;

//echo "<br><br>쿼리 = ".$query."<br><Br>"; //exit;

//echo $query;

$result = mysqli_query($gconnet,$query);

if($s_sect2){
	$b_name_sql = "select com_name from member_info where 1 and idx='".$s_sect2."'";
	$b_name_query = mysqli_query($GLOBALS['gconnet'],$b_name_sql);
	$b_name_row = mysqli_fetch_array($b_name_query);
	$b_name = $b_name_row['com_name']." 추천인별 ";
}

$pay_str = "회원리스트";

if($b_name){
	$pay_str =  $pay_str."_".$b_name;
} else {
	$pay_str =  $pay_str;
}

$pay_str =  iconv("UTF-8","EUC-KR",$pay_str);

$filename = $pay_str."_".date("Y-m-d").".xls";
//$filename = iconv("UTF-8","EUC-KR",$filename);
//if($_SERVER['REMOTE_ADDR'] != "121.167.147.150"){	
Header( "Content-type: application/vnd.ms-excel" ); 
Header( "Content-Disposition: attachment; filename=".$filename ); 
Header( "Content-Description: PHP4 Generated Data" );
?>

<head>
			<meta http-equiv=Content-Type content="text/html; charset=ks_c_5601-1987">
		</head>
		

		<table border width="100%">
		<tr bgcolor=#CCCCCC align="center">
			<td><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","아이디")?></strong></font></td>
			<td><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","성명")?></strong></font></td>
			<td><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","연락처")?></strong></font></td>
			<td><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","이메일")?></strong></font></td>
			<td><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","주 거래 증권사")?></strong></font></td>
			<td><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","추천인")?></strong></font></td>
		<?if($s_gubun == "SPE"){?>
			<td><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","VVIP 가입기간")?></strong></font></td>
			<td><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","VVIP 종료일")?></strong></font></td>
		<?}?>
			<td><font color="#669900"><strong><?=iconv("UTF-8","EUC-KR","등록일시")?></strong></font></td>
		</tr>
		<? if(mysqli_num_rows($result)==0) { ?>
				<tr>
					<td colspan="20" height="40"><strong><?=$pay_str?> <?=iconv("UTF-8","EUC-KR","내역이 없습니다.")?></strong></td>
				</tr>
		<? } ?>
		<?
		for ($ikm=0; $ikm<mysqli_num_rows($result); $ikm++){
				$row = mysqli_fetch_array($result);

				if($row[login_ok] == "Y"){
									$login_ok = "<font style='color:blue;'>로그인 가능</font>";
								}elseif($row[login_ok] == "N"){
									$login_ok = "<font style='color:red;'>로그인 차단</font>";
								}

								if($row[master_ok] == "Y"){
									$master_ok = "<font style='color:blue;'>승인</font>";
								}elseif($row[master_ok] == "N"){
									$master_ok = "<font style='color:red;'>미승인</font>";
								}

								$member_level_sql = "select level_name from member_level_set where 1=1 and level_code = '".$row[user_level]."' ";   
								$member_level_query = mysqli_query($gconnet,$member_level_sql);
								$member_level_row = mysqli_fetch_array($member_level_query);
								$user_level_str = $member_level_row['level_name'];

								if($row[gender] == "M"){
									$gender = "남성";
								} elseif($row[gender] == "F"){
									$gender = "여성";
								} else {
									$gender = "";
								}

								if($row['payment_sect'] == "pm_vip1"){
									$payment_sect_str = "1 개월";
								} elseif($row['payment_sect'] == "pm_vip2"){
									$payment_sect_str = "2 개월";
								} elseif($row['payment_sect'] == "pm_vip3"){
									$payment_sect_str = "3 개월";
								}
		?>
		<tr bgcolor=#ffffff align="center" height="22">
			<td ><?=$row['user_id']?></td>
			<td ><?=iconv("UTF-8","EUC-KR",$row['user_name'])?></td>
			<td ><?=$row['cell']?></td>
			<td ><?=$row['email']?></td>
			<td ><?=iconv("UTF-8","EUC-KR",$row['m_channel'])?></td>
			<td ><?=iconv("UTF-8","EUC-KR",$row['recom_name'])?></td>
		<?if($s_gubun == "SPE"){?>
			<td ><?=iconv("UTF-8","EUC-KR",$payment_sect_str)?></td>
			<td ><?=substr($row[payment_period],0,10)?></td>
		<?}?>
			<td ><?=$row['wdate']?></td>
		</tr>
		<?
		}
		?>
		</table>