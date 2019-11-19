<?
if($_include_function_query){
	return;
}else{
	$_include_function_query = true;
}
?>
<?
$debug = true;

//공통 내용 출력
function MgrGeneralView($tableName, $pkColumn, $value,$where=""){
	$query = "select * from ".$tableName." where ".$pkColumn."='".$value."'";
	
	if($where){
		$query .= $where;
	}

	//if($debug){
		//echo $query;
	//}

	$result = mysqli_query($gconnet,$query);
	
	return $result;
}

#######################################################################################
function chMgrGeneralView($ch_tableName, $ch_pkColumn, $ch_value){
	$query = "select * from ".$ch_tableName." where ".$ch_pkColumn."='".$ch_value."'";
//echo $query;
	$ch_result = mysqli_query($gconnet,$query);
	return $ch_result;
}
#########################################################################################

//공통 내용 삭제
function MgrGeneralDelete($tableName, $pkColumn, $value){
	$query = "delete from ".$tableName." where ".$pkColumn."='".$value."'";

	//if($debug){
		//echo $query;
	//}

	$result = mysqli_query($gconnet,$query);

	return $result;
}

//공통목록 출력
function MgrGeneralList($tableName, $orderBy, $field, $keyword, $pageNo, $pageScale, $where=""){
	$query = "select * from ".$tableName." where 1=1 ";
	
	if($field == "shopall"){
		if ($field){
		$query .= "and ( pro_name like '%$keyword%' or pro_tag like '%$keyword%' or pro_detail like '%$keyword%' or pro_detail_s like '%$keyword%' ) ";
		}
	} else { 
		if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
		}
	}

	if($where){
		$query .= $where;
	}
	$query .= " order by ".$orderBy;

	$start = ($pageNo-1)*$pageScale;
	$query .= " LIMIT ".$start.", ".$pageScale;
	
	/*echo $field."<br>";
	echo $keyword."<br>";*/
	//echo $query;

	$result = mysqli_query($gconnet,$query);
	
	return $result;
}

function MgrGeneralList_pt($tableName, $orderBy, $field, $keyword, $pageNo, $pageScale, $where=""){
	$query = "select * from ".$tableName." where 1=1 ";
	
	if ($keyword){
	$query .= "and (branch_name like '%".$keyword."%' or branch_tel like '%".$keyword."%' or branch_content like '%".$keyword."%' ) ";
	}
	
	if($where){
		$query .= $where;
	}
	$query .= " order by ".$orderBy;

	$start = ($pageNo-1)*$pageScale;
	$query .= " LIMIT ".$start.", ".$pageScale;

	//echo $query;

	$result = mysqli_query($gconnet,$query);
	
	return $result;
}

//공통 카운트
function MgrGeneralListCount($tableName, $field, $keyword, $where=""){
	$query = "select * from ".$tableName." where 1=1 ";
	
	if($field == "shopall"){
		if ($field){
		$query .= "and ( pro_name like '%$keyword%' or pro_maker like '%$keyword%' or maker_model like '%$keyword%' or maker_organ like '%$keyword%' or pro_tag like '%$keyword%' or pro_detail like '%$keyword%' or pro_detail_s like '%$keyword%' ) ";
		}
	} else { 
		if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
		}
	}

	if($where){
		$query .= $where;
	}
			
  //echo $query;
	
	$result = mysqli_query($gconnet,$query);
	//$row = mysqli_fetch_array($result);
	//return $row[cnt];
	return mysqli_num_rows($result);
}

function MgrGeneralListCount_pt($tableName, $field, $keyword, $where=""){
	$query = "select * from ".$tableName." where 1=1 ";
	
	if ($keyword){
	$query .= "and (branch_name like '%".$keyword."%' or branch_tel like '%".$keyword."%' or branch_content like '%".$keyword."%' ) ";
	}

	if($where){
		$query .= $where;
	}
			
  //echo $query;
	
	$result = mysqli_query($gconnet,$query);
	//$row = mysqli_fetch_array($result);
	//return $row[cnt];
	return mysqli_num_rows($result);
}

// 복수 필드 검색 목록 출력
function MgrGeneralList_ar($tableName, $orderBy, $field, $keyword, $pageNo, $pageScale, $where=""){
	$query = "select * from ".$tableName." where 1=1 ";
	
	$field_arr = explode(",",$field);
	
	if($keyword){
		$query .= " and ( ";
		for($k=0; $k<sizeof($field_arr); $k++){
			
			if($k == sizeof($field_arr)-1){
			$query .= $field_arr[$k]." like '%".$keyword."%' ";
			} else {
			$query .= $field_arr[$k]." like '%".$keyword."%' or ";
			}
		
		}
		$query .= " ) ";
	}

	if($where){
		$query .= $where;
	}
	$query .= " order by ".$orderBy;

	$start = ($pageNo-1)*$pageScale;
	$query .= " LIMIT ".$start.", ".$pageScale;

	//echo $query;

	$result = mysqli_query($gconnet,$query);
	
	return $result;
}

//복수 필드 검색 카운트
function MgrGeneralListCount_ar($tableName, $field, $keyword, $where=""){
	$query = "select * from ".$tableName." where 1=1 ";
	
	$field_arr = explode(",",$field);
	
	if($keyword){
		$query .= " and ( ";
		for($k=0; $k<sizeof($field_arr); $k++){
			
			if($k == sizeof($field_arr)-1){
			$query .= $field_arr[$k]." like '%".$keyword."%' ";
			} else {
			$query .= $field_arr[$k]." like '%".$keyword."%' or ";
			}
		
		}
		$query .= " ) ";
	}
	
	if($where){
		$query .= $where;
	}
			
	//echo $query;
	
	$result = mysqli_query($gconnet,$query);
	//$row = mysqli_fetch_array($result);
	//return $row[cnt];
	return mysqli_num_rows($result);
}

//우편번호 검색
function MgrZipCodeSearch($dong){
	if(!$dong){
		return;
	}

	$query = "select * from zipcode where dong like '%".trim($dong)."%' order by zipcode asc";
	$result = mysqli_query($gconnet,$query);

	return $result;
}

// 게시판 답글
function MgrBbsReply($bbs, $no, $ref, $step, $depth, $subject, $writer, $passwd, $content, $file1_name, $file1_o, $file2_name="", $file2_o="",$ip, $is_html, $email, $is_secure,$is_popup,$regi_date,$user_id,$view_id,$status="",$p_no){

	$query = "update bbs set step=(step+1) where bbs_code='$bbs' and ref=".$ref." and step>".$step;
	//echo $query; exit;
	mysqli_query($gconnet,$query);

	if ($step ==0){
		$step = 1;
	} else {
		$step = $step+1;
	}
	$depth = $depth +1;

	/*
	echo $ref."<br>";
	echo $step."<br>";
	echo $depth."<br>";
	exit;
	*/
	$result = MgrBbsWrite($bbs, $subject, $writer, $passwd, $content, $file1_name, $file1_o, $file2_name, $file2_o, $ip, $is_html, $email, $ref, $step, $depth, $is_secure,$is_popup,$regi_date,$user_id,$view_id,$status,NULL,NULL,$p_no);

	return $result;

}

// 게시판 수정
function MgrBbsModify($bbs, $subject, $writer, $passwd, $content, $file_up_name1, $file_up_org1,$file_up_name2="", $file_up_org2="", $ip, $is_html, $email, $is_secure, $is_popup, $regi_date, $cate_1vs1,$no){

	$query = " update bbs set "; 
	$query .= " subject = '".$subject."', ";
	if ($writer != ""){
	$query .= " writer = '$writer', "; 
	}
	if ($regi_date != ""){
	//$query .= " write_time = now(), "; 
	}
	$query .= " content = '".$content."', ";
	$query .= " file_c = '".$file_up_name1."', ";
	$query .= " file_o = '".$file_up_org1."', ";
	$query .= " file_c2 = '".$file_up_name2."', ";
	$query .= " file_o2 = '".$file_up_org2."', ";
	$query .= " ip = '".$ip."', ";
	$query .= " is_html = '".$is_html."', ";
	$query .= " email = '".$email."', ";
	$query .= " is_secure = '".$is_secure."', ";
	$query .= " 1vs1_cate = '".$cate_1vs1."', ";
	$query .= " is_popup = '".$is_popup."' ";
	$query .= " where no='$no' and bbs_code='$bbs' ";

	//echo $query;
	//exit;

	$result = mysqli_query($gconnet,$query);
	return $result;
}

// 상담댓글게시물 등록시 진행상황 수정
function MgrBbsModify_counsel($bbs, $no, $f){

	$query = " update bbs set "; 
	$query .= " re_YN = '$f' ";
	$query .= " where no='$no' and bbs_code='$bbs' ";

	//echo $query;
	//exit;

	$result = mysqli_query($gconnet,$query);
	return $result;
}

// 게시판 삭제
function MgrBbsDelete($bbs, $no){
	$query = "delete from bbs where bbs_code='$bbs' and no='$no'";
	$result = mysqli_query($gconnet,$query);

	return $result;
}

// 게시판 입력
function MgrBbsWrite($bbs, $subject, $writer, $passwd, $content, $file1_name, $file1_o, $file2_name="", $file2_o="",$ip, $is_html, $email, $ref, $step, $depth, $is_secure, $is_popup ,$regi_date,$user_id,$view_id,$status="",$cate_1vs1="",$cell_1vs1="",$p_no){

	if($ref){
		$max = $ref;
	}else{
		//$query = "select max(ref) as max from bbs where bbs_code='$bbs'";
		$query = "select max(ref) as max from bbs where 1=1 ";
		$result = mysqli_query($gconnet,$query);
		$row = mysqli_fetch_array($result);
		if ($row[max]){
			$max = $row[max]+1;
		} else{
			$max = 1;
		}
	}

	//$c_time = date("H:i:s");
	//$regi_date2 = $regi_date." ".$c_time;
	if (!$regi_date){
	$regi_date = date("Y-m-d H:i:s");
	}
	/*
	echo $max."<br>";
	echo $step."<br>";
	echo $depth."<br>";
	exit;
	*/
	$query = " insert into bbs set "; 
	$query .= " bbs_code = '".$bbs."', ";
	$query .= " p_no = '".$p_no."', ";
	$query .= " ref = '".$max."', ";
	$query .= " step = '".$step."', ";
	$query .= " depth = '".$depth."', ";
	$query .= " subject = '".$subject."', ";
	$query .= " writer = '".$writer."', ";
	$query .= " passwd = '".$passwd."', ";
	$query .= " content = '".$content."', ";
	$query .= " file_c = '".$file1_name."', ";
	$query .= " file_o = '".$file1_o."', ";
	$query .= " file_c2 = '".$file2_name."', ";
	$query .= " file_o2 = '".$file2_o."', ";
	$query .= " cnt = 0, ";
	$query .= " reco = 0, ";
	$query .= " ip = '".$ip."', ";
	$query .= " write_time = now(), ";
	$query .= " is_html = '".$is_html."', ";
	$query .= " email = '".$email."', ";
	$query .= " is_secure = '".$is_secure."', ";
	$query .= " is_popup = '".$is_popup."', ";
	$query .= " user_id = '".$user_id."', ";
	$query .= " view_id = '".$view_id."', ";
	$query .= " 1vs1_cate = '".$cate_1vs1."', ";
	$query .= " 1vs1_cell = '".$cell_1vs1."', ";
	$query .= " status = '".$status."' ";
	
	//echo $query;
	//exit;
	$result = mysqli_query($gconnet,$query);
	return $result;
}

function MgrBbsUp($bbs, $no, $keyword, $field,$view_id="",$my_list=""){
	$query = "select min(no) as no from bbs where bbs_code='$bbs' and no > $no and step='0' ";
	//$query = "select max(no) as no from bbs where bbs_code='$bbs' and no < $no ";
	
	if($field == "all"){
		if ($field){
		$query .= "and ( subject like '%$keyword%' or writer like '%$keyword%' or content like '%$keyword%' ) ";
		}
	} else { 
		if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
		}
	}
	//echo $lecture_idx;
		
	if($my_list){ // 1:1 게시판일때
		if($view_id){
		$query .= " and view_id = '".$view_id."' ";
		}
	}

	//echo $query;
	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);

	$query = "select * from bbs where no = '$row[no]'";
	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);

	return $row;
}

function MgrBbsBelow($bbs, $no, $keyword, $field,$view_id="",$my_list=""){
	$query = "select max(no) as no from bbs where bbs_code='$bbs' and no < $no and step='0' ";
	//$query = "select min(no) as no from bbs where bbs_code='$bbs' and no > $no ";
	
	if($field == "all"){
		if ($field){
		$query .= "and ( subject like '%$keyword%' or writer like '%$keyword%' or content like '%$keyword%' ) ";
		}
	} else { 
		if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
		}
	}

	if($my_list){ // 1:1 게시판일때
		if($view_id){
		$query .= " and view_id = '".$view_id."' ";
		}
	}

	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);
	//echo $query;
	$query = "select * from bbs where no = '$row[no]'";
	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);

	return $row;
}

//===== 이전글(내부답변의....)
function MgrBbsUp_sd($bbs, $no, $keyword, $field,$view_id="",$my_list=""){
	//$query = "select min(no) as no from bbs where bbs_code='$bbs' and no > $no and step='0' ";
	$query = "select max(no) as no from bbs where bbs_code='$bbs' and step = 0 and no < $no ";
	
	if($field == "all"){
		if ($field){
		$query .= "and ( subject like '%$keyword%' or writer like '%$keyword%' or content like '%$keyword%' ) ";
		}
	} else { 
		if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
		}
	}
		
	if($my_list){ // 1:1 게시판일때
		if($view_id){
		$query .= " and view_id = '".$view_id."' ";
		}
	}	

	//echo $query;
	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);	

	$query = "select * from bbs where no = '$row[no]' and step = 0";

	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);

	return $row;
}


//===== 다음글(내부답변의.....)
function MgrBbsBelow_sd($bbs, $no, $keyword, $field,$view_id="",$my_list=""){
	//$query = "select max(no) as no from bbs where bbs_code='$bbs' and no < $no and step='0' ";
	$query = "select min(no) as no from bbs where bbs_code='$bbs' and step = 0 and no > $no ";
	
	if($field == "all"){
		if ($field){
		$query .= "and ( subject like '%$keyword%' or writer like '%$keyword%' or content like '%$keyword%' ) ";
		}
	} else { 
		if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
		}
	}

	if($my_list){ // 1:1 게시판일때
		if($view_id){
		$query .= " and view_id = '".$view_id."' ";
		}
	}

	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);
	//echo $query;
	$query = "select * from bbs where no = '$row[no]' and step = 0 ";
	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);

	return $row;


}


function MgrBbsVeiw($bbs, $no, $a_ch=''){

	if ($a_ch==''){
		$query = "update bbs set cnt=cnt+1 where bbs_code='$bbs' and no='$no'";
		mysqli_query($gconnet,$query);
	}

	$query = "select * from bbs where bbs_code='$bbs' and no='$no'";
	
	if ($where){
		$query .= $where;
	}

	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);

	return $row;	
}

function MgrBbsVeiw_sd($bbs, $no, $p_no, $a_ch=''){
	if ($a_ch==''){
		$query = "update bbs set cnt=cnt+1 where bbs_code='$bbs' and no='$no'";
		mysqli_query($gconnet,$query);
	}

	$query = "select * from bbs where bbs_code='$bbs' and p_no = $no";
	$sd_result = mysqli_query($gconnet,$query);
	$sd_row = mysqli_fetch_array($sd_result);
	return $sd_row;	
}


function MgrBbs_comment_List($comment_bbs, $comment_bbs_no, $comment_keyword, $comment_field, $comment_pageNo, $comment_pageScale){
	$comment_query = "select * from bbs_comment where bbs='$comment_bbs' and bbs_no='$comment_bbs_no' ";
	if ($comment_field){
		$comment_query .= "and ".$comment_field." like '%".$comment_keyword."%'";
	}
	$comment_query .= " order by no desc ";
	//$comment_query .= ($orderby==""?"no":$orderby)." desc";
	
	//echo $comment_query;

	//$start = ($comment_pageNo-1)*$comment_pageScale;
	//$comment_query .= " LIMIT ".$start.", ".$comment_pageScale;
	
	//echo $comment_query;

	$comment_result = mysqli_query($gconnet,$comment_query);
	
	return $comment_result;
}

function MgrBbs_comment_Write($bbs, $bbs_no, $writer, $passwd, $user_id,$subject,$content,$member_idx=""){
	
	$signdate = date("Y-m-d H:i:s");

	$query = " insert into bbs_comment set ";
	$query .= " bbs = '".$bbs."', ";
	$query .= " bbs_no = '".$bbs_no."', ";
	$query .= " member_idx = '".$member_idx."', ";
	$query .= " writer = '".$writer."', ";
	$query .= " passwd = '".$passwd."', ";
	$query .= " user_id = '".$user_id."', ";
	$query .= " subject = '".$subject."', ";
	$query .= " content = '".$content."', ";
	$query .= " write_time = now() ";
	
	//echo $query;
	
	$result = mysqli_query($gconnet,$query);
	return $result;
}

function tbused_comment_Write($bbs, $bbs_no, $writer, $passwd, $user_id,$subject,$content,$member_idx=""){
	
	$signdate = date("Y-m-d H:i:s");

	$query = " insert into tbused_comment set ";
	$query .= " bbs = '".$bbs."', ";
	$query .= " bbs_no = '".$bbs_no."', ";
	$query .= " member_idx = '".$member_idx."', ";
	$query .= " writer = '".$writer."', ";
	$query .= " passwd = '".$passwd."', ";
	$query .= " user_id = '".$user_id."', ";
	$query .= " subject = '".$subject."', ";
	$query .= " content = '".$content."', ";
	$query .= " write_time = now() ";
	
	//echo $query;
	
	$result = mysqli_query($gconnet,$query);
	return $result;
}

function MgrBbs_comment_Delete($bbs, $no){
	$query = "delete from bbs_comment where bbs='$bbs' and no='$no'";
	$result = mysqli_query($gconnet,$query);

	return $result;
}

function tbused_comment_Delete($bbs, $no){
	$query = "delete from tbused_comment where bbs='$bbs' and no='$no'";
	$result = mysqli_query($gconnet,$query);

	return $result;
}


function MgrBbs_comment_Modify($writer, $passwd, $user_id,$subject,$content,$bbs_comment_no,$bbsl){

	$signdate = date("Y-m-d H:i:s");
	
	$query = " update bbs_comment set ";
	$query .= " subject = '".$subject."', ";
	$query .= " content = '".$content."' ";
	$query .= " where no='$bbs_comment_no' and bbs='$bbs' ";
	
//	echo $query;
//	exit;
	$result = mysqli_query($gconnet,$query);
	return $result;
}

function MgrBbsList($bbs, $field, $keyword, $orderby, $pageNo, $pageScale,$where =""){
	$query = "select * from bbs where bbs_code='$bbs' ";
	
	if($field == "all"){
		if ($field){
		$query .= "and ( subject like '%$keyword%' or writer like '%$keyword%' or content like '%$keyword%' ) ";
		}
	} else { 
		if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
		}
	}
		
	if ($where){
		$query .= $where;
	}

	if(!$orderby){
	$query .= " order by ref desc, step asc, depth asc, ";
	$query .= ($orderby==""?"no":$orderby)." desc";
	} else {
	$query .= $orderby;
	}

	$start = ($pageNo-1)*$pageScale;
	$query .= " LIMIT ".$start.", ".$pageScale;

	//echo $query;

	$result = mysqli_query($gconnet,$query);
	
	return $result;
}



function MgrBbsListCount($bbs, $field, $keyword,$where = ""){
	$query = "select count(*) cnt from bbs where bbs_code = '$bbs' ";
	
	if($field == "all"){
		if ($field){
		$query .= "and ( subject like '%$keyword%' or writer like '%$keyword%' or content like '%$keyword%' ) ";
		}
	} else { 
		if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
		}
	}
	
	if ($where){
		$query .= $where;
	}
	
	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);
	
	return $row[cnt];
}


#################### 코드 구분없이 통합검색 보기 ######################
	
function MgrBbsList_search($bbs, $field, $keyword, $orderby, $pageNo, $pageScale,$where =""){
	$query = "select * from bbs where 1=1 ";
	
	if($field == "all"){
		if ($field){
		$query .= "and ( subject like '%$keyword%' or writer like '%$keyword%' or content like '%$keyword%' ) ";
		}
	} else { 
		if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
		}
	}
		
	if ($where){
		$query .= $where;
	}

	if(!$orderby){
	$query .= " order by ref desc, step asc, depth asc, ";
	$query .= ($orderby==""?"no":$orderby)." desc";
	} else {
	$query .= $orderby;
	}

	$start = ($pageNo-1)*$pageScale;
	$query .= " LIMIT ".$start.", ".$pageScale;

	//echo $query;

	$result = mysqli_query($gconnet,$query);
	
	return $result;
}



function MgrBbsListCount_search($bbs, $field, $keyword,$where = ""){
	$query = "select count(*) cnt from bbs where 1=1 ";
	
	if($field == "all"){
		if ($field){
		$query .= "and ( subject like '%$keyword%' or writer like '%$keyword%' or content like '%$keyword%' ) ";
		}
	} else { 
		if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
		}
	}
	
	if ($where){
		$query .= $where;
	}
	
	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);
	
	return $row[cnt];
}

#################### 코드 구분없이 통합검색 보기 종료 ######################


#################### 마이페이지 내가 쓴 글 보기 ######################

function MgrBbsList_my($bbs, $field, $keyword, $orderby, $pageNo, $pageScale,$where =""){
	$query = "select * from bbs where 1=1 ";
	
	if($field == "all"){
		if ($field){
		$query .= "and ( subject like '%$keyword%' or writer like '%$keyword%' or content like '%$keyword%' or company like '%$keyword%' or chairman like '%$keyword%' ) ";
		}
	} else { 
		if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
		}
	}
		
	if ($where){
		$query .= $where;
	}

	if(!$orderby){
	$query .= " order by ref desc, step asc, depth asc, ";
	$query .= ($orderby==""?"no":$orderby)." desc";
	} else {
	$query .= $orderby;
	}

	$start = ($pageNo-1)*$pageScale;
	$query .= " LIMIT ".$start.", ".$pageScale;

	//echo $query;

	$result = mysqli_query($gconnet,$query);
	
	return $result;
}



function MgrBbsListCount_my($bbs, $field, $keyword,$where = ""){
	$query = "select count(*) cnt from bbs where 1=1 ";
	
	if($field == "all"){
		if ($field){
		$query .= "and ( subject like '%$keyword%' or writer like '%$keyword%' or content like '%$keyword%' or company like '%$keyword%' or chairman like '%$keyword%' ) ";
		}
	} else { 
		if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
		}
	}
	
	if ($where){
		$query .= $where;
	}

	//echo $query;
	
	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);
	
	return $row[cnt];
}

function MgrBbsVeiw_my($bbs, $no, $a_ch="",$where=""){

	//echo $where."<br>";

	if ($a_ch==""){
		$query = "update bbs set cnt=cnt+1 where no='$no' ";
		mysqli_query($gconnet,$query);
	}

	$query = "select * from bbs where no='$no' ";
	
	if ($where){
		$query .= $where;
	}

	//echo $query; exit;

	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);

	return $row;	
}

#################### 제품후기, qna 게시판 쿼리 #####################

function MgrBbs_product_List($bbs, $field, $keyword, $orderby, $pageNo, $pageScale,$where =""){
	$query = "select * from product_board where bbs_sect ='$bbs' ";
	
	if ($field && $keyword){
		if($field == "tot"){
			$query .= "and ( product_name like '%".$keyword."%' ) or ( title like '%".$keyword."%' ) or ( name like '%".$keyword."%' ) or ( content like '%".$keyword."%' ) ";
		} else {
			$query .= "and ".$field." like '%".$keyword."%'";
		}
	}
			
	if ($where){
		$query .= $where;
	}

	if(!$orderby){
	$query .= " order by ref desc, step asc, depth asc, ";
	$query .= ($orderby==""?"idx":$orderby)." desc";
	} else {
	$query .= $orderby;
	}

	$start = ($pageNo-1)*$pageScale;
	$query .= " LIMIT ".$start.", ".$pageScale;

	//echo $query;

	$result = mysqli_query($gconnet,$query);
	
	return $result;
}

function MgrBbs_product_ListCount($bbs, $field, $keyword,$where = ""){
	$query = "select count(*) cnt from product_board where bbs_sect ='$bbs' ";
	
	if ($field && $keyword){
		if($field == "tot"){
			$query .= "and ( product_name like '%".$keyword."%' ) or ( title like '%".$keyword."%' ) or ( name like '%".$keyword."%' ) or ( content like '%".$keyword."%' ) ";
		} else {
			$query .= "and ".$field." like '%".$keyword."%'";
		}
	}
			
	if ($where){
		$query .= $where;
	}

	//echo $query;
	
	$result = mysqli_query($gconnet,$query);
	$row = mysqli_fetch_array($result);
	
	return $row[cnt];
}

########## 테이블 조인  ##########
function joinlist($query, $orderBy, $field, $keyword, $pageNo, $pageScale, $where=""){
		
	if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
	}

	if($where){
		$query .= $where;
	}
	$query .= " order by ".$orderBy;

	$start = ($pageNo-1)*$pageScale;
	$query .= " LIMIT ".$start.", ".$pageScale;

	//echo $query;

	$result = mysqli_query($gconnet,$query);
	
	return $result;
}

function joinlistcount($query, $field, $keyword, $where=""){
	
	if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
	}
	if($where){
		$query .= $where;
	}
	
	//echo $query;
	$result = mysqli_query($gconnet,$query);
	
	//$row = mysqli_fetch_array($result);
	//return $row[cnt];
	return mysqli_num_rows($result);
}

function joinlist_ar($query, $orderBy, $field, $keyword, $pageNo, $pageScale, $where=""){
		
	$field_arr = explode(",",$field);
	
	if($keyword){
		$query .= " and ( ";
		for($k=0; $k<sizeof($field_arr); $k++){
			
			if($k == sizeof($field_arr)-1){
			$query .= $field_arr[$k]." like '%".$keyword."%' ";
			} else {
			$query .= $field_arr[$k]." like '%".$keyword."%' or ";
			}
		
		}
		$query .= " ) ";
	}

	if($where){
		$query .= $where;
	}
	$query .= " order by ".$orderBy;

	$start = ($pageNo-1)*$pageScale;
	$query .= " LIMIT ".$start.", ".$pageScale;

	//echo $query;

	$result = mysqli_query($gconnet,$query);
	
	return $result;
}

function joinlistcount_ar($query, $field, $keyword, $where=""){
	
	$field_arr = explode(",",$field);
	
	if($keyword){
		$query .= " and ( ";
		for($k=0; $k<sizeof($field_arr); $k++){
			
			if($k == sizeof($field_arr)-1){
			$query .= $field_arr[$k]." like '%".$keyword."%' ";
			} else {
			$query .= $field_arr[$k]." like '%".$keyword."%' or ";
			}
		
		}
		$query .= " ) ";
	}

	if($where){
		$query .= $where;
	}
	
	//echo $query;
	$result = mysqli_query($gconnet,$query);
	//$row = mysqli_fetch_array($result);
	//return $row[cnt];
	return mysqli_num_rows($result);
}

function joinview($joinquery, $pkColumn, $value,$where=""){
	$query = $joinquery." where ".$pkColumn."='".$value."'";
	
	if($where){
		$query .= $where;
	}

	//if($debug){
		//echo $query;
	//}

	$result = mysqli_query($gconnet,$query);
	
	return $result;
}

#############################################
function ch_jo_MgrGeneralList($query, $orderBy, $field, $keyword, $pageNo, $pageScale, $where=""){
		
	if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
	}

	if($where){
		$query .= $where;
	}
	$query .= " order by ".$orderBy;

	$start = ($pageNo-1)*$pageScale;
	$query .= " LIMIT ".$start.", ".$pageScale;

	//echo $query;

	$result = mysqli_query($gconnet,$query);
	
	return $result;
}

function ch_jo_MgrGeneralListCount($query, $field, $keyword, $where=""){
	
	if ($field){
		$query .= "and ".$field." like '%".$keyword."%'";
	}
	if($where){
		$query .= $where;
	}
	
	//echo $query;
	$result = mysqli_query($gconnet,$query);
	
	//$row = mysqli_fetch_array($result);
	//return $row[cnt];
	return mysqli_num_rows($result);
}
#############################################
?>