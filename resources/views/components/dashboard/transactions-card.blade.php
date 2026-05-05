@props(['transactions' => []])

<div 
    x-data="{ open: false, selected: {} }"
    class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white rounded-2xl p-6 shadow-md transition-all duration-300"
>

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
            Recent Transactions
        </h3>

        <span class="text-sm text-gray-500 dark:text-gray-400">
            Last {{ count($transactions) }} transactions
        </span>
    </div>

    <!-- Transactions List -->
    <div class="space-y-3">
        @foreach($transactions as $transaction)
            <div 
                @click="open = true; selected = {{ json_encode($transaction) }}"
                class="flex items-center justify-between border-b border-gray-200 dark:border-gray-800 px-3 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800/40 transition duration-200 cursor-pointer"
            >

                <!-- Left -->
                <div class="flex items-center gap-4">
                    
                    <!-- Icon -->
                    <div class="w-10 h-10 flex items-center justify-center rounded-full
                        {{ $transaction['type'] === 'income' 
                            ? 'bg-green-500/10 text-green-500' 
                            : 'bg-red-500/10 text-red-500' }}">
                        
                        {{ $transaction['type'] === 'income' ? '↓' : '↑' }}
                    </div>

                    <!-- Info -->
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            {{ $transaction['category'] }} • {{ $transaction['date'] }}
                        </p>
                        
                        @if(!empty($transaction['description']))
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                {{ $transaction['description'] }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- Amount -->
                <div class="font-semibold
                    {{ $transaction['type'] === 'income' 
                        ? 'text-green-500' 
                        : 'text-gray-800 dark:text-gray-200' }}">
                    
                    {{ $transaction['type'] === 'income' ? '+' : '-' }}
                    {{ money($transaction['amount'], 2) }}
                </div>
            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div 
        x-show="open"
        x-transition
        class="fixed inset-0 flex items-center justify-center bg-black/50 z-50"
    >

        <!-- Modal Content -->
        <div 
            @click.outside="open = false"
            class="bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 p-6 rounded-2xl w-full max-w-md text-gray-900 dark:text-white shadow-xl"
        >

            <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-200">
                Transaction Details
            </h2>

            <div class="space-y-2 text-sm">
                <p><span class="text-gray-500 dark:text-gray-400">Title:</span> <span x-text="selected.title"></span></p>
                <p><span class="text-gray-500 dark:text-gray-400">Category:</span> <span x-text="selected.category"></span></p>
                <p>
                    <span class="text-gray-500 dark:text-gray-400">Description:</span> 
                    <span x-text="selected.description || '—'"></span>
                </p>
                <p><span class="text-gray-500 dark:text-gray-400">Date:</span> <span x-text="selected.date"></span></p>
                <p>
                    <span class="text-gray-500 dark:text-gray-400">Amount:</span> 
                    ₦<span x-text="Number(selected.amount).toLocaleString()"></span>
                </p>
                <p>
                    <span class="text-gray-500 dark:text-gray-400">Type:</span> 
                    <span 
                        :class="selected.type === 'income' ? 'text-green-500' : 'text-red-500'"
                        x-text="selected.type"
                    ></span>
                </p>
            </div>

            <!-- Close Button -->
            <button 
                @click="open = false"
                class="mt-6 w-full bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700 transition rounded-lg py-2 text-gray-800 dark:text-gray-200"
            >
                Close
            </button>
        </div>

    </div>

</div>