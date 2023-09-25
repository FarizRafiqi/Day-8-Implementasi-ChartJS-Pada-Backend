<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccessGroup extends Model
{
    public $table = 'access_group';
    public function user_create()
    {
        return $this->belongsTo('App\Models\User', 'created_id', 'id');
    }

    public function user_update()
    {
        return $this->belongsTo('App\Models\User', 'updated_id', 'id');
    }

    public function access_masters()
    {
        return $this->belongsToMany('App\Models\AccessMaster', 'access_group_detail', 'id_access_group', 'id_access_master')->withPivot('priority');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'id_access_group', 'id');
    }
    public function filter($order_field, $order_ascdesc, $search, $search_column, $limit, $startLimit)
    {
        $sql = AccessGroup::select('access_group.*', 'user_create.name as user_create_name', 'user_update.name as user_update_name')
        ->join('users as user_create', 'user_create.id', 'access_group.created_id')
        ->join('users as user_update', 'user_update.id', 'access_group.updated_id')
        ->orderBy($order_field, $order_ascdesc);

        if ($search != '' && $search != NULL) {
            $sql->where('access_group.id', 'LIKE', "%{$search}%")
            ->orWhere('access_group.nama', 'LIKE', "%{$search}%")
            ->orWhere('access_group.keterangan', 'LIKE', "%{$search}%")
            ->orWhere('access_group.access_detail', 'LIKE', "%{$search}%")
            ->orWhere('access_group.created_at', 'LIKE', "%{$search}%")
            ->orWhere('user_create.name', 'LIKE', "%{$search}%")
            ->orWhere('access_group.updated_at', 'LIKE', "%{$search}%")
            ->orWhere('user_update.name', 'LIKE', "%{$search}%");
        }

        if ($search_column['id'] != '' && $search_column['id'] != NULL) {
            $sql->where('access_group.id', 'LIKE', "%{$search_column['id']}%");
        }
        if ($search_column['nama'] != '' && $search_column['nama'] != NULL) {
            $sql->where('access_group.nama', 'LIKE', "%{$search_column['nama']}%");
        }
        if ($search_column['keterangan'] != '' && $search_column['keterangan'] != NULL) {
            $sql->where('access_group.keterangan', 'LIKE', "%{$search_column['keterangan']}%");
        }
        if ($search_column['access_detail'] != '' && $search_column['access_detail'] != NULL) {
            $sql->where('access_group.access_detail', 'LIKE', "%{$search_column['access_detail']}%");
        }
        if ($search_column['created_at'] != '' && $search_column['created_at'] != NULL) {
            $sql->where('access_group.created_at', 'LIKE', "%{$search_column['created_at']}%");
        }
        if ($search_column['user_create'] != '' && $search_column['user_create'] != NULL) {
            $sql->where('user_create.name', 'LIKE', "%{$search_column['user_create']}%");
        }
        if ($search_column['updated_at'] != '' && $search_column['updated_at'] != NULL) {
            $sql->where('access_group.updated_at', 'LIKE', "%{$search_column['updated_at']}%");
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
