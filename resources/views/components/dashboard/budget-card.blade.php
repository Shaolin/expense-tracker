@props(['items' => []])

<div class="bg-gray-900 rounded-2xl p-6 shadow-lg text-white">
    <h3 class="text-lg font-semibold mb-4">Budget Status</h3>

    <div class="space-y-4">
        @foreach($items as $item)
            @php
                $percentage = ($item['spent'] / $item['total']) * 100;
            @endphp

            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-{{ $item['color'] }}-500"></span>
                        {{ $item['name'] }}
                    </span>
                    <span class="text-gray-400">
                        ${{ $item['spent'] }} / ${{ $item['total'] }}
                    </span>
                </div>

                <div class="w-full bg-gray-700 h-2 rounded-full">
                    <div 
                        class="h-2 rounded-full bg-{{ $item['color'] }}-500"
                        style="width: {{ $percentage }}%">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>