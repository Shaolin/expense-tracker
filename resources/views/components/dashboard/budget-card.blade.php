@props(['items' => []])

@php
$colorMap = [
    'green' => 'bg-green-500',
    'red' => 'bg-red-500',
    'blue' => 'bg-blue-500',
    'yellow' => 'bg-yellow-500',
    'purple' => 'bg-purple-500',
];
@endphp

<div class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl p-6 shadow-md transition-all duration-300 text-gray-900 dark:text-white">
    
    <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">
        Budget Status
    </h3>

    <div class="space-y-4">
        @foreach($items as $item)
        @php
            $spent = (float) $item['spent'];
            $total = (float) $item['total'];
            $hasBudget = $total > 0;
            $percentage = $hasBudget ? min(($spent/$total)*100,100) : 0;
            $overBudget = $hasBudget && $spent > $total;

            $colorClass = $colorMap[$item['color']] ?? 'bg-blue-500';
        @endphp

        <div>
            <!-- Top Row -->
            <div class="flex justify-between text-sm mb-1">
                
                <span class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full {{ $colorClass }}"></span>
                    
                    <span class="text-gray-700 dark:text-gray-300">
                        {{ $item['name'] }}
                    </span>
                </span>

                <span class="text-gray-500 dark:text-gray-400">
                    {{ money($spent, 2) }}
                    
                    @if($hasBudget)
                        / {{ money($total, 2) }}
                    @else
                        <span class="text-yellow-500 dark:text-yellow-400 text-xs">
                            (No budget set)
                        </span>
                    @endif
                </span>
            </div>

            @if($hasBudget)
            <!-- Progress Bar -->
            <div class="w-full bg-gray-200 dark:bg-gray-700 h-2 rounded-full overflow-hidden">
                
                <div 
                    class="h-2 rounded-full transition-all duration-500 
                        {{ $overBudget ? 'bg-red-500' : $colorClass }}"
                    style="width: {{ $percentage }}%">
                </div>
            </div>

            <!-- Status Text -->
            <p class="text-xs mt-1 {{ $overBudget ? 'text-red-500' : 'text-gray-500 dark:text-gray-400' }}">
                @if ($overBudget)
                    Over budget by {{ money($spent - $total, 2) }}
                @else
                    {{ money($total - $spent, 2) }} remaining
                @endif
            </p>
            @endif
        </div>
        @endforeach
    </div>
</div>