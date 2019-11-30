<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * constructor fuction to load some requirement for controller
     */
    public function __construct(Customer $customer = null)
    {
        $this->Customer = $customer;
    }

    /**
     * function to check the user role and redirect
     */
    public function checkRoleAndRedirect()
    {
        $roles = Auth::user()->getRoles();
        if (in_array('admin', $roles->toArray()) || in_array('user-manager', $roles->toArray())) {
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

        if (!$this->checkRoleAndRedirect()) {
            return redirect('/home');
        }

        return view('customer.index');
    }

    /**
     * Fetch all the customer for listing.
     *
     */
    public function getAll()
    {

        if (!$this->checkRoleAndRedirect()) {
            return redirect('/home');
        }

        $customers = Customer::select(['name', 'email', 'created_at'])->get();

        return datatables($customers)
            ->editColumn('created_at', function ($customer) {
                return $customer->created_at->format('d/m/Y');
            })
            ->make(true);
    }
}
