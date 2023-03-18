@extends('layout.master');
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-11">
                <form class="form-horizontal text-sm-center" action="{{ route('products.store') }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-3 justify-content-center">
                        <label class="col-form-label col-1">Tên sản phẩm</label>
                        <div class="col-7">
                            <input type="text" class="form-control" id="product_name" name="name" placeholder="Tên sản phẩm" onchange="generateSlug(this.value)"
                                   value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3 justify-content-center form-inline">
                        <label class="col-form-label col-1">Ảnh sản phẩm</label>
                        <div class="col-7 form-inline">
                            <input type="file" class="form-control col-10" name="image" onchange="pic.src=window.URL.createObjectURL(this.files[0])">
                            <img id="pic" width="auto" height="150" class="col-2 border-0"/>
                            @if ($errors->has('image'))
                                <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3 justify-content-center">
                        <label class="col-form-label col-1">Mô tả sản phẩm</label>
                        <div class="col-7">
                            <textarea class="form-control" name="description" rows="5" placeholder="Mô tả sản phẩm" spellcheck="false">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3 justify-content-center">
                        <label class="col-form-label col-1">Giá sản phẩm</label>
                        <div class="col-7">
                            <input type="number" class="form-control" name="price" placeholder="Giá sản phẩm(VNĐ)"
                                   value="{{ old('price') }}">
                            @if ($errors->has('price'))
                                <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3 justify-content-center">
                        <label class="col-form-label col-1">Slug</label>
                        <div class="col-7">
                            <input type="text" class="form-control" id="slug" name="slug" placeholder="slug"
                                   value="{{ old('slug') }}">
                            @if ($errors->has('slug'))
                                <span class="text-danger text-left">{{ $errors->first('slug') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row mb-3 justify-content-center">
                        <label class="col-form-label col-1">Loại sản phẩm</label>
                        <div class="col-7">
                            <select class="form-control" name="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('category_id'))
                                <span class="text-danger text-left">{{ $errors->first('category_id') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group mb-0 justify-content-center row">
                        <div class="col-9">
                            <button class="btn btn-info" id="btn-submit">Thêm sản phẩm</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        function generateSlug(name) {
            $.ajax({
                url: '{{ route('products.slug.generate') }}',
                type: 'POST',
                dataType: 'json',
                data: { name },
                success: function (response){
                    $('#slug').val(response.data);
                    $('#slug').trigger('change');
                },
                error: function (response){

                }
            });
        }

        $('#slug').change(function () {
            $('#btn-submit').attr('disabled', true);
            $.ajax({
                url: '{{ route('products.slug.check') }}',
                type: 'GET',
                dataType: 'json',
                data: { slug: $(this).val() },
                success: function (response){
                    if(response.success){
                        $('#btn-submit').attr('disabled', false);
                    }
                },
                error: function (response){

                }
            });
        });
    </script>
@endpush