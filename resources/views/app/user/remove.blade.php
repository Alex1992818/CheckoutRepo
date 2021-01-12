@extends('layouts.app')

@section('title')
    <title>Chekout</title>
@endsection

@section('content')

    <div class="container" style="margin-top : 70px;">
        <form action="{{route('app.user.info.remove')}}" method="POST" id="form">
            @csrf
            <h4 class="text-light-black fw-600" style="text-align:center">To remove your data from our records, please enter your account email address and click submit.</h4>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="text-light-white fs-14">Email</label>
                        <input type="email" name="email" class="form-control form-control-submit"
                               placeholder="Email" required>
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn-second btn-submit full-width" id="remove">
                            Remove <i class="fas fa-sign-in-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById("remove").addEventListener("click", myFunction);

        function myFunction() {
          alert ("Successfully remove your information!");
        }
    </script>
@endpush