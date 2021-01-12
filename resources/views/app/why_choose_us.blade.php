@extends('layouts.app')

@section('title')
    <title>Chekout</title>
@endsection 

@section('content')



<style type="text/css">
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    .main-container h1{
        text-align: center;
        font-size: 4rem;
        margin-top: 2rem;
    }
    .main-container p{
        display: flex;
        text-align: center;
        justify-content: center;
        font-size: 1.3rem;
    }
    .container .container-img{
        height: 5rem;
        width: auto;
        display: block;  
        margin-left: auto;  
        margin-right: auto;
    }
    .container h5{
        text-align: center;
        margin-bottom: 0;
    }
    .container p{
        font-size: .9rem;
    }

    h1.whyChooseCheckoutHead {
    margin: 0;
    padding: 0;
    font-weight: bold;
}

p.whyChooseCheckoutPara {
    margin: 0;
    padding: 0;
    line-height: 1;
    font-weight: 300;
    padding-bottom: 0.5em;
}

h5.convHead {
    font-weight: bolder;
    font-size: 1.5em;
}

p.convPara {
    text-align: left;
    line-height: 1.3;
    padding-right: 3em;
}


</style>



<section>
    <div class="main-container">
        <h1 class="whyChooseCheckoutHead">Why Choose Chekout!</h1>
        <p class="whyChooseCheckoutPara">Tired of paying endless food delivery fees? So were we. That’s why we created Chekout, New York City’s<br> newest, most exciting food delivery platform!</p>

        <div class="container">
            <div class="row ml-5 mr-5">
            
                <div class="col-md-6">
                    <img src="{{asset('public/img/lowest_fees.png')}}" class="container-img">
                    <h5 class="convHead">Lowest fees!</h5> 
                        <p class="convPara">We are priced better than any other food delivery
                         company. You will never pay more than $2.50 for delivery or 10% in service fees. We won’t overcharge you and we won’t inflate menu prices. Ever.
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('public/img/fast_service.png')}}" class="container-img">
                    <h5 class="convHead">Fast Service!</h5> 
                        <p class="convPara">You will get your food quickly without ever having to leave your home or office.
                    </p>
                </div>
            </div>

            <div class="row ml-5 mr-5">
                
                <div class="col-md-6">
                    <img src="{{asset('public/img/constant_care.png')}}" class="container-img">
                    <h5 class="convHead">Constant Care!</h5> 
                        <p class="convPara">A 24/7 concierge team is available to assist with your food delivery problems and questions.
                    </p>
                </div>
                <div class="col-md-6">
                    <img src="{{asset('public/img/convenient_to_use.png')}}" class="container-img">
                    <h5 class="convHead">Convenient to use!</h5>
                        <p class="convPara">Order directly through our website or our easy-to-use app and let us do the rest!
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@push('scripts')
    <script>
    </script>
@endpush