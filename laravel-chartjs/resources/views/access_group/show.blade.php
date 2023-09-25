@extends('layouts.app')
@section('title', 'Access Group Detail')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="panel-body" id="toro-area">
                <div class="content">
                    <div class="header"><h3>General</h3></div>
                </div>
                <div class="content">
                    <div class="description">
                        <p><b>Nama : </b> {{ $data['access_group']->nama }}</p>
                        <p><b>Keterangan : </b>
                            <?php echo $data['access_group']->keterangan ?? '-' ?>
                        </p>
                        <p><b>Created At : </b> {{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                        $data['access_group']->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</p>
                        <p><b>Created By : </b> {{ $data['access_group']->user_create->name }}</p>
                        <p><b>Updated At : </b> {{date_format(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',
                        $data['access_group']->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s')}}</p>
                        <p><b>Updated By : </b> {{ $data['access_group']->user_update->name }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('header_scripts')
    <link href="{{ asset ('semantic/components/icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('semantic/components/statistic.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('semantic/components/card.css') }}" rel="stylesheet">
    <link href="{{ asset ('js/data-table/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('js/data-table/buttons/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('js/data-table/colreorder/colReorder.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('js/data-table/keytable/keyTable.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('js/data-table/fixedheader/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('js/data-table/fixedcolumns/fixedColumns.bootstrap.min.css') }}" rel="stylesheet">

    <script src="{{ asset ('js/data-table/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset ('js/data-table/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset ('js/data-table/buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset ('js/data-table/buttons/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset ('js/data-table/buttons/buttons.flash.min.js') }}"></script>
    <script src="{{ asset ('js/data-table/buttons/jszip.min.js') }}"></script>
    <script src="{{ asset ('js/data-table/buttons/pdfmake.min.js') }}"></script>
    <script src="{{ asset ('js/data-table/buttons/vfs_fonts.js') }}"></script>
    <script src="{{ asset ('js/data-table/buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset ('js/data-table/buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset ('js/data-table/buttons/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset ('js/data-table/colreorder/dataTables.colReorder.min.js') }}"></script>
    <script src="{{ asset ('js/data-table/keytable/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset ('js/data-table/fixedheader/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset ('js/data-table/fixedcolumns/dataTables.fixedColumns.min.js') }}"></script>
@endpush

@push('scripts')
    <script type="text/javascript">
        function datatable(btnBarElement, tableElement, footElement, data, column) {
            $(footElement).each(function () {
                const title = $(this).text();
                $(this).html('<input type="text" class="form-control" name="search_tabel" placeholder="Search ' + title + '" />');
            });

            tabel = $(tableElement).DataTable({
                "responsive": true,
                "ordering": true,
                "data": data,
                "columns": column,
                "PaginationType": "bootstrap",
            });

            new $.fn.dataTable.Buttons(tabel, {
                buttons: [{
                    extend: 'copyHtml5',
                    exportOptions: {
                        columns: [':visible']
                    }
                }, {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: [':visible']
                    }
                }, {
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [':visible']
                    }
                }, {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: [':visible']
                    }
                }, {
                    extend: 'print',
                    exportOptions: {
                        columns: [':visible']
                    }
                }, 'colvis']
            });

            tabel.buttons().container().appendTo($(btnBarElement));

            tabel.columns().every(function () {
                var that = this;
                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });
        }

        $(document).ready(function () {
            datatable('#btnbar', '#toro-data', '#toro-data tfoot th', <?= $data['access_group']->access_masters ?>, [{data: 'id'}, {data: 'nama'}, {data: 'keterangan'}, {
                data: 'id',
                render: function (value) {
                    return "<a class='btn btn-success btn-xl' href='<?= url('access_masters') . '/' ?>" + btoa(value) + "'><i class='fa fa-fw fa-eye'></i> Detail</a>";
                }
            }]);
            datatable('#btnbar2', '#toro-data2', '#toro-data2 tfoot th', <?= $data['access_group']->users ?>, [{data: 'id'}, {data: 'name'}, {data: 'email'}, {
                data: 'id',
                render: function (value) {
                    return "<a class='btn btn-success btn-xl' href='<?= url('users') . '/' ?>" + btoa(value) + "'><i class='fa fa-fw fa-eye'></i> Detail</a>";
                }
            }]);
        });
    </script>
@endpush
