@props(['items' => []])

<div class="bg-gray-900 rounded-2xl p-6 shadow-lg text-white">
    <h3 class="text-lg font-semibold mb-4">Budget Status</h3>

    <div class="space-y-4">
        @foreach($items as $item)
        @php
            $spent = (float) $item['spent'];
            $total = (float) $item['total'];
            $hasBudget = $total > 0;
            $percentage = $hasBudget ? min(($spent/$total)*100,100) : 0;
            $overBudget = $hasBudget && $spent > $total;
        @endphp

        <div>
            <div class="flex justify-between text-sm mb-1">
                <span class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-{{ $item['color'] }}-500"></span>
                    {{ $item['name'] }}
                </span>
                <span class="text-gray-400">
                    {{-- ₦{{ number_format($spent, 2) }} --}}
                    {{ money($spent, 2) }}
                    @if($hasBudget)
                        {{-- / ₦{{ number_format($total, 2) }} --}}
                      /  {{ money($total, 2) }}
                    @else
                        <span class="text-yellow-400 text-xs">(No budget set)</span>
                    @endif
                </span>
            </div>

            @if($hasBudget)
            <div class="w-full bg-gray-700 h-2 rounded-full">
                <div class="h-2 rounded-full 
                    {{ $overBudget ? 'bg-red-500' : 'bg-' . $item['color'] . '-500' }}"
                    style="width: {{ $percentage }}%">
                </div>
            </div>
            {{-- <p class="text-xs mt-1 {{ $overBudget ? 'text-red-400' : 'text-gray-400' }}">
                {{ $overBudget 
                    ? 'Over budget by ₦' . number_format($spent - $total, 2)
                    : '₦' . number_format($total - $spent, 2) . ' remaining'
                }}
            </p> --}}
            <p class="text-xs mt-1 {{ $overBudget ? 'text-red-400' : 'text-gray-400' }}">
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