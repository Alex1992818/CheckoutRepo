@extends('layouts.app')

@section('title')
    <title>Chekout</title>
@endsection

@section('content')

    <div class="container" style="margin-top : 70px;">
        <form id="help-form" class="form-horizontal" method="POST" action="">
            <div class="card text-white bg-dark mb-0" style="border:none!important; background-color:white!important;">
                <div class="help_top" style="background-image:url('{{ asset('img/help.jfif') }}');background-size:cover;
                background-repeat:   no-repeat;
                background-position: center center;">
                    <h1>Having trouble?</h1>
                    <h2>We are here to help</h2>
                    <!--<div class="help_search">-->
                    <!--    <input type="text" placeholder="Describe your issue" value="" />-->
                    <!--    <Button type="button">SEARCH</Button>-->
                    <!--</div>-->
                </div>
                <div class="help_body">
                    <h1>Contact Us</h1>
                    <div class="help_topic_item">
                        <div class="help_item_first">
                            <i class="fas fa-phone"></i>
                            <span>Call us: 855-535-0404</span>
                        </div>
                    </div>
                    <div class="help_topic_item">
                        <div class="help_item_first">
                            <i class="fas fa-envelope"></i>
                            <span>Email us: support@chekoutteam.com</span>
                        </div>
                    </div>
                    <!--<div class="help_topic_item">-->
                    <!--    <div class="help_item_first">-->
                    <!--        <i class="fas fa-question"></i>-->
                    <!--        <span>Help with an order</span>-->
                    <!--    </div>-->
                    <!--    <i class="fas fa-chevron-right"></i>-->
                    <!--</div>-->
                    <!--<div class="help_topic_item">-->
                    <!--    <div class="help_item_first">-->
                    <!--        <i class="fas fa-credit-card"></i>-->
                    <!--        <span>Account and payment options</span>-->
                    <!--    </div>-->
                    <!--    <i class="fas fa-chevron-right"></i>-->
                    <!--</div>-->
                    <!--<div class="help_topic_item">-->
                    <!--    <div class="help_item_first">-->
                    <!--        <i class="fas fa-info-circle"></i>-->
                    <!--        <span>Guide to Chekout</span>-->
                    <!--    </div>-->
                    <!--    <i class="fas fa-chevron-right"></i>-->
                    <!--</div>-->
                    <!--<div class="help_topic_item">-->
                    <!--    <div class="help_item_first">-->
                    <!--        <i class="fas fa-coins"></i>-->
                    <!--        <span>Chekout rewards</span>-->
                    <!--    </div>-->
                    <!--    <i class="fas fa-chevron-right"></i>-->
                    <!--</div>-->
                    
                </div>

            </div>
        </form>
    </div>
@endsection

@push('scripts')
<!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/5fc852b9920fc91564ccf353/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        console.log(s1);
        })();
    
    </script>
    <!--End of Tawk.to Script-->
@endpush