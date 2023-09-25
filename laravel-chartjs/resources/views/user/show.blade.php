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
                        <p><b>Name : </b> {{ $data['user']->name }}</p>
                        <p><b>Email : </b> {{ $data['user']->email }} </p>
                        <p><b>Access Group : </b> {{ $data['user']->access_group->nama }} </p>
                        <p><b>Created At : </b> {{ date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                        $data['user']->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s') }}</p>
                        <p><b>Updated At : </b> {{ date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                        $data['user']->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
