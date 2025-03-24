<x-app-layout>
    <div class="p-4">
        <div class="grid grid-cols-3 gap-4">
            @foreach ($allTeams as $team)
                <div class="border border-gray-200 rounded-md py-2 px-4">
                    <div class="flex flex-row justify-between">
                        <div class="flex flex-col items-start space-y-1">
                            <span class="font-semibold text-sm inline-flex items-center">
                                <x-lucide-users class="w-4 h-4 mr-2" />
                                {{ $team->name }}
                            </span>
                            <span class="text-ellipsis text-slate-400 text-xs inline-flex items-center">
                                {{ $team->description }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-1">
                        <span class="text-xs text-slate-400 italic">
                            {{ trans_choice('teams/admin/show-all.member_count', $team->members()->count(), ['count' => $team->members()->count()]) }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
