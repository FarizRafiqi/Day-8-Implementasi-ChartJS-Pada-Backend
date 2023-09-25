<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOrder extends Model
{
    use HasFactory;
    public $table = 'beli_order';

    public function user_create()
    {
        return $this->belongsTo('App\Models\User', 'created_id', 'id');
    }

    public function user_update()
    {
        return $this->belongsTo('App\Models\User', 'updated_id', 'id');
    }

    public function filter($order_field, $order_ascdesc, $search, $search_column, $limit, $startLimit)
    {
        $sql = MOrder::select('beli_order.*', 'user_create.name as user_create_name', 'user_update.name as user_update_name')
        ->join('users as user_create', 'user_create.id', 'beli_order.created_id')
        ->join('users as user_update', 'user_update.id', 'beli_order.updated_id')
        ->orderBy($order_field, $order_ascdesc);

        if ($search != '' && $search != NULL) {
            $sql->where('beli_order.id', 'LIKE', "%{$search}%")
            ->orWhere('beli_order.tanggal', 'LIKE', "%{$search}%")
            ->orWhere('beli_order.tanggal_dibutuhkan', 'LIKE', "%{$search}%")
            ->orWhere('beli_order.no_faktur', 'LIKE', "%{$search}%")
            ->orWhere('beli_order.id_m_vendor', 'LIKE', "%{$search}%")
            ->orWhere('beli_order.id_user_verifikasi', 'LIKE', "%{$search}%")
            ->orWhere('beli_order.jumlah', 'LIKE', "%{$search}%")
            ->orWhere('beli_order.ppn_percent', 'LIKE', "%{$search}%")
            ->orWhere('beli_order.pp_nominal', 'LIKE', "%{$search}%")
            ->orWhere('beli_order.total', 'LIKE', "%{$search}%")
            ->orWhere('beli_order.status', 'LIKE', "%{$search}%")
            ->orWhere('beli_order.created_at', 'LIKE', "%{$search}%")
            ->orWhere('user_create.name', 'LIKE', "%{$search}%")
            ->orWhere('beli_order.updated_at', 'LIKE', "%{$search}%")
            ->orWhere('user_update.name', 'LIKE', "%{$search}%");
        }

        if ($search_column['id'] != '' && $search_column['id'] != NULL) {
            $sql->where('beli_order.id', 'LIKE', "%{$search_column['id']}%");
        }
        if ($search_column['tanggal'] != '' && $search_column['tanggal'] != NULL) {
            $sql->where('beli_order.tanggal', 'LIKE', "%{$search_column['tanggal']}%");
        }
        if ($search_column['tanggal_dibutuhkan'] != '' && $search_column['tanggal_dibutuhkan'] != NULL) {
            $sql->where('beli_order.tanggal_dibutuhkan', 'LIKE', "%{$search_column['tanggal_dibutuhkan']}%");
        }
        if ($search_column['no_faktur'] != '' && $search_column['no_faktur'] != NULL) {
            $sql->where('beli_order.no_faktur', 'LIKE', "%{$search_column['no_faktur']}%");
        }
        if ($search_column['id_m_vendor'] != '' && $search_column['id_m_vendor'] != NULL) {
            $sql->where('beli_order.id_m_vendor', 'LIKE', "%{$search_column['id_m_vendor']}%");
        }
        if ($search_column['id_user_verifikasi'] != '' && $search_column['id_user_verifikasi'] != NULL) {
            $sql->where('beli_order.id_user_verifikasi', 'LIKE', "%{$search_column['id_user_verifikasi']}%");
        }
        if ($search_column['jumlah'] != '' && $search_column['jumlah'] != NULL) {
            $sql->where('beli_order.jumlah', 'LIKE', "%{$search_column['jumlah']}%");
        }
        if ($search_column['ppn_percent'] != '' && $search_column['ppn_percent'] != NULL) {
            $sql->where('beli_order.ppn_percent', 'LIKE', "%{$search_column['ppn_percent']}%");
        }
        if ($search_column['pp_nominal'] != '' && $search_column['pp_nominal'] != NULL) {
            $sql->where('beli_order.pp_nominal', 'LIKE', "%{$search_column['pp_nominal']}%");
        }
        if ($search_column['total'] != '' && $search_column['total'] != NULL) {
            $sql->where('beli_order.total', 'LIKE', "%{$search_column['total']}%");
        }
        if ($search_column['status'] != '' && $search_column['status'] != NULL) {
            $sql->where('beli_order.status', 'LIKE', "%{$search_column['status']}%");
        }
        if ($search_column['created_at'] != '' && $search_column['created_at'] != NULL) {
            $sql->where('beli_order.created_at', 'LIKE', "%{$search_column['created_at']}%");
        }
        if ($search_column['user_create'] != '' && $search_column['user_create'] != NULL) {
            $sql->where('user_create.name', 'LIKE', "%{$search_column['user_create']}%");
        }
        if ($search_column['updated_at'] != '' && $search_column['updated_at'] != NULL) {
            $sql->where('beli_order.updated_at', 'LIKE', "%{$search_column['updated_at']}%");
        }
        if ($search_column['user_update'] != '' && $search_column['user_update'] != NULL) {
            $sql->where('user_update.name', 'LIKE', "%{$search_column['user_update']}%");
        }

        $filter_count = $sql->count();
        $filter_data = $sql->offset($startLimit)->limit($limit)->get();

        $data = ['filter_count' => $filter_count, 'filter_data' => $filter_data];
        return $data;
    }
}
