<x-app-layout>
    <div class="p-4 z-0">
        <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-grow">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($surveys as $survey)
                        <a href="{{ route('surveys.show', $survey) }}"
                            class="inline-flex items-center @if ($survey->status === 'active') border-green-400 border-2 @else border-gray-200 border @endif rounded-lg py-2 px-4 w-full">
                            <div class="flex flex-col items-start">
                                <span class="text-sm">{{ $survey->name }}</span>
                                <span class="text-xs italic @if ($survey->status === 'active') text-green-400 @endif">
                                    {{ __('surveys/statuses.' . $survey->status) }}
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col">
                <div class="w-full md:w-64">
                    <a href="{{ route('surveys.create') }}"
                        class="inline-flex items-center border border-gray-200 rounded-lg px-4 py-1.5 w-full">
                        <x-lucide-plus class="w-5 h-5 mr-1" />
                        <span class="text-sm">{{ __('surveys/index.buttons.create') }}</span>
                    </a>
                </div>

                <div class="w-full md:w-64 flex-shrink-0 md:sticky md:top-4 self-start mt-2">
                    <div class="border border-gray-300 rounded-lg px-4 py-2">
                        <h2 class="text-lg font-semibold">Filters</h2>

                        <div class="space-y-4">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
