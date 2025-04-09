<div class="mt-4 w-1/2">
    <x-filament::tabs x-data="{
        activeTab: '{{ request()->query('tab', 'manual') }}',
        setActiveTab(tab) {
            this.activeTab = tab;

            const url = new URL(window.location.href);
            url.searchParams.set('tab', tab);
            history.pushState({}, '', url);
        }
    }" class="flex flex-col">
        <div class="flex flex-row items-center p-2">
            <x-filament::tabs.item alpine-active="activeTab === 'manual'" x-on:click="setActiveTab('manual')">
                <span>{{ __('surveys/show.filament_tabs.manual') }}</span>
            </x-filament::tabs.item>
            <x-filament::tabs.item alpine-active="activeTab === 'excelImport'" x-on:click="setActiveTab('excelImport')"
                class="ml-1">
                <span>{{ __('surveys/show.filament_tabs.excel') }}</span>

                <x-slot name="badge">
                    {{ __('surveys/show.filament_tabs.badges.experimental') }}
                </x-slot>
            </x-filament::tabs.item>
        </div>

        <div class="flex flex-col mt-4 p-2">
            <div x-show="activeTab === 'manual'" x-cloak>
                {{ $this->surveyQuestionsForm }}
            </div>
            <div x-show="activeTab === 'excelImport'" x-cloak>
                <form action="{{ route('surveys.upload.excel', $survey) }}" method="POST">
                    @csrf

                    <input type="file" name="excel_file" class="filepond" enctype="multipart/form-data" />

                    <button type="submit"
                        class="bg-slate-800 w-full items-center text-white mt-6 py-2 rounded-md text-sm">
                        Upload Excel File
                    </button>
                </form />
            </div>
        </div>
    </x-filament::tabs>
</div>
