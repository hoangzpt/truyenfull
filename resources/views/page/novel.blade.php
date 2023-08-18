@extends('../layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('novel-category/' . $novel->category->slug_category) }}">{{ $novel->category->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $novel->name }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3">
                    <img style="height: 300px; width: 100%;" class="bd-placeholder-img card-img-top img-thumbnail" src="{{ asset('public/uploads/novel/'.$novel->image) }}" alt="">
                </div>
                <div class="col-md-9">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h3>{{ $novel->name }}</h3>
                        </li>
                        <li class="list-group-item">Tác giả: {{ $novel->author }}</li>
                        <li class="list-group-item">Thể loại: {{ $novel->category->name }}</li>
                        <li class="list-group-item">Số chương: {{ $countChapter }}</li>
                        <li class="list-group-item">Lượt xem: 3000</li>
                        <li class="list-group-item">
                            <a href="#">Danh sách chương</a>
                        </li>
                        @if($firstChapter)
                            <li class="list-group-item">
                                <a class="btn btn-primary" href="{{ url('read-chapter/' . $firstChapter->slug_chapter) }}">Đọc từ đầu</a>
                            </li>
                        @else
                            <li class="list-group-item">
                                <a class="btn btn-primary" href="#">Đọc từ đầu</a>
                            </li>
                        @endif
                    </ul>
                </div>

                <div class="col-md-12">
                    <h3>Mô tả</h3>
                    <p class="text-lg-center lh-lg">
                        {!! $novel->describe !!}
                    </p>
                </div>
                <br>

                <h3>Mục Lục</h3>
                <ul class="list-group list-group-flush">
                    @if ($countChapter == 0)
                        <li class="list-group-item">Đang cập nhật ...</li>
                    @else
                        @foreach($chapters as $chapter)
                            <li class="list-group-item">
                                <a class="text-decoration-none" href="{{ url('read-chapter/' . $chapter->slug_chapter) }}"> {{ $chapter->title }} </a>
                            </li>
                        @endforeach
                    @endif
                </ul>

                <h3>Truyện cùng thể loại</h3>
                <div class="row">
                    @foreach($sameCategories as $key=>$sameCategory)
                        <div class="card shadow-sm col-md-3">
                            <img style="height: 300px; width: 100%;" class="bd-placeholder-img card-img-top img-thumbnail" src="{{ asset('public/uploads/novel/'.$sameCategory->image) }}" alt="">
                            <div class="card-body">
                                <h6>{{ $sameCategory->name }}</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ url('read/' . $sameCategory->slug_novel) }}" class="btn btn-sm btn-primary">Xem truyện</a>
                                        <a href="" class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-eye"></i> 60000 </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3">
            Truyện xem nhiều
        </div>
    </div>
@endsection
