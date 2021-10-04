
<?php 
    use App\Http\Controllers\CategoryController;
    $category   = new CategoryController;
    $path       = Request::path();
    $categories = $category->index($path);
?>
  <div>
    <div class="list-group mt-4">
      @foreach ($categories as $category)
        <a href="{{ $path }}/{{ mb_strtolower($category->name) }}/{{ $category->id }}" 
          class="list-group-item list-group-item-action m-1">{{ $category->name }}</a>
      @endforeach
    </div>
  </div>