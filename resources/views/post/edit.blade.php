@extends('app')
@section('app')
<form action="/post/update/ {{$post_edit->id}}" method="post" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="image_post">Image</label>
        <input type="file" name="image_post" id="image_post" class="form-control form" value="{{$post_edit->image_post}}">
        <img src="{{ asset('storage/' . $post_edit->image_post) }}" class="my-3" alt="" style="width: 400px">
    </div>
    <div>
        <label for="desc">Desc</label>
        <textarea name="desc" id="desc" cols="30" class="form-control form" rows="10">{{$post_edit->desc}}</textarea>
    </div>
    <button class="btn btn-dark my-3" type="submit">Posting</button>
    <a href="/" class="btn btn-dark my-3" type="">Kembali</a>
</form>
@endsection
