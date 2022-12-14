<?php

namespace App\Http\Livewire\Chart;

use Laravolt\Charts\Bar;
use Illuminate\Support\Facades\DB;

class PenjualanServicePerbulan extends Bar
{
    protected string $title = 'Revenue Service This Year';

    protected int $height = 350;

    /**
     * Sembunyikan semua element pendukung chart seperti sumbu x-y dan label.
     * Cocok untuk menampilkan chart dalam area yang sempit.
     * @link https://apexcharts.com/docs/options/chart/sparkline/
     */
    protected bool $sparkline = false;

    public function series(): array
    {
        $data = DB::table('dm_codes')
            ->select(DB::raw(' code_name as services, coalesce(sum(cn_freightcharge_amount),0) as amount'))
            ->leftJoin('tx_cargo_manifest', 'cn_service', '=', 'code_code')
            ->whereYear('cn_date', date('Y'))
            ->where('code_codegroup', '=', 'SVR')
            ->groupBy('code_name')
            ->pluck('amount','services');

        return [
            'Total' => $data->toArray()
        ];
    }
}
