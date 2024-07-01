<?php

namespace App\Http\Controllers\Dashboard;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Notifications\testNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(){

        $countOfProducts = Product::get()->count();

        return view('Dashboard.home',compact('countOfProducts'));
    }
}
