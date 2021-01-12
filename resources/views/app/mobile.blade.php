@extends('layouts.app')

@section('title')
    <title>Chekout</title>
@endsection

@section('content')
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
<link href="{{ asset('css/mobile/default-theme.css') }}" rel="stylesheet">
<link href="{{ asset('css/mobile/style.css') }}" rel="stylesheet">


<div class="row">
    <!-- Start Feature -->
    <section id="mu-feature">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-feature-area">

                        <div class="mu-title-area">
                            <h2 class="mu-title">OUR APP FEATURES</h2>
                            <span class="mu-title-dot"></span>
                            <p>Food delivery from your favorite Manhattan restaurants, at a fraction of the cost.</p>
                        </div>

                        <!-- Start Feature Content -->
                        <div class="mu-feature-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mu-feature-content-left">
                                        <img class="mu-profile-img" src="{{asset('img/iphone-group.png')}}" alt="iphone Image">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mu-feature-content-right">

                                        <!-- Start single feature item -->
                                        <div class="media">
                                            <div class="media-left">
                                                <button class="btn mu-feature-btn" type="button">
                                                    <i class="fa fa-tablet" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <div class="media-body">
                                                <h3 class="media-heading">Responsive Design</h3>
                                                <ul>
                                                    <li>Restaurants can be filtered by popularity, customer rating, distance, price and cuisine</li>
                                                    <li>Automatically keep track of your favorite restaurants and menu items, and save dishes for future orders</li>
                                                    <li>Ability to send reservation requests directly to restaurants for dine-in*</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- End single feature item -->

                                        <!-- Start single feature item -->
                                        <div class="media">
                                            <div class="media-left">
                                                <button class="btn mu-feature-btn" type="button">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <div class="media-body">
                                                <h3 class="media-heading">Safe and Easy to Order</h3>
                                                <ul>
                                                    <li>One-click sign up using Apple ID, Facebook or Gmail</li>
                                                    <li>Hundreds of your favorite restaurants available for delivery right to your door</li>
                                                    <li>A 24/7 concierge team to assist with your food delivery</li>
                                                    <li>No contact delivery. Meet your courier at the front door, curbside, or go non-contact and have deliveries left at your doorstep</li>
                                                    <li>Tamper proof seals so you can feel safe about your order</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!-- End single feature item -->

                                        <!-- Start single feature item -->
                                        <div class="media">
                                            <div class="media-left">
                                                <button class="btn mu-feature-btn" type="button">
                                                    <i class="fa fa-money" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                            <div class="media-body">
                                                <h3 class="media-heading">Big Savings</h3>
                                                <ul>
                                                    <li>Maximum delivery fee of $2.50</li>
                                                    <li>A flat-rate service charge of 10% rather than the 17%-33% other apps charge</li>
                                                    <li>No inflated menu prices or hidden fees</li>
                                                </ul>    
                                            </div>
                                        </div>
                                        <!-- End single feature item -->

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Feature Content -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Feature -->    



    <!-- Start Download -->
    <section id="mu-download">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mu-download-area">

                        <div class="mu-title-area">
                            <h2 class="mu-title">GET THE APP</h2>
                            <span class="mu-title-dot"></span>
                        </div>


                        <div class="mu-download-content">
                            <a class="mu-apple-btn" href="https://apps.apple.com/us/app/order-chekout/id1540173746"><i class="fa fa-apple"></i><span>apple store</span></a>
                            <a class="mu-google-btn" href="#"><i class="fa fa-android"></i><span>google play</span></a>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Download -->

</div>
@endsection

@push('scripts')
    <script>

    </script>
@endpush