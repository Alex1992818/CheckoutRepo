@extends('layouts.app')

@section('title')
    <title>Chekout</title>
@endsection

@section('content')
    <!-- slider -->

<section class="favorite_content">
<br>
<br>
<br>
<br>
<br>
    <div class="row">
        @if(session()->has('message'))
            <div class="col-lg-12">
                <div class="alert alert-info">
                    {{session('message')}}
                </div>
            </div>
        @endif
        <div class="col-12 col-xl-6">
            <div class="cards">
                <h4 style="width: 100%">Saved Cards ({{count($cards)}})</h4>
                @foreach($cards as $card)
                    <div class = "row">
                        <div class = "col-8">
                            <h6><span class="fa fa-credit-card" style="font-size: 20px"></span> {{ $card['card']['brand'] }} &ensp;&ensp; **** {{ $card['card']['last4'] }} &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; {{ $card['card']['exp_month'] }}/{{ $card['card']['exp_year'] }}</h6>
                        </div>
                        
                        <div class = "col-2">
                            <form action="{{ route('app.user.card.delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $card['card']['id'] }}">
                                <button class="fa fa-trash btn-outline-danger" style="float: right; font-size: 20px"></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>    
            
        </div>
        <div class="col-12 col-xl-6">
            <div class="cards">

                <h4 style="width: 100%">Add New Card</h4>

                @if($errors->any())
                    <div class="col-12">
                        <div class="alert alert-danger">
                            There is an error adding your new card. Please contact support team. 
                        </div>
                    </div>
                @endif
                
                    
                <form action="{{ route('app.user.card.store') }}" id="card-form" method="POST">
                    @csrf

                    <input type="text" name="title" id="cardholder-name" class="form-control" placeholder = "Holder Name">
                                
                    <br>

                    <div id="card-element" class="form-control" style="padding-top: 10px"></div>
                            
                    <br>

                    <button class="btn btn-outline-dark" type = "button" id="save-card" style="float:right">Save Card</button>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    
                </form>
               
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://js.stripe.com/v3/"></script>
<script>
    $(document).ready(function () {
        var stripe = Stripe('{{ env('STRIPE_TOKEN') }}');
            var elements = stripe.elements();
            var cardElement = elements.create('card');
            cardElement.mount('#card-element');
            $('#save-card').on('click', function () {
                var cardholder = $('#cardholder-name').val();
                stripe.createToken(cardElement).then(function (result) {
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        var paymentMethodId = result.token.id;
                        var lastfour = result.token.card.last4;
                        var form = $('#card-form');
                        form.append('<input name="paymentmethod" type="hidden" value="' + paymentMethodId + '">');
                        form.append('<input name="lastfour" type="hidden" value="' + lastfour + '">');
                        form.append('<input name="fulltoken" type="hidden" value=' + btoa(JSON.stringify(result.token)) + '">');
                         form.append('<input name="ser" type="hidden" value="' + cardholder + '">');
                        form.submit();
                    }
                });
            });
    });
</script>
@endpush