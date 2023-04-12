<h2 class="section-title">Find what you need</h2>
<div class="col-md-3">
    <div class="card card-refine card-plain">
        <div class="card-content">
            <form>
                <h4 class="card-title">
                    Bộ lọc
                    <a href="{{ route('customer.index') }}" class="btn btn-info btn-fab btn-fab-mini btn-simple pull-right" rel="tooltip"
                            title="" data-original-title="Reset Filter">
                        <i class="material-icons">cached</i>
                    </a>
                </h4>
                <div class="panel panel-default panel-rose">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                           href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <h4 class="panel-title">Khoảng giá</h4>
                            <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel"
                         aria-labelledby="headingOne">
                        <input type="hidden" name="min_price" value="{{ $minPrice }}" id="input-min-price">
                        <input type="hidden" name="max_price" value="{{ $maxPrice }}" id="input-max-price">
                        <div class="panel-body panel-refine">
                            <span class="pull-left">
                                ₫<span id="span-min-price">{{ $minPrice }}</span>
                            </span>
                            <span class="pull-right">
                                ₫<span id="span-max-price">{{ $maxPrice }}</span>
                            </span>
                            <div class="clearfix"></div>
                            <div id="sliderRefine"
                                 class="slider slider-info noUi-target noUi-ltr noUi-horizontal">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default panel-rose">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                           href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <h4 class="panel-title">Loại sản phẩm</h4>
                            <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel"
                         aria-labelledby="headingThree">
                        <div class="panel-body">
                            @foreach($categories as $category)
                                <div class="checkbox">
                                    <label>
                                        <input
                                                type="checkbox"
                                               value="{{ $category->slug }}"
                                               data-toggle="checkbox"
                                               name="categories[]"
                                                @if(in_array(($category->slug), $filterCategories))
                                                    checked
                                                @endif
                                        >
                                        <span class="checkbox-material"><span class="check"></span></span>
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <br>
                <button class="btn btn-info btn-round">
                    <i class="fa fa-filter"></i>
                    Lọc
                </button>
            </form>
        </div>
    </div><!-- end card -->
</div>
@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            const slider2 = document.getElementById('sliderRefine');

            const minPrice = parseInt($('#input-min-price').val())
            const maxPrice = parseInt($('#input-max-price').val())

            noUiSlider.create(slider2, {
                start: [minPrice, maxPrice],
                connect: true,
                range: {
                    'min': [{{ $arrPrice['min_price'] }} - 50000],
                    'max': [{{ $arrPrice['max_price'] }} + 50000]
                },
                step: 1000,
            });

            let val;
            slider2.noUiSlider.on('update', function (values, handle) {
                val = Math.round(values[handle]);
                if (handle) {
                    $('#span-max-price').text(val);
                    $('#input-max-price').val(val);
                } else {
                    $('#span-min-price').text(val);
                    $('#input-min-price').val(val);
                }
            });
        });
    </script>
@endpush