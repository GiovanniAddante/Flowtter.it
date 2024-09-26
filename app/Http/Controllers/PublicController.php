<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Category;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function homepage() {
        // $advertisements = Advertisement::take(5)->get()->sortByDesc('created_at');
        // $advertisements = Advertisement::where('is_accepted', true)->take(6)->get()->sortByDesc('created_at');
        $advertisements = Advertisement::where('is_accepted', true)->latest()->take(6)->get();
        return view('welcome',compact('advertisements'));
    }

    public function categoryShow(Category $category) {
        return view('categoryShow', compact('category'));
    }

    public function setLanguage($lang){
        session()->put('locale',$lang);
        return redirect()->back();
        
    }

    public function searchAdvertisements(Request $request){
        $advertisements = Advertisement::search($request->searched)->where('is_accepted', true)->simplePaginate(9);
        $searched=$request->searched;
        return view('advertisement.index', compact('advertisements', 'searched'));
    }
}
