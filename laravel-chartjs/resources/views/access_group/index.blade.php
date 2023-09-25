@extends('layouts.app')
@section('title', 'Access Group')
@section('content')
    <div class="row top_tiles">
        <div class="wrapper">
            <div class="row" id="row-report">
                <div class="col-md-12">
                    <section class="panel">
                        <h4 class="panel-heading">
                            Daftar Access Group
                        </h4>
                        <div class="panel-body" id="toro-area">
                            @can('access', 'access_group_create')
                                <a class="btn btn-info" href="{{ route('access_groups.create') }}">Tambah Access
                                    Group</a>
                            @endcan
                            <div id="btnbar" style="float: right; margin-bottom: 10px"></div>
                            <table id="toro-data" class="table table-hover table-bordered convert-data-table display">
                                <thead>
                                <tr>
                                    <th>Actions</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Keterangan</th>
                                    <th>Access Detail</th>
                                    <th>Created At</th>
                                    <th>Created By</th>
                                    <th>Updated At</th>
                                    <th>Updated By</th>
                                </tr>

                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Actions</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Keterangan</th>
                                    <th>Access Detail</th>
                                    <th>Created At</th>
                                    <th>Created By</th>
                                    <th>Updated At</th>
                                    <th>Updated By</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        let tabel = null;

        function generateTable() {
            tabel.ajax.reload();
        }

        $(document).ready(function () {
            $('#toro-data tfoot th').each(function () {
                const title = $(this).text();
                $(this).html('<input type="text" class="form-control" name="search_tabel" placeholder="Search ' + title + '" />');
            });

            tabel = $('#toro-data').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "ordering": true,
                "order": [
                    [0, 'asc']
                ],
                "ajax": {
                    "url": "{{ route('access_groups.datatable') }}",
                    "type": "GET",
                },
                "deferRender": true,
                "columnDefs": [{
                    "targets": [0],
                    "searchable": true,
                    "sortable": true
                },
                    {
                        "targets": [1],
                        "searchable": true,
                        "sortable": true
                    },
                    {
                        "targets": [2],
                        "searchable": true,
                        "sortable": true
                    }
                ],
                "PaginationType": "bootstrap",
                "lengthMenu": [
                    [10, 25, 50, 100, 200, 300],
                    [10, 25, 50, 100, 200, 300]
                ],
                colReorder: true,
                keys: true,
                fixedHeader: true,
                scrollX: true,
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

            tabel.buttons().container().appendTo($('#btnbar'));

            tabel.columns().every(function () {
                const that = this;
                $('input', this.footer()).on('keyup change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });
        });
    </script>
@endpush
