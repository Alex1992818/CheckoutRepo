<?php

namespace App\Http\Controllers;

use App\Repositories\Vendors\VendorsRepositoryInterface;
use App\Repositories\Users\UsersRepositoryInterface;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function showCategory($category, VendorsRepositoryInterface $vendorsRepository, UsersRepositoryInterface $usersRepository){
        $categoryName = $category;
        $vendors = $vendorsRepository->getVendorsWithCategory($category);
        $favorites = [];

        $fs_user = null;
        if (session()->has('firestore_user')) {
            $fs_user = session()->get('firestore_user');
        }

        if(!is_null($fs_user)){
            $favorites = $usersRepository->getFavorites($fs_user->user_id, 'restaurant');
        }
        //return $vendors;
        return view('app.categories.show', [
            'categoryName' => $categoryName,
            'nearby' => $vendors,
            'delivery' => 0,
            'favorites' => $favorites,
        ]);
    }

    public function showDeliveryCategory($category, $lat, $lng, VendorsRepositoryInterface $vendorsRepository, UsersRepositoryInterface $usersRepository){
        $categoryName = $category;
        $vendors = $vendorsRepository->getVendorsWithCategory($category);
        $favorites = [];

        $fs_user = null;
        if (session()->has('firestore_user')) {
            $fs_user = session()->get('firestore_user');
        }

        if(!is_null($fs_user)){
            $favorites = $usersRepository->getFavorites($fs_user->user_id, 'restaurant');
        }

        $nearbyRestaurants = [];

        foreach($vendors as $res){
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

        //return $vendors;
        return view('app.categories.show', [
            'categoryName' => $categoryName,
            'nearby' => $nearbyRestaurants,
            'delivery' => 1,
            'favorites' => $favorites,
        ]);
    }
}
