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

            <form class="space-y-4">

                <div>
                    <label class="text-sm text-gray-400">Category</label>
                    <select class="w-full mt-1 bg-gray-800 border-gray-700 rounded-lg">
                        <option>Food & Dining</option>
                        <option>Transportation</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm text-gray-400">Amount</label>
                    <input type="number" class="w-full mt-1 bg-gray-800 border-gray-700 rounded-lg">
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" @click="openModal = false" class="text-gray-400">
                        Cancel
                    </button>
                    <button class="bg-indigo-600 px-4 py-2 rounded-lg">
                        Save
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>