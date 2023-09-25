@extends('layouts.app')
@section('title', 'Access Master')
@section('content')
    <div class="right_col" role="main">
        <div class="container">
            <h4 class="panel-heading">
                @if($data['actions'] == 'store')
                    Tambah
                @else
                    Ubah
                @endif
                Akses Master
            </h4>
            <div class="panel-body mt-4" id="toro-area">
                <form id="toro-form" method="POST"
                      action="{{ ($data['actions'] == 'store') ? route('access_masters.store') : route('access_masters.update', $data['access_master']->id) }}">
                    @if($data['actions']=='update')
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter nama"
                                       value="{{ $data['access_master']->nama }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                        <textarea class="textarea form-control" rows="8" name="keterangan"
                        >{{ $data['access_master']->keterangan }}</textarea>
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
                            <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter nama"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                        <textarea class="textarea form-control" rows="8"
                                  name="keterangan"></textarea>
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
