{{-- @props([
    'name' => 'Category',
    'description' => '',
    'color' => 'green',
    'expenses' => 0,
    'amount' => '$0',
    'percent' => 0,
    'budget' => '$0'
]) --}}

@props([
    'category',
    'name' => 'Category',
    'description' => '',
    'color' => 'green',
    'expenses' => 0,
    'amount' => '₦0',
    'percent' => 0,
    'budget' => '₦0'
])


@php
$colors = [
    'green' => ['bg' => 'bg-green-500', 'rgb' => '34,197,94'],
    'blue' => ['bg' => 'bg-blue-500', 'rgb' => '59,130,246'],
    'yellow' => ['bg' => 'bg-yellow-500', 'rgb' => '234,179,8'],
    'purple' => ['bg' => 'bg-purple-500', 'rgb' => '168,85,247'],
    'pink' => ['bg' => 'bg-pink-500', 'rgb' => '236,72,153'],
    'cyan' => ['bg' => 'bg-cyan-500', 'rgb' => '6,182,212'],
    'red' => ['bg' => 'bg-red-500', 'rgb' => '239,68,68'],
];

$bgColor = $colors[$color]['bg'] ?? 'bg-green-500';
$rgb = $colors[$color]['rgb'] ?? '34,197,94';
@endphp


    <!-- Accent -->
   
    <div 
    class="group flex bg-gray-900 rounded-2xl overflow-hidden border border-gray-800 shadow transition-all duration-300 hover:scale-[1.02]"
    style="transition: box-shadow 0.3s ease;"
    onmouseover="this.style.boxShadow='0 0 25px rgba({{ $rgb }},0.45)'"
    onmouseout="this.style.boxShadow=''"
>

        <!-- Colored Left Side -->
        <div class="w-1 {{ $bgColor }}"></div>
    
        <!-- Card Content -->
        <div class="flex-1 p-5">
    
            <!-- Header -->
            <div class="flex justify-between items-start">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full {{ $bgColor }}"></span>
                    <h2 class="text-white font-semibold">{{ $name }}</h2>
                </div>
    
                <div class="flex gap-2">
                    {{-- <button class="text-gray-400 hover:text-white">✏️</button> --}}
                    <a href="{{ route('categories.edit', $category) }}">
                        ✏️
                    </a>
                    {{-- <button class="text-red-500 hover:text-red-600">🗑️</button> --}}

                      <!-- Delete -->
    <form action="{{ route('categories.destroy', $category) }}" method="POST"
    onsubmit="return confirm('Delete this category?')">
  @csrf
  @method('DELETE')

  <button type="submit" class="text-red-400 hover:text-red-600">
      🗑️
  </button>
</form>
                </div>
            </div>
    
            <!-- Description -->
            <p class="text-gray-400 text-sm mt-2">
                {{ $description }}
            </p>
    
            <!-- Stats -->
            <div class="flex justify-between items-center mt-4 text-sm">
                <span class="text-gray-400">{{ $expenses }} expenses</span>
                <span class="text-white font-semibold">{{ $amount }}</span>
            </div>
    
            <!-- Budget -->
            <div class="mt-3">
                <div class="flex justify-between text-xs text-gray-400 mb-1">
                    <span>Budget</span>
                    <span>{{ $percent }}% of {{ $budget }}</span>
                </div>
    
                <div class="w-full bg-gray-800 rounded-full h-2">
                    <div class="{{ $bgColor }} h-2 rounded-full" style="width: {{ $percent }}%"></div>
                </div>
            </div>
    
        </div>
    </div>
   

