<?php

namespace App\Http\Livewire\Chart;

use Laravolt\Charts\Line;
use App\Models\TxCargoManifest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PenjualanPerbulan extends Line
{
    protected string $title = 'Revenue This Year';

    protected int $height = 350;

    /**
     * Sembunyikan semua element pendukung chart seperti sumbu x-y dan label.
     * Cocok untuk menampilkan chart dalam area yang sempit.
     * @link https://apexcharts.com/docs/options/chart/sparkline/
     */
    protected bool $sparkline = false;

    public function series(): array
    {
        // Inisiasi data 12 bulan dengan value 0.
        // Ingat, array dimulai dari index 0.
        $data = [0,0,0,0,0,0,0,0,0,0,0,0];
        // Ambil data registrasi bulanan.
        // Di step ini, tidak semua bulan ada datanya.
        // $cn = TxConnotes::whereYear('cn_date', now()->year)
        //     ->pluck('cn_date', 'cn_freightcharge_amount')
        //     ->countBy(function ($createdAt, $freightAmount) {
        //         // kurangi dengan 1, agar sesuai dengan index array yang dimulai dari 0
        //         return Carbon::parse($createdAt)->month - 1;
        //     });

        $cn = TxCargoManifest::select(
            DB::raw('sum(cn_freightcharge_amount) as sums'), 
            DB::raw("month(cn_date) as monthKey")
            )
            ->whereYear('cn_date', date('Y'))
            ->groupBy('monthKey')
            ->orderBy('cn_date', 'ASC')
            ->get();

        // Oleh sebab itu, kita gabungkan data bulanan riil dengan data 12 bulan kosongan,
        // agar array yang dihasilkan tetap 12
        // $data = $cn->union($months)->toArray();
        foreach($cn as $cnperbulan){
            $data[$cnperbulan->monthKey-1] = $cnperbulan->sums;
        }

        return [
            'Total' => $data,
        ];
    }

    public function labels(): array
    {
        return ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    }
}
