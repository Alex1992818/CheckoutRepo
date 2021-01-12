<?php

namespace App\Http\Controllers;

use App\Repositories\Users\UsersFirebaseRepository;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Repositories\Vendors\VendorsRepositoryInterface;
use App\Services\FirebaseAuthService;
use Illuminate\Http\Request;
use Kreait\Firebase\Exception\Auth\EmailExists;
use Laravel\Fortify\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Factory;
use Firebase\Auth\Token\Exception\InvalidToken;
class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function passwordReset(Request $request){
        
        $apiKey="AIzaSyC1jKOFLhfQoZD3xJISSPnSW9-4SyYPpjY";
        // $serviceAccount = ServiceAccount::fromJsonFile('/google-service-account.json');
        $firebase = (new Factory);
        // ->withServiceAccountAndApiKey($serviceAccount, $apiKey)
        // ->create();

     $auth = $firebase->createAuth();
     $email = $request->email;
     $auth->sendPasswordResetLink($email);
    //  dd($auth->sendPasswordResetLink($email));
     return view('passwordreset')->with('success',1);
    }

    public function login(Request $request){
        $service = new FirebaseAuthService;
        Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ])->validate();

        return $service->logInWithEmailAndPassword($request->email, $request->password);
    }

     public function google(Request $request){
        //  dd($request->fname);
        $service = new FirebaseAuthService;
        $service->loginWithGoogleToken($request->select,$request->fname,$request->lname);
        return route("home");
    }

    public function apple(Request $request){
        //  dd($request->fname);
        $service = new FirebaseAuthService;
        $service->loginWithAppleToken($request->select,$request->providerId,$request->name,$request->email);
        return route("home");
    }

    public function facebook(Request $request){
        //  dd($request->fname);
        $service = new FirebaseAuthService;
        $service->loginWithFacebookToken($request->select);
        return route("home");
    }
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request, UsersRepositoryInterface $usersRepository){
        // Todo: when registering, create a regular user
        // Todo: Validate
        $request->phone = trim($request->phone);
        Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'confirmed'],
            'phone' => ['required', 'numeric', 'digits:10'],
            'firstName' => ['required'],
            'dob' => ['required']
        ])->validate();
        //   dd($request->firstName);
        // value=
        $userProperties = [
           
            'email' => $request->email,
            'tenantId' => "$request->firstName",
            'phoneNumber' => '+1' . $request->phone,
            'password' => $request->password,
            'displayName' => $request->firstName,
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'photoUrl' =>"$request->firstName/$request->address/$request->apartmentno/$request->phone/$request->lastName/$request->dob",
            'disabled' => false,
            'dob'=>$request->dob,
            'apartmentno'=>$request->apartmentno,
            'address'=>$request->address
            
        ];

        try{
            $user = $usersRepository->createAuthUser($userProperties);
        //    dd($user);
        }catch(EmailExists $e){
            return redirect()->back()->withErrors(['That email already exists']);
        }

        session()->flash('type', 'success');
        session()->flash('message', 'Account created successfully. Please log in below.');
        return redirect(route('auth.login'));
    }

    public function logout(){
        $service = new FirebaseAuthService;
        return $service->logUserOut();
    }
}