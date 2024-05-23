@props(['type', 'useIcon' => false])

<span {{ $attributes->merge(['class' => 'badge ' . ($type ?? '')]) }}>
  @if ($useIcon)
    {!! $icon ?? '<span class="badge-point"></span>' !!}
  @endif
  {{ $slot }}
</span>
