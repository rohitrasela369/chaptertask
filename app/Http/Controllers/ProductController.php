<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * constructor fuction to load some requirement for controller
     */
    public function __construct(Product $product = null)
    {
        $this->Product = $product;
    }

    /**
     * function to check the user role and redirect
     */
    public function checkRoleAndRedirect()
    {
        $roles = Auth::user()->getRoles();
        if (in_array('admin', $roles->toArray()) || in_array('shop-manager', $roles->toArray())) {
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

        return view('product.index');
    }

    /**
     * Fetch all the product for listing.
     *
     */
    public function getAll()
    {
        if (!$this->checkRoleAndRedirect()) {
            return redirect('/home');
        }

        $products = Product::select(['name', 'price', 'in_stock'])->get();

        return datatables($products)
            ->editColumn('in_stock', function ($product) {
                return ($product->in_stock) ? "Yes" : "No";
            })
            ->make(true);
    }
}
