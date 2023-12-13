<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ url('/')}}/img/logo2.png" class="logo" alt="FindProperty Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
