<?php

namespace App\Transformers;

use App\Conversion;
use League\Fractal\TransformerAbstract;

class ConversionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Conversion $conversion)
    {
        return [
            'integer' => $conversion->arabic,
            'count' => $conversion->conversion_count,
            'last_converted' => $conversion->updated_at->toDateTimeString()
        ];
    }
}
