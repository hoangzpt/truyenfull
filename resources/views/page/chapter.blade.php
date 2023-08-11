@extends('../layout')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page">Data</li>
        </ol>
    </nav>
    <div class="row">
        <div class="cod-md-12">
            <h4>{{ $chapter->novel->name }}</h4>
            <p>Chương hiện tại: {{ $chapter->title }}</p>
            <div class="col-md-5">
                <div class="form-group">
                    <h4 class="d-inline"> Chọn chương: </h4>
                    <select name="active" class="form-select form-select-lg mb-4" aria-label="Default select example">
                        @foreach($allChapter as $chapter)
                            <option value="0"> {{ $chapter->title }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="content">
                <p class="text-md-start lh-lg">
                    {{ $chapter->content }}
                </p>

            </div>
        </div>
    </div>
@endsection
