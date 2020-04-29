<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Discount;
use App\OrderItem;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $model = Cart::orderBy('id', 'desc')->get();

        $total = Cart::totalPrice();

        return view('cart.cart', [
            'model' => $model,
            'total' => $total
        ]);
    }

    public function add(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'qty' => 'required|numeric|min:1'
        ]);

        $model = Product::find($request->id);

        if (!$model) 
            abort(404, 'Product not found');

        $item = Cart::where('product_id', $request->id)->first();

        if (!empty($item)) {
            $qty = $item->qty + $request->qty;
            $data = [
                'qty' => $qty,
            ];
            if ($item->update($data))
                return redirect()->route('cart')->with('success', 'cart updated');
        } else {
            $data = [
                'product_id' => $request->id,
                'qty' => $request->qty
            ];

            if (Cart::create($data)) 
                return redirect()->route('cart')->with('success', 'Added to cart');
        }
        
        return redirect()->back()->with('error', 'Failed');
    }

    public function update(Request $request)
    {        
        foreach ($request->id as $key => $value) {
            $model = Cart::find($value);
            $model->update([
                'qty' => $request->qty[$key]
            ]);
        }

        return redirect()->back();
    }

    public function remove($id)
    {
        $model = Cart::find($id);

        if (!$model)
            abort('404');

        if ($model->delete()) {
            return redirect()->back()->with('success', 'Deleted');
        } else 
            return redirect()->back()->with('error', 'Error 500');
    }

    public function checkout()
    {
        if ($model = Cart::checkout())
            return redirect()->route('order.detail', $model->id);

        return redirect()->back()->with('error', 'Failed');
    }

}
