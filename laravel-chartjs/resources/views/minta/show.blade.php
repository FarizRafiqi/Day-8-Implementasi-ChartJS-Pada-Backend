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
                        <p><b>Tanggal : </b> {{ $data['beli_minta']->tanggal }}</p>
                        <p><b>Tanggal Dibutuhkan : </b> {{ $data['beli_minta']->tanggal_dibutuhkan }} </p>
                        <p><b>No Faktur : </b> {{ $data['beli_minta']->no_faktur}} </p>
                        <p><b>Vendor : </b> {{ $data['beli_minta']->id_user_pemohon }} </p>
                        <p><b>User Verifikasi : </b> {{ $data['beli_minta']->id_user_menyetujui }} </p>
                        <p><b>Status : </b> {{ $data['beli_minta']->status }} </p>
                        <p><b>Created At : </b> {{ date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                        $data['beli_minta']->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s') }}</p>
                        <p><b>Updated At : </b> {{ date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                        $data['beli_minta']->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
