<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Conversion;
use Carbon\Carbon;

class RecentlyConvertedControllerTest extends TestCase
{
    public function testList()
    {
        $date = Carbon::create(1989, 10, 27, 12);
        Carbon::setTestNow($date);

        for ($i = 1; $i <= 30; $i++) {
            Conversion::firstOrCreate([
                'arabic' => $i,
                'conversion_count' => 1,
                ]);
        }

        foreach (Conversion::where('arabic', '<=', 10)->get() as $key => $conversion) {
            $date = Carbon::create(2019, 9, 15, $key+1);
            Carbon::setTestNow($date);
            $conversion->touch();
        }

        $response = $this->get('api/recently_converted');

        $response
            ->assertStatus(200)
            ->assertExactJson(
                [
                    "recently_converted" => [
                        "data" => [
                            [
                                "integer" => 10,
                                "count" => 1,
                                "last_converted" => "2019-09-15 10:00:00"
                            ],
                            [
                                "integer" => 9,
                                "count" => 1,
                                "last_converted" => "2019-09-15 09:00:00"
                            ],
                            [
                                "integer" => 8,
                                "count" => 1,
                                "last_converted" => "2019-09-15 08:00:00"
                            ],
                            [
                                "integer" => 7,
                                "count" => 1,
                                "last_converted" => "2019-09-15 07:00:00"
                            ],
                            [
                                "integer" => 6,
                                "count" => 1,
                                "last_converted" => "2019-09-15 06:00:00"
                            ],
                            [
                                "integer" => 5,
                                "count" => 1,
                                "last_converted" => "2019-09-15 05:00:00"
                            ],
                            [
                                "integer" => 4,
                                "count" => 1,
                                "last_converted" => "2019-09-15 04:00:00"
                            ],
                            [
                                "integer" => 3,
                                "count" => 1,
                                "last_converted" => "2019-09-15 03:00:00"
                            ],
                            [
                                "integer" => 2,
                                "count" => 1,
                                "last_converted" => "2019-09-15 02:00:00"
                            ],
                            [
                                "integer" => 1,
                                "count" => 1,
                                "last_converted" => "2019-09-15 01:00:00"
                            ]
                        ]
                    ]
                ]
            );
    }
}
