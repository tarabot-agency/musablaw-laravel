<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.title_en') }}</label>
            <input type="text" class="form-control" placeholder="{{ __('app.title_en') }}" value="{{ $page->title_en }}"
                name="title_en" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.image') }}</label>
            <input type="file" class="form-control" placeholder="{{ __('app.image') }}" name="image">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.description_en') }}</label>
            <textarea rows="5" class="form-control" placeholder="{{ __('app.description_en') }}" name="description_en">{{ $page->description_en }}</textarea>
        </div>
    </div>
    @if ($page->icon)
        <div class="col-md-6">
            <div class="form-group">
                <label>{{ __('app.icon') }}</label> -
                <a href="https://icons.getbootstrap.com" target="__blank">
                    {{ __('app.link') }}</a>
                <input type="text" class="form-control" placeholder="Icon Class From Link Above Like ( bi bi-alarm )"
                    value="{{ $page->icon }}" name="icon" required>
            </div>
        </div>
    @endif
</div>
