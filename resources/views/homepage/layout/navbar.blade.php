<nav class="navbar navbar-default navbar-fixed-top navbar-color-on-scroll navbar-transparent" color-on-scroll="100"
     id="sectionsNav">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('customer.index') }}">{{ config('app.name') }}</a>
        </div>

        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <form class="navbar-form navbar-right" role="search" action="{{ route('customer.index') }}" style="position: relative">
                        <div class="form-group form-white is-empty">
                            <input type="text" class="form-control typeahead" id="search" placeholder="Search" name="q"
                                   value="{{ $q ?? ''}}">
                            <span class="material-input"></span>
                        </div>
                        <button type="submit" class="btn btn-info btn-raised btn-fab btn-fab-mini">
                            <i class="material-icons">search</i>
                        </button>
                        <div style="height: 200px; width: 300px; overflow-y: auto; position: absolute; float: none;" id="search_list"></div>
                    </form>
                </li>
                <li class="button-container">
                    <a href="{{ route('customer.cart.index') }}"
                       class="btn btn-info btn-round">
                        <i class="material-icons">shopping_cart</i>
                        Giỏ Hàng
                    </a>
                </li>
                <li class="dropdown">
                    <a class="profile-photo dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        @if(isCustomer())
                            @if(session('customer.avatar') === null)
                                <div class="profile-photo-small">
                                    <img src="{{ asset('images/default-avatar.png') }}"
                                         class="img-circle img-responsive">
                                </div>
                            @else
                                <div class="profile-photo-small">
                                    <img src="{{ asset('storage') . '/' . session('customer.avatar') }}"
                                         alt="Circle Image"
                                         class="img-circle img-responsive" style="height: 40px; width: 50px">
                                </div>
                            @endif
                        @else
                            <div class="profile-photo-small">
                                <button class="btn btn-info btn-raised btn-fab btn-fab-mini">
                                    <i class="material-icons" style="position: absolute; top: 57%; left: 50%;">account_circle</i>
                                </button>
                            </div>
                        @endif
                        <div class="ripple-container"></div>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="dropdown-header">
                            Tài khoản
                        </li>
                        @if(isCustomer())
                            <li>
                                <a href="{{ route('customer.profile.edit') }}">
                                    {{ session('customer.full_name') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer.profile.check') }}">
                                    Hoá đơn
                                </a>
                            </li>
                        @endif
                        @if(!isCustomer())
                            <li>
                                <a href="{{ route('customer.login') }}">Đăng nhập</a>
                            </li>
                            <li>
                                <a href="{{ route('customer.register') }}">Đăng ký</a>
                            </li>
                        @endif
                        @if(isCustomer())
                            <li class="divider"></li>
                            <li>
                                <form method="post" action="{{ route('customer.logout')}}" style="text-align: center">
                                    @csrf
                                    <button class="btn btn-link" style="background-color:transparent; color: gray">Đăng
                                        xuất
                                    </button>
                                </form>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#search').on('input', function () {
                const query = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('customer.search') }}",
                    type: "POST",
                    data: {'search': query},
                    success: function (data) {
                        if($('#search').length > 0 && $('#search').val() != ''){
                            $('#search_list').html(data);
                        }
                        else {
                            $('#search_list').html("");
                        }
                    }
                });
            });
        });
    </script>
@endpush
