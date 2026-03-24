@props(['name'])

@switch($name)

    @case('dashboard')
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13h8V3H3v10zM13 21h8v-6h-8v6zM13 3v6h8V3h-8zM3 21h8v-4H3v4z"/>
        </svg>
    @break

    @case('expenses')
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V4m0 12v4"/>
        </svg>
    @break

    @case('income')
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    @break

    @case('categories')
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M3 11l9-9 9 9-9 9-9-9z"/>
        </svg>
    @break

    @case('budgets')
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h13M9 5v6h13M5 5h.01M5 11h.01M5 17h.01"/>
        </svg>
    @break

    @case('settings')
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317a1 1 0 011.35-.447l1.2.693a1 1 0 00.95 0l1.2-.693a1 1 0 011.35.447l.693 1.2a1 1 0 000 .95l-.693 1.2a1 1 0 01-.447 1.35l-1.2.693a1 1 0 000 .95l1.2.693a1 1 0 01.447 1.35l-.693 1.2a1 1 0 00-.95 0l-1.2-.693a1 1 0 00-.95 0l-1.2.693a1 1 0 01-1.35-.447l-.693-1.2a1 1 0 000-.95l.693-1.2a1 1 0 01.447-1.35l1.2-.693a1 1 0 000-.95l-1.2-.693a1 1 0 01-.447-1.35l.693-1.2z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
    @break

    @case('balance')
<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V4m0 12v4"/>
</svg>
@break

@case('savings')
<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a5 5 0 00-10 0v2M5 9h14l-1 10H6L5 9z"/>
</svg>
@break

@endswitch