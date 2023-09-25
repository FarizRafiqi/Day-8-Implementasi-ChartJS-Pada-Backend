<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

if (!function_exists('check_user_access')) {
	function check_user_access($access_list, $access, $separator = ";;")
	{
		$user_access = explode($separator, $access_list);
		return in_array($access, $user_access);
	}
}

if ( ! function_exists('get_data'))
{
    function get_data($table, $where='id', $id, $return)
    {
		$res = DB::table($table)->where($where, $id)->first();
		return $res->{$return};
    }
}

