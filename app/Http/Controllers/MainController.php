<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\User;
use App\Session;
use App\Presence;

class MainController extends Controller
{

    function createNewSession (Request $request){
        $session = new Session();
        $session->name = $request->name;
        $session->save();
        return response()->json([
            'session' => $session,
            'message' => "successSession"
        ], 200);
    }

    function changeTheQR (Request $request){

        $id = $request->sessionId;
        $session = Session::where('id', '=', $id)->first();
        $qr =  $id."session".rand(0,9).rand(0,9) . rand(0,9);
        $session->qr = $qr;
        $session->save();
        $QrCode = QrCode::size(500)->generate($qr);


        return response()->json([
            'session' => $session,
            'QRCodePNG' => $QrCode,
            'message' => "successQR"
        ], 200);

    }

    function validatePresence (Request $request){

        $id = $request->sessionId;
        $qr = $request->qr;
        $session = Session::where('id', '=', $id)->first();
        $qrOrg = $session->qr;

        if($qrOrg == $qr) {
            // $userId = $request->user()->id;
            // $presence = new Presence();
            // $presence->session_id = $id;
            // $presence->user_id = $userId;
            // $presence->save();
            return response()->json([
                // 'presence' => $presence,
                'message' => "successPresence",
                'request' => $request
            ], 200);
        }
        else {
            return response()->json([
                'message' => "errorPresence"
            ], 400);
        }
    }

}
