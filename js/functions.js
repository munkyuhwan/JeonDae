String.prototype.format = function() {
    a = this;
    for (k in arguments) {
        a = a.replace("{" + k + "}", arguments[k])
    }
    return a
}
window.fbAsyncInit = function() {
    FB.init({
        appId            : '966680140341971',
        autoLogAppEvents : true,
        xfbml            : true,
        version          : 'v5.0'
    });
};


var isApp=false;
function setIsApp() {
    isApp = true;
    alert(isApp)
}

function likeClick(report_idx) {
    $.ajax({
       url:"../include/like_clicked.php",
        data:{"report_idx":report_idx},
        success:function(response) {

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



function goShare(href) {
    FB.ui({
        method: 'share',
        href: href,
    }, function(response){});
    console.log($('#report_idx').val())
}