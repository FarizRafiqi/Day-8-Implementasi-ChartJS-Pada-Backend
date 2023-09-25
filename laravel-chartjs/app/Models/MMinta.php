<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMinta extends Model
{
    use HasFactory;
    public $table = 'beli_minta';

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
        $sql = MMinta::select('beli_minta.*', 'user_create.name as user_create_name', 'user_update.name as user_update_name')
        ->join('users as user_create', 'user_create.id', 'beli_minta.created_id')
        ->join('users as user_update', 'user_update.id', 'beli_minta.updated_id')
        ->orderBy($order_field, $order_ascdesc);

        if ($search != '' && $search != NULL) {
            $sql->where('beli_minta.id', 'LIKE', "%{$search}%")
            ->orWhere('beli_minta.tanggal', 'LIKE', "%{$search}%")
            ->orWhere('beli_minta.tanggal_dibutuhkan', 'LIKE', "%{$search}%")
            ->orWhere('beli_minta.no_faktur', 'LIKE', "%{$search}%")
            ->orWhere('beli_minta.id_user_pemohon', 'LIKE', "%{$search}%")
            ->orWhere('beli_minta.id_user_menyetujui', 'LIKE', "%{$search}%")
            ->orWhere('beli_minta.status', 'LIKE', "%{$search}%")
            ->orWhere('beli_minta.created_at', 'LIKE', "%{$search}%")
            ->orWhere('user_create.name', 'LIKE', "%{$search}%")
            ->orWhere('beli_minta.updated_at', 'LIKE', "%{$search}%")
            ->orWhere('user_update.name', 'LIKE', "%{$search}%");
        }

        if ($search_column['id'] != '' && $search_column['id'] != NULL) {
            $sql->where('beli_minta.id', 'LIKE', "%{$search_column['id']}%");
        }
        if ($search_column['tanggal'] != '' && $search_column['tanggal'] != NULL) {
            $sql->where('beli_minta.tanggal', 'LIKE', "%{$search_column['tanggal']}%");
        }
        if ($search_column['tanggal_dibutuhkan'] != '' && $search_column['tanggal_dibutuhkan'] != NULL) {
            $sql->where('beli_minta.tanggal_dibutuhkan', 'LIKE', "%{$search_column['tanggal_dibutuhkan']}%");
        }
        if ($search_column['no_faktur'] != '' && $search_column['no_faktur'] != NULL) {
            $sql->where('beli_minta.no_faktur', 'LIKE', "%{$search_column['no_faktur']}%");
        }
        if ($search_column['id_user_pemohon'] != '' && $search_column['id_user_pemohon'] != NULL) {
            $sql->where('beli_minta.id_user_pemohon', 'LIKE', "%{$search_column['id_user_pemohon']}%");
        }
        if ($search_column['id_user_menyetujui'] != '' && $search_column['id_user_menyetujui'] != NULL) {
            $sql->where('beli_minta.id_user_menyetujui', 'LIKE', "%{$search_column['id_user_menyetujui']}%");
        }
        if ($search_column['status'] != '' && $search_column['status'] != NULL) {
            $sql->where('beli_minta.status', 'LIKE', "%{$search_column['status']}%");
        }
        if ($search_column['created_at'] != '' && $search_column['created_at'] != NULL) {
            $sql->where('beli_minta.created_at', 'LIKE', "%{$search_column['created_at']}%");
        }
        if ($search_column['user_create'] != '' && $search_column['user_create'] != NULL) {
            $sql->where('user_create.name', 'LIKE', "%{$search_column['user_create']}%");
        }
        if ($search_column['updated_at'] != '' && $search_column['updated_at'] != NULL) {
            $sql->where('beli_minta.updated_at', 'LIKE', "%{$search_column['updated_at']}%");
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
