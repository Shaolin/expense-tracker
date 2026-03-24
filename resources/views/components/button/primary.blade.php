<button {{ $attributes->merge([
    'class' => 'bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition'
]) }}>
    {{ $slot }}
</button>