@props(['percentage', 'color'])

<div class="w-full">
    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
        <div 
            class="{{ $color }} h-2 rounded-full transition-all duration-300"
            style="width: {{ $percentage }}%">
        </div>
    </div>

    <div class="text-xs text-gray-500 mt-1 text-right">
        {{ round($percentage) }}%
    </div>
</div>