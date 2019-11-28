<? include $_SERVER['DOCUMENT_ROOT']."/master/include/head.php" ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?
$idx = trim(sqlfilter($_REQUEST['idx']));
$query = "SELECT * FROM clean_index WHERE category_idx=".$idx;
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
<div id="wrapper" >
    <? include $_SERVER['DOCUMENT_ROOT']."/master/include/master_left.php" ?>
    <div id="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="../clean_index/?<?=$total_param?>">설정</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="../clean_index/clean_index.php?<?=$total_param?>">클린지수</a>
                </li>
                <li class="breadcrumb-item active"><?=$title_row['category_name']?></li>

            </ol>
                <form name="frm" id="addFrm" action="add_index_action.php"   method="post" enctype="multipart/form-data">
                    <input type="hidden" name="total_param" value="<?=$total_param?>" />
                    <input type="hidden" name="category_idx" value="<?=$idx?>" >
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        1. 없음 게시물 기준
                                    </div>
                                    <div class="card-body">
                                        <div class="form-label-group">
                                            <input type="number" id="clean_content_cnt" name="clean_content_cnt" class="form-control" onkeyup="$('#mid_content_cnt_start').val(this.value)"  placeholder="클린 게시물 기준" required="required" autofocus="autofocus" value="<?=$row['non_content_cnt']?>" >
                                            <label for="clean_content_cnt">클린 게시물 기준</label>
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
                                            2. 중간 게시물 기준
                                        </div>
                                        <div class="card-body">
                                            <div class="form-label-group">
                                                <input type="number" id="mid_content_cnt_start" name="mid_content_cnt_start" class="form-control" placeholder="0" required="required" autofocus="autofocus" value="<?=$row['mid_content_cnt_start']?>">
                                                <label for="mid_content_cnt_start"></label> 개 ~
                                                <input type="number" id="mid_content_cnt_end" name="mid_content_cnt_end" class="form-control" onkeyup="$('#content_standard').val(this.value)" placeholder="0" required="required" autofocus="autofocus" value="<?=$row['mid_content_cnt_end']?>">
                                                <label for="mid_content_cnt_end"></label>
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
                                            3. 클린 게시물 기준
                                        </div>
                                        <div class="card-body">
                                            <div class="form-label-group">
                                                <input type="number" id="content_standard" name="content_standard" class="form-control" placeholder="게시물 기준" required="required" autofocus="autofocus" value="<?=$row['clean_content_cnt']?>">
                                                <label for="content_standard">게시물 기준</label>개~
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