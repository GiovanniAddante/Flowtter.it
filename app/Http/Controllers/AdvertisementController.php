<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('create');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advertisements = Advertisement::where('is_accepted', true)->orderBy('created_at','desc')->simplePaginate(6);

        return view('advertisement.index', compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('advertisement.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Advertisement $advertisement)
    {
        return view('advertisement.show-detail', compact('advertisement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Advertisement $advertisement)
    {
        if (Auth::user()->id == $advertisement->user->id) {
            return view('advertisement.edit', compact('advertisement'));
        }
        return redirect()->back()->with('message', __('ui.cannotModify'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Advertisement $advertisement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advertisement $advertisement)
    {
        $advertisement->delete();
        return redirect(route('home'))->with('message', __('ui.deleteSuccess'));
    }
}
