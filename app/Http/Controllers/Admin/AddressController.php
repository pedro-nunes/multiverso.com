<?php

namespace App\Http\Controllers\Admin;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use Illuminate\Database\QueryException;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        try{
            $title = 'Cadastrar endereço';
            $customer = Customer::find($id);
            return view('admin.address.create', 'title', 'customer');
        } catch (QueryException $e) {
            return abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressRequest $request, $customer_id)
    {
        try {
            $address = new Address;
            $address->fill($request->all());
            $address->customer_id = $customer_id;
            $address->save();
            
            return response()->json([
                'trigger' => alert(
                    'Endereço cadastrado com sucesso!',
                    2000,
                    route('admin.customer.index', $request->customer_id)
                ),
            ]);
        } catch (QueryException $e) {
            dd($e->getMessage());
            return abort(500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $address = Address::find($id);
            return response()->json([
                'a' => $address
            ]);

        } catch (QueryException $e) {
            return abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $address = Address::find($id);
            $address->fill($request->all());
            $address->save();
            return response()->json([
                'trigger' => alert(
                    'Endereço atualizado com sucesso!',
                    2000,
                    route('admin.customer.index', $address->customer_id)
                ),
            ]);
        } catch (QueryException $e) {
            return abort(500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $address = Address::find($id);
            $address->delete();
            return response()->json([
                'result' =>  true,
            ]);
        } catch (QueryException $e) {
            return response()->json(['trigger' => db_error($e->getMessage())]);
        }
    }
}