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
                <div class="card-header">
                    <div class="row mb-2">
                        <div class="col-sm-4">
                            <a href="{{ route('producers.create') }}" class="btn btn-success mb-2">
                                <i class="mdi mdi-plus-circle mr-2"></i>
                                Thêm nhà cung cấp
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="producer_table" class="table table-striped table-centered mb-0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Được tạo lúc</th>
                                <th>Chỉnh sửa</th>
                                @if(checkSuperAdmin())
                                    <th>Xoá</th>
                                @endif
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

            let table = $('#producer_table').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.3/i18n/vi.json',
                },
                processing: true,
                scrollY: '50vh',
                lengthMenu: [[5, 10, 20, -1], [5, 10, 20, "Tất cả"]],
                ajax: '{!! route('producers.api') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'address', name: 'address'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'edit', name: 'edit',
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            return `<a class="btn btn-primary" href="${data}"><i class="mdi mdi-file-edit-outline"></i></i></a>`
                        }
                    },
                        @if(checkSuperAdmin())
                    {
                        data: 'destroy', name: 'delete',
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            return `<form method="post" action="${data}" class="mb-0">
                                    @csrf
                            @method('DELETE')
                            <button class="btn-delete btn btn-danger">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                        </form>`
                        }
                    },
                    @endif
                ]
            });
        });
    </script>
@endpush
