@extends('layouts.app')
@section('title', 'User')
@section('content')
    <div class="right_col" role="main">
        <div class="container">
            <h4 class="panel-heading">
                @if($data['actions'] == 'store')
                    Tambah
                @else
                    Ubah
                @endif
                User
            </h4>
            <div class="panel-body mt-4" id="toro-area">
                <form id="toro-form" method="POST"
                      action="{{ ($data['actions'] == 'store') ? route('users.store') : route('users.update', base64_encode($data['user']->id)) }}">
                    @if($data['actions']=='update')
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                       value="{{ $data['user']->name }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Enter email"
                                       value="{{ $data['user']->email }}" required>
                            </div>
                        </div>
                            <?php if ($data['actions'] !== 'update') : ?>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Enter password" required>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group row">
                            <label for="id_access_group" class="col-sm-2 col-form-label">Access Group</label>
                            <div class="col-sm-10">
                                <select class="js-example-placeholder-multiple form-control" name="id_access_group"
                                        id="id_access_group">
                                    @for ($i = 0; $i < count($data['access_group']); $i++)
                                        <option value="{{ $data['access_group'][$i]->id }}">
                                            {{ $data['access_group'][$i]->nama}}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="submit" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    @else
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Enter email"
                                       required>
                            </div>
                        </div>
                            <?php if ($data['actions'] !== 'update') : ?>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password"
                                       placeholder="Enter password" required>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group row">
                            <label for="id_access_group" class="col-sm-2 col-form-label">Access Group</label>
                            <div class="col-sm-10">
                                <select class="js-example-placeholder-multiple form-control" name="id_access_group"
                                        id="id_access_group">
                                    @for ($i = 0; $i < count($data['access_group']); $i++)
                                        <option value="{{ $data['access_group'][$i]->id }}">
                                            {{ $data['access_group'][$i]->nama}}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="submit" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
@section('header_scripts')
    @parent
    <link href="{{ asset ('js/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('js/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet">

    <script src="{{ asset ('js/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset ('js/knockout.js') }}"></script>
    <script src="{{ asset ('js/knockout-sortable.js') }}"></script>
@endsection
@push('scripts')
<script>
    $(".js-example-placeholder-multiple").select2({
        placeholder: "Select a Access Master"
    });
</script>
@endpush
