<div x-data="{ open: false }" class="relative">
    
    <div x-data="{ open: false }" class="relative">
        <button @click="open = !open" 
                class="flex items-center gap-2 px-3 py-2 rounded-lg w-full
                       bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white">
            {{ auth()->user()->organizations()->where('organizations.id', session('organization_id'))->first()->name }}
            <x-icon name="chevron-down" />
        </button>
    </div>

    <div x-show="open" @click.outside="open = false"
         class="absolute mt-1 w-full bg-white dark:bg-gray-900 rounded-lg shadow-lg z-50">
        @foreach(auth()->user()->organizations as $org)
            <form action="{{ route('organizations.switch') }}" method="POST">
                @csrf
                <input type="hidden" name="organization_id" value="{{ $org->id }}">
                <button type="submit"
                        class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-800
                               {{ session('organization_id') == $org->id ? 'font-semibold' : '' }}">
                    {{ $org->name }} 
                    @if($org->is_personal) (Personal) @endif
                </button>
            </form>
        @endforeach
    </div>
</div>
