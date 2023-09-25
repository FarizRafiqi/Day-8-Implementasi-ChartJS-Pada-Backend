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
                        <p><b>Nama : </b> {{ $data['access_master']->nama }}</p>
                        <p><b>Keterangan : </b>
                            <?php echo $data['access_master']->keterangan ?? '-' ?>
                        </p>
                        <p><b>Created At : </b> {{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                        $data['access_master']->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</p>
                        <p><b>Created By : </b> {{ $data['access_master']->user_create->name }}</p>
                        <p><b>Updated At : </b> {{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                        $data['access_master']->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</p>
                        <p><b>Updated By : </b> {{ $data['access_master']->user_update->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
