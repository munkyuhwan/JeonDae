String.prototype.format = function() {
    a = this;
    for (k in arguments) {
        a = a.replace("{" + k + "}", arguments[k])
    }
    return a
}

function likeClick(report_idx) {
    $.ajax({
       url:"../include/like_clicked.php",
        data:{"report_idx":report_idx},
        success:function(response) {
            console.log(response)
            try{
                var res = JSON.parse(response);
                toast(res.msg)
            }catch(e) {

            }
        },
        error:function(error) {

        }
    });
}



function goShare() {
    console.log($('#report_idx').val())
}