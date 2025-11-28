@if(session(''flash_success''))
    <div class="mb-6 rounded-2xl border border-green-200 bg-green-50 p-4 text-green-800">
        {{ session(''flash_success'') }}
    </div>
@endif
