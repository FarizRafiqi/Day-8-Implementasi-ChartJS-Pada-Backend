<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\MOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function __construct()
    {
        if (!check_user_access(Session::get('user_access'), 'order_manage')) {
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
        if (!check_user_access(Session::get('user_access'), 'order_manage')) {
            return redirect('/');
        }

        $data = DB::table('beli_order')->get();
        return view('order.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!check_user_access(Session::get('user_access'), 'order_create')) {
            return redirect('/');
        }

        $data['actions'] = 'store';
        return view('order.order', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!check_user_access(Session::get('user_access'), 'order_create')) {
            return redirect('/');
        }

        $order = new MOrder();
        $order->created_id = Auth::user()->id;
        $order->updated_id = Auth::user()->id;
        $order->no_faktur = $request->no_faktur;
        $order->id_m_vendor = $request->id_m_vendor;
        $order->id_user_verifikasi = $request->id_user_verifikasi;
        $order->jumlah = $request->jumlah;
        $order->ppn_percent = $request->ppn_percent;
        $order->pp_nominal = $request->pp_nominal;
        $order->total = $request->total;
        $order->status = $request->status;
        $order->tanggal = $request->tanggal;
        $order->tanggal_dibutuhkan = $request->tanggal_dibutuhkan;

        $order->save();

        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!check_user_access(Session::get('user_access'), 'order_read')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['beli_order'] = MOrder::find($id);
        return view('order.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!check_user_access(Session::get('user_access'), 'order_update')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['actions'] = 'update';
        $data['beli_order'] = MOrder::find($id);
        return view('order.order', compact('data'));
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
        if (!check_user_access(Session::get('user_access'), 'order_update')) {
            return redirect('/');
        }

        $id = base64_decode($id);

        $order = MOrder::find($id);
        $order->created_id = Auth::user()->id;
        $order->updated_id = Auth::user()->id;
        $order->no_faktur = $request->no_faktur;
        $order->id_m_vendor = $request->id_m_vendor;
        $order->id_user_verifikasi = $request->id_user_verifikasi;
        $order->jumlah = $request->jumlah;
        $order->ppn_percent = $request->ppn_percent;
        $order->pp_nominal = $request->pp_nominal;
        $order->total = $request->total;
        $order->status = $request->status;
        $order->tanggal = $request->tanggal;
        $order->tanggal_dibutuhkan = $request->tanggal_dibutuhkan;

        $order->save();

        return redirect()->route('order.index');
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
            "tanggal" => (isset($columns[2]['search']['value'])) ? $columns[2]['search']['value'] : "",
            "tanggal_dibutuhkan" => (isset($columns[3]['search']['value'])) ? $columns[3]['search']['value'] : "",
            "no_faktur" => (isset($columns[4]['search']['value'])) ? $columns[4]['search']['value'] : "",
            "id_m_vendor" => (isset($columns[5]['search']['value'])) ? $columns[5]['search']['value'] : "",
            "id_user_verifikasi" => (isset($columns[6]['search']['value'])) ? $columns[6]['search']['value'] : "",
            "jumlah" => (isset($columns[7]['search']['value'])) ? $columns[7]['search']['value'] : "",
            "ppn_percent" => (isset($columns[8]['search']['value'])) ? $columns[8]['search']['value'] : "",
            "pp_nominal" => (isset($columns[9]['search']['value'])) ? $columns[9]['search']['value'] : "",
            "total" => (isset($columns[10]['search']['value'])) ? $columns[10]['search']['value'] : "",
            "status" => (isset($columns[11]['search']['value'])) ? $columns[11]['search']['value'] : "",
            "created_at" => (isset($columns[12]['search']['value'])) ? $columns[12]['search']['value'] : "",
            "user_create" => (isset($columns[13]['search']['value'])) ? $columns[13]['search']['value'] : "",
            "updated_at" => (isset($columns[14]['search']['value'])) ? $columns[14]['search']['value'] : "",
            "user_update" => (isset($columns[15]['search']['value'])) ? $columns[15]['search']['value'] : "",
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order_index = $_GET['order'][0]['column'];
        if ($order_index == 1)
            $order_field = 'id';
        else if ($order_index == 2)
            $order_field = 'tanggal';
        else if ($order_index == 3)
            $order_field = 'tanggal_dibutuhkan';
        else if ($order_index == 4)
            $order_field = 'no_faktur';
        else if ($order_index == 5)
            $order_field = 'id_m_vendor';
        else if ($order_index == 6)
            $order_field = 'id_user_verifikasi';
        else if ($order_index == 7)
            $order_field = 'jumlah';
        else if ($order_index == 8)
            $order_field = 'ppn_percent';
        else if ($order_index == 9)
            $order_field = 'pp_nominal';
        else if ($order_index == 10)
            $order_field = 'total';
        else if ($order_index == 11)
            $order_field = 'status';
        else if ($order_index == 12)
            $order_field = 'created_at';
        else if ($order_index == 13)
            $order_field = 'user_create_name';
        else if ($order_index == 14)
            $order_field = 'updated_at';
        else if ($order_index == 15)
            $order_field = 'user_update_name';
        else
            $order_field = 'id';

        $order_ascdesc = $_GET['order'][0]['dir'];

        $order = new MOrder();

        $sql_total = $order->count();
        $sql_filter = $order->filter(
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
            if (check_user_access(Session::get('user_access'), 'minta_update')) {
                $action .= "<a class='btn btn-info btn-sm mr-2' href='" . route('minta.edit', base64_encode($value->id)) . "'><i class='fa fa-fw fa-pencil'></i> Edit</a>";
            }
            if (check_user_access(Session::get('user_access'), 'minta_read')) {
                $action .= "<a class='btn btn-success btn-sm mt-2' href='" . route('minta.show', base64_encode($value->id)) . "'><i class='fa fa-fw fa-eye'></i> Detail</a>";
            }

            $row[] = $action;
            $row[] = $value->id;
            $row[] = $value->tanggal;
            $row[] = $value->tanggal_dibutuhkan;
            $row[] = $value->no_faktur;
            $row[] = $value->id_m_vendor;
            $row[] = $value->id_user_verifikasi;
            $row[] = $value->jumlah;
            $row[] = $value->ppn_percent;
            $row[] = $value->pp_nominal;
            $row[] = $value->total;
            $row[] = date_format(Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s');
            $row[] = $value->user_create_name;
            $row[] = date_format(Carbon::createFromFormat('Y-m-d H:i:s', $value->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s');
            $row[] = $value->user_update_name;

            if ($value->status == 1) {
                $row[] = 'Aktif';
            } else {
                $row[] = 'Tidak Aktif';
            }

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
}
