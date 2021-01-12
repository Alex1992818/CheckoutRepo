@extends('layouts.app')

@section('title')
    <title>Chekout</title>
@endsection

@section('content')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .sign{
        float:right;
    }
    .icons
    {
        font-size:20px;
    }

    .heading h1{
        text-align: center;
        font-weight: bold;
    }

    .newZig{
        padding-top: 3em;
    }

    .newZig h3 {
    margin: 0;
    padding: 0;
    font-weight: 600;
    padding-right: 13em;
    }

    .newZig p {
    margin: 0;
    line-height: 1.3;
    padding: 0.2em 2em 0 0;
    }
    
    /*.restCont{
        margin-top: -9em;
    }*/

    </style>
<div class="container py-3">
    <div class="heading">
        <h1>Chekout How We Started</h1>
    </div>
    
    <div class="row">
        <div class="col-md-8 newZig">
            <h3>Why Checkout Was Started</h3>
            <p>Chekout was created in early 2020 to help restaurants widen their reach without having to face the high fees associated with most other delivery companies. Realizing that many restaurants were struggling due to COVID-19, We wanted to create a food delivery platform that would support both the restaurant and the consumer.</p>
    
        {{-- <p style="margin-top: 4%;">
            Our vision is to give restaurants hope and allow the industry he loves to stay afloat during hardships. Through Chekout, restaurants keep one hundred percent of their profits and consumers pay the lowest fees. Restaurants love it because it makes their lives easier, helps them continue to thrive and keeps them connected to consumers who might have walked away from food delivery due to high costs and hidden fees. Consumers love it because they can continue supporting the restaurants they love through the pandemic and beyond while paying less for delivery than ever before.
    </p> --}}
    </div>
            <div class="col=md-3">
        <img src="{{asset('public/img/about-us-chopsticks-300px.png')}}" height="193" width="300" vertical-align: baseline;>
        </div>
        
        
    </div>
    </div>
    <div class="container">
    <div class="row">
    <div class="col-md-3">
        <img src="{{asset('public/img/about-us-pita-300px.png')}}" height="193" width="300" vertical-align: baseline;>
    </div>
    <div class="col-md-8 newZig">
        {{-- <p style="margin-left: 6%">
            We believe we need restaurants now more than ever. In an era where consumers feel disconnected from one another because of the pandemic, restaurants have the power to bring friends and families together even when they choose to dine at home. Chekout helps by delivering the restaurant experience directly to them, providing comfort and normalcy during a stressful time.
          <br>
          
          After launching in New York City, Chekout plans to expand into other markets that have been exhausted by high pricing...</p> --}}
            <h3>Restaurants Keep 100% Of The Profits</h3>
            <p>Our vision is to give restaurants hope and allow the industry he loves to stay afloat during hardships. Through Chekout, restaurants keep one hundred percent of their profits and consumers pay the lowest fees. Restaurants love it because it makes their lives easier, helps them continue to thrive and keeps them connected to consumers who might have walked away from food delivery due to high costs and hidden fees.</p>
        </div>
    </div>
    
    {{-- <br>
    <br><br><br><br> --}}
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 newZig">
                <h3>Never Any Hidden Fees</h3>
                <p>Consumers love it because they can continue supporting the restaurants they love through the pandemic and beyond. Order with Chekout, and we guarantee that you will never experience added menu costs or hidden fees.</p>
        
            {{-- <p style="margin-top: 4%;">
                Our vision is to give restaurants hope and allow the industry he loves to stay afloat during hardships. Through Chekout, restaurants keep one hundred percent of their profits and consumers pay the lowest fees. Restaurants love it because it makes their lives easier, helps them continue to thrive and keeps them connected to consumers who might have walked away from food delivery due to high costs and hidden fees. Consumers love it because they can continue supporting the restaurants they love through the pandemic and beyond while paying less for delivery than ever before.
        </p> --}}
        </div>
                <div class="col-md-3">
            <img src="{{asset('public/img/about-us-pizza-300px.png')}}" height="193" width="300" vertical-align: baseline;>
            </div>
            
            
        </div>
        </div>

        <div class="container">
            <div class="row">
            <div class="col-md-3">
                <img src="{{asset('public/img/about-us-hot-dog-300px.png')}}" height="193" width="300" vertical-align: baseline;>
            </div>
            <div class="col-md-8 newZig">
                {{-- <p style="margin-left: 6%">
                    We believe we need restaurants now more than ever. In an era where consumers feel disconnected from one another because of the pandemic, restaurants have the power to bring friends and families together even when they choose to dine at home. Chekout helps by delivering the restaurant experience directly to them, providing comfort and normalcy during a stressful time.
                  <br>
                  
                  After launching in New York City, Chekout plans to expand into other markets that have been exhausted by high pricing...</p> --}}
                    <h3>Bringing People Together</h3>
                    <p>We believe we need restaurants now more than ever. In an era where consumers feel disconnected from one another because of the pandemic, restaurants have the power to bring friends and families together even when they choose to dine at home. Chekout helps by delivering the restaurant experience directly to them, providing comfort and normalcy during a stressful time.</p>
                </div>
            </div>
            
            {{-- <br>
            <br><br><br><br> --}}
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-8 newZig">
                        <h3>Chek(us)out In Your City</h3>
                        <p>After launching in New York City, Chekout plans to expand into other markets that have been exhausted by high pricing.</p>
                
                    {{-- <p style="margin-top: 4%;">
                        Our vision is to give restaurants hope and allow the industry he loves to stay afloat during hardships. Through Chekout, restaurants keep one hundred percent of their profits and consumers pay the lowest fees. Restaurants love it because it makes their lives easier, helps them continue to thrive and keeps them connected to consumers who might have walked away from food delivery due to high costs and hidden fees. Consumers love it because they can continue supporting the restaurants they love through the pandemic and beyond while paying less for delivery than ever before.
                </p> --}}
                </div>
                        <div class="col-md-3">
                    <img src="{{asset('public/img/about-us-fries-300px.png')}}" height="193" width="300" vertical-align: baseline;>
                    </div>                    
                    
                </div>
                </div>




    <br>
    <br>
    <br>
    <br><br>
    <br>
    <br>
@endsection

@push('scripts')
    <script>
    </script>
@endpush