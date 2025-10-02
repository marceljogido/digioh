@php($faq = $faq ?? ($data ?? null))
@php($isEdit = isset($faq) && $faq->exists)
<div class="row">
    <div class="col-12 col-md-6 mb-3">
        <label class="form-label" for="question">{{ __('Question') }}</label>
        {!! field_required('required') !!}
        <input type="text" name="question" id="question" value="{{ old('question', $faq->question ?? '') }}" class="form-control" required>
    </div>
    <div class="col-12 col-md-6 mb-3">
        <label class="form-label" for="question_en">{{ __('Question (English)') }}</label>
        <input type="text" name="question_en" id="question_en" value="{{ old('question_en', $faq->question_en ?? '') }}" class="form-control">
    </div>
    <div class="col-12 mb-3">
        <label class="form-label" for="answer">{{ __('Answer') }}</label>
        <textarea class="form-control" name="answer" id="answer" rows="4">{{ old('answer', $faq->answer ?? '') }}</textarea>
    </div>
    <div class="col-12 mb-3">
        <label class="form-label" for="answer_en">{{ __('Answer (English)') }}</label>
        <textarea class="form-control" name="answer_en" id="answer_en" rows="4">{{ old('answer_en', $faq->answer_en ?? '') }}</textarea>
    </div>
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
