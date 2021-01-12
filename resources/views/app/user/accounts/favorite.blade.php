@extends('layouts.app')

@section('title')
    <title>Chekout</title>
@endsection

@section('content')
    <!-- slider -->

<section class="favorite_content">
    
    <section class="ex-collection section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-header-left">
                        <h3 class="text-light-black header-title title">Your Favorites</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 restaurent-tabs u-line">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active text-light-white fw-700" data-toggle="pill"
                                                href="#fav-restaurants">Restaurants</a>
                        </li>
                        <li class="nav-item"><a class="nav-link text-light-white fw-700" data-toggle="pill"
                                                href="#fav-foods">Foods</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-12"> 
                    <br>
                </div>
                <div class="tab-content col-12">
                    <div id="fav-restaurants" class="tab-pane fade in active show">
                        
                        @if(empty($fav_restaurants))
                        <div class = "col-12 text-center">
                            <div class="favorite_body">
                                <img src="{{ asset('img/nofavorite.png') }}" class="img-fluid" alt="food">
                                <h3>No favorites restaurants yet</h3>
                                <span>Restaurants you rate highly will appear hear. </span>
                                <Button id="find_food"><span>Find Restaurants</span></Button>
                            </div>
                        </div>
                        @else

                        <div class = "row">
                            @foreach($fav_restaurants as $restaurant)
                                <?php
                                    $isOpenedRes = false;
                                    $message = "";
                                    $date = time();
                                    $restaurant['hours'] = get_object_vars($restaurant['hours']);
                                    
                                    if($restaurant['hours'][strtolower(date("l"))][0]){
                                        if($restaurant['hours'][strtolower(date("l"))][1]=='null'){
                                            $restaurant['hours'][strtolower(date("l"))] = "11:00";
                                        }

                                        if($restaurant['hours'][strtolower(date("l"))][2]=='null'){
                                            $restaurant['hours'][strtolower(date("l"))] = "21:00";
                                        }

                                        $st_time    =   strtotime($restaurant['hours'][strtolower(date("l"))][1]);
                                        $end_time   =   strtotime($restaurant['hours'][strtolower(date("l"))][2]);
                                        $cur_time   =   strtotime('now');
                                        
                                        if($st_time < $cur_time && $end_time > $cur_time)
                                        {
                                            $isOpenedRes = true;
                                        }
                                        // $isOpenedRes = true;
                                        if($st_time > $cur_time){
                                            $message = 'Open at '.date('g:i A', strtotime($restaurant['hours'][strtolower(date("l"))][1]));
                                        }

                                        if($end_time <= $cur_time){
                                            if($restaurant['hours'][strtolower(date("l", strtotime('tomorrow')))][0]){
                                                if($restaurant['hours'][strtolower(date("l", strtotime('tomorrow')))][1]=='null'){
                                                    $restaurant['hours'][strtolower(date("l"))] = "11:00";
                                                }
    
                                                $message = 'Closed until: Tomorrow '.date('g:i A', strtotime($restaurant['hours'][strtolower(date("l", strtotime('tomorrow')))][1]));
                                                
                                            }else{
                                                for($i=2; $i < 7; $i++){
                                                    if($restaurant['hours'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][0]){
                                                        if($restaurant['hours'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][1]=='null'){
                                                            $restaurant['hours'][strtolower(date("l", strtotime('+'.$i.' day', $date)))] = "11:00";
                                                        }
                                                        $message = 'Closed until: '.date("l", strtotime('+'.$i.' day', $date)).' '.date('g:i A', strtotime($restaurant['hours'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][1]));
                                                        break;
                                                    }
                                                }
                                            }
                                        }
                                        
                                    } else {
                                        if($restaurant['hours'][strtolower(date("l", strtotime('tomorrow')))][0]){
                                            if($restaurant['hours'][strtolower(date("l", strtotime('tomorrow')))][1]=='null'){
                                                $restaurant['hours'][strtolower(date("l"))] = "11:00";
                                            }

                                            $message = 'Closed until: Tomorrow '.date('g:i A', strtotime($restaurant['hours'][strtolower(date("l", strtotime('tomorrow')))][1]));
                                            
                                        }else{
                                            for($i=2; $i < 7; $i++){
                                                if($restaurant['hours'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][0]){
                                                    if($restaurant['hours'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][1]=='null'){
                                                        $restaurant['hours'][strtolower(date("l", strtotime('+'.$i.' day', $date)))] = "11:00";
                                                    }
                                                    $message = 'Closed until: '.date("l", strtotime('+'.$i.' day', $date)).' '.date('g:i A', strtotime($restaurant['hours'][strtolower(date("l", strtotime('+'.$i.' day', $date)))][1]));
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    
                                ?>

                                <div class="col-lg-4 col-md-6 col-sm-6 fav-restaurant-details">
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
                                        
                                        <div class="product-caption">
                                            <p class = "fav-restaurant">
                                                <span class = "fa fa-heart favorite-icon active">
                                                    <input type="hidden" class = "vendorId_for_fav" value="{{$restaurant['vendor_id']}}">
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
                                                        class="text-light-white time">{{$restaurant['address'] ?? '' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @endif
                


                    </div>
                    <div id="fav-foods" class="tab-pane fade">
                        
                        @if(empty($fav_foods))
                        <div class = "col-12 text-center">
                            <div class="favorite_body">
                                <img src="{{ asset('img/nofavorite.png') }}" class="img-fluid" alt="food">
                                <h3>No favorites foods yet</h3>
                                <span>Restaurants you rate highly will appear hear. </span>
                                <Button id="find_food"><span>Find Foods</span></Button>
                            </div>
                        </div>
                        @else
                        
                        <div class = "row">
                            @foreach($fav_foods as $food)
                            <div class = "col-lg-6 fav-food-details">
                                <div class="restaurent-product-list">
                                    <div class="restaurent-product-detail" data-detail="{{ json_encode($food)}}">
                                        <div class="restaurent-product-left">
                                            <div class="restaurent-product-title-box">
                                                <div class="restaurent-product-box">
                                                    <div class="restaurent-product-title">
                                                        <h5 class="mb-2" data-toggle="modal" data-target="#restaurent-popup">
                                                            <a href="javascript:void(0)"
                                                                class="text-light-black fw-600">{{ $food['name'] ?? ''}}</a>
                                                        </h5>
                                                    </div>
                                                    <div class="restaurent-product-label"></div>
                                                </div>
                                                <div class="restaurent-product-rating"></div>
                                            </div>
                                            <div class="restaurent-product-caption-box text-light-white limit-line-3 w-100">
                                                {{ $food['description'] ?? '' }}
                                            </div>
                                            @if(!( $food['price']))
                                                @if(! ($food['sizeWithPrice']))
                                                    <p class="font-weight-bold m-0 mt-2"></p>
                                                @else
                                                    <?php $price = $food['sizeWithPrice'][0]->price; $price_size = $food['sizeWithPrice'][0]->size;?>
                                                    @foreach($food['sizeWithPrice'] as $sizeWithPrice)
                                                        @if($price > $sizeWithPrice->price)
                                                            <?php
                                                                $price = $sizeWithPrice->price;
                                                                $price_size = $sizeWithPrice->size;
                                                            ?>
                                                        @endif
                                                    @endforeach
                                                    <p class="font-weight-bold m-0 mt-2">{{$price_size}}: &nbsp;&nbsp;${{$price}}</p>
                                                @endif
                                            @elseif(is_numeric( $food['price'] ))
                                                <p class="font-weight-bold m-0 mt-2">${{ $food['price'] ?? 0 }}</p>
                                            @else
                                                <?php $price = str_replace('$', '', $food['price']) ?>
                                                <p class="font-weight-bold m-0 mt-2">${{ $price ?? 0 }}</p>
                                            @endif
                                            <form
                                                action="{{ route('app.cart.add-item', ['restaurantId' => $food['restaurant_id'], 'id' => $food['id']]) }}"
                                                class="add-to-cart-form" method="post">
                                                @csrf
                                                <input type="hidden" name="item" value="{{$food['id']}}">
                                            </form>
                                            <div
                                                class="restaurent-product-price">
                                            </div>
                                            <div class="restaurent-tags-price">
                                                <div class="restaurent-tags">
                                                </div>

                                                <span class = "fa fa-heart favorite-icon fav-icon active"></span>
                                            </div>
                                        </div>
                                        <div
                                            class="restaurent-product-img">
                                            @if(isset($food['photo']))
                                                <img
                                                    src="{{ $food['photo']}}"
                                                    class="img-fluid"
                                                    alt="#">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </section>

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
            <div class="modal-footer border-0 pt-0">
                <button class="btn btn-block btn-add-cart">Add to cart</button>
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

    <script>
        $(".favorite_body").on("click", "#find_food", function() {
            window.location.href = "{{route('home')}}"
        });

        $('.fav-restaurant .favorite-icon').click(function(){
            if($(this).hasClass('active')) {
                $(this).removeClass('active');
                var vendor_id = $(this).children('.vendorId_for_fav').val();
                var parent = $(this).parents('.fav-restaurant-details');
                $.ajax({
                    url: '{{ route("app.remove-favorite") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: vendor_id
                    },
                    success: function(result) {
                        parent.remove();    
                    },
                    error: function(result) {
                        $(this).addClass('active');
                    }
                });

            }    
        }); 

        $('.restaurent-tags-price .favorite-icon').click(function(){
            if($(this).hasClass('active')) {
                $(this).removeClass('active');
                var parent = $(this).parents('.fav-food-details');
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
                        parent.remove();
                    },
                    error: function(result) {
                        $(this).addClass('active');
                    }
                });

            }
        });



        let product;
        let extra_option_price = 0;
        $(document).ready(function () {

            $(document).on('submit', '.add-to-cart-form', function (e) {
                e.preventDefault();
                var form = $(e.target);
                console.log(form.attr('action'));
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
                console.log(item);
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
            console.log(total);
            $("#modalProductDetail .btn-add-cart").text('Add to cart - $' + parseFloat(total).toFixed(2))
        }
        const resetProductPrice = () => {
            var total = $("#modalProductDetail .btn-add-cart").data('price');
            extra_option_price = 0;
            $("#modalProductDetail .product-options .select-class option:selected").each((index, item) => {
                if(extraPrice = $(item).data('price')) {
                    extra_option_price = extra_option_price + parseFloat(extraPrice);
                }
            })
            $(".option-quantity-class").each((index, item) => {
                if($(item).val() > 0) {
                    
                    var opt_str_arr = $(item)[0].id;
                    opt_str_arr = opt_str_arr.split('_');
                    var product_ext_opt = product.extraOption[parseInt(opt_str_arr[1])].data[parseInt(opt_str_arr[2])];
                    // options.push({option_type:'quantity', option_id: parseInt(opt_str_arr[1]), option_data_id: parseInt(opt_str_arr[2]), option_count: $(item).val()});
                    var cnt = $(`#price_${parseInt(opt_str_arr[1])}_${parseInt(opt_str_arr[2])}`).val();
                    extra_option_price = extra_option_price + parseFloat(product_ext_opt.price * cnt);
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
            
            total = parseFloat(total) + extra_option_price;
            $("#modalProductDetail .btn-add-cart").text('Add to cart - $' + parseFloat(total).toFixed(2))
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
                let options = '';
                var flg_priceWithSize = 0;
                if($(e.target).hasClass('fav-icon')) {
                    return false;
                }
                
                product = $(this).data('detail');
                
                if(product.price)
                    product.price = product.price.replace('$', '');
                if(isNaN(product.price) || product.price == null ) {
                    if(product.sizeWithPrice == null)
                    {
                        // if(product.extraOption.length == 0){
                        //     $("#modalTemporaryProduct").modal('show')
                        //     return;
                        // }
                        $("#modalTemporaryProduct").modal('show')
                            return;
                    }
                    else
                    {
                        flg_priceWithSize = 1;
                        var price = product.sizeWithPrice[0].price;
                        var price_size = product.sizeWithPrice[0].size;
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
                        
                        $("#modalProductDetail .product-price").text(`Price: $ ${price ? price : 0}`)
                        $("#modalProductDetail .btn-add-cart").data('price', (price ? price : 0))
                        $("#modalProductDetail .btn-add-cart").text('Add to cart - $' + (price ? price : 0))
                    }
                }
                // if(product.price == null && product.extraOption.length == 0) {
                //     $("#modalTemporaryProduct").modal('show')
                //     return;
                // }
                
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
                if(flg_priceWithSize == 0){
                    $("#modalProductDetail .product-price").text(`Price: $ ${product.price ? product.price : 0}`)
                    $("#modalProductDetail .btn-add-cart").data('price', (product.price ? product.price : 0))
                    $("#modalProductDetail .btn-add-cart").text('Add to cart - $' + (product.price ? product.price : 0))
                }
                
                
                    
                if(product.extraOption) {
                    product.extraOption.forEach((item, index_item) => {
                        if(item.type == 'quantity')
                        {
                            options += '<label>' + item.title + '</label>';
                            item.data.forEach((option_item, index_option_item) => {
                                if(option_item.price)
                                    option_item.price = option_item.price.replace('$', '');
                                else
                                    option_item.price = 0;
                                options += '<div style="display: flex; padding-bottom: 6px;"><input id="title_'+ index_item +'_'+ index_option_item +'" style="width: 80%; padding-top: 3px; padding-bottom: 3px" type="text" value="' + option_item.tag + (option_item.price ? '(+$' + option_item.price + ')' : '') +'" disabled><input style="width: 20%; padding-top: 3px; padding-bottom: 3px;"  value="0" min="0" type="number" class="option-quantity-class" id="price_' + index_item + '_' + index_option_item + '" onChange="resetProductPrice()"></div>';
                            });
                        }
                        else if(item.type == 'checkbox'){
                            options += '<label>' + item.title + '</label>';
                            item.data.forEach((option_item, index_option_item) => {
                                if(option_item.price)
                                    option_item.price = option_item.price.replace('$', '');
                                else
                                    option_item.price = 0;
                                options += '<div style="display: flex; padding-bottom: 6px; align-items: center;"><input id="title_'+ index_item +'_'+ index_option_item +'" style="width: 85%; padding-top: 3px; padding-bottom: 3px;" type="text" value="' + option_item.tag + (option_item.price ? '(+$' + option_item.price + ')' : '') +'" disabled><input style="width: 15%" value="off" type="checkbox" class="option-checkbox-class" id="checkbox_' + index_item + '_' + index_option_item + '" onChange="checkboxChanged(' +index_item + ',' + index_option_item +')"></div>';
                            });
                        }
                        else{
                            options += '<label>'+ item.title +'</label>' +
                                '<select class="form-control mb-3 select-class" '+ (item.required ? 'required="required"' : '') +' onchange="resetProductPrice()">' +
                                    '<option value="0">Choose...</option>';
    
                                    item.data.forEach((option_item, index_option_item) => {
                                        if (option_item.price)
                                            option_item.price = option_item.price.replace('$', '');
                                        else
                                            option_item.price = 0;
                                        options += '<option value="title_radio_' + index_item + '_' + index_option_item  + '" data-price="'+ (option_item.price ? option_item.price : 0) +'">' + option_item.tag + (option_item.price ? '(+$' + option_item.price + ')' : '') +'</option>'
                                    });
    
                            options += '</select>';
                        }
                    });
                    
                    $("#modalProductDetail .product-options").html(options);
                }
                
                $("#frmProductDetail")[0].reset()
                $("#modalProductDetail").modal('show')
            })
            
            
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
                console.log(sizeWithPriceOpt);
                var data = {
                    _token: "{{ csrf_token() }}",
                    restaurant_id: $(this).find('.restaurant-id').val(),
                    menu_id: $(this).find('.menu-id').val(),
                    section_id: $(this).find('.section-id').val(),
                    product_id: $(this).find('.product-id').val(),
                    sizeWithPriceOpt: sizeWithPriceOpt,
                    message: $(this).find('.message').val()
                }
                var options = [];
                $("")
                $("#modalProductDetail .product-options .select-class").each((index, item) => {
                    if($(item).val() != 0) {
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
                console.log(data);
                
                $("#modalProductDetail .btn-add-cart").prepend('<span class="spinner-border spinner-border-sm mb-1 mr-2" role="status" aria-hidden="true"></span>')
                
                $.ajax({
                    url: '{{ route("app.cart.add-item") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        console.log(result);
                        $("#modalProductDetail .btn-add-cart span").remove()
                        renderCart()
                        $("#modalProductDetail").modal('hide')
                    }
                });
            })
            $("#modalProductDetail .btn-add-cart").click(function(e) {
                var total = $("#modalProductDetail .btn-add-cart").text();
                if(total == 'Add to cart - $0'){
                    alert("Please select options");
                    return;
                }
                e.preventDefault()
                $("#frmProductDetail").trigger('submit')
            });
        });
    </script>
@endpush

