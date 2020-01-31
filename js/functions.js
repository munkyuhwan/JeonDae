

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


function checkPlatform() {
    var userAgent=navigator.userAgent.toLowerCase();

    if (userAgent.indexOf("ANDROID_WEBVIEW")) {
        return "app_android"
    }
    else if (userAgent.indexOf("ANDROID_WEBVIEW")) {
        return "app_ios"
    }
    else {
        return "browser"
    }


}

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
                $("#like_btn_"+report_idx).html(res.like_cnt)
                toast(res.msg)
            }catch(e) {

            }
        },
        error:function(error) {

        }
    });
}

function commentLikeClicked(comment_idx) {
    $.ajax({
        url:"../include/comment_like_action.php",
        data:{"comment_idx":comment_idx},
        success:function(response) {
            try{
                var res = JSON.parse(response);

                if ( $("#comment_like_"+comment_idx).attr('class').replace(" ","") == "like_btn" ) {
                    $("#comment_like_" + comment_idx).attr('class', 'like_btn on');
                }else {
                    $("#comment_like_" + comment_idx).attr('class', 'like_btn');
                }
                toast(res.msg)
                $("#comment_cnt_"+comment_idx).html(res.cnt)
            }catch(e) {

            }
        },
        error:function(error) {

        }
    });
}



function goShare(href, idx) {
    if (checkPlatform() == "app_android") {
        App.fb_share($('#content_' + idx).html(), href, idx)

    }else if (checkPlatform() == "app_ios" ) {

        webkit.messageHandlers.fb_share.postMessage("{\"content\":\""+ encodeURI($('#content_' + idx).html())+"\", \"href\":\""+encodeURI(href)+"\", \"idx\":\""+idx+"\"}")

    } else {
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
    if (imgTag != undefined) {
        imgTag = imgTag.replace("../", "");
    }else {
        imgTag = ""
    }
    if (checkPlatform() == "app_android") {
        App.kakao_share($('#content_' + idx).html(), "https://djund.com/" + imgTag,href, idx);
        //App.kakao_share($('#content_' + idx).html(), href, idx);

    }else if (checkPlatform() == "app_ios") {
        webkit.messageHandlers.kakao_share.postMessage("{\"content\":\""+ encodeURI($('#content_' + idx).html())+"\", \"imgUrl\":\""+"https://djund.com/" + imgTag.replace("../", "")+"\" , \"href\":\""+encodeURI(href)+"\", \"idx\":\""+idx+"\"}")
    }else {
        doKakaoTalkSahre(href, idx)
    }
}

function doKakaoTalkSahre(href, idx) {

    var imgTag = $('#img_' + idx).attr("src")
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
                    mobileWebUrl: href+ "?idx=" + idx,
                    webUrl: href+ "?idx=" + idx
                }
            }
        ]
    });

}

function goShareKakaoStory(href, idx) {
    var imgTag = $('#img_'+idx).attr("src")
    if (imgTag != undefined) {
        imgTag = imgTag.replace("../", "");
    }else {
        imgTag = ""
    }
    if (checkPlatform() == "app_ios" ) {
        webkit.messageHandlers.kakao_story_share.postMessage("{\"content\":\""+ encodeURI($('#content_' + idx).html())+"\", \"imgUrl\":\""+"https://djund.com/" + imgTag.replace("../", "")+"\" , \"href\":\""+encodeURI(href)+"\", \"idx\":\""+idx+"\"}")
    }else {
        Kakao.Story.share({
            url: href + "?idx=" + idx,
            text: $('#content_' + idx).html()
        });
    }
}


function setCommentList(reportIdx, el, txt) {
    $.ajax({
        url:"../include/get_comment_list.php",
        data:{"report_idx":reportIdx},
        success:function(response) {

            if ( $("#comment_list_whole_"+reportIdx).css("display") == "none" ) {
                $("#comment_list_whole_" + reportIdx).css("display", "block")
                $("#comment_list_whole_" + reportIdx).html(response);
                $("#comment_list_" + reportIdx).css("display", "none");
                el.innerHTML = txt+"닫기"
            }else {
                $("#comment_list_whole_" + reportIdx).css("display", "none")
                $("#comment_list_whole_" + reportIdx).html(response);
                $("#comment_list_" + reportIdx).css("display", "block");
                el.innerHTML = txt+"모두보기"
            }
        },
        error:function(error) {

        }
    });

}
function getMobileOperatingSystem() {
    var userAgent = navigator.userAgent || navigator.vendor || window.opera;

    //console.log(userAgent);
    // Windows Phone must come first because its UA also contains "Android"
    if (/windows phone/i.test(userAgent)) {
        return "Windows Phone";
    }

    if (/android/i.test(userAgent)) {
        return "Android";
    }

    // iOS detection from: http://stackoverflow.com/a/9039885/177710
    if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
        return "iOS";
    }

    if (/Safari/.test(userAgent) && !window.MSStream ) {
        return "iOS";
    }

    return "unknown";
}

function isScrolledBottom(e) {

    //안드로이드, 브라우저
    if (getMobileOperatingSystem() == "Android") {
        if ( Math.ceil($(window).innerHeight() + $(window).scrollTop()) >= $("body").height()) {
            return true;
        }else {
            return false;
        }
    }else if (getMobileOperatingSystem() == "iOS") {
        if ( (Math.ceil($(window).innerHeight() + $(window).scrollTop())) === ($("body").height()-64) ) {
            e.preventDefault();

            return true;
        }else {
            return false;
        }
    }else {


        if ( Math.ceil($(window).innerHeight() + $(window).scrollTop()) >= $("body").height()) {
            return true;
        }else {
            return false;
        }
    }

}