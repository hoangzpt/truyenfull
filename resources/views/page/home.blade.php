@extends('../layout')

@section('slide')
    @include('page.slide')
@endsection

@section('content')

<h3>Truyện mới cập nhất</h3>
<div class="album py-5 bg-light">
    <div class="container">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($novels as $key => $novel)
                <div class="col">
                    <div class="card shadow-sm">
                        <img style="height: 300px; width: 100%;" class="bd-placeholder-img card-img-top img-thumbnail" src="{{ asset('public/uploads/novel/' .  $novel->image ) }}" alt="">
                        <div class="card-body">
                            <a class="text-decoration-none text-black" href="{{ url('read/' . $novel->slug_novel) }}">
                                <h3>{{ $novel->name }}</h3>
                            </a>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{ url('read/' . $novel->slug_novel) }}" class="btn btn-sm btn-primary">Xem truyện</a>
                                    <a href="" class="btn btn-sm btn-outline-secondary"><i class="fa-regular fa-eye"></i> 60000 </a>
                                </div>
                                <small class="text-muted">9 mins ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="mt-2 btn btn-success btn-sm" href="">Xem thêm</a>
    </div>
</div>
@endsection
