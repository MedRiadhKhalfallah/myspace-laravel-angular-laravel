<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'MaintenanceTN')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Maintenance TN Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
