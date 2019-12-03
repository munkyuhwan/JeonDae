<? include $_SERVER['DOCUMENT_ROOT']."/master/include/head.php" ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_htmlheader_admin.php"; // 관리자페이지 헤더?>
<? include $_SERVER["DOCUMENT_ROOT"]."/master/include/check_login.php"; // 관리자 로그인여부 확인?>
<?

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

$query_category = "SELECT category_name, idx, cover_img, profile_img FROM report_categories";
$category_result = mysqli_query($gconnet,$query_category);
$idx = trim(sqlfilter($_REQUEST['idx']));

$query = "SELECT * FROM report_list WHERE idx=".$idx;
$result = mysqli_query($gconnet, $query);
$assoc = mysqli_fetch_assoc($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Register</title>

    <!-- Custom fonts for this template-->
    <link href="../master/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="../master/css/sb-admin.css" rel="stylesheet">

</head>
<script>
    if (!String.prototype.format) {
        String.prototype.format = function() {
            var args = arguments;
            return this.replace(/{(\d+)}/g, function(match, number) {
                return typeof args[number] != 'undefined'
                    ? args[number]
                    : match
                    ;
            });
        };
    }
    function get_sub_categories(sel) {
        var opts = "<option value=\"{0}\" >{1}</option>\n"
        $.ajax({
            url:"get_sub_category.php",
            data:{"idx":sel},
            success:function (response) {
                try {
                    var res = JSON.parse(response)
                    var str = opts.format('','카테고리 선택')
                    for(let data of res) {
                        str += opts.format(data.idx, data.sub_name)
                    }
                    $('#sub_category_select').html(str);
                }catch (e) {

                }
            },
            error:function (error) {

            }
        })
    }

    function removeExistingFile(idx) {
        if (confirm("삭제 하시겠습니까?") ) {
            $.ajax({
                url: "delete_file.php",
                data: {"idx": idx},
                success: function (response) {
                    console.log(response)
                    try {
                        var res = JSON.parse(response)
                        if (res.result == true) {
                            getFileList(idx)
                        }
                    } catch (e) {

                    }
                },
                error: function (error) {

                }
            })
        }
    }

    function getFileList(idx) {
        var str = "<div class=\"form-label-group border text-align-right file-add-group\" >\n" +
            "          <button type=\"button\" style=\"border: none; background: none;\" name=\"minus_btn[]\" onclick=\"removeExistingFile({0})\" >\n" +
            "              <i class=\"fas fa-minus\"></i>\n" +
            "          </button>\n" +
            "          <img src=\"../../upload_file/report/{1}\" width=\"80\" >\n" +
            "      </div>"
        $.ajax({
            url: "get_file.php",
            data: {"idx": idx},
            success: function (response) {
                var add ="";
                try {
                    var res = JSON.parse(response)
                    for (let data of res) {
                        add += str.format(data.idx, data.report_file_name);
                    }

                    $('#prev_files').html(add);

                } catch (e) {

                }
            },
            error: function (error) {

            }
        })
    }

    var imgListFormat = "<div class=\"form-label-group border text-align-right file-add-group\" >\n" +
        "                    <button type=\"button\" style=\"border: none; background: none;\" name=\"minus_btn[]\" onclick=\"removeFile(this)\" >\n" +
        "                         <i class=\"fas fa-minus\" ></i>\n" +
        "                    </button>\n" +
        "                    <input type=\"file\" name=\"img_add[]\" autofocus=\"autofocus\"  >\n" +
        "               </div>\n"

    function fileAddition() {
        $('#file_list').append(imgListFormat)
    }

    function removeFile(el) {
        $('.file-add-group')[$("button[name='minus_btn[]']").index(el)].remove()
    }

    $(document).ready(function () {
        getFileList(<?=$idx?>)
    })

</script>
<body class="">
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

    <div class="card card-register mx-auto mt-5">
        <div class="card-body">
            <form name="frm" id="addFrm" action="edit_action.php"   method="post" enctype="multipart/form-data">
                <input type="hidden" name="total_param" value="<?=$total_param?>">
                <input type="hidden" name="idx" value="<?=$idx?>">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <textarea style="width: 100%;" id="input_text" name="input_text"><?=$assoc['content_text']?></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="hash_tags" name="hash_tags" class="form-control" placeholder="해시태그" required="required" autofocus="autofocus" value="<?=$assoc['report_hashtag']?>">
                                <label for="hash_tags">해시태그</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    첨부파일
                                    <button type="button" style="border: none; background: none;" onclick="fileAddition()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <div class="card-body" id="prev_files">

                                </div>

                                <div class="card-body" id="file_list">
                                    <div class="form-label-group border text-align-right file-add-group" >
                                        <button type="button" style="border: none; background: none;" name="minus_btn[]" onclick="removeFile(this)" >
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="file" name="img_add[]" autofocus="autofocus" >
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <button class="btn btn-primary btn-block" type="submit"  >등록</button>
                <button class="btn btn-secondary btn-block" type="button" onclick="history.back();"  >취소</button>
            </form>
        </div>
    </div>
</div>
<? include $_SERVER['DOCUMENT_ROOT']."/master/include/footer.php"?>
