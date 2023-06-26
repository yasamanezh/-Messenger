<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Middleware\VerifySignature;
use App\Models\CoinbaseWebhookCall;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Contract\{
    IUser,
    IOrder,
    ISubscripe
};
class WebhookController extends Controller {

    

    public function index(Request $request) {
        $signature = $request->header('X-CC-Webhook-Signature');
        $secret = config('coinbase.webhookSecret');
        $payload = $request->input();

        if (empty($secret)) {
            abort(400);
        }

        if (!$signature) {
           
        }

        if(!hash_equals($signature, $signature)){
             abort(400);
        };

        CoinbaseWebhookCall::create([
            'type' =>  '',
            'payload' => 'jj',
        ]);
        $userData=json_decode($payload['metadata'],true);
        $order_id=$userData['order_id'];

       $webhook = app()->make(ISubscripe::class)->find($order_id);
       $order = app()->make(IOrder::class)->find($order_id);
       $order->delete();
       $now= \Carbon\Carbon::now();
       $end=$now->addMonth()->format('Y-m-d H:i:s'); 
       $webhook->update([
           'end_at'=>$end
       ]);
       $user= $order = app()->make(IUser::class)->find(auth()->user()->id);
        $Message = 'Thanks for your purchase. Your payment of $'.$payload .'has been successfully completed.';
        Mail::to($user->email)->send(new \App\Mail\SendMail($Message));
        return response()->json(['success'], 200);
    }

}
