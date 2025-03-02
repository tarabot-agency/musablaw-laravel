<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('app.title') }}</label>
            <input type="text" class="form-control"
                placeholder="{{ __('app.title') }}" value="{{ old('title_ar') }}"
                name="title_ar" id="title_ar" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('app.meta_title') }}</label>
            <input type="text" class="form-control"
                placeholder="{{ __('app.meta_title') }}" value="{{ old('meta_title') }}"
                name="meta_title" id="meta_title" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('app.slug') }}</label>
            <input type="text" class="form-control"
                placeholder="{{ __('app.slug') }}" value="{{ old('slug') }}"
                name="slug" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('app.show_at') }}</label>
            <input type="datetime-local" class="form-control"
                placeholder="{{ __('app.show_at') }}" value="{{ old('show_at') }}"
                name="show_at" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('app.base_image') }}</label>
            <input type="file" class="form-control" name="image" id="image">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('app.secondary_images') }}</label>
            <input type="file" class="form-control" name="secondary_images[]" multiple>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ __('app.meta_description') }}</label>
            <textarea rows="3" class="form-control" placeholder="{{ __('app.meta_description') }}" name="meta_description" required>{{ old('meta_description') }}</textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ __('app.description') }}</label>
            <textarea rows="10" class="form-control" placeholder="{{ __('app.description') }}" name="description_ar" id="description_ar">{{ old('description_ar') }}</textarea>
        </div>
    </div>
</div>
