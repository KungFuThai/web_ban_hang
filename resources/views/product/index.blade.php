@extends('layout.master');
@push('css')
    <link href="{{ asset('css/vendor/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/vendor/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css">
@endpush
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Hyper</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Products</h4>
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
                                <a href="{{ route('product.create') }}" class="btn btn-danger mb-2">
                                    <i class="mdi mdi-plus-circle mr-2"></i>
                                    Add Product
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-right">
                                    <button type="button" class="btn btn-success mb-2 mr-1"><i
                                            class="mdi mdi-settings"></i></button>
                                    <button type="button" class="btn btn-light mb-2 mr-1">Import</button>
                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                </div>
                            </div><!-- end col-->
                        </div>

                        <div class="table-responsive">
                            <div id="products-datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length" id="products-datatable_length"><label>Display <select
                                                    class="custom-select custom-select-sm ml-1 mr-1">
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="20">20</option>
                                                    <option value="-1">All</option>
                                                </select> products</label></div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="products-datatable_filter" class="dataTables_filter"><label>Search:<input
                                                    type="search" class="form-control form-control-sm" placeholder=""
                                                    aria-controls="products-datatable"></label></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table
                                            class="table table-centered w-100 dt-responsive nowrap dataTable no-footer dtr-inline"
                                            id="products-datatable" role="grid"
                                            aria-describedby="products-datatable_info" style="width: 1526px;">
                                            <thead class="thead-light">
                                                <tr role="row">
                                                    <th class="all dt-checkboxes-cell dt-checkboxes-select-all sorting_disabled"
                                                        style="width: 28.6px;" rowspan="1" colspan="1" data-col="0"
                                                        aria-label="
                                                            
                                                                
                                                                &amp;nbsp;
                                                            
                                                        ">
                                                        <div class="custom-control custom-checkbox"><input type="checkbox"
                                                                class="custom-control-input dt-checkboxes"><label
                                                                class="custom-control-label">&nbsp;</label></div>
                                                    </th>
                                                    <th class="all sorting_asc" tabindex="0"
                                                        aria-controls="products-datatable" rowspan="1" colspan="1"
                                                        style="width: 420.8px;" aria-sort="ascending"
                                                        aria-label="Product: activate to sort column descending">Product
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="products-datatable"
                                                        rowspan="1" colspan="1" style="width: 177.8px;"
                                                        aria-label="Category: activate to sort column ascending">Category
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="products-datatable"
                                                        rowspan="1" colspan="1" style="width: 160.8px;"
                                                        aria-label="Added Date: activate to sort column ascending">Added
                                                        Date</th>
                                                    <th class="sorting" tabindex="0" aria-controls="products-datatable"
                                                        rowspan="1" colspan="1" style="width: 95.8px;"
                                                        aria-label="Price: activate to sort column ascending">Price</th>
                                                    <th class="sorting" tabindex="0" aria-controls="products-datatable"
                                                        rowspan="1" colspan="1" style="width: 124.8px;"
                                                        aria-label="Quantity: activate to sort column ascending">Quantity
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="products-datatable"
                                                        rowspan="1" colspan="1" style="width: 99.8px;"
                                                        aria-label="Status: activate to sort column ascending">Status</th>
                                                    <th style="width: 85.6px;" class="sorting_disabled" rowspan="1"
                                                        colspan="1" aria-label="Action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr role="row" class="odd">
                                                    <td class="dt-checkboxes-cell" tabindex="0">
                                                        <div class="custom-control custom-checkbox"><input type="checkbox"
                                                                class="custom-control-input dt-checkboxes"><label
                                                                class="custom-control-label">&nbsp;</label></div>
                                                    </td>
                                                    <td class="sorting_1">
                                                        <img src="assets/images/products/product-6.jpg" alt="contact-img"
                                                            title="contact-img" class="rounded mr-3" height="48">
                                                        <p class="m-0 d-inline-block align-middle font-16">
                                                            <a href="apps-ecommerce-products-details.html"
                                                                class="text-body">Adirondack Chair</a>
                                                            <br>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        Aeron Chairs
                                                    </td>
                                                    <td>
                                                        07/07/2018
                                                    </td>
                                                    <td>
                                                        $65.94
                                                    </td>

                                                    <td>
                                                        652
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-success">Active</span>
                                                    </td>

                                                    <td class="table-action">
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-eye"></i></a>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="even">
                                                    <td tabindex="0" class="dt-checkboxes-cell">
                                                        <div class="custom-control custom-checkbox"><input type="checkbox"
                                                                class="custom-control-input dt-checkboxes"><label
                                                                class="custom-control-label">&nbsp;</label></div>
                                                    </td>
                                                    <td class="sorting_1">
                                                        <img src="assets/images/products/product-1.jpg" alt="contact-img"
                                                            title="contact-img" class="rounded mr-3" height="48">
                                                        <p class="m-0 d-inline-block align-middle font-16">
                                                            <a href="apps-ecommerce-products-details.html"
                                                                class="text-body">Amazing Modern Chair</a>
                                                            <br>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        Aeron Chairs
                                                    </td>
                                                    <td>
                                                        09/12/2018
                                                    </td>
                                                    <td>
                                                        $148.66
                                                    </td>

                                                    <td>
                                                        254
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-success">Active</span>
                                                    </td>

                                                    <td class="table-action">
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-eye"></i></a>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td class="dt-checkboxes-cell" tabindex="0">
                                                        <div class="custom-control custom-checkbox"><input type="checkbox"
                                                                class="custom-control-input dt-checkboxes"><label
                                                                class="custom-control-label">&nbsp;</label></div>
                                                    </td>
                                                    <td class="sorting_1">
                                                        <img src="assets/images/products/product-2.jpg" alt="contact-img"
                                                            title="contact-img" class="rounded mr-3" height="48">
                                                        <p class="m-0 d-inline-block align-middle font-16">
                                                            <a href="apps-ecommerce-products-details.html"
                                                                class="text-body">Bean Bag Chair</a>
                                                            <br>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        Wooden Chairs
                                                    </td>
                                                    <td>
                                                        06/30/2018
                                                    </td>
                                                    <td>
                                                        $99
                                                    </td>

                                                    <td>
                                                        1,021
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-danger">Deactive</span>
                                                    </td>
                                                    <td class="table-action">
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-eye"></i></a>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="even">
                                                    <td tabindex="0" class="dt-checkboxes-cell">
                                                        <div class="custom-control custom-checkbox"><input type="checkbox"
                                                                class="custom-control-input dt-checkboxes"><label
                                                                class="custom-control-label">&nbsp;</label></div>
                                                    </td>
                                                    <td class="sorting_1">
                                                        <img src="assets/images/products/product-4.jpg" alt="contact-img"
                                                            title="contact-img" class="rounded mr-3" height="48">
                                                        <p class="m-0 d-inline-block align-middle font-16">
                                                            <a href="apps-ecommerce-products-details.html"
                                                                class="text-body">Biblio Plastic Armchair</a>
                                                            <br>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star-half"></span>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        Wooden Chairs
                                                    </td>
                                                    <td>
                                                        09/08/2018
                                                    </td>
                                                    <td>
                                                        $8.99
                                                    </td>

                                                    <td>
                                                        1,874
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-success">Active</span>
                                                    </td>
                                                    <td class="table-action">
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-eye"></i></a>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>
                                                <tr role="row" class="odd">
                                                    <td class="dt-checkboxes-cell" tabindex="0">
                                                        <div class="custom-control custom-checkbox"><input type="checkbox"
                                                                class="custom-control-input dt-checkboxes"><label
                                                                class="custom-control-label">&nbsp;</label></div>
                                                    </td>
                                                    <td class="sorting_1">
                                                        <img src="assets/images/products/product-3.jpg" alt="contact-img"
                                                            title="contact-img" class="rounded mr-3" height="48">
                                                        <p class="m-0 d-inline-block align-middle font-16">
                                                            <a href="apps-ecommerce-products-details.html"
                                                                class="text-body">Bootecos Plastic Armchair</a>
                                                            <br>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star"></span>
                                                            <span class="text-warning mdi mdi-star-half"></span>
                                                        </p>
                                                    </td>
                                                    <td>
                                                        Wing Chairs
                                                    </td>
                                                    <td>
                                                        07/15/2018
                                                    </td>
                                                    <td>
                                                        $148.66
                                                    </td>

                                                    <td>
                                                        485
                                                    </td>
                                                    <td>
                                                        <span class="badge badge-danger">Deactive</span>
                                                    </td>

                                                    <td class="table-action">
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-eye"></i></a>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-square-edit-outline"></i></a>
                                                        <a href="javascript:void(0);" class="action-icon"> <i
                                                                class="mdi mdi-delete"></i></a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="products-datatable_info" role="status"
                                            aria-live="polite">Showing products 1 to 5 of 12</div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                            id="products-datatable_paginate">
                                            <ul class="pagination pagination-rounded">
                                                <li class="paginate_button page-item previous disabled"
                                                    id="products-datatable_previous"><a href="#"
                                                        aria-controls="products-datatable" data-dt-idx="0" tabindex="0"
                                                        class="page-link"><i class="mdi mdi-chevron-left"></i></a></li>
                                                <li class="paginate_button page-item active"><a href="#"
                                                        aria-controls="products-datatable" data-dt-idx="1" tabindex="0"
                                                        class="page-link">1</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="products-datatable" data-dt-idx="2" tabindex="0"
                                                        class="page-link">2</a></li>
                                                <li class="paginate_button page-item "><a href="#"
                                                        aria-controls="products-datatable" data-dt-idx="3" tabindex="0"
                                                        class="page-link">3</a></li>
                                                <li class="paginate_button page-item next" id="products-datatable_next"><a
                                                        href="#" aria-controls="products-datatable" data-dt-idx="4"
                                                        tabindex="0" class="page-link"><i
                                                            class="mdi mdi-chevron-right"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div>
@endsection
@push('js')
    <script src="{{ asset('js/vendor/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/vendor/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/vendor/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/vendor/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/vendor/dataTables.checkboxes.min.js') }}"></script>
@endpush
