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
}
function goShareTwitter(href) {
    var idx = href.split("?idx=")[1]

    window.open("https://twitter.com/intent/tweet?text="+ decodeURI( href+"\n"+$('#content_'+idx).html()), "_blank" );
}


Kakao.init('6e77fd382a50866acb40aec217b3948d');

function goShareKakaoTalk(href) {
    var idx = href.split("?idx=")[1]
    var imgTag = $('#img_'+idx).attr("src")

    Kakao.Link.sendDefault({
        objectType: 'feed',
        content: {
            title: '전대전',
            description: $('#content_'+idx).html(),
            imageUrl: href,
            link: {
                mobileWebUrl: "https://djund.com/"+imgTag.replace("../",""),
                webUrl: href
            }
        },
        /*
        social: {
            likeCount: 286,
            commentCount: 45,
            sharedCount: 845
        },
        */
        buttons: [
            {
                title: '웹으로 보기',
                link: {
                    mobileWebUrl: 'https://developers.kakao.com',
                    webUrl: 'https://developers.kakao.com'
                }
            }
        ]

    });
}
function goShareKakaoStory(href) {

}


