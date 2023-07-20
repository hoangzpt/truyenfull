@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Danh mục truyện</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <a class="btn btn-success mb-3" href="{{ route('category.create') }}" role="button">Thêm danh
                            mục</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">Slug danh mục</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->slug_category }}</td>
                                        <td>{{ $category->describe }}</td>
                                        <td>
                                            @if ($category->status == 0)
                                                <span class="text text-success">Kích hoạt</span>
                                            @else
                                                <span class="text text-danger">Không kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>

                                            <form class="d-flex" action="{{ route('category.destroy', $category->id) }}"
                                                method="POST">
                                                <div style="margin-right: 20px;">
                                                    <a class="btn btn-primary"
                                                        href="{{ route('category.edit', $category->id) }}"
                                                        role="button">Sửa</a>
                                                </div>
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn muốn xóa danh mục này không ?');"
                                                    class="btn btn-danger">Xoá</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
