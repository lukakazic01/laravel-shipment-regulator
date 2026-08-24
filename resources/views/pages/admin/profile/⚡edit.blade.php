<?php

use App\Mappers\SelectOptionsMapper;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Authorize;
use Livewire\Component;

new class extends Component {
    public User $user;
    public Collection $roles;
    public string $role = "";

    public function mount()
    {
        $this->roles = SelectOptionsMapper::toSelectOptions(User::ALLOWED_ROLES);
        $this->role = $this->user->role;
    }

    public function rules()
    {
        return [
            'role' => ['required', 'string', Rule::in(User::ALLOWED_ROLES)]
        ];
    }

    #[Authorize('admin-access')]
    public function assignNewRoleToUser(User $user)
    {
        $validated = $this->validate();
        $user->forceFill($validated)->save();
        return redirect()->route('admin.profile.index')->with('message', "Successfully changed role of $user->name to $this->role");
    }
};
?>

<div class="flex justify-center">
    <div class="w-full max-w-sm bg-white rounded-2xl border border-slate-200 shadow-sm">
        <div class="px-6 pt-6 pb-5 flex items-center gap-3 border-b border-slate-100">
            <div
                class="h-11 w-11 rounded-full bg-secondary text-white flex items-center justify-center font-medium text-sm">
                {{ ucfirst(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-sm font-semibold text-secondary">{{ $user->name }}</p>
                <p class="text-xs text-slate-500">User details</p>
            </div>
        </div>
        <div class="px-6 py-5 space-y-4">
            <div>
                <p class="text-[11px] uppercase tracking-wide text-slate-400">Name</p>
                <p class="text-sm text-slate-800">{{ $user->name }}</p>
            </div>

            <div>
                <p class="text-[11px] uppercase tracking-wide text-slate-400">Email</p>
                <p class="text-sm text-slate-800">{{ $user->email }}</p>
            </div>

            <div>
                <p class="text-[11px] uppercase tracking-wide text-slate-400">Current role</p>
                <p class="text-sm text-slate-800 first-letter:uppercase font-bold">{{ $user->role }}</p>
            </div>
        </div>
        <form wire:submit="assignNewRoleToUser({{ $user->id }})" class="px-6 pb-6 pt-2 border-t border-slate-100">
            @csrf
            <x-forms.field name="role" required>
                <x-forms.label>Roles</x-forms.label>
                <x-forms.select wire:model.blur="role" :values="$roles"/>
                <x-forms.error-message/>
            </x-forms.field>
            <x-base-button type="submit" class="w-full mt-4 py-1.5! bg-secondary!">Save role</x-base-button>
        </form>
    </div>
</div>

