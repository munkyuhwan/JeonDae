

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
    if (typeof App != "undefined") {
        App.fb_share($('#content_' + idx).html(), href, idx)

    }else if (typeof webkit != "undefined" ) {

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
    if (typeof App != "undefined") {
        App.kakao_share($('#content_' + idx).html(), "https://djund.com/" + imgTag.replace("../", ""), idx);
    }else if (typeof webkit != "undefined" ) {
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
    if (typeof webkit != "undefined" ) {
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
