@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Thêm danh mục truyện</div>
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

                        <form method="POST" action="{{ route('category.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Tên danh mục</label>
                                <input type="text" value="{{ old('name') }}" class="form-control" name="name" onkeyup="ChangeToSlug()" placeholder="Tên danh mục" id="slug">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Slug danh mục</label>
                                <input type="text" value="{{ old('slug') }}" class="form-control" name="slug_category" readonly placeholder="Tên danh mục" id="convert_slug">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Mô tả</label>
                                <input type="text" value="{{ old('describe') }}" class="form-control" name="describe" placeholder="Mô tả danh mục">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Trạng thái</label>
                                <select name="status" class="form-select" aria-label="Default select example">
                                    <option value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
