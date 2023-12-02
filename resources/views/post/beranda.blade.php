@extends('app')
@section('app')
   <div class="row">
    <div class="col">
        <div class="card card-profile p-4 mt-4 text-center">
            @if (Auth::user()->image)
            <img src="{{ asset('uploads/' . Auth::user()->image) }}"  style="width: 200px; height:200px;"
                alt="Gambar Profil" class=" image-beranda img-thumbnail rounded-circle m-auto" style="">
        @else
        <div class="m-auto">
            <img src="https://lh3.googleusercontent.com/proxy/esjjzRYoXlhgNYXqU8Gf_3lu6V-eONTnymkLzdwQ6F6z0MWAqIwIpqgq_lk4caRIZF_0Uqb5U8NWNrJcaeTuCjp7xZlpL48JDx-qzAXSTh00AVVqBoT7MJ0259pik9mnQ1LldFLfHZUGDGY=w1200-h630-p-k-no-nu" class="rounded-circle" style="width: 200px; height:200px; object-fit:cover;" alt="">
        </div>
            <!-- Tampilkan gambar default jika pengguna tidak memiliki gambar profil -->

        @endif


        {{-- pref image --}}
        <div class="card-images-pref">
        </div>
        <img src="{{ asset('uploads/' . Auth::user()->image) }}"
        alt="Gambar Profil" class=" image-beranda-pref img-thumbnail m-auto" style="">
        {{-- pref image --}}
        <p>{{Auth::user()->email}}</p>
         <h3 class="text-profile">Selamat datang {{Auth::user()->name}}</h3>
         <p class="text-light">{{Auth::user()->bio}}</p>
        </div>
        <hr>
        @if (session('success'))
         <div class="alert alert-info text-dark">
           {{session('success')}}
         </div>
       @endif
        @if (session('error'))
         <div class="alert alert-danger">
           {{session('error')}}
         </div>
       @endif
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
       @if ($posts->isEmpty())
           <p class="text-center"> Belum ada postingan yang tersedia </p>
       @endif
       @foreach ($posts as $p )
           <div class="my-3">
               {{-- looping all post --}}
               <div class="card card-post" style="">
                   <div class="row ">
                    <div class="col">
                        @if ($p->image_post)
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $p->image_post) }}" class="img-fluid rounded-start preview-image" alt="...">
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
                        <div class=" col-1">
                            <div class="card-body button-beranda">
                                <form action="/post/hapus/{{$p->id}}" method="post" enctype="multipart/form-data">
                                <a href="/post/lihat/ {{$p->id}}" class="btn btn-info"><i class="bi bi-eye"></i></a>
                                @csrf
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i></button>
                                <a href="/post/edit/ {{$p->id}}" class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                            </form>
                            </div>
                        </div>
                   </div>
               </div>
           </div>
       @endforeach
    </div>
   </div>
@endsection
