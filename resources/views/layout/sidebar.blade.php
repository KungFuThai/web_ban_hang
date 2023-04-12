<div class="left-side-menu mm-show">

    <a href="{{ route('welcome') }}" class="logo text-center logo-light font-weight-bold font-16" style="color: #596473">
        {{ config('app.name') }}
    </a>

    <div class="h-100 mm-active" id="left-side-menu-container" data-simplebar="init">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-height-auto-observer-wrapper">
                <div class="simplebar-height-auto-observer"></div>
            </div>
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden;">
                        <div class="simplebar-content" style="padding: 0px;">

                            <!--- Sidemenu -->
                            <ul class="metismenu side-nav mm-show">

                                <li class="side-nav-title side-nav-item">Menu</li>

                                <li class="side-nav-item">
                                    <a href="{{ route('welcome') }}" class="side-nav-link" aria-expanded="false">
                                        <i class="uil-home-alt"></i>
                                        <span> Dashboards </span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="{{ route('orders.index') }}" class="side-nav-link">
                                        <i class="mdi mdi-cart-plus"></i>
                                        <span> Đơn hàng </span>
                                    </a>
                                </li>
                                @if(isSuperAdmin())
                                <li class="side-nav-item">
                                    <a href="{{ route('customers.index') }}" class="side-nav-link">
                                        <i class="dripicons-user"></i>
                                        <span>Khách hàng</span>
                                    </a>
                                </li>
                                @endif
                                <li class="side-nav-item">
                                    <a href="{{ route('products.index') }}" class="side-nav-link">
                                        <i class="mdi mdi-tshirt-v"></i>
                                        <span>Sản phẩm</span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="{{ route('categories.index') }}" class="side-nav-link">
                                        <i class="dripicons-list"></i>
                                        <span>Loại sản phẩm</span>
                                    </a>
                                </li>
                                <li class="side-nav-item">
                                    <a href="{{ route('producers.index') }}" class="side-nav-link">
                                        <i class="dripicons-store"></i>
                                        <span>Nhà cung cấp</span>
                                    </a>
                                </li>
                                @if(isSuperAdmin())
                                    <li class="side-nav-item">
                                        <a href="{{ route('admins.index') }}" class="side-nav-link">
                                            <i class="mdi mdi-account-supervisor"></i>
                                            <span>Admin</span>
                                        </a>
                                    </li>
                                    <li class="side-nav-item">
                                        <a href="{{ route('activities.index') }}" class="side-nav-link">
                                            <i class="mdi mdi-history"></i>
                                            <span>Hoạt động</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>

                            <!-- Help Box -->

                            <!-- end Help Box -->
                            <!-- End Sidebar -->

                            <div class="clearfix"></div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="simplebar-placeholder" style="width: auto; height: 100px;"></div>
        </div>
        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
        </div>
        <div class="simplebar-track simplebar-vertical" style="visibility: hidden;">
            <div class="simplebar-scrollbar"
                 style="height: 0px; transform: translate3d(0px, 0px, 0px); display: none;"></div>
        </div>
    </div>
    <!-- Sidebar -left -->

</div>

