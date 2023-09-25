<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\AccessGroup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        if (!check_user_access(Session::get('user_access'), 'users_manage')) {
            return redirect('/');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!check_user_access(Session::get('user_access'), 'users_manage')) {
            return redirect('/');
        }

        $data = User::get();
        return view('user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!check_user_access(Session::get('user_access'), 'users_create')) {
            return redirect('/');
        }

        $data['actions'] = 'store';
        $data['access_group'] = AccessGroup::all();
        return view('user.user', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!check_user_access(Session::get('user_access'), 'users_create')) {
            return redirect('/');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|max:255',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->id_access_group = $request->id_access_group;
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!check_user_access(Session::get('user_access'), 'users_read')) {
            return redirect('/');
        }

        $id = base64_decode($id);

        $data['user'] = User::find($id);
        return view('user.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!check_user_access(Session::get('user_access'), 'users_update')) {
            return redirect('/');
        }

        $data['actions'] = 'update';
        $id = base64_decode($id);
        $data['user'] = User::find($id);
        $data['access_group'] = AccessGroup::all();

        return view('user.user', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!check_user_access(Session::get('user_access'), 'users_update')) {
            return redirect('/');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.update', $id)->withErrors($validator);
        }

        $id = base64_decode($id);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->id_access_group = $request->id_access_group;
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function datatable(Request $request)
    {
        $search = $_GET['search']['value'];
        $columns = $request->input('columns');

        $search_column = array(
            "id" => (isset($columns[1]['search']['value'])) ? $columns[1]['search']['value'] : "",
            "name" => (isset($columns[2]['search']['value'])) ? $columns[2]['search']['value'] : "",
            "email" => (isset($columns[3]['search']['value'])) ? $columns[3]['search']['value'] : "",
            "access_group" => (isset($columns[4]['search']['value'])) ? $columns[4]['search']['value'] : "",
            "created_at" => (isset($columns[5]['search']['value'])) ? $columns[5]['search']['value'] : "",
            "updated_at" => (isset($columns[6]['search']['value'])) ? $columns[6]['search']['value'] : "",
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order_index = $_GET['order'][0]['column'];

        if ($order_index == 1)
            $order_field = 'id';
        else if ($order_index == 2)
            $order_field = 'name';
        else if ($order_index == 3)
            $order_field = 'email';
        else if ($order_index == 4)
            $order_field = 'access_group';
        else if ($order_index == 5)
            $order_field = 'created_at';
        else if ($order_index == 6)
            $order_field = 'updated_at';
        else
            $order_field = 'id';

        $order_ascdesc = $_GET['order'][0]['dir'];

        $user = new User();

        $sql_total = $user->count();
        $sql_filter = $user->filter(
            $order_field,
            $order_ascdesc,
            $search,
            $search_column,
            $limit,
            $start
        );

        $filter_count = $sql_filter['filter_count'];
        $filter_data = $sql_filter['filter_data'];

        foreach ($filter_data as $value) {
            $row = array();

            $action = '';
            if (check_user_access(Session::get('user_access'), 'users_update')) {
                $action .= "<a class='btn btn-info btn-sm mr-2' href='" . route('users.edit', base64_encode($value->id)) . "'><i class='fa fa-fw fa-pencil'></i> Edit</a>";
            }
            if (check_user_access(Session::get('user_access'), 'users_read')) {
                $action .= "<a class='btn btn-success btn-sm' href='" . route('users.show', base64_encode($value->id)) . "'><i class='fa fa-fw fa-eye'></i> Detail</a>";
            }


            $row[] = $action;
            $row[] = $value->id;
            $row[] = $value->name;
            $row[] = $value->email;
            $row[] = date_format(Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s');
            $row[] = date_format(Carbon::createFromFormat('Y-m-d H:i:s', $value->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s');
            $row[] = $value->access_group;

            $data[] = $row;
        }

        if ($filter_count == 0) {
            $data = 0;
        }

        $callback = array(
            'draw' => $_GET['draw'],
            'recordsTotal' => $sql_total,
            'recordsFiltered' => $filter_count,
            'data' => $data
        );
        header('Content-Type: application/json');
        return $callback;
    }

    public function changePassword()
    {
        return view('user.password');
    }

    public function savePassword(Request $request)
    {
        $summary = json_decode($request->summary);

        $user_id = Auth::user()->id;
        $user = User::find($user_id);

        if (Hash::check($summary->oldPassword, $user->password)) {
            $user->password = Hash::make($summary->newPassword);
            $user->save();
        } else {
            return redirect()->route('users.changePassword')->with('error', 'Old Password Not Match !');
        }

        return redirect('/');
    }
}
