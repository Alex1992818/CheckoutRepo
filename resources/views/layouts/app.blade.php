@extends('layouts.base')
<!-- Navigation -->
@section('body')
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="#">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="#">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="#">
    <link rel="apple-touch-icon-precomposed" href="#">
    <link rel="icon" href="{{asset('public/img/favicon23.png')}}" sizes="16x16 32x32" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://orderchekout.com/css/app.bundle.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    <style type="text/css">
    .left-sidebar{
        /*background:linear-gradient(0deg, rgba(0, 0, 0, 0.9), rgba(0, 0,0, 0.9)), url(sidebar-bg.png);
        background-size: cover;
        background-position: center;*/
        background: #fff;
        max-width: 330px;
        min-height: 100vh;
        padding: 25px 20px;
    }
    .sidebar-menu{
        padding: 0!important;
    }
    .logo-holder{
        max-width: 145px;
        width: 100%;
    }
    .sidebar-logo{
        max-width: 145px;
    }
    .logo-subtext{
        color: white;
        text-align: center;
        font-size: 8px;
        margin-top: 3px;
    }
    .pizzza-img-n{
        max-width: 90px;
    }
    .sidebar-menu .col-md-4 {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    .sidebar-menu .col-md-5{
        -ms-flex: 0 0 41.666667%;
        flex: 0 0 41.666667%;
        max-width: 41.666667%;
    }
    .sidebar-menu .col-md-7{
        -ms-flex: 0 0 58.333333%;
        flex: 0 0 58.333333%;
        max-width: 58.333333%;
        padding-left: 0!important;
        padding-right: 0!important;
    }
    .sidebar-menu .col-md-8 {
        -ms-flex: 0 0 66.666667%;
        flex: 0 0 66.666667%;
        max-width: 66.666667%;
        padding-left: 0!important;
    }
    .menu-links li{
        line-height: 1;
        padding-bottom: 1em;
        padding-left: 1.2em;
    }
    .menu-links a{
      color: #000;
      text-transform: uppercase;
      /*text-shadow: 0px 0px 11px #fd7bbb;*/
      letter-spacing: 0.5px;
      line-height: 1.84;
      font-size: 12px;
      font-weight: 500;
    }
    /*.menu-links a i{
        width: 20px;
        text-shadow: none!important;
        color: #dc278c;
    }*/
    .padd-20{
        margin-bottom: 0;
        padding: 20px 0;
    }
    .menu_mobile_app > button >span, .menu_mobile_app > button >i{
        color: #000000!important;
    }
    .menu_mobile_info > img{
        margin-left: -4px;
    }
    .menu_mobile_info > img, .menu_mobile_app, .menu_top_items > ul > li, .menu_create_items > a{
        margin-left: 0;
    }
    .menu_bottom{
        margin-top: 25px;
    }
    .btn-signin{
        color: #fff!important;
    background-color: #000!important;
    border-color: #000!important;
    width: 100%!important;
    padding-top: 0.8em !important;
    padding-bottom: 0.8em !important;
    }
    .menu-close-icon{
        opacity: 1!important;
    }
    .menu-close-icon span{ 
        color: #000;
        /*text-shadow: 0px 0px 10px #dc278c;*/
    }

    /*@supports (-webkit-text-stroke: 1px #dc278c) {
      .menu-links a{
        -webkit-text-stroke: 1px #dc278c;
      }
      .menu-links i{
        -webkit-text-stroke: 0px #dc278c!important;
      }
    }*/

    .myFlex{
        display: flex;
        margin-top: 1em;
    margin-left: -2em;
    }

    .myFlexL{
        max-width: 10em;
    }
                    
    .myFlexR{
        max-width: 11em;
        margin-left: 0.7em;
    }         
    
    .mat-3{
        padding: 3em;
    }

    .footTop{
        background-color: #000;
        padding: 1.5em 0;
    }

    .copTxt{
        text-align: right;
    }

    .text-light-whiteMin{
        color: #6a6a82;
    }

    .bgFoot{
        background: #ff008e;
        padding: 1em 0 !important;
        text-align: center;
    }

    .orderFootPara{
        padding: 0;
        margin: 0;
        color: #fff;
        font-size: 1.5em;
        font-family: inherit;
        font-weight: bold;
    }

    .orderFootBtn{
        background: #010101;
        border: 0;
        color: #fff;
        font-family: inherit;
        font-weight: bold;
        padding: 0.2em 1.3em;
        margin-left: 0.2em;
        border-radius: 0.4em;
    }

    .orderFootBtn:hover{
        background: #fff !important;
        color: #ff008e !important;
    }

    .myIphoneBg{
        background: #b2b7bb;
    }

    
    .input-icons i { 
        position: absolute; 
    } 
      
    .input-icons { 
        width: 100%; 
    } 
      
    .icon-search { 
        padding: 10px; 
        min-width: 40px; 
        margin-top: 4px;
    } 
      
    .input-field { 
        width: 100%; 
        padding-left: 30px; 
    } 
    
    
    @media only screen and (min-width: 820px){
        #responsive{
            margin-left: -8em !important;
        }
    }

    * {
        box-sizing: border-box;
      }
      
      #myInput {
        background-image: url('/css/searchicon.png');
        background-position: 10px 12px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
      }
      
      #myUL {
        list-style-type: none;
        padding: 0;
        margin: 0;
      }
      
      #myUL li a {
        border: 1px solid #ddd;
        margin-top: -1px; /* Prevent double borders */
        background-color: #f6f6f6;
        padding: 12px;
        text-decoration: none;
        font-size: 18px;
        color: black;
        display: block
      }
      
      #myUL li a:hover:not(.header) {
        background-color: #eee;
      }
  </style>
 
        <!-- Navigation -->
    <div class="container-fluid pl-0 pr-0">
        <div class="bs-canvas bs-canvas-left position-fixed bg-light h-100">
            {{--  <header class="bs-canvas-header p-3 bg-white">
                <a href="#">
                    <img src="{{ asset('img/logo.png') }}" class="img-fluid" alt="Logo">
                </a>
                <button type="button" class="bs-canvas-close close" aria-label="Close"><span aria-hidden="true" class="text-dark">&times;</span></button>
            </header>  --}}
           
            <div >
                <input type="hidden" id="current_lat" value="">
                        <input type="hidden" id="current_lng" value="">
                        <div class="left-sidebar">
                            <div style="float: right;">
                                <button type="button" class="bs-canvas-close close menu-close-icon" aria-label="Close"><span aria-hidden="true">×</span></button>
                            </div>
                            <div class="logo-holder">
                                <a href="#"><img src="{{asset('public/img/logo.png')}}" class="sidebar-logo"></a>
                                <h6 class="logo-subtext"><i>Chek(us)out. We deliver</i></h6>
                            </div>
                            <div class="container-fluid sidebar-menu">

                                <div class="text-center">
                                    @if(isset($user))
                                    <form action="{{ route('auth.logout') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary btn-signin">Sign Out</button>
                                    </form>
                                    @else
                                    <a href="{{ route('auth.login') }}"><button  class="btn btn-primary btn-signin">Sign In</button></a>
                                    @endif
                                </div>



                                <div class="row">
                                    {{-- <div class="col-md-5">
                                        <img src="{{asset('public/img/pizza.png')}}" class="pizzza-img-n">
                                    </div> --}}
                                    <div class="col-md-12 menu-links my-4">
                                        <ul>
                                            @if(isset($user))

                                            <li>
                                                <a href="{{ route('landing') }}" class="menu-item5">Home</a>
                                            </li>

                                            <li>
                                                <a href="https://www.orderchekoutblog.com/" class="menu-item4">Blog</a>
                                            </li>
                                         
                                            <li>
                                                <a href="{{ route('app.about') }}" class="menu-item5">About Us</a>
                                            </li>
                                            
                                            {{-- <li>
                                                <a href="{{ route('app.covid-19') }}" class="menu-item3"><i class="fa fa-users"></i>  Covid-19 Safety</a>
                                            </li> --}}
                                            <!--<li>-->
                                            <!--    <a href="{{ route('app.membership') }}" class="menu-item7"><i class="fa fa-question-circle"></i> Membership Page</a>-->
                                            <!--</li>-->
                                            <!--<li>-->
                                            <!--    <a href="{{ route('app.our-team') }}" class="menu-item6"><i class="fa fa-ravelry"></i> Meet The Chekout Team</a>-->
                                            <!--</li>-->
                                            <li>
                                                <a href="{{ route('app.why-choose-us') }}" class="menu-item6">Why Choose Chekout</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('app.mobileapp') }}" class="menu-item6">Chekout our app</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('app.restaurant.add') }}" class="menu-item6">Add Your Restaurant</a>
                                            </li>
                                            <!--<li>-->
                                            <!--    <a href="{{ route('app.membership') }}" class="menu-item7"><i class="fa fa-question-circle"></i> Membership Page</a>-->
                                            <!--</li>-->
                                            <!--<li>-->
                                            <!--    <a href="{{ route('app.our-team') }}" class="menu-item6"><i class="fa fa-cart-ravelry"></i> Meet The Chekout Team</a>-->
                                            <!--</li>-->
                                            @else
                                            <li>
                                                <a href="{{ route('landing') }}" class="menu-item5">Home</a>
                                            </li> 
                                            
                                            <li>
                                                <a href="https://www.orderchekoutblog.com/" class="menu-item4">Blog</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('app.about') }}" class="menu-item5">About Us</a>
                                            </li>
                                            
                                            {{-- <li>
                                                <a href="{{ route('app.covid-19') }}" class="menu-item3"><i class="fa fa-users"></i>  Covid-19 Safety</a>
                                            </li> --}}
                                            <!--<li>-->
                                            <!--    <a href="{{ route('app.membership') }}" class="menu-item7"><i class="fa fa-question-circle"></i> Membership Page</a>-->
                                            <!--</li>-->
                                            <!--<li>-->
                                            <!--    <a href="{{ route('app.our-team') }}" class="menu-item6"><i class="fa fa-ravelry"></i> Meet The Chekout Team</a>-->
                                            <!--</li>-->
                                            <li>
                                                <a href="{{ route('app.why-choose-us') }}" class="menu-item6">Why Choose Chekout</a>
                                            </li>

                                            <li>
                                                <a href="{{ route('app.mobileapp') }}" class="menu-item6">Chekout our app</a>
                                            </li>    

                                            <li>
                                                <a href="{{ route('app.restaurant.add') }}" class="menu-item6">Add Your Restaurant</a>
                                            </li>
                                            @endif
                                            
                                        </ul>
                                    </div>
                                </div>
                              
                                <div class="menu_bottom mt-5">
                                    <div class="menu_mobile_info">
                                        <img src="https://orderchekout.com/img/app-icon.png" class="img-fluid" alt="Logo">
                                        <p style="color: #000;">There's more to love in <br>the app.</p>
                                    </div>
                                    <div class="menu_mobile_app">
                                        <button class="myIphoneBg" onclick="window.open('https://apps.apple.com/us/app/order-chekout/id1540173746','');"><i class="fa fa-apple"></i><span>iPhone<span></span></span></button>
                                        <button class="myIphoneBg" onclick="window.open('https://play.google.com/store/apps/details?id=com.orderchekout.vendor.android','');"><i class="fa fa-android"></i><span>Android<span></span></span></button>
                                    </div>
                                </div>
                                <div class="menu_bottom mt-5">
                                    <div class="menu_top_items">
                                        <ul>
                                            <li>
                                                <div class="menu_top_item">
                                                    <i class="fa fa-question-circle text-black"></i>
                                                    <a href="{{route('app.user.help')}}" class="text-black"><span id="show_help">Help</span></a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="menu_create_items">
                                        <a><span style="font-size:14px; color:black;">Concierge Service: &nbsp;855-535-0404</span></a>
                                        <a><span style="font-size:14px; color:black;">Service Available: &nbsp;5:00 AM to Midnight</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
             
            </div>
        </div>

        <main>
            <div class="header">
                <header class="full-width">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12 mainNavCol">
                                <!-- logo -->
                                <div class="logo mainNavCol">
                                    <button class="navbar-toggler pull-bs-canvas-left" type="button" data-target="#sidebar" data-toggle="collapse"><i class="fas fa-bars"></i></button>
                                    <a href="#" id="gohome">
                                        <img src="{{ asset('img/logo.png') }}" class="img-fluid" alt="Logo">
                                    </a>
                                </div>
                                <!-- logo -->
                                <div class="main-search mainNavCol">
                                    <!--change-->
                                    <div class="main-search search-form full-width">
                                        <div class="row">
                                            <!-- location picker -->
                                            <div class="col-lg-5 col-md-5 ml-4">
                                                <a href="#" class="delivery-add p-relative"> <span class="icon"><i
                                                            class="fas fa-map-marker-alt"></i></span>
                                                    <span class="address">Enter your address</span>
                                                </a>
                                                <div class="location-picker">
                                                    <input type="text" class="form-control" placeholder="Enter a new address" id="searchInput" autocomplete="false" >
                                                </div>
                                            </div>
                                            
                                            <div class="col-lg-5 col-md-5 ml-4">
                                                <div style="display: flex; justify-content: space-between">
                                                    <div>
                                                        <a href="#" class="delivery-mode p-relative" id="delivery-mode">
                                                            <span class="icon">
                                                                <!--<i class="fas fa-pizza-slice"></i>-->
                                                                <!--<img style="height: 40px; width: 50px; display: block; " src="{{asset('public/img/newcart.jpeg')}}" class="icon">-->
                                                                <img style="height: 40px; width: 40px; display: block; " src="{{asset('public/img/takeout-new.png')}}" class="icon">
                                                                </span>
                                                            <span class="method" >TakeOut</span>
                                                        </a>
                                                        <div class="mode-picker" style="flex-direction:column;">
                                                            <a class="mode-item mode-selected" id="mode-takeout" style="margin-top:5px; width:80%; height:30px; background-color:#fff;color:black;display:flex; flex-direction:row; align-items:center; cursor:pointer">
                                                                <!--<i class="fas fa-pizza-slice" style="margin-right:15px"></i>-->
                                                                <!--<img style="height: 35px; width: 35px; display: block; margin-right:15px; margin-left: -16px; " src="{{asset('public/img/newcart.jpeg')}}" class="icon">-->
                                                                <img style="height: 35px; width: 35px; display: block; margin-right:15px; margin-left: -16px; " src="{{asset('public/img/takeout-new.png')}}" class="icon">
                                                                TakeOut</a>
                                                            <a class="mode-item" id="mode-delivery" style="width:80%; height:30px; background-color:#fff;color:black;display:flex; flex-direction:row; align-items:center; cursor:pointer">
                                                                <!--<i class="fas fa-truck" style="margin-right:15px"></i>-->
                                                                <img style="height: 35px; width: 35px; display: block; margin-right:15px; margin-left: -16px;" src="{{asset('public/img/delivery-new.png')}}" class="icon">
                                                                Delivery</a>
                                                                <!--<a class="mode-item" id="mode-reservation" style="width:80%; height:30px; background-color:#fff;color:black;display:flex; flex-direction:row; align-items:center; cursor:pointer">-->
                                                                    <!--<i class="fas fa-truck" style="margin-right:15px"></i>-->
                                                                <!--    <img style="height: 35px; width: 35px; display: block; margin-right:15px; margin-left: -16px;" src="{{asset('public/img/calendar-icon1.png')}}" class="icon">-->
                                                                <!--    Schedule</a>-->
                                                        </div>
                                                    </div>
                                                 {{--  <div style="margin:auto 0; display: flex">
                                                    
                                                            <div style="display: flex">
                                                                <div class="input-icons" > 
                                                                    <i class="fa fa-search icon-search"></i> 
                                                                    <input type="text" class="form-control input-field" id="myInput" onkeyup="myFunction()" placeholder="Find Food.." title="Type in a name">
                                                                </div>
                                                                <ul id="myUL" style="
                                                                position: absolute;
                                                                margin-top: 44px;
                                                                width: 264px;
                                                            ">
                                                                    <li><a href="#">Adele</a></li>
                                                                   
                                                                  </ul>
                                                                  
                                                                 
                                                              
                                                            </div>
                                                      
                                                    </div>  --}}
                                                </div>
                                            </div>
                                            
                                            <!-- location picker -->
                                            <!-- search -->
                                            {{--<div class="col-lg-5 col-md-5">
                                                <div class="dropdown search-box">
                                                    <input type="text" class="form-control"
                                                           placeholder="Pizza, Burger, Chinese" id="search-box"
                                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink"
                                                         id="search-list" style="border-radius: 0;">
                                                        <a class="dropdown-item" href="http://google.com">Action</a>
                                                        <a class="dropdown-item" href="#">Another action</a>
                                                        <a class="dropdown-item" href="#">Something else here</a>
                                                    </div>
                                                </div>
                                            </div>--}}
                                            <!-- search -->
                                        </div>
                                    </div>
                                </div>
                                <div class="right-side fw-700 mainNavCol">
                                {{--                            <div class="gem-points">--}}
                                {{--                                <a href="#"> <i class="fas fa-concierge-bell"></i>--}}
                                {{--                                    <span>Order Now</span>--}}
                                {{--                                </a>--}}
                                {{--                            </div>--}}
                                <!-- mobile search -->
                                    <div class="mobile-search">
                                        <a href="#" data-toggle="modal" data-target="#search-box"> <i class="fas fa-search"></i>
                                        </a>
                                    </div>
                                    <!-- mobile search -->
                                    <!-- user account -->
                                    @if(isset($user))
                                        <div class="user-details p-relative">
                                            <a href="#" class="text-light-white fw-500">
                                                <img src="{{ asset('img/account.png') }}" alt="Logo" style="width:35px;">
                                                <span>Hi, {{ $user['firstName'] }}</span>
                                            </a>
                                            <div class="user-dropdown">
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('app.user.account.show') }}" class="text-center">
                                                            <img src="{{ asset('img/account.png') }}" alt="Logo" style="width:35px;">
                                                            <span class="details">Account</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('app.user.wallet.show') }}" class="text-center">
                                                            <img src="{{ asset('img/wallet.png') }}" style="height:35px" alt="userimg">
                                                            <span class="details">Wallet</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('app.user.favorite.show') }}" class="text-center">
                                                            <img src="{{ asset('img/addfavorite.png') }}" style="height:35px" alt="userimg">
                                                            <span class="details">Favorite</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('app.user.orders.past') }}" class="text-center">
                                                            <img src="{{ asset('img/history.png') }}" style="height:35px" alt="userimg">
                                                            <span class="details">History</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="user-footer"><span class="text-light-black">Not {{ $user['firstName'] }}?</span>
                                                    <form action="{{ route('auth.logout') }}" method="POST">
                                                        @csrf
                                                        <button class="text-orange">Sign Out</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="gem-points">
                                            <a href="{{ route('auth.login') }}"> <img style="height: 50px; width: 50px; display: block; " src="{{asset('public/img/logo.jpeg')}}" class="icon">
                                                <span>Sign In</span>
                                            </a>
                                        </div>
                                @endif
                                <!-- mobile search -->
                                    <!-- user notification -->
                                    {{--
                                    <div class="cart-btn notification-btn">
                                        <a href="#" class="text-dark fw-700"> <i class="fas fa-bell"></i>
                                            <span class="user-alert-notification"></span>
                                        </a>
                                        <div class="notification-dropdown">
                                            @if(isset($notifications) && $notifications->count() > 0)
                                                @foreach($notifications as $notification)
                                                    <div class="item">
                                                        <div class="product-detail">
                                                            <a href="#">
                                                                <div class="img-box">
                                                                    <img src="https://via.placeholder.com/50x50" class="rounded"
                                                                         alt="image">
                                                                </div>
                                                                <div class="product-about">
                                                                    <p class="text-light-black">Lil Johnny’s</p>
                                                                    <p class="text-light-white">Spicy Maxican Grill</p>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="rating-box">
                                                            <p class="text-light-black">How was your last order ?.</p> <span
                                                                class="text-dark-white"><i class="fas fa-star"></i></span>
                                                            <span class="text-dark-white"><i class="fas fa-star"></i></span>
                                                            <span class="text-dark-white"><i class="fas fa-star"></i></span>
                                                            <span class="text-dark-white"><i class="fas fa-star"></i></span>
                                                            <span class="text-dark-white"><i class="fas fa-star"></i></span>
                                                            <cite class="text-light-white">Ordered 2 days ago</cite>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="item mt-3">
                                                    <div class="product-detail">
                                                        <div class="alert">
                                                            No new notifications.
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>--}}
                                    <!-- user notification -->
                                    <!-- user cart -->
                                    <div class="cart-btn cart-dropdown">
                                        <a href="#" class="text-dark fw-700">
                                            <img src="{{ asset('public/img/cart-new.png') }}" style="height: 30px" alt="">
                                            
                                            <span class="user-alert-cart">0</span>
                                        </a>
                                        <div class="cart-detail-box">
                                            <div class="card">
                                                <div class="card-header padding-15">{{ $cart->vendor_name ?? 'Your orders' }}</div>
                                                <div class="card-body no-padding">
                                                    <input type='hidden' id='vendorId' value=''>
                                                    <div class="item-total border-top">
                                                        <div class="padding-15 d-flex justify-content-between">
                                                            <div>
                                                                <span class="fw-700">Total:</span>
                                                                <span class="fw-700 total-price">$0</span>
                                                            </div>
                                                            <div>
                                                                <a href="#" class="text-danger" onclick="emptyCart(true)">Empty cart</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <h6 class="text-dark-white text-center my-4 no-items">No order</h6>
                                                </div>
                                                <div class="card-footer">
                                                    <a href="{{ route('app.checkout.index')}}" class="btn btn-block btn-add-cart">
                                                        Checkout
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- user cart -->
                                </div>
                            </div>
                            <div class="col-sm-12 mobile-search">
                                <div class="mobile-address">
                                    <a href="#" class="delivery-add" data-toggle="modal" data-target="#address-box"> <span
                                            class="address">Brooklyn, NY</span>
                                    </a>
                                </div>
                                <div class="sorting-addressbox"><span
                                        class="full-address text-dark">Brooklyn, NY 10041</span>
                                    <div class="btns">
                                        <div class="filter-btn">
                                            <button type="button"><i class="fas fa-sliders-h text-dark fs-18"></i>
                                            </button>
                                            <span class="text-dark">Sort</span>
                                        </div>
                                        <div class="filter-btn">
                                            <button type="button"><i class="fas fa-filter text-dark fs-18"></i>
                                            </button>
                                            <span class="text-dark">Filter</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>
            </div>
            <div class="main-sec"></div>
            @yield('content')
        </main>
    <!-- modal boxes -->
        <div class="modal fade" id="address-box">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title fw-700">Change Address</h4>
                    </div>
                    <div class="modal-body">
                        <div class="location-picker">
                            <input type="text" class="form-control" placeholder="Enter a new address">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="change-mode-asking" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content bg-white">
                    <div class="modal-header border-0 pb-0 justify-content-end">
                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="flex-shrink: 0;"><path d="M17.2929 18.7071C17.6834 19.0976 18.3166 19.0976 18.7071 18.7071C19.0976 18.3166 19.0976 17.6834 18.7071 17.2929L13.4142 12L18.7071 6.70711C19.0976 6.31658 19.0976 5.68342 18.7071 5.29289C18.3166 4.90237 17.6834 4.90237 17.2929 5.29289L12 10.5858L6.70711 5.29289C6.31658 4.90237 5.68342 4.90237 5.29289 5.29289C4.90237 5.68342 4.90237 6.31658 5.29289 6.70711L10.5858 12L5.29289 17.2929C4.90237 17.6834 4.90237 18.3166 5.29289 18.7071C5.68342 19.0976 6.31658 19.0976 6.70711 18.7071L12 13.4142L17.2929 18.7071Z" fill="#494949"></path></svg>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-center">Sorry, this item is temporarily unavailable</h5>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <!-- <button class="btn btn-danger cancel">Cancel</button> -->
                        <button class="btn btn-danger emptyCart col-6">Empty Cart</button>
                        <button class="btn btn-success checkOut col-6">Checkout</button>
                    </div>
                </div>
            </div>
        </div>

<div>

    @yield('footer')
    </div>
    <div class="container-fluid" style="background-color: #000;">
        <footer class="page-footer font-small unique-color-dark" >
        
          <div class="container-footer" style="height:185px">
            <!-- Footer Links -->
          <div class="container text-white text-center text-md-left mt-5">
        
            <!-- Grid row -->
            <div class="row mt-3 mat-3" style="
            height: 290px;
        ">
        
              <!-- Grid column -->
              <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4" >
        
                <!-- Content -->
                <h6 class="text-uppercase font-weight-bold mt-0 mb-0" style="color:#fff;">Get to Know Us</h6>
                {{-- <hr class="accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;"><br> --}}
                <a href="http:orderchekout.com/about-us" style="text-decoration:none;color:white;">About us</a><br>
                <a href="http:orderchekoutblog.com" style="text-decoration:none;color:white;">Our Blog</a><br>
                <a href="http:orderchekout.com/why-choose-us" style="text-decoration:none;color:white;">Why Chekout</a><br>
                {{-- <a href="#" style="text-decoration:none;color:white;">The Chekout Team</a><br> --}}
        
              </div>
              <!-- Grid column -->
        
              <!-- Grid column -->
              <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4" >
        
                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold mt-0 mb-0" style="color:#fff;">Helpful Links</h6>
                {{-- <hr class="accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;"><br> --}}
                <a href="{{route('app.user.help')}}" style="text-decoration:none;color:white;">Help</a><br>
                <!--<a href="#" style="text-decoration:none;color:white;">Current Promotions</a><br>-->
                {{-- <a href="#" style="text-decoration:none;color:white;">FAQ</a><br>
                <a href="#" style="text-decoration:none;color:white;">Memberships</a><br>
                <!--<a href="#" style="text-decoration:none;color:white;">Current Promotions</a><br>-->
                <a href="#" style="text-decoration:none;color:white;">Media inquires</a><br> --}}
        
                
              </div>
              <!-- Grid column -->
        
              <!-- Grid column -->
              <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4" >
        
                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold mt-0 mb-0" style="color:#fff;">Follow Us</h6>
                 {{-- <hr class="accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;"><br> --}}
                <a target="_blank" href="https://www.facebook.com/ordercheckout" style="text-decoration:none;color:white;">Facebook</a><br>
                <a target="_blank"  href="https://www.twitter.com/orderchekout" style="text-decoration:none;color:white;">Twitter</a><br>
                <a target="_blank" href="https://www.instagram.com/order_chekout?igshid=slx4i5q94rt2" style="text-decoration:none;color:white;">Instagram</a><br>
                <!--<a target="_blank" href="#" style="text-decoration:none;color:white;">Linkedin</a><br>-->
        
              </div>
              <!-- Grid column -->
        
              <!-- Grid column -->
              <div class="col-md-6 col-lg-4 col-xl-4 " >
        
                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold mt-0 mb-0" style="color:#fff;">Join Chekout</h6>
                {{-- <hr class="accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;"><br> --}}
                <a href="{{ route('auth.login') }}" style="text-decoration:none;color:white;">Sign Up/In</a><br>
                <a href="{{ route('app.restaurant.add') }}" style="text-decoration:none;color:white;">Add Restaurant</a><br>
               
                  <div class="myFlex"> 
                  <a href="javascript:void(0)" style="margin-top: 5px;" onclick="window.open('https://apps.apple.com/us/app/order-chekout/id1540173746','');"> 
                    <img src="{{asset('public/img/thoo.png')}}" class="myFlexL" alt="" >
                    </a> 
                   
                    <a href="#" style="margin-top: 5px;">
                        <img src="{{asset('public/img/rts.jpg')}}" class="myFlexR" alt="kjkjjk" >
                    </a> 
                </div>  
                
                <!-- Grid column -->
                <div class="col-lg-8 text-center text-md-right">
        
                  <!-- Facebook -->
                 
        
                </div>
                <!-- Grid column -->
              </div>
              <!-- Grid column -->
        
            </div>
            <!-- Grid row -->
        
          </div>
          <!-- Footer Links -->
        </footer>
        </div>
        <div class="footTop">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="payment-logo mb-md-20">
                            {{-- <div class="payemt-icon">
                                <img src="{{ asset('img/cards/visa.jpg') }}" alt="#">
                                <img src="{{ asset('img/cards/mastercard.png') }}" alt="#">
                                <img src="{{ asset('img/cards/card-front.jpg') }}" alt="#">
                                <img src="{{ asset('img/cards/amex-card-front.png') }}" alt="#">
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-4 text-center medewithlove align-self-center">
                        {{-- <a href="http://orderchekout.com" class="text-custom-white"><img src="{{ asset('img/logo.png') }}"
                                                                                           alt="chekout logo"></a> --}}
                    </div>
                    <div class="col-lg-4">
                        <div class="copyright-text copTxt"><span class="text-light-whiteMin">© <a href="#" class="text-light-whiteMin">Chekout</a> - 2020 | All Rights Reserved</span>
                        </div>
                    </div>
                </div>
            </div>
    </div>
        <!--<div class="copyright bgFoot">-->
        <!--    {{-- <div class="container-fluid">-->
        <!--        <div class="row">-->
        <!--            <div class="col-lg-4">-->
        <!--                <div class="payment-logo mb-md-20">-->
        <!--                    <div class="payemt-icon">-->
        <!--                        <img src="{{ asset('img/cards/visa.jpg') }}" alt="#">-->
        <!--                        <img src="{{ asset('img/cards/mastercard.png') }}" alt="#">-->
        <!--                        <img src="{{ asset('img/cards/card-front.jpg') }}" alt="#">-->
        <!--                        <img src="{{ asset('img/cards/amex-card-front.png') }}" alt="#">-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--            <div class="col-lg-4 text-center medewithlove align-self-center">-->
        <!--                <a href="http://orderchekout.com" class="text-custom-white"><img src="{{ asset('img/logo.png') }}"-->
        <!--                                                                                   alt="chekout logo"></a>-->
        <!--            </div>-->
        <!--            <div class="col-lg-4">-->
        <!--                <div class="copyright-text"><span class="text-light-white">© <a href="#" class="text-light-white">Chekout</a> - 2020 | All Rights Reserved</span>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div> --}}-->
            
                <!--<p class="orderFootPara">Free Delivery For Entire Month Of January!! <a href="{{route('landing')}}" class="orderFootBtn">Order Now</a></p>-->
            
        </div>
    </div>
    <!-- Modal -->
<div class="modal fade" id="dateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="display: table;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Reservation Date</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <label for="">Choose date</label>
          <form id="formtr" action="{{route('home.reservation')}}">
            
        <input name="date" id="date"/>
        <br>

        <div class="container">
            <label for="">Choose time</label>
            <select class="form-control" id="starttime" name="book_time" style="height: 50px;" required>

            </select>
        </div>
        <br>
        <span>TakeOut:<input type="checkbox" class="py-2" style="width: 7%" name="progress" id="progress1" value="0" tabIndex="1" onClick="ckChange(this)" @if ( Session::get('mode') == 'takeout')
         checked
        @endif  @if ( Session::get('mode') == 'delivery') disabled @endif ></span>
        <span>Delivery:<input type="checkbox" class="py-2" style="width: 7%" name="progress" id="progress2" value="1" tabIndex="1" onClick="ckChange(this)" @if ( Session::get('mode') == 'delivery')
           checked
           @endif  @if ( Session::get('mode') == 'takeout') disabled @endif ></span>
        <div id="formdiv">
        
        </div>
       
        <br>
        <button class="btn btn-success" type="submit">Schedule</button>
    </form>
      </input>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> --}}
    </div>
  </div>
</div>
</div>
<div class="modal fade" id="address-set-modal" tabindex="-1" role="dialog" data-backdrop="static" aria-labelledby="pleaseInputYourAddress" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Please input your address</h5>
      </div>
      <div class="modal-body">
        <input id="address-set-input" class="form-control" placeholder="Enter a new address" autocomplete="off">
      </div>
    </div>
  </div>
</div>

    @include('app.user.help')
@endsection

@push('scripts')
<script>
    function myFunction() {
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value;

        $.ajaxSetup({headers:
            {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });
           
            $.ajax({
            url:"{{ route('fetch.restaurants') }}",
            method:"GET",
            data:{filter:filter},
            success: function(result){
            //$('#tl-'+dt+'').html(result);
            }
            });

        ul = document.getElementById("myUL");
        li = ul.getElementsByTagName("li");
        for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
    </script>
    <script>
        var lat = '';
        var lng = '';
        $(document).ready(function () {

            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/5fc852b9920fc91564ccf353/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
            
            var mode = "{{ Session::get('mode')}}";
            var selectedday="{{ Session::get('selectedday')}}";

            var onPage="{{$onPage ?? false}}";
            console.log(selectedday);
            // if(mode == "reservation" && onPage=='' && selectedday==''){
            //     $("#dateModal").modal("show");
            // }
            if(mode == "takeout"){
                setCookie("mode","takeout", 365);
            
                $("#gohome").attr("href","{{route('home')}}");
            }
            if(mode == "reservation"){
                $("#delivery-mode").children().eq(0).children().eq(0).toggleClass("fa-pizza-slice").attr('src', '{{asset('public/img/takeout-new.png')}}');;
                $("#delivery-mode").children().eq(0).children().eq(0).toggleClass("fa-truck").attr('src', '{{asset('public/img/calendar-icon1.png')}}');
                $("#delivery-mode").children().eq(1).text("Schedule");
            
                $("#mode-takeout").toggleClass("mode-selected");
                $("#mode-reservation").toggleClass("mode-selected");
                var loc = getCookie("curloc");
               setCookie("mode","reservation", 365);
                  if(loc == "") return;
                  var location = JSON.parse(loc);
                 lat = location.lat;
                 lng = location.lng;
                console.log(location);
                console.log(lat);
                console.log(lng);
                var url = "{{route('home.reservation',['lat'=>'latv','lng' =>'lngv'])}}";
              url = url.replace('latv', lat);
              url = url.replace('lngv', lng);
              $("#gohome").attr("href",url);
            }
            if(mode == "delivery"){
                $("#delivery-mode").children().eq(0).children().eq(0).toggleClass("fa-pizza-slice").attr('src', '{{asset('public/img/takeout-new.png')}}');;
                $("#delivery-mode").children().eq(0).children().eq(0).toggleClass("fa-truck").attr('src', '{{asset('public/img/delivery-new.png')}}');
                $("#delivery-mode").children().eq(1).text("Delivery");
                $("#mode-delivery").toggleClass("mode-selected");
                $("#mode-takeout").toggleClass("mode-selected");
                var loc = getCookie("curloc");
                setCookie("mode","delivery", 365);
                if(loc == "") return;
                var location = JSON.parse(loc);
                var lat = location.lat;
                var lng = location.lng;
                console.log(location);
                console.log(lat);
                console.log(lng);
                var url = "{{route('home.delivery',['lat'=>'latv','lng' =>'lngv'])}}";
                url = url.replace('latv', lat);
                url = url.replace('lngv', lng);
                $("#gohome").attr("href",url);
            }
            else{
                $("#gohome").attr("href","{{route('home')}}");
            }
            
           
            $(".delivery-mode").click(function () {
                $(".mode-picker").toggleClass("open");
                $(".delivery-mode").toggleClass("open");
            });
            
            $("#mode-delivery").click(function () {
                
                if(mode == 'delivery') return;
                var loc = getCookie("curloc");
                if(loc == "") return;
                if(checkEmptyCart()){
                    changeToDeliveryMode();
                } else {
                    $("#change-mode-asking .text-center").text("You are changing to delivery mode and have items in your cart. Do you want to checkout or clear cart?");
                    $("#change-mode-asking").modal("show");
                    $("#change-mode-asking").on('click', '.emptyCart', function(){
                        $("#change-mode-asking").modal("hide");
                        var vendorId = $("#vendorId").val();
                        console.log(vendorId);
                     
                        var location = JSON.parse(loc);
                        lat = location.lat;
                        lng = location.lng;
                        console.log(location);
                        console.log(lat);
                        console.log(lng);
                        var url = "{{route('home.delivery',['lat'=>'latv','lng' =>'lngv'])}}";
                        url = url.replace('latv', lat);
                        url = url.replace('lngv', lng);
                        emptyCart();
                        console.log(emptyCart());

                        setTimeout(function(){ 
                              window.location.href =url;
                           
                         }, 1000);
                     
                       
                      
                    });
                    $("#change-mode-asking").on('click', '.checkOut', function(){
                        $("#change-mode-asking").modal("hide");
                        window.location.href = "{{route('app.checkout.index')}}";
                    });
                }

              
            });
            
            $("#mode-reservation").click(function () {
                
                if(mode == 'reservation') return;
                var loc = getCookie("curloc");
                if(loc == "") return;
                if(checkEmptyCart()){
                    changeToReservationMode();
                } else {
                    $("#change-mode-asking .text-center").text("You are changing to delivery mode and have items in your cart. Do you want to checkout or clear cart?");
                    $("#change-mode-asking").modal("show");
                    $("#change-mode-asking").on('click', '.emptyCart', function(){
                        $("#change-mode-asking").modal("hide");
                  
                        var vendorId = $("#vendorId").val();
                        console.log(vendorId);
                        emptyCart();
                        console.log(emptyCart());


                        setTimeout(function(){ 
                            window.location.href = "{{route('home.reservation')}}";
                         
                       }, 1000);
                       
                       
                        
                    });
                    $("#change-mode-asking").on('click', '.checkOut', function(){
                        $("#change-mode-asking").modal("hide");
                        window.location.href = "{{route('app.checkout.index')}}";
                    });
                }

              
            });

            $("#mode-takeout").click(function () {
                if(mode == 'takeout') return;
                changeToTakeOutMode();
                return;
                
                // if(checkEmptyCart()){
                   
                // } else {
                //     $("#change-mode-asking .text-center").text("You are changing to TakeOut mode and have items in your cart. Do you want to: button for checkout or button for clear cart?");
                //     $("#change-mode-asking").modal("show");
                //     $("#change-mode-asking").on('click', '.ok', function(){
                //         $("#change-mode-asking").modal("hide");
                //     });
                // }
            });

            const changeToDeliveryMode = () => {
                $(".mode-picker").removeClass("open");
                $(".delivery-mode").removeClass("open");
                $("#delivery-mode").children().eq(0).children().eq(0).toggleClass("fa-pizza-slice").attr('src', '{{asset('public/img/takeout-new.png')}}');
                $("#delivery-mode").children().eq(0).children().eq(0).toggleClass("fa-truck").attr('src', '{{asset('public/img/delivery-new.png')}}');
                $("#delivery-mode").children().eq(1).text("Delivery");
                $(this).toggleClass("mode-selected");
                $("#mode-takeout").toggleClass("mode-selected");
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
            }
            const changeToReservationMode = () => {
                $(".mode-picker").toggleClass("open");
                $(".delivery-mode").toggleClass("open");
                
                $("#delivery-mode").children().eq(0).children().eq(0).toggleClass("fa-pizza-slice").attr('src', '{{asset('public/img/takeout-new.png')}}');
                $("#delivery-mode").children().eq(0).children().eq(0).toggleClass("fa-truck").attr('src', '{{asset('public/img/calendar-icon1.png')}}');
                $("#delivery-mode").children().eq(1).text("Schedule");
                $(this).toggleClass("mode-selected");
                $("#mode-reservation").toggleClass("mode-selected");
              
              
                var location = JSON.parse(loc);
                var lat = location.lat;
                var lng = location.lng;
                console.log(location);
                console.log(lat);
                console.log(lng);
                var url = "{{route('home.reservation',['lat'=>'latv','lng' =>'lngv'])}}";
                url = url.replace('latv', lat);
                url = url.replace('lngv', lng);
                $("#gohome").attr("href",url);
                setCookie("mode","reservation",365);
                window.location.href = url;
            }

            const changeToTakeOutMode = () => {
                $(".mode-picker").toggleClass("open");
                $(".delivery-mode").toggleClass("open");
                
                $("#delivery-mode").children().eq(0).children().eq(0).toggleClass("fa-truck").attr('src', '{{asset('public/img/delivery-new.png')}}');
                $("#delivery-mode").children().eq(0).children().eq(0).toggleClass("fa-pizza-slice").attr('src', '{{asset('public/img/takeout-new.png')}}');
                $("#delivery-mode").children().eq(1).text("TakeOut");
                $(this).toggleClass("mode-selected");
                $("#mode-delivery").toggleClass("mode-selected");
                $("#gohome").attr("href","{{route('home')}}");
                setCookie("mode","takeout",365);
                window.location.href = "{{route('home')}}";
            }
            

            function checkEmptyCart(){
                var statusOfCart = $(".cart-detail-box .card .card-body .item-total").attr('class');
                if(statusOfCart.includes('d-none')){
                    return true;
                } else {
                    return false;
                }
            }


            
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

            $(document).on('click', '.pull-bs-canvas-right, .pull-bs-canvas-left', function(){
                $('body').prepend('<div class="bs-canvas-overlay bg-dark position-fixed w-100 h-100"></div>');
                if($(this).hasClass('pull-bs-canvas-right'))
                    $('.bs-canvas-right').addClass('mr-0');
                else
                    $('.bs-canvas-left').addClass('ml-0');
                return false;
            });

            // $(".menu_top_item").on("click", "#show_help", function() {
            //     var elm = $('.bs-canvas');
            //     elm.removeClass('mr-0 ml-0');
            //     $('.bs-canvas-overlay').remove();
            //     var options = {
            //         'backdrop': 'static'
            //     };

            //     $('#help-modal').modal(options)
            // });

            $(document).on('click', '.bs-canvas-close, .bs-canvas-overlay', function(){
                var elm = $(this).hasClass('bs-canvas-close') ? $(this).closest('.bs-canvas') : $('.bs-canvas');
                elm.removeClass('mr-0 ml-0');
                $('.bs-canvas-overlay').remove();
                return false;
            });
            $('#search-box').on('keyup', debounce(function () {
                if ($('#search-box').val() == '') {
                    $('#search-list').dropdown('hide');
                }
                $.post('/searchbox', {
                        _token: '{{ csrf_token() }}',
                        searchTerm: $('#search-box').val(),
                    }, "json"
                )
                    .done(function (data) {
                        console.log(data);
                        if (data.length > 0) {
                            data.forEach(function (item) {
                                var link = null;
                                if (item.type === 'restaurant') {
                                    link = '/restaurant/' + item.type_id;
                                } else if (item.type === 'product') {
                                    link = '/restaurant/' + item.type_id;
                                }
                                $('#search-list').empty();
                                $('#search-list').append('<a href="' + link + '" class="dropdown-item" >' + item.name + '</a>');
                                $('.dropdown-toggle').dropdown('open');
                            });
                        } else {
                            $('#search-list').append('<a class="dropdown-item" href="">No Results</a>');
                        }
                    })
            }, 500));

            function debounce(func, wait, immediate) {
                var timeout;
                return function () {
                    var context = this, args = arguments;
                    var later = function () {
                        timeout = null;
                        if (!immediate) func.apply(context, args);
                    };
                    var callNow = immediate && !timeout;
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                    if (callNow) func.apply(context, args);
                };
            }
        });


        $('#btn_submit_search').on('click', function(){
            $('#search_form').submit();
        })
        const removeCartItem = (product_id) => {
            window.event.preventDefault()

            var data = {
                _token: "{{ csrf_token() }}",
                product_id
            }

            $.ajax({
                url: '{{ route("app.cart.remove-item") }}',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(result) {
                    renderCart()
                }
            })
        }

        const emptyCart = (render) => {
            window.event.preventDefault()
            console.log(render);

            var data = {
                _token: "{{ csrf_token() }}",
            }

            $.ajax({
                url: '{{ route("app.cart.remove-all") }}',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(result) {
                    renderCart()
                }
            })
        }

        const renderCart = () => {
            $.ajax({
                url: '{{ route("app.cart.get-data") }}',
                type: 'GET',
                dataType: 'json',
                success: function(result) {
                    if(result == null) result = {};
                    if(Object.keys(result).length) {
                        $(".cart-btn.cart-dropdown .cart-detail-box .card-body .item-total").removeClass('d-none')
                        $(".cart-btn.cart-dropdown .cart-detail-box .card-body .no-items").addClass('d-none')
                    } else {
                        $(".cart-btn.cart-dropdown .cart-detail-box .card-body .item-total").addClass('d-none')
                        $(".cart-btn.cart-dropdown .cart-detail-box .card-body .no-items").removeClass('d-none')
                    }

                    $(".cart-btn.cart-dropdown .user-alert-cart").text(Object.keys(result).length)

                    var list = '';
                    var total_price = 0;
                    var vendor = '';
                    
                    for (const [key, item] of Object.entries(result)) {
                        vendor = item.vendor;
                        msg=item.message;
                        if (msg == null){
msg='';
                        }
                            
                        
                        list += '<div class="cat-product-box border-bottom-1">' +
                            '<div class="cat-product pb-1">' +
                                '<div class="d-flex justify-content-between">' +
                                    '<div class="cat-name text-dark">' +
                                        '<span class="text-dark-white mr-2">' + item.quantity + ' ×</span>' +
                                        item.name +
                                    '</div>' +
                                    '<div class="price ml-2">$' + parseFloat(item.item_price).toFixed(2) + '</div>' +
                                '</div>' +
                                '<div class="item-options ml-4">' +
                                    '<div class="option">';
                                    
                                    item.options.forEach(function(option) {
                                        list += '<div class="name limit-line-2 text-light-white">•' + option.name + '</div>';
                                        if(!isNaN(option.price) && option.price != null && option.price)
                                            list += '<div class="price ml-2">+$' + option.price + '</div>';
                                    })

                        list +=     '</div>' +
                                '</div>' +
                                '<div class="message text-light-white ml-3">' + msg + '</div>'+
                            '</div>' +
                            '<p class="text-center text-danger font-weight-bold" style="cursor: pointer" onclick="removeCartItem(\'' + item.id + '\')"> Remove </p>' +
                        '</div>';

                        total_price = parseFloat(total_price) + parseFloat(item.total_price)
                    }

                    $(".cart-btn.cart-dropdown .cart-detail-box .card-body .cat-product-box").remove();
                    $(".cart-btn.cart-dropdown .cart-detail-box .card-body").prepend(list);
                    $("#vendorId").val(vendor);
                    $(".cart-btn.cart-dropdown .cart-detail-box .item-total .total-price").text('$' + total_price.toFixed(2))
                }
            });
        }

        $(function() {
            renderCart();
            var inputa = document.getElementById('searchInput');
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
                $(".address").text(valff[0]);
                $(".location-picker").toggleClass("open");
                $(".delivery-add").toggleClass("open");
                if(getCookie("mode") == "delivery") {
                    var url = "{{route('home.delivery',['lat'=>'latv','lng' =>'lngv'])}}";
                    url = url.replace('latv', JSON.parse(JSON.stringify(loc)).lat);
                    url = url.replace('lngv', JSON.parse(JSON.stringify(loc)).lng);
                    setCookie("mode","delivery",365);
                    window.location.href = url;
                }
                
            });
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
    <style>
        .location-picker{
            width:100%;
        }
        
    </style>
   
        <script>
            function ckChange(ckType){
                var ckName = document.getElementsByName(ckType.name);
                var checked = document.getElementById(ckType.id);
            
                if (checked.checked) {
                  for(var i=0; i < ckName.length; i++){
            
                      if(!ckName[i].checked){
                          ckName[i].disabled = true;
                      }else{
                          ckName[i].disabled = false;
                      }
                  } 
                }
                else {
                  for(var i=0; i < ckName.length; i++){
                    ckName[i].disabled = false;
                  } 
                }    
            }

            </script>
@endpush
