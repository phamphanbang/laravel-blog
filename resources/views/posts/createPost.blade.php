@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
    <div class="p-3 mb-2 bg-danger text-white">{{ $errors->first() }}</div>
    @endif
    @isset($data["delete-message"])
    <div class="alert alert-success" role="alert">
        {{ $data["delete-message"] }}
      </div>
    @endisset
    <div class="row justify-content-center">
        <div class="col-md-8 col-xl-10">
            <div class="card">
                <div class="card-header">
                    <h3>{{ __('Add new post') }}</h3>
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
                        <form action="{{ url('/post') }}" method="post">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <input required="required" value="{{ old('title') }}" placeholder="Enter title here"
                                    type="text" name="title" class="form-control" />
                            </div>
                            <div class="form-group">
                                <textarea name='body' class="form-control">{{ old('body') }}</textarea>
                            </div>
                            <input type="submit" name='publish' class="btn btn-success" value="{{ __('Publish') }}" />
                            <input type="submit" name='save' class="btn btn-default" value="{{ __('Save Draft') }}" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection