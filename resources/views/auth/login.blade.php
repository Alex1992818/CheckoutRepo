  
@extends('layouts.auth')

@section('auth-section')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
  .signin-button {
    width: 210px;
    height: 40px;
}
</style>
    <div class="login-sec">

        <div class="login-box">
          <!-- <div class="btn-second btn-google full-width text-center g-signin2" data-onsuccess="onSignIn" data-theme="dark" data-longtitle="true"></div>
            -->
          <h3 class="text-center"><b>Welcome Back Chekmate!</b></h3>

<br>

          <button class="btn-second btn-google full-width text-light" onclick ="onSignIn()"> <i style="margin-right: 10px;" class="fa fa-google" aria-hidden="true"></i> Login with Google</button>
         
          <br>
          <br>
      <button style="background-color: black" class="btn-second full-width text-light"  onclick ="Rtr()"> <i style="margin-right: 10px;" class="fa fa-apple" aria-hidden="true"></i> Login with Apple</button>
         
         <br>
         <br>

          <button class="btn-second btn-facebook full-width"  onclick = "facebookSignin()"><i style="margin-right: 10px;" class="fa fa-facebook-square" aria-hidden="true"></i>Login With Facebook</button>
          <form action="{{route('auth.login.check')}}" method="POST" id="form">
            @csrf
            <br><br>
            <div class="form-group text-center"><span>or login with</span></div>
                {{-- <h4 class="text-light-black fw-600">Sign in to Chekout</h4> --}}
                <div class="row">
                    <div class="col-12">
                        @if(session()->has('message'))
                            <div class="alert alert-{{ session()->has('type') ? session('type') : 'danger' }}">
                                <ul>
                                    <li>{{ session('message') }}</li>
                                </ul>
                            </div>
                        @endif
                        {{--                        <p class="text-light-black">Have a corporate username? <a--}}
                        {{--                                href="add-restaurant.html">Click here</a>--}}
                        {{--                        </p>--}}
                        <div class="form-group">
                            <label class="text-light-white fs-14">Email</label>
                            <input type="email" name="email" class="form-control form-control-submit"
                                   placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <label class="text-light-white fs-14">Password</label>
                            <input type="password" id="password-field" name="password"
                                   class="form-control form-control-submit" value=""
                                   placeholder="Password" required>
                            <div data-name="#password-field"
                                 class="fa fa-fw fa-eye field-icon toggle-password"></div>
                        </div>
                        <div class="form-group checkbox-reset">
                            <label class="custom-checkbox mb-0">
                                <input type="checkbox" name="#"> <span class="checkmark"></span>
                                Keep me signed in</label> <a href="{{route('reset.blade')}}">Reset password</a>
                        </div>
                        <div class="form-group">
                            <button style="background-color: #dc278c" type="submit" class="btn-second text-light full-width">
                                Sign in <i class="fas fa-sign-in-alt"></i>
                            </button>
                        </div>
                        <div class="form-group text-center"><span>or</span>
                        </div>
                        {{--                        <div class="form-group">--}}
                        {{--                            <button type="submit" class="btn-second btn-facebook full-width">--}}
                        {{--                                <img src="assets/img/facebook-logo.svg" alt="btn logo">Continue with--}}
                        {{--                                Facebook--}}
                        {{--                            </button>--}}
                        {{--                        </div>--}}
                                              
                        <div class="form-group text-center mb-0"><a style="background-color: #dc278c" class="btn btn-block btn-outline-dark text-light" href="{{ route('auth.register') }}">Create your
                                account</a>
                                
                        </div>
                        <div>
                        
                    </div>
                    <div style = "text-align:center; margin-top:20px">
                      <a  href="{{ route('app.user.privacy.show') }}" style="font-size : 15px; color : navy; text-decoration:underline ">Privacy Policy</a>
                  </div>
                </div>
            </form>
           
                                                   
            
            
            
          </div>
          <br>
         
         
        </div>
@endsection
@push('scripts')
<script type="text/javascript" src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>
         


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
  var lat = '';
  var lng = '';
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
    provider.addScope('profile');
   //console.log(googleUser);
    
  


    firebase.auth().signInWithPopup(provider).then(function (result) { 
            var token = result.credential.idToken;
                console.log(result.additionalUserInfo.profile);
                fname=result.additionalUserInfo.profile.given_name;
                lname=result.additionalUserInfo.profile.family_name;
              
                var loc = getCookie("curloc");
                var location = JSON.parse(loc);
                lat = location.lat;
                lng = location.lng;
                var urlset = "{{route('home.delivery',['lat'=>'latv','lng' =>'lngv'])}}";
                urlset = urlset.replace('latv', lat);
                urlset = urlset.replace('lngv', lng);
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
                    window.location.href = urlset;
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

  var providerfacebook = new firebase.auth.FacebookAuthProvider();

function facebookSignin() {
 firebase.auth().signInWithPopup(providerfacebook)
 
 .then(function(result) {
    var token = result.credential.accessToken;
    var user = result.user;
      
    console.log(token)
    var loc = getCookie("curloc");
    var location = JSON.parse(loc);
    lat = location.lat;
    lng = location.lng;
    var urlset = "{{route('home.delivery',['lat'=>'latv','lng' =>'lngv'])}}";
    urlset = urlset.replace('latv', lat);
    urlset = urlset.replace('lngv', lng);
    
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
                  window.location.href = urlset;
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
      AppleID.auth.init({
      clientId : 'com.bilaltech.checckout',
      redirectURI :'https://chekout-delivery.firebaseapp.com/__/auth/handler',
     
      state : '',
      nonce : '',
      usePopup : true //or false defaults to false
    });
   
    
    var providerapple = new firebase.auth.OAuthProvider('apple.com');
    providerapple.addScope('name');
    
    console.log(providerapple);
    function Rtr() {
   
    firebase
      .auth()
      .signInWithPopup(providerapple)
      .then(function(result) {
        // The signed-in user info.
        var use = result.user;
        //console.log(email);
        console.log(result.credential);
        console.log(use.email);
         // You can also get the Apple OAuth Access and ID Tokens.
         var providerId=result.credential.providerId;
        var accessToken = result.credential.accessToken;
        var token = result.credential.idToken;
        var name=use.displayName;
        var email=use.email;
        jQuery( document ).ready( function( $ ) {

          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          var loc = getCookie("curloc");
          var location = JSON.parse(loc);
          lat = location.lat;
          lng = location.lng;
          var urlset = "{{route('home.delivery',['lat'=>'latv','lng' =>'lngv'])}}";
          urlset = urlset.replace('latv', lat);
          urlset = urlset.replace('lngv', lng);
          
          $.ajax({ 
              url:"{{ route('apple.form') }}",
              method:"POST",
              data:{select:token,providerId:providerId,name:name,email:email},
              success: function(url){
                 window.location.href = urlset;
          },
      })
      });
    
        // ...
      })
      .catch(function(error) {
        // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
        // The email of the user's account used.
        var email = error.email;
        // The firebase.auth.AuthCredential type that was used.
        var credential = error.credential;
    
        // ...
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