@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Cập nhật truyện</div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('novel.update', $novel->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Tên truyện</label>
                                <input type="text" value="{{ $novel->name }}" class="form-control" name="name"
                                    onkeyup="ChangeToSlug()" placeholder="Tên truyện" id="slug">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug truyện</label>
                                <input type="text" value="{{ $novel->slug_novel }}" class="form-control" name="slug_novel"
                                    readonly placeholder="Slug truyện" id="convert_slug">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả truyện</label>
                                <textarea name="describe" class="form-control" rows="5" style="resize: none;">{{ $novel->describe }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Danh mục truyện</label>
                                <select name="category" class="form-select" aria-label="Default select example">
                                    @foreach ($categories as $key => $category)
                                        <option {{ $category->id == $novel->category_id ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh truyện</label>
                                <input type="file" class="form-control-file" name="image">
                                <img src="{{ asset('public/uploads/novel/'.$novel->image) }}"
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select name="status" class="form-select" aria-label="Default select example">
                                    @if ($novel->status == 0)
                                        <option selected value="0">Kích hoạt</option>
                                        <option value="1">Không kích hoạt</option>
                                    @else
                                        <option value="0">Kích hoạt</option>
                                        <option selected value="1">Không kích hoạt</option>
                                    @endif
                                    
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Cập nhật truyện</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
