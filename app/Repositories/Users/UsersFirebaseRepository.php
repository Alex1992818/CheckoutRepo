<?php


namespace App\Repositories\Users;


use App\Models\Firebase\Cart;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Omnipay\Omnipay;

class UsersFirebaseRepository implements UsersRepositoryInterface
{
    // Todo: Maybe add the auth and firestore connections?
    public $auth;

    public $firestore;

    public function __construct()
    {
        $this->auth = app('firebase.auth');
        $firestoreConnection = app('firebase.firestore');
        $this->firestore = $firestoreConnection->database();
    }

    public function getAuthUsers()
    {
        $userList = [];
        $users = $this->auth->listUsers(1000, 1000);
        foreach ($users as $user) {
            array_push($userList, $user);
        }

        return collect($userList);
    }

    public function getAuthUserById($id)
    {
        // TODO: Implement getAuthUserById() method.
    }

    public function createAuthUser($data)
    {
    //    dd($this->auth->createUser($data));
        return $this->auth->createUser($data);
    }

    public function deleteAuthUserById($id)
    {
        // TODO: Implement deleteAuthUserById() method.
    }

    public function getFirestoreUserByEmail($email)
    {
        $users = [];
        $collection = $this->firestore->collection('users');
        $query = $collection->where('email', '=', $email)->limit(1);
        foreach ($query->documents() as $document) {
            $item = $document->data();
            $item['user_id'] = $document->id();
            array_push($users, $item);
        }
        if (isset($users[0])) {
            return json_decode(json_encode($users[0]), FALSE);
        } else {
            return null;
        }
    }

    public function getFirestoreUserByAuthId($authid)
    {
        $users = [];
        $collection = $this->firestore->collection('users');
        $query = $collection->where('authId', '=', $authid)->limit(1);
        foreach ($query->documents() as $document) {
            $item = $document->data();
            $item['user_id'] = $document->id();
            array_push($users, $item);
        }
        if (isset($users[0])) {
            return json_decode(json_encode($users[0]), FALSE);
        } else {
            return null;
        }
    }
    public function getPaymentMethodByOwnerId($ownerId){
        $user = [];
        $collection = $this->firestore->collection('payment_methods');
        $query = $collection->where('ownerId', '=', $ownerId)->limit(1);
        foreach ($query->documents() as $document) {
            $item = $document->data();
            $item['card_id'] = $document->id();
            array_push($user, $item);
        }
        if (isset($user[0])) {
            return json_decode(json_encode($user[0]), FALSE);
        } else {
            return null;
        }
    }

    public function getAllPaymentMethodsByOwnerId($ownerId){
        $user = [];
        $users = session()->get('firestore_user');
        $collection = $this->firestore->collection('users')->document($users->user_id)->collection('cards');
        foreach ($collection->documents() as $document) {
            $item = $document->data();
            $item['card_id'] = $document->id();
            array_push($user, $item);
        }
        return collect($user);
    }

    public function createNewPaymentMethod($fullStripeToken){
        $method = null;
        $user = session()->get('firestore_user');
        $collection = $this->firestore->collection('users')->document($user->user_id)->collection('cards');
        $doc = $collection->document($fullStripeToken->card->id);
        $fullStripeToken->card->cardId = $fullStripeToken->card->id;
        $fullStripeToken->title = $fullStripeToken->card->title ?? "New";
        $data = [
            'card' => (array) $fullStripeToken->card,
            'ownerId' => $user->user_id
        ];
        $doc->set($data);
        $snapshot = $doc->snapshot();
        if ($snapshot->exists()) {
            $method = $snapshot->data();
        }
        return json_decode(json_encode($method), FALSE);
    }

    public function deletePaymentMethod($id)
    {
        $user = session()->get('firestore_user');
        $gateway = Omnipay::create('Stripe');
        $gateway->setApiKey(env('STRIPE_SECRET'));
        $cardResponse = $gateway->deleteCard([
            'cardReference' => $id,
            'customerReference' => $user->stripeCustomerID,
        ])->send();

        if($cardResponse->isSuccessful()){
            $collection = $this->firestore->collection('users')->document($user->user_id)->collection('cards');
            $doc = $collection->document($id);
            $doc->delete();
        }else{
            throw new Exception("Invalid Request");
        }
    }

    public function deleteAddress($id)
    {
        $user = session()->get('firestore_user');
        $collection = $this->firestore->collection('users')->document($user->user_id)->collection('address');
        $doc = $collection->document($id);
        $doc->delete();
    }

    public function getFirestoreUsers()
    {
        // TODO: Implement getFirestoreUsers() method.
    }

    public function getFirestoreUserById($id)
    {
        // TODO: Implement getFirestoreUserById() method.
    }

    public function createFirestoreUser($authUser, $email)
    {
       
        // dd($authUser);

        $authId=$authUser['localId'];
        if (isset($authUser['firstName']) || isset($authUser['lastName']) ) {
            $fname=$authUser['firstName'];
            $lname=$authUser['lastName'] ?? '';
      

        }

        else {
           
                $selected = explode('/', $authUser['profilePicture']);
                // dd($selected);
                $dob= $selected[5];
                $address = $selected[1];
                
                $apartmentno=$selected[2];
                $phone=$selected[3];
            
            $fname=$authUser['displayName'];
            $lname=$selected[4];
            
        }
      
        $vendor = null;
        if ($email != null) {
            # code...
       
        $gateway = Omnipay::create('Stripe');
        $gateway->setApiKey(env('STRIPE_SECRET'));
        $response = $gateway->createCustomer([
            'description' => 'Chekout User',
            'email' => $email
        ])->send();
        if ($response->isSuccessful()) {
            $data = [
                'email' => $email,
                'authId' => $authId,
                 'firstName'=>$fname,
                 'lastName'=>$lname,
                 'dob'=>$dob ?? '',
                 'address'=>$address ?? '',
                 'apartmentno'=>$apartmentno ?? '',
                 'phone'=>$phone ?? '',
                'stripeCustomerID' => $response->getCustomerReference()
            ];
        } else {
            $data = [
                'firstName'=>$fname,
                'lastName'=>$lname,
                     'email' => $email,
                     'authId' => $authId
            ];
             }
             }
          else{
                $data = [
             
             'authId' => $authId
         ];
}
        $collection = $this->firestore->collection('users');
        $document = $collection->newDocument();
        $document->set($data);
        $snapshot = $document->snapshot();
        if ($snapshot->exists()) {
            $vendor = $snapshot->data();
            $vendor['user_id'] = $snapshot->id();
        }
        return json_decode(json_encode($vendor), FALSE);
    }

    public function updateFirestoreUser($id, $data){
        $vendor = [];
        $collection = $this->firestore->collection('users');
        $document = $collection->document($id);
        
        $document->set($data, [
            'merge' => true
        ]);
        $snapshot = $document->snapshot();
        if ($snapshot->exists()) {
            $vendor = $snapshot->data();
            $vendor['user_id'] = $snapshot->id();
            // dd($vendor);
        }
        return json_decode(json_encode($vendor), FALSE);
    }

    public function deleteFirestoreUserById($id)
    {
        // TODO: Implement deleteirestoreUserById() method.
    }

    public function getStripeCustomerByUserId($id){

    }



    public function createReservationOrder($userObj, $dataArray, $fees,$tx,$reservation){
       
        $order = null;
        $items = '';
        // Todo: chargeID gets set on the update
        $cart = session('cart');
        $products = [];
        $data = [];
        $resname = '';
        $resphone = '';
        $resaddr = '';
        $pre='';
        $dat='';
        if(!empty($cart)){
            foreach($cart as $item){
                $product = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'price' => $item['item_price'],
                    'quantity' => $item['quantity'],
                    'message' => $item['message'],
                    'vendor' => $item['vendor'],
                 
                ];
                $resname = $item['res_name'];
                $resphone = $item['res_phone'];
                $resaddr = $item['res_addr'];
                $product['options'] = $item['options'];
                $pre = $item['pref_contact_info'];
               
                $dat=$item['pref_contact_methods'];
             
                array_push($products, $product);
            }
        }

//        {{ isset($taxRate) && is_numeric($taxRate) && is_numeric($feeRate) && is_numeric($cart->subtotal) ?  number_format($cart->subtotal * ($taxRate + $feeRate) , 2) : 0}}
        $user = (array) $userObj;
        $user['firstName'] = $dataArray['customer_name'];
        $user['phone'] = $dataArray['customer_phone'];
        $mode = session('mode');
        $address = [];
        if($mode == 'delivery'){
            $address = [
                'city' => $dataArray['city'],
                'state' => $dataArray['state'],
                'line1' => $dataArray['address1'],
                'line2' => $dataArray['address2'],
                'postalCode' => $dataArray['zip']
            ];
        }

         $reservationdata=[
            'name'=>$reservation['name'] ?? '',
            'phone'=>$reservation['phone'] ?? '',
            'reservationDateTime'=>$reservation['reservationDateTime'] ?? '',
            'reservationDay'=>$reservation['reservationDay'] ?? '',
            
            'vendorId'=>$reservation['vendorId'] ?? '',
            
            'restaurantName'=>$reservation['restaurantName'] ?? '',
            'createdAt' => Carbon::now(),
            'type'=>$reservation['type'] ?? '',
         ];

        $data = [
            'authorID' => $userObj->user_id,
            'payment_type'=>$dataArray['paymenttypes'] ?? '',
            'delivery_fee'=>'',
            'subtotal' => round(($fees-$tx ?? 0), 2),
            'taxes_and_fees' =>round($tx, 2) ?? 0,
            'total'=> round($fees),
            'author' => $user,
            'createdAt' => Carbon::now(),
            'vendorID' => '',
            'vendor' => $resname,
            'vendor_phone' => $resphone,
            'vendor_address' => $resaddr,
            'isDelivery' => $mode=="delivery"?true:false,
            'status' => 'Order Placed',
            'instructions' => $dataArray['delivery_instructions'],
            'pref_contact_info'=>$pre,
            'pref_contact_methods'=>$dat,
            'reservation'=>$reservationdata,
            'reservationType'=>$reservation['type'] ?? '',
            'address' => $address,
            'products' => $products,
            'tip' => $dataArray['tip']??0,
        ];
        // dd($data);
        $collection = $this->firestore->collection('restaurant_orders');
        $doc = $collection->newDocument();
        $doc->set($data);
        $snapshot = $doc->snapshot();
        if ($snapshot->exists()) {
            $method = $snapshot->data();
            $method['order_id'] = $snapshot->id();
        }
        // dd(json_decode(json_encode($method), FALSE));
        return json_decode(json_encode($method), FALSE);
    }

    public function createOrder($userObj, $dataArray, $fees,$tx){
        // dd($dataArray);
        $order = null;
        $items = '';
        // Todo: chargeID gets set on the update
        $cart = session('cart');
        $products = [];
        $data = [];
        $resname = '';
        $resphone = '';
        $resaddr = '';
        $pre='';
        $dat='';
        if(!empty($cart)){
            foreach($cart as $item){
                $product = [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'price' => $item['item_price'],
                    'quantity' => $item['quantity'],
                    'message' => $item['message'],
                    'vendor' => $item['vendor'],
                 
                ];
                $resname = $item['res_name'];
                $resphone = $item['res_phone'];
                $resaddr = $item['res_addr'];
                $product['options'] = $item['options'];
                $pre = $item['pref_contact_info'];
               
                $dat=$item['pref_contact_methods'];
             
                array_push($products, $product);
            }
        }

//        {{ isset($taxRate) && is_numeric($taxRate) && is_numeric($feeRate) && is_numeric($cart->subtotal) ?  number_format($cart->subtotal * ($taxRate + $feeRate) , 2) : 0}}
        $user = (array) $userObj;
        $user['firstName'] = $dataArray['customer_name'];
        $user['phone'] = $dataArray['customer_phone'];
        $mode = session('mode');
        $address = [];
        // if($mode == 'delivery'){
            $address = [
                'city' => $dataArray['city'] ?? '',
                'state' => $dataArray['state'] ?? '',
                'line1' => $dataArray['address1'] ?? '',
                'line2' => $dataArray['address2'] ?? '',
                'postalCode' => $dataArray['zip'] ?? ''
            ];
        // }

        $data = [
            'authorID' => $userObj->user_id,
            'payment_type'=>$dataArray['paymenttypes'] ?? '',
            'delivery_fee'=>'',
            'subtotal' => round(($fees-$tx ?? 0), 2),
            'taxes_and_fees' => round(($tx ?? 0), 2),
            'total'=>round($fees),
            'author' => $user,
            'createdAt' => Carbon::now(),
            'vendorID' => '',
            'vendor' => $resname,
            'vendor_phone' => $resphone,
            'vendor_address' => $resaddr,
            'isDelivery' => $mode=="delivery"?true:false,
            'status' => 'Order Placed',
            'instructions' => $dataArray['delivery_instructions'],
            'pref_contact_info'=>$pre,
            'pref_contact_methods'=>$dat,
            'address' => $address,
            'products' => $products,
            'tip' => $dataArray['tip']??0,
        ];
        // dd($data);
        $collection = $this->firestore->collection('restaurant_orders');
        $doc = $collection->newDocument();
        $doc->set($data);
        $snapshot = $doc->snapshot();
        if ($snapshot->exists()) {
            $method = $snapshot->data();
            $method['order_id'] = $snapshot->id();
        }
        return json_decode(json_encode($method), FALSE);
    }

    public function getOrderById($id){
        $order = null;
        $collection = $this->firestore->collection('restaurant_orders');
        $document = $collection->document($id);
        $snapshot = $document->snapshot();
        
        if ($snapshot->exists()) {
            $order = $snapshot->data();
            try{
                $order['created_at'] = $order['createdAt']->get()->getTimestamp();
            }catch(Exception $e){
                Log::Info("Timestamp for order: " . $id . " does not exist in database");
                $order['created_at'] = Carbon::now()->timestamp;
            }
            $order['order_id'] = $snapshot->id();
        }

       
        return json_decode(json_encode($order), FALSE);
    }

    public function getOrdersByUserId($id){
        $products = [];
        $collection = $this->firestore->collection('restaurant_orders');
        $query = $collection->where('author.user_id', '=', $id);
        foreach ($query->documents() as $document) {
            $doc = $document->data();
            $doc['order_id'] = $document->id();
            array_push($products, $doc);
        }

        return collect($products);
    }

    public function updateOrder($orderRecord, $chargeId, $status){
        $collection = $this->firestore->collection('restaurant_orders');
        $doc = $collection->document($orderRecord);
        $doc->set([
            'chargeID' => $chargeId,
            'status' => 'Order Paid'
        ], [
            'merge' => true
        ]);
    }

    public function reservationOrder($orderRecord, $data){
        $collection = $this->firestore->collection('restaurant_orders');
        $doc = $collection->document($orderRecord);
        $doc->set([
            'reservation' => $data,
            'reservationType'=>$data["type"]
           
        ], [
            'merge' => true
        ]);
    }

    public function rushOrder($orderRecord, $fees){
        $collection = $this->firestore->collection('restaurant_orders');
        $doc = $collection->document($orderRecord);
        $doc->set([
            'rush_fees' => $fees,
            
           
        ], [
            'merge' => true
        ]);
    }

    public function getUserAddresses($id){
        $address = [];
        $collection = $this->firestore->collection('users');
        $document = $collection->document($id);
        $addresses = $document->collection('address');
        foreach($addresses->documents() as $document){
            $data = $document->data();
            $data['address_id'] = $document->id();
            array_push($address, $data);
        }
        return collect($address);
    }

    public function addUserDetail($user, $data){
        $details = [];
        $collection = $this->firestore->collection('users')->document($user->user_id)->collection('details');
        $document = $collection->newDocument();
        $document->set($data);
        $snapshot = $document->snapshot();
        if ($snapshot->exists()) {
            $address = $snapshot->data();
        }
        return json_encode($details, false);
    }
    public function addUserAddress($user, $data){
        $address = [];
        $collection = $this->firestore->collection('users')->document($user->user_id)->collection('address');
        $document = $collection->newDocument();
        $document->set($data);
        $snapshot = $document->snapshot();
        if ($snapshot->exists()) {
            $address = $snapshot->data();
        }
        return json_encode($address, false);
    }

    public function addReservations($data){
        // //   dd($request->all());
        // $collection = $this->firestore->collection('special_offer_emails');
        // $query = $collection->where('email', '=', $request->email)->limit(1);
    
        // if($query->documents()->size() == 0){
        //   $data=[
        //     'email'=>$request->email
        //   ];
          $collection = $this->firestore->collection('reservations');
          $document = $collection->newDocument();
          $document->set($data);
       
          return 1;
        
        }

    public function addFavorite($id, $user_id, $type, $data) {
        $collection = $this->firestore->collection('favorites');
        $doc = $collection->document($id);
        $doc->set([
            'id' => $id,
            'user_id' => $user_id,
            'type' => $type,
            'data' => $data
        ]);
        return 1;
    }

    public function removeFavorite($id) {
        $collection = $this->firestore->collection('favorites');
        $doc = $collection->document($id);
        $doc->delete();
        return 1;
    }

    public function getFavorites($user_id, $type) {
        $favorites = [];
        $collection = $this->firestore->collection('favorites');
        $query = $collection->where('user_id', '=', $user_id);
        if($type != 'all')
            $query = $query->where('type', '=', $type);



        foreach ($query->documents() as $document) {
            $doc = $document->data();
            $doc['data'] = json_decode($doc['data']);
            array_push($favorites, $doc);
        }

        return collect($favorites);
    }

    public function checkFavorite($id) {
        $collection = $this->firestore->collection('favorites');
        $doc = $collection->document($id);
        if($doc->snapshot()->exists()) {
            return true;
        } else {
            return false;
        }
    }
}