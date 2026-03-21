<x-layouts.app>

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <p class="text-gray-400">Overview of your financial activity this month</p>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        <x-stat-card 
            title="Total Income" 
            amount="$5,725.00" 
            change="+12.5% from last month"
        />

        <x-stat-card 
            title="Total Expenses" 
            amount="$1,073.02" 
            change="-8.2% from last month"
            :positive="false"
        />

        <x-stat-card 
            title="Current Balance" 
            amount="$4,651.98" 
            change=""
        />

        <x-stat-card 
            title="Savings Rate" 
            amount="81%" 
            change="+5.3% improvement"
        />

    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

        <!-- Chart Placeholder -->
        <div class="bg-white dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-gray-800 p-6 rounded-xl border">
            <h2 class="mb-4">Expenses by Category</h2>
            <div class="h-64 flex items-center justify-center text-gray-500">
                Chart goes here
            </div>
        </div>

        <!-- Budget -->
       
            <div class="bg-white dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-gray-800 p-6 rounded-xl border">
            <h2 class="mb-4">Budget Status</h2>

            <div class="space-y-4">

                <div>
                    <div class="flex justify-between text-sm">
                        <span>Food & Dining</span>
                        <span>$268 / $800</span>
                    </div>
                    <div class="w-full bg-gray-800 h-2 rounded mt-1">
                        <div class="bg-green-500 h-2 rounded w-1/3"></div>
                    </div>
                </div>

                <div>
                    <div class="flex justify-between text-sm">
                        <span>Transportation</span>
                        <span>$192 / $400</span>
                    </div>
                    <div class="w-full bg-gray-800 h-2 rounded mt-1">
                        <div class="bg-blue-500 h-2 rounded w-1/2"></div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Transactions -->
    {{-- <div class="mt-6 bg-gray-900 p-6 rounded-xl border border-gray-800"> --}}
    <div class="mt-6 bg-white dark:bg-gray-900 p-6 rounded-xl border border-gray-200 dark:border-gray-800 p-6 rounded-xl border">
        <h2 class="mb-4">Recent Transactions</h2>

        <div class="space-y-4">

            <div class="flex justify-between items-center">
                <div>
                    <p>Lunch delivery</p>
                    <p class="text-sm text-gray-400">Food & Dining • Mar 14</p>
                </div>
                <span class="text-red-500">-$24.99</span>
            </div>

            <div class="flex justify-between items-center">
                <div>
                    <p>Credit card rewards</p>
                    <p class="text-sm text-gray-400">Cashback • Mar 13</p>
                </div>
                <span class="text-green-500">+$50.00</span>
            </div>

        </div>
    </div>

</x-layouts.app>