<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DmDistrictprices;
use Illuminate\Support\Facades\DB;
use App\Models\DmDistricts;
use App\Models\User;
use App\Models\TxCargoManifest;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class SMPosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // die('testinggg');
        return view('entri.create');
        //
    }

    public function getprice(Request $request)
    {  
        $user  = auth()->user();
        $price = 0;

        $data = DmDistrictprices::where([
            'branch_code'         => $user->user_branch_code,
            'district_dest_code'  => $request->cn_destcity,
            'service_code'        => $request->cn_service,
            'goods_type_code'     => $request->cn_goods_type,
            'weight'              => $request->cn_weight,
        ])->first();

        if (!$data) {
            $price = 0;
        }
        else if ($request->cn_weight > 1) {
            $price = $data['price'] * (int) $request->cn_weight;
        }else{
            $price = $data['price'];
        }

        echo json_encode($price);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth_user = auth()->user();
        $user      = User::with('branch')->find($auth_user->id)->first();
        $citydest  = DmDistricts::with('branch')->active()->where('district_code', '=', $request->cn_destcity)->first();

        $first     = 0;
        $cn_no     = $first.rand(10,1000);
        
        DB::beginTransaction();
        $cn                              = new TxCargoManifest;
        $cn->cn_no                       = $cn_no;
        $cn->cn_date                     = date("Y-m-d", strtotime($request->cn_date));
        $cn->cn_service                  = $request->cn_service;
        $cn->cn_goods_type               = $request->cn_goods_type;
        $cn->cn_branch_code              = $user->branch->branch_code;
        $cn->cn_qty                      = $request->cn_qty;
        $cn->cn_weight                   = $request->cn_weight;
        $cn->cn_freightcharge_amount     = $request->cn_freightcharge_amount;
        $cn->cn_branchdestination_code   = $citydest->branch->branch_code;
        $cn->cn_destcity                 = $request->cn_destcity;
        $cn->cn_shipper_name             = $request->cn_shipper_name;
        $cn->cn_shipper_adress           = $request->cn_shipper_adress;
        $cn->cn_shipper_phone            = $request->cn_shipper_phone;
        $cn->cn_shipper_email            = $request->cn_shipper_email;
        $cn->cn_receiver_name            = $request->cn_receiver_name;
        $cn->cn_receiver_adress          = $request->cn_receiver_adress;
        $cn->cn_receiver_phone           = $request->cn_receiver_phone;
        $cn->cn_receiver_email           = $request->cn_receiver_email;
        $cn->cn_transactionstatus        = 'OK';
        $cn->created_by                  = $auth_user->user_code;
        $cn->updated_by                  = $auth_user->user_code;
        $cn->is_active                   = '1';
        $cn->save();

        DB::commit();

        return redirect()->route('pos.create')->withSuccess('Berhasil membuat transaski');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
