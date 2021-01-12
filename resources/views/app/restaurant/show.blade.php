@extends('layouts.app')

@section('title')
    <title>Chekout</title>
@endsection
@section('content')

    <div class="page-banner" id="menu">
        <div class="owl-carousel owl-theme">
            <div class="item page-banner">
                <img src="{{str_replace('/logo/', '/banner/', $restaurant->photo) ?? asset('img/slider.jpeg')}}" alt="banner">
            </div>
            <div class="item page-banner">
                <img src="{{str_replace('/logo/', '/banner/', $restaurant->photo) ?? asset('img/slider.jpeg')}}" alt="banner">
            </div>
        </div>
    
        <div class="overlay-2">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="back-btn">
                            <button type="button" class="text-light-green"><i class="fas fa-chevron-left"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="tag-share forward-btn">
                                <span class="text-light-green share-tag">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- restaurent top -->
    <!-- restaurent details -->
    <section class="restaurent-details  u-line">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading padding-tb-10">
                        <h3 class="text-light-black title fw-700 no-margin">{{ $restaurant->name ?? 'Untitled' }}</h3>
                        <input type="hidden" id="delivery_radius" value="{{ $restaurant->deliveryRadius }}">
                        <input type="hidden" id="res_lat" value="{{ $restaurant->latitude }}">
                        <input type="hidden" id="res_lng" value="{{ $restaurant->longitude }}">
                        <input type="hidden" id="res_relay" value="{{ $restaurant->relay_key }}">
                        
                        <p class="text-light-black sub-title no-margin">{{ $restaurant->address ?? 'Unlisted Address' }}
                            {{--                            <span><a href="checkout.html" class="text-success">Change locations</a></span>--}}
                        </p>
                        {{--                        <div class="head-rating">--}}
                        {{--                            --}}{{--                             Todo: Need to make this work wth an actual rating reviewsSum/reviewsCount--}}
                        {{--                            <div class="rating"> <span class="fs-16 text-yellow">--}}
                        {{--                              <i class="fas fa-star"></i>--}}
                        {{--                            </span>--}}
                        {{--                                <span class="fs-16 text-yellow">--}}
                        {{--                              <i class="fas fa-star"></i>--}}
                        {{--                            </span>--}}
                        {{--                                <span class="fs-16 text-yellow">--}}
                        {{--                              <i class="fas fa-star"></i>--}}
                        {{--                            </span>--}}
                        {{--                                <span class="fs-16 text-yellow">--}}
                        {{--                              <i class="fas fa-star"></i>--}}
                        {{--                            </span>--}}
                        {{--                                <span class="fs-16 text-dark-white">--}}
                        {{--                              <i class="fas fa-star"></i>--}}
                        {{--                            </span>--}}
                        {{--                                <span class="text-light-black fs-12 rate-data">--}}
                        {{--                                    {{ $restaurant->reviewsCount ?? 0}}--}}
                        {{--                                    {{ isset($restaurant->reviewsCount) && ($restaurant->reviewsCount != 1) ? 'ratings' : 'rating' }}--}}
                        {{--                                </span>--}}
                        {{--                            </div>--}}
                        {{--                            <div class="product-review">--}}
                        {{--                                <div class="restaurent-details-mob">--}}
                        {{--                                    <a href="#"> <span class="text-light-black"><i--}}
                        {{--                                                class="fas fa-info-circle"></i></span>--}}
                        {{--                                        <span class="text-dark-white">info</span>--}}
                        {{--                                    </a>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="restaurent-details-mob">--}}
                        {{--                                    <a href="#"> <span class="text-light-black"><i--}}
                        {{--                                                class="fas fa-info-circle"></i></span>--}}
                        {{--                                        <span class="text-dark-white">info</span>--}}
                        {{--                                    </a>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="restaurent-details-mob">--}}
                        {{--                                    <a href="#"> <span class="text-light-black"><i--}}
                        {{--                                                class="fas fa-info-circle"></i></span>--}}
                        {{--                                        <span class="text-dark-white">info</span>--}}
                        {{--                                    </a>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="restaurent-details-mob">--}}
                        {{--                                    <a href="#"> <span class="text-light-black"><i--}}
                        {{--                                                class="fas fa-info-circle"></i></span>--}}
                        {{--                                        <span class="text-dark-white">info</span>--}}
                        {{--                                    </a>--}}
                        {{--                                </div>--}}
                        {{--                                --}}{{--                                <h6 class="text-light-black no-margin">91<span class="fs-14">% Food was good</span></h6>--}}
                        {{--                                --}}{{--                                <h6 class="text-light-black no-margin">91<span class="fs-14">% Food was good</span></h6>--}}
                        {{--                                --}}{{--                                <h6 class="text-light-black no-margin">91<span class="fs-14">% Food was good</span></h6>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                    <div class="restaurent-logo page-banner">
                        <img src="{{ $restaurant->photo ?? asset('img/logo.png') }}" class="img-fluid" alt="#">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- restaurent details -->
    <!-- restaurent tab -->
    <div class="restaurent-tabs u-line">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="restaurent-menu scrollnav">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active text-light-white fw-700" data-toggle="pill"
                                                    href="#menu">Menu</a>
                            </li>
                            <li class="nav-item"><a class="nav-link text-light-white fw-700" data-toggle="pill"
                                                    href="#about">About</a>
                            </li>
                            <li class="nav-item"><a class="nav-link text-light-white fw-700" data-toggle="pill"
                                                    href="#review">Reviews</a>
                            </li>
                            <!-- <li class="nav-item"><a class="nav-link text-light-white fw-700" data-toggle="pill"
                                                    href="#mapgallery">Map & Gallery</a>
                            </li> -->
                        </ul>
                        <div class="add-wishlist fav-restaurant">
                            <span class = "fa fa-heart favorite-icon @if($isFavorite) active @endif">
                                <input type="hidden" class = "vendorId_for_fav" value="{{$restaurant->id}}">
                                <input type="hidden" class = "name_for_fav" value="{{ $restaurant->name ?? ''}}">
                                <input type="hidden" class = "description_for_fav" value="{{$restaurant->description ?? ''}}">
                                <input type="hidden" class = "photo_for_fav" value="{{ $restaurant->photo }}">
                                <input type="hidden" class = "address_for_fav" value="{{$restaurant->address ?? ''}}">
                                <input type="hidden" class = "hours_for_fav" value="{{json_encode($restaurant->operation_info)}}">
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- restaurent tab -->
    <!-- restaurent address -->
    <div class="restaurent-address u-line">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="address-details">
                        <div class="address">
                            <div class="delivery-address"><a href="" class="text-light-black">Delivery,
                                    ASAP
                                    ({{ isset($restaurant->prep_min) ? $restaurant->prep_min . ' minutes' : 'No Estimate Available' }}
                                    )</a>
                                <div class="delivery-type"><span
                                        class="text-success fs-12 fw-500">No minimum</span>
                                    {{--                                    <span class="text-light-white">, Free Delivery</span>--}}
                                </div>
                            </div>
                            {{--                            <div class="change-address"><a href="checkout.html" class="fw-500">Change</a>--}}
                            {{--                            </div>--}}
                        </div>
                        {{--                        <p class="text-light-white no-margin">Lorem ipsum dolor sit amet, consectetur adipiscing--}}
                        {{--                            elit,</p>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- restaurent address -->
    <!-- restaurent meals -->
    <section class="section-padding restaurent-meals bg-light-theme">
        <div class="container">
            <div class="alert alert-info text-center" id="alert" style="display: none;">

            </div>

            <div class="row">
                <div class="col-lg-12 col-xl-11">
                    @foreach($current->collection('restaurant_menu')->documents() as $menu)
                        @foreach($current->collection('restaurant_menu')->document($menu->data()['id'])->collection('menu_section')->orderBy('orderNumber')->documents() as $section)
                            <h3 class="mb-2">{{ $section->data()['name'] }}</h3>
        
                            <div class="row mb-4">
                                @if($current->collection('restaurant_menu')->document($menu->data()['id'])->collection('menu_section')->document($section->data()['id'])->collection('menu_item')->documents())
                                    @foreach($current->collection('restaurant_menu')->document($menu->data()['id'])->collection('menu_section')->document($section->data()['id'])->collection('menu_item')->documents() as $product)
                                        <div class="col-lg-6 mb-2">
                                            <x-menu-item-card
                                                :product="$product"
                                                :restaurant="$restaurant"
                                                :favorites="$favorites"
                                                >
                                            </x-menu-item-card>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-12">
                                        <div class="alert alert-info">
                                            This restaurant doesn't have a
                                            menu
                                            set up yet.
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- restaurent meals -->
    <!-- restaurent about -->
    <section class="section-padding restaurent-about smoothscroll" id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="text-light-black fw-700 title">{{ $restaurant->title ?? '' }}</h3>
                    {{--                    <p class="text-light-green no-margin">American, Breakfast, Coffee and Tea, Fast Food, Hamburgers</p>--}}
                    <p class="text-light-white no-margin">{{ $restaurant->description ?? '' }}</p>
                    <span
                        class="text-{{ isset($restaurant->price) && $restaurant->price > 0 ? 'success' : 'dark-white' }} fs-16">$</span>
                    <span
                        class="text-{{ isset($restaurant->price) && $restaurant->price > 1 ? 'success' : 'dark-white' }} fs-16">$</span>
                    <span
                        class="text-{{ isset($restaurant->price) && $restaurant->price > 2 ? 'success' : 'dark-white' }} fs-16">$</span>
                    <span
                        class="text-{{ isset($restaurant->price) && $restaurant->price > 3 ? 'success' : 'dark-white' }} fs-16">$</span>
                    <span
                        class="text-{{ isset($restaurant->price) && $restaurant->price > 4 ? 'success' : 'dark-white' }} fs-16">$</span>
                    <input type="hidden" value="{{$restaurant->deliveryRadius}}">
                    <ul class="about-restaurent">
                        <li>
                            <i class="fas fa-building"></i>
                            <span>
                                <a href="#" class="text-light-white">{{ $restaurant->name }}</a>
                            </span>
                        </li>
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>
                                <a href="#" class="text-light-white">{{ $restaurant->address }}</a>
                            </span>
                        </li>
                        <li><i class="fas fa-phone-alt"></i>
                            <span><a href="tel:"
                                     class="text-light-white">{{$restaurant->phone}}</a></span>
                        </li>
                        {{--                        <li><i class="far fa-envelope"></i>--}}
                        {{--                            <span><a href="mailto:" class="text-light-white">demo@domain.com</a></span>--}}
                        {{--                        </li>--}}
                    </ul>
                    {{--                    <ul class="social-media pt-2">--}}
                    {{--                        <li><a href="#"><i class="fab fa-facebook-f"></i></a>--}}
                    {{--                        </li>--}}
                    {{--                        <li><a href="#"><i class="fab fa-twitter"></i></a>--}}
                    {{--                        </li>--}}
                    {{--                        <li><a href="#"><i class="fab fa-instagram"></i></a>--}}
                    {{--                        </li>--}}
                    {{--                        <li><a href="#"><i class="fab fa-pinterest-p"></i></a>--}}
                    {{--                        </li>--}}
                    {{--                        <li><a href="#"><i class="fab fa-youtube"></i></a>--}}
                    {{--                        </li>--}}
                    {{--                    </ul>--}}
                </div>
                <div class="col-md-6">
                    <div class="restaurent-schdule">
                        <div class="card">
                            <div class="card-header text-light-white fw-700 fs-16">Hours</div>
                            <div class="card-body">
                                <div class="schedule-box">
                                    @if(isset($restaurant->operation_info) && isset($restaurant->operation_info) && count($restaurant->operation_info->monday) > 0)
                                        <div class="day text-light-black">Monday</div>
                                        <div
                                            class="time text-light-black">{{ $restaurant->operation_info->monday[0] == true ? date("g:i a", strtotime($restaurant->operation_info->monday[1])) . ' - ' . date("g:i a", strtotime($restaurant->operation_info->monday[2])) : 'Closed' }}</div>
                                    @endif
                                </div>
                                <div class="collapse show" id="schdule">
                                    <div class="schedule-box">
                                        <div class="day text-light-black">Tuesday</div>
                                        <div
                                            class="time text-light-black">{{ $restaurant->operation_info->tuesday[0] == true ? date("g:i a", strtotime($restaurant->operation_info->tuesday[1])) . ' - ' . date("g:i a", strtotime($restaurant->operation_info->tuesday[2])) : 'Closed' }}</div>
                                    </div>
                                    <div class="schedule-box">
                                        <div class="day text-light-black">Wednesday</div>
                                        <div
                                            class="time text-light-black">{{ $restaurant->operation_info->wednesday[0] == true ? date("g:i a", strtotime($restaurant->operation_info->wednesday[1])) . ' - ' . date("g:i a", strtotime($restaurant->operation_info->wednesday[2])) : 'Closed' }}</div>
                                    </div>
                                    <div class="schedule-box">
                                        <div class="day text-light-black">Thursday</div>
                                        <div
                                            class="time text-light-black">{{ $restaurant->operation_info->thursday[0] == true ? date("g:i a", strtotime($restaurant->operation_info->thursday[1])) . ' - ' . date("g:i a", strtotime($restaurant->operation_info->thursday[2])) : 'Closed' }}</div>
                                    </div>
                                    <div class="schedule-box">
                                        <div class="day text-light-black">Friday</div>
                                        <div
                                            class="time text-light-black">{{ $restaurant->operation_info->friday[0] == true ? date("g:i a", strtotime($restaurant->operation_info->friday[1])) . ' - ' . date("g:i a", strtotime($restaurant->operation_info->friday[2])) : 'Closed' }}</div>
                                    </div>
                                    <div class="schedule-box">
                                        <div class="day text-light-black">Saturday</div>
                                        <div
                                            class="time text-light-black">{{ $restaurant->operation_info->saturday[0] == true ? date("g:i a", strtotime($restaurant->operation_info->saturday[1])) . ' - ' . date("g:i a", strtotime($restaurant->operation_info->saturday[2])) : 'Closed' }}</div>
                                    </div>
                                    <div class="schedule-box">
                                        <div class="day text-light-black">Sunday</div>
                                        <div
                                            class="time text-light-black">{{ $restaurant->operation_info->sunday[0] == true ? date("g:i a", strtotime($restaurant->operation_info->sunday[1])) . ' - ' . date("g:i a", strtotime($restaurant->operation_info->sunday[2])) : 'Closed' }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer"><a class="fw-500" data-toggle="collapse" href="#schdule">See
                                    the full schedule</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- restaurent about -->
    <!-- map gallery -->
    <!-- <div class="map-gallery-sec section-padding bg-light-theme smoothscroll" id="mapgallery">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main-box">
                        <div class="row">
                            <div class="col-md-6 map-pr-0">
                                <iframe id="locmap"
                                        src="https://maps.google.com/maps?q={{ $restaurant->address }}&t=&z=13&ie=UTF8&iwloc=&output=embed"></iframe>
                            </div>
                            <div class="col-md-6 map-pl-0">
                                <div class="gallery-box padding-10">
                                    <ul class="gallery-img">
                                        <li>
                                            <a class="image-popup"
                                               href="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                               title="Image title">
                                                <img
                                                    src="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                    class="img-fluid full-width"
                                                    alt="9.jpg"/>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="image-popup"
                                               href="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                               title="Image title">
                                                <img
                                                    src="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                    class="img-fluid full-width"
                                                    alt="9.jpg"/>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="image-popup"
                                               href="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                               title="Image title">
                                                <img
                                                    src="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                    class="img-fluid full-width"
                                                    alt="9.jpg"/>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="image-popup"
                                               href="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                               title="Image title">
                                                <img
                                                    src="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                    class="img-fluid full-width"
                                                    alt="9.jpg"/>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="image-popup"
                                               href="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                               title="Image title">
                                                <img
                                                    src="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                    class="img-fluid full-width"
                                                    alt="9.jpg"/>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="image-popup"
                                               href="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                               title="Image title">
                                                <img
                                                    src="https://images.pexels.com/photos/1640777/pexels-photo-1640777.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                                                    class="img-fluid full-width"
                                                    alt="9.jpg"/>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- map gallery -->
    <!-- restaurent reviews -->
    @php
        $reviewTotal = isset($restaurant->reviewsCount) && $restaurant->reviewsCount > 0 && $restaurant->reviewsSum > 0 ? $restaurant->reviewsSum / $restaurant->reviewsCount : 0;
    @endphp
    <section class="section-padding restaurent-review smoothscroll" id="review">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header-left">
                        <h3 class="text-light-black header-title title">Reviews
                            for {{ $restaurant->title ?? 'this restaurant' }}</h3>
                    </div>
                    <div class="restaurent-rating mb-xl-20">
                        <div class="star"><span class="text-{{ $reviewTotal > 0 ? 'yellow' : 'dark-white'}} fs-16">
                                <i class="fas fa-star"></i>
                            </span>
                            <span class="text-{{ $reviewTotal > 1 ? 'yellow' : 'dark-white'}} fs-16">
                                <i class="fas fa-star"></i>
                            </span>
                            <span class="text-{{ $reviewTotal > 2 ? 'yellow' : 'dark-white'}} fs-16">
                                <i class="fas fa-star"></i>
                            </span>
                            <span class="text-{{ $reviewTotal > 3 ? 'yellow' : 'dark-white'}} fs-16">
                                <i class="fas fa-star"></i>
                            </span>
                            <span class="text-{{ $reviewTotal > 4 ? 'yellow' : 'dark-white'}} fs-16">
                                <i class="fas fa-star"></i>
                            </span>
                        </div>
                        <span class="fs-12 text-light-black">
                            {{ $restaurant->reviewsCount ?? 0}}
                            {{ isset($restaurant->reviewsCount) && ($restaurant->reviewsCount != 1) ? 'ratings' : 'rating' }}</span>
                    </div>
                    <div class="u-line"></div>
                </div>
                @if(isset($reviews) && $reviews->count() > 0)
                    <div class="col-md-12">
                        @foreach($reviews as $review)
                            <div class="review-box">
                                <div class="review-user">
                                    <div class="review-user-img">
                                        <img src="{{ $review['authorProfilePic'] ?? 'https://via.placeholder.com/40' }}"
                                             class="rounded-circle" alt="#" style="max-height: 90px;">
                                        <div class="reviewer-name">
                                            <p class="text-light-black fw-600">{{ $review['authorName'] && trim($review['authorName']) != '' ? $review['authorName'] : 'Anonymous' }}
                                            {{--                                                <small class="text-light-white fw-500">New--}}
                                            {{--                                                    York, (NY)</small>--}}
                                            {{--                                            </p> <i class="fas fa-trophy text-black"></i><span class="text-light-black">Top Reviewer</span>--}}
                                        </div>
                                    </div>
                                    <div class="review-date"><span class="text-light-white">Sep 20, 2020</span>
                                    </div>
                                </div>
                                <div class="ratings"><span
                                        class="text-{{ $review['rating'] > 0 ? 'yellow' : 'dark-white' }} fs-16">
                                        <i class="fas fa-star"></i>
                                    </span>
                                    <span class="text-{{ $review['rating'] > 1 ? 'yellow' : 'dark-white' }} fs-16">
                                        <i class="fas fa-star"></i>
                                    </span>
                                    <span class="text-{{ $review['rating'] > 2 ? 'yellow' : 'dark-white' }} fs-16">
                                        <i class="fas fa-star"></i>
                                    </span>
                                    <span class="text-{{ $review['rating'] > 3 ? 'yellow' : 'dark-white' }} fs-16">
                                        <i class="fas fa-star"></i>
                                    </span>
                                    <span class="text-{{ $review['rating'] > 4 ? 'yellow' : 'dark-white' }} fs-16">
                                        <i class="fas fa-star"></i>
                                    </span>
                                    <span class="ml-2 text-light-white">2 days ago</span>
                                </div>
                                <p class="text-light-black">{{ isset($review['text']) && trim($review['text']) != '' ? $review['text'] :  'No text provided.'}}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="col-12">
                        <div class="review-img">
                            <img src="{{ asset('img/review-footer.png') }}" class="img-fluid" alt="#">
                            <div class="review-text">
                                <h2 class="text-light-white mb-2 fw-600">Be one of the first to review</h2>
                                <p class="text-light-white">Order now and write a review to give others the inside
                                    scoop.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <div class="modal fade" id="modalProductDetail" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="min-width: 600px;">
            <div class="modal-content bg-white">
                <div class="modal-header border-0 pb-0 justify-content-end">
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="flex-shrink: 0;"><path d="M17.2929 18.7071C17.6834 19.0976 18.3166 19.0976 18.7071 18.7071C19.0976 18.3166 19.0976 17.6834 18.7071 17.2929L13.4142 12L18.7071 6.70711C19.0976 6.31658 19.0976 5.68342 18.7071 5.29289C18.3166 4.90237 17.6834 4.90237 17.2929 5.29289L12 10.5858L6.70711 5.29289C6.31658 4.90237 5.68342 4.90237 5.29289 5.29289C4.90237 5.68342 4.90237 6.31658 5.29289 6.70711L10.5858 12L5.29289 17.2929C4.90237 17.6834 4.90237 18.3166 5.29289 18.7071C5.68342 19.0976 6.31658 19.0976 6.70711 18.7071L12 13.4142L17.2929 18.7071Z" fill="#494949"></path></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="frmProductDetail">
                        <input type="hidden" class="restaurant-id">
                        <input type="hidden" class="menu-id">
                        <input type="hidden" class="section-id">
                        <input type="hidden" class="product-id">
                        <h4 class="font-weight-bold mb-2 product-name">Name</h4>
                        <img class="product-image d-none mb-3" src="" alt="">
                        <p class="limit-line-3 product-description">Description</p>
                        <h5 class="font-weight-bold product-price mt-2 mb-3"></h5>
                        <h5 class="font-weight-bold product-calory">Cal: 600-700</h5>
                        <div class="product-options">

                        </div>

                        <label for="">Message:</label>
                        <textarea name="" class="form-control message" cols="30" rows="3"></textarea>
                    </form>
                </div>
                <div class="modal-footer border-0 pt-0" style="display: block">
                    @if (session('cart'))
                        
                    
                   <?php $cart = session('cart'); ?>
            @foreach( $cart as $key => $cat)
                
                @if($cat["vendor"] != $restaurant->id)
               <span>Items already in cart:your cart contains items form a diffrent restaurant would you like to reset your cart before browsing this restaurant<a href="#" id="emptycs" class="btn btn-danger" onclick="emptyCart(true)">Empty cart</a></span>
                @else
                <div class="row">
                    <div class="col-lg-2 space"></div>
                    <div class="col-lg-2 col-2">
                        <button class="btn btn-block btn-reduce-quantity" style="background-color: lightgrey; color: black !important; font-size: 18px">-</button>    
                    </div>
                    <div class="col-lg-4 col-8">
                        <!--<input type="text" id="quantity_val" value="Quantity: 0" disabled>-->
                        <p class="text-light-black fw-600" id="quantity_val" style="text-align: center; font-size: 20px; color: grey">Quantity: 0</p>
                    </div>
                    <div class="col-lg-2 col-2">
                        <button class="btn btn-block btn-add-quantity" style="background-color: lightgrey; color: black !important; font-size: 18px">+</button>    
                    </div>
                    <div class="col-lg-2 space"></div>
                </div>
                
                <button class="btn btn-block btn-add-cart" style="margin-left: 0">Add to cart</button>

                    @endif
                    @if ($key == 0)
                    @break
                        
                    @endif
                    @endforeach
                    @else
                    <div class="row">
                        <div class="col-lg-2 space"></div>
                        <div class="col-lg-2 col-2">
                            <button class="btn btn-block btn-reduce-quantity" style="background-color: lightgrey; color: black !important; font-size: 18px">-</button>    
                        </div>
                        <div class="col-lg-4 col-8">
                            <!--<input type="text" id="quantity_val" value="Quantity: 0" disabled>-->
                            <p class="text-light-black fw-600" id="quantity_val" style="text-align: center; font-size: 20px; color: grey">Quantity: 0</p>
                        </div>
                        <div class="col-lg-2 col-2">
                            <button class="btn btn-block btn-add-quantity" style="background-color: lightgrey; color: black !important; font-size: 18px">+</button>    
                        </div>
                        <div class="col-lg-2 space"></div>
                    </div>
                    <button class="btn btn-block btn-add-cart" style="margin-left: 0">Add to cart</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTemporaryProduct" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <button class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalOutArea" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content bg-white">
                <div class="modal-header border-0 pb-0 justify-content-end">
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="flex-shrink: 0;"><path d="M17.2929 18.7071C17.6834 19.0976 18.3166 19.0976 18.7071 18.7071C19.0976 18.3166 19.0976 17.6834 18.7071 17.2929L13.4142 12L18.7071 6.70711C19.0976 6.31658 19.0976 5.68342 18.7071 5.29289C18.3166 4.90237 17.6834 4.90237 17.2929 5.29289L12 10.5858L6.70711 5.29289C6.31658 4.90237 5.68342 4.90237 5.29289 5.29289C4.90237 5.68342 4.90237 6.31658 5.29289 6.70711L10.5858 12L5.29289 17.2929C4.90237 17.6834 4.90237 18.3166 5.29289 18.7071C5.68342 19.0976 6.31658 19.0976 6.70711 18.7071L12 13.4142L17.2929 18.7071Z" fill="#494949"></path></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Sorry, your address is not in relay or delivery area.</h5>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalNoInfo" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content bg-white">
                <div class="modal-header border-0 pb-0 justify-content-end">
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="flex-shrink: 0;"><path d="M17.2929 18.7071C17.6834 19.0976 18.3166 19.0976 18.7071 18.7071C19.0976 18.3166 19.0976 17.6834 18.7071 17.2929L13.4142 12L18.7071 6.70711C19.0976 6.31658 19.0976 5.68342 18.7071 5.29289C18.3166 4.90237 17.6834 4.90237 17.2929 5.29289L12 10.5858L6.70711 5.29289C6.31658 4.90237 5.68342 4.90237 5.29289 5.29289C4.90237 5.68342 4.90237 6.31658 5.29289 6.70711L10.5858 12L5.29289 17.2929C4.90237 17.6834 4.90237 18.3166 5.29289 18.7071C5.68342 19.0976 6.31658 19.0976 6.70711 18.7071L12 13.4142L17.2929 18.7071Z" fill="#494949"></path></svg>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Sorry, current restaurant has no contact information.<br>Please contact our serivce team.</h5>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/owl.carousel.min.js') }}"></script>
    <script>
        let product;
        let extra_option_price = 0;
        let flg_optionPrice = 0;
        let quantity_count;
        let total_price;
        $(document).ready(function () {
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                loop: true,
                nav: false,
                dots: false,
                items: 1,
            });

            $('.page-banner .back-btn').click(function(){
                owl.trigger('prev.owl.carousel', [300]);
            });
            
            $('.page-banner .forward-btn').click(function(){
                owl.trigger('next.owl.carousel', [300]);
            });

            $(document).on('submit', '.add-to-cart-form', function (e) {
                e.preventDefault();
                var form = $(e.target);
                var inputs = form.find('input');
                var select = form.find('select');
                // not sure if you wanted this, but I thought I'd add it.
                // get an associative array of just the values.
                var values = {};
                inputs.each(function () {
                    values[this.name] = $(this).val();
                });
                select.each(function () {
                    values[this.name] = $(this).val();
                });
                // console.log(values);
                // $.post(form.attr('action'), values, "json")
                //     .done(function (data) {
                //         console.log(data);
                //         if (data.error) {
                //             $('#alert').show();
                //             $('#alert').empty().append(
                //                 '<div class="row">' + data.error + '</div>' +
                //                 '<div class="row">' + data.alert + '</div>'
                //             );
                //         } else {
                //             // Todo: Prepend to not get rid of the subtotal box.
                //             var cartItems = $(document).find('.cat-product-box').remove();
                //             var cartBadge = $(document).find('.user-alert-cart').first();
                //             console.log('Cart Badge Below');
                //             console.log(cartBadge);
                //             cartBadge.empty().text(data.items.length);
                //             var carts = $(document).find('.cart-item-holder');
                //             console.log(carts);
                //             carts.each(function () {
                //                 var items = data.items;
                //                 var string = '';
                //                 for (var itemkey in items) {
                //                     string += parseFirstCartItemString(items[itemkey], itemkey) + parseSecondCartItemString(items[itemkey], itemkey) + parseThirdCartItemString(items[itemkey], itemkey);
                //                 }
                //                 $(this).html(string);
                //             });
                //             var subtotals = $(document).find('.cart-subtotal');
                //             subtotals.each(function (subtotalEvent) {
                //                 $(this).empty().append(
                //                     '<a href="#" class="text-dark-white fw-500">$' + data.subtotal + '</a>');
                //             });
                //         }
                //     })
            });
            function parseFirstCartItemString(item, index) {
                return '<div class="cat-product-box" data-cart="' + index + '-' + item.id + '">' +
                '                        <div class="cat-product">' +
                '                            <div class="cat-name">' +
                '                                <div class="row">' +
                '                                    <div class="col-12">' +
                '                                        <a href="#">' +
                '                                            <p class="text-dark"><span' +
               '                                                    class="text-dark-white">' + item.quantity + '</span>' + item.name + '</p>';
            }
            function parseSecondCartItemString(item, index) {
                var string = '';
                options = item.options;
                for (var optionkey in options) {
                    string += '<span class="text-light-white">' + options[optionkey] + '</span>';
                }
                return string;
            }
            function parseThirdCartItemString(item, index) {
                return '                                            <div class="delete-btn">' +
                    '                                                <a class="text-dark-white remove-item"' +
                    '                                                   data-id="' + item.id + '" data-index="' + index + '"> <i' +
                    '                                                        class="far fa-trash-alt"></i>' +
                    '                                                </a>' +
                    '                                            </div>' +
                    '                                        </a>' +
                    '                                    </div>' +
                    '                                </div>' +
                    '                            </div>' +
                    '                            <div class="price"><a href="#" class="text-dark-white fw-500">' +
                    '$' + item.price +
                    '                                </a>' +
                    '                            </div>' +
                    '                        </div>' +
                    '                    </div>';
            }
        });


        const checkboxChanged = (index_item, index_option_item) => {
            if($(`#checkbox_${index_item}_${index_option_item}`).val() == "off")
                $(`#checkbox_${index_item}_${index_option_item}`).val("on");
            else
                $(`#checkbox_${index_item}_${index_option_item}`).val("off");
            resetProductPrice();
        }
        
        const change_sizeWithPrice = () => {
            var id = $('#sizeWithPrice_id').val();
            var total = parseFloat(product.sizeWithPrice[id].price);
            $('.product-price').text(`Price: $ ${total}`);
            $("#modalProductDetail .btn-add-cart").data('price', total);
            total += parseFloat(extra_option_price);
            $("#modalProductDetail .btn-add-cart").text('Add to cart - $' + parseFloat(total).toFixed(2))
        }
        
        const resetProductPrice = () => {
            
            var total = $("#modalProductDetail .btn-add-cart").data('price');
            extra_option_price = 0;
            product.extraOption.forEach((item, index_item) => {
               if(item.trigger == 0 || !item.trigger || item.trigger == ""){
                    if(item.type == 'quantity')
                    {
                        item.data.forEach((option_item, index_option_item) => {
                            extra_option_price += $(`#price_${index_item}_${index_option_item}`).val() * option_item.price;
                        });
                    }
                    else if(item.type == 'checkbox')
                    {
                        item.data.forEach((option_item, index_option_item) => {
                            if($(`#checkbox_${index_item}_${index_option_item}`).val() == "on"){
                                extra_option_price += option_item.price;
                            }
                        })
                    }
                    else
                    {
                        item.data.forEach((option_item, index_option_item) => {
                            if($(`#select_${index_item}`).val() == `title_radio_${index_item}_${index_option_item}`){
                                extra_option_price += option_item.price;
                            }
                        })
                    }
                }
                else{
                    var max_price = 0;
                    
                    if(item.type == 'quantity'){
                        max_price = 0;
                         for(index = 0; index < item.data.length; index ++)
                             if(max_price < item.data[index].price)
                                 max_price = item.data[index].price;
                        var cnt = 0;
                        
                        item.data.forEach((option_item, index_option_item) => {
                            
                            if($(`#price_${index_item}_${index_option_item}`).val() > 0)
                                cnt ++;
                            if(cnt > item.trigger)
                            {
                                extra_option_price += $(`#price_${index_item}_${index_option_item}`).val() * max_price;
                            }
                            
                        }); 
                    }
                    else if(item.type == 'checkbox')
                    {
                        max_price = 0;
                         for(index = 0; index < item.data.length; index ++)
                             if(max_price < item.data[index].price)
                                 max_price = item.data[index].price;
                        cnt = 0;
                        item.data.forEach((option_item, index_option_item) => {
                            if($(`#checkbox_${index_item}_${index_option_item}`).val() == "on"){
                                cnt ++;
                            }
                            if(cnt > item.trigger){
                                extra_option_price += max_price;
                            }
                        })
                    }
                }
            });
            // $("#modalProductDetail .product-options .select-class option:selected").each((index, item) => {
            //     if(extraPrice = $(item).data('price')) {
            //         extra_option_price = extra_option_price + parseFloat(extraPrice);
            //     }
            // })
            // $(".option-quantity-class").each((index, item) => {
            //     if($(item).val() > 0) {
                    
            //         var opt_str_arr = $(item)[0].id;
            //         opt_str_arr = opt_str_arr.split('_');
            //         var product_ext_opt = product.extraOption[parseInt(opt_str_arr[1])].data[parseInt(opt_str_arr[2])];
            //         var cnt = $(`#price_${parseInt(opt_str_arr[1])}_${parseInt(opt_str_arr[2])}`).val();
            //         extra_option_price = extra_option_price + parseFloat(product_ext_opt.price * cnt);
            //     }
            // })
            
            // $(".option-checkbox-class").each((index, item) => {
            //     if($(item).val() == "on") {
            //         var opt_str_arr = $(item)[0].id;
            //         opt_str_arr = opt_str_arr.split('_');
            //         var product_ext_opt = product.extraOption[parseInt(opt_str_arr[1])].data[parseInt(opt_str_arr[2])];
            //         extra_option_price = extra_option_price + parseFloat(product_ext_opt.price);
            //     }
            // })
            
            
            total = parseFloat(total) + extra_option_price;
            total_price = total;
            $("#modalProductDetail .btn-add-cart").text('Add to cart - $' + parseFloat(total).toFixed(2))

            setTimeout(()=>{
                var total = $("#modalProductDetail .btn-add-cart").data('price');
                extra_option_price = 0;
                $("#modalProductDetail .product-options .select-class option:selected").each((index, item) => {
                    if(extraPrice = $(item).data('price')) {
                        if(index == 0 && flg_optionPrice == 1){
                            total = parseFloat(extraPrice);
                            $("#modalProductDetail .product-price").text('Price: $' + parseFloat(total).toFixed(2));
                            $("#modalProductDetail .btn-add-cart").data('price', total);
                            $("#modalProductDetail .btn-add-cart").text('Add to cart - $' + total);
                        }
                        else{
                            extra_option_price = extra_option_price + parseFloat(extraPrice);
                        }
                    }
                })

                var quantity_trigger_price = 0;
                var quantity_trigger_count = 0;


                $(".quantity-trigger").each((index, item) => {
                    var val = $(item).val();
                    // console.log("trigger count value ++ ", val);
                    quantity_trigger_count += parseInt(val);
                })
                
                var i = 0
                $(".option-quantity-class").each((index, item) => {
                    if($(item).val() > 0) {
                        var opt_str_arr = $(item)[0].id;
                        opt_str_arr = opt_str_arr.split('_');
                        var product_ext_opt = product.extraOption[parseInt(opt_str_arr[1])].data[parseInt(opt_str_arr[2])];
                        var cnt = parseInt($(`#price_${parseInt(opt_str_arr[1])}_${parseInt(opt_str_arr[2])}`).val());
                        i+=cnt;
                        extra_option_price = extra_option_price + parseFloat(product_ext_opt.price * cnt);
                        
                        if(i <= quantity_trigger_count){
                            quantity_trigger_price+=parseFloat(product_ext_opt.price * i);
                        } else {
                            quantity_trigger_price = 0;
                            quantity_trigger_price+=parseFloat(product_ext_opt.price * quantity_trigger_count);    
                        }
                        
                        
                    }
                })

                
                $(".option-checkbox-class").each((index, item) => {
                    if($(item).val() == "on") {
                        var opt_str_arr = $(item)[0].id;
                        opt_str_arr = opt_str_arr.split('_');
                        var product_ext_opt = product.extraOption[parseInt(opt_str_arr[1])].data[parseInt(opt_str_arr[2])];
                        extra_option_price = extra_option_price + parseFloat(product_ext_opt.price);
                    }
                })

                if(!quantity_trigger_price){
                    quantity_trigger_price = 0;
                }
                
                total = parseFloat(total) + extra_option_price - quantity_trigger_price;
                total_price = total;
                $("#modalProductDetail .btn-add-cart").text('Add to cart - $' + parseFloat(total).toFixed(2))
            }, 100);
            
        }
        
        // const quantity_price_change = () => {
        //     // var total = $("#modalProductDetail .btn-add-cart").data('price');
        //     // var product_ext_opt = product.extraOption[index_item].data[index_option_item];
        //     // if(product_ext_opt.price != 0)
        //     // {
        //     //     var cnt = $(`#price_${index_item}_${index_option_item}`).val();
        //     //     total = parseFloat(total) + product_ext_opt.price * cnt;
        //     // }
        //     var total = $("#modalProductDetail .btn-add-cart").data('price');
            
        //     $("#modalProductDetail .btn-add-cart").data('price', total);
        //     $("#modalProductDetail .btn-add-cart").text('Add to cart - $' + parseFloat(total).toFixed(2))
            
        // }
        $(function() {
            $(".restaurent-product-detail").click(function(e) {
                quantity_count = 1;
                let options = '';
                var flg_priceWithSize = 0;
                flg_optionPrice = 0;
                if($(e.target).hasClass('fav-icon')) {
                    return false;
                }

                var product_price = $(this).find(".product-price").text();
                if(!product_price.includes("Price"))
                        product_price = "Price: " + product_price;
                product = $(this).data('detail');
                // console.log(product);
                if(product.price)
                    product.price = product.price.replace('$', '');
                if(isNaN(product.price) || product.price == null ) {
                    if(product.sizeWithPrice == null || product.sizeWithPrice.length == 0)
                    {
                        if(product.extraOption){
                            flg_optionPrice = 1;
                            $("#modalProductDetail .product-price").text(product_price);
                            $("#modalProductDetail .btn-add-cart").data('price', 0);
                            $("#modalProductDetail .btn-add-cart").text('Add to cart - $0');
                        }
                        else{
                            $("#modalTemporaryProduct").modal('show')
                                return;
                        }
                    }
                    else
                    {
                        flg_priceWithSize = 1;
                        var price = 0;
                        var price_size = 0;
                        if(product.sizeWithPrice[0]){
                          price = product.sizeWithPrice[0].price;
                          price_size = product.sizeWithPrice[0].size;
                        }
                        for(var i = 1; i < product.sizeWithPrice.length; i ++)
                        {
                            if(parseFloat(price) > parseFloat(product.sizeWithPrice[i].price)){
                                price = product.sizeWithPrice[i].price;
                                price_size = product.sizeWithPrice[i].size;
                            }
                        }
                        // product.price = price;
                        
                        options += '<label style="font-weight: bold;">'+ 'Choose Type' +'</label>' +
                                '<select class="form-control mb-3" id="sizeWithPrice_id" onchange="change_sizeWithPrice()">';
                        options += `<option value="0" selected>${product.sizeWithPrice[0].size}: ${product.sizeWithPrice[0].price}</option>`;
                        
                        for(i = 1; i < product.sizeWithPrice.length; i ++)    {
                            options += `<option value="${i}">${product.sizeWithPrice[i].size}: ${product.sizeWithPrice[i].price}</option>`;
                        }
        
                        options += '</select>';
                        options += '<hr>';
                        
                        $("#modalProductDetail .product-price").text(product_price)
                        $("#modalProductDetail .btn-add-cart").data('price', (price ? price : 0))
                        $("#modalProductDetail .btn-add-cart").text('Add to cart - $' + (price ? price : 0))
                    }
                }
                
                $("#modalProductDetail .restaurant-id").val(product.restaurant_id)
                $("#modalProductDetail .menu-id").val(product.menu_id)
                $("#modalProductDetail .section-id").val(product.section_id)
                $("#modalProductDetail .product-id").val(product.id)
                $("#modalProductDetail .product-image").addClass('d-none')
                if(product.photo) {
                    $("#modalProductDetail .product-image").attr('src', product.photo)
                    $("#modalProductDetail .product-image").removeClass('d-none')
                }
                $("#modalProductDetail .product-name").text(product.name)
                $("#modalProductDetail .product-description").text(product.description)
                // console.log(flg_optionPrice);
                if(flg_priceWithSize == 0 && flg_optionPrice == 0){
                    
                    $("#modalProductDetail .product-price").text(product_price)
                    $("#modalProductDetail .btn-add-cart").data('price', (product.price ? product.price : 0))
                    $("#modalProductDetail .btn-add-cart").text('Add to cart - $' + (product.price ? product.price : 0))
                }
                // $("#modalProductDetail .btn-add-quantity").text(`Quantity : ${quantity_count}`);
                $('#quantity_val').text(`Quantity : ${quantity_count}`);
                if(product.extraOption) {
                    product.extraOption.forEach((item, index_item) => {
                        if(item.type == 'quantity')
                        {
                            options += '<div style="display: flex; justify-content: space-between; padding-top: 11px;">' + '<label>' + item.title + '</label>';
                            if(item.trigger != 0 && item.trigger != "" && item.trigger != null )
                                options += `<input type="hidden" class="quantity-trigger" name="trigger-${index_item}" value="${item.trigger}">`;
                            else
                                options += `<input type="hidden" class="quantity-trigger" name="trigger-${index_item}" value="">`;

                            options += '</div>'
                            item.data.forEach((option_item, index_option_item) => {
                                if(option_item.price)
                                    option_item.price = option_item.price.replace('$', '');
                                else
                                    option_item.price = 0;
                                options += '<div style="display: flex; padding-bottom: 6px;"><input id="title_'+ index_item +'_'+ index_option_item +'" style="width: 80%; padding-top: 3px; padding-bottom: 3px" type="text" value="' + option_item.tag + (option_item.price ? '(+$' + option_item.price + ')' : '') +'" disabled><input style="width: 20%; padding-top: 3px; padding-bottom: 3px;"  value="0" min="0" type="number" class="option-quantity-class" id="price_' + index_item + '_' + index_option_item + '" onChange="resetProductPrice()"></div>';
                            });
                        }
                        else if(item.type == 'checkbox'){
                            if(item.trigger != 0)
                                options += '<p> Free Trigger: ' + item.trigger + '</p>' ;
                            options += '</div>';
                            options += '<label>' + item.title + '</label>';
                            if(item.trigger != 0 && item.trigger != "" && item.trigger != null )
                                options += `<input type="hidden" class="checkbox-trigger" name="trigger-${index_item}" value="${item.trigger}">`;
                            else
                                options += `<input type="hidden" class="checkbox-trigger" name="trigger-${index_item}" value="">`;
                            item.data.forEach((option_item, index_option_item) => {
                                if(option_item.price)
                                    option_item.price = option_item.price.replace('$', '');
                                else
                                    option_item.price = 0;
                                options += '<div style="display: flex; padding-bottom: 6px; align-items: center;"><input id="title_'+ index_item +'_'+ index_option_item +'" style="width: 85%; padding-top: 3px; padding-bottom: 3px;" type="text" value="' + option_item.tag + (option_item.price ? '(+$' + option_item.price + ')' : '') +'" disabled><input style="width: 15%" value="off" type="checkbox" class="option-checkbox-class" id="checkbox_' + index_item + '_' + index_option_item + '" onChange="checkboxChanged(' +index_item + ',' + index_option_item +')"></div>';
                            });
                        }
                        else{
                            

                            if(item.trigger != 0 && item.trigger != "" && item.trigger != null )
                                options += `<input type="hidden" class="radio-trigger" name="trigger-${index_item}" value="${item.trigger}">`;
                            else
                                options += `<input type="hidden" class="radio-trigger" name="trigger-${index_item}" value="">`;

                            options += '<label>'+ item.title +'</label>' +
                                '<select class="form-control mb-3 select-class" id="groupoption-'+ index_item +'" '+ (item.required ? 'required="required"' : '') +' onchange="resetProductPrice()">' +
                                    '<option value="-1">Choose...</option>';
                                    var radio_data = [];
                                    item.data.forEach((option_item, index_option_item) => {
                                        if (option_item.price)
                                            option_item.price = option_item.price.toString().replace('$', '');
                                        else
                                            option_item.price = 0;
                                        option_item.price = parseFloat(option_item.price).toFixed(2);
                                        radio_data.push(option_item);
                                    });

                                    radio_data.sort((a, b) => a.price - b.price);

                                    radio_data.forEach((option_item, index_option_item) => {
                                        options += '<option value="title_radio_' + index_item + '_' + index_option_item  + '" data-price="'+ (option_item.price ? option_item.price : 0) +'">' + option_item.tag + (option_item.price ? '(+$' + option_item.price + ')' : '') +'</option>'
                                    });
    
                            options += '</select>';
                            if(item.trigger.toString().includes("999")){
                                $("#modalProductDetail").on("change", "#groupoption-" + index_item, function(){
                                    var trigger_nums = item.trigger.toString().split("999");
                                    if($(`#groupoption-${index_item}`).val()){
                                        var val = trigger_nums[parseInt($(`#groupoption-${index_item}`).val().split("_")[3], 10)+1];
                                        console.log(val);
                                        $(`input[name=trigger-${trigger_nums[0]}]`).val(val);
                                    }
                                });
                            }
                        }

                        

                    });
                    
                    $("#modalProductDetail .product-options").html(options);
                    $('#groupoption-0').val('0').trigger('change');
                    if(flg_optionPrice == 1)
                        $('#groupoption-0 option[value=title_radio_0_0]').attr('selected', true);
                    resetProductPrice();
                }
                
                $("#frmProductDetail")[0].reset()
                $("#modalProductDetail").modal('show')
            })
            $('.btn-add-quantity').click(function(){
                quantity_count ++;
                $("#quantity_val").text(`Quantity : ${quantity_count}`);
            })
            $('.btn-reduce-quantity').click(function(){
                if(quantity_count > 1)
                    quantity_count --;
                $("#quantity_val").text(`Quantity : ${quantity_count}`);
            })
            function haversine_distance(mk1, mk2) {
                  var R = 3958.8; // Radius of the Earth in miles
                  var rlat1 = mk1['lat'] * (Math.PI/180); // Convert degrees to radians
                  var rlat2 = mk2['lat'] * (Math.PI/180); // Convert degrees to radians
                  var difflat = rlat2-rlat1; // Radian difference (latitudes)
                  var difflon = (mk2['lng']-mk1['lng']) * (Math.PI/180); // Radian difference (longitudes)
            
                  var d = 2 * R * Math.asin(Math.sqrt(Math.sin(difflat/2)*Math.sin(difflat/2)+Math.cos(rlat1)*Math.cos(rlat2)*Math.sin(difflon/2)*Math.sin(difflon/2)));
                  return d;
            }
            
            $("#frmProductDetail").submit(function(e) {
                
                // var area= [
                //     {lat:40.493737, lng:-74.256403},
                //     {lat:40.574482, lng:-73.668612},
                //     {lat:41.022939, lng:-73.784092},
                //     {lat:40.748805, lng:-74.204438},
                //     {lat:40.624460, lng:-74.279499},
                //     {lat:40.493737, lng:-74.256403}    
                // ];
            //     var area= [
            //         {lat:40.471099, lng:-74.348045},
            //         {lat:41.011810, lng:-74.936990},
            //         {lat:41.494259, lng:-73.874423},
            //         {lat:41.456234, lng:-72.016743},
            //         {lat:40.997582, lng:-71.352535},
            //         {lat:40.115218, lng:-72.925658},
            //         {lat:40.471099, lng:-74.348045}
            //     ];
                
            //     polygon = new google.maps.Polygon({
            // 		path: area,
            // 		geodesic: true,
            // 		strokeColor: '#FFd000',
            // 		strokeOpacity: 1.0,
            // 		strokeWeight: 4,
            // 		fillColor: '#FFd000',
            // 		fillOpacity: 0.35
            // 	});
            	
            // 	var curloc = getCookie("curloc");
            // 	var resloc = new google.maps.LatLng(parseFloat($("res_lat").val()), parseFloat($("res_lng").val()));
            // 	console.log(curloc);
            	
            // 	var relay_key = $("#res_relay").val();
            // 	console.log(relay_key);
            // 	//var order_info = $("res_contact").val();
            // 	var order_info = [];
            // 	if((relay_key == null || relay_key == "") && (order_info == [] || order_info == null)){
            // 	    $("#modalProductDetail").modal('hide')
            // 	    $("#modalNoInfo").modal('show');
            // 	    return;
            // 	}
            	
            // 	if (google.maps.geometry.poly.containsLocation(new google.maps.LatLng(curloc['lat'], curloc['lng']), polygon)){
            //          if($("#delivery_radius").val() == ""){
                         
            //          }
            //     } else {
            //         if($("#delivery_radius").val() == ""){
            //             $("#modalProductDetail").modal('hide')
            //             $("#modalOutArea").modal('show')
            //             return;
            //         }
            //         else{
                        
            //         }
            //         $("#modalProductDetail").modal('hide')
            //         $("#modalOutArea").modal('show')
            //         return;  
            //     };
                e.preventDefault()
                if($("#modalProductDetail .btn-add-cart span").length) return; // Processing
                var sizeWithPriceOpt = 0;
                sizeWithPriceOpt = parseInt($('#sizeWithPrice_id').val()) + 1;
                

                var data = {
                    _token: "{{ csrf_token() }}",
                    restaurant_id: $(this).find('.restaurant-id').val(),
                    menu_id: $(this).find('.menu-id').val(),
                    section_id: $(this).find('.section-id').val(),
                    product_id: $(this).find('.product-id').val(),
                    sizeWithPriceOpt: sizeWithPriceOpt,
                    message: $(this).find('.message').val(),
                    total_price: total_price,
                    quantity_count: quantity_count,
                }
                var options = [];
                $("#modalProductDetail .product-options .select-class").each((index, item) => {
                    if($(item).val() != -1) {
                        var opt_str_arr = $(item).val().split('_');
                        options.push({option_type:'radio', option_id: parseInt(opt_str_arr[2]), option_data_id: parseInt(opt_str_arr[3]), option_count: 0})
                    }
                })
                $(".option-quantity-class").each((index, item) => {
                    if($(item).val() > 0) {
                        var opt_str_arr = $(item)[0].id;
                        opt_str_arr = opt_str_arr.split('_');
                        options.push({option_type:'quantity', option_id: parseInt(opt_str_arr[1]), option_data_id: parseInt(opt_str_arr[2]), option_count: $(item).val()});
                    }
                })
                $(".option-checkbox-class").each((index, item) => {
                    if($(item).val() == "on") {
                        var opt_str_arr = $(item)[0].id;
                        opt_str_arr = opt_str_arr.split('_');
                        options.push({option_type:'checkbox', option_id: parseInt(opt_str_arr[1]), option_data_id: parseInt(opt_str_arr[2]), option_count: 0});
                    }
                })
                Object.assign(data, { options: options});
                
                $("#modalProductDetail .btn-add-cart").prepend('<span class="spinner-border spinner-border-sm mb-1 mr-2" role="status" aria-hidden="true"></span>')
                
                $.ajax({
                    url: '{{ route("app.cart.add-item") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        $("#modalProductDetail .btn-add-cart span").remove()
                        renderCart()
                        $("#modalProductDetail").modal('hide')
                    }
                });
                setTimeout(function(){ 
                $("#modalProductDetail").modal('hide')
            }, 2000);
                
            })
            $("#modalProductDetail .btn-add-cart").click(function(e) {
                var total = $("#modalProductDetail .btn-add-cart").text();
                if(total == 'Add to cart - $0.00'){
                    alert("Please select options");
                    return;
                }
                e.preventDefault()
                $("#frmProductDetail").trigger('submit')
            })

            /* +++++++++++++ Favorite For Menu ++++++++++++++++ */

            $('.restaurent-tags-price .favorite-icon').click(function(){
                if($(this).hasClass('active')) {
                    $(this).removeClass('active');
                    var parent = $(this).parents('.restaurent-product-detail');
                    var menu_id = parent.find('[name=item]').val();
                    $.ajax({
                        url: '{{ route("app.remove-favorite") }}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: menu_id
                        },
                        success: function(result) {

                        },
                        error: function(result) {
                            $(this).addClass('active');
                        }
                    });

                } else {
                    $(this).addClass('active');
                    var parent = $(this).parents('.restaurent-product-detail');
                    var menu_id = parent.find('[name=item]').val();
                    var data_details = parent.data('detail');

                    $.ajax({
                        url: '{{ route("app.add-favorite") }}',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token: "{{ csrf_token() }}",
                            data: JSON.stringify(data_details),
                            type: 'menu',
                            id: menu_id
                        },
                        success: function(result) {
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


            $('.fav-restaurant .favorite-icon').click(function(){
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

            /* End */
        })
    </script>
  <script>
    $('#emptycs').click(function(){
        setTimeout(function(){ 
            window.location.reload();

         }, 1000);
    });
  </script>
@endpush
