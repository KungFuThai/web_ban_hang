@extends('layout.master');
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="{{ route('admins.create') }}" class="btn btn-success mb-2">
                                    <i class="mdi mdi-plus-circle mr-2"></i>
                                    Thêm nhân viên
                                </a>
                            </div>
                        </div>
                        <form class="form-inline float-right" id="form-filter">
                            <div class="form-group">
                                <label for="phone" class="col-sm-2 control-label">Phone</label>
                                <div class="col-3">
                                    <select class="form-control select-filter" id="phone" name="phone">
                                        <option selected>All</option>
                                        @foreach ($phones as $phone)
                                            <option @if ($phone === $selectedPhone) selected @endif>
                                                {{ $phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" style="height:auto !important;">
                            <table class="table table-striped table-centered mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Thông tin</th>
                                        <th>Vai trò</th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                @foreach ($admins as $each)
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $each->id }}
                                            </td>
                                            <td>
                                                {{ $each->full_name }} - {{ $each->gender_name }}
                                                <br>
                                                <a href="mailto:{{ $each->email }}">
                                                    {{ $each->email }}
                                                </a>
                                                <br>
                                                <a href="tel:{{ $each->phone }}">
                                                    {{ $each->phone }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $each->role_name }}
                                            </td>
                                            <td>
                                                <div class="form-inline justify-content-center">
                                                    {{--                                                <a href="{{ route('admins.show', $each) }}" class="btn btn-info"> --}}
                                                    {{--                                                    <i class="mdi mdi-account-card-details"></i> --}}
                                                    {{--                                                </a> --}}
                                                    &nbsp;
                                                    <a class="btn btn-primary" href="{{ route('admins.edit', $each) }}">
                                                        <i class="mdi mdi-file-edit-outline"></i>
                                                    </a>
                                                    &nbsp;@if (isSuperAdmin())
                                                        <form method="post" action="{{ route('admins.destroy', $each) }}"
                                                            class="mb-0">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn-delete btn btn-danger">
                                                                <i class="mdi mdi-delete"></i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <nav>
                                <ul class="pagination justify-content-center mb-0">
                                    {{ $admins->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        jQuery(document).ready(function($) {
            $(".select-filter").change(function($event) {
                $("#form-filter").submit();
            })
        });
    </script>
@endpush
