@extends('layouts.app')
@section('title', 'Access Master Detail')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="panel-body" id="toro-area">
                <div class="content">
                    <h3> General</h3>
                </div>
                <div class="content">
                    <div class="description">
                        <p><b>Nama : </b> {{ $data['barang']->nama }}</p>
                        <p><b>Keterangan : </b>
                            <?php echo $data['barang']->keterangan ?? '-' ?>
                        </p>
                        <p><b>Created At : </b> {{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                        $data['barang']->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</p>
                        <p><b>Created By : </b> {{ $data['barang']->user_create->name }}</p>
                        <p><b>Updated At : </b> {{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                        $data['barang']->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</p>
                        <p><b>Updated By : </b> {{ $data['barang']->user_update->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
