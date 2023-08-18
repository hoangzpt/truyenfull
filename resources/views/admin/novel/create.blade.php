@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm truyện</div>
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

                        <form method="POST" action="{{ route('novel.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Tên truyện</label>
                                <input type="text" value="{{ old('name') }}" class="form-control" name="name"
                                    onkeyup="ChangeToSlug()" placeholder="Tên truyện" id="slug">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tác giả</label>
                                <input type="text" value="{{ old('author') }}" class="form-control" name="author"
                                       onkeyup="ChangeToSlug()" placeholder="Tên tác giả" id="slug">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug truyện</label>
                                <input type="text" value="{{ old('slug_novel') }}" class="form-control" name="slug_novel"
                                    readonly placeholder="Slug truyện" id="convert_slug">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả truyện</label>
                                <textarea id="describe_novel" name="describe" class="form-control" rows="5" style="resize: none;"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Danh mục truyện</label>
                                <select name="category" class="form-select" aria-label="Default select example">
                                    @foreach ($categories as $key => $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Hình ảnh truyện</label>
                                <input type="file" class="form-control-file" name="image">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select name="status" class="form-select" aria-label="Default select example">
                                    <option value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm truyện</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
