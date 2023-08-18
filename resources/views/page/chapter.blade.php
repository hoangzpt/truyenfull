@extends('../layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('/') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('novel-category/' . $novel_Breadcrum->category->slug_category) }}">{{ $novel_Breadcrum->category->name }}</a></li>
            <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ url('read/' . $novel_Breadcrum->slug_novel) }}">{{ $novel_Breadcrum->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $chapter->title }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="cod-md-12">
            <h4>{{ $chapter->novel->name }}</h4>
            <p>Chương hiện tại: {{ $chapter->title }}</p>
            <style  type="text/css">
                .isDisable {
                    color: currentColor;
                    pointer-events: none;
                    opacity: 0.5;
                    text-decoration: none;
                }
            </style>
            <div class="form-group">
                <div class="d-flex align-items-center justify-content-center">
                    <a class="btn btn-success" href="{{ url('read-chapter/' . $previousChapter) }}"> < </a>
                    <select name="select-chapter" style="margin-top: 23px;" class="select-chapter form-select form-select-lg mb-4" aria-label="Default select example">
                        @foreach($allChapter as $chapter)
                            <option value="{{ url('read-chapter/' . $chapter->slug_chapter) }}"> {{ $chapter->title }} </option>
                        @endforeach
                    </select>
                    <a class="btn btn-success {{ $chapter->id == $maxId->id ? '' : 'isDisable' }}" href="{{ url('read-chapter/' . $nextChapter) }}"> > </a>
                </div>
            </div>


            <div class="content">
                <p class="text-lg-center lh-lg">
                    {!! $chapter->content !!}
                </p>

            </div>
            <div class="form-group">
                <div class="d-flex align-items-center justify-content-center">
                    <a class="btn btn-success" href="{{ url('read-chapter/' . $previousChapter) }}"> < </a>
                    <select name="select-chapter" style="margin-top: 23px;" class="select-chapter form-select form-select-lg mb-4" aria-label="Default select example">
                        @foreach($allChapter as $chapter)
                            <option value="{{ url('read-chapter/' . $chapter->slug_chapter) }}"> {{ $chapter->title }} </option>
                        @endforeach
                    </select>
                    <a class="btn btn-success" href="{{ url('read-chapter/' . $nextChapter) }}"> > </a>
                </div>
            </div>
        </div>
    </div>
@endsection
