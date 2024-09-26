<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Mail\BecomeRevisor;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

class RevisorController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only('index');
    }

    public function index(){
        $advertisement_to_check = Advertisement::where('is_accepted', null)->first();

        return view('revisor.index',compact('advertisement_to_check'));
    }
    
    public function acceptAdevertisement(Advertisement $advertisement){
        $advertisement->setAccepted(true);
        return redirect()->back()->with('message', __('ui.advAccepted'));
    }

    public function rejectAdevertisement(Advertisement $advertisement){
        $advertisement->setAccepted(false);
        return redirect()->back()->with('message', __('ui.advNotAccepted'));
    }

    public function becomeRevisor(){
        return view('revisor.become');
    }

    public function requestRevisor(Request $request){
        try {
            Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user(), $request->description));
        } catch (Exception $th) {
            return redirect()->back()->with('denied', __('ui.revisorBadRequest'));
        }
        return redirect('/')->with('message', __('ui.revisorSendRequest'));
    }

    public function makeRevisor(User $user){
        Artisan::call('presto:makeUserRevisor', ["email" => $user->email]);
        return redirect('/')->with('message', __('ui.revisorBecomeMessage'));
    }
}
