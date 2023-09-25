@extends('layouts.app')
@section('title', 'Access Group')
@section('content')
    <div class="right_col" role="main">
        <div class="container">
            <h4 class="panel-heading">
                @if($data['actions'] == 'store')
                    Tambah
                @else
                    Ubah
                @endif
                Akses Group
            </h4>
            <form id="toro-form" class="mt-5" method="POST"
                  action="{{ ($data['actions'] == 'store') ? route('access_groups.store') : route('access_groups.update', base64_encode($data['access_group']->id)) }}">
                @if($data['actions']=='update')
                    @method('PUT')
                    @csrf
                    <div class="form-group row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter nama"
                                   value="{{ $data['access_group']->nama }}" required>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                    <textarea class="textarea form-control" rows="8"
                              name="keterangan">{{ $data['access_group']->keterangan }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="access_master" class="col-sm-2 col-form-label">Access Master</label>
                        <div class="col-sm-10">
                            <select class="js-example-placeholder-multiple form-control" name="access_masters[]"
                                    id="access_masters"
                                    multiple="multiple">
                                @for ($i = 0; $i < count($data['access_master']); $i++)
                                    <option
                                        value="{{ $data['access_master'][$i]->id }}">
                                        {{ $data['access_master'][$i]->nama}}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="submit" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" name="summary">
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
                            <textarea class="textarea form-control" rows="8" name="keterangan"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="access_master" class="col-sm-2 col-form-label">Access Master</label>
                        <div class="col-sm-10">
                            <select class="js-example-placeholder-multiple form-control" name="access_masters[]"
                                    id="access_masters" multiple="multiple">
                                @for ($i = 0; $i < count($data['access_master']); $i++)
                                    <option
                                        value="{{ $data['access_master'][$i]->id }}">
                                        {{ $data['access_master'][$i]->nama}}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="submit" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <input type="hidden" name="summary">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(".js-example-placeholder-multiple").select2({
            placeholder: "Select a Access Master"
        });
    </script>
@endpush
