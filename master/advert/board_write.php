<? include $_SERVER['DOCUMENT_ROOT']."/master/include/head.php" ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?
/*if(!$_AUTH_LIST){
	error_back("게시판 접근권한이 없습니다.");
	exit;
}*/

$s_cate_code = trim(sqlfilter($_REQUEST['s_cate_code'])); // 게시판 카테고리 코드
$bbs_code = trim(sqlfilter($_REQUEST['bbs_code'])); // 게시판 코드
$v_sect = trim(sqlfilter($_REQUEST['v_sect'])); // 게시판 분류
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);

$s_sect1 = trim(sqlfilter($_REQUEST['s_sect1'])); // 지역 시,도
$s_sect2 = trim(sqlfilter($_REQUEST['s_sect2'])); // 지역 구,군
$s_level = sqlfilter($_REQUEST['s_level']); // 회원 계급별 검색
$s_gender = sqlfilter($_REQUEST['s_gender']); // 성별 검색

################## 파라미터 조합 #####################
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&keyword='.$keyword.'&bbs_code='.$bbs_code.'&v_sect='.$v_sect.'&s_cate_code='.$s_cate_code.'&s_sect1='.$s_sect1.'&s_sect2='.$s_sect2.'&s_gender='.$s_gender.'&s_level='.$s_level;

?>

	<SCRIPT LANGUAGE="JavaScript">
		<!--
		function go_view(no,bcode){
			location.href = "board_view.php?idx="+no+"&bbs_code="+bcode+"&pageNo=<?=$pageNo?>&bmenu=<?=$bmenu?>&smenu=<?=$smenu?>&field=<?=$field?>&keyword=<?=$keyword?>&s_cate_code=<?=$s_cate_code?>&v_sect=<?=$v_sect?>&s_sect1=<?=$s_sect1?>&s_sect2=<?=$s_sect2?>&s_gender=<?=$s_gender?>&s_level=<?=$s_level?>";
		}

		function go_list(){
			location.href = "board_list.php?<?=$total_param?>";
		}

		function go_regist(){
			location.href = "board_write.php?<?=$total_param?>";
		}

		function go_search() {
			if(!frm_page.field.value || !frm_page.keyword.value) {
				alert("검색조건 또는 검색어를 입력해 주세요!!") ;
				exit;
			}
			frm_page.submit();
		}

		function cate_sel_1(z){
			var tmp = z.options[z.selectedIndex].value;
			//alert(tmp);
			_fra_admin.location.href="../partner/cate_select_1.php?cate_code1="+tmp+"&fm=s_mem&fname=s_sect2";
		}

		//-->
	</SCRIPT>

	<body id="page-top">

	<nav class="navbar navbar-expand navbar-dark bg-dark static-top">


		<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
			<i class="fas fa-bars"></i>
		</button>

		<!-- Navbar Search -->
		<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
				<div class="input-group-append">
					<button class="btn btn-primary" type="button">
						<i class="fas fa-search"></i>
					</button>
				</div>
			</div>
		</form>

	</nav>

	<div id="wrapper">

		<!-- Sidebar -->
		<? include $_SERVER['DOCUMENT_ROOT']."/master/include/master_left.php" ?>

		<div id="content-wrapper">

			<div class="container-fluid">

				<!-- Breadcrumbs-->
				<ol class="breadcrumb">
					<li class="breadcrumb-item">
						<a href="../settings/?<?=$total_param?>">설정</a>
					</li>
					<li class="breadcrumb-item active">공지사항</li>
				</ol>

				<!-- DataTables Example -->
				<div class="card mb-3">

					<form name="frm" id="addFrm" action="board_write_action.php"   method="post" enctype="multipart/form-data">
						<div class="card-header">
							공지사항 제목
						</div>
						<div class="card-body">
							<div class="form-label-group">
								<input type="text" style="width: 100%;" id="subject" name="subject" required>
								<label for="subject">제목</label>
							</div>
						</div>

						<div class="card-header">
							공지사항 내용
						</div>
						<div class="card-body">
							<div class="form-label-group">
								<textarea type="text" style="width:100%; height: 100px; " id="content" name="content" required></textarea>
							</div>
						</div>

						<button class="btn btn-primary btn-block" type="submit">등록</button>
						<button class="btn btn-secondary btn-block" type="button" onclick="location.href='board_list.php?<?=$total_param?>'; "  >취소</button>
					</form>
				</div>
			</div>

		</div>

	</div>
	<!-- /#wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="login.html">Logout</a>
				</div>
			</div>
		</div>
	</div>
<? include $_SERVER['DOCUMENT_ROOT']."/master/include/footer.php"?>