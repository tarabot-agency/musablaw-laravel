<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.title') }}</label>
            <input type="text" class="form-control"
                placeholder="{{ __('app.title') }}" value="{{ old('title_en') }}"
                name="title_en" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>{{ __('app.base_image') }}</label>
            <input type="file" class="form-control" name="image">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>{{ __('app.secondary_images') }}</label>
            <input type="file" class="form-control" name="secondary_images[]" multiple>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ __('app.description') }}</label>
            <textarea rows="10" class="form-control" placeholder="{{ __('app.description') }}" name="description_en">{{ old('description_en') }}</textarea>
        </div>
    </div>
</div>
