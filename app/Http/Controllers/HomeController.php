<?php

namespace App\Http\Controllers;

use App\Repositories\Vendors\VendorsRepositoryInterface;
use App\Repositories\Users\UsersRepositoryInterface;

use Illuminate\Http\Request;
use App\Services\ExternalApis\RelayDelivery;
use Exception;
use date;

class HomeController extends Controller
{
    public function index_landing(){
        return view('layouts.landing');
    }
    
    public function index(VendorsRepositoryInterface $vendorsRepository, UsersRepositoryInterface $usersRepository)
    {
        $nearbyRestaurants = $vendorsRepository->getVendors();
        $favorites = [];

        $fs_user = null;
        if (session()->has('firestore_user')) {
            $fs_user = session()->get('firestore_user');
        }

        if(!is_null($fs_user)){
            $favorites = $usersRepository->getFavorites($fs_user->user_id, 'restaurant');
        }

        $prevOrders = null;
        session()->put('mode','takeout');
    
        return view('app.home', [
            'nearby' => $nearbyRestaurants,
            'prevOrders' => $prevOrders,
            'delivery' => 0,
            'favorites' => $favorites,
        ]);
    }
    
    public function showSearch(VendorsRepositoryInterface $vendorsRepository, UsersRepositoryInterface $usersRepository ,Request $request){
        
        $firestore = app('firebase.firestore');
        $restaurants = $vendorsRepository->getVendors();
        $result = array();
        $count = 0;
        for($i = 0; $i < count($restaurants); $i ++){
            // $item = json_decode(json_encode($firestore->database()->collection('restaurants')->document($restaurants[$i]['id'])->snapshot()->data()));
            $current = $firestore->database()->collection('restaurants')->document($restaurants[$i]['id']);
            foreach($current->collection('restaurant_menu')->documents() as $menu)
            {
                foreach($current->collection('restaurant_menu')->document($menu->data()['id'])->collection('menu_section')->orderBy('orderNumber')->documents() as $section){
                    if($current->collection('restaurant_menu')->document($menu->data()['id'])->collection('menu_section')->document($section->data()['id'])->collection('menu_item')->documents()){
                        foreach($current->collection('restaurant_menu')->document($menu->data()['id'])->collection('menu_section')->document($section->data()['id'])->collection('menu_item')->documents() as $product){
                            if($product->data()['name'] == $request->search_str){
                                array_push($result, $product);
                            }
                        }
                    }
                }
            }
            
        }
        dd($result);
    }
    


    public function reservationCheck(Request $request,VendorsRepositoryInterface $vendorsRepository){
        
        
        $today=strtolower(date('l',strtotime($request->date)));
        $resId=$request->resId;

       $rest= $vendorsRepository->getVendorById($request->resId);
       
       $start_time=date("g:i a", strtotime($rest->operation_info->$today[1]));
       $end_time=date("g:i a", strtotime($rest->operation_info->$today[2]));
      
       $data =$this->SplitTime($start_time, $end_time, "30");
      
$output='';
foreach($data as $row)
{

$output .= '<option value="'.$row.'">'.$row.'</option>';
}
echo $output;
    }
    

    public function SplitTime($StartTime, $EndTime, $Duration="30")
    {
    $ReturnArray = array ();// Defined the output
    $StartTime = strtotime ($StartTime)+(30*60); //Get Timestamp
    $EndTime = strtotime ($EndTime); //Get Timestamp
    
    $AddMins = $Duration * 60;
    
    while ($StartTime <= $EndTime) //Run loop
    {
    // dd($StartTime);
    $ReturnArray[] = date ("g:i a", $StartTime);
    $StartTime += $AddMins; //Endtime check
    }
    return $ReturnArray;
    }


    public function delivery($lat, $lng, VendorsRepositoryInterface $vendorsRepository, UsersRepositoryInterface $usersRepository)
    {  
        $favorites = [];

        $fs_user = null;
        if (session()->has('firestore_user')) {
            $fs_user = session()->get('firestore_user');
        }

        if(!is_null($fs_user)){
            $favorites = $usersRepository->getFavorites($fs_user->user_id, 'restaurant');
        }
        session()->put('mode','delivery');
        $nearbyRestaurants = [];
        $restaurants = $vendorsRepository->getVendors();
        $relay = new RelayDelivery();
        foreach($restaurants as $res){
            if($res['relay_key'] !=null){
                
              
                if($res['deliveryRadius'] != ""){
                    $R = 3958.8; // Radius of the Earth in miles
                    $rlat1 = floatval($lat) * (pi()/180); // Convert degrees to radians
                    $rlat2 = floatval($res['latitude']) * (pi()/180);
                    $difflat = $rlat2-$rlat1; // Radian difference (latitudes)
                    $difflon = (floatval($res['longitude'])-floatval($lng)) * (pi()/180); // Radian difference (longitudes)
                    
                    $d = 2 * $R * asin(sqrt(sin($difflat/2)*sin($difflat/2)+cos($rlat1)*cos($rlat2)*sin($difflon/2)*sin($difflon/2)));
                    if(floatval($res['deliveryRadius']) >= $d){ 
                        array_push($nearbyRestaurants, $res);
                    }
                }
            }
            else if($res['deliveryRadius'] != ""){
                $R = 3958.8; // Radius of the Earth in miles
                // if($res['name'] == "Andy's Sandy")
                //     dd(floatval($lat),floatval($lng));
                $rlat1 = floatval($lat) * (pi()/180); // Convert degrees to radians
                $rlat2 = floatval($res['latitude']) * (pi()/180);
                $difflat = $rlat2-$rlat1; // Radian difference (latitudes)
                $difflon = (floatval($res['longitude'])-floatval($lng)) * (pi()/180); // Radian difference (longitudes)
                
                $d = 2 * $R * asin(sqrt(sin($difflat/2)*sin($difflat/2)+cos($rlat1)*cos($rlat2)*sin($difflon/2)*sin($difflon/2)));
                if(floatval($res['deliveryRadius']) >= $d){
                    array_push($nearbyRestaurants, $res);
                }
                // if($res['name'] == "Andy's Sandy")
                //     dd($d);
            }
        }
        
        $prevOrders = null;

        return view('app.home', [
            'nearby' => $nearbyRestaurants,
            'prevOrders' => $prevOrders,
            'delivery' => 1,
            'favorites' => $favorites,
        ]);
    }
    
    public function showAbout() {
        return view('app.about_us');
    }

    public function showBlog() {
        return view('app.blog');
    }

    public function showCovid19() {
        return view('app.covid_19');
    }

    public function showMembership() {
        return view('app.membership');
    }

    public function showOurTeam() {
        return view('app.our_team');
    }

    public function showWhyChooseUs() {
        return view('app.why_choose_us');
    }

    public function firebasework(UsersRepositoryInterface $usersRepository){

        /* update catetories for restaurants ------------- start ------------ */

        // $category_collection = $usersRepository->firestore->collection('vendor_categories');
        // $categories = [];

        // foreach($category_collection->documents() as $doc){
        //     $title = $doc->data()['title'];
        //     $categories[$title] = false;
        // }


        
        // $collection = $usersRepository->firestore->collection('restaurants');
        // $query = $collection->orderBy('name');
        // foreach( $query->documents() as $doc ){
        //     echo $doc->data()['id']."<br>";
        //     $id = $doc->data()['id'];
        //     $doc = $collection->document($id);
        //     $doc->set([
        //         'cuisine_type' => $categories,
        //     ], [
        //         'merge' => true
        //     ]);
        // }

        /* update catetories for restaurants ------------- end ------------ */

        // set_time_limit(50000);

        // $collection = $usersRepository->firestore->collection('restaurants');

        // $restaurant_menus = $collection->document("1a8321b745984b5b8d2b")->collection('restaurant_menu');
        // foreach( $restaurant_menus->documents() as $doc ){
        //     $id = $doc->data()['id'];
        //     $menu_sections = $restaurant_menus->document($id)->collection('menu_section');
        //     foreach( $menu_sections->documents() as $doc ){
        //         $id = $doc->data()['id'];
        //         $order_number = $doc->data()['orderNumber'];
        //         $order_number_i = intval($order_number);
        //         $doc = $menu_sections->document($id);
        //         $doc->set([
        //             'orderNumber' => $order_number_i,
        //         ], [
        //                 'merge' => true
        //         ]);
        //     }
        // }



        // $query = $collection->orderBy('name');
        // foreach( $query->documents() as $doc ){
        //     echo $doc->data()['id']."<br>";
        //     $id = $doc->data()['id'];
        //     $restaurant_menus = $collection->document($id)->collection('restaurant_menu');
        //     foreach( $restaurant_menus->documents() as $doc ){
        //         $id = $doc->data()['id'];
        //         $menu_sections = $restaurant_menus->document($id)->collection('menu_section');
        //         foreach( $menu_sections->documents() as $doc ){
        //             $id = $doc->data()['id'];
        //             $order_number = $doc->data()['orderNumber'];
        //             $order_number_i = intval($order_number);
        //             $doc = $menu_sections->document($id);
        //             $doc->set([
        //                 'orderNumber' => $order_number_i,
        //             ], [
        //                     'merge' => true
        //             ]);
        //         }
        //     }
        // }

    }
    
    public function mobileApp() {
        return view('app.mobile');
    }


   public function checkRestaurent(VendorsRepositoryInterface $vendorsRepository,Request $request){	
    $isOpenedRes = false;	
    $message='';	
    $res=[];	

    $today=strtolower(date('l',strtotime($request->dt)));	
//  dd($today);	
    $selectedtime=strtolower(date("H:i:s",strtotime($request->dt)));	

       $restaurent=$vendorsRepository->getVendorById($request->resId);	
    //    dd($restaurent->operation_info->$today['0']);	
    $avail_time=$restaurent->operation_info->$today['0'];	
    // dd($avail_time);	
       $st_time=strtotime($restaurent->operation_info->$today['1']);	
       $end_time=strtotime($restaurent->operation_info->$today['2']);	
       $cur_time=strtotime($selectedtime);	
    //   dd($st_time,$end_time,$cur_time);	
    if ($avail_time == true) {	
        if($st_time < $cur_time && $end_time > $cur_time)	
            {	
                $isOpenedRes = true;	
            }	
            else {	
                $isOpenedRes = false;	
            }	
    }	
    else{	
        $isOpenedRes = false;	

    }	


    // $isOpenedRes = true;	
    if($st_time > $cur_time){	
        $message = 'Open at '.date('g:i A', strtotime($restaurent->operation_info->$today['1']));	
    }	
    if($st_time < $cur_time){	
        $message = 'Closes at '.date('g:i A', strtotime($restaurent->operation_info->$today['2']));	
    }	
    if ($avail_time == false) {	
        $message = 'Today restaurent is closed';	
    }	
    $res['status']=$isOpenedRes;	
    $res['message']=$message;	

    // dd($res);	
    echo json_encode($res);	
   }
   
    public function reservation(VendorsRepositoryInterface $vendorsRepository, UsersRepositoryInterface $usersRepository,Request $request){

 if ($request->date) {
    
    $today=strtolower(date('l',strtotime($request->date)));
    $dit=strtolower(date('Y-m-d',strtotime($request->date)));
    $selectedtime=strtolower(date("g:i a",strtotime($request->book_time)));
 
     $full=$dit.'  '.$selectedtime;
      
    // dd($full);
    // dd($selectedtime);
    $datetime=strtotime($request->date);
    // dd($datetime);
    $nearbyRestaurants = $vendorsRepository->getVendors();
    $favorites = [];

    $fs_user = null;
    if (session()->has('firestore_user')) {
        $fs_user = session()->get('firestore_user');
    }

    if(!is_null($fs_user)){
        $favorites = $usersRepository->getFavorites($fs_user->user_id, 'restaurant');
    }
    if ($request->progress == 0) {
        session()->put('type','takeout');
    }
else {
    session()->put('type','delivery');
}
    $prevOrders = null;

    
    session()->put('mode','reservation');
    session()->put('selectedtime',$selectedtime);
    session()->put('selecteddate',$datetime);
    session()->put('selectedday',$today);
    session()->put('fulldate',$full);
    return redirect(route('app.restaurant.show', ['id' => $request->resId ?? '']));
 }
 else{
    $nearbyRestaurants = $vendorsRepository->getVendors();
    $favorites = [];

    $fs_user = null;
    if (session()->has('firestore_user')) {
        $fs_user = session()->get('firestore_user');
    }

    if(!is_null($fs_user)){
        $favorites = $usersRepository->getFavorites($fs_user->user_id, 'restaurant');
    }

    $prevOrders = null;
    session()->put('mode','reservation');
    session()->put('selectedday',null);
    return view('app.home', [
        'nearby' => $nearbyRestaurants,
        'prevOrders' => $prevOrders,
      
        'reservation'=>1,
        'favorites' => $favorites,
    ]);
 }
      
    }

   
}