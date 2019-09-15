<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\User;
use App\Session;
use App\Presence;

class MainController extends Controller
{

    function startNewSession (Request $request){

        $session = new Session();
        $session->save();
        return response()->json([
            'message' => '#successSeesionTask'
        ], 200);

    }

}
