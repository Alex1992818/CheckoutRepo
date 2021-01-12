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
    .modal-content{
        background-color: black;
        padding: 1rem 2rem;
    }
    .er h1{
        color: #DC1877;
        font-size: 4rem;
    }
    .header .close{
        color: #DC1877;
        font-size: 2rem;
        display: flex;
        margin-top: -4rem;
    }
    .modal-content p{
        color: white;
        text-align: center;
    }
    .mail-color{
        color: #DC1877;
    }
    .modal-content img{
        height: 30vh;
        width: 20vw;
        display: block;
        margin-right: auto;
        margin-left: auto;
    }
    .tags img{
        height: 4vh;
        width: 2.5vw;
        display: inline-block;
        padding-left: .5rem;
    }
    .tags .btn{
        color: white;
        background-color: #DC1877;
        display: block;
        margin-right: auto;
        margin-left: auto;
        padding: .3rem 4rem;
    }
</style>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <h2>Add Restaurant</h2>
                <form action="" id="frm_add_restaurant">
                    @csrf
                    <div class="form-group">
                        <label for="name" class="mb-0">Your Name:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email" class="mb-0">Your Email:</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>    
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone" class="mb-0">Best Number to Call:</label>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your phone">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="restaurant_name" class="mb-0">The Restaurant Name:</label>
                        <input type="text" id="restaurant_name" name="restaurant_name" class="form-control" placeholder="Enter restaurant name" required>
                    </div>

                    <div class="form-group">
                        <label for="comment" class="mb-0">Anything you would like us to know?</label>
                        <textarea id="comment" name="comment" class="form-control" cols="30" rows="5"></textarea>
                    </div>

                    <div class="text-right">
                        <div class="d-flex justify-content-end mt-5">
                            <button type="button" id="submit_data" style="background-color: #dc278c" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                              Submit</button>
                        </div>
                
                      
                
                        {{-- <button type="submit" id="submit_data" class="btn btn-primary px-5">Submit</button> --}}
                    </div>
                    <div class="alert alert-success mt-3 d-none" role="alert">
                        Success!!!
                    </div>
                    <div class="alert alert-warning mt-3 d-none" role="alert">
                        Something went wrong. Please try again.
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- The Modal -->
    
    <div class="modal" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="er">
                <h1 class="modal-title">Welcome!</h1>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <p>Welcome to the Chekout Team!</p>
              
              <p>One of our Chekout Team members will reach out within 24<br> hours to discuss your partnership with<br> Chekout,if you need immediate attention please email us at<br> 
                  <span class="mail-color">partnerships@chekoutteam.com</span>.</p>

              <img src="{{asset('public/img/Untitled-46.png')}}">
            
            <div class="row tags mt-3">
                <div class="col-md-6">
                    <p>Follow Us <a target="_blank" href="https://www.facebook.com/ordercheckout"> <img src="{{asset('public/img/fb1.png')}}"></a>
                           <a target="_blank" href="https://instagram.com/order_chekout?igshid=slx4i5q94rt2"> <img src="{{asset('public/img/insta1.png')}}"></a>
                           <a target="_blank" href="https://twitter.com/orderchekout"> <img src="{{asset('public/img/twitter1.png')}}"></p></a>
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn" data-dismiss="modal">Home</button>
                  </div>
            </div>
        </div>
      </div>
    </div>
@endsection

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <script>
        $(function() {
            $("#frm_add_restaurant").submit(function(e) {
                e.preventDefault()
                
                if( $("#submit_data").hasClass('processing') )
                    return false;


                var form = $(this);

                $("#submit_data").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>')
                $("#submit_data").addClass('processing')

                $.ajax({
                    url: '{{ route("app.restaurant.save") }}',
                    type: 'POST',
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function(result) {
                        $("#submit_data").text('Submit')
                        $("#submit_data").removeClass('processing')

                        if(result['success']) {
                            $(form).find('.alert-warning').addClass('d-none')
                            $(form).find('.alert-success').removeClass('d-none')
                            $(form)[0].reset()
                        } else {
                            $(form).find('.alert-success').addClass('d-none')
                            $(form).find('.alert-warning').removeClass('d-none')
                        }
                    }
                });
            })
        })
    </script>
@endpush

