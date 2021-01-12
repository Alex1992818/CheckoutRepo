@extends('layouts.auth')

@section('styles')
     <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #locationfield,
      #controls {
        position: relative;
        width: 480px;
      }
      #autocomplete {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 99%;
      }
      .label {
        text-align: right;
        font-weight: bold;
        width: 100px;
        color: #303030;
        font-family: "Roboto", Arial, Helvetica, sans-serif;
      }
      #address {
        border: 1px solid #000090;
        background-color: #f0f9ff;
        width: 480px;
        padding-right: 2px;
      }
      #address td {
        font-size: 10pt;
      }
      .field {
        width: 99%;
      }
      .slimField {
        width: 80px;
      }
      .wideField {
        width: 200px;
      }
      #locationfield {
        height: 20px;
        margin-bottom: 2px;
      }
    </style>
@endsection


@section('auth-section')
    <div class="login-box" onload="disableSubmit()">
        <div class="login-box">
            <form action="{{ route('auth.register.store') }}" method="POST">
                @csrf
                <h4 class="text-light-black fw-600">Create your account</h4>
                <div class="row">
                    @if($errors->any())
                        <div class="col-12">
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>
                                            {{$error}}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-light-white fs-14">First Name</label>
                            <input type="text" name="firstName" class="form-control form-control-submit"
                                   placeholder="First Name" required>
                        </div>
                    </div>
                    <div class="col-12">
                      <div class="form-group">
                          <label class="text-light-white fs-14">Last Name</label>
                          <input type="text" name="lastName" class="form-control form-control-submit"
                                 placeholder="Last Name" required>
                      </div>
                  </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="text-light-white fs-14">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control form-control-submit"
                                   placeholder="Phone" required>
                        </div>
                        <div class="form-group">
                            <label class="text-light-white fs-14">Email</label>
                            <input type="email" name="email" class="form-control form-control-submit"
                                   placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label class="text-light-white fs-14">Date Of Birth</label>
                            <input type="date" name="dob" class="form-control form-control-submit"
                                   placeholder="Date Of Birth" >
                        </div>
                           
                        
                        {{--  <div class="form-group">
                        <label for="exampleFormControlTextarea1">Address</label>
                        <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>  --}}
                        <div class="form-group">
                            <label class="text-light-white fs-14">Apartment No.</label>
                            <input type="text" name="apartmentno" class="form-control form-control-submit"
                                   placeholder="Apartment No." required>
                        </div>   
                        
                        <div class="form-group">
                        <label class="text-light-white fs-14" for="exampleFormControlTextarea1">Address</label>
                        <!--<textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>-->
                        <!--<label for="exampleFormControlTextarea1">Address</label>-->
                        <div id="locationfield">
                                 <input name="address" id="autocomplete" placeholder="Enter your address" onFocus="geolocate()" type="text" required/>
                                      </div>
                        </div>

                        <div class="form-group">
                            <label class="text-light-white fs-14">Password (8 character minimum)</label>
                            <input type="password" id="password-field" name="password"
                                   class="form-control form-control-submit"
                                   placeholder="Password" required>
                            <div data-name="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></div>
                        </div>
                        <div class="form-group">
                            <label class="text-light-white fs-14">Password Repeat</label>
                            <input type="password" id="password-field" name="password_confirmation"
                                   class="form-control form-control-submit"
                                   placeholder="Password" required>
                        </div>
                        <div class="form-group checkbox-reset">
                            <label class="custom-checkbox mb-0">
                                <input type="checkbox" name="#"> <span class="checkmark"></span> Keep me signed
                                in</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" style="background-color: #dc278c" class="btn-second text-light full-width"><i class="fas fa-user"></i>
                                &nbsp; Create your account
                            </button>
                        </div>
                        <div class="form-group text-center"><span>or</span>
                        </div>
                        {{--                        <div class="form-group">--}}
                        {{--                            <button type="submit" class="btn-second btn-facebook full-width">--}}
                        {{--                                <img src="assets/img/facebook-logo.svg" alt="btn logo">Continue with Facebook</button>--}}
                        {{--                        </div>--}}
                        {{--                        <div class="form-group">--}}
                        {{--                            <button type="submit" class="btn-second btn-google full-width">--}}
                        {{--                                <img src="assets/img/google-logo.png" alt="btn logo">Continue with Google</button>--}}
                        {{--                        </div>--}}
                        <div class="form-group text-center">
                            <p class="text-light-black mb-0">Have an account? <a href="{{ route('auth.login') }}">Sign
                                    in</a>
                            </p>
                        </div>
                        
                    
                        <span  class="text-light-black fs-12 terms">By creating your Chekout account, you agree to the Terms of Use and Privacy Policy </span>
                                 
<br><br>
                                
                                 
</div>

</div>

</form>
{{-- <button class="btn-second btn-facebook full-width" onclick = "facebookSignin()">Facebook Signin</button> --}}
 
<div style = "text-align:center; margin-top:10px">
  <a  href="{{ route('app.user.privacy.show') }}" style="font-size : 17px; color : navy; text-decoration:underline ">Privacy Policy</a>
</div>
        </div>
    </div>
    
@endsection

@push('scripts')
<script>
 function disableSubmit() {
  document.getElementById("submit").disabled = true;
 }
  function activateButton(element) {
      if(element.checked) {
        document.getElementById("submit").disabled = false;
       }
       else  {
        document.getElementById("submit").disabled = true;
      }
  }
</script>
   <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-app.js"></script>
<script src='https://cdn.firebase.com/js/client/2.2.1/firebase.js'></script>
  <!-- If you enabled Analytics in your project, add the Firebase SDK for Analytics -->
  <script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-analytics.js"></script>

  
  <script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-auth.js"></script>
  <script src="https://www.gstatic.com/firebasejs/8.1.2/firebase-firestore.js"></script>
  <script src="//connect.facebook.net/en_US/sdk.js"></script>

 

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
    apiKey: "AIzaSyC1jKOFLhfQoZD3xJISSPnSW9-4SyYPpjY",
    authDomain: "chekout-delivery.firebaseapp.com",
    databaseURL: "https://chekout-delivery.firebaseio.com",
    projectId: "chekout-delivery",
    storageBucket: "chekout-delivery.appspot.com",
    messagingSenderId: "223987454895",
    appId: "1:223987454895:web:c46a72b08577f09752555a",
    measurementId: "G-0S9MKLFT0D"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
  function onSignIn(googleUser) {
    var provider=new firebase.auth.GoogleAuthProvider();
    console.log(googleUser.xt.sV);
    console.log(googleUser.xt.vT);
    fname=googleUser.xt.sV;
    lname=googleUser.xt.vT;
    firebase.auth().signInWithPopup(provider).then(function (result) { 
            var token = result.credential.idToken;
              
            jQuery( document ).ready( function( $ ) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({ 
                url:"{{ route('googlenew.form') }}",
                method:"POST",
                data:{select:token,fname:fname,lname:lname},
                success: function(url){
                    window.location.href = url;
            },
        })
        });
    }).catch(function (error) {
        var errorMessage=error.message;
        alert(errorMessage);
    });
}
window.fbAsyncInit = function() {
  FB.init ({
     appId      : '914705312600817',
     xfbml      : true,
     version    : 'v2.6'
  });
};
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
} (document, 'script', 'facebook-jssdk'));
var provider = new firebase.auth.FacebookAuthProvider();
function facebookSignin() {
firebase.auth().signInWithPopup(provider)
.then(function(result) {
  var token = result.credential.accessToken;
  var user = result.user;
    
  console.log(token)
  
  
      jQuery( document ).ready( function( $ ) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({ 
            url:"{{ route('facebook.form') }}",
            method:"POST",
            data:{select:token},
            success: function(url){
                window.location.href = url;
        },
    })
    });
  console.log(user)
}).catch(function(error) {
  console.log(error.code);
  console.log(error.message);
});
}
function facebookSignout() {
firebase.auth().signOut()
.then(function() {
  console.log('Signout successful!')
}, function(error) {
  console.log('Signout failed')
});
}
    </script>
    
    <script>
        // This sample uses the Autocomplete widget to help the user select a
        // place, then it retrieves the address components associated with that
        // place, and then it populates the form fields with those details.
        // This sample requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script
        // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        let placeSearch;
        let autocomplete;
        const componentForm = {
          street_number: "short_name",
          route: "long_name",
          locality: "long_name",
          administrative_area_level_1: "short_name",
          country: "long_name",
          postal_code: "short_name",
        };
  
        function initAutocomplete() {
          // Create the autocomplete object, restricting the search predictions to
          // geographical location types.
          autocomplete = new google.maps.places.Autocomplete(
            document.getElementById("autocomplete"),
            { types: ["geocode"] }
          );
          // Avoid paying for data that you don't need by restricting the set of
          // place fields that are returned to just the address components.
          autocomplete.setFields(["address_component"]);
          // When the user selects an address from the drop-down, populate the
          // address fields in the form.
          autocomplete.addListener("place_changed", fillInAddress);
        }
  
        function fillInAddress() {
          // Get the place details from the autocomplete object.
          const place = autocomplete.getPlace();
  
          for (const component in componentForm) {
            document.getElementById(component).value = "";
            document.getElementById(component).disabled = false;
          }
  
          // Get each component of the address from the place details,
          // and then fill-in the corresponding field on the form.
          for (const component of place.address_components) {
            const addressType = component.types[0];
  
            if (componentForm[addressType]) {
              const val = component[componentForm[addressType]];
              document.getElementById(addressType).value = val;
            }
          }
        }
  
        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
              const geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
              };
              const circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy,
              });
              // autocomplete.setBounds(circle.getBounds());
            });
          }
        }
      </script>
     
@endpush