<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{
    public function get_drinkware_products(Request $request)
    {
        $list = Products::where('type_id', 5) -> take(10) -> get();

        foreach ($list as $item)
        {
            $item['description'] = strip_tags($item['description']);
            $item['description'] = $Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$item['description']);
            unset($item['selected_people']);
            unset($item['people']);
        }

        $data = [
            'total_size' => $list -> count(),
            'type_id' => 5,
            'offset' => 0,
            'products' => $list
        ];

    return response() -> json ($data, 200);
    }

    public function get_others_products(Request $request)
    {
        $list = Products::where('type_id', 4) -> take(10) -> get();

        foreach ($list as $item)
        {
            $item['description'] = strip_tags($item['description']);
            $item['description'] = $Content = preg_replace("/&#?[a-z0-9]+;/i"," ",$item['description']);
            unset($item['selected_people']);
            unset($item['people']);
        }

        $data = [
            'total_size' => $list -> count(),
            'type_id' => 4,
            'offset' => 0,
            'products' => $list
        ];

    return response() -> json ($data, 200);
    }
}