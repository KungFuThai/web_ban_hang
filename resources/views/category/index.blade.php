@extends('layout.master');
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="page-title">{{ $title }}</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="{{ route('categories.create') }}" class="btn btn-danger mb-2">
                                    <i class="mdi mdi-plus-circle mr-2"></i>
                                    Add Category
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table id="category_table" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Producer</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
@push('js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/date-1.1.2/fc-4.1.0/fh-3.2.4/r-2.3.0/rg-1.2.0/sc-2.0.7/sb-1.3.4/sl-1.4.0/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function() {

            let table = $('#category_table').DataTable({
                processing: true,
                serverSide: true,
                scrollY: 400,
                lengthMenu: [5, 10, 20, 'All'],
                ajax: '{!! route('categories.api') !!}',
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'producer', name: 'producer' },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'edit', name: 'edit',
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            return `<a class="btn btn-primary" href="${data}">Edit</a>`
                        }
                    },
                    {
                        data: 'destroy', name: 'delete',
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            return `<form method="post" action="${data}">
                                    @csrf
                            @method('DELETE')
                            <button type="button" class="btn-delete btn btn-danger">Delete</button>
                        </form>`
                        }
                    },
                ]
            });
            $(document).on('click','.btn-delete',function() {
                let form = $(this).parents('form');
                $.ajax({
                    url: form.attr('action'), //gọi tới URL của form
                    type: 'POST',
                    dataType: 'json',
                    data: form.serialize(),
                    success: (function() {
                        console.log("Success");
                        table.draw();
                    }),
                    error: (function() {
                        console.log("error");
                    }),
                });
            });
        });
    </script>
@endpush
