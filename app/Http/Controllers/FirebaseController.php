<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Kreait\Firebase;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use Kreait\Firebase\Firestore;
use Google\Cloud\Firestore\FirestoreClient;
class FirebaseController extends Controller

{


	public function index(Request $request){
       
		date_default_timezone_set('America/Los_Angeles');
		$day=strtolower(date ('l'));
		
        $firebase = (new Factory)->withServiceAccount(__DIR__.'/firebase.json');
		$firestore = new FirestoreClient([
			'keyFilePath' => __DIR__.'/firebase.json',
            'projectId' => 'chekout-delivery',
        ]);
        $collectionReference = $firestore->collection('restaurants');
        $restaurants=$collectionReference->where('status','=','1');
    
        $restaurants = $restaurants->documents();

        $data=[];
        foreach ($restaurants as $document) {
        	$distance=$this->haversine($request->latitude,$request->longitude,$document['latitude'],$document['longitude']);
        	echo $distance;
        	if($distance < 3 && $document['operation_info'][$day][0]==true){
        		$data[]=$document->data();
        	}
		  
		}
         return json_encode($data);
	}

	function haversine($lat_from, $lon_from, $lat_to, $lon_to) {
	    $radius = 6371000;
	    $delta_lat = deg2rad($lat_to-$lat_from);
	    $delta_lon = deg2rad($lon_to-$lon_from);

	    $a = sin($delta_lat/2) * sin($delta_lat/2) +
	        cos(deg2rad($lat_from)) * cos(deg2rad($lat_to)) *
	        sin($delta_lon/2) * sin($delta_lon/2);
	    $c = 2*atan2(sqrt($a), sqrt(1-$a));

	    // Convert the distance from meters to miles
	    return ceil(($radius*$c)*0.000621371);
	}



	public function search(Request $request){
       
		// dd($request->all());
        $firebase = (new Factory)->withServiceAccount(__DIR__.'/firebase.json');
		$firestore = new FirestoreClient([
			'keyFilePath' => __DIR__.'/firebase.json',
            'projectId' => 'chekout-delivery',
        ]);
        $collectionReference = $firestore->collectionGroup('menu_item');
        $restaurants = $collectionReference->documents();

        $data=[];
        foreach ($restaurants as $document) {
        	if($document['name']==$request->searchText){
        		$data[]=$document->data();
        	}
        	
         
		}
         return json_encode($data);
	}
	

 }

?>
