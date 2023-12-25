<form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
        <label for="title">Title</label>
    </div>
    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-floating mb-3">
        <select class="form-select" aria-label="Default select example" id="category_id" name="category_id">
            <option value="" disabled selected>Select an option</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $post->category->id ? 'selected' : '' }}>
                    {{ $category->name }}</option>
            @endforeach
        </select>
        <label for="role">Category</label>
    </div>
    @error('category_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="content">Content</label>
        <textarea class="form-control" name="content" id="content" rows="5">{{ $post->content }}</textarea>
    </div>
    @error('content')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <label for="thumb" class="form-label">Thumb</label>
        <img class="img-thumbnail mb-2" src="{{ asset( $post->thumb ) }}" alt="" style="width: 10rem;">
        <input class="form-control" type="file" id="thumb" name="thumb">
    </div>
    @error('thumb')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="mb-3">
        <input class="form-control" type="datetime-local" id="published_at" name="published_at"
            value="{{ $post->published_at }}" disabled>
    </div>
    @error('published_at')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="tags" name="tags" value="{{ $post->tagList() }}">
        <label for="tags">Tags</label>
    </div>
    @error('tags')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <button type="submit" class="btn btn-primary rounded-pill">Update</button>
</form>
