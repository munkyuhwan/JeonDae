<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<?

$_SESSION['user_access_idx'] = 54;

$query = "SELECT idx, real_name, file_chg FROM member_info WHERE idx=".$_SESSION['user_access_idx'] ;
$result = mysqli_query($gconnet, $query);
$row = mysqli_fetch_assoc($result);


$_SESSION['user_access_name'] = $row['real_name'];
$_SESSION['profile_img'] = $row['file_chg'];
echo "<script>location.replace('../main1');</script>";
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
    <input type="hidden" name="fb_id" id="fb_id" >
</form>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '966680140341971',
            cookie     : true,
            xfbml      : true,
            version    : 'v5.0'
        });

        FB.AppEvents.logPageView();

    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    function checkLoginState() {
        FB.getLoginStatus(function(response) {

            console.log(response.status)
            if (response.status === 'connected') {
                FB.api('/me', function(res) {
                    // 제일 마지막에 실행
                    if (res.id!='') {
                        //checkMember(res.id)
                        $('#fb_id').val(res.id)
                        $('#frm').submit()
                    }
                    // alert("Success Login : " + response.name);
                });
            } else if (response.status === 'not_authorized') {
                // 사람은 Facebook에 로그인했지만 앱에는 로그인하지 않았습니다.
                FB.login(function(response) {
                    // handle the response
                    $('#fb_id').val(response.id)

                }, {scope: 'public_profile,email'});
            } else {
                // 그 사람은 Facebook에 로그인하지 않았으므로이 앱에 로그인했는지 여부는 확실하지 않습니다.
            }

        }, true);
    }

    function checkMember(idx) {
        $('#fb_id').val(idx);
        $('#frm').submit();
        /*
         $.ajax({
         url:"check_member.php",
         method:"POST",
         data:{"fb_id":idx},
         success:function(response) {

         try {
         var res = JSON.parse(response);
         console.log(res.result)
         if (res.result != true ) {
         location.href = '../join/';
         }else {
         location.href = '../main1/';
         }

         }catch (e) {

         }

         },
         error:function(error) {

         }
         })
         */
    }



</script>
</body>
</html>
