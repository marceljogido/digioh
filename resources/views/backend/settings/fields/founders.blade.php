@php
    $defaultFounders = $field['value'] ?? [];
    $storedFounders = setting($field['name']);
    if (is_string($storedFounders)) {
        $storedFounders = json_decode($storedFounders, true);
    }
    $founders = old($field['name'], $storedFounders ?? $defaultFounders);
    if (! is_array($founders) || empty($founders)) {
        $founders = $defaultFounders;
    }
@endphp

<div class="form-group mt-3">
    <label class="form-label">
        <strong>{{ __($field['label']) }}</strong>
    </label>

    <div id="founders-container">
        @forelse($founders as $index => $founder)
            @include('backend.settings.partials.founder-card', ['index' => $index, 'founder' => $founder])
        @empty
            @include('backend.settings.partials.founder-card', ['index' => 0, 'founder' => []])
        @endforelse
    </div>

    <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-founder-button">
        <i class="fa fa-plus"></i> {{ __('Tambah Founder') }}
    </button>

    @php
        $prototype = view('backend.settings.partials.founder-card', ['index' => '__INDEX__', 'founder' => []])->render();
    @endphp
    <script type="text/template" id="founder-template">{!! $prototype !!}</script>
</div>

@once
    @push('after-scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const container = document.getElementById('founders-container');
                const templateEl = document.getElementById('founder-template');
                const addButton = document.getElementById('add-founder-button');

                if (!container || !templateEl || !addButton) {
                    return;
                }

                function renumberFounders() {
                    const items = container.querySelectorAll('.founder-item');
                    items.forEach((item, idx) => {
                        item.dataset.index = idx;
                        const heading = item.querySelector('[data-order]');
                        if (heading) {
                            const label = heading.getAttribute('data-label') || 'Founder';
                            heading.textContent = label + ' #' + (idx + 1);
                        }

                        item.querySelectorAll('[data-field]').forEach((input) => {
                            const field = input.getAttribute('data-field');
                            if (!field) {
                                return;
                            }
                            const name = `about_founders[${idx}][${field}]`;
                            const id = `about_founders_${idx}_${field}`;
                            input.setAttribute('name', name);
                            input.setAttribute('id', id);
                        });
                    });
                }

                function addFounder() {
                    const index = container.querySelectorAll('.founder-item').length;
                    const html = templateEl.innerHTML.replace(/__INDEX__/g, index);
                    const fragment = document.createRange().createContextualFragment(html);
                    container.appendChild(fragment);
                    renumberFounders();
                }

                addButton.addEventListener('click', function () {
                    addFounder();
                });

                container.addEventListener('click', function (event) {
                    const removeBtn = event.target.closest('[data-remove-founder]');
                    if (removeBtn) {
                        const item = removeBtn.closest('.founder-item');
                        if (item) {
                            item.remove();
                            renumberFounders();
                        }
                    }
                });

                renumberFounders();
            });
        </script>
    @endpush
@endonce
