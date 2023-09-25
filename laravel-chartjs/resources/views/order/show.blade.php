@extends('layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="container">
            <div class="panel-body" id="toro-area">
                <div class="content">
                    <div class="header">General</div>
                </div>
                <div class="content">
                    <div class="description">
                        <p><b>Tanggal : </b> {{ $data['beli_order']->tanggal }}</p>
                        <p><b>Tanggal Dibutuhkan : </b> {{ $data['beli_order']->tanggal_dibutuhkan }} </p>
                        <p><b>No Faktur : </b> {{ $data['beli_order']->no_faktur}} </p>
                        <p><b>Vendor : </b> {{ $data['beli_order']->id_m_vendor }} </p>
                        <p><b>User Verifikasi : </b> {{ $data['beli_order']->id_user_verifikasi }} </p>
                        <p><b>Harga Sebelum PPN : </b> {{ $data['beli_order']->jumlah }} </p>
                        <p><b>PPN % : </b> {{ $data['beli_order']->ppn_percent }} </p>
                        <p><b>Nominal PPN : </b> {{ $data['beli_order']->pp_nominal }} </p>
                        <p><b>Harga Setelah PPN : </b> {{ $data['beli_order']->total }} </p>
                        <p><b>Status : </b> {{ $data['beli_order']->status }} </p>
                        <p><b>Created At : </b> {{ date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                        $data['beli_order']->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s') }}</p>
                        <p><b>Updated At : </b> {{ date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                        $data['beli_order']->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s') }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
