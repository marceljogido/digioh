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

{{-- Auto Translate Button --}}
<div class="row mb-3">
    <div class="col-12">
        <button type="button" id="autoTranslateFaqBtn" class="btn btn-outline-primary">
            <i class="fas fa-language me-2"></i>{{ __('Auto Translate ID → EN') }}
        </button>
        <small class="text-muted ms-2">{{ __('Otomatis terjemahkan pertanyaan dan jawaban Indonesia ke Inggris') }}</small>
    </div>
</div>

@push('after-scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const translateBtn = document.getElementById('autoTranslateFaqBtn');
    if (!translateBtn) return;

    translateBtn.addEventListener('click', async function() {
        const btn = this;
        const originalText = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Translating...';

        try {
            const questionId = document.getElementById('question_id')?.value || '';
            const answerId = document.getElementById('answer_id')?.value || '';

            if (!questionId && !answerId) {
                alert('{{ __("Tidak ada konten Indonesia untuk diterjemahkan") }}');
                return;
            }

            const response = await fetch('{{ route("backend.translate.batch") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    texts: [questionId, answerId],
                    source: 'id',
                    target: 'en'
                })
            });

            const data = await response.json();

            if (data.success) {
                const [questionEn, answerEn] = data.translations;

                const questionEnField = document.getElementById('question_en');
                if (questionEnField && questionEn) questionEnField.value = questionEn;

                const answerEnField = document.getElementById('answer_en');
                if (answerEnField && answerEn) answerEnField.value = answerEn;

                btn.innerHTML = '<i class="fas fa-check me-2"></i>Translated!';
                setTimeout(() => { btn.innerHTML = originalText; }, 2000);
            } else {
                throw new Error(data.message || 'Translation failed');
            }
        } catch (error) {
            console.error('Translation error:', error);
            alert('{{ __("Gagal menerjemahkan: ") }}' + error.message);
            btn.innerHTML = originalText;
        } finally {
            btn.disabled = false;
        }
    });
});
</script>
@endpush
