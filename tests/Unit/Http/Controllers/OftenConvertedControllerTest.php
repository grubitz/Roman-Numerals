<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Conversion;
use Carbon\Carbon;

class OftenConvertedControllerTest extends TestCase
{
    public function testList()
    {
        $date = Carbon::create(1989, 10, 27, 12);
        Carbon::setTestNow($date);

        for ($i = 1; $i <= 3; $i++) {
            Conversion::firstOrCreate([
                'arabic' => $i,
                'conversion_count' => 10 - $i,
                'created_at' => $date,
                'updated_at' => $date
                ]);
        }

        $response = $this->get('api/often_converted');

        $response
            ->assertStatus(200)
            ->assertExactJson(
                [
                    "often_converted" => [
                        "data" => [
                            [
                                "integer" => 1,
                                "count" => 9,
                                "last_converted" => "1989-10-27 12:00:00"
                            ],
                            [
                                "integer" => 2,
                                "count" => 8,
                                "last_converted" => "1989-10-27 12:00:00"
                            ],
                            [
                                "integer" => 3,
                                "count" => 7,
                                "last_converted" => "1989-10-27 12:00:00"
                            ]
                        ],
                    ]
                ]
            );
    }
}
