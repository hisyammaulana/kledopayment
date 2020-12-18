<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payments;
use App\Events\PaymentNotifications;
use Pusher\Pusher;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payments::orderBy('name')->get();
        return view('home', compact('payments'));
    }

    public function create()
    {
        return view('addPayments');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:2'
        ]);

        Payments::create($request->all());

        return back()->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function destroy($id)
    {

        $payments = Payments::findOrFail($id);
        $payments->delete();
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data['message'] = 'Data '. $payments->name .' berhasil terhapus';
        $pusher->trigger('laravel-web-notifications', 'App\\Events\\PaymentNotifications', $data);
    }


}
