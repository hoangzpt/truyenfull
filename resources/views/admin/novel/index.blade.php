@extends('layouts.app')

@section('content')
    @include('layouts.nav')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Danh sách truyện</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <a class="btn btn-success mb-3" href="{{ route('novel.create') }}" role="button">Thêm truyện</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên truyện</th>
                                    <th scope="col">Tác giả</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Slug truyện</th>

                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($novels as $key => $novel)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td>{{ $novel->name }}</td>
                                        <td>{{ $novel->author }}</td>
                                        <td><img src="{{ asset('public/uploads/novel/'.$novel->image) }}" height="200" width="200" alt=""></td>
                                        <td>{{ $novel->slug_novel }}</td>

                                        <td>{{ $novel->category->name }}</td>
                                        <td>
                                            @if ($novel->status == 0)
                                                <span class="text text-success">Kích hoạt</span>
                                            @else
                                                <span class="text text-danger">Không kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>

                                            <form class="d-flex" action="{{ route('novel.destroy', $novel->id) }}"
                                                method="POST">
                                                <div style="margin-right: 20px;">
                                                    <a class="btn btn-primary"
                                                        href="{{ route('novel.edit', $novel->id) }}"
                                                        role="button">Sửa</a>
                                                </div>
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn muốn xóa truyện này không ?');"
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
