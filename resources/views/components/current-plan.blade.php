<div class="bg-secondary-full dark:bg-primary-full border dark:border-primary-light w-full md:w-2/3 rounded-lg p-2">
    <h1 class="font-medium text-2xl dark:text-primary-shadWhite mb-1">
        {{ __('settings/index.headers.current_plan.header') }}
    </h1>
    <p class="font-light text-xs text-gray-400 italic">
        {{ __('settings/index.headers.current_plan.subheader') }}
    </p>

    <div class="flex items-center justify-between mt-4">
        <div>
            <span
                class="text-3xl font-bold dark:text-secondary-full">{{ __('settings/index.headers.current_plan.' . $user->activePlan()->name) }}</span>
            <p class="text-xs text-gray-400 italic mt-1">
                {{ __('settings/index.headers.current_plan.team_limit', [
                    'current_amount' => auth()->user()->ownedTeams()->count(),
                    'plan_limit' => $user->activePlan()->max_teams,
                ]) }}
            </p>
            @if (!auth()->user()->canCreateTeams())
                <p class="text-xs text-red-500 mt-1 italic">
                    {{ __('settings/index.headers.current_plan.team_limit_exceeded') }}
                </p>
            @endif
        </div>

        <x-button type="button"
            class="bg-primary-full hover:bg-primary-light dark:bg-primary-light text-white dark:text-primary-full rounded px-4 py-1.5 transition-colors">
            {{ __('settings/index.headers.current_plan.change_plan') }}
        </x-button>
    </div>
</div>
