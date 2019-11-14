<? include $_SERVER['DOCUMENT_ROOT']."/master/include/head.php" ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?
$idx = trim(sqlfilter($_REQUEST['idx']));
$query = "SELECT * FROM popular_feeds WHERE category_idx=".$idx;
$result = mysqli_query($gconnet, $query);
$row = mysqli_fetch_assoc($result);

$title_query = "SELECT category_name FROM report_categories WHERE idx=".$idx;
$title_result = mysqli_query($gconnet, $title_query);
$title_row = mysqli_fetch_assoc($title_result);
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
    <? include $_SERVER['DOCUMENT_ROOT']."/master/include/master_left.php" ?>

    <div id="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../settings/?<?=$total_param?>">설정</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="../popular_feeds/?<?=$total_param?>">인기피드 설정</a>
                </li>
                <li class="breadcrumb-item active"><?=$title_row['category_name']?></li>

            </ol>
            <form name="frm" id="addFrm" action="add_popular_action.php"   method="post" enctype="multipart/form-data">
                <input type="hidden" name="total_param" value="<?=$total_param?>" />
                <input type="hidden" name="category_idx" value="<?=$idx?>" >
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    1. 조회수 기준
                                </div>
                                <div class="card-body">
                                    <div class="form-label-group">
                                        <input type="number" id="view_cnt" name="view_cnt" class="form-control" placeholder="조회수 기준" required="required" autofocus="autofocus" value="<?=$row['view_cnt']?>" >
                                        <label for="view_cnt">개 이상</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <div class="card">
                                    <div class="card-header">
                                        2. 댓글 기준
                                    </div>
                                    <div class="card-body">
                                        <div class="form-label-group">
                                            <input type="number" id="comment_cnt" name="comment_cnt" class="form-control" placeholder="0" required="required" autofocus="autofocus" value="<?=$row['comment_cnt']?>">
                                            <label for="comment_cnt"></label> 개 이상
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <div class="card">
                                    <div class="card-header">
                                        3. 좋아요 기준
                                    </div>
                                    <div class="card-body">
                                        <div class="form-label-group">
                                            <input type="number" id="like_cnt" name="like_cnt" class="form-control" placeholder="게시물 기준" required="required" autofocus="autofocus" value="<?=$row['like_cnt']?>">
                                            <label for="like_cnt">게시물 기준</label>개~
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-block" type="submit" >등록</button>
                <button class="btn btn-secondary btn-block" type="button" data-dismiss="addModal" data-target="#addModal" onclick="history.back();" >취소</button>
            </form>
        </div>
    </div>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/master/include/footer.php"?>