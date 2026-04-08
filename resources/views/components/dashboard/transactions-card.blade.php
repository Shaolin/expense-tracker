@props(['transactions' => []])

<div 
    x-data="{ open: false, selected: {} }"
    class="bg-gray-900 rounded-2xl p-6 shadow-lg text-white"
>

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold">Recent Transactions</h3>
        <span class="text-sm text-gray-400">
            Last {{ count($transactions) }} transactions
        </span>
    </div>

    <!-- Transactions List -->
    <div class="space-y-3">
        @foreach($transactions as $transaction)
            <div 
                @click="open = true; selected = {{ json_encode($transaction) }}"
                class="flex items-center justify-between border-b border-gray-800 px-3 py-3 rounded-lg hover:bg-gray-800/40 transition duration-200 cursor-pointer"
            >

                <!-- Left -->
                <div class="flex items-center gap-4">
                    
                    <!-- Icon -->
                    <div class="w-10 h-10 flex items-center justify-center rounded-full
                        {{ $transaction['type'] === 'income' ? 'bg-green-500/10 text-green-400' : 'bg-red-500/10 text-red-400' }}">
                        
                        {{ $transaction['type'] === 'income' ? '↓' : '↑' }}
                    </div>

                    <!-- Info -->
                    <div>
                        {{-- <p class="font-medium">{{ $transaction['title'] }}</p>
                        <p class="text-sm text-gray-400">
                            {{ $transaction['category'] }} • {{ $transaction['date'] }}
                        </p> --}}
                        <p class="text-sm text-gray-400">
                            {{ $transaction['category'] }} • {{ $transaction['date'] }}
                        </p>
                        
                        @if(!empty($transaction['description']))
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $transaction['description'] }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Amount -->
                <div class="font-semibold
                    {{ $transaction['type'] === 'income' ? 'text-green-400' : 'text-gray-200' }}">
                    
                    {{ $transaction['type'] === 'income' ? '+' : '-' }}
                  
                    ₦{{ number_format($transaction['amount'], 2) }}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div 
        x-show="open"
        x-transition
        class="fixed inset-0 flex items-center justify-center bg-black/70 z-50"
    >

        <!-- Modal Content -->
        <div 
            @click.outside="open = false"
            class="bg-gray-900 p-6 rounded-2xl w-full max-w-md text-white shadow-xl"
        >

            <h2 class="text-xl font-bold mb-4">Transaction Details</h2>

            <div class="space-y-2 text-sm">
                <p><span class="text-gray-400">Title:</span> <span x-text="selected.title"></span></p>
                <p><span class="text-gray-400">Category:</span> <span x-text="selected.category"></span></p>
                <p>
                    <span class="text-gray-400">Description:</span> 
                    <span x-text="selected.description || '—'"></span>
                </p>
                <p><span class="text-gray-400">Date:</span> <span x-text="selected.date"></span></p>
                <p>
                    <span class="text-gray-400">Amount:</span> 
                    {{-- $<span x-text="selected.amount"></span> --}}
                    ₦<span x-text="Number(selected.amount).toLocaleString()"></span>
                </p>
                <p>
                    <span class="text-gray-400">Type:</span> 
                    <span 
                        :class="selected.type === 'income' ? 'text-green-400' : 'text-red-400'"
                        x-text="selected.type"
                    ></span>
                </p>
            </div>

            <!-- Close Button -->
            <button 
                @click="open = false"
                class="mt-6 w-full bg-gray-800 hover:bg-gray-700 transition rounded-lg py-2"
            >
                Close
            </button>
        </div>

    </div>

</div>