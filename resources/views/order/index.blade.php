@extends('layout.master');
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form class="form-inline" id="form-filter">
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Trạng thái</label>
                                <div class="col-3">
                                    <select class="form-control" id="select-filter" name="status">
                                        <option selected>All</option>
                                        @foreach($statuses as $status => $value)
                                            <option value="{{ $value }}"
                                                    @if( (string)$value === (string)$selectedStatus ) selected @endif
                                            >
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="order_table" class="table table-striped table-centered mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Đặt bởi</th>
                                    <th>Thông tin người nhận</th>
                                    <th>Tổng tiền</th>
                                    <th>Thời gian đặt</th>
                                    <th>Trạng thái</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                                </thead>
                                @foreach ($data as $each)
                                    <tbody>
                                    <tr>
                                        <td>{{ $each->id }}</td>
                                        <td>
                                            {{ $each->customer->last_name . ' ' . $each->customer->first_name}}
                                            <br>
                                            <a href="tel:{{ $each->customer->phone }}">
                                                {{ $each->customer->phone }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $each->name_receiver }}
                                            <br>
                                            <a href="tel:{{ $each->phone_receiver }}">
                                                {{ $each->phone_receiver }}
                                            </a>
                                            <br>
                                            {{ $each->address_receiver }}
                                        </td>
                                        <td>
                                            <small>₫</small>
                                            {{ $each->total_price }}
                                        </td>
                                        <td>{{ $each->time_created_at }}</td>
                                        <td>
                                            {{--                                            @if ($each->status === 1)--}}
                                            {{--                                                Chờ duyệt--}}
                                            {{--                                            @elseif($each->status === 2)--}}
                                            {{--                                                Đã duyệt--}}
                                            {{--                                            @else--}}
                                            {{--                                                Đã huỷ--}}
                                            {{--                                            @endif--}}
                                            @switch($each->status)
                                                @case(1)
                                                Chờ duyệt
                                                @break

                                                @case(2)
                                                Đã duyệt
                                                @break

                                                @case(3)
                                                Đã huỷ
                                                @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="form-inline justify-content-center">
                                                <a href="{{ route('orders.show', $each) }}" class="btn btn-info">
                                                    <i class="mdi mdi-eye-settings-outline"></i>
                                                </a>
                                                &nbsp;
                                                @if($each->status === 1 || $each->status === 3)
                                                    <form method="post" action="{{ route("orders.update", $each) }}"
                                                          class="mb-0">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="2">
                                                        <button class="btn-delete btn btn-success"><i
                                                                    class="mdi mdi-truck-check-outline"></i></button>
                                                    </form>
                                                @endif
                                                &nbsp;
                                                @if($each->status === 1 || $each->status === 2)
                                                    <form method="post" action="{{ route("orders.update", $each) }}"
                                                          class="mb-0">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="3">
                                                        <button class="btn-delete btn btn-danger"><i
                                                                    class="mdi mdi-cancel"></i></button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                            <nav>
                                <ul class="pagination justify-content-center mb-0">
                                    {{ $data->links() }}
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
        $(document).ready(function ($) {
            $("#select-filter").change(function ($event) {
                $("#form-filter").submit();
            })
        });
    </script>
@endpush