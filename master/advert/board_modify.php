<? include $_SERVER['DOCUMENT_ROOT']."/master/include/head.php" ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?
if($_AUTH_VIEW){
	error_back("본문보기 권한이 없습니다.");
	exit;
}

$idx = trim(sqlfilter($_REQUEST['idx']));
$pageNo = trim(sqlfilter($_REQUEST['pageNo']));
$field = trim(sqlfilter($_REQUEST['field']));
$keyword = sqlfilter($_REQUEST['keyword']);
$bbs_code = sqlfilter($_REQUEST['bbs_code']);
$s_cate_code = trim(sqlfilter($_REQUEST['s_cate_code'])); // 게시판 카테고리 코드
$v_sect = trim(sqlfilter($_REQUEST['v_sect'])); // 게시판 분류
################## 파라미터 조합 #####################
$total_param = 'bmenu='.$bmenu.'&smenu='.$smenu.'&field='.$field.'&keyword='.$keyword.'&bbs_code='.$bbs_code.'&v_sect='.$v_sect.'&s_cate_code='.$s_cate_code.'&pageNo='.$pageNo;

$sql = "SELECT * FROM board_content WHERE 1 AND idx=".$idx;
$query = mysqli_query($gconnet,$sql);
$result = mysqli_fetch_assoc($query);
//echo $sql; exit;

if(mysqli_num_rows($query) == 0){
	?>
	<SCRIPT LANGUAGE="JavaScript">
		<!--
		alert('해당하는 게시물이 없습니다.');
		location.href =  "board_list.php?<?=$total_param?>";
		//-->
	</SCRIPT>
	<?
	exit;
}

?>

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
				<form name="frm" id="addFrm" action="board_modify_action.php"   method="post" enctype="multipart/form-data">
					<input type="hidden" name="idx" value="<?=$idx?>" >
					<div class="card mb-3">

						<div class="card-header">
							공지사항 제목
						</div>
						<div class="card-body">
							<div class="form-label-group">
								<div class="form-label-group">
									<input type="text" style="width: 100%;" id="subject" name="subject" value="<?=$result['subject']?>" required>
									<label for="subject">제목</label>
								</div>

							</div>
						</div>

						<div class="card-header">
							공지사항 내용
						</div>
						<div class="card-body">
							<div class="form-label-group">
								<div class="form-label-group">
									<textarea type="text" style="width:100%; height: 100px; " id="content" name="content" required><?=$result['content']?></textarea>
								</div>
							</div>
						</div>

						<button class="btn btn-primary btn-block" type="submit" >수정</button>
						<button class="btn btn-secondary btn-block" type="button" onclick="history.back(); "  >취소</button>
					</div>
				</form>
			</div>

		</div>

	</div>
	<!-- /#wrapper -->

<? include $_SERVER['DOCUMENT_ROOT']."/master/include/footer.php"?>