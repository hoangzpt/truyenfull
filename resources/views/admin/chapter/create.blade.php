@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm chương truyện</div>
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

                        <form method="POST" action="{{ route('chapter.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Tên chương</label>
                                <input type="text" value="{{ old('title') }}" class="form-control" name="title"
                                    onkeyup="ChangeToSlug()" placeholder="Tên chương" id="slug">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug chương</label>
                                <input type="text" value="{{ old('slug_chapter') }}" class="form-control" name="slug_chapter"
                                    readonly placeholder="Slug chương" id="convert_slug">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả chương</label>
                                <input name="describe" value="{{ old('describe') }}" class="form-control" rows="5" style="resize: none;"></input>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nội dung chương</label>
                                <textarea id="content_chapter" name="content" value="{{ old('content') }}" class="form-control" rows="5" style="resize: none;"></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Thuộc truyện</label>
                                <select name="novel" class="form-select" aria-label="Default select example">
                                    @foreach ($novels as $key => $novel)
                                        <option value="{{ $novel->id }}">{{ $novel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select name="status" class="form-select" aria-label="Default select example">
                                    <option value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm chương</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
