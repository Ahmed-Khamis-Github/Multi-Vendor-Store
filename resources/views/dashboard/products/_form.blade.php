<div class="card-body">
    <div class="form-group">
        <x-form.input type="text" name="name" :value="$product->name" label='Product Name' />
    </div>

    <div class="form-group">
        <label>Select Category</label>
        <select class="form-control" name="category_id">
            <option value="">primary product</option>
            @foreach ($parents as $parent)
                <option value="{{ $parent->id }}" @selected(@old('category_id', $parent->id) == $product->category_id)>{{ $parent->name }}</option>
            @endforeach

        </select>
    </div>





    <div class="form-group">
        <x-form.textarea name='description' :value="$product->description" label="Description" />
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
    @if ($product->image)
        <li class="list-inline-item">
            <img id="previewImage" src="{{ asset('storage/' . $product->image) }}" height="80px">
        </li>
    @endif


    <div class="form-group">
        <x-form.input type="number" name="price" :value="$product->price" label='Product Price' />
    </div>

    <div class="form-group">
        <x-form.input type="number" name="compare_price" :value="$product->compare_price" label='Product Compare_Price' />
    </div>


    <div class="form-group">
        <x-form.input label="Tags" id="tags" name="tags" :value="$tags ?? ''" />
    </div>


    <div>
        <x-form.radio name="status" :checked="$product->status" :options="['active' => 'Active', 'draft' => 'Draft', 'archived' => 'Archived']" />
    </div>




</div>
<!-- /.card-body -->

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
</div>


@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var input = document.querySelector('input[name=tags]');
            new Tagify(input);
        });
    </script>
@endpush




