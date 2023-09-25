<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MBarang extends Model
{
    public $table = 'm_barang';
    protected $fillable = [
        'nama',
        'keterangan',
        'status'
    ];

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
        $sql = MBarang::select('m_barang.*', 'user_create.name as user_create_name', 'user_update.name as user_update_name')
            ->join('users as user_create', 'user_create.id', 'm_barang.created_id')
            ->join('users as user_update', 'user_update.id', 'm_barang.updated_id')
            ->orderBy($order_field, $order_ascdesc);

        if ($search != '' && $search != NULL) {
            $sql->where('m_barang.id', 'LIKE', "%{$search}%")
                ->orWhere('m_barang.nama', 'LIKE', "%{$search}%")
                ->orWhere('m_barang.keterangan', 'LIKE', "%{$search}%")
                ->orWhere('m_barang.status', 'LIKE', "%{$search}%")
                ->orWhere('m_barang.created_at', 'LIKE', "%{$search}%")
                ->orWhere('user_create.name', 'LIKE', "%{$search}%")
                ->orWhere('m_barang.updated_at', 'LIKE', "%{$search}%")
                ->orWhere('user_update.name', 'LIKE', "%{$search}%");
        }

        if ($search_column['id'] != '' && $search_column['id'] != NULL) {
            $sql->where('m_barang.id', 'LIKE', "%{$search_column['id']}%");
        }

        if ($search_column['nama'] != '' && $search_column['nama'] != NULL) {
            $sql->where('m_barang.nama', 'LIKE', "%{$search_column['nama']}%");
        }

        if ($search_column['keterangan'] != '' && $search_column['keterangan'] != NULL) {
            $sql->where('m_barang.keterangan', 'LIKE', "%{$search_column['keterangan']}%");
        }

        if ($search_column['status'] != '' && $search_column['status'] != NULL) {
            $sql->where('m_barang.status', 'LIKE', "%{$search_column['status']}%");
        }

        if ($search_column['created_at'] != '' && $search_column['created_at'] != NULL) {
            $sql->where('m_barang.created_at', 'LIKE', "%{$search_column['created_at']}%");
        }

        if ($search_column['user_create'] != '' && $search_column['user_create'] != NULL) {
            $sql->where('user_create.name', 'LIKE', "%{$search_column['user_create']}%");
        }

        if ($search_column['updated_at'] != '' && $search_column['updated_at'] != NULL) {
            $sql->where('m_barang.updated_at', 'LIKE', "%{$search_column['updated_at']}%");
        }

        if ($search_column['user_update'] != '' && $search_column['user_update'] != NULL) {
            $sql->where('user_update.name', 'LIKE', "%{$search_column['user_update']}%");
        }

        $filter_count = $sql->count();
        $filter_data = $sql->offset($startLimit)->limit($limit)->get();

        return ['filter_count' => $filter_count, 'filter_data' => $filter_data];
    }
}
