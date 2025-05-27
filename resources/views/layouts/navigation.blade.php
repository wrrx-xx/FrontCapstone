@if(auth()->user()->isOwner())
    <x-nav-link :href="route('sales.index')" :active="request()->routeIs('sales.index')">
        {{ __('Sales Report') }}
    </x-nav-link>
@endif 