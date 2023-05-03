@extends('layout.master');
@push('css')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="activity_table" class="table table-striped table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên hành động</th>
                                <th>Người thực hiện</th>
                                <th>Mã đơn hàng</th>
                                <th>Thời gian thực hiện</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function () {

            let table = $('#activity_table').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.3/i18n/vi.json',
                },
                processing: true,
                order: [[ 0, 'desc' ]],
                lengthMenu: [[10, 20, -1], [10, 20, "Tất cả"]],
                ajax: '{!! route('activities.api') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: 'activity_name',
                        target: 2,
                        render: function (data, type, row, meta) {
                            if (data === 'ACCEPT') {
                                return 'Duyệt đơn';
                            }
                            return `Huỷ đơn`;
                        }
                    },
                    {data: 'admin_name', name: 'admin_name'},
                    {data: 'order_id', name: 'order_id'},
                    {data: 'created_at', name: 'created_at'},
                ]
            });
        });
    </script>
@endpush