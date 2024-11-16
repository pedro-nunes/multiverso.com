<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Services\FreteService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{

    /*/
    protected $freteService;

    public function __construct(FreteService $freteService)
    {
        $this->freteService = $freteService;
    }

    /**
     * Realiza a cotação de frete e exibe o resultado.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     
    public function getDeliveryPrices(Request $request)
    {
        $request->validate([
            'cep_origem' => 'required|regex:/^\d{5}-\d{3}$/',
            'cep_destino' => 'required|regex:/^\d{5}-\d{3}$/',
            'peso' => 'required|numeric|min:1',
            'comprimento' => 'required|numeric|min:1',
            'altura' => 'required|numeric|min:1',
            'largura' => 'required|numeric|min:1',
        ]);

        $dados = [
            'from' => [
                'zipcode' => str_replace('-', '', $request->cep_origem), 
            ],
            'to' => [
                'zipcode' => str_replace('-', '', $request->cep_destino),
            ],
            'weight' => $request->peso * 1000, // Convertendo para gramas
            'dimensions' => [
                'length' => $request->comprimento,
                'height' => $request->altura,
                'width' => $request->largura,
            ],
        ];

        // Realiza a cotação
        $cotacao = $this->freteService->cotarFrete($dados);

        return view('frete.result', compact('cotacao'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $title = 'Pedidos';
            $products = Product::all();
            if($products->isEmpty()) {
                session()->flash('info', 'Ainda não existe <b class="text-danger">Pedidos</b> cadastrados no sistema');
            }
            return view('admin.order.index', compact('title', 'products'));
        } catch (QueryException $e) {
            // Log the error
            return abort(500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Criar pedido';

        return view('admin.order.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $order = new Order;
            $order->fill($request->all());

            $order->customer_id = $request->customer_id;

            $order->payment = 'CREDITO 5X';
            $order->total_order = '299.99';
            $order->information = 'teste';

            //$order->user_id = 1;

            
            $address = new \stdClass;
            /**
             * Dados do cliente
             */
            $address->customer = $request->customer;
            $address->cpf = $request->cpf;
            //$address->rg = $request->rg;
            $address->email = $request->email;
            $address->phone = $request->phone;
            $address->whatsapp = $request->whatsapp;

            /**
             * Endereço deentrega do cliente
             */
            $address->address_name = $request->address_name;
            $address->zip = $request->zip;
            $address->address = $request->address;
            $address->number = $request->number;
            $address->complement = $request->complement;
            $address->district = $request->district;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->observation = $request->observation;

            /**
             * Transformar o objeto em json
             */
            $order->delivery_address = json_encode($address);
            
            $order->save();       

        } catch (\Exception $e) {
            dd($e->getMessage());
            return abort(500);
        }
    }

    public function getCustomer(string $document)
    {
        try {
            $customer = Customer::where('document', $document)->first();
            return response()->json([
                'c' => $customer
            ]);
        } catch (QueryException $e) {
            dd($e->getMessage());
            return abort(500);
        }
    }

    public function getDeliveryPrice($zip)
    {
        $price = null;
        if($zip == '08615300'){
            $price = '19.90';
        } elseif($zip == '08780000') {
            $price = '32.25';
        } elseif($zip == '08673000') {
            $price = '16.90';
        }
        $total = $price+5199.99;

        return response()->json([
            'c' => [ 
                'frete' => number_format($price,2,",","."),
                'total' => number_format($total,2,",",".")
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}