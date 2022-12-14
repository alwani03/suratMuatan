<?php

namespace App\Http\Livewire\Chart;

use Laravolt\Charts\Donut;
use Illuminate\Support\Facades\DB;

class TransaksiPerCabang extends Donut
{
    protected string $title = 'transaction Branch This Year';

    protected int $height = 350;

    /**
     * Sembunyikan semua element pendukung chart seperti sumbu x-y dan label.
     * Cocok untuk menampilkan chart dalam area yang sempit.
     * @link https://apexcharts.com/docs/options/chart/sparkline/
     */
    protected bool $sparkline = false;

    public function series(): array
    {
        $data = DB::table('dm_branches')
            ->select(DB::raw(' branch_name as branch, coalesce(sum(cn_freightcharge_amount),0) as amount'))
            ->leftJoin('tx_cargo_manifest', 'cn_branch_code', '=', 'branch_code')
            ->whereYear('cn_date', date('Y'))
            ->groupBy('branch_name')
            ->pluck('amount','branch');

        return [
            'Total' => $data->toArray()
        ];
    }
}
