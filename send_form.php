<? include $_SERVER['DOCUMENT_ROOT']."/master/include/head.php" ?>
<? include $_SERVER["DOCUMENT_ROOT"]."/pro_inc/include_default.php"; // 공통함수 인클루드 ?>
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
</script>
<body class="bg-dark">

<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">Register an Account</div>
        <div class="card-body">
            <form name="frm" id="addFrm" action="write_action.php"   method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <select name="category_select" class="custom-select custom-select-sm form-control form-control-sm" onchange="get_sub_categories(this.value)">
                                    <option value="" >제보함 선택</option>
                                    <?while ($row = mysqli_fetch_assoc($category_result)) {?>
                                        <option value="<?=$row['idx']?>" ><?=$row['category_name']?></option>
                                    <?}?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-label-group">
                        <select name="sub_category_select" id="sub_category_select" class="custom-select custom-select-sm form-control form-control-sm">
                            <option value="" >카테고리 선택</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <textarea style="width: 100%;" id="input_text" name="input_text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-block" type="submit"  >등록</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../master/vendor/jquery/jquery.min.js"></script>
<script src="../master/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../master/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
