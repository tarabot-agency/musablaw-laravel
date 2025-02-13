<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label>{{ __('app.title_en') }}</label>
            <input type="text" class="form-control" placeholder="{{ __('app.title_en') }}"
                value="{{ $article->title_en }}" name="title_en" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>{{ __('app.slug') }}</label>
            <input type="text" class="form-control"
                placeholder="{{ __('app.slug') }}"
                value="{{ $article->slug }}" name="slug" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.title_ar') }}</label>
            <input type="text" class="form-control" placeholder="{{ __('app.title_ar') }}"
                value="{{ $article->title_ar }}" name="title_ar" required>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>{{ __('app.show_at') }}</label>
            <input type="datetime-local" class="form-control"
                placeholder="{{ __('app.show_at') }}" value="{{  $article->show_at }}"
                name="show_at" required>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ __('app.meta_description') }}</label>
            <textarea rows="3" class="form-control" placeholder="{{ __('app.meta_description') }}" name="meta_description" required>{{ $article->meta_description }}</textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ __('app.description_en') }}</label>
            <textarea rows="10" class="form-control ckeditor" placeholder="{{ __('app.description_en') }}" name="description_en">{{ $article->description_en }}</textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ __('app.description_ar') }}</label>
            <textarea rows="10" class="form-control ckeditor" placeholder="{{ __('app.description_ar') }}" name="description_ar">{{ $article->description_ar }}</textarea>
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
