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
                Order
            </h4>
            <div class="panel-body mt-4" id="toro-area">
                <form id="toro-form" method="POST"
                      action="{{ ($data['actions'] == 'store') ? route('orders.store') : route('orders.update', base64_encode($data['beli_order']->id)) }}">
                    @if($data['actions']=='update')
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                       placeholder="Masukkan Tanggal" value="{{ $data['beli_order']->tanggal }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_dibutuhkan" class="col-sm-2 col-form-label">Tanggal Dibutuhkan</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal_dibutuhkan"
                                       name="tanggal_dibutuhkan"
                                       placeholder="Masukkan Tanggal Dibutuhkan"
                                       value="{{ $data['beli_order']->tanggal_dibutuhkan }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_faktur" class="col-sm-2 col-form-label">No Faktur</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_faktur" name="no_faktur"
                                       placeholder="Masukkan No Faktur" value="{{ $data['beli_order']->no_faktur }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_m_vendor" class="col-sm-2 col-form-label">Vendor</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_m_vendor" name="id_m_vendor"
                                       placeholder="Masukkan Nama Vendor" value="{{ $data['beli_order']->id_m_vendor }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_user_verifikasi" class="col-sm-2 col-form-label">ID User Verifikasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_user_verifikasi"
                                       name="id_user_verifikasi"
                                       placeholder="Masukkan User Verifikasi"
                                       value="{{ $data['beli_order']->id_user_verifikasi }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ppn_percent" class="col-sm-2 col-form-label">PPN Percent</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ppn_percent" name="ppn_percent"
                                       placeholder="Masukkan PPN" value="{{ $data['beli_order']->ppn_percent }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pp_nominal" class="col-sm-2 col-form-label">PPN Nominal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="pp_nominal" name="pp_nominal"
                                       placeholder="Masukkan PPN Nominal" value="{{ $data['beli_order']->pp_nominal }}"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="jumlah" name="jumlah"
                                       placeholder="Masukkan Jumlah"
                                       value="{{ $data['beli_order']->jumlah }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total" class="col-sm-2 col-form-label">Total</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="total" name="total"
                                       placeholder="Masukkan Total"
                                       value="{{ $data['beli_order']->total }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="status" name="status"
                                       placeholder="0 = not completed, 1 = completed, 2 = partial, 3 = canceled"
                                       value="{{ $data['beli_order']->status }}" required>
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
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                       placeholder="Masukkan Tanggal" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_dibutuhkan" class="col-sm-2 col-form-label">Tanggal Dibutuhkan</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal_dibutuhkan"
                                       name="tanggal_dibutuhkan"
                                       placeholder="Masukkan Tanggal Dibutuhkan"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_faktur" class="col-sm-2 col-form-label">No Faktur</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_faktur" name="no_faktur"
                                       placeholder="Masukkan No Faktur" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_m_vendor" class="col-sm-2 col-form-label">Vendor</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_m_vendor" name="id_m_vendor"
                                       placeholder="Masukkan Nama Vendor" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_user_verifikasi" class="col-sm-2 col-form-label">ID User Verifikasi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="id_user_verifikasi"
                                       name="id_user_verifikasi"
                                       placeholder="Masukkan User Verifikasi"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ppn_percent" class="col-sm-2 col-form-label">PPN Percent</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="ppn_percent" name="ppn_percent"
                                       placeholder="Masukkan PPN" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pp_nominal" class="col-sm-2 col-form-label">PPN Nominal</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="pp_nominal" name="pp_nominal"
                                       placeholder="Masukkan PPN Nominal" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="jumlah" name="jumlah"
                                       placeholder="Masukkan Jumlah"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="total" class="col-sm-2 col-form-label">Total</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="total" name="total"
                                       placeholder="Masukkan Total"
                                       required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="status" name="status"
                                       placeholder="0 = not completed, 1 = completed, 2 = partial, 3 = canceled"
                                       required>
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
