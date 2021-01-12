@extends('layouts.app')

@section('title')
    <title>Chekout</title>
@endsection

@section('content')


<!------ Include the above in your HEAD tag ---------->

 
 <div class="form-gap"></div>
<div class="container text-center py-4" >
	<div class="row">
		<div class="col-md-4 col-md-offset-4" style="
    margin-left: 364px;
">
@if (isset($success))
<div class="alert alert-success" role="alert">
  please check your email, We have sent you password reset link
</div>
@endif

            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form action="{{route('reset.form')}}" autocomplete="off" class="form" method="post">
    @csrf
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <input  style="background-color: #dc278c" name="recover-submit"  class="btn btn-lg  btn-block" value="Reset Password" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>
@endsection
@push('scripts')


@endpush