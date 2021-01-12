<?php


namespace App\Services;


use App\Repositories\Users\UsersFirebaseRepository;

use App\Repositories\Users\UsersRepositoryInterface;
use Carbon\Carbon;
use Firebase\Auth\Token\Exception\InvalidToken;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Auth\SignIn\FailedToSignIn;

class FirebaseAuthService
{
    private $auth;

    public function __construct()
    {
        $this->auth = app('firebase.auth');
        $this->usersRepository = app(UsersRepositoryInterface::class);
    }

    // Todo: Need a function to log in
    // Todo: Need a function to check if token is valid

    // Todo: need a function to refresh token.

    public function logInWithEmailAndPassword($email, $password){
        try{
            $signInResult = $this->auth->signInWithEmailAndPassword($email, $password);
            $user = $signInResult->data();
            // Todo: If it is a valid login, check for the user in the Users table, if they exist, get that data, if not
            $fs_user = $this->getFirestoreUserOrReturnNew($email, $user);
            session()->put('firebase_id_token', $user['idToken']);
            session()->put('firebase_refresh_token', $user['refreshToken']);
            session()->put('firebase_expires_at', Carbon::now()->addSeconds($user['expiresIn']));
            session()->put('user', $user);
            session()->put('firestore_user', $fs_user);
            $loc=$_COOKIE['curloc'];
           
             $location = json_decode($loc);
            //  dd($location);
            $lat = $location->lat;
            $lng = $location->lng;
            // var url = "{{route('home.reservation',['lat'=>'latv','lng' =>'lngv'])}}";
            // url = url.replace('latv', lat);
            // url = url.replace('lngv', lng);
            return redirect(route('home.delivery',['lat'=>$lat,'lng' =>$lng]));
        }catch(FailedToSignIn $e){
            // Todo: Return with errors
            Log::Info($e);
            session()->flash('message', 'Invalid Credentials');
            return redirect(route('auth.login'));
        }
    }

    public function getFirestoreUserOrReturnNew($email, $authUser){
        // dd($authUser);
        $user = $this->usersRepository->getFirestoreUserByEmail($email);
        // dd($user);
        if($user){
            
          
            
            return $user;
        }else{
            return $this->usersRepository->createFirestoreUser($authUser, $email);
        }
    }

    public function getFirestoreUserOrReturnNewWithAuthId($authid){
        $email=null;
        $user = $this->usersRepository->getFirestoreUserByAuthId($authid);
        if($user){
            return $user;
        }else{
            return $this->usersRepository->createFirestoreUser($authid, $email);
        }
    }


    // Todo: Need to be able to log user out as well

    public function logUserOut(){
        session()->forget(['firebase_id_token', 'firebase_refresh_token', 'firebase_expires_at', 'user', 'firestore_user']);
        return redirect(route('home'));
    }

    public function getAuthenticatedUser()
    {
        // Todo: return authenticated user from session
    }

    public function logInWithRefreshToken(){

    }

    public function checkToken($token)
    {
        try {
            $verifiedIdToken = $this->auth->verifyIdToken($token);
        } catch (InvalidToken $e) {
            return false;
        }

        $uid = $verifiedIdToken->getClaim('sub');
        $user = $this->auth->getUser($uid);
        return $user;
    }
    public function loginWithGoogleToken($token,$fname,$lname){
        try{
            $signInResult = $this->auth->signInWithGoogleIdToken($token); 
               
            $user = $signInResult->data();
          
            $user['firstName'] = $fname;
            $user['lastName'] = $lname;
           
            $fs_user = $this->getFirestoreUserOrReturnNew($user['email'], $user);
            session()->put('firebase_id_token', $user['idToken']);
            session()->put('firebase_refresh_token', $user['refreshToken']);
            session()->put('firebase_expires_at', Carbon::now()->addSeconds($user['expiresIn']));
            session()->put('body', $fname);
            session()->put('user', $user);
            session()->put('firestore_user', $fs_user);
            return true;
        }catch(FailedToSignIn $e){
            // Todo: Return with errors
            Log::Info($e);
            session()->flash('message', 'Invalid Credentials');
            return redirect(route('auth.login'));
        }
    }
    public function loginWithFacebookToken($token){
        try{
            $signInResult = $this->auth->signInWithFacebookAccessToken($token); 
            // dd($fname);          
            $user = $signInResult->data();
            // dd($user);
            
            
            // dd($user);
            $fs_user = $this->getFirestoreUserOrReturnNew($user['email'], $user);
            session()->put('firebase_id_token', $user['idToken']);
            session()->put('firebase_refresh_token', $user['refreshToken']);
            session()->put('firebase_expires_at', Carbon::now()->addSeconds($user['expiresIn']));
           
            session()->put('user', $user);
            session()->put('firestore_user', $fs_user);
            return true;
        }catch(FailedToSignIn $e){
            // Todo: Return with errors
            Log::Info($e);
            session()->flash('message', 'Invalid Credentials');
            return redirect(route('auth.login'));
        }
    }
    public function loginWithAppleToken($token,$provider,$name,$email){
        try{
            $signInResult = $this->auth->signInWithIdpIdToken($provider,$token); 
            // dd($token);          
            $user = $signInResult->data();
            $user['firstName'] = $name;
            $user['email']=$email;
        //   $er=  $this->auth->signInWithRefreshToken($user['refreshToken']);
        
          $fs_user = $this->getFirestoreUserOrReturnNew($email,$user);
          
       
        if ($email == null && $email =='') {
            $fs_user = $this->getFirestoreUserOrReturnNewWithAuthId($user['localId']);
            
        }
          
            session()->put('firebase_id_token', $user['idToken']);
            session()->put('firebase_refresh_token', $user['refreshToken']);
            session()->put('firebase_expires_at', Carbon::now()->addSeconds($user['expiresIn']));
           
            session()->put('user', $user);
            session()->put('firestore_user', $fs_user);
            return true;
        }catch(FailedToSignIn $e){
            // Todo: Return with errors
            Log::Info($e);
            session()->flash('message', 'Invalid Credentials');
            return redirect(route('auth.login'));
        }
    }
}