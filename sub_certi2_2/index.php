<? include $_SERVER['DOCUMENT_ROOT'] . "/include/head.php" ?>
<style>
    #map_ma {width:100%; height:100%;
        position: fixed !important; clear:both; border:solid 1px red;}
</style>
<body>

<div class="wrapper">
    <header>
        <div class="header grd_bg sub">
            <h1>지역인증</h1>
            <a class="back_btn" href="javascript:history.go(-1)"></a>
        </div>
    </header>
    <section class="main_section">
        <div class="certi_result map">
            <h2 class="hidden">주소 검색지도</h2>
            <div class="map_noti">지도를 움직여 주소를 설정하세요</div>
            <div class="map_wrap">
                <!-- 지도 api 불러올 영역 -->
                <!-- div id="map_ma"></div -->
                <div id="map" style="width:100%; height:100%; position: fixed; "></div>

                <!-- img src="../images/img_sample_map.jpg" alt="" style="max-width:unset; width:200%; " -->
                <p class="map_pointer"><img src="../images/icon_map_pointer.png" alt=""></p>
            </div>
            <div class="map_bot">
                <div class="addr_info">
                    <p class="addr1" id="addr1">마포구 삼개로 3길 13</p> <!-- 도로명주소 -->
                    <p class="addr2" id="addr2">서울특별시 마포구 도화동 209-12</p><!-- 지번주소 -->
                </div>
                <div class="btn_row">
                    <form name="frm" id="frmNext" action="../sub_certi2_3">
                        <input type="hidden" name="oldAddr" id="oldAddr">
                        <input type="hidden" name="newAddr" id="newAddr">
                        <input type="hidden" name="sggNm" id="sggNm">
                        <input type="hidden" name="siNm" id="siNm">
                        <button type="submit" class="blue_btn loca_btn"><img src="../images/icon_loca.png" alt=""> 현 위치로 주소 설정</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=6e77fd382a50866acb40aec217b3948d&libraries=services"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=6e77fd382a50866acb40aec217b3948d" ></script>
<script type="text/javascript" >
    var container = document.getElementById('map'); //지도를 담을 영역의 DOM 레퍼런스
    //126.94771329814067,37.540122492998684
    var options = { //지도를 생성할 때 필요한 기본 옵션
        //center: new kakao.maps.LatLng(33.450701, 126.570667), //지도의 중심좌표.
        //level: 3 //지도의 레벨(확대, 축소 정도)
    };

    var map;
    var geocoder;

    function searchDetailAddrFromCoords(coords) {
        // 좌표로 법정동 상세 주소 정보를 요청합니다
        var callback = function(result, status) {
            if (status === kakao.maps.services.Status.OK) {
                $('#oldAddr').val(result[0].address.address_name);

                $('#addr2').html(result[0].address.address_name)
                $('#addr1').html(result[0].road_address)

                $('#sggNm').val(result[0].address.region_2depth_name);
                $('#siNm').val(result[0].address.region_1depth_name);
            }
        };
        geocoder.coord2Address(coords.getLng(), coords.getLat(), callback);
    }

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(showPosition, errorCallback, positionOptions );
        } else {
            console.log( "Geolocation is not supported by this browser." );
        }
    }

    function errorCallback(error) {
        if (error.code == 1) {
            alert('gps를 켜신후 새로고침 해 주세요.');
        }
    }

    function positionOptions(options) {

    }

    function showPosition(position) {

        options = { //지도를 생성할 때 필요한 기본 옵션
            center: new kakao.maps.LatLng(position.coords.latitude, position.coords.longitude), //지도의 중심좌표.
            level: 3 //지도의 레벨(확대, 축소 정도)
        };

        map = new kakao.maps.Map(container, options);
        geocoder = new kakao.maps.services.Geocoder();

        kakao.maps.event.addListener(map, 'dragend', function() {
            searchDetailAddrFromCoords(map.getCenter());
        });

        searchDetailAddrFromCoords(map.getCenter());

    }
    getLocation();

    /*
     function searchAddrFromCoords(coords) {
     // 좌표로 행정동 주소 정보를 요청합니다
     var callback = function(result, status) {
     if (status === kakao.maps.services.Status.OK) {
     console.log(result)
     }
     };

     console.log( geocoder.coord2RegionCode(coords.getLng(), coords.getLat(), callback) )
     }
     */

</script>



<!-- script>
    $(document).ready(function() {
        var myLatlng = new google.maps.LatLng(35.837143, 128.558612); // 위치값 위도 경도
        var Y_point = 35.837143;		// Y 좌표
        var X_point = 128.558612;		// X 좌표
        var zoomLevel = 18;				// 지도의 확대 레벨 : 숫자가 클수록 확대정도가 큼

        var myLatlng = new google.maps.LatLng(Y_point, X_point);
        var mapOptions = {
            zoom: zoomLevel,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById('map_ma'), mapOptions);

        map.addListener('dragend', function() {
            // 3 seconds after the center of the map has changed, pan back to the
            // marker.
            console.log("drag end")
            console.log("map center: "+map.getCenter().lat())
            var cordinate = map.getCenter();


            $.ajax({
                url:"https://maps.googleapis.com/maps/api/geocode/json",
                data:{"latlng":map.getCenter().lat()+","+map.getCenter().lng(),"key":"AIzaSyBttsNU86lLDankM2ljCLGQMplQowsFkL8"},
                success:function(response) {
                    console.log(response)
                },
                error:function(error) {

                }
            })


        });

    })

</script -->

</body>
</html>

<!--

-->