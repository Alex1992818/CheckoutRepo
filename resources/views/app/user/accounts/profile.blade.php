@extends('app.user.account')

@section('title')
    <title>Chekout</title>
@endsection

@section('account_right_panel')
    <!-- slider -->
    <section class="profile_setting">
        <div class="profile_avatar">
            <img src="{{ asset('img/user.jfif') }}" class="img-fluid" alt="Logo" style="width:60px;height:60px;">
            <div class="profile_user_infos">
                <span style="font-weight: bold;">{{ ($fs_user->firstName ?? '') . ($fs_user->lastName ?? '') }}</span>
                <span class="text-dark">{{ $fs_user->email ?? 'email@example.com' }}</span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="addresses">
                    <h4 style="width: 100%">Saved Addresses ({{count($addresses)}})</h4>
                    <div>
                        @foreach($addresses as $address)
                        <div class = "row">
                            <div class = "col-9">
                                <p>{{ $address['line2'] ?? ''}} {{ $address['line1'] ?? ''}}, {{ $address['city'] ?? ''}}, {{ $address['state'] ?? '' }} {{ $address['zip'] ?? ''}}</p>
                            </div>
                            <div class = "col-3">
                                <form action="{{ route('app.user.address.delete') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $address['address_id'] }}">
                                    <button class="fa fa-trash btn-outline-danger"></button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                        <!-- <div class="card">
                            <form action="{{ route('app.user.address.add') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    @csrf
                                    <h5>New Address</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <span>Name</span>
                                            <input type="text" class="form-control" name="addtitle">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-6">
                                            <span>Street Address</span>
                                            <input type="text" class="form-control" name="address1">
                                        </div>
                                        <div class="col-6">
                                            <span>Apartment No.</span>
                                            <input type="text" class="form-control" name="address2">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-4">
                                            <span>City</span>
                                            <input type="text" class="form-control" name="city">
                                        </div>
                                        <div class="col-4">
                                            <span>State</span>
                                            <input type="text" class="form-control" name="state">
                                        </div>
                                        <div class="col-4">
                                            <span>Zip</span>
                                            <input type="text" class="form-control" name="zip">
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-outline-dark">Save Address</button>
                                </div>
                            </form>
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-6">
                <div class="addresses">
                    <h4 style="width: 100%">Add New Address</h4>
                        @if($errors->any())
                        <div class="col-12">
                            <div class="alert alert-danger">
                                Please input correct address
                            </div>
                        </div>
                        @endif
                        <input type="text" class="form-control" placeholder="Enter a new address" id="searchInput-2" autocomplete="true" >
                        
                        
                        <form action="{{ route('app.user.address.add') }}" method="POST">
                            @csrf
                            
                               
                            <input type="hidden" class="form-control" id="address1" name="address1">
                            <br>
                        
                            <input type="text" class="form-control" id="address2" name="address2" placeholder = "Apartment No">
                        
                            <input type="hidden" class="form-control" id="city" name="city">
                        
                            <input type="hidden" class="form-control" id="state" name="state">
                        
                            <input type="hidden" class="form-control" id="zip" name="zip">
                            
                            <br>
                            <button class="btn btn-outline-dark" style="float: right">Save Address</button>
                            
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
    </form>

    <div class="modal fade" id="add-email-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document" style="width:300px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit-option-modal-label">Add Email</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="option-attachment-body-content">
                    <form id="option-edit-form" class="form-horizontal" method="POST" action="">
                        <div class="card text-white bg-dark mb-0" style="background-color:black!important;">

                            <div class="card-body">
                                <!-- id -->
                                <div class="form-group">
                                    <label class="col-form-label" for="modal-input-email">Email Address</label>
                                    <input type="text" name="modal-input-email" class="form-control"
                                           id="modal-input-email" required="">
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="modal_done">Done</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        $(document).ready(function () {
            
            var email = '';
            $(".profile_emails").on("click", "#add_email", function () {
                var options = {
                    'backdrop': 'static'
                };

                $('#add-email-modal').modal(options)
            });

            $('#modal_done').on('click', function () {
                email = $("#modal-input-email").val();
                $(".profile_email_items").append('<span class="profile_email" style="font-size:15px; font-weight: bold; margin-bottom:10px">' + email + '</span>');
                //$("#add_email").hide();
            });
            $('#address-btn').on('click', function () {
                if ($(this).find('i').hasClass('fa-angle-up')) {
                    $(this).find('i').addClass('fa-angle-down').removeClass('fa-angle-up');
                } else {
                    $(this).find('i').addClass('fa-angle-up').removeClass('fa-angle-down');
                }
            });

            var inputa = document.getElementById('searchInput-2');
            var autocompletea = new google.maps.places.Autocomplete(inputa);
            autocompletea.addListener('place_changed', function() {
                var placea = autocompletea.getPlace();
                console.log(placea.formatted_address);
                $("#searchInput-2").val(placea.formatted_address.replaceAll(', USA', ''));
                var autoAddr = placea.formatted_address.replaceAll(', USA', '').toString();
                var autoAddr_details = autoAddr.split(', ');
                var autoAddr_line1 = autoAddr_details[0];
                var autoAddr_city = autoAddr_details[1];
                var autoAddr_state = autoAddr_details[2].split(' ')[0];
                var autoAddr_zip = autoAddr_details[2].split(' ')[1];

                $('#address1').val(autoAddr_line1);
                $('#city').val(autoAddr_city);
                $('#state').val(autoAddr_state);
                $('#zip').val(autoAddr_zip);
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
        });
        

    </script>
@endpush
