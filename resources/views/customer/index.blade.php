@extends('layout.master');
@push('css')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.css"/>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="{{ asset('css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="customer_table" class="table table-striped table-centered mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Info</th>
                                    <th>Age</th>
                                    <th>Created At</th>
                                    @if(checkSuperAdmin())
                                        <th>Delete</th>
                                    @endif
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
            let table = $('#customer_table').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.3/i18n/vi.json',
                },
                processing: true,
                scrollY: '50vh',
                lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Tất cả"]],
                ajax: '{!! route('customers.api') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data: 'avatar',
                        target: 1,
                        orderable: false,
                        searchable: false,
                        selectable: false,
                        render: function (data) {
                            if (!data) {
                                return '';
                            }
                            return `<img width="50px" src="{{ asset('storage/${data}') }}">`;
                        }
                    },
                    {data: 'name', name: 'name',},
                    {data: 'gender', name: 'gender'},
                    {data: 'info', name: 'info'},
                    {data: 'age', name: 'age'},
                    {data: 'created_at', name: 'created_at'},
                    @if(checkSuperAdmin())
                    {
                        data: 'destroy', name: 'delete',
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            return `<form method="post" action="${data}" class="mb-0">
                                    @csrf
                            @method('DELETE')
                            <button class="btn-delete btn btn-danger"><i class="mdi mdi-delete"></i></button>
                        </form>`
                        }
                    },
                    @endif
                ]
            });
        });
    </script>
@endpush