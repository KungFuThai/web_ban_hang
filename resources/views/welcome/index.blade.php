@extends('layout.master')
@push('css')
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 360px;
            max-width: 800px;
            margin: 1em auto;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-right">
                        <i class="mdi mdi-tshirt-v widget-icon bg-success-lighten text-success"></i>
                    </div>
                    <h5 class="text-muted font-weight-normal mt-0" title="Number of Customers">Sản phẩm</h5>
                    <h3 class="mt-3 mb-3">{{ $productCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-right">
                        <i class="mdi mdi-cart-plus widget-icon bg-success-lighten text-success"></i>
                    </div>
                    <h5 class="text-muted font-weight-normal mt-0" title="Number of Customers">Đơn hàng</h5>
                    <h3 class="mt-3 mb-3">{{ $orderCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-right">
                        <i class="mdi mdi-format-list-bulleted widget-icon bg-success-lighten text-success"></i>
                    </div>
                    <h5 class="text-muted font-weight-normal mt-0" title="Number of Customers">Loại sản phẩm</h5>
                    <h3 class="mt-3 mb-3">{{ $categoryCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card widget-flat">
                <div class="card-body">
                    <div class="float-right">
                        <i class="mdi mdi-store widget-icon bg-success-lighten text-success"></i>
                    </div>
                    <h5 class="text-muted font-weight-normal mt-0" title="Number of Customers">Nhà cung cấp</h5>
                    <h3 class="mt-3 mb-3">{{ $producerCount }}</h3>
                </div>
            </div>
        </div>
    </div>
    @if(isSuperAdmin())
        <div class="row">
            <div class="col-lg-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-account-multiple widget-icon bg-success-lighten text-success"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Number of Customers">Khách hàng</h5>
                        <h3 class="mt-3 mb-3">{{ $customerCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card widget-flat">
                    <div class="card-body">
                        <div class="float-right">
                            <i class="mdi mdi-account-multiple widget-icon bg-success-lighten text-success"></i>
                        </div>
                        <h5 class="text-muted font-weight-normal mt-0" title="Number of Customers">Admin</h5>
                        <h3 class="mt-3 mb-3">{{ $adminCount }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card widget-flat">
                <div class="card-body">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                    </figure>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
        $(document).ready(function () {
            $.ajax({
                url: '{{ route('get_revenue') }}',
                type: 'GET',
                dataType: 'json',
                data: {days: 6},
            })
                .done(function (response) {
                    const arrX = (Object.keys(response.data));
                    const arrY = (Object.values(response.data));
                    Highcharts.chart('container', {

                        title: {
                            text: 'Thống kê doanh thu 7 ngày gần nhất',
                            align: 'left'
                        },

                        yAxis: {
                            title: {
                                text: 'Doanh thu'
                            },
                            max: null,
                            min: null,
                        },

                        xAxis: {
                            categories: arrX
                        },

                        legend: {
                            layout: 'vertical',
                            align: 'right',
                            verticalAlign: 'middle'
                        },

                        plotOptions: {
                            series: {
                                label: {
                                    connectorAllowed: false
                                },
                            }
                        },

                        series: [{
                            name: 'Số tiền',
                            data: arrY
                        }],

                        responsive: {
                            rules: [{
                                condition: {
                                    maxWidth: 500
                                },
                                chartOptions: {
                                    legend: {
                                        layout: 'horizontal',
                                        align: 'center',
                                        verticalAlign: 'bottom'
                                    }
                                }
                            }]
                        }

                    });
                });
        });
    </script>
@endpush