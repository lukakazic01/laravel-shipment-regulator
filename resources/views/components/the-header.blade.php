@php use App\Models\Shipment; @endphp
<header class="relative bg-secondary">
    <div class="relative max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-2.5">
            <span class="flex items-center justify-center w-8 h-8 rounded-lg bg-primary shadow-lg shadow-orange-900/30">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round" class="w-4.5 h-4.5">
                    <path
                        d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/>
                    <path d="m3.3 7 8.7 5 8.7-5"/>
                    <path d="M12 22V12"/>
                </svg>
            </span>
            <span class="text-white font-semibold tracking-tight">{{ config('app.name') }}</span>
        </a>

        <nav class="hidden sm:flex items-center gap-8 text-sm font-medium text-slate-300">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <a href="{{ route('shipments.index') }}" class="hover:text-white transition-colors">Shipments</a>
            @can('create', Shipment::class)
                <a href="{{ route('shipments.create') }}" class="hover:text-white transition-colors">Create shipment</a>
            @endcan
        </nav>

        @auth
            <div class="flex items-center gap-4">
                <a href="{{ route('profile.index') }}"
                   class="font-medium text-primary hover:text-[#FF7F1F] transition-colors">Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-4">
                    @csrf
                    <button type="submit" class="font-medium text-primary hover:text-[#FF7F1F] transition-colors">
                        Log out
                    </button>
                </form>
            </div>
        @else
            <div class="flex items-center gap-4">
                <a href="{{ route('register') }}"
                   class="font-medium text-primary hover:text-[#FF7F1F] transition-colors">
                    Register
                </a>
                <a href="{{ route('login') }}"
                   class="font-medium text-primary hover:text-[#FF7F1F] transition-colors">
                    Login
                </a>
            </div>
        @endauth
    </div>
</header>
