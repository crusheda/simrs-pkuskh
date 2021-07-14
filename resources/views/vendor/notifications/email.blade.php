@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
{{-- # {{ $greeting }} --}}
# @lang('Sistem Informasi Rumah Sakit PKU Muhammadiyah Sukoharjo')
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Halo Sedulur PKU!!')
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
<br>@lang('ttd'),<br>
@lang('Yussuf Faisal, S.Kom')<br>
@lang('Developer Simrsku')
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Jika terdapat masalah pada tombol \":actionText\", copy dan paste URL dibawah ini ke browser Anda,\n".
    'Berikut Link Reset Password:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
