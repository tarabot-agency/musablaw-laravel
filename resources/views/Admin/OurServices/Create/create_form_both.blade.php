<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.title_en') }}</label>
            <input type="text" class="form-control" placeholder="{{ __('app.title_en') }}" value="{{ old('title_en') }}"
                name="title_en" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.title_ar') }}</label>
            <input type="text" class="form-control" placeholder="{{ __('app.title_ar') }}"
                value="{{ old('title_ar') }}" name="title_ar" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.description_en') }}</label>
            <textarea rows="5" class="form-control" placeholder="{{ __('app.description_en') }}" name="description_en">{{ old('description_en') }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.description_ar') }}</label>
            <textarea class="form-control" placeholder="{{ __('app.description_ar') }}" name="description_ar" rows="5">{{ old('description_ar') }}</textarea>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.icon') }}</label> -
            <a href="https://icons.getbootstrap.com" target="__blank">
                {{ __('app.link') }}</a>
                <input type="text" class="form-control" placeholder='Icon Class From Link Above Like ( bi bi-alarm )'
                value="{{ old('icon') }}" name="icon" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>{{ __('app.image') }}</label>
            <input type="file" class="form-control" placeholder="{{ __('app.image') }}" name="image">
        </div>
    </div>

</div>
