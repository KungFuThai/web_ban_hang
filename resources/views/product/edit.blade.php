@extends('layout.master');
@section('content')
    <a href="{{ route('products.index') }}"
       class="btn text-muted d-none d-sm-inline-block btn-link font-weight-semibold">
        <i class="mdi mdi-arrow-left"></i>
        Quay lại
    </a>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal text-sm-center" action="{{ route('products.update', $each) }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row mb-3 justify-content-center">
                            <label class="col-form-label col-1">Tên sản phẩm</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="product_name" name="name"
                                       placeholder="Tên sản phẩm" onchange="generateSlug(this.value)"
                                       value="{{ $each->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 justify-content-center form-inline">
                            <label class="col-form-label col-1">Thêm ảnh mới</label>
                            <div class="col-7 form-inline">
                                <input type="file" class="form-control col-10" name="image"
                                       onchange="pic.src=window.URL.createObjectURL(this.files[0])">
                                <img id="pic" width="auto" height="150" class="col-2"/>
                                @if ($errors->has('image_new'))
                                    <span class="text-danger text-left">{{ $errors->first('image_new') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 justify-content-center form-inline">
                            <label class="col-form-label col-1">Hoặc giữ ảnh cũ</label>
                            <div class="col-7 form-inline">
                                <img width="auto" height="150" class="col-2"
                                     src="{{ asset('storage'). '/' . $each->image }}"/>
                            </div>
                        </div>
                        <div class="form-group row mb-3 justify-content-center">
                            <label class="col-form-label col-1">Mô tả sản phẩm</label>
                            <div class="col-7">
                            <textarea class="form-control" name="description" rows="5" placeholder="Mô tả sản phẩm"
                                      spellcheck="false">{{ $each->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 justify-content-center">
                            <label class="col-form-label col-1">Giá sản phẩm</label>
                            <div class="col-7">
                                <input type="number" class="form-control" name="price" placeholder="Giá sản phẩm(VNĐ)"
                                       value="{{ $each->price }}">
                                @if ($errors->has('price'))
                                    <span class="text-danger text-left">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3 justify-content-center">
                            <label class="col-form-label col-1">Slug</label>
                            <div class="col-7">
                                <input type="text" class="form-control" id="slug" name="slug" placeholder="slug"
                                       value="{{ $each->slug }}">
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
                                        <option value="{{ $category->id }}"
                                                @if($each->category_id === $category->id)
                                                selected
                                                @endif>
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
                                <button class="btn btn-info" id="btn-submit">Sửa sản phẩm</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        function generateSlug(name) {
            $.ajax({
                url: '{{ route('products.slug.generate') }}',
                type: 'GET',
                dataType: 'json',
                data: {name},
                success: function (response) {
                    $('#slug').val(response.data);
                    $('#slug').trigger('change');
                },
                error: function (response) {

                }
            });
        }
    </script>
@endpush