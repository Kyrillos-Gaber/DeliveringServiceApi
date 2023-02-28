<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    //
    // function return all arders in api services
    public function show()
    {
        return Invoice::all();
    }

    // function return company orders
    public function index($companyId)
    {
        return Invoice::where('campanyId', $companyId)->get();
    }


    // function store  a invoices in api services from restaurant
    public function storeInvoice(Request $request)
    {
        $invoice = $request->validate([
            'companyId' => 'required',
            'isPaid' => 'required',
            'delivaryFees' => 'required',
            'city' => 'required',
            'street' => 'required',
            'buildingNumber' => 'required',
            'floorNumber' => 'required',
            'apartmentNumber' => 'required',
            'totalPrice' => 'required',
            'orderDate' => 'required',
            'clientName' => 'required',
            'clientPhone' => 'required',
            'invoiceCode' => 'required',
        ]);

        // $invoiceCode = $invoice['invoiceCode'] . md5($campanyId);

        $order = Invoice::create([
            'companyId' => $invoice['companyId'],
            'isPaid' => $invoice['isPaid'],
            'delivaryFees' => $invoice['delivaryFees'],
            'city' => $invoice['city'],
            'street' => $invoice['street'],
            'buildingNumber' => $invoice['buildingNumber'],
            'floorNumber' => $invoice['floorNumber'],
            'apartmentNumber' => $invoice['apartmentNumber'],
            'totalPrice' => $invoice['totalPrice'],
            'orderDate' => $invoice['orderDate'],
            'clientName' => $invoice['clientName'],
            'clientPhone' => $invoice['clientPhone'],
            'invoiceCode' => $invoice['invoiceCode'],
        ]);

        return response()->json([
            'message' => 'Invoice has been added successfully',
            'data' => $order
        ], 200);
    }
}