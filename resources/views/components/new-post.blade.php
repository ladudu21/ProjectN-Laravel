<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="title" name="title">
        <label for="title">Title</label>
    </div>
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-floating mb-3">
        <select class="form-select" aria-label="Default select example" id="category_id" name="category_id">
            <option value="" disabled selected>Select an option</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <label for="role">Category</label>
    </div>
    @error('category_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="content">Content</label>
        <textarea class="form-control" name="content" id="editor" rows="5"></textarea>
    </div>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    @error('content')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="thumb" class="form-label">Thumb</label>
        <input class="form-control" type="file" id="thumb" name="thumb">
    </div>
    @error('thumb')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <input class="form-control" type="datetime-local" id="published_at" name="published_at">
    </div>
    @error('published_at')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="tags" name="tags">
        <label for="tags">Tags</label>
    </div>
    @error('tags')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-primary rounded-pill">Post</button>
</form>
