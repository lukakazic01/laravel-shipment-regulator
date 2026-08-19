<?php

use App\Enums\AlertSeverity;
use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

new class extends Component {
    /**
     * @var Collection<int, User> $users
     */
    public Collection $users;

    public function mount(): void
    {
        $this->users = User::query()->hydrate(
            Cache::remember('users', 600, fn() => User::all()->toArray())
        )->reject(fn($user) => $user->id === auth()->id());
    }
};
?>

<div class="bg-white rounded border border-gray-200 overflow-hidden">
    <x-base.session-message :alert-severity="AlertSeverity::Success" />
    <table class="w-full text-sm">
        <thead>
        <tr class="border-b border-gray-200 bg-gray-50">
            <th class="text-left font-semibold text-secondary/50 uppercase tracking-wide text-xs px-6 py-3">Name</th>
            <th class="text-left font-semibold text-secondary/50 uppercase tracking-wide text-xs px-6 py-3">Email</th>
            <th class="text-left font-semibold text-secondary/50 uppercase tracking-wide text-xs px-6 py-3">Role</th>
            <th class="text-left font-semibold text-secondary/50 uppercase tracking-wide text-xs px-6 py-3">Actions</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
        @foreach ($users as $user)
            <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        <div
                            class="shrink-0 w-9 h-9 rounded-full bg-primary/10 text-primary font-semibold flex items-center justify-center text-xs uppercase">
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
                @can('admin-access')
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.profile.edit', $user->id) }}" class="text-primary font-semibold">
                            Edit
                        </a>
                    </td>
                @endcan
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
