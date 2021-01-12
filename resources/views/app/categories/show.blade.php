@extends('layouts.app')
@section('title')
    <title>Chekout | Categories</title>
@endsection

@section('content')
    <div class="most-popular section-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-10 offset-1 browse-cat border-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="section-header-left">
                                <h3 class="text-light-black header-title title-2">{{$categoryName}}</h3>
                            </div>
                        </div>
                        @if(!empty($nearby) && count($nearby) > 0)
                        
                            <div class="row col-12" id="restaurant-list">
                            @foreach($nearby as $restaurant)
                                <?php
                                    $defaultdate=$today ?? strtolower(date("l"));
                                    $isOpenedRes = false;
                                    $message = "";
                                    
                                    $date =$datetime ?? time();
                                    if($restaurant['operation_info'][$defaultdate][0]){
                                        if($restaurant['operation_info'][$defaultdate][1]=='null'){
                                            $restaurant['operation_info'][$defaultdate][1] = "11:00";
                                        }

                                        if($restaurant['operation_info'][$defaultdate][2]=='null'){
                                            $restaurant['operation_info'][$defaultdate][2] = "21:00";
                                        }
                                        if (isset($selectedtime)){
                                        $rtsgd=strtotime($selectedtime);
                                        }
                                        else{
                                            $rtsgd=strtotime('now');
                                        }
                                        
                                         
                                        $st_time    =   strtotime($restaurant['operation_info'][$defaultdate][1]);
                                        $end_time   =   strtotime($restaurant['operation_info'][$defaultdate][2]);
                                        
                                        $cur_time   =   $rtsgd;
                                        
                                        if($st_time < $end_time) {
                                            if($st_time < $cur_time && $end_time > $cur_time)
                                                {
                                                    $isOpenedRes = true;
                                                }
                                        } else {
                                            $mid_time   =   strtotime('23:59:59');
                                            $day_time   =   strtotime('00:00:00');
                                            if(($st_time < $cur_time && $cur_time <= $mid_time) || ($day_time < $cur_time && $cur_time <= $end_time))
                                                {
                                                    $isOpenedRes = true;
                                                }
                                        }
                                        // $isOpenedRes = true;
                                        if($st_time > $cur_time){
                                            $message = 'Open at '.date('g:i A', strtotime($restaurant['operation_info'][$defaultdate][1]));
                                        }

                                        if($end_time <= $cur_time){
                                            if($restaurant['operation_info'][strtolower(date("l", strtotime('tomorrow')))][0]){
                                                if($restaurant['operation_info'][strtolower(date("l", strtotime('tomorrow')))][1]=='null'){
                                                    $restaurant['operation_info'][$defaultdate][1] = "11:00";
                                                }
    
                                                $message = 'Closed until: Tomorrow '.date('g:i A', strtotime($restaurant['operation_info'][strtolower(date("l", strtotime('tomorrow')))][1]));
                                                
                                            }else{
                                                for($i=2; $i < 7; $i++){
                                                    if($restaurant['operation_info'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][0]){
                                                        if($restaurant['operation_info'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][1]=='null'){
                                                            $restaurant['operation_info'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][1] = "11:00";
                                                        }
                                                        $message = 'Closed until: '.date("l", strtotime('+'.$i.' day', $date)).' '.date('g:i A', strtotime($restaurant['operation_info'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][1]));
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                        
                                    } else {
                                        if($restaurant['operation_info'][strtolower(date("l", strtotime('tomorrow')))][0]){
                                            if($restaurant['operation_info'][strtolower(date("l", strtotime('tomorrow')))][1]=='null'){
                                                $restaurant['operation_info'][$defaultdate][1] = "11:00";
                                            }

                                            $message = 'Closed until: Tomorrow '.date('g:i A', strtotime($restaurant['operation_info'][strtolower(date("l", strtotime('tomorrow')))][1]));
                                            
                                        }else{
                                            for($i=2; $i < 7; $i++){
                                                if($restaurant['operation_info'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][0]){
                                                    if($restaurant['operation_info'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][1]=='null'){
                                                        $restaurant['operation_info'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][1] = "11:00";
                                                    }
                                                    $message = 'Closed until: '.date("l", strtotime('+'.$i.' day', $date)).' '.date('g:i A', strtotime($restaurant['operation_info'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][1]));
                                                    break;
                                                }
                                            }
                                        }
                                    }


                                    /* Check Favorite */

                                    $isFavorite = false;
                                    foreach($favorites as $fav) {
                                        if($fav['data']->vendor_id == $restaurant['vendor_id']){
                                            $isFavorite = true;
                                            break;
                                        }
                                    }

                                    
                                ?>
                                
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product-box mb-xl-20 b-">
                                        <div class="product-img" @if($isOpenedRes) onclick="location.href='{{route('app.restaurant.show', ['id' => $restaurant['vendor_id'] ?? ''])}}';" style="cursor:pointer;" @else style="cursor:not-allowed;" @endif>
                                            <a href="">
                                                <img
                                                    src="{{$restaurant['photo'] ?? 'https://via.placeholder.com/255x150'}}"
                                                    class="img-fluid full-width"
                                                    alt="product-img" style="height:150px;">
                                            </a>
                                            <div class="overlay" @if(!$isOpenedRes) style="background-color: rgba(0,0,0,0.7); color: white; font-size: 16px" @endif>
                                                <div class="product-tags padding-10">
                                                    <div class="custom-tag">
                                                        @if(!$isOpenedRes)
                                                            {{ $message??"Closed" }}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" value="{{$restaurant['latitude']}}">
                                        <input type="hidden" value="{{$restaurant['longitude']}}">
                                        <input type="hidden" value="{{$restaurant['prep_min']}}">
                                        
                                        <div class="product-caption">
                                            <p>
                                                <span class = "fa fa-heart favorite-icon @if($isFavorite) active @endif">
                                                    <input type="hidden" class = "vendorId_for_fav" value="{{$restaurant['vendor_id']}}">
                                                    <input type="hidden" class = "name_for_fav" value="{{ $restaurant['name'] ?? ''}}">
                                                    <input type="hidden" class = "photo_for_fav" value="{{ $restaurant['photo'] }}">
                                                    <input type="hidden" class = "description_for_fav" value="{{$restaurant['description'] ?? ''}}">
                                                    <input type="hidden" class = "address_for_fav" value="{{$restaurant['address'] ?? ''}}">
                                                    <input type="hidden" class = "hours_for_fav" value="{{json_encode($restaurant['operation_info'])}}">
                                                </span>
                                            </p>
                                            <div class="title-box">
                                                <h6 class="product-title" @if($isOpenedRes) onclick="location.href='{{route('app.restaurant.show', ['id' => $restaurant['vendor_id'] ?? ''])}}';" style="cursor:pointer; font-weight:bold" @else style="cursor:not-allowed; font-weight:bold" @endif>
                                                    {{ $restaurant['name'] ?? '' }}
                                                </h6>
                                                <div class="tags">
                                                </div>
                                            </div>
                                            <p class="text-light-black" style="display:inline; margin-right:30px;">{{ $restaurant['description'] ?? '' }}</p>
                                            <div class="product-details">
                                                <div class="price-time"><span
                                                        class="text-ligh-white time">{{ explode(',',$restaurant['address'])[0] ?? '' }}</span>
                                                    <span
                                                        class="text-ligh-white price">{{ $restaurant['min_order'] ?? '' }}</span>
                                                </div>
                                                {{--                                                <div class="rating"> <span>--}}
                                                {{--                        <i class="fas fa-star text-yellow"></i>--}}
                                                {{--                        <i class="fas fa-star text-yellow"></i>--}}
                                                {{--                        <i class="fas fa-star text-yellow"></i>--}}
                                                {{--                        <i class="fas fa-star text-yellow"></i>--}}
                                                {{--                        <i class="fas fa-star text-yellow"></i>--}}
                                                {{--                      </span>--}}
                                                {{--                                                    <span class="text-light-white text-right">4225 ratings</span>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                            <div class="product-footer">
                                                 <span
                                                     class="text-{{ isset($vendor['price']) && $vendor['price'] > 0 ? 'success' : 'dark-white' }} fs-16" style="color:black; font-size:12px;"></span>
                                                     
                                                <!--<span-->
                                                <!--    class="text-{{ isset($vendor['price']) &&  $vendor['price'] > 1 ? 'success' : 'dark-white' }} fs-16">$</span>-->
                                                <!--<span-->
                                                <!--    class="text-{{ isset($vendor['price']) &&  $vendor['price'] > 2 ? 'success' : 'dark-white' }} fs-16">$</span>-->
                                                <!--<span-->
                                                <!--    class="text-{{ isset($vendor['price']) &&  $vendor['price'] > 3 ? 'success' : 'dark-white' }} fs-16">$</span>-->
                                                <!--<span-->
                                                <!--    class="text-{{ isset($vendor['price']) &&  $vendor['price'] > 4 ? 'success' : 'dark-white' }} fs-16">$</span>-->
                                                {{--                                                <span class="text-custom-white square-tag">--}}
                                                {{--                      <img src="/img/svg/004-leaf.svg" alt="tag">--}}
                                                {{--                    </span>--}}
                                                {{--                                                <span class="text-custom-white square-tag">--}}
                                                {{--                      <img src="/img/svg/006-chili.svg" alt="tag">--}}
                                                {{--                    </span>--}}
                                                {{--                                                <span class="text-custom-white square-tag">--}}
                                                {{--                      <img src="/img/svg/005-chef.svg" alt="tag">--}}
                                                {{--                    </span>--}}
                                                {{--                                                <span class="text-custom-white square-tag">--}}
                                                {{--                      <img src="/img/svg/008-protein.svg" alt="tag">--}}
                                                {{--                    </span>--}}
                                                {{--                                                <span class="text-custom-white square-tag">--}}
                                                {{--                      <img src="/img/svg/009-lemon.svg" alt="tag">--}}
                                                {{--                    </span>--}}
                                            </div>
                                            <!--<i class="fa fa-calendar calendar" custom1="{{$restaurant['vendor_id']}}" id="calendar" style="float: right; font-size: 17px;"></i>-->
                                            <span class="text-ligh-white price" style="float:left; padding: .375rem; padding-left:0"><b>Phone Number</b>&nbsp;:&nbsp;{{ $restaurant['phone'] ?? '' }}</span>
                                            <button class="btn btn calendar" custom1="{{$restaurant['vendor_id']}}" customStart="{{$restaurant['operation_info'][$defaultdate][1]}}" customEnd={{$restaurant['operation_info'][$defaultdate][2]}} style=" float: right;" id="calendar">Schedule <i class="fas fa-calendar"></i></button>
                                        </div>
                                    </div>
                                </div>
                               
                            @endforeach
                                
                            </div>
                        @else
                            <div class="col-12">
                                <div class="alert alert-info">
                                    We don't have any restaurants in this category yet. Check back soon!
                                </div>
                            </div>
                        @endif
                    </div>
                    <section class="browse-cat u-line section-padding">
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="section-header-left">
                                        <h3 class="text-light-black header-title title">Browse by cuisine
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="category-slider swiper-container">
                                        <div class="swiper-wrapper">
                                            @foreach($categories as $category)
                                                @if($category['photo'] && $category['photo'] != "")
                                                <div class="swiper-slide">
                                                    <a href="{{ route('app.category.show', ['id' => $category['title']])}}"
                                                       class="categories">
                                                        <div class="icon text-custom-white bg-light-green ">
                                                        @if(!str_contains($category['photo'], "http"))
                                                        <img src="{{ asset('img/categories') }}/{{$category['photo']}}" class="rounded-circle" alt="categories">
                                                        @else
                                                        <img src="{{$category['photo']}}" class="rounded-circle" alt="categories">
                                                        @endif
                                                        </div>
                                                        <span
                                                            class="text-light-black cat-name">{{ $category['title'] }}</span>
                                                    </a>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                        <!-- Add Arrows -->
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- Browse by category -->

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script>
    $(function(){
        var mode = "{{ Session::get('mode')}}";
        var isDelivery = "{{ $delivery }}";
        var category = "{{ $categoryName }}"
        if(mode == "delivery"){
        if(isDelivery != "1"){

            var loc = getCookie("curloc");
            setCookie("mode","delivery", 365);
            if(loc == "") return;
            var locatione = JSON.parse(loc);
            var lat = locatione.lat;
            var lng = locatione.lng;

            var url = "{{route('app.category.show.delivery',['id'=>'categoryv','lat'=>'latv','lng' =>'lngv'])}}";
            url = url.replace('categoryv', category);
            url = url.replace('latv', lat);
            url = url.replace('lngv', lng);
            console.log(url);
            location.href = url;
        }
    }
    });

    //console.log(startTime,endTime)
    var date = new Date();
    var newdate = new Date(date);

    newdate.setDate(newdate.getDate() + 15);
    
    var dd = newdate.getDate();
    var tm = newdate.getTime();
    var mm = newdate.getMonth() + 1;
    var y = newdate.getFullYear();

    var someFormattedDate = y + '/' + mm + '/' + dd;
   
     
   

   
    </script>
    <script>
        
        $(document).ready(function () {
            if ("geolocation" in navigator){ //check geolocation available
	            function myFunction(item) {
                    var latitude = parseFloat($(item).children().eq(0).children().eq(1).val());
                    var longitude = parseFloat($(item).children().eq(0).children().eq(2).val());
                    // var current_lat = parseFloat($('#current_lat').val());
                    // var current_lng = parseFloat($('#current_lng').val());
                    var prep_time = $(item).children().eq(0).children().eq(3).val();
                    //var timeurl = 'https://maps.googleapis.com/maps/api/distancematrix/json?origins='+current_lat+','+current_lng+'&destinations='+latitude+','+longitude+'&&key=AIzaSyC1jKOFLhfQoZD3xJISSPnSW9-4SyYPpjY';
                   
                   
                   //console.log(current_lat);
                   //const origin1 = { lat: current_lat, lng: current_lng };
                   const current_addr = getCookie("setuplocation");
                   const dest1 = {lat: latitude,lng: longitude};
                 
                   var service = new google.maps.DistanceMatrixService();  
                    service.getDistanceMatrix({
                      origins: [current_addr],
                      destinations: [dest1],
                      travelMode: google.maps.TravelMode.DRIVING,
                     },function(response){
                         //console.log(response);
                        count++;
                        if(getCookie("first") == "yes"){
                            console.log(getCookie("mode"));
                            if(getCookie("mode") == "delivery"){
                                $(item).find("div.product-footer").children().eq(0).text("Estimated Delivery Time: "+response['rows'][0]['elements'][0]['duration']['text']+" + "+prep_time+"mins");
                            }
                        }
                        else{
                                var temp1 = response['rows'][0]['elements'][0]['duration']['text'];
                        
                                var day1=0;
                                var hour1=0;
                                var min1=0;
                                temp1 = temp1.split(' ');
                
                                for(var i = 0; i < temp1.length - 1; i++) {
                                    if(temp1[i+1] == 'days' || temp1[i+1] == 'day')
                                        day1 = parseInt(temp1[i]);
                                    else if(temp1[i+1] == 'hours' || temp1[i+1] == 'hour')
                                        hour1 = parseInt(temp1[i]);
                                    else if(temp1[i+1] == 'mins' || temp1[i+1] == 'min')
                                        min1 = parseInt(temp1[i]);
                                }
                                
                               
                                t_min1 =  day1*24 + hour1*60 + min1 + parseInt(prep_time);
                                t_min2 =  t_min1 + 10;
                                
                            if(getCookie("mode") == "delivery"){
                                $(item).find("div.product-footer").children().eq(0).text("Estimated Delivery Time: " + t_min1+" mins"+" ~ "+t_min2+" mins");
                            }
 
                        }
                         if(count == lists.length){
                            mother = $("#restaurant-list");
                            element = mother.children("div.col-lg-4");
                            element.sort(function(a, b) {
                                
                                var temp1 = $(a).find("div.product-footer").children().eq(0).text();
                                var temp2 = $(b).find("div.product-footer").children().eq(0).text();
                                
                                var min1=0, min2 = 0;
                                temp1 = temp1.split(' ');
                                temp2 = temp2.split(' ');
                                
                                for(var i = 0; i < temp1.length - 2; i++) {
                                   if(temp1[i+1] == 'mins')
                                        min1 = parseInt(temp1[i]);
                                }
                                
                                for(var i = 0; i < temp2.length - 2; i++) {
                                    if(temp1[i+1] == 'mins')
                                        min2 = parseInt(temp2[i]);
                                }
                                
                                if (min1 > min2)
                                    return 1;
                                if (min1 < min2)
                                    return -1;
                                
                                return 0;
                            });
                            element.detach().appendTo(mother);
                        }
                     });
                    
                }
	            //rr
                // navigator.geolocation.getCurrentPosition(function(position){
                //     console.log("Found your location \nLat : "+position.coords.latitude+" \nLang :"+ position.coords.longitude);
                //     $("#current_lat").val(position.coords.latitude.toString());
                //     $("#current_lng").val(position.coords.longitude.toString());
                //     var url = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyC1jKOFLhfQoZD3xJISSPnSW9-4SyYPpjY&location_type=ROOFTOP&result_type=street_address&latlng='+position.coords.latitude+','+position.coords.longitude;
                //     // $(".address").text("nLat : "+position.coords.latitude+" \nLang :"+ position.coords.longitude);
                //     $.ajax({
                //         url: url,
                //         type:'GET',
                //         success:function(result){
                //             console.log(result['results'][0]['formatted_address']);
                            
                //             var val = result['results'][0]['formatted_address'].split(',');
                //           //  $(".address").text(val[0]);
                //         },
                //         error:function(error){
                //             console.log(error);
                //         }
                //     });
                    var count = 0;
                    var lists = $("#restaurant-list").children("div.col-lg-4").toArray();
                    lists.forEach(myFunction);
                    
                //});
                
                
            }
           // var lists = $("#restaurant-list").children("div.col-lg-4").toArray();
            //lists.forEach(myFunction);


            /* favorite restaurant */

            $('.favorite-icon').click(function(){
                if($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    var vendor_id = $(this).children('.vendorId_for_fav').val();
                    $.ajax({
                        url: '{{ route("app.remove-favorite") }}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: vendor_id
                        },
                        success: function(result) {

                        },
                        error: function(result) {
                            $(this).addClass('active');
                        }
                    });

                } else {
                    $(this).addClass('active');
                    var vendor_id = $(this).children('.vendorId_for_fav').val();
                    var data = {
                        vendor_id: vendor_id,
                        name: $(this).children('.name_for_fav').val(),
                        description: $(this).children('.description_for_fav').val(),
                        hours: JSON.parse($(this).children('.hours_for_fav').val()),
                        photo: $(this).children('.photo_for_fav').val(),
                        address: $(this).children('.address_for_fav').val(),
                    };

                    $.ajax({
                        url: '{{ route("app.add-favorite") }}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            data: JSON.stringify(data),
                            type: 'restaurant',
                            id: vendor_id
                        },
                        success: function(result) {
                            console.log(result);
                            if(result == 0) {
                                $(this).removeClass('active');
                                location.href = "{{ route('auth.login') }}";
                                return;
                            }

                        },
                        error: function(result) {
                            $(this).removeClass('active');
                        }
                    });
                }
            });

    

        });
    </script>
    <script>
     var startTime='';
     var endTime='';
        $('.calendar').click(function(){
               resId=$(this).attr('custom1');
               startTime=$(this).attr('customStart');
               endTime=$(this).attr('customEnd');
              console.log(endTime)
            $("#dateModal").modal("show");
             $("#formdiv").html(`<input type="text" id="resId" value=${resId} name="resId" hidden>`)
               console.log(resId);

               var setMin = function(){
            
                this.setOptions({
                    minTime:'11:00 AM'
                });
              };
             
        });
       
       $("#date").on("change", function (e) {
         var hms=startTime;
        var date2 = new Date();
        var newdate2 = new Date(date2,hms);
        console.log(date2);
            console.log(newdate2);
        });
        $('#date').datetimepicker({ 
            step: 30, 
            inline:true,
            maxDate:someFormattedDate,
            format: 'm/d/y g:i A',
            formatTime: 'g:i A',
            //minTime:tm
            
            
            
        });

        
    </script>
    <style>
        .header .search-form span.address{
            min-width:250px;
        }
    </style>
    <style>
    @media only screen and (min-width: 820px) {
  #responsive {
      width: 1140px;
      margin-left: -45px;
  }
}
    </style>
@endpush
