@extends('layouts.app')

@section('content')
    <div class="inner-wrapper">
        <div class="container-fluid no-padding">
            <div class="row no-gutters overflow-auto">
                <div class="col-md-6">
                    <div class="main-banner">
                        {{-- <img src="{{ asset('public/img/pizzza-im.png') }}" class="img-fluid full-width main-img"
                             alt="banner"> --}}
                        <div class="overlay-2 main-padding" style="padding: 24px 20px 20px 40px;">
                            <img src="{{ asset('public/img/un5.png') }}" class="img-fluid" alt="logo">
                        </div>
{{--                        <img src="https://via.placeholder.com/340x220" class="footer-img" alt="footer-img">--}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section-2 user-page main-padding">
                        @yield('auth-section')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
