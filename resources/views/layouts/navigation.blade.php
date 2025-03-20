<nav class="hidden md:block sticky bg-secondary-full bg-white">
    <div class="p-4 flex justify-between items-center w-full">
        <div class="flex items-center space-x-4">
            <a href="{{ route('dashboard') }}">
                <span class="inline-flex items-center text-sm italic font-semibold">
                    <x-lucide-church class="ml-4 w-5 h-5 mr-1" />
                    {{ __('navigation/topbar.header') }}
                </span>
            </a>

            @can('create_church')
                <a href="{{ route('churches.create') }}">
                    <button
                        class="inline-flex items-center py-1 px-2 border border-gray-200 rounded-md hover:bg-gray-200 group">
                        <x-lucide-circle-fading-plus
                            class="w-4 h-4 mr-1 group-hover:w-5 group-hover:h-5 transition-all duration-100" />
                        <span
                            class="text-xs group-hover:text-sm transition-all duration-100">{{ __('navigation/topbar.links.create_church') }}</span>
                    </button>
                </a>
            @else
                <div x-data="{
                    open: false,
                    toggle() {
                        if (this.open) {
                            return this.close()
                        }

                        this.$refs.button.focus()

                        this.open = true
                    },
                    close(focusAfter) {
                        if (!this.open) return

                        this.open = false

                        focusAfter && focusAfter.focus()
                    }
                }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                    x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['current_team_dropdown']"
                    class="relative inline-block">
                    <button x-ref="button" x-on:click="toggle()" :aria-expanded="open"
                        :aria-controls="$id('current_team_dropdown')" type="button"
                        class="inline-flex items-center justify-between py-0.5 px-2 rounded-md hover:bg-gray-200 w-48 border border-slate-300">
                        <div class="inline-flex items-center">
                            <x-lucide-users class="w-3 h-3 mr-2" />
                            @if (auth()->user()->currentTeam)
                                <span class="text-sm">{{ auth()->user()->currentTeam->name }}</span>
                            @else
                                <span class="text-sm">{{ __('navigation/topbar.no_team_found') }}</span>
                            @endif
                        </div>
                        <x-lucide-separator-horizontal class="w-4 h-4" />
                    </button>

                    <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
                        :id="$id('current_team_dropdown')" x-cloak
                        class="origin-top-left absolute left-full top-0 mt-0 ml-2 w-48 border border-gray-300 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="options-menu">
                        <div class="p-1" role="none">
                            @can('view_any_attached_team')
                                @if (auth()->user()->ownedChurch()->exists())
                                    <div class="flex flex-col items-start">
                                        <div class="border-b border-gray-200 w-full py-1">
                                            <span class="px-2">{{ auth()->user()->church->church_name }}</span>
                                        </div>
                                        @if (auth()->user()->teams->count() > 0)
                                            @foreach (auth()->user()->teams as $userTeam)
                                                <form action="{{ route('teams.switch', $userTeam) }}" method="POST"
                                                    class="w-full mt-1">
                                                    @csrf
                                                    <button type="submit"
                                                        class="inline-flex items-center justify-between rounded-md hover:bg-gray-200 w-full px-2 py-1"
                                                        role="menuitem">
                                                        <span class="text-sm font-medium">{{ $userTeam->name }}</span>
                                                        @if (auth()->user()->current_team_id == $userTeam->id)
                                                            <x-lucide-circle-check class="w-4 h-4 text-emerald-500" />
                                                        @endif
                                                    </button>
                                                </form>
                                            @endforeach
                                        @else
                                            <span
                                                class="text-sm px-2 py-1 mt-1">{{ __('navigation/topbar.no_team_found') }}</span>
                                        @endif
                                    </div>
                                @endif
                            @endcan

                            <hr class="mt-1 mb-2" />

                            @can('create_teams')
                                <a href="{{ route('teams.create') }}"
                                    class="inline-flex items-center rounded-md hover:bg-gray-200 w-full px-2 py-1">
                                    <x-lucide-circle-plus class="w-4 h-4 mr-1" />
                                    <span class="text-sm font-medium">{{ __('navigation/topbar.links.new_team') }}</span>
                                </a>
                            @else
                                <a href=""
                                    class="inline-flex items-center rounded-md bg-emerald-500 hover:bg-emerald-700 w-full px-2 py-1 text-white">
                                    <x-lucide-book-plus class="w-4 h-4 mr-1" />
                                    <span class="text-sm">{{ __('navigation/topbar.links.upgrade_plan') }}</span>
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            @endcan
        </div>

        <div x-data="{
            open: false,
            toggle() {
                if (this.open) {
                    return this.close()
                }

                this.$refs.button.focus()

                this.open = true
            },
            close(focusAfter) {
                if (!this.open) return

                this.open = false

                focusAfter && focusAfter.focus()
            }
        }" x-on:keydown.escape.prevent.stop="close($refs.button)"
            x-on:focusin.window="! $refs.panel.contains($event.target) && close()" x-id="['user_dropdown']"
            class="relative inline-block">
            <button id="profile_button" @click="open = !open" class="flex items-center">
                <img src="{{ auth()->user()->defaultavatar() }}" class="w-8 h-8 object-cover rounded-full" />
            </button>

            <div x-ref="panel" x-show="open" x-transition.origin.top.left x-on:click.outside="close($refs.button)"
                :id="$id('user_dropdown')" x-cloak
                class="origin-top-right absolute right-full top-0 mt-3 mr-2 w-60 border border-gray-300 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                role="profile_menu" aria-orientation="vertical" aria-labelledby="profile-menu">
                <div class="p-1" role="none">
                    <div class="inline-flex items-center px-2 space-x-2">
                        <img src="{{ auth()->user()->defaultAvatar() }}" class="w-6 h-6 object-cover rounded-full" />
                        <div class="flex flex-col items-start">
                            <span class="text-sm font-semibold">
                                {{ auth()->user()->name }} ({{ auth()->user()->username }})
                            </span>
                            <span class="text-xs text-gray-400">{{ auth()->user()->email }}</span>
                        </div>
                    </div>

                    <hr class="mt-1 mb-1" />

                    <x-topbar-dropdown-tab href="{{ route('settings', auth()->user()) }}" icon="lucide-user-cog">
                        {{ __('navigation/topbar.user_dropdown.links.user_settings') }}
                    </x-topbar-dropdown-tab>
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf

                        <button type="submit"
                            class="inline-flex items-start w-full rounded-md hover:bg-red-300 px-2 py-1">
                            <x-lucide-log-out class="w-4 h-4 mr-2" />
                            <span class="text-sm">{{ __('navigation/topbar.user_dropdown.links.logout') }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="p-4">
        <div class="ml-4 space-x-4">
            <x-topbar-navigation-tab href="{{ route('dashboard') }}" active="{{ request()->routeIs('dashboard') }}">
                {{ __('navigation/topbar.tabs.dashboard') }}
            </x-topbar-navigation-tab>
            @can('view_current_team')
                <x-topbar-navigation-tab href="{{ route('teams.show', $currentTeam) }}"
                    active="{{ request()->routeIs('teams.show', $currentTeam) }}">
                    {{ __('navigation/topbar.tabs.teams') }}
                </x-topbar-navigation-tab>
            @endcan
        </div>
    </div>
</nav>

<nav class="block md:hidden p-4 flex justify-end">
    <div x-data="{ open: false }">
        <button id="mobile_navigation_hamburger" @click="open = !open" class="flex items-center">
            <x-lucide-menu class="w-6 h-6" />
        </button>

        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="fixed top-0 right-0 h-full w-full bg-white border-l border-gray-300 shadow-lg focus:outline-none z-50"
            style="display: none;" role="profile_menu" aria-orientation="vertical" aria-labelledby="profile-menu">
            <div class="h-full flex flex-col">
                <div class="px-4 py-6">
                    <button @click="open = false" class="focus:outline-none">
                        <x-lucide-square-x class="w-6 h-6" />
                    </button>
                </div>
                <div class="p-4 space-y-4">
                    <x-mobile-nav-tab href="{{ route('dashboard') }}" icon='lucide-layout-dashboard'
                        active="{{ request()->routeIs('dashboard') }}">
                        {{ __('navigation/topbar.tabs.dashboard') }}
                    </x-mobile-nav-tab>
                    @can('view_current_team')
                        <x-mobile-nav-tab href="{{ route('teams.show', $currentTeam) }}" icon='lucide-users'
                            active="{{ request()->routeIs('teams.show', $currentTeam) }}">
                            {{ __('navigation/topbar.tabs.teams') }}
                        </x-mobile-nav-tab>
                    @endcan
                </div>

                <div x-data="{ open: false }" class="mt-auto p-4 relative">
                    <div @click="open = !open">
                        <div
                            class="border-2 border-gray-200 rounded-md p-2 flex flex-row items-center justify-between hover:cursor-pointer">
                            <div class="inline-flex items-center space-x-2">
                                <img src="{{ auth()->user()->defaultavatar() }}"
                                    class="w-8 h-8 object-cover rounded-full" />
                                <div class="flex flex-col items-start">
                                    <span class="text-sm">
                                        {{ auth()->user()->name }} ({{ auth()->user()->username }})
                                    </span>
                                    <span class="text-gray-400 text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                            <x-lucide-separator-horizontal class="w-5 h-5" />
                        </div>
                    </div>

                    <div x-show="open" @click.away="open = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="origin-bottom-end absolute bottom-full border border-gray-300 right-4 w-11/12 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                        role="profile_menu" aria-orientation="vertical" aria-labelledby="profile-menu">
                        <div class="p-1" role="none">
                            <x-topbar-dropdown-tab href="{{ route('settings', auth()->user()) }}"
                                icon="lucide-user-cog">
                                {{ __('navigation/topbar.user_dropdown.links.user_settings') }}
                            </x-topbar-dropdown-tab>
                            <form action="{{ route('logout') }}" method="POST" class="w-full">
                                @csrf

                                <button type="submit"
                                    class="inline-flex items-center px-2 py-1.5 w-full rounded-md hover:bg-red-300">
                                    <x-lucide-log-out class="w-4 h-4 mr-2" />
                                    <span
                                        class="text-sm">{{ __('navigation/topbar.user_dropdown.links.logout') }}</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
