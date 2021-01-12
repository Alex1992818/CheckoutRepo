@extends('layouts.app')

@section('title')
    <title>Chekout</title>
@endsection

@section('content')
{{-- <div class="jumbotron text-center">
    <h1 class="display-3">Thank You!</h1>
    <p class="lead"><strong>Please check your email for receipt.</strong>
    <br>Please feel free to Contact-Us if you need assistance.</p>
    <hr>
    <p>
      Having trouble?<br> 
      Contact Us<br>
        <i>Conciege Service:  855-535-0404<br>
        Service Available:  5:00 AM to Midnight</i>
    </p>
    <p class="lead">
      <a class="btn btn-primary btn-sm" href="https://orderchekout.com/beta1" role="button">Continue to homepage</a>
    </p>
    

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contact Us</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
  </div> --}}
  <div class="container py-4">
    <center>
      <section>
        <img src="{{asset('public/img/thank.png')}}" style="width:40%;height:20%;">
        <h1>Thank You!&nbsp<?php $user = session('user');
                 echo $user['firstName'] ?? $user['displayName'];
          ?></h1>
        <p>A confirmation email has been sent to your email.<br>Since you are already here why not join our list for discounts.</p>
        <div style="display:inline;">
          <form action="{{route('email.submit')}}" method="POST">
            @csrf
          <input style="border:1px solid pink; width:50%; height:5%;  margin-right:5px;margin-top:10px" name="email" type="email" placeholder="Email Address">
          <button  class="btn btn-outline-white btn-default btn-sm" style="background-color:pink;" type="submit">Yes, Sign Me Up!</button>
        </form>
          <br><b style="float:right; margin-right:20%;">Follow Us <i class="fab fa-twitter" style="width:5px;height:5px;"></i>&emsp;<img src="{{asset('public/img/ins.png')}}" style="width:20px;height:20px;">&nbsp; <i class="fab fa-facebook" style="width:5px;height:5px;"></i>
          </b>
        </div>
      </section>
    </center>
  </div>
  <br><br>
  <table class="table" style="
  width: 80%;
  margin-left: 9rem!important;
">
  <hr>
    <thead>
    <tr>
      <th>Item</th>
      <th>Price</th>
      <th>QTY</th>
      <th >Amount due</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($carts as $cart)
    
    <tr>
    
      <td style="margin-right:20px;width:60%;margin-left:20px;">
      <div class="row">
        {{--  <div class="col-md-3">
          <img src="{{asset('public/img/item34.jpg')}}" style="width:100%;height:20%;">
        </div>  --}}
        <div class="col-md-7">
          
            <h5>{{$cart['res_name']}}</h5>
            <p>{{$cart['name']}}</p>
            <p>Call 600-700</p>
          
          
        </div>
      </div>
      </td>
      <td style="margin-right:50px;">${{$cart['item_price']}}</td>
      <td style="margin-right:50px;">{{$cart['quantity']}}</td>
      <td style=" margin-right:50px;">
      <p>Sub Total:${{$cart['total_price']}}</p>
      <p>Tax:${{$fees}}</p>
      <p>Delivery Fee:$0</p>
      <p>Total:<b style="color:#e75480;">${{$totalCost}}</b></p>
      </td>
    </tr>
    @endforeach
    
    
    </tbody>
  </table>
@endsection
