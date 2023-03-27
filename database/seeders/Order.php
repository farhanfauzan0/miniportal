<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Order extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10000; $i++) {
            DB::table('portal_order')->insert([
                'pemesan' => "TEST" . Str::random(3),
                'pesanan_id' => "1",
                'jumlah_pesanan' => "10",
                'status_id' => "1",
                'deadline' => Carbon::now(),
                'omset' => str_replace('.', "", "1000000"),
                'created_at' => Carbon::now()
            ]);
        }
    }
}
