@extends('app')
@section('app')
<div class="card p-2 mb-3 header-post fs-5 fw-bold" style="margin-top:5rem;">Detail Postingan {{$post_show->user->name}}</div>
<div class="card card-post" >
    <div class="row ">
        <div class="col">
            @if ($post_show->image_post)
                <img src="{{ asset('storage/' . $post_show->image_post) }}" class="img-fluid rounded-start" alt="..." style="width: 400px; height:300px;">
            @else
                <p class="m-5">Tidak Mengupload Gambar</p>
            @endif
        </div>
        <div class="col-md-6">
            <div class="card-body ">
                <h5 class="card-title">{{ $post_show->user->name }}</h5>
                <p class="card-text fs-5 fw-bold">
                    {{ $post_show->desc }}
                </p>
                <p class="card-text">
                    <small class="text-body-secondary"> Last updated {{ $post_show->created_at->format('H:i:s') }}</small>
                </p>
            </div>
        </div>
        <div class="col-2">
            <div class="card-body">
                <a href="/post" class="btn btn-info">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
