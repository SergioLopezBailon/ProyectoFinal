<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class PagoController extends Controller
{
    public function pago(Request $request, User $user){

        try {
            Stripe::setApiKey(config('services.stripe.secret'));
        $customer = Customer::create(array(
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));
        $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => $request->balance*100,
                'currency' => 'eur'
            ));
            $user->update(['balance'=>$user->balance+$request->balance]);
            $user->save();
            return redirect()->route('profile.edit')->withStatus(__('Pago realizado correctamente.'));
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
