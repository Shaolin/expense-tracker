<div 
    x-data="{ openModal: false }"
>
    <!-- Modal -->
    <div 
        x-show="openModal"
        class="fixed inset-0 bg-black/50 flex items-center justify-center z-50"
        style="display: none;"
    >
        <div class="bg-gray-900 text-white rounded-2xl p-6 w-full max-w-md">

            <h2 class="text-lg font-semibold mb-4">Set Budget</h2>

            <form method="POST" action="{{ route('budgets.store') }}">
                @csrf
            
                <select name="category_id" required>
                    @foreach(\App\Models\Category::where('user_id', auth()->id())->get() as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            
                <input type="number" name="amount" step="0.01" required>
            
                <input type="month" name="month" required>
            
                <button type="submit">Save Budget</button>
            </form>
        </div>
    </div>
</div>