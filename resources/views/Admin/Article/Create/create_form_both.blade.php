<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.title_en') }}</label>
            <input type="text" class="form-control"
                placeholder="{{ __('app.title_en') }}" value="{{ old('title_en') }}"
                name="title_en" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.title_ar') }}</label>
            <input type="text" class="form-control"
                placeholder="{{ __('app.title_ar') }}" value="{{ old('title_ar') }}"
                name="title_ar" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.description_en') }}</label>
            <textarea rows="10" class="form-control" placeholder="{{ __('app.description_en') }}" name="description_en">{{ old('description_en') }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.description_ar') }}</label>
            <textarea rows="10" class="form-control" placeholder="{{ __('app.description_ar') }}" name="description_ar">{{ old('description_ar') }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.base_image') }}</label>
            <input type="file" class="form-control" name="image">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.secondary_images') }}</label>
            <input type="file" class="form-control" name="secondary_images[]" multiple>
        </div>
    </div>
</div>
