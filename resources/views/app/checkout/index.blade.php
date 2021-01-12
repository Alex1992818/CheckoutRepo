@extends('layouts.app')

@section('title')
    <title>Chekout</title>
  
@endsection

@section('content')
<style>
    #apple-pay-button {
  
      background-color: black;
      background-image: -webkit-named-image(apple-pay-logo-white);
      background-size: 100% 100%;
      background-origin: content-box;
      background-repeat: no-repeat;
      width: 30%;
      height: 44px;
      padding: 10px 0;
      border-radius: 10px;
    }
  </style>
    <section class="final-order section-padding bg-light-theme">
        <div class="container-fluid">
            @if($cartStatus)
                @if($errors->any())
                    <div class="col-lg-7">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                @if(session()->has('message'))
                    <div class="col-lg-7">
                        <div class="alert alert-info">
                            {{session('message')}}
                        </div>
                    </div>
                @endif
                <form class="row" id="form" action="{{ route('app.checkout.submit') }}" method="POST">
                    @csrf
                    <div class="col-lg-7">
                        <div class="main-box padding-20">
                            <div class="row mb-xl-20">
                                <div class="col-12">
                                    <div class="section-header-left">
                                        @if ((session()->get('mode')) == 'delivery')
                                        <h3 class="text-light-black header-title">Review and place order for <b>Delivery</b></h3>
                                        @else
                                        <h3 class="text-light-black header-title">Review and place order for <b>TakeOut</b></h3>
                                        @endif
                                    </div>
                                    <h6 class="text-light-black fw-700 fs-14">Review address and payments before
                                        completing your purchase</h6>
                                    
                                    <br>
                                    <div class="section-header-left col-12">
                                        <h4 class="text-light-black" style="margin-bottom: 0px">Your Info</h4>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <h6>
                                            <a href="#" class="delivery-add-1 p-relative"> <span class="icon"><i
                                                        class="fa fa-user"></i></span>
                                                <span>Your Name <small>(required)</small></span>
                                            </a>
                                            <div class="location-picker-1">
                                            <input type="text" class="form-control" name="customer_name"
                                                       id="customer_name"
                                                       placeholder="Your Name" value="{{ $customerName ?? '' }}" required>                                            </div>
                                        </h6>
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <h6>
                                            <a href="#" class="delivery-add-1 p-relative"> <span class="icon"><i
                                                        class="fa fa-phone"></i></span>
                                                <span>Phone Number <small>(required)</small></span>
                                            </a>
                                            <div class="location-picker-1">
                                            <input type="text" class="form-control" name="customer_phone"
                                                       placeholder="Phone Number" value="{{ $customerPhone ?? '' }}" required>                                            </div>
                                        </h6>
                                    </div>
                                    @if ((session()->get('mode')) == 'delivery')
                                        <div class="col-md-8 col-12"><br>
                                        <input type="hidden" class="form-control" id="address" name="address"
                                                       value="{{ $add ?? '' }}">
                                        <input type="hidden" class="form-control" id="address1" name="address1"
                                                       value="{{ $add ?? '' }}">
                                        <input type="hidden" class="form-control" id="city" name="city"
                                                            value="{{ $customerAddress->city ?? '' }}" >
                                        <input type="hidden" class="form-control" id="state" name="state"
                                                           value="New York">
                                        <input type="hidden" class="form-control" id="zip" name="zip"
                                                    value="{{ $customerAddress->zip ?? '' }}">
                                        <input type="hidden" class="form-control" id="address_id" name="address_id"
                                                    value="{{ $customerAddress->id ?? '' }}">

                                        </div>
                                        <div class="col-md-8 col-12">
                                            <h6>
                                                <a href="#" class="delivery-add-1 p-relative"> <span class="icon"><i
                                                            class="fas fa-map-marker-alt"></i></span>
                                                    <span>Select your address</span>
                                                </a>
                                                <div class="location-picker-1">
                                                <select class="custom-select" id="selectbox">
                                                    <!--<option selected>Choose...Saved Address</option>-->
                                                    <option value="add-new-address" style="color: #FF8D00; font-weight: 600">Add New Address</option>
                                                    @foreach($addresses as $address)
                                                    <option value="{{ $address['address_id'] }}" id="str-{{ $address['address_id'] }}" custom1="{{ $address['title1'] ?? ''}}" custom2="{{ $address['line1'] ?? ''}}" custom3="{{ $address['line2'] ?? ''}}" custom4="{{ $address['state'] ?? ''}}" custom5="{{ $address['city'] ?? ''}}" custom6="{{ $address['zip'] ?? ''}}">{{$address['line1']??''}} {{$address['city']??''}} {{$address['state']??''}} {{$address['zip']??''}}</option>
                                                    @endforeach
                                                    

                                                    </select>
                                                </div>
                                            </h6>
                                        </div>
                                   

                                        <div class="col-md-8 col-12 new-address" style="display: none">
                                        <h6>
                                            <a href="#" class="delivery-add-1 p-relative"> <span class="icon"><i
                                                        class="fas fa-map-marker-alt"></i></span>
                                                <span>Enter your address</span>
                                            </a>
                                            <div class="location-picker-1">
                                                <input type="text" class="form-control" placeholder="Enter a new address" id="searchInput-1" autocomplete="false" >
                                            </div>
                                        </h6>
                                        </div>

                                       

                                        <div class="col-md-8 col-12">
                                        <h6>
                                            <a href="#" class="delivery-add-1 p-relative"> <span class="icon"><i
                                                        class="fa fa-building"></i></span>
                                                <span>Apartment No.</span>
                                            </a>
                                            <input type="text" class="form-control" id="address2" name="address2"
                                                    placeholder="Apartment No."
                                                    value="{{ $customerAddress->address2 ?? '' }}" required>
                                        </h6>
                                        </div>

                                    
                                    @endif

                                </div>
                            </div>
                            <div class="col-md-8 col-12">
                                
                                <div class="payment-sec">
                                    <div class="section-header-left">
                                        <h4 class="text-light-black" style="margin-bottom: 0px">Delivery Instructions</h4>
                                    </div>
                                    <div class="form-group">
                                    <textarea class="form-control form-control-submit" rows="4"
                                                placeholder="Delivery Details"
                                                name="delivery_instructions"></textarea>
                                    </div>
                                    <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                    <label style="font-size: 16px">Tip: $</label><input type="number" value="0" min="0" name="tip" id="tip" style="width: 100px; height: 15px">
                                            </div>
                                            @if(session()->get('mode') == "delivery")
                                        
                                            <div class="col-lg-9 col-md-6" style="padding-top: 10px">
                                                <input type="checkbox" class="form-check-input" value="1" id="rush" name="rush" style="width: 500px;height: 15px;">
                                                <label class="form-check-label" for="rush" style="font-size: 16px">Rush this order for $3 more</label>
                                            </div>        
                                            @endif
                                            
                                    </div>
                                    <br>

                                    <div class="section-header-left">
                                        <h4 class="text-light-black"  style="margin-bottom: 0px">Payment information</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div id="accordion">
                                            <div class="card-list" style="{{ $cards->count()==0 ? 'display: none' : '' }}">
                                                                <select name="selectedCard" class="form-control form-control" style = "text-align: justify; text-align-last: justify">
                                                                    @foreach($cards as $card)
                                                                        <option value="{{ $card['card']['id'] }}" style="color:grey">&#128179;{{ $card['card']['brand'] }} **** {{ $card['card']['last4'] }}   &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;&nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; {{ $card['card']['exp_month'] }}/{{ $card['card']['exp_year'] }} &nbsp;</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="row mb-4"
                                                                    style="{{ $cards->count()>0 ? 'display: none' : '' }}"
                                                                    id="addstripe">
                                                                <div class="col-md-6 col-12">
                                                                    <div class="form-group">
                                                                        <label for="card-element">Cardholder
                                                                            Name</label>
                                                                        <input type="text" id="cardholder-name"
                                                                                class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <label for="card-element">Card</label>
                                                                    <div id="card-element" style="margin-top: 2px; padding-top: 8px"
                                                                            class="form-control"></div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="cardselect"
                                                                    value="{{ $cards->count() > 0 ? 'existing' : 'new' }}"
                                                                    id="cardselect">
                                                            <br>
                                                            <div class="form-group">
                                                                <button type="button" id="submit-order"
                                                                        class="btn-first green-btn text-custom-white full-width fw-500">
                                                                    Place Your Order
                                                                </button>
                                                                <!-- <br><br>
                                                                <button type="button" id="temporary-order"
                                                                        class="btn btn-info full-width">
                                                                    Temporary
                                                                </button> -->
                                                            </div>
                                                            <p class="text-center text-light-black no-margin">By
                                                                placing
                                                                your order, you agree to Chekout <a href="#">terms
                                                                    of
                                                                    </a> and <a href="#">privacy agreement</a>
                                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="card order-detail-box">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-3 res-image">
                                        <img src="{{ asset('img/cart.png') }}" alt="res-image">
                                    </div>

                                    <div class="col-9">
                                        <div class="title fw-700">Your orders</div>
                                        <div class="res-name"></div>
                                        <div class="res-address"></div>
                                        <div class="action-box">
                                                <a href='#' class='res-back'><span class="btn-success"> Add more items </span></a>
                                        
                                                <a href='#' class='empty-cart'><span class="btn-danger"> Empty Cart </span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-body">

                                <div class="padding-15 fw-600 cart-summary">
                                    <div class="option item-total">
                                        <div class="name">Subtotal:</div>
                                        <div class="price">$0.00</div>
                                    </div>
                                    <div class="option delivery-fee fw-600">
                                        <div class="name">Delivery free:</div>
                                        <div class="price">Free</div>
                                    </div>
                                    <div class="option tax-fee text-dark-white fw-600">
                                        <div class="name">Taxes & Fees <button type="button" class="tax-info" onclick="openTaxInfo()"><i class="fas fa-info-circle"></i></button></div>
                                        <div class="price">$0.00</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer p-0 modify-order">
                                <div class="option total-amount text-custom-white fw-700">
                                    <div class="name">Total</div>
                                    <div class="price">$0.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- <div id="container">
  


   
   
   
   
   
                </div>
                <br>
                <br>
                <button id="apple-pay-button"></button> -->
            @else
                <div class="row">
                    <div class="col-lg-8 offset-2">
                        <div class="main-box padding-20 text-center">
                            <h3 clas="text-light-black header-title fw-700">Your cart is empty. Find something
                                satisfying.</h3>
                        </div>
                    </div>
                </div>
                <section class="browse-cat u-line section-padding">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-header-left">
                                    <h3 class="text-light-black header-title title">Browse by cuisine <span
                                            class="fs-14">
                                    {{--                                            <a href="restaurant.html">See all restaurants</a></span></h3>--}}
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
                                                <span class="text-light-black cat-name">{{ $category['title'] }}</span>
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
                
            @endif
           
            <div id="message" style="margin:60px"></div>
        </div>
    </section>
    <div class="modal" tabindex="-1" role="dialog" id="taxes">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Taxes & Fees</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="sales-tax">Sales tax: $0</p>
                    <p class="service-fee"> Service fee: $0 </p>
                    <p><small>Happy Holidays, Free Delivery all of December</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
   
@endsection

@push('scripts')
<script async
src="https://pay.google.com/gp/p/js/pay.js"
onload="onGooglePayLoaded()"></script>
<script> 
    const baseRequest = {
      apiVersion: 2,
      apiVersionMinor: 0
    };
     
    const allowedCardNetworks = ["AMEX", "DISCOVER", "INTERAC", "JCB", "MASTERCARD", "VISA"];
     
    const allowedCardAuthMethods = ["PAN_ONLY", "CRYPTOGRAM_3DS"];
     
    const tokenizationSpecification = {
      type: 'PAYMENT_GATEWAY',
      parameters: {
        'gateway': 'example',
        'gatewayMerchantId': 'exampleGatewayMerchantId'
      }
    };
     
    const baseCardPaymentMethod = {
      type: 'CARD',
      parameters: {
        allowedAuthMethods: allowedCardAuthMethods,
        allowedCardNetworks: allowedCardNetworks
      }
    }; 
    const cardPaymentMethod = Object.assign(
      {},
      baseCardPaymentMethod,
      {
        tokenizationSpecification: tokenizationSpecification
      }
    );
     
    let paymentsClient = null;
     
    function getGoogleIsReadyToPayRequest() {
      return Object.assign(
          {},
          baseRequest,
          {
            allowedPaymentMethods: [baseCardPaymentMethod]
          }
      );
    } 
    function getGooglePaymentDataRequest() {
      const paymentDataRequest = Object.assign({}, baseRequest);
      paymentDataRequest.allowedPaymentMethods = [cardPaymentMethod];
      paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
      paymentDataRequest.merchantInfo = {
         merchantName: 'Example Merchant'
      };
      return paymentDataRequest;
    }
    
     
    function getGooglePaymentsClient() {
      if ( paymentsClient === null ) {
        paymentsClient = new google.payments.api.PaymentsClient({environment: 'TEST'});
      }
      return paymentsClient;
    } 
    function onGooglePayLoaded() {
      const paymentsClient = getGooglePaymentsClient();
      paymentsClient.isReadyToPay(getGoogleIsReadyToPayRequest())
          .then(function(response) {
            if (response.result) {
              addGooglePayButton();
              }
          })
          .catch(function(err) {
              
          });
    }
    
     
    function addGooglePayButton() {
      const paymentsClient = getGooglePaymentsClient();
      const button =
          paymentsClient.createButton({onClick: onGooglePaymentButtonClicked});
      document.getElementById('container').appendChild(button);
    }
     
    function getGoogleTransactionInfo() {
      return {
        countryCode: 'US',
        currencyCode: 'USD',
        totalPriceStatus: 'FINAL',
        
        totalPrice: '{{$totalprice}}'
      };
    }
     
    function prefetchGooglePaymentData() {
      const paymentDataRequest = getGooglePaymentDataRequest(); 
      paymentDataRequest.transactionInfo = {
        totalPriceStatus: 'NOT_CURRENTLY_KNOWN',
        currencyCode: 'USD'
      };
      const paymentsClient = getGooglePaymentsClient();
      paymentsClient.prefetchPaymentData(paymentDataRequest);
    }
     
    function onGooglePaymentButtonClicked() {
      const paymentDataRequest = getGooglePaymentDataRequest();
      paymentDataRequest.transactionInfo = getGoogleTransactionInfo();
       //console.log(paymentDataRequest.transactionInfo);
      const paymentsClient = getGooglePaymentsClient();
      paymentsClient.loadPaymentData(paymentDataRequest)
          .then(function(paymentData) {
              processPayment(paymentData);
            // handle the response
            py=paymentData.paymentMethodData.tokenizationData.token;
            lastfourdt=paymentData.paymentMethodData.info.cardDetails;
            cardNetworks=paymentData.paymentMethodData.info.cardNetwork;
            var form = $('#form');
            form.append('<input name="paymentmethodtype" type="hidden" value="1">');
            form.append('<input name="paymentmethodtoken" type="hidden" value="'+py+'">');
            form.append('<input name="cardfourdigit" type="hidden" value="'+lastfourdt+'">');
            form.append('<input name="cardnetwork" type="hidden" value="'+cardNetworks+'">');
            form.append('<input name="paymenttypes" type="hidden" value="Google Pay">');
            form.submit();
         
            console.log(paymentDataRequest.transactionInfo);
            console.log(paymentDataRequest.transactionInfo.totalPrice);
            console.log(paymentData);
          })
          .catch(function(err) {
            // show error in developer console for debugging
            console.error(err);
          });
    }
     
    function processPayment(paymentData) {
        paymentToken = paymentData.paymentMethodData.tokenizationData.token;
        //console.log(paymentToken);
    }
</script>

    <script src="https://js.stripe.com/v3/"></script>
    <script>
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

        var current_address = getCookie("totaladdress");
        current_address = current_address.replaceAll(', USA', '').replaceAll(', ', ',');
        $('#address').val(current_address);
        if(current_address != ""){
            var current_address_details = current_address.split(',');
            var current_address_line1 = current_address_details[0];
            var current_address_city = current_address_details[1];
            var current_address_state = current_address_details[2].split(' ')[0];
            var current_address_zip = current_address_details[2].split(' ')[1];
            $('#address1').val(current_address_line1);
            $('#city').val(current_address_city);
            $('#state').val(current_address_state);
            $('#zip').val(current_address_zip);
            $("#selectbox").prepend(`<option value='current-address' id='str-current-address' custom2='${current_address_line1}' custom4='${current_address_state}' custom5='${current_address_city}' custom6='${current_address_zip}'  selected>${current_address}</option>`);
        }
        const removeCheckoutCartItem = (product_id) => {
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
                    renderCheckoutCart()
                }
            })
        }
        const renderCheckoutCart = () => {
            $.ajax({
                url: '{{ route("app.cart.get-data") }}',
                type: 'GET',
                dataType: 'json',
                success: function(result) {
                    if(Object.keys(result).length) {
                        $(".order-detail-box .item-total").removeClass('d-none')
                        $(".order-detail-box .no-items").addClass('d-none')
                    } else {
                        $(".order-detail-box .item-total").addClass('d-none')
                        $(".order-detail-box .no-items").removeClass('d-none')
                    }

                    $(".order-detail-box .card-body .row").remove();

                    var list = '';
                    var total_price = 0;
                    var res_name = '';
                    var res_address = '';
                    var res_id = '';
                    var res_photo = '';

                    for (const [key, item] of Object.entries(result)) {
                        res_name = item.res_name;
                        res_address = item.res_addr;
                        res_id = item.vendor;
                        res_photo = item.res_photo;
                        list += '<div class="row">'

                        // item image part
                        list += '<div class="col-2 item-image">'

                        if(item.photo){
                            list += '<img src="' + item.photo + '" alt="item-image">';
                        }                        

                        list += '</div>'

                        list += '<div class="cat-product-box border-bottom col-10">' +
                            '<div class="cat-product pb-1">' +
                            '<div class="d-flex justify-content-between">' +
                            '<div class="cat-name text-dark fw-700">' +
                            '<span class="text-dark-white mr-2">' + item.quantity + ' ×</span>' +
                            item.name +
                            '</div>' +
                            '<div class="price fw-700 ml-2">$' + parseFloat(item.item_price).toFixed(2) + '&nbsp;&nbsp; <span class="fa fa-minus-circle text-danger" style="cursor: pointer; font-size: 18px" onclick="removeCheckoutCartItem(\'' + item.id + '\')"></snan></div>' +
                            '</div>' +
                            '<div class="item-options ml-4">';
                        item.options.forEach(function(option) {
                            list += '<div class="option">' +
                                '<div class="name limit-line-2 text-light-white">•' + option.name + '</div>';
                            if(!isNaN(option.price) && option.price != null && option.price)
                                list += '<div class="price ml-2">+$' + option.price + '</div>';
                            list += '</div>';
                        })
                        list += '</div>'+
                            '<div class="message text-light-white ml-3">' + (item.message === null ? '':item.message) + '</div>'+
                            '</div>' +
                            '</div>';

                        list += '</div>'
                        total_price = parseFloat(total_price) + parseFloat(item.total_price)
                    }

                    
                    $(".order-detail-box .res-name").text(res_name);
                    $(".order-detail-box .res-address").text(res_address);
                    if(res_photo)
                        $(".order-detail-box .res-image img").attr('src', res_photo);
                    else
                        $(".order-detail-box .res-image img").attr('src', '{{ asset("img/cart.png") }}');

                    if(res_id){
                        var res_url = "{{route('app.restaurant.show', ['id' => 'res_id'])}}";
                        res_url = res_url.replace('res_id', res_id);
                        $(".order-detail-box .res-back").attr('href', res_url);
                    }
                    
                    $(".order-detail-box .cat-product-box").remove();
                    $(".order-detail-box .card-body").prepend(list);
                    $(".order-detail-box .item-total .price").text('$' + total_price.toFixed(2))
                    
                    // @if (session()->get('mode') == 'delivery')
                    //     $(".delivery-fee").text("Delivery fee: $" + (total_price / 10).toFixed(2) + " (10 %)" ) 
                    // @endif
                    
                    var tax = (total_price * '{{$taxRate ?? 0}}');
                    var service_fee = (total_price * '{{$feeRate ?? 0}}');
                    $(".order-detail-box .tax-fee .price").text('$' + ( parseFloat(tax) + parseFloat(service_fee) ).toFixed(2))
                    $("#taxes .sales-tax").text('Sales Tax: $' + tax.toFixed(2))
                    $("#taxes .service-fee").text('Service Fee: $' + service_fee.toFixed(2))
                    $(".order-detail-box .total-amount .price").text('$' + (parseFloat(total_price) + parseFloat(tax) + parseFloat(service_fee)).toFixed(2))
                    
                    @if (session()->get('mode') == 'delivery')
                        $(".order-detail-box .total-amount .price").text('$' + (parseFloat(total_price) + parseFloat(tax) + parseFloat(service_fee)).toFixed(2))
                    @endif
                }
            });
        }
        $(function() {
            setTimeout(() => {
                renderCheckoutCart();
            }, 1500);
            
            var address = getCookie("totaladdress");
            
            // if (address == "") {
            //     $("#user_address").val(getCookie("setuplocation"));    
            // }
            // else{
            //     $("#user_address").val(address);
            // }

            $(".action-box .empty-cart").click(function(){
                emptyCart();
                url = $(".action-box .res-back").attr("href");
                setTimeout(function(){ 
                              window.location.href =url;
                         }, 1000);
                     
            });
            
        })
        // Todo: Need the actual stripe id
        if ({{$cartStatus ? 'true' : 'false'}} == true)
        {
            
            var stripe = Stripe('{{ env('STRIPE_TOKEN') }}');
            var elements = stripe.elements();
            var cardElement = elements.create('card');
            cardElement.mount('#card-element');
            cardElement.on('change', function (event) {
                
                if (event.complete) {
                    $('#submit-order').attr('disabled', false);
                } else if (event.error) {
                    $('#submit-order').attr('disabled', 'disabled');
                    // show validation to customer
                }
            });

            /*  Relay Checker temporary begin */

            $('#temporary-order').click(function() {
                var form = $('#form');
                form.append('<input name="isTemporary" type="hidden" value="YES" >');
                form.submit();
            });

            /*  Relay Checker temporary end */


            $('#submit-order').on('click', function () {
                // Todo: Validate cardholder name;
                // Todo: Check if existing or new is set before doing the validation stuff;
                if ($('#cardselect').val() == 'new') {
                    // Todo: Get the cardholder details and set them here (billing details) validate them first?
                    var cardholder = $('#customer_name').val();
                    stripe.createToken(cardElement).then(function (result) {
                        if (result.error) {
                            // Inform the customer that there was an error.
                            var errorElement = document.getElementById('card-errors');
                            errorElement.textContent = result.error.message;
                        } else {
                            // Send the token to your server.
                            var paymentMethodId = result.token.id;
                            var lastfour = result.token.card.last4;
                            var form = $('#form');
                            form.append('<input name="paymentmethod" type="hidden" value="' + paymentMethodId + '">');
                      
                            form.append('<input name="lastfour" type="hidden" value="' + lastfour + '">');
                            form.append('<input name="paymenttypes" type="hidden" value="Stripe">');
                            form.append('<input name="fulltoken" type="hidden" value=' + btoa(JSON.stringify(result.token)) + '">');
                            form.submit();
                        }
                    });
                } else {
                    var form = $('#form');
                    form.submit();
                }
            });
            $('#addstripebutton').on('click', function (e) {
                // Todo: make a hidden input that says existing or new
                $('#addstripe').toggle();
                if ($('#addstripe').is(':visible')) {
                    $(e.target).text('Use Existing Card');
                    $('#cardselect').val('new');
                    $('#submit-order').attr('disabled', false);
                } else {
                    $(e.target).text('Add New Card')
                    $('#cardselect').val('existing');
                }
            })
        }
        const openTaxInfo = () => {
            $('#taxes').modal('show');
        }
    </script>
    <script>
$( "#selectbox" )
  .change(function () {
    var str = "";
       lm=$(this).val();
       if(lm == "add-new-address"){
            $(".new-address").slideDown();
            $('#address1').val('');
            $('#address2').val('');
            $('#city').val('');
            $('#state').val('');
            $('#zip').val('');
            $('#address_id').val('new-address');
           return;
       }else{
           $(".new-address").slideUp();
       }
      address=$('#str-'+lm).attr('custom2');
      address2=$('#str-'+lm).attr('custom3');
      state=$('#str-'+lm).attr('custom4');
      city=$('#str-'+lm).attr('custom5');
      zip=$('#str-'+lm).attr('custom6');
      $('#address1').val(address);
      $('#address2').val(address2);
      $('#city').val(city);
      $('#state').val(state);
      $('#zip').val(zip);
      $('#address_id').val(lm);
  })
</script>
<script>
    $(function() {
            var inputa = document.getElementById('searchInput-1');
            var autocompletea = new google.maps.places.Autocomplete(inputa);
            autocompletea.addListener('place_changed', function() {
                var placea = autocompletea.getPlace();
                var valff = placea.formatted_address.split(',');
                $("#searchInput-1").val(placea.formatted_address.replaceAll(', USA', '')).replaceAll(', ', ',');
                var autoAddr = placea.formatted_address.replaceAll(', USA', '').replaceAll(', ', ',').toString();
                try{
                    var autoAddr_details = autoAddr.split(',');
                    var autoAddr_line1 = autoAddr_details[0];
                    var autoAddr_city = autoAddr_details[1];
                    var autoAddr_state = autoAddr_details[2].split(' ')[0];
                    var autoAddr_zip = autoAddr_details[2].split(' ')[1];
                    $('#address1').val(autoAddr_line1);
                    $('#city').val(autoAddr_city);
                    $('#state').val(autoAddr_state);
                    $('#zip').val(autoAddr_zip);
                }catch(e){
                    $('#address1').val('');
                    $('#city').val('');
                    $('#state').val('');
                    $('#zip').val('');
                    $("#searchInput-1").val('');
                }
                //  setCookie("setuplocation", valff[0], 365);
                //  setCookie("totaladdress", placea.formatted_address, 365);
                //  setCookie("curloc",JSON.stringify(loc),365);
                // $(".address").text(valff[0]);
                // $(".location-picker-1").toggleClass("open");
                // $(".delivery-add-1").toggleClass("open");
                // if(getCookie("mode") == "delivery") {
                //     var url = "{{route('home.delivery',['lat'=>'latv','lng' =>'lngv'])}}";
                //     url = url.replace('latv', JSON.parse(JSON.stringify(loc)).lat);
                //     url = url.replace('lngv', JSON.parse(JSON.stringify(loc)).lng);
                //     setCookie("mode","delivery",365);
                //     window.location.href = url;
                // }
                
            });
        })

</script>


<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script>
Stripe.setPublishableKey("{{env('STRIPE_TOKEN')}}");


Stripe.applePay.checkAvailability(function(available) {
if (available) {
document.getElementById('apple-pay-button').style.display = 'block';
}
});
document.getElementById('apple-pay-button').addEventListener('click', beginApplePay);
function beginApplePay() {
var paymentRequest = {
countryCode: 'US',
currencyCode: 'USD',
total: {
  label: 'Stripe.com',
  amount: '{{$totalprice}}'
}
};


var session = Stripe.applePay.buildSession(paymentRequest,
function(result, completion) {

$.post('/about-us', { token: result.token.id 
    
    
}).done(function() {
  completion(ApplePaySession.STATUS_SUCCESS);
  // You can now redirect the user to a receipt page, etc.
py=result.token.id;

       var form = $('#form');
        form.append('<input name="paymentmethodtype" type="hidden" value="1">');
        form.append('<input name="paymentmethodtoken" type="hidden" value="'+py+'">');
     
        form.append('<input name="paymenttypes" type="hidden" value="Apple Pay">');
        form.submit();
        
//   window.location.href = '/chekout/thankyou';
}).fail(function() {
  completion(ApplePaySession.STATUS_FAILURE);
});

}, function(error) {
console.log(error.message);
});

session.oncancel = function() {
console.log("User hit the cancel button in the payment window");
};

session.begin();
}
</script>
@endpush