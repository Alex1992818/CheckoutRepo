@extends('layouts.app')

@section('title')
<title>Chekout</title>
@endsection

@section('content')
<!-- slider -->
<style>
    h5.card-title.homeThreeHead {
        margin: 0;
    }

    p.card-text.text-dark.homeThreePara {
        margin: 0;
        padding: 0;
        text-align: left;
        line-height: 1.3;
    }

    .homeCardBody {
        padding: 0.3em 0 0 0 !important;
    }

    .homeDownThreee {
        width: 106%;
    }

    .learnMoreHome {
        color: #FF1493;
        font-weight: 600;
    }

    #calendar {
        cursor: pointer;
    }
</style>
<?php  $testing=[ 0=>"sunday",
                  1=>"monday",
                  2=>"tuesday",
                 3=>"wednesday",
                  4=>"thursday", 
                   5=>"friday",
                 6=>"saturday"
];

//$rtis=[];
?> 
<section class="about-us-slider swiper-container p-relative">
    <div class="swiper-wrapper">
        <div class="swiper-slide slide-item">
            <img src="{{ asset('/img/processed.jpeg') }}" class="img-fluid full-width" alt="Banner">
            <div class="transform-center">
                <div class="container">
                    <div class="row justify-content-start">
                        <div class="col-lg-7 align-self-center">
                            <div class="right-side-content" id="responsive">
                                <h1 class="text-custom-white fw-600">TIRED OF ENDLESS FEES? CHEK(US)OUT</h1>
                                <h4 class="text-custom-white fw-400">Your favourite New York City restaurants at a
                                    fraction of the cost.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="overlay overlay-bg"></div>
        </div>
    </div>
    
  
</section>
<!-- slider -->
<!-- Browse by category -->
<section class="browse-cat u-line section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header-left">
                    <h3 class="text-light-black header-title title">Browse by cuisine</h3>
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
<!-- Browse by category -->
<!-- your previous order -->
{{-- <section class="recent-order section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-header-left">
                    <h3 class="text-light-black header-title title">Your previous orders <span class="fs-14"><a
                                href="{{ route('app.user.orders.past') }}">See all past orders</a></span></h3>
                </div>
            </div>
            @if(isset($prevOrders) && $prevOrders->count() > 0)
            @foreach($prevOrders as $order)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="product-box mb-md-20">
                    <div class="product-img">
                        <a href="restaurant.html">
                            <img src="https://via.placeholder.com/255x104" class="img-fluid full-width"
                                alt="product-img">
                        </a>
                    </div>
                    <div class="product-caption">
                        <h6 class="product-title"><a href="restaurant.html" class="text-light-black ">
                                Chilli
                                Chicken Pizza</a></h6>
                        <p class="text-light-white">Big Bites, Brooklyn</p>
                        <div class="product-btn">
                            <a href="order-details.html" class="btn-first white-btn full-width text-dark fw-600">Track Order</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-12">
                <div class="alert alert-info">
                    You havent ordered anything yet.
                </div>
            </div>
            @endif
        </div>
    </div>
</section> --}}
<!-- your previous order -->
<!-- Explore collection -->
<section class="ex-collection section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12" sytle="display: flex;">
                <div class="section-header-left" style="float:left;"> 
                    <h3 class="text-light-black header-title title">Restaurants Near You</h3>
                </div>
                <!--<div class="section-header-right" style="float: right">-->
                <!--    <h3 class="text-light-black header-title title" style="font-size: 17px;" id="page_title">Page 1</h3>-->
                <!--</div>-->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="row" id="restaurant-list">
                    <input type="hidden" id="current_lat" value="">
                    <input type="hidden" id="current_lng" value="">
                    @if(isset($nearby))
                    @foreach($nearby as $restaurant)
                    <?php $rtis= array();
                    $jsonValues='';
                                    $defaultdate=$today ?? strtolower(date("l"));
                                    $isOpenedRes = false;
                                    $message = "";
                                foreach($testing as $ks => $test){
                                    if($restaurant['operation_info'][$test][0] == false){
                                        $rtis[]=$ks;
                                        $jsonValues = json_encode($rtis);
                                    }
                                  }
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

                                        
                                        
                                        if($st_time <= $end_time) {
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

                    <div class="col-lg-4 col-md-6 col-sm-6 item-restaurant">
                        <div class="product-box mb-xl-20 b-">
                            <div class="product-img" @if($isOpenedRes)
                                onclick="location.href='{{route('app.restaurant.show', ['id' => $restaurant['vendor_id'] ?? ''])}}';"
                                style="cursor:pointer;" @else style="cursor:not-allowed;" @endif>
                                <a href="">
                                    <img src="{{$restaurant['photo'] ?? 'https://via.placeholder.com/255x150'}}"
                                        class="img-fluid full-width" alt="product-img" style="height:150px;">
                                </a>
                                <div class="overlay" @if(!$isOpenedRes)
                                    style="background-color: rgba(0,0,0,0.7); color: white; font-size: 16px" @endif>
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
                                    <span class="fa fa-heart favorite-icon @if($isFavorite) active @endif">
                                        <input type="hidden" class="vendorId_for_fav"
                                            value="{{$restaurant['vendor_id']}}">
                                        <input type="hidden" class="name_for_fav"
                                            value="{{ $restaurant['name'] ?? ''}}">
                                        <input type="hidden" class="photo_for_fav" value="{{ $restaurant['photo'] }}">
                                        <input type="hidden" class="description_for_fav"
                                            value="{{$restaurant['description'] ?? ''}}">
                                        <input type="hidden" class="address_for_fav"
                                            value="{{$restaurant['address'] ?? ''}}">
                                        <input type="hidden" class="hours_for_fav"
                                            value="{{json_encode($restaurant['operation_info'])}}">
                                    </span>
                                </p>
                                <div class="title-box">
                                    <h6 class="product-title" @if($isOpenedRes)
                                        onclick="location.href='{{route('app.restaurant.show', ['id' => $restaurant['vendor_id'] ?? ''])}}';"
                                        style="cursor:pointer; font-weight:bold" @else
                                        style="cursor:not-allowed; font-weight:bold" @endif>
                                        {{ $restaurant['name'] ?? '' }}
                                    </h6>
                                    <div class="tags">
                                    </div>
                                </div>
                                <p class="text-light-black" style="display:inline; margin-right:30px;">{{
                                    $restaurant['description'] ?? '' }}</p>
                                <div class="product-details">
                                    <div class="price-time"><span class="text-ligh-white time">{{
                                            explode(',',$restaurant['address'])[0] ?? '' }}</span>
                                        <span class="text-ligh-white price">{{ $restaurant['min_order'] ?? '' }}</span>
                                    </div>
                                    {{-- <div class="rating"> <span>--}}
                                            {{-- <i class="fas fa-star text-yellow"></i>--}}
                                            {{-- <i class="fas fa-star text-yellow"></i>--}}
                                            {{-- <i class="fas fa-star text-yellow"></i>--}}
                                            {{-- <i class="fas fa-star text-yellow"></i>--}}
                                            {{-- <i class="fas fa-star text-yellow"></i>--}}
                                            {{-- </span>--}}
                                        {{-- <span class="text-light-white text-right">4225 ratings</span>--}}
                                        {{-- </div>--}}
                                </div>
                                <div class="product-footer">
                                    <span
                                        class="text-{{ isset($vendor['price']) && $vendor['price'] > 0 ? 'success' : 'dark-white' }} fs-16"
                                        style="color:black; font-size:12px;"></span>

                                    <!--<span-->
                                    <!--    class="text-{{ isset($vendor['price']) &&  $vendor['price'] > 1 ? 'success' : 'dark-white' }} fs-16">$</span>-->
                                    <!--<span-->
                                    <!--    class="text-{{ isset($vendor['price']) &&  $vendor['price'] > 2 ? 'success' : 'dark-white' }} fs-16">$</span>-->
                                    <!--<span-->
                                    <!--    class="text-{{ isset($vendor['price']) &&  $vendor['price'] > 3 ? 'success' : 'dark-white' }} fs-16">$</span>-->
                                    <!--<span-->
                                    <!--    class="text-{{ isset($vendor['price']) &&  $vendor['price'] > 4 ? 'success' : 'dark-white' }} fs-16">$</span>-->
                                    {{-- <span class="text-custom-white square-tag">--}}
                                        {{-- <img src="/img/svg/004-leaf.svg" alt="tag">--}}
                                        {{-- </span>--}}
                                    {{-- <span class="text-custom-white square-tag">--}}
                                        {{-- <img src="/img/svg/006-chili.svg" alt="tag">--}}
                                        {{-- </span>--}}
                                    {{-- <span class="text-custom-white square-tag">--}}
                                        {{-- <img src="/img/svg/005-chef.svg" alt="tag">--}}
                                        {{-- </span>--}}
                                    {{-- <span class="text-custom-white square-tag">--}}
                                        {{-- <img src="/img/svg/008-protein.svg" alt="tag">--}}
                                        {{-- </span>--}}
                                    {{-- <span class="text-custom-white square-tag">--}}
                                        {{-- <img src="/img/svg/009-lemon.svg" alt="tag">--}}
                                        {{-- </span>--}}
                                </div>
                                <!--<i class="fa fa-calendar calendar" custom1="{{$restaurant['vendor_id']}}" id="calendar" style="float: right; font-size: 17px;"></i>-->
                                <span class="text-ligh-white price"
                                    style="float:left; padding: .375rem; padding-left:0"><b>Phone
                                        Number</b>&nbsp;:&nbsp;{{ $restaurant['phone'] ?? '' }}</span>
                                <button class="btn btn calendar" custom1="{{$restaurant['vendor_id']}}" customStart="{{$restaurant['operation_info'][$defaultdate][1]}}" customEnd="{{$restaurant['operation_info'][$defaultdate][2]}}" customDays="{{$jsonValues}}"  style="float: right;" id="calendar">Schedule <i class="fas fa-calendar"></i></button>
                            </div>
                        </div>
                    </div>

                    @endforeach
                    @else
                    <div class="col-12">
                        <div class="alert alert-primary">
                            No restaurants near you.
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <ul class="pagination custom-pagination" style="width: 100%"></ul>
        </div>
        {{-- <div class="row">--}}
            {{-- <div class="col-md-6">--}}
                {{-- <div class="ex-collection-box mb-sm-20">--}}
                    {{-- <img src="https://via.placeholder.com/540x300" class="img-fluid full-width" alt="image">--}}
                    {{-- <div class="category-type overlay padding-15"><a href="restaurant.html"
                            class="category-btn">Top--}}
                            {{-- rated</a>--}}
                        {{-- </div>--}}
                    {{-- </div>--}}
                {{-- </div>--}}
            {{-- <div class="col-md-6">--}}
                {{-- <div class="ex-collection-box">--}}
                    {{-- <img src="https://via.placeholder.com/540x300" class="img-fluid full-width" alt="image">--}}
                    {{-- <div class="category-type overlay padding-15"><a href="restaurant.html"
                            class="category-btn">Top--}}
                            {{-- rated</a>--}}
                        {{-- </div>--}}
                    {{-- </div>--}}
                {{-- </div>--}}
            {{-- </div>--}}
    </div>
</section>
<!-- Explore collection -->
<!-- footer -->
{{-- <div class="footer-top section-padding bg-black">--}}
    {{-- <div class="container-fluid">--}}
        {{-- <div class="row">--}}
            {{-- <div class="col-md-2 col-sm-4 col-6 mb-sm-20">--}}
                {{-- <div class="icon-box"><span class="text-dark"><i class="flaticon-credit-card-1"></i></span>--}}
                    {{-- <span class="text-custom-white">100% Payment<br>Secured</span>--}}
                    {{-- </div>--}}
                {{-- </div>--}}
            {{-- <div class="col-md-2 col-sm-4 col-6 mb-sm-20">--}}
                {{-- <div class="icon-box"><span class="text-dark"><i class="flaticon-wallet-1"></i></span>--}}
                    {{-- <span class="text-custom-white">Support lots<br> of Payments</span>--}}
                    {{-- </div>--}}
                {{-- </div>--}}
            {{-- <div class="col-md-2 col-sm-4 col-6 mb-sm-20">--}}
                {{-- <div class="icon-box"><span class="text-dark"><i class="flaticon-help"></i></span>--}}
                    {{-- <span class="text-custom-white">24 hours / 7 days<br>Support</span>--}}
                    {{-- </div>--}}
                {{-- </div>--}}
            {{-- <div class="col-md-2 col-sm-4 col-6">--}}
                {{-- <div class="icon-box"><span class="text-dark"><i class="flaticon-truck"></i></span>--}}
                    {{-- <span class="text-custom-white">Free Delivery<br>with $50</span>--}}
                    {{-- </div>--}}
                {{-- </div>--}}
            {{-- <div class="col-md-2 col-sm-4 col-6">--}}
                {{-- <div class="icon-box"><span class="text-dark"><i class="flaticon-guarantee"></i></span>--}}
                    {{-- <span class="text-custom-white">Best Price<br>Guaranteed</span>--}}
                    {{-- </div>--}}
                {{-- </div>--}}
            {{-- <div class="col-md-2 col-sm-4 col-6">--}}
                {{-- <div class="icon-box"><span class="text-dark"><i class="flaticon-app-file-symbol"></i></span>--}}
                    {{-- <span class="text-custom-white">Mobile Apps<br>Ready</span>--}}
                    {{-- </div>--}}
                {{-- </div>--}}
            {{-- </div>--}}
        {{-- </div>--}}
    {{-- </div>--}}

@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.js"></script>
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.js"></script>
<script>

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
        
        var restaurant_for_length = <?php echo json_encode($nearby)?>;
        var restaurant_length = restaurant_for_length.length;
        if(restaurant_length > 24)
        {
            var offset = restaurant_length % 24;
            if(offset > 0) {
                restaurant_length += 24;
            }
            $('.custom-pagination').rpmPagination({
                domElement: '.item-restaurant',
                limit: 24,
                total: restaurant_length,
            })  
        }
        if ("geolocation" in navigator) { //check geolocation available
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
                const dest1 = { lat: latitude, lng: longitude };

                var service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix({
                    origins: [current_addr],
                    destinations: [dest1],
                    travelMode: google.maps.TravelMode.DRIVING,
                }, function (response) {
                    //console.log(response);
                    count++;
                    if (getCookie("first") == "yes") {
                        if (getCookie("mode") == "delivery") {
                            $(item).find("div.product-footer").children().eq(0).text("Estimated Delivery Time: " + response['rows'][0]['elements'][0]['duration']['text'] + " + " + prep_time + "mins");
                        }
                    }
                    else {
                        var temp1 = response['rows'][0]['elements'][0]['duration']['text'];

                        var day1 = 0;
                        var hour1 = 0;
                        var min1 = 0;
                        temp1 = temp1.split(' ');

                        for (var i = 0; i < temp1.length - 1; i++) {
                            if (temp1[i + 1] == 'days' || temp1[i + 1] == 'day')
                                day1 = parseInt(temp1[i]);
                            else if (temp1[i + 1] == 'hours' || temp1[i + 1] == 'hour')
                                hour1 = parseInt(temp1[i]);
                            else if (temp1[i + 1] == 'mins' || temp1[i + 1] == 'min')
                                min1 = parseInt(temp1[i]);
                        }


                        t_min1 = day1 * 24 + hour1 * 60 + min1 + parseInt(prep_time);
                        t_min2 = t_min1 + 10;

                        if (getCookie("mode") == "delivery") {
                            $(item).find("div.product-footer").children().eq(0).text("Estimated Delivery Time: " + t_min1 + " mins" + " ~ " + t_min2 + " mins");
                        }

                    }
                    if (count == lists.length) {
                        mother = $("#restaurant-list");
                        element = mother.children("div.col-lg-4");
                        element.sort(function (a, b) {

                            var temp1 = $(a).find("div.product-footer").children().eq(0).text();
                            var temp2 = $(b).find("div.product-footer").children().eq(0).text();

                            var min1 = 0, min2 = 0;
                            temp1 = temp1.split(' ');
                            temp2 = temp2.split(' ');

                            for (var i = 0; i < temp1.length - 2; i++) {
                                if (temp1[i + 1] == 'mins')
                                    min1 = parseInt(temp1[i]);
                            }

                            for (var i = 0; i < temp2.length - 2; i++) {
                                if (temp1[i + 1] == 'mins')
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
         
        $('.favorite-icon').click(function () {
            if ($(this).hasClass('active')) {
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
                    success: function (result) {

                    },
                    error: function (result) {
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
                    success: function (result) {
                        console.log(result);
                        if (result == 0) {
                            $(this).removeClass('active');
                            location.href = "{{ route('auth.login') }}";
                            return;
                        }

                    },
                    error: function (result) {
                        $(this).removeClass('active');
                    }
                });
            }
        });

    });
</script>
<script>
    var startTime = '';
    var endTime = '';
    var resId = '';
    var das = '';
    var datadays='';
    //var days=[];
    $('.calendar').click(function () {
        resId = $(this).attr('custom1');
        startTime = $(this).attr('customStart');
        endTime = $(this).attr('customEnd');
        days = $(this).attr('customDays');
        //console.log(JSON.parse(days));
        //datadays=JSON.parse(days);
        

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('check.reservation') }}",
            method: "POST",
            data: { date: das, resId: resId },
            success: function (result) {
                console.log(result);
                $('#starttime').html(result)

            }

        })





        console.log(endTime)
        $("#formdiv").html(`<input type="text" id="resId" value=${resId} name="resId" hidden>`)



        $('#date').datetimepicker({

            inline: true,
            maxDate: someFormattedDate,
            format: 'm/d/y g:i A',
            beforeShowDay: my_check,
            timepicker: false,
    
    
    
    
        });
        function my_check(in_date) {
            if(days.length > 0){
            if (jQuery.inArray(in_date.getDay(),JSON.parse(days)) > -1) {
                return [false, "notav", 'Not Available'];
            } else {
                return [true, "av", "available"];
            }
        }
        else{
            return [true, "av", "available"];   
        }
        }


       
        console.log(resId);



        var setMin = function () {

            this.setOptions({
                minTime: '11:00 AM'
            });
        };
        $("#dateModal").modal("show");
    });

    $("#date").on("change", function (e) {
        das = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('check.reservation') }}",
            method: "POST",
            data: { date: das, resId: resId },
            success: function (result) {
                console.log(result);
                $('#starttime').html(result)

            }

        })
        console.log($(this).val());
    });


        $('.pagination').on('click', function() {
            
            // $('.page-link').each(function(e, el) {
            //     var page_no = $(this).attr('data-page_no');
            //     console.log(page_no);
            //     if(page_no != "..." && page_no != "undefined")
            //     {
            //         if($(`.page-${page_no}`).hasClass('disabled'))
            //         {
            //             $('#page_title').text(`Page ${page_no}`);
            //         }
            //     }
            // });
            $("html, body").animate({ scrollTop: 800 }, "fast");
            
        })
   
</script>
<style>
    .header .search-form span.address {
        min-width: 250px;
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