<?php

namespace App\Http\Controllers;

use App\Repositories\Vendors\VendorsRepositoryInterface;
use App\Repositories\Users\UsersRepositoryInterface;

use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index(VendorsRepositoryInterface $vendorsRepository){
        $restaurants = $vendorsRepository->getVendors();
        return $restaurants;
        return view('app.restaurant.index');
    }

    public function showRestaurant(Request $request, VendorsRepositoryInterface $vendorsRepository, UsersRepositoryInterface $usersRepository, $id){
        // Todo: Frontend needs review dates...
        $firestore = app('firebase.firestore');
        $current = $firestore->database()->collection('restaurants')->document($id);
        // $restaurantData = $vendorsRepository->getVendorById($id);
        $restaurantData = json_decode(json_encode($current->snapshot()->data()));
        // dd($restaurantData);
        // return;
        // Todo: Need to just do a list of products for this menu?

        $favorites = [];
        $isFavorite = false;

        $fs_user = null;
        if (session()->has('firestore_user')) {
            $fs_user = session()->get('firestore_user');
        }

        if(!is_null($fs_user)){
            $favorites = $usersRepository->getFavorites($fs_user->user_id, 'menu');
            $isFavorite = $usersRepository->checkFavorite($fs_user->user_id.$id);
        }
        
        return view('app.restaurant.show', [
            'restaurant' => $restaurantData,
            'current' => $current,
            'favorites' => $favorites,
            'isFavorite' => $isFavorite,
        ]);
    }

    public function selectNew($restaurantId){
        session()->forget('cart');
        return redirect('/restaurant/' . $restaurantId );
    }

    public function goBack($restaurantId){
        return redirect('/restaurant/' . $restaurantId );
    }

    public function showMenuItem(){
        return view('app.restaurant.items.index');
    }
    
    public function showRegister(){
        return view('app.restaurant.register.index');
    }
    
    public function addRestaurant(){
        return view('app.restaurant.register.index');
    }

    public function saveRestaurant(Request $request, VendorsRepositoryInterface $vendorsRepository) {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'restaurant_name' => $request->restaurant_name,
            'comment' => $request->comment
        ];
        
        try {
            $result = $vendorsRepository->registerRestaurant($data);
            $arr = array(
                'success' => true,
                'data' => $result
            );

            return response()->json($arr);
        } catch (Exception $e) {
            $arr = array(
                'success' => false,
                'message' => 'Something went wrong...'
            );

            return response()->json($arr);
        }
    }
}
