@extends('personal.layouts.main')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Adding post</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('personal.main.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('personal.post.index') }}">Posts</a></li>
                            <li class="breadcrumb-item active">Add category</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <form action="{{ route('personal.post.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group w-25">
                                <input type="text" class="form-control" name="title" placeholder="post name"
                                       value="{{ old('title') }}">
                                @error('title')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50">
                                <textarea id="summernote" name="content">{{ old('content') }}</textarea>
                                @error('content')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50">
                                <label for="exampleInputFile">Add image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                                @error('image')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group w-50">
                                <label>Tags</label>
                                <select class="select2" multiple="multiple" name="tag_ids[]" data-placeholder="Choose tags" style="width: 100%;" id="tag-select">
                                    @foreach($tags as $tag)
                                        <option {{ is_array(old('tag_ids')) && in_array($tag->id, old('tag_ids')) ? ' selected' : '' }}
                                                value="{{ $tag->id }}">
                                            {{ $tag->title }}
                                        </option>
                                    @endforeach
                                    <option value="__new__">Add New Tag</option>
                                </select>
                                @error('tag_ids')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary mt-2" value="Add">
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
                <!-- Main row -->


                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function getTagTitles()
        {
            let url = "{{route('tags.get.titles')}}";
            fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            })
                .then(response => response.json())
                .then(data => {
                    console(data);
                });
        }
        getTagTitles();
        function isNumeric(str) {
            // Use a regular expression to check if the string contains only numbers
            return /^\d+$/.test(str);
        }

        $(document).ready(function() {
            $('#tag-select').select2();

            $('#tag-select').on('select2:selecting', function(e) {
                var selectedTag = e.params.args.data.text;

                if (selectedTag === 'Add New Tag') {
                    var newTag = prompt('Enter the new tag:');
                    if (newTag) {
                        if(isNumeric(newTag))
                        {
                            alert('tag can not be number')
                        }
                        else{
                            var option = new Option(newTag, newTag, true, true);
                            $('#tag-select').append(option).trigger('change');
                        }
                    }
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
