@extends('layouts.base')
<!-- Navigation -->
@section('body')
<link rel="stylesheet" href="{{ asset('css/landing/style.css') }}">

<!--<section>-->
<!--    <div class="rt-container">-->
<!--        <div class="col-rt-12">-->
<!--            <div class="Scriptcontent">-->
                
<!--                <div class="area" >-->
<!--                    <ul class="circles">-->
<!--                            <li></li>-->
<!--                            <li><img src="{{ asset('img/nofavorite.png') }}" alt="food"></li>-->
<!--                            <li></li>-->
<!--                            <li></li>-->
<!--                            <li></li>-->
<!--                            <li></li>-->
<!--                            <li></li>-->
<!--                            <li></li>-->
<!--                            <li></li>-->
<!--                            <li></li>-->
<!--                            <li></li>-->
<!--                            <li></li>-->
                            <!-- <li><img src="{{ asset('img/food7.png') }}" alt="food"></li>
                            <li><img src="{{ asset('img/nofavorite.png') }}" alt="food"></li>-->
<!--                            <li><img src="{{ asset('img/food7.png') }}" alt="food"></li>-->
<!--                            <li><img src="{{ asset('img/food4.png') }}" alt="food"></li>-->
<!--                            <li><img src="{{ asset('img/food5.png') }}" alt="food"></li>-->
<!--                            <li><img src="{{ asset('img/food6.png') }}" alt="food"></li>-->
<!--                            <li><img src="{{ asset('img/nofavorite.png') }}" alt="food"></li>-->
<!--                            <li><img src="{{ asset('img/food8.png') }}" alt="food"></li>-->
<!--                            <li><img src="{{ asset('img/food3.png') }}" alt="food"></li>-->
<!--                            <li><img src="{{ asset('img/fastfood.jpg') }}" alt="food"></li> -->
<!--                    </ul>-->
<!--                </div >-->
<!--                <form>-->
<!--                    <div class="context">-->
<!--                        <a href="#"><img src="{{ asset('img/Chekout-logo.png') }}" class="logo" alt="food"></a>-->
<!--                        <div class="location-box location-picker open">-->
                            
<!--                                <input type="text" name="location" value="" id="location-a" autocomplete="off" tabindex="1" placeholder="Enter your delivery location" maxlength="30" required>-->
<!--                                <button class="next-1"><b>NEXT</b></button>-->
                            
<!--                        </div>-->
<!--                    </div>-->
<!--                </form>-->
<!--        </div>-->
<!--		</div>-->
<!--    </div>-->
<!--</section>-->
@endsection
@push('scripts')

<script>
    let experience_mode = "";
    $(document).ready(function(){

        var inputa = document.getElementById('location-a');
        var autocompletea = new google.maps.places.Autocomplete(inputa);
        autocompletea.addListener('place_changed', function() {
            var placea = autocompletea.getPlace();
            var valff = placea.formatted_address.split(',');
            console.log(placea.formatted_address);
            var loc = placea.geometry.location;
            console.log(JSON.stringify(loc));
            setCookie("setuplocation", valff[0], 365);
            setCookie("totaladdress", placea.formatted_address, 365);
            setCookie("curloc",JSON.stringify(loc),365);
            
        });

        if ("geolocation" in navigator){ //check geolocation available
            var loc = getCookie("curloc");
            
            if(loc == "")
                navigator.geolocation.getCurrentPosition(function(position){
            
                    var url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyC1jKOFLhfQoZD3xJISSPnSW9-4SyYPpjY&location_type=ROOFTOP&result_type=street_address&latlng='+position.coords.latitude+','+position.coords.longitude;
                    // $(".address").text("nLat : "+position.coords.latitude+" \nLang :"+ position.coords.longitude);
                    var cur_loc = getCookie("curloc");
                    if (cur_loc == "") {
                        var newloc = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        setCookie("curloc", JSON.stringify(newloc), 365);
                        console.log("yes");
                    }
                    $.ajax({
                        url: url,
                        type:'GET',
                        success:function(result){
                            console.log(result);
                        
                            var val = result['results'][0]['formatted_address'].split(',');
                            var setuplocation = getCookie("setuplocation");
                            if (setuplocation == "") {
                                setCookie("setuplocation", val[0], 365);
                                setCookie("totaladdress", result['results'][0]['formatted_address'], 365);
                                setCookie("first", "yes", 365);
                                $(".address").text(val[0]);
                                changeToDeliveryMode();
                            }else{
                                $(".address").text(setuplocation);
                                setCookie("first", "no", 365);
                            }
                        },
                        error:function(error){
                            console.log(error);
                        }
                    });
                },
                function(){
                    console.log("blocked location ---------------------");
                    $("#address-set-modal").modal('show');
                    var address_set_input = document.getElementById('address-set-input');
                        var autocompletea = new google.maps.places.Autocomplete(address_set_input);
                        autocompletea.addListener('place_changed', function() {
                            var placea = autocompletea.getPlace();
                            var valff = placea.formatted_address.split(',');
                            console.log(placea.formatted_address);
                            var loc = placea.geometry.location;
                            console.log(JSON.stringify(loc));
                            setCookie("setuplocation", valff[0], 365);
                            setCookie("totaladdress", placea.formatted_address, 365);
                            setCookie("curloc",JSON.stringify(loc),365);
                            changeToDeliveryMode();
                        });
                }    
            );
            else
            {
                var setuplocation = getCookie("setuplocation");
                $(".address").text(setuplocation);
                setCookie("first", "no", 365);
            }
        }
        
        var loc = getCookie("curloc");
            
            var location = JSON.parse(loc);
            var lat = location.lat;
            var lng = location.lng;
            
            var url = "{{route('home.delivery',['lat'=>'latv','lng' =>'lngv'])}}";
            url = url.replace('latv', lat);
            url = url.replace('lngv', lng);
            $("#gohome").attr("href",url);
            setCookie("mode","delivery",365);
            window.location.href = url;
    
    
    
    })
    
    function setCookie(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
      var expires = "expires="+d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    
    function getCookie(cname) {
      var name = cname + "=";
      var ca = document.cookie.split(';');
      for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }
</script>
@endpush

