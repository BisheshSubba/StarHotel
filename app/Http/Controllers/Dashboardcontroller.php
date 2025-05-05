<?php

namespace App\Http\Controllers;

use App\Models\gallery;
use App\Models\main;
use App\Models\room;
use App\Models\booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class Dashboardcontroller extends Controller
{
    
    public function index(){
        $data =main::all();
        return view('home',compact('data'));
    }   
    public function viewgallery(){
        $room=room::all();
        $data=gallery::all();
        return view('gallery',compact('room','data'));
    }
public function userbook($id)
{
    $data = booking::where('name', $id)->with('room')->get();
    $currentDate = Carbon::now()->toDateString(); 
    return view('userbook', compact('data', 'currentDate'));
}

    public function cancelbooking($id){
        $data=booking::find($id);
        $data->delete();
        return redirect()->back();

    }
    public function about(){
        $data =main::all();
        return view('abouts',compact('data'));
    }
}
