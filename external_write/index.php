<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>전대전 제보</title>

    <!-- Custom fonts for this template-->
    <link href="../master/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="../master/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../master/css/sb-admin.css" rel="stylesheet">

</head>
<script>
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



</script>
<div class="container">
    <div class="card card-register mx-auto mt-5">
        <div class="card-header">전대전 제보</div>
        <div class="card-body">
            <form name="frm" id="addFrm" action="add_report_action.php"   method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <textarea style="width: 100%;" id="input_text" name="input_text"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="col-md-6">
                            <div class="form-label-group">
                                <input type="text" id="hash_tags" name="hash_tags" class="form-control" placeholder="해시태그" required="required" autofocus="autofocus">
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
                <button class="btn btn-secondary btn-block" type="button" data-dismiss="modal"  >취소</button>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../master/vendor/jquery/jquery.min.js?ver=<?=time()?>"></script>
<script src="../master/vendor/bootstrap/js/bootstrap.bundle.min.js?ver=<?=time()?>"></script>

<!-- Core plugin JavaScript-->
<script src="../master/vendor/jquery-easing/jquery.easing.min.js?ver=<?=time()?>"></script>

<!-- Page level plugin JavaScript-->
<script src="../master/vendor/datatables/jquery.dataTables.js?ver=<?=time()?>"></script>
<script src="../master/vendor/datatables/dataTables.bootstrap4.js?ver=<?=time()?>"></script>

<!-- Custom scripts for all pages-->
<script src="../master/js/sb-admin.min.js?ver=<?=time()?>"></script>

<!-- Demo scripts for this page-->
<script src="../master/js/demo/datatables-demo.js?ver=<?=time()?>"></script>

</body>

</html>
