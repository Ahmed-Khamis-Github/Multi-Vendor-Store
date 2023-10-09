<div class="card-body">
    <div class="form-group">
         <x-form.input type="text" name="name" :value="$category->name" label='Category Name' />
    </div>

    <div class="form-group">
        <label>Select</label>
        <select class="form-control" name="parent_id">
            <option value="">primary category</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}" @selected(@old('parent_id',$category->parent_id) == $parent->id)>{{ $parent->name }}</option>
            @endforeach

        </select>
    </div>





    <div class="form-group">
        <x-form.textarea name='description' :value="$category->description" label="Description" />
      </div>




    <div class="form-group">
        <label for="exampleInputFile">File input</label>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
            <div class="input-group-append">
                <span class="input-group-text">Upload</span>
            </div>
        </div>
    </div>
    @if ($category->image)
        <li class="list-inline-item">
            <img id="previewImage" src="{{ asset('storage/' . $category->image) }}" height="80px">
        </li>
    @endif

    <x-form.radio name="status" :checked="$category->status" :options="['active' => 'Active', 'archived' => 'Archived']" />
 



</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function to preview the uploaded image
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#previewImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Event listener to trigger the image preview when a file is selected
    $("#exampleInputFile").change(function() {
        previewImage(this);
    });
</script>
