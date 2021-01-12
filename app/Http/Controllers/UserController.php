<?php

namespace App\Http\Controllers;

use App\Repositories\Users\UsersRepositoryInterface;
use App\Repositories\Vendors\VendorsRepositoryInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Auth\SignIn\FailedToSignIn;
use Omnipay\Omnipay;

class UserController extends Controller
{
    public function showPastOrders(VendorsRepositoryInterface $repository, UsersRepositoryInterface $usersRepository)
    {
        if (session()->has('firestore_user')) {
            $fs_user = session()->get('firestore_user');
            $orders = $usersRepository->getOrdersByUserId($fs_user->user_id);
            $orderWithVendor = [];

            foreach ($orders as $order) {
                // $vendor = $repository->getVendorById($order['products'][0]['vendor']);
                // $order['vendor'] = $order['products'][0]['vendor'];

                try {
                    $order['created_at'] = Carbon::createFromTimestamp($order['createdAt']->get()->getTimestamp());
                } catch (Exception $e) {
                    $order['created_at'] = Carbon::now()->timestamp;
                }
                $order['created_at_time'] = $order['created_at']->format('g:i a');
                array_push($orderWithVendor, $order);
            }
            
            $categories = $repository->getVendorCategories();
            return view('app.user.orders.all', [
                'orders' => $orderWithVendor,
                'categories' => $categories
            ]);
        } else {
            //return redirect('/');
        }
    }

    public function showOrder($id, VendorsRepositoryInterface $repository, UsersRepositoryInterface $usersRepository)
    {
        $order = $usersRepository->getOrderById($id);
        if ($order->createdAt) {

            $order->created_at = Carbon::createFromTimestamp($order->created_at, 'EST');
            $order->created_at_time = $order->created_at->format('g:i a');
        }
        $vendor = $repository->getVendorById($order->products[0]->vendor);

        
        return view('app.user.orders.detail', [
            'order' => $order,
            'vendor' => $vendor
        ]);
        // return redirect()->route('home');
    }

    private function getUserData()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $usersRef = $database->collection('users');
        $snapshot = $usersRef->documents();
        $users = [];
        foreach ($snapshot as $item) {
            array_push($users, $item->data());
        }

        return collect($users);


        $database = app('firebase.database');
        $reference = $database->getReference('/');
        $value = $reference->getValue();
        return $value;
        $users = [];
        foreach ($value as $val) {
            array_push($users, $val);
        }
        return $users;
    }

    public function loginTest()
    {
        $auth = app('firebase.auth');
        $email = 'brandonjbegle@gmail.com';
        $password = 'testing1234';
        try {
            $signInResult = $auth->signInWithEmailAndPassword($email, $password);
            return $signInResult->data();
        } catch (FailedToSignIn $e) {
            return $e;
            return false;
        }
    }
    
    public function showPrivacy(UsersRepositoryInterface $usersRepository)
    {
        return view('app.user.privacy');
    }

    public function showHelp(UsersRepositoryInterface $usersRepository){
        return view('app.help_us');
    }
    
    public function showAccount(UsersRepositoryInterface $usersRepository)
    {
        $fs_user = session()->get('firestore_user');
        // Todo: Create a new collection on each users object
        if(!isset($fs_user->user_id)){
            return redirect('login');
        }
        $addresses = $usersRepository->getUserAddresses($fs_user->user_id);
        return isset($fs_user->user_id) ? view('app.user.accounts.profile', [
            'fs_user' => $fs_user,
            'addresses' => $addresses,
            // 'cards' => $cards
        ]) : redirect('login');
    }

    public function addAddress(Request $request, UsersRepositoryInterface $usersRepository)
    {

        $this->validate($request, [
            'address1' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip' => 'required',
        ]);

        $fs_user = session()->get('firestore_user');
        // dd($request->addtitle);
        $data = [
            'city' => $request->city,
            'country' => 'United States',
            'line1' => $request->address1,
            'line2' => $request->address2,
            'state' => $request->state,
            'zip' => $request->zip,
            'title1' => $request->addtitle
        ];
        try {
            $usersRepository->addUserAddress($fs_user, $data);
        } catch (Exception $e) {
            Log::Info($e);
            session()->flash('message', 'There was an error updating your account. Please contact support.');
        }
        return redirect('/user/account');
    }


    public function updateAddress(Request $request, UsersRepositoryInterface $usersRepository)
        {
        $fs_user = session()->get('firestore_user');
        $addresses = $usersRepository->getUserAddresses($fs_user->user_id)->where('address_id',$request->address_id)->first();
         $collection = $usersRepository->firestore->collection('users');
         $query = $collection->document($fs_user->user_id)->collection("address")->document($request->address_id);
        
        $data = [
            'city' => $request->city,
            'country' => 'United States',
            'line1' => $request->address1,
            'line2' => $request->address2,
            'state' => $request->state,
            'postalCode' => $request->zip,
            'title1' => $request->addtitle
        ];
        $query->set($data, [
            'merge' => true
        ]);
    
        
        
        
        
        
        try {
           
        } catch (Exception $e) {
            Log::Info($e);
            session()->flash('message', 'There was an error updating your account. Please contact support.');
        }
        return redirect('/user/account');
       }


    public function deleteAddress(Request $request, UsersRepositoryInterface $usersRepository){
        try {
            $usersRepository->deleteAddress($request->id);
        } catch (Exception $e) {
            Log::Info($e);
            session()->flash('message', 'There was an error updating your account. Please contact support.');
        }
        return redirect('/user/account');
    }

    public function deleteCard(Request $request, UsersRepositoryInterface $usersRepository){
        try {
            $usersRepository->deletePaymentMethod($request->id);
        } catch (Exception $e) {
            Log::Info($e);
            session()->flash('message', 'There was an error deleting your card. Please contact support.');
        }
        return redirect('/user/wallet');
    }

    public function storeCard(Request $request, UsersRepositoryInterface $usersRepository){
        // dd($request->ser);
        $fs_user = session()->get('firestore_user');
        $name=$request->ser;
        $fullStripeToken = json_decode(base64_decode($request->fulltoken), false);

        
        $fullStripeToken->card->title = $name;

        $gateway = Omnipay::create('Stripe');
        $gateway->setApiKey(env('STRIPE_SECRET'));

        $stripeCustomer = $fs_user->stripeCustomerID ?? null;
        

        if (!$stripeCustomer) {
            $customerResponse = $gateway->createCustomer([
                'description' => 'Chekout User',
                'email' => $fs_user->email
            ])->send();
            if ($customerResponse->isSuccessful()) {
                $stripeCustomer = $customerResponse->getCustomerReference();
                $usersRepository->updateFirestoreUser($fs_user->user_id, [
                    'stripeCustomerID' => $stripeCustomer
                ]);
                $fs_user->stripeCustomerId = $stripeCustomer;
                session()->forget('firestore_user');
                session()->put('firestore_user', $fs_user);
            } else {
                session()->flash('message', 'There was an error creating your order.');
                return redirect(route('/user/wallet'));
            }
        }

        $cardResponse = $gateway->createCard([
            'token' => $request->paymentmethod,
            'customerReference' => $stripeCustomer,
        ])->send();

        if($cardResponse->isSuccessful()){
            try{
                $usersRepository->createNewPaymentMethod($fullStripeToken);
            }catch (Exception $e) {
                Log::Info($e);
                session()->flash('message', 'There was an error adding your card. Please contact support.');
            }
            return redirect('/user/wallet');
        } else {
            session()->flash('message', 'There was an error adding your card. Please contact support.');
            return redirect('/user/wallet');
        }

        

    }

    public function showWallet(Request $request, UsersRepositoryInterface $usersRepository)
    {
        $fs_user = session()->get('firestore_user');
        // Todo: Create a new collection on each users object
        if(!isset($fs_user->user_id)) return redirect('login');
        $cards = $usersRepository->getAllPaymentMethodsByOwnerId($fs_user->user_id);
        return view('app.user.accounts.wallet.index', [
            'cards' => $cards
        ]);
    }

    public function editWallet()
    {
        return view('app.user.accounts.wallet.edit');
    }

    public function showFavorite(UsersRepositoryInterface $usersRepository)
    {
        $fs_user = null;
        if (session()->has('firestore_user')) {
            $fs_user = session()->get('firestore_user');
        }
        if(is_null($fs_user)){
            return redirect(route('app.user.favorite.show'));
        }
        
        $favorites = $usersRepository->getFavorites($fs_user->user_id, 'all');

        $fav_restaurants = [];
        $fav_foods = [];

        foreach($favorites as $item) {
            if($item["type"] == 'restaurant'){
                array_push($fav_restaurants, get_object_vars($item["data"]));
            } else {
                array_push($fav_foods, get_object_vars($item["data"]));
            }
        }
        
        return view('app.user.accounts.favorite', compact('fav_restaurants', 'fav_foods'));
    }

    public function fixstore(){
        $this->auth = app('firebase.auth');
        $firestoreConnection = app('firebase.firestore');
        $ref = $firestoreConnection->database();
        $refs = $ref->collection('restaurants');

        foreach($refs->documents() as $document){
            $menu = $ref->collection('restaurants')->document($document->id())->collection('restaurant_menu');
            foreach($menu->documents() as $menu_doc){
                $section = $ref->collection('restaurants')->document($document->id())->collection('restaurant_menu')->document($menu_doc->id())->collection('menu_section');
                foreach($section->documents() as $sec_doc){
                    $item = $ref->collection('restaurants')->document($document->id())->collection('restaurant_menu')->document($menu_doc->id())->collection('menu_section')->document($sec_doc->id())->collection('menu_item');
                    foreach($item->documents() as $item_doc){

                        $item_doc->update([[
                            'path' => 'sizeRequired',
                            'value' => false
                        ]]);
                    }
                }
            }
        }
        return 'success';
    }


}