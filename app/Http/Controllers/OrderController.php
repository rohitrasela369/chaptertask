<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * constructor fuction to load some requirement for controller
     */
    public function __construct(Order $order = null)
    {
        $this->Order = $order;
    }

    /**
     * function to check the user role and redirect
     */
    public function checkRoleAndRedirect()
    {
        $roles = Auth::user()->getRoles();
        if ( in_array('admin', $roles->toArray()) || in_array('shop-manager', $roles->toArray())) {
            return true;
        }
        return false;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->checkRoleAndRedirect()) {
            return redirect('/home');
        }
        return view('order.index');
    }

    /**
     * Fetch all the order for listing.
     *
     */
    public function getAll()
    {
        if (!$this->checkRoleAndRedirect()) {
            return redirect('/home');
        }

        $orders = Order::with(['customer' => function ($query) {
                $query->select('id', 'name');
            }])
            ->select('invoice_number', 'total_amount', 'status', 'customer_id', 'id')
            ->get();
        return datatables($orders)
            ->make(true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$this->checkRoleAndRedirect()) {
            return redirect('/home');
        }

        // Log Activity
        // activity()->log(Auth::user()->name . ' processed the order: '. $id);

        $order = Order::with(['customer', 'order_items', 'order_items.product'])->where(['id' => $id])->first();
        return view('order.show', ['order' => $order]);
    }
}
