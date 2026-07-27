<footer class="bg-secondary">
    <div class="max-w-6xl mx-auto px-6 py-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-slate-400">
        <span>&copy; {{ now()->year }} {{ config('app.name') }}</span>
        <a href="{{ route('home') }}" class="font-medium text-primary hover:text-[#FF7F1F] transition-colors">
            Track a shipment &rarr;
        </a>
    </div>
</footer>
