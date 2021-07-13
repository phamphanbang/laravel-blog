@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        {{ $errors->first() }}
      </div>
    @endif
    @isset ($data["message"])
    <div class="alert alert-success" role="alert">
        {{ $data["message"] }}
      </div>
    @endisset
    <div class="row justify-content-center">
        <div class="col-md-8 col-xl-10">

            <div class="card">
                <div class="card-header">
                    <h3>Edit Post</h3>
                </div>

                <div class="card-body">
                    <div class="card-text">
                        <script type="text/javascript" src="{{ asset('/js/tinymce/tinymce.min.js') }}">
                        </script>
                        <script type="text/javascript">
                            tinymce.init({
                                    selector: "textarea",
                                    plugins: ["advlist autolink lists link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste"],
                                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
                                });
                        </script>
                        <form action="{{ asset('/post/update') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="post_id"
                                value="{{ old('post_id') ? old('post_id') : $data["post"]->id }}">
                            <input type="hidden" name="author_id"
                                value="{{ old('author_id') ? old('author_id') : $data["post"]->author_id }}">
                            <div class="form-group">
                                <input required="required"
                                    value="{{ old('title') ? old('title'):$data["post"]->title }}"
                                    placeholder="Enter title here" type="text" name="title" class="form-control" />
                            </div>
                            <div class="form-group">
                                <textarea name='body'
                                    class="form-control">{{ old('body') ? old('body'):$data["post"]->body}}</textarea>
                            </div>
                            <input type="submit" name='update' class="btn btn-success" value="Update" />
                            <input type="submit" name='save' class="btn btn-default" value="Save Draft" />
                            <a href="{{ route('deletePost',['id' => $data["post"]->id]) }}" class="btn btn-danger">Delete</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection