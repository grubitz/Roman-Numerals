<?php

namespace App\Http\Controllers;

use App\Conversion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConversionController extends Controller
{
    /**
     * @param  int  $integer
     * @return \Illuminate\Http\Response
     */
    public function convert(int $integer)
    {
        $converter = new \App\IntegerConversion();
        $result = $converter->toRomanNumerals($integer);
        if (!isset($result)) {
            return response()->json([
                'error' => 'Integer has to be between 1 and 3999'
            ], Response::HTTP_BAD_REQUEST);
        }
        $conversion = Conversion::where(['arabic' => $integer])->first();
        if (!isset($conversion)) {
            $conversion = new Conversion(['arabic' => $integer, 'conversion_count' => 0]);
        }
        $conversion->conversion_count++;
        $conversion->save();

        return response()->json([
            'numeral' => $result
        ]);
    }
}
