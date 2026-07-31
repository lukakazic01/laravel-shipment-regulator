<x-layout>
    <div class="bg-white rounded border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
            <tr class="border-b border-gray-200 bg-gray-50">
                <th class="text-left font-semibold text-secondary/50 uppercase tracking-wide text-xs px-6 py-3">Name</th>
                <th class="text-left font-semibold text-secondary/50 uppercase tracking-wide text-xs px-6 py-3">Email</th>
                <th class="text-left font-semibold text-secondary/50 uppercase tracking-wide text-xs px-6 py-3">Role</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @foreach ($users as $user)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="shrink-0 w-9 h-9 rounded-full bg-primary/10 text-primary font-semibold flex items-center justify-center text-xs uppercase">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <span class="font-medium text-secondary">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-secondary/70">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded capitalize bg-primary/10 text-primary">
                            {{ $user->role }}
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
