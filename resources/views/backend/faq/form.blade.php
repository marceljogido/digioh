@php($faq = $faq ?? ($data ?? null))
@php($isEdit = isset($faq) && $faq->exists)
@php($locales = available_locales())
@php($sourceLocale = config('translatable.source_locale', 'id'))
<div class="row">
    @foreach($locales as $locale)
        <div class="col-12 col-md-6 mb-3">
            <label class="form-label" for="question_{{ $locale }}">
                {{ __('Question') }} ({{ strtoupper($locale) }})
            </label>
            @if($locale === $sourceLocale)
                {!! field_required('required') !!}
            @endif
            <input
                type="text"
                name="question[{{ $locale }}]"
                id="question_{{ $locale }}"
                value="{{ old("question.$locale", $faq?->getTranslation('question', $locale, false)) }}"
                class="form-control"
                @if($locale === $sourceLocale) required @endif
            >
        </div>
    @endforeach

    @foreach($locales as $locale)
        <div class="col-12 mb-3">
            <label class="form-label" for="answer_{{ $locale }}">
                {{ __('Answer') }} ({{ strtoupper($locale) }})
            </label>
            <textarea
                class="form-control"
                name="answer[{{ $locale }}]"
                id="answer_{{ $locale }}"
                rows="4"
            >{{ old("answer.$locale", $faq?->getTranslation('answer', $locale, false)) }}</textarea>
        </div>
    @endforeach
</div>
<div class="row">
    <div class="col-6 col-md-3 mb-3">
        <label class="form-label" for="sort_order">{{ __('Sort Order') }}</label>
        <input type="number" min="0" name="sort_order" id="sort_order" value="{{ old('sort_order', $faq->sort_order ?? 0) }}" class="form-control">
    </div>
    <div class="col-6 col-md-3 mb-3">
        <div class="form-check mt-4">
            <input class="form-check-input" type="checkbox" value="1" id="is_active" name="is_active" @checked(old('is_active', $faq->is_active ?? true))>
            <label class="form-check-label" for="is_active">{{ __('Active') }}</label>
        </div>
    </div>
</div>
