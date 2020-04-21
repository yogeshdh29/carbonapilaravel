<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activitie;
use App\Country;
use App\Fuel;
use App\Mode;
use \GuzzleHttp\Client;
use Carbon\Carbon;
use App\Carbonfootprint;
use DB;
class CarbonsController extends Controller
{
    //

    public function index() {
    	$activitie = Activitie::pluck('type','id')->all();
    	$country = Country::pluck('country','id')->all();
    	$fuel = Fuel::pluck('type','id')->all();
    	$mode = Mode::pluck('mode','id')->all();
    	return view('carbon.index', compact('activitie','country','fuel','mode'));
    }

    public function store(Request $request) {

    	$activitie = $request->activity;
    	$activities = $request->activities;
    	$fuels = $request->fuels;
    	$modes = $request->modes;
    	$countries = $request->countries;
    	if($activities == 'fuel')
    	{	
    		$request->validate([
    			'fuels' => 'required'
    		]);
    	}
    	else if($activities == 'miles')
    	{
    		$request->validate([
    			'modes' => 'required'
    		]);
    	}	

    	$client = new client();
    	$response = $client->request('GET','https://api.triptocarbon.xyz/v1/footprint', [
    		'query' => ['activity' => $activitie, 
    					'activityType' => $activities, 
    					'country' => $countries,
    					'mode' => $modes,
    					'fuelType' => $fuels
    					],
    	]);

    	$key = "Carbon footprint";
    	$value = $response->getBody();
    	\Cache::put($key, $value, now()->addMinutes(1440));
    	$value = json_decode($value, true);
    	$data = DB::insert("insert into carbonfootprints (footprint) values (?)", [$value['carbonFootprint']]);
    	print_r($value['carbonFootprint']);
    	dd("Inserted");
    }
}
