<?php

namespace App\Http\Controllers;

use App\Conversion;
use Illuminate\Http\Request;
use App\Transformers\ConversionTransformer;

class RecentlyConvertedController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $result = Conversion::latest('updated_at')->limit(10)->get();
        return response()->json([
            'recently_converted' => $result->transformWith(new ConversionTransformer())->toArray()
        ]);
    }
}
