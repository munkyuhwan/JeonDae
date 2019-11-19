<?
if($num_sub >= 1){ // DB 추출갯수가 하나라도 있을때 시작 
	
	$page_list_size = $pageScale_sub; // 한 페이지당 출력할 갯수  
	//$page_list_size = 10; // 한 페이지당 출력할 갯수  
	$page_size = 10; // 1 ~ 10 페이지까지 화면에 뿌려준다.
	$total_row = $num_sub; // 게시물의 총 갯수
	//$total_row = 469; // 게시물의 총 갯수
	$c_page = $pageNo_sub; // 현재 페이지

	//$total_page =  floor(($total_row - 1) / $page_list_size);		//전체  개수
	$total_page =  ceil($total_row / $page_list_size);		//전체  개수
	//$start_page = ($c_page / $page_size) * $page_size;	//시작  값
	$page_per = ceil($c_page/$page_size);	

	$start_page_prev = $c_page%$page_size;
	if($start_page_prev == 1){
		$start_page = $c_page;	//시작  값
	} else {
		$start_page = ceil($c_page / $page_size);	
		$start_plus_num = ($page_per -1)*($page_size-1);
		$start_page = $start_page+$start_plus_num;	//시작  값
	}
	
	$end_page = $start_page + $page_size - 1;	// 끝  값

	// 전체  초기화
	if ($total_page < $end_page){
		$end_page = $total_page;
	}
	
	//echo ($page_per -1)*($page_size-1)."<br><br>";
	//echo $c_page."<br><br>";
	//echo (11/10)."<br><br>";
	//echo $page_size;
	//echo "시작페이지 = ".$start_page." | 현재페이지 = ".$c_page." || current_page = ".$current_page." ||| 종료페이지 = ".$end_page." |||| 총 페이지수 = ".$total_page."<br><br>";

			###처음 버튼
				if ($c_page > $page_size) {
					//마지막
					//echo '<a href="'.$_SERVER["PHP_SELF"].'?pageNo_sub=&'.$total_param_sub.'"><img src="'.$last_img_path.'" border="0"  alt="처음으로"/></a>';
					//이전
					//$prev_list = ($start_page - 1)*$page_list_size;
					$prev_list = $start_page - $page_size;
					if($prev_list == 0){
						$prev_list = "";
					}
					echo ' <a href="'.$_SERVER["PHP_SELF"].'?pageNo_sub='.$prev_list.'&'.$total_param_sub.'" class="prev">이전 페이지</a>';
				}
				//echo '&nbsp;';
			###페이지 출력
				for ($i=$start_page;$i <= $end_page;$i++){

					//$page = $page_list_size * $i;
					$page = $i;

					if($page == 0){
						$page = 1;
					}

					//echo $c_page." :: ".$page."<br><br>";
					
					if($c_page != $page){
						//echo '<a href="'.$_SERVER["PHP_SELF"].'?pageNo_sub='.$page.'&'.$total_param_sub.'&pidx='.$pidx.'"><span>'.($i+1).'</span></a>';
						echo '<a href="'.$_SERVER["PHP_SELF"].'?pageNo_sub='.$page.'&'.$total_param_sub.'"><span>'.$i.'</span></a>';
					}else{
						//echo "<span class='page'>".($i+1).'</span>';
						echo '<a href="'.$_SERVER["PHP_SELF"].'?pageNo='.$page.'&'.$total_param_sub.'" class="on">'.$i.'</a>';
					}

					if($i != $end_page){
						//echo '<img src="/img/icon/line.gif" align="absmiddle">';
						//echo '&nbsp';					
					}
				}
				//echo '&nbsp;';
			###다음버튼
				if($total_page > $end_page){
					//다음
					//$next_list = ($end_page + 1)*$page_list_size;
					//$next_list = $end_page*$page_list_size;
					$next_list = $end_page + 1;
					echo '<a href="'.$_SERVER["PHP_SELF"].'?pageNo_sub='.$next_list.'&'.$total_param_sub.'" class="next">다음 페이지</a>';
					// 처음
					/*$last_page = $total_row - ($total_row % $page_list_size);
					if($last_page == $total_row){
						$last_page = $total_row - $page_list_size;
					}*/
					$last_page = $total_page;
					//echo ' <a href="'.$_SERVER["PHP_SELF"].'?pageNo_sub='.$last_page.'&'.$total_param_sub.'"> <img src="'.$first_img_path.'" border="0"   alt="마지막으로" /></a>';
				}

} // DB 추출갯수가 하나라도 있을때 종료 
?>