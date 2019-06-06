<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class homeController extends Controller
{
    public function getContries() {

     $api_url = 'https://api.printful.com/countries';
     $api_json = file_get_contents($api_url);
     $api_result = json_decode($api_json , true);
     return $api_result;
    }
}
