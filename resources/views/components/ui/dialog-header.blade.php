@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'flex flex-col space-y-1.5 text-center sm:text-right mb-4 ' . $class]) }}>
    {{ $slot }}
</div>

