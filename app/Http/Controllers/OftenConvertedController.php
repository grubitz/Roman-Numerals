<?php

namespace App\Http\Controllers;

use App\Conversion;
use Illuminate\Http\Request;
use App\Transformers\ConversionTransformer;

class OftenConvertedController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $result = Conversion::orderBy('conversion_count', 'desc')->limit(10)->get();

        return response()->json([
            'often_converted' => $result->transformWith(new ConversionTransformer())
        ]);
    }
}
