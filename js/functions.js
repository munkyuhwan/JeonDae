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



function goShare(href, idx) {
    if (typeof App != "undefined") {
        App.fb_share($('#content_' + idx).html(), href, idx)
    }else {
       goFBShare(href, idx)
    }
}

function goFBShare(href, idx) {
    FB.ui({
        method: 'share',
        href: href + "?idx=" + idx,
    }, function (response) {
    });
}

function goShareTwitter(href, idx) {
    window.open("https://twitter.com/intent/tweet?text="+ decodeURI( href+"?idx="+idx+"\n"+$('#content_'+idx).html()), "_blank" );
}

Kakao.init('6e77fd382a50866acb40aec217b3948d');

function goShareKakaoTalk(href, idx) {
    var imgTag = $('#img_'+idx).attr("src")
    if (typeof App != "undefined") {
        App.kakao_share($('#content_' + idx).html(), "https://djund.com/" + imgTag.replace("../", ""), idx);
    }else {
        doKakaoTalkSahre(href, idx)
    }
}

function doKakaoTalkSahre(href, idx) {
    var imgTag = $('#img_'+idx).attr("src")
    Kakao.Link.sendDefault({
        objectType: 'feed',
        content: {
            title: '전대전',
            description: $('#content_' + idx).html(),
            imageUrl: "https://djund.com/" + imgTag.replace("../", ""),
            link: {
                mobileWebUrl: href + "?idx=" + idx,
                webUrl: href + "?idx=" + idx
            }
        },
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

function goShareKakaoStory(href, idx) {
    Kakao.Story.share({
        url: href+"?idx="+idx,
        text: $('#content_'+idx).html()
    });
}


