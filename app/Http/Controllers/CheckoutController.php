<?php

namespace App\Http\Controllers;

use App\Models\Firebase\Cart;
use App\Repositories\Users\UsersRepositoryInterface;
use App\Repositories\Vendors\VendorsRepositoryInterface;
use App\Services\ExternalApis\RelayDelivery;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Omnipay\Omnipay;
use Kreait\Firebase\Factory;
use Carbon\Carbon;
class CheckoutController extends Controller
{
   public $firestore;
   
   public function index(VendorsRepositoryInterface $vendorsRepository, UsersRepositoryInterface $usersRepository)
    {
        if( empty(session()->get('firestore_user')) )
            return redirect(route('auth.login'));
        $fs_user = null;
        if (session()->has('firestore_user')) {
            $fs_user = session()->get('firestore_user');
        }   

        $cards = $usersRepository->getAllPaymentMethodsByOwnerId($fs_user->user_id);
        // echo json_encode(session()->get('user'));
        // return;
       
        $customerName='';
        $customerAddress=[];
        $address1 = '';
        $customerPhone='';
        $users = [];
        $collection = $usersRepository->firestore->collection('users');
        $query = $collection->document($fs_user->user_id)->collection("address")->limit(1);
        // $card= $collection->document($fs_user->user_id)->collection("cards")->limit(1);;
        $addresses = $usersRepository->getUserAddresses($fs_user->user_id);
     
        if($query->documents()->size()){
            foreach ($query->documents() as $document) { 
                $cardDetails = $document->data();
                // dd($cardDetails);
                $lastname=$fs_user->lastName ?? '';
                $customerName = $fs_user->firstName ?? ''.' '.$lastname;
                $customerAddress = new \stdClass();
                $address1 = $cardDetails['line1'] ?? '';
                $customerAddress->address2 = $cardDetails['line2'] ?? '';
                $customerAddress->city = $cardDetails['city'] ?? '';
                $customerAddress->state = $cardDetails['state'];
                $customerAddress->zip = $cardDetails['zip'] ?? '';
                $customerPhone = $cardDetails['phone'] ?? '';
                //   dd($cardDetails['line1']);
            }
            
        }
        
       
   
        $tax_rate = .07875;
        $fee_rate = .10;
        $cart = session('cart');
        if (!empty($cart)) {
            $cartStatus = true;
            $restaurant = null;
            // $restaurant = $vendorsRepository->getVendorById($cart->vendor);
        } else {
            $cartStatus = false;
            $restaurant = null;
        }
    //    dd($cart);
    if (!empty($cart)) {
    $i=0;
    foreach ($cart as $key => $value) {
        $i=$value['total_price']+$i;
    }
}
$totalCost = $this->calculateTotalCost($tax_rate, $fee_rate);
$fees = $this->calculateFees($tax_rate, $fee_rate);
$is=$totalCost;
// dd($i);
        return view('app.checkout.index', [
            'customerName' => $customerName,
            'customerAddress' => $customerAddress,
            'customerPhone' => $customerPhone,
            'cartStatus' => $cartStatus,
            'restaurant' => $restaurant,
            'taxRate' => $tax_rate,
            'feeRate' => $fee_rate,
            // 'savedCard' => $savedCard,
            // 'lastFour' => $lastFour,
            // 'cardProvider' => $cardProvider,
            // 'expiration' => $expiration,
            'totalprice'=>$is ?? 0,
            'add'=>$address1,
            'cards' => $cards,
            'addresses' => $addresses
        ]);
    }
    public function attemptOrder(Request $request, UsersRepositoryInterface $usersRepository, VendorsRepositoryInterface $vendorsRepository)
    {
        // dd($request->paymentmethod);
        if(isset($request->isTemporary)){
            return $this->relayTemporary($request, $usersRepository, $vendorsRepository);
        }


        if(true){
                    $mode = session()->get('mode');

                    if( empty(session()->get('firestore_user')) )
                        return redirect(route('auth.login'));
                    $fs_user = session('firestore_user');
                    //return $request->all();
                    
                    $tax_rate = .07875;
                    $fee_rate = .10;
                    $tip = $request->tip??0;
            
                    $this->validate($request, [
                        
                        'customer_phone' => 'required',
                        'cardselect' => 'required',
                        'customer_name' => 'required'
                    ]);
                    // Todo: Remove this when we add more states;
                    // $collection = $usersRepository->firestore->collection('users');
                    //  $query = $collection->document($fs_user->user_id)->collection("address")->document($request->address_id);
                    $data1 = [
                        'title1'=>$request->customer_name ?? '',
                        'city' => $request->city ?? '',
                        'country' => 'United States',
                        'line1' => $request->address1??'',
                        'line2' => $request->address2 ?? '',
                        'state' => $request->state,
                        'phone' => $request->customer_phone ?? '',
                        'zip' => $request->zip ?? '',
                        'type'=>$request->type ?? '',
                    ];
                    //   $query->set($data1, [
                    //     'merge' => true
                    // ]);
                
                
                    // Todo: Set the restaurant name;
                    $addresses = $usersRepository->getUserAddresses($fs_user->user_id);
                    if($addresses->count()<=3){
                    $usersRepository->addUserAddress($fs_user, $data1);
                    }      
                    $request->merge(['state' => 'NY']);
            
                //   dd($firebaseOrder);
                $mode = session()->get('mode');
                

                if( empty(session()->get('firestore_user')) )
                    return redirect(route('auth.login'));
                $fs_user = session('firestore_user');
                //return $request->all();
                $tax_rate = .07875;
                $fee_rate = .10;

                $this->validate($request, [
                    
                    'customer_phone' => 'required',
                    'cardselect' => 'required',
                    'customer_name' => 'required'
                ]);
                // Todo: Remove this when we add more states;
                // $collection = $usersRepository->firestore->collection('users');
                //  $query = $collection->document($fs_user->user_id)->collection("address")->document($request->address_id);
                $data1 = [
                    'title1'=>$request->customer_name,
                    'city' => $request->city,
                    'country' => 'United States',
                    'line1' => $request->address1,
                    'line2' => $request->address2,
                    'state' => $request->state,
                    'phone' => $request->customer_phone ?? '',
                    'zip' => $request->zip,
                    'type'=>$request->type,
                ];
                //   $query->set($data1, [
                //     'merge' => true
                // ]);

        
                // Todo: Set the restaurant name;
                $addresses = $usersRepository->getUserAddresses($fs_user->user_id);
                if($addresses->count()<=3){
                $usersRepository->addUserAddress($fs_user, $data1);
                }      
                $request->merge(['state' => 'NY']);

                //   dd($firebaseOrder);

                $factory = new Factory();
        
                $firestore = $factory->createFirestore();
            
                $database = $firestore->database();

                $cart = session('cart');
                
                $userRef =  $database->collection('restaurants')->where("id","=",$cart[0]["vendor"])->limit(1)->documents();
                $kst="";
                $dst="";
                $name = "";
                        foreach ($userRef as $item) {
                        
                        // if(strlen($item) > 300) {            
                            $kst = $item['relay_key'];
                            $name = $item['name'];
                        
                            $dst = $item['relay_site'];
                            //  dd($producer);
                        // }
                        }

                

                if($mode == 'delivery') {
                    if($kst != "" && $dst != "" && $kst != null && $dst != null){
                        $service = new RelayDelivery();

                        
                        $location = [
                            "producerLocationKey" => $dst,
                            "address" => [
                            "address1" => $request->address1,
                            "city" => $request->city,
                            "state" => $request->state,
                            "zip" => $request->zip,
                            ]
                        ];
                        
                        
                    

                        try{
                            if(!$service->canDeliverTo($location, $kst)){
                                session()->flash('message', 'Sorry, '.$name.' cannot deliver to: '.$request->address);
                                return redirect(route('app.checkout.index'));
                            } 
                        }catch(Exception $e){
                            session()->flash('message', $e->getMessage());
                            return redirect(route('app.checkout.index'));
                        }
                    }
                }

        
            
                if ($request->cardselect == 'new') {
                    try {
                        
                        $fullStripeToken = json_decode(base64_decode($request->fulltoken), false);
                        
                        $usersRepository->createNewPaymentMethod($fullStripeToken);
                    
                        
                    } catch (Exception $e) {
                        //dd($e);
                    }
                    $request->lastfour;
                    $request->paymentmethod;
                } else {
                    $request->paymentmethod;
                }
            
                if ($fs_user) {
                    $stripeCustomer = $fs_user->stripeCustomerID ?? null;
                } else {
                    session()->flash('message', 'You must be logged in to complete an order.');
                    return redirect(route('app.checkout.index'));
                }

                $gateway = Omnipay::create('Stripe');
                $gateway->setApiKey(env('STRIPE_SECRET'));

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
                        return redirect(route('app.checkout.index'));
                    }
                }


                $restaurantName = null;
                $totalCost = $this->calculateTotalCost($tax_rate, $fee_rate) + $tip;
                
                $fees = $this->calculateFees($tax_rate, $fee_rate);


                if(($mode == 'delivery') && ($request->rush == 1)) {
                    $totalCost =$totalCost+3;
                
                    $fees =$fees+3;
                    }
            

                $tx=$fee_rate+$tax_rate;
                // dd($tax_rate,$fee_rate,$fees,$totalCost);
                $firebaseOrder = [];
                
                
                    $selecteddate='';
                    $selectedday='';
                    $selectedtime='';
                    $type='';
                    $data567=[];
                    if($mode == 'reservation') {
                     
                      
                      $selecteddate=session()->get('selecteddate');
                      $selectedday=session()->get('selectedday');
                       $selectedtime=session()->get('selectedtime');
                      $type=session()->get('type');
                      $fulltime=session()->get('fulldate');
                           
      
      
      
      
                       foreach ($cart as $kt => $vale) {
                        
                      
                              $data567=[
                                 'name'=>$request->customer_name ?? '',
                                 'phone'=>$request->customer_phone ?? '',
                                 'reservationDateTime'=>$fulltime,
                                 'reservationDay'=>$selectedday,
                                 'createdAt' => Carbon::now(),
                                 'vendorId'=>$vale['vendor'] ?? '',
                                 
                                 'restaurantName'=>$vale['res_name'] ?? '',
                                 
                                 'type'=>$type ?? '',
                              ];
                              
                              $usersRepository->addReservations($data567);
                              // dd($usersRepository->addReservations($data));
                             
                              
                          }
                          $firebaseOrder = $usersRepository->createReservationOrder($fs_user, $request->all(), $totalCost,$tx,$data567);
                    }
                    else{
                      $firebaseOrder = $usersRepository->createOrder($fs_user, $request->all(), $totalCost, $fees,$tx);
                    }

                    
                $firebaseOrderId = $firebaseOrder->order_id;
                if(($mode == 'delivery') && ($request->rush == 1)) {
                    $fees=3;
                    $usersRepository->rushOrder($firebaseOrderId, $fees);
                }
                // dd($userRef);
                $returnUrl = env('APP_URL') . '/order/callback/' . $firebaseOrderId;
                
                $data = [
                    'amount' => $totalCost,
                    'currency' => 'USD',
                    'description' => 'Chekout Order for ' . $restaurantName . ': ' . $firebaseOrderId,
                //                'paymentMethod' => $paymentMethod,
                //                'returnUrl' => $returnUrl,
                //                'confirm' => true,
                ];
                if ($request->cardselect == 'new') {
                    $cardResponse = $gateway->createCard([
                        'token' => $request->paymentmethod,
                        'customerReference' => $stripeCustomer,
                    ])->send();

                    if($cardResponse->isSuccessful()){
                        $data['cardReference'] = $cardResponse->getTransactionReference();
                        $data['customerReference'] = $stripeCustomer;
                    }else{
                        Log::Info($cardResponse->getMessage());
                        session()->flash('message', 'There was a problem with your payment method. Try another.');
                        return redirect(route('app.checkout.index'));
                    }
                } else {
                    // $savedCardRaw = $usersRepository->getPaymentMethodByOwnerId($fs_user->user_id);
                    // dd($savedCardRaw);
                    if ($request->selectedCard) {
                        $data['customerReference'] = $stripeCustomer;
                        $data['paymentMethod'] = $request->selectedCard;
                    }
                }


                $response = $gateway->purchase($data)->send();
                // dd($response);
                if ($response==false) {
                    return $response->redirect();
                } else if ($response->isSuccessful()) {
                    // Todo: Enable delivery
                    // Todo: Update the order with the charge id and the status
                    
                    $cart = session('cart');
                
                    //Mail::to('usamtg@hotmail.com')->send(new SendMailable('Dave'));
                    $usersRepository->updateOrder($firebaseOrderId, $response->getTransactionReference(), 'Order Paid');
                    
                
                    
                    if($mode != 'delivery'){
                        session()->forget('cart');
                        return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
                    }



            
                
                // echo $kst;
                // echo $dst;
            
                // return;
                if($kst != "" && $dst != "" && $kst != null && $dst != null){

                    try{
                        if($this->createRelayDelivery($firebaseOrderId, $request->all(),$userRef, $cart, (($cart->subtotal??0) * $tax_rate), false)){
                            // dd($this->createRelayDelivery($firebaseOrderId, $request->all(), $cart, (($cart->subtotal??0) * $tax_rate)));
                            session()->forget('cart');
                            return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
                        }else{
                            session()->flash('message', 'There was a problem creating your delivery. Try again.');
                            return redirect(route('app.checkout.index'));
                        }
                        session()->forget('cart');
                        return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
                    }catch(Exception $e){
                        

                        // $to      = 'kosong0926@hotmail.com';
                        $to      = 'david@chekoutteam.com';
                        $subject = 'Relay Dellivery Api Error';

                        $message = '
                            <html>
                            <head>
                            <title>Error Report</title>
                            </head>
                            <body>
                            <h3>Here is Error Details For Relay Delivery Api</h3>
                            <h4>Error</h4>
                            <code>'. $e->getMessage() .'</code>
                            <h4>Relay Token</h4>
                            <code>'. $kst .'</code>
                            <h4>Producer Key</h4>
                            <code>'. $dst .'</code>
                            <h4>Vendor Id</h4>
                            <code>'. $firebaseOrder->vendor .'</code>
                            <h4>Order Id</h4>
                            <code>'. $firebaseOrderId .'</code>
                            </body>
                            </html>
                            ';

                        // $headers = 'From: webmaster@example.com' . "\r\n" .
                        //     'Reply-To: webmaster@example.com' . "\r\n" .
                        //     'X-Mailer: PHP/' . phpversion();
                        $headers[] = 'MIME-Version: 1.0';
                        $headers[] = 'Content-type: text/html; charset=iso-8859-1';


                        mail($to, $subject, $message,implode("\r\n", $headers));


                        session()->flash('message', 'There was a problem creating your delivery.');
                        return redirect(route('app.checkout.index'));
                    }

                } else {
                    session()->forget('cart');
                    return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
                }
                
                    

                } else {
                
                    session()->forget('cart');
                        return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
                }
        
            }
            else{

            
                $mode = session()->get('mode');
            

                if( empty(session()->get('firestore_user')) )
                    return redirect(route('auth.login'));
                $fs_user = session('firestore_user');
                //return $request->all();
                $tax_rate = .07875;
                $fee_rate = .10;

                $this->validate($request, [
                    
                    'customer_phone' => 'required',
                    'cardselect' => 'required',
                    'customer_name' => 'required'
                ]);
                // Todo: Remove this when we add more states;
                // $collection = $usersRepository->firestore->collection('users');
                //  $query = $collection->document($fs_user->user_id)->collection("address")->document($request->address_id);
                $data1 = [
                    'title1'=>$request->customer_name,
                    'city' => $request->city,
                    'country' => 'United States',
                    'line1' => $request->address1,
                    'line2' => $request->address2,
                    'state' => $request->state,
                    'phone' => $request->customer_phone ?? '',
                    'zip' => $request->zip,
                    'type'=>$request->type,
                ];
                //   $query->set($data1, [
                //     'merge' => true
                // ]);
        
        
                // Todo: Set the restaurant name;
                $addresses = $usersRepository->getUserAddresses($fs_user->user_id);
                if($addresses->count()<=3){
                $usersRepository->addUserAddress($fs_user, $data1);
                }      
                $request->merge(['state' => 'NY']);

                //   dd($firebaseOrder);

                $factory = new Factory();
        
                $firestore = $factory->createFirestore();
            
                $database = $firestore->database();

                $cart = session('cart');
                
                $userRef =  $database->collection('restaurants')->where("id","=",$cart[0]["vendor"])->limit(1)->documents();
                $kst="";
                $dst="";
                $name = "";
                        foreach ($userRef as $item) {
                        
                        // if(strlen($item) > 300) {            
                            $kst = $item['relay_key'];
                            $name = $item['name'];
                        
                            $dst = $item['relay_site'];
                            //  dd($producer);
                        // }
                        }

            

                if($mode == 'delivery') {
                    if($kst != "" && $dst != "" && $kst != null && $dst != null){
                        $service = new RelayDelivery();

                        $location = [
                            "producerLocationKey" => $dst,
                            "address" => [
                            "address1" => $request->address1,
                            "city" => $request->city,
                            "state" => $request->state,
                            "zip" => $request->zip,
                            ]
                        ];

                    

                        try{
                            if(!$service->canDeliverTo($location, $kst)){
                                session()->flash('message', 'Sorry, '.$name.' cannot deliver to: '.$request->address);
                                return redirect(route('app.checkout.index'));
                            } 
                        }catch(Exception $e){
                            session()->flash('message', $e->getMessage());
                            return redirect(route('app.checkout.index'));
                        }
                    }
                }

        
            
            if ($request->cardselect == 'new') {
                try {
                    
                    $fullStripeToken = json_decode(base64_decode($request->fulltoken), false);
                    
                    $usersRepository->createNewPaymentMethod($fullStripeToken);
                
                    
                } catch (Exception $e) {
                    //dd($e);
                }
                $request->lastfour;
                $request->paymentmethod;
            } else {
                $request->paymentmethod;
            }
        
            if ($fs_user) {
                $stripeCustomer = $fs_user->stripeCustomerID ?? null;
            } else {
                session()->flash('message', 'You must be logged in to complete an order.');
                return redirect(route('app.checkout.index'));
            }

            $gateway = Omnipay::create('Stripe');
            $gateway->setApiKey(env('STRIPE_SECRET'));

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
                    return redirect(route('app.checkout.index'));
                }
            }


            $restaurantName = null;
            $totalCost = $this->calculateTotalCost($tax_rate, $fee_rate);
            
            $fees = $this->calculateFees($tax_rate, $fee_rate);


            if(($mode == 'delivery') && ($request->rush == 1)) {
                $totalCost =$totalCost+3;
            
                $fees =$fees+3;
                }
        

            $tx=$fee_rate+$tax_rate;
        // dd($tax_rate,$fee_rate,$fees,$totalCost);
            $firebaseOrder = [];
                    
                    
            $selecteddate='';
            $selectedday='';
            $selectedtime='';
            $type='';
            $data567=[];
            if($mode == 'reservation') {
            
            
            $selecteddate=session()->get('selecteddate');
            $selectedday=session()->get('selectedday');
            $selectedtime=session()->get('selectedtime');
            $type=session()->get('type');
            $fulltime=session()->get('fulldate');
                




            foreach ($cart as $kt => $vale) {
                
            
                    $data567=[
                        'name'=>$request->customer_name ?? '',
                        'phone'=>$request->customer_phone ?? '',
                        'reservationDateTime'=>$fulltime,
                        'reservationDay'=>$selectedday,
                        'createdAt' => Carbon::now(),
                        'vendorId'=>$vale['vendor'] ?? '',
                        
                        'restaurantName'=>$vale['res_name'] ?? '',
                        
                        'type'=>$type ?? '',
                    ];
                    
                    $usersRepository->addReservations($data567);
                    // dd($usersRepository->addReservations($data));
                    
                    
                }
                $firebaseOrder = $usersRepository->createReservationOrder($fs_user, $request->all(), $totalCost,$tx,$data567);
            }
            else{
            $firebaseOrder = $usersRepository->createOrder($fs_user, $request->all(), $totalCost, $fees,$tx);
            }

            
            $firebaseOrderId = $firebaseOrder->order_id;
            if(($mode == 'delivery') && ($request->rush == 1)) {
                $fees=3;
                $usersRepository->rushOrder($firebaseOrderId, $fees);
            }
            // dd($userRef);
            $returnUrl = env('APP_URL') . '/order/callback/' . $firebaseOrderId;
            
            $data = [
                'amount' => $totalCost,
                'currency' => 'USD',
                'description' => 'Chekout Order for ' . $restaurantName . ': ' . $firebaseOrderId,
        //                'paymentMethod' => $paymentMethod,
        //                'returnUrl' => $returnUrl,
        //                'confirm' => true,
            ];
            if ($request->cardselect == 'new') {
                $cardResponse = $gateway->createCard([
                    'token' => $request->paymentmethod,
                    'customerReference' => $stripeCustomer,
                ])->send();

                if($cardResponse->isSuccessful()){
                    $data['cardReference'] = $cardResponse->getTransactionReference();
                    $data['customerReference'] = $stripeCustomer;
                }else{
                    Log::Info($cardResponse->getMessage());
                    session()->flash('message', 'There was a problem with your payment method. Try another.');
                    return redirect(route('app.checkout.index'));
                }
            } else {
                // $savedCardRaw = $usersRepository->getPaymentMethodByOwnerId($fs_user->user_id);
                // dd($savedCardRaw);
                if ($request->selectedCard) {
                    $data['customerReference'] = $stripeCustomer;
                    $data['paymentMethod'] = $request->selectedCard;
                }
            }

        
            $response = $gateway->purchase($data)->send();
            // dd($response);
            if ($response==false) {
                return $response->redirect();
            } else if ($response->isSuccessful()) {
                // Todo: Enable delivery
                // Todo: Update the order with the charge id and the status
                
                $cart = session('cart');
            
                //Mail::to('usamtg@hotmail.com')->send(new SendMailable('Dave'));
                $usersRepository->updateOrder($firebaseOrderId, $response->getTransactionReference(), 'Order Paid');
                
            
                
                if($mode != 'delivery'){
                    session()->forget('cart');
                    return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
                }



        
            
            // echo $kst;
            // echo $dst;
        
            // return;
            if($kst != "" && $dst != "" && $kst != null && $dst != null){

                try{
                    if($this->createRelayDelivery($firebaseOrderId, $request->all(),$userRef, $cart, (($cart->subtotal??0) * $tax_rate))){
                        // dd($this->createRelayDelivery($firebaseOrderId, $request->all(), $cart, (($cart->subtotal??0) * $tax_rate)));
                        session()->forget('cart');
                        return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
                    }else{
                        session()->flash('message', 'There was a problem creating your delivery. Try again.');
                        return redirect(route('app.checkout.index'));
                    }
                    session()->forget('cart');
                    return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
                }catch(Exception $e){
                    

                    // $to      = 'kosong0926@hotmail.com';
                    $to      = 'david@chekoutteam.com';
                    $subject = 'Relay Dellivery Api Error';

                    $message = '
                        <html>
                        <head>
                        <title>Error Report</title>
                        </head>
                        <body>
                        <h3>Here is Error Details For Relay Delivery Api</h3>
                        <h4>Error</h4>
                        <code>'. $e->getMessage() .'</code>
                        <h4>Relay Token</h4>
                        <code>'. $kst .'</code>
                        <h4>Producer Key</h4>
                        <code>'. $dst .'</code>
                        <h4>Vendor Id</h4>
                        <code>'. $firebaseOrder->vendor .'</code>
                        <h4>Order Id</h4>
                        <code>'. $firebaseOrderId .'</code>
                        </body>
                        </html>
                        ';

                    // $headers = 'From: webmaster@example.com' . "\r\n" .
                    //     'Reply-To: webmaster@example.com' . "\r\n" .
                    //     'X-Mailer: PHP/' . phpversion();
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1';


                    mail($to, $subject, $message,implode("\r\n", $headers));


                    session()->flash('message', 'There was a problem creating your delivery.');
                    return redirect(route('app.checkout.index'));
                }

            } else {
                session()->forget('cart');
                return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
            }
            
                

            } else {
            
                session()->forget('cart');
                    return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
            }
        
        }
    }

    private function relayTemporary(Request $request, UsersRepositoryInterface $usersRepository, VendorsRepositoryInterface $vendorsRepository){
        $mode = session()->get('mode');

        if( empty(session()->get('firestore_user')) )
            return redirect(route('auth.login'));
        $fs_user = session('firestore_user');
        //return $request->all();
        
        $tax_rate = .07875;
        $fee_rate = .10;

        $this->validate($request, [
            
            'customer_phone' => 'required',
            'cardselect' => 'required',
            'customer_name' => 'required'
        ]);
        // Todo: Remove this when we add more states;
        // $collection = $usersRepository->firestore->collection('users');
        //  $query = $collection->document($fs_user->user_id)->collection("address")->document($request->address_id);
        $data1 = [
            'title1'=>$request->customer_name ?? '',
            'city' => $request->city ?? '',
            'country' => 'United States',
            'line1' => $request->address1??'',
            'line2' => $request->address2 ?? '',
            'state' => $request->state,
            'phone' => $request->customer_phone ?? '',
            'zip' => $request->zip ?? '',
            'type'=>$request->type ?? '',
        ];
        //   $query->set($data1, [
        //     'merge' => true
        // ]);
    
    
        // Todo: Set the restaurant name;
        $addresses = $usersRepository->getUserAddresses($fs_user->user_id);
        if($addresses->count()<=3){
        $usersRepository->addUserAddress($fs_user, $data1);
        }      
        $request->merge(['state' => 'NY']);

        //dd($firebaseOrder);
        $mode = session()->get('mode');
        

        if( empty(session()->get('firestore_user')) )
            return redirect(route('auth.login'));
        $fs_user = session('firestore_user');
        //return $request->all();
        $tax_rate = .07875;
        $fee_rate = .10;

        $this->validate($request, [            
            'customer_phone' => 'required',
            'customer_name' => 'required'
        ]);
        // Todo: Remove this when we add more states;
        // $collection = $usersRepository->firestore->collection('users');
        //  $query = $collection->document($fs_user->user_id)->collection("address")->document($request->address_id);
        $data1 = [
            'title1'=>$request->customer_name,
            'city' => $request->city,
            'country' => 'United States',
            'line1' => $request->address1,
            'line2' => $request->address2,
            'state' => $request->state,
            'phone' => $request->customer_phone ?? '',
            'zip' => $request->zip,
            'type'=>$request->type,
        ];
        //   $query->set($data1, [
        //     'merge' => true
        // ]);       

        //   dd($firebaseOrder);

        $factory = new Factory();

        $firestore = $factory->createFirestore();

        $database = $firestore->database();

        $cart = session('cart');
        
        $userRef =  $database->collection('restaurants')->where("id","=",$cart[0]["vendor"])->limit(1)->documents();
        $kst="";
        $dst="";
        $name = "";
                foreach ($userRef as $item) {
                
                // if(strlen($item) > 300) {            
                    $kst = $item['relay_key'];
                    $name = $item['name'];
                
                    $dst = $item['relay_site'];
                    //  dd($producer);
                // }
                }

        

        if($mode == 'delivery') {
            if($kst != "" && $dst != "" && $kst != null && $dst != null){
                $service = new RelayDelivery();

                
                $location = [
                    "producerLocationKey" => $dst,
                    "address" => [
                    "address1" => $request->address1,
                    "city" => $request->city,
                    "state" => $request->state,
                    "zip" => $request->zip,
                    ]
                ];
                
                
            

                try{
                    if(!$service->canDeliverTo($location, $kst)){
                        session()->flash('message', 'Sorry, '.$name.' cannot deliver to: '.$request->address);
                        return redirect(route('app.checkout.index'));
                    } 
                }catch(Exception $e){
                    session()->flash('message', $e->getMessage());
                    return redirect(route('app.checkout.index'));
                }
            }
        }



       

       


        $restaurantName = null;
        $totalCost = $this->calculateTotalCost($tax_rate, $fee_rate);
        
        $fees = $this->calculateFees($tax_rate, $fee_rate);


        if(($mode == 'delivery') && ($request->rush == 1)) {
            $totalCost =$totalCost+3;
        
            $fees =$fees+3;
            }


        $tx=$fee_rate+$tax_rate;
        // dd($tax_rate,$fee_rate,$fees,$totalCost);
        $firebaseOrder = [];
                
                
                    $selecteddate='';
                    $selectedday='';
                    $selectedtime='';
                    $type='';
                    $data567=[];
                    if($mode == 'reservation') {
                     
                      
                      $selecteddate=session()->get('selecteddate');
                      $selectedday=session()->get('selectedday');
                       $selectedtime=session()->get('selectedtime');
                      $type=session()->get('type');
                      $fulltime=session()->get('fulldate');
                           
      
      
      
      
                       foreach ($cart as $kt => $vale) {
                        
                      
                              $data567=[
                                 'name'=>$request->customer_name ?? '',
                                 'phone'=>$request->customer_phone ?? '',
                                 'reservationDateTime'=>$fulltime,
                                 'reservationDay'=>$selectedday,
                                 'createdAt' => Carbon::now(),
                                 'vendorId'=>$vale['vendor'] ?? '',
                                 
                                 'restaurantName'=>$vale['res_name'] ?? '',
                                 
                                 'type'=>$type ?? '',
                              ];
                              
                              $usersRepository->addReservations($data567);
                              // dd($usersRepository->addReservations($data));
                             
                              
                          }
                          $firebaseOrder = $usersRepository->createReservationOrder($fs_user, $request->all(), $totalCost,$tx,$data567);
                    }
                    else{
                      $firebaseOrder = $usersRepository->createOrder($fs_user, $request->all(), $totalCost, $fees,$tx);
                    }

                    
                $firebaseOrderId = $firebaseOrder->order_id;
                if(($mode == 'delivery') && ($request->rush == 1)) {
                    $fees=3;
                    $usersRepository->rushOrder($firebaseOrderId, $fees);
                }
        // dd($userRef);
        $returnUrl = env('APP_URL') . '/order/callback/' . $firebaseOrderId;
        
        
        if (true) {
            // Todo: Enable delivery
            // Todo: Update the order with the charge id and the status
            
            $cart = session('cart');
        
            //Mail::to('usamtg@hotmail.com')->send(new SendMailable('Dave'));            
        
            
            if($mode != 'delivery'){
                session()->forget('cart');
                return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
            }




        
        // echo $kst;
        // echo $dst;

        // return;
            if($kst != "" && $dst != "" && $kst != null && $dst != null){

                try{
                    if($this->createRelayDelivery($firebaseOrderId, $request->all(),$userRef, $cart, (($cart->subtotal??0) * $tax_rate), true)){
                        // dd($this->createRelayDelivery($firebaseOrderId, $request->all(), $cart, (($cart->subtotal??0) * $tax_rate)));
                        session()->forget('cart');
                        return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
                    }else{
                        session()->flash('message', 'There was a problem creating your delivery. Try again.');
                        return redirect(route('app.checkout.index'));
                    }
                    session()->forget('cart');
                    return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
                }catch(Exception $e){
                    

                    // $to      = 'kosong0926@hotmail.com';
                    $to      = 'david@chekoutteam.com';
                    $subject = 'Relay Dellivery Api Error';

                    $message = '
                        <html>
                        <head>
                        <title>Error Report</title>
                        </head>
                        <body>
                        <h3>Here is Error Details For Relay Delivery Api</h3>
                        <h4>Error</h4>
                        <code>'. $e->getMessage() .'</code>
                        <h4>Relay Token</h4>
                        <code>'. $kst .'</code>
                        <h4>Producer Key</h4>
                        <code>'. $dst .'</code>
                        <h4>Vendor Id</h4>
                        <code>'. $firebaseOrder->vendor .'</code>
                        <h4>Order Id</h4>
                        <code>'. $firebaseOrderId .'</code>
                        </body>
                        </html>
                        ';

                    // $headers = 'From: webmaster@example.com' . "\r\n" .
                    //     'Reply-To: webmaster@example.com' . "\r\n" .
                    //     'X-Mailer: PHP/' . phpversion();
                    $headers[] = 'MIME-Version: 1.0';
                    $headers[] = 'Content-type: text/html; charset=iso-8859-1';


                    mail($to, $subject, $message,implode("\r\n", $headers));


                    session()->flash('message', 'There was a problem creating your delivery.');
                    return redirect(route('app.checkout.index'));
                }

            } else {
                session()->forget('cart');
                return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
            }
        
            

        } else {
        
            session()->forget('cart');
                return view('thankyou')->with('carts',$cart)->with('fees',$fees)->with('totalCost',$totalCost);
        }
    }

    public function callback(Request $request, $provider, $firebaseOrderId, $status = null)
    {
      
        $gateway = Omnipay::create('Stripe\PaymentIntents');
        $gateway->setApiKey(env('STRIPE_SECRET'));
        $completePaymentUrl = env('APP_URL') . '/order/callback/' . $firebaseOrderId;
        $response = $gateway->confirm([
            'paymentIntentReference' => $request->payment_intent,
            'returnUrl' => $completePaymentUrl
        ])->send();
        if ($response->isSuccessful()) {
            $transactionReference = $response->getTransactionReference();
            // Todo: Store this transaction in the firebase order as transactionReference
            // $this->createRelayDelivery();

        } else {
            // Todo: There was an error or they cancelled.
            // Todo: redirect to the order to checkout and tell them that they cancelled.
            session()->flash('message', 'You cancelled the order.');
        }
    }


    private function createRelayDelivery($firebaseOrderId, $dataArray,$userRef, $cart, $tax, $isTemporary)
    {
        
        $externalId = $firebaseOrderId;
        
    //   dd($firebaseOrderId);
        $customerName = $dataArray['customer_name'];
        $customerPhone = $dataArray['customer_phone'];
        $address1 = $dataArray['address1'];
        $city = $dataArray['city'];
        $state = $dataArray['state'];
        $zip = $dataArray['zip'];
        $instructions = $dataArray['delivery_instructions'];
        $tip = 0;
        $producer = '';
        $key = '';
      
   
    //     $snapshot = $document->snapshot();
        
    //     if ($snapshot->exists()) {
    //         $order = $snapshot->data();
    //         try{
    //             $order['created_at'] = $order['createdAt']->get()->getTimestamp();
    //         }catch(Exception $e){
    //             Log::Info("Timestamp for order: " . $id . " does not exist in database");
    //             $order['created_at'] = Carbon::now()->timestamp;
    //         }
    //         $order['order_id'] = $snapshot->id();
    //     }
        
    // dd($userRef);
        foreach ($userRef as $item) {
            
            // if(strlen($item) > 300) {            
                $key = $item['relay_key'];
               
                $producer = $item['relay_site'];
                //  dd($producer);
            // }
        }
       
        //  dd($customerPhone);
        // This code will be removed in live version use FIREBASE relay_key below
        
        // $producer = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyTmFtZSI6Il9hcGlfYWRtaW5fdXNlcl9zdHVmZF9fZTEzNjNiIiwib3JkZXJTb3VyY2VJZCI6IjcwIiwidXNlck5hbWVzIjpbIl9hcGlfYWRtaW5fdXNlcl9zdHVmZF9fZTEzNjNiIl0sInByb2R1Y2VyS2V5Ijoic3R1ZmQiLCJwcm9kdWNlckxvY2F0aW9uS2V5cyI6W10sImlzQWRtaW4iOmZhbHNlLCJpc1Byb2R1Y2VyIjp0cnVlLCJpYXQiOjE2MDc2MTU3MjF9.QTdzrT0Vs1C-oVyJypjmYQKKcebUVICZEGlbpVRoTUw';
        // $key = 'cheesestore';   //relay_site
        // --------------------

        $items = [];
        foreach($cart as $item){
            $options = [];
            if(isset($item['options']) && count($item['options']) > 0){
                foreach($item['options'] as $option){
                    $newOption = [
                        'name' => $option['name'],
                        'quantity' => 1
                    ];
                    array_push($options, $newOption);
                }
            }
            $newItem = [
                'name' => $item['name'],
                'quantity' => 1,
                'price' => $item['item_price'],
                'options' => $options
            ];
            array_push($items, $newItem);
        }
        $data = [
            'order' => [
                'externalId' => $externalId,    // this will be order id
                'producer' => [
                    'producerLocationKey' => $producer  // relay_producer
                ],
                'consumer' => [
                    'name' => $customerName?? '',
                    'phone' => $customerPhone?? '',
                    'location' => [
                        'address1' => $address1,
                        'city' => $city,
                        'state' => $state,
                        'zip' => $zip
                    ]
                ],
                'price' => [
                    'subTotal' => $cart->subtotal ?? 0,
                    'tax' => $tax,
                    'tip' => $tip
                ],
                'specialInstructions' => $instructions,
                'items' => $items
            ]
        ];

        $service = new RelayDelivery();

        $ret = array("success"=> false);

        try{
            $ret =  $service->createOrder($data, $key);
            if($isTemporary)
                $this->saveRelayInfoTrack($firebaseOrderId, json_encode($data), json_encode($ret));

        }catch(Exception $e){
            if($isTemporary)
                $this->saveRelayInfoTrack($firebaseOrderId, json_encode($data), $e->getMessage());
        }
        
        return $ret;
    }

    private function saveRelayInfoTrack($firebaseOrderId, $request, $response){
        $factory = new Factory();
        
        $firestore = $factory->createFirestore();
    
        $database = $firestore->database();

        $data = [
            'order_id'=>$firebaseOrderId,
            'date_time'=>Carbon::now(),
            'request'=>$request,
            'response'=>$response,
        ];

        $collection = $database->collection('relay');
        $doc = $collection->newDocument();
        $doc->set($data);
    }

    public function cancelOrder()
    {
        return null;
    }

    private function calculateFees($taxRate, $feeRate) {
        $cart = session('cart');
        if(empty($cart))
            return 0;

        $total = 0;
        foreach ($cart as $item) {
            if (!empty($item['total_price']) && is_numeric($item['total_price'])) {
                $total += $item['total_price'];
            }
        }
        return round($total * ($taxRate + $feeRate), 2);
    }

    private function calculateTotalCost($taxRate, $feeRate) {
        $cart = session('cart');
        if(empty($cart))
            return 0;

        $total = 0;
        foreach ($cart as $item) {
            if (!empty($item['total_price']) && is_numeric($item['total_price'])) {
                $total += $item['total_price'];
            }
        }
        return round($total * (1 + ($taxRate + $feeRate)), 2);
    }
    
    public function successPayment(){
        return redirect(route('thanks.route'));
    }
}