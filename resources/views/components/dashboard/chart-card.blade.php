@props(['data' => []])


    <div class="bg-gray-900 rounded-2xl p-6 shadow-lg text-white">
    <h3 class="text-lg font-semibold mb-4">Expenses by Category</h3>

    <div class="flex flex-col lg:flex-row items-center justify-center gap-6">
        
            
             
                <!-- Chart (centered properly) -->
                <div class="flex justify-center w-full lg:w-auto">
                    <div class="w-72 h-72">
                        <canvas id="expenseChart"></canvas>
                    </div>
                </div>

       
        <div class="space-y-2 text-sm">
            @foreach($data as $item)
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 bg-{{ $item['color'] }}-500 rounded-full"></span>
                    {{ $item['name'] }}
                </div>
            @endforeach
        </div>
    </div>
</div>

