<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?
//session_unset();
//unset($_SESSION);
//print_r($_SESSION);
//$_SESSION['user_access_idx'] = 3;
session_start();
if ($_SESSION['user_access_idx'] != "") {
    // echo "<script>location.replace('../main1');</script>";
}

/*
$_SESSION['user_access_idx'] = 56;

$query = "SELECT idx, real_name, file_chg FROM member_info WHERE idx=".$_SESSION['user_access_idx'] ;
$result = mysqli_query($gconnet, $query);
$row = mysqli_fetch_assoc($result);


$_SESSION['user_access_name'] = $row['real_name'];
echo "<script>location.replace('../main1');</script>";
*/
?>
<body>
<div class="wrapper">
    <section class="intro_section grd_bg">
        <h1><img src="../images/logo.png" alt="전대전 로고"></h1>
        <div class="login_link">
            <a href="javascript:checkLoginState()" >Facebook으로 시작하기 </a>
        </div>
    </section>
</div>
<form name="frm" id="frm" action="check_member.php" method="get" >
    <input type="hidden" name="fb_id" id="fb_id" value="" >
    <input type="hidden" name="fb_name" id="fb_name" value="" >
    <input type="hidden" name="fb_email" id="fb_email" value="" >
</form>
<script>

    function checkMember(snsID, snsName, snsEmail) {
        $('#fb_id').val(snsID);
        $('#fb_name').val(snsName);
        $('#fb_email').val(snsEmail);
        $('#frm').submit();
    }

    function checkLoginState() {

        if (typeof App != "undefined") {
            App.fb_login();
        }else if (typeof webkit != "undefined" ) {
            webkit.messageHandlers.fb_login.postMessage("")

        } else {

            FB.getLoginStatus(function (response) {

                if (response.status === 'connected') {
                    FB.api('/me?fields=id,name', function (res) {
                        // 제일 마지막에 실행
                        console.log(res)
                        if (res.id != '') {
                            checkMember(res.id, res.name, res.user_email)
                            //$('#fb_id').val(res.id)
                            //$('#frm').submit()
                        }
                        // alert("Success Login : " + response.name);
                    });

                } else if (response.status === 'not_authorized') {
                    // 사람은 Facebook에 로그인했지만 앱에는 로그인하지 않았습니다.
                    FB.login(function (res) {
                        // handle the response
                        $('#fb_id').val(response.id)
                        //checkMember(res.id, res.name, res.user_email)

                    }, {scope: 'public_profile,email'});
                } else {
                    alert('페이스북에 로그인 해 주세요.');
                    window.open("https://www.facebook.com/","_blank")
                    // 그 사람은 Facebook에 로그인하지 않았으므로이 앱에 로그인했는지 여부는 확실하지 않습니다.
                }

            }, true);
        }
    }

    window.fbAsyncInit = function() {
        FB.init({
            appId      : '966680140341971',
            cookie     : true,
            xfbml      : true,
            version    : 'v5.0'
        });

        FB.AppEvents.logPageView();
        checkLoginState();
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));





</script>
</body>
</html>
Œ