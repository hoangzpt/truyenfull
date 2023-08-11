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

                        <a class="btn btn-success mb-3" href="{{ route('chapter.create') }}" role="button">Thêm chương</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tên chương</th>
                                    <th scope="col">Slug chương</th>
                                    <th scope="col">Mô tả</th>
                                    <th scope="col">Truyện</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($chapters as $key => $chapter)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td>{{ $chapter->title }}</td>
                                        <td>{{ $chapter->slug_chapter }}</td>
                                        <td>{{ $chapter->describe }}</td>
                                        <td>{{ $chapter->novel->name }}</td>
                                        <td>
                                            @if ($chapter->status == 0)
                                                <span class="text text-success">Kích hoạt</span>
                                            @else
                                                <span class="text text-danger">Không kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>

                                            <form class="d-flex" action="{{ route('chapter.destroy', $chapter->id) }}"
                                                  method="POST">
                                                <div style="margin-right: 20px;">
                                                    <a class="btn btn-primary"
                                                       href="{{ route('chapter.edit', $chapter->id) }}"
                                                       role="button">Sửa</a>
                                                </div>
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn muốn xóa chương này không ?');"
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
