<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Order;
use App\OrderItem;
use App\Rules\CheckVoucher;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list()
    {
        $model = Order::all();
        return view('order.list', compact('model'));    
    }

    public function show($id)
    {
        $model = Order::find($id);
        return view('order.show', [
            'model' => $model
        ]);
    }

    public function redeem(Request $request, $id)
    {
        $order = Order::find($id);
        if ($order->voucher_code == '') {
            $request->validate([
                'code' => ['required','string','min:6', new CheckVoucher()]
            ]);
    
            $voucher = Discount::where('discount_code', $request->code)->first();
            $discount = floor($order->total_price * $voucher->discount_percentage / 100);
            $totalPayment = $order->total_payment - $discount;
    
            $data = [
                'voucher_code' => strtoupper($request->code),
                'discount' => $discount,
                'total_payment' => $totalPayment
            ];

            if ($order->update($data)) {
                return redirect()->back()->with('success', 'Voucher redeemed');
            } else {
                return redirect()->back()->with('error', 'Failed');
            }
        } else {

            $data = [
                'voucher_code' => null,
                'discount' => 0,
                'total_payment' => $order->total_payment + $order->discount
            ];

            if ($order->update($data)) {
                return redirect()->back()->with('success', 'Voucher removed');
            } else {
                return redirect()->back()->with('error', 'Failed');
            }
        }
    }

    public function payment($id)
    {
        $model = Order::find($id);

        if (!$model)
            abort(404);

        if ($model->update(['paid' => 1]))
            return redirect()->route('order')->with('success', 'Payment success');
        else
            return redirect()->route('order')->with('error', 'Payment failed');
    }

}
