<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    private $file_name = 'database.json';

    public function index() {
        if(Storage::exists($this->file_name)) {
            $products = Storage::get($this->file_name);
        } else {
            $products = json_encode([]);
        }
        $products = json_decode($products, true);

        $total = array_sum(array_map(function($item) {
            return $item['Total value number'];
        }, $products));

        return view('index', compact('products', 'total'));
    }

    public function store(Request $request) {

        if($request->ajax()) {

            if(Storage::exists($this->file_name)) {
                $data = Storage::get($this->file_name);
            } else {
                $data = json_encode([]);
            }
            $data = json_decode($data, true);

            $date = date('Y-m-d H:i:s');
            $data =  array_merge($data, [[
                'Product Name'       => $request->input('name'),
                'Quantity in stock'  => $request->input('quantity'),
                'Price per item'     => $request->input('price'),
                'Datetime submitted' => $date,
                'Total value number' => $request->input('quantity') * $request->input('price')
            ]]);

            Storage::put($this->file_name, json_encode($data, JSON_PRETTY_PRINT));
//            dd($data);

           //return response()->json($data);
            //Storage::put('database.json', 'Contents');

            return response()->json([
                'name'     => $request->input('name'),
                'quantity' => $request->input('quantity'),
                'price'    => $request->input('price'),
                'date'     => $date,
                'total'    => $request->input('quantity') * $request->input('price'),
                'success'  => 1
            ]);
        }
    }
}
