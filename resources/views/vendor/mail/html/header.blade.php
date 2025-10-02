@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'DigiOH')
<img src="{{ asset('img/logo-with-text.jpg') }}" class="logo" alt="DigiOH Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
