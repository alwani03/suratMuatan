<x-volt-app title="Entri Surat Muatan">
    {!! form()->open()->post()->action(route('pos.store'))->horizontal() !!}
        <x-volt-panel title="Data" icon="book">
            {{-- tanggal  --}}
            {!! form()->timepicker('cn_date', date('d-m-Y'))->withTime()->label('Date')->readonly() !!}

            {{-- nomor surat muatan udara  --}}
            {!! form()->text('cn_no')->label('No. Surat Muatan Udara')->hint('Leave it blank to generate from the system') !!}

            {{-- Destination city  --}}
            @php
            $query = "SELECT district_code as id, district_name name from dm_districts where is_active = 1 order by district_name"
            @endphp
            {!!  form()->dropdownDB('cn_destcity', $query, 'id', 'name')->label('Destination City')->id('destcity')->required() !!}

            {{-- Service Type --}}
            @php
            $query = "SELECT code_code as id, code_name name from dm_codes where code_codegroup = 'SVR' and is_active = 1 order by code_name"
            @endphp
            {!!  form()->dropdownDB('cn_service', $query, 'id', 'name')->label('Service Type')->id('service')->required() !!}

            @php
            $query = "SELECT code_code as id, code_name name from dm_codes where code_codegroup = 'SHI' and is_active = 1 order by code_name"
            @endphp
            {!!  form()->dropdownDB('cn_goods_type', $query, 'id', 'name')->label('Shipmemnt Type')->id('goods_type')->required() !!}

            {{-- koli dan berat  --}}
            {!! form()->number('cn_qty')->id('cn_qty')->label('Colly')->required() !!}
            {!! form()->number('cn_weight')->id('cn_weight')->label('Weight')->required() !!}
            {!! form()->text('cn_freightcharge_amount_view')->id('cn_freightcharge_amount_view')->label('Shipping Cost')->readonly()->required() !!}

            <input type="hidden" id="cn_freightcharge_amount" name="cn_freightcharge_amount" value="">

            <x-volt-panel title="Shipper" icon="user-plus">

                {!! form()->text('cn_shipper_name')->label('Name')->required() !!}
                {!! form()->text('cn_shipper_adress')->label('Address')->required() !!}
                {!! form()->number('cn_shipper_phone')->label('No.Telp')->required() !!}
                {!! form()->text('cn_shipper_email')->label('Email') !!}
        
            </x-volt-panel>

            <x-volt-panel title="Consignee" icon="user-plus">

                {!! form()->text('cn_receiver_name')->label('Name')->required() !!}
                {!! form()->text('cn_receiver_adress')->label('Address')->required() !!}
                {!! form()->number('cn_receiver_phone')->label('No.Telp')->required() !!}
                {!! form()->text('cn_receiver_email')->label('Email') !!}
        
            </x-volt-panel>

        </x-volt-panel>
    {!! form()->action(form()->submit(__('Save')), form()->link(__('Cancel'), route('pos.create'))) !!}
    {!! form()->close() !!}
</x-volt-app>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function () {
        //untuk token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '<?= csrf_token() ?>'
            }
        });

        function formatRupiah(angka, prefix) {
            console.log(angka)
              var number_string = angka.toString(),
                split = number_string.split(","),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

              // tambahkan titik jika yang di input sudah menjadi angka ribuan
              if (ribuan) {
                separator = sisa ? "." : "";
                rupiah += separator + ribuan.join(".");
              }
            
              rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
              return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
        }

        $('#cn_weight').on('change', function (e) {
            if($('#cn_weight').val() < 10){
                Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'Price Minimum Weight 10 Kg',
                    })
                return false
            }
  
            let cn_destcity    = $('#destcity').val()
            let cn_service     = $('#service').val()
            let cn_goods_type  = $('#goods_type').val()
            let cn_qty         = $('#cn_qty').val()
            let cn_weight      = $('#cn_weight').val()

            $.ajax({
                url: "{{ route('pos.getprice') }}",
                type: 'post',
                data: {
                    cn_destcity: cn_destcity,
                    cn_service: cn_service,
                    cn_goods_type: cn_goods_type,
                    cn_qty: cn_qty,
                    cn_weight: cn_weight
                },
                dataType: 'json',
                success: function(data) {
                    
                    let dataRupiah = formatRupiah(data,"Rp. ")
                    if (data == 0){
                            Swal.fire({
                                 icon: 'error',
                                 title: 'Oops...',
                                 text: 'Price Not Available!',
                            })
                        return false
                    }else{
                        Swal.fire({
                                 icon: 'success',
                                 title: '',
                                 text: dataRupiah,
                        })
                        $('#cn_freightcharge_amount_view').val(dataRupiah)
                        $('#cn_freightcharge_amount').val(data)
                    }
                }
            });

        });

    });

</script>