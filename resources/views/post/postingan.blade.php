@extends('app')
@section('app')
    <div class="row">
        <div class="col">
            @if (session('success'))
            <div class="alert alert-info text-dark">
              {{session('success')}}
            </div>
          @endif

          @error('image_post')
          <div class="text-danger ">
              {{$message}}
          </div>
          @enderror
            <div class="">
                <p class="mx-4 mt-3 fw-bold header-post">Apa yang anda pikirkan ?</p>
                <form action="/store" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="image_post">Image</label>
                        <input type="file" name="image_post" id="image_post" class="form form-control">
                    </div>
                    <div>
                        <label for="desc">Desc</label>
                        <textarea name="desc" id="desc" cols="30" class="form form-control" rows="10"></textarea>
                        @error('desc')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <button class="btn btn-dark my-3" type="submit">Posting</button>
                </form>
            </div>
            {{-- all post --}}
            <hr>
            <p class="mx-4 mt-5 fw-bold header-post">Semua Postingan</p>
            @if ($post->isEmpty())
                <p class="text-center"> Belum ada postingan yang tersedia </p>
            @endif
            @foreach ($post as $p )
                <div class="my-3">
                    {{-- looping all post --}}
                    <div class="card card-post" style="">
                        <div class="row ">
                            <div class="col">
                                @if ($p->image_post)
                                    <div class="image-container">
                                        <img src="{{ asset('imagepost/' . $p->image_post) }}" class="img-fluid rounded-start preview-image" alt="...">
                                    </div>
                                @else
                                    <p class="m-5">Tidak Mengupload Gambar</p>
                                @endif
                            </div>
                            <div class="preview-overlay"></div>
                            <div class="col-md-7">
                                <div class="card-body ">
                                    <h5 class="card-title">{{ $p->user->name }}</h5>
                                    <p class="card-text fs-5 fw-bold">
                                        {{ $p->desc }}
                                    </p>
                                    <p class="card-text">
                                        <small class="text-body-secondary"> Last updated {{ $p->created_at->format('H:i:s') }}</small>
                                    </p>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="card-body">
                                    <a href="/post/lihat/{{$p->id}}" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            {{$post->links("pagination::bootstrap-4")}}
        </div>
    </div>
@endsection
