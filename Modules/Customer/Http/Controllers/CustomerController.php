<?php

namespace Modules\Customer\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Customer\Entities\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('customer::index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function createForm()
    {
        return view('customer::addCust');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function create(Request $request)
    {
       $data = $request->except('_token');

        $cust = new Customer();

        $cust->fill($data);

        $cust->save();

        return $cust->fresh();
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function editForm($id)
    {
        $cust = Customer::find($id);
        return view('customer::editCUst', compact('cust'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function edit(Request $request, $id)
    {
        $data = $request->except('_token');

        $cust = Customer::find($id);

        $cust->fill($data);

        $cust->save();

        return $cust->fresh();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect(route('customer'));
    }
}
