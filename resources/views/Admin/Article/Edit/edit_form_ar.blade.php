<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('app.title') }}</label>
            <input type="text" class="form-control"
                placeholder="{{ __('app.title') }}"
                value="{{ $article->title_ar }}" name="title_ar" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('app.meta_title') }}</label>
            <input type="text" class="form-control"
                placeholder="{{ __('app.meta_title') }}"
                value="{{ $article->meta_title }}" name="meta_title" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('app.slug') }}</label>
            <input type="text" class="form-control"
                placeholder="{{ __('app.slug') }}"
                value="{{ $article->slug }}" name="slug" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('app.show_at') }}</label>
            <input type="datetime-local" class="form-control"
                placeholder="{{ __('app.show_at') }}" value="{{  $article->show_at }}"
                name="show_at" required>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>{{ __('app.image') }}</label>
            <input type="file" class="form-control" name="image">
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
            <textarea rows="3" class="form-control" placeholder="{{ __('app.meta_description') }}" name="meta_description" required>{{ $article->meta_description }}</textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>{{ __('app.description') }}</label>
            <textarea rows="10" class="form-control ckeditor" placeholder="{{ __('app.description') }}" name="description_ar" id="description_ar">{{ $article->description_ar }}</textarea>
        </div>
    </div>
</div>
