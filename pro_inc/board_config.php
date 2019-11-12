<?
if(!$bbs){
	$bbs =  trim(sqlfilter($_REQUEST['bbs']));
}

if($bbs){

	$bbs_config_sql = "select * from bbs_config where bbs_code='".$bbs."' ";
	$bbs_config_query = mysqli_query($gconnet,$bbs_config_sql);
	$bbs_config_row = mysqli_fetch_array($bbs_config_query);

	$board_str = $bbs_config_row[bbs_name];
	$config_board_menu = $bbs_config_row[board_menu];
	$config_board_sect = $bbs_config_row[board_sect];
	$config_board_title = $bbs_config_row[photo_file_s1];
	$config_board_content = $bbs_config_row[content_file_c1];
	$config_bbs_content = nl2br($bbs_config_row[bbs_content]);
}

if ($config_board_sect=="general"){	//	일반게시판
	$top_content = '';	//일반게시판은 코딩되어있음
} else {
	if($config_bbs_content){
		$top_content = "<div class='bbs_con_conf' style='text-align:left;padding-left:10px;'><ul>$config_bbs_content</ul></div>";
	}
}
?>