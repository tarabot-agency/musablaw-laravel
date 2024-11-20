<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.title_ar') }}</label>
            <input type="text" class="form-control"
                placeholder="{{ __('app.title_ar') }}"
                value="{{ $article->title_ar }}" name="title_ar" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>{{ __('app.image') }}</label>
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
            <label>{{ __('app.description_ar') }}</label>
            <textarea rows="10" class="form-control" placeholder="{{ __('app.description_ar') }}" name="description_ar">{{ $article->description_ar }}</textarea>
        </div>
    </div>
</div>
