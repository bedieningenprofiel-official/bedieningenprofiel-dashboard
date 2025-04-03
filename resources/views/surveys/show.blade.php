<x-app-layout>
    <div class="p-4">
        <div class="flex flex-col justify-center items-center w-full">
            <div class="border border-gray-200 w-1/2 rounded-md p-4">
                <div class="grid grid-cols-2 grid-rows-3 grid-flow-col gap-4">
                    <div class="flex flex-col items-start">
                        <label for="name" class="text-sm">Survey name</label>
                        <span id="name" class="text-xs mt-1">{{ $survey->name }}</span>
                    </div>
                    <div class="flex flex-col items-start">
                        <label for="description" class="text-sm">Description</label>
                        <span id="description" class="text-xs mt-1">{{ $survey->description }}</span>
                    </div>
                    <div class="flex flex-col items-start">
                        <label for="status" class="text-sm">Status</label>
                        <span id="status"
                            class="px-1 @if ($survey->status === 'active') bg-green-200 text-green-600 @elseif ($survey->status === 'inactive') bg-red-200 text-red-600 @else bg-orange-200 text-orange-600 @endif text-xs rounded-sm mt-1">{{ ucfirst($survey->status) }}</span>
                    </div>
                    <div class="flex flex-col items-start">
                        <label for="is-template" class="text-sm">Is a template</label>
                        <span id="is-template"
                            class="text-xs mt-1">{{ ucfirst($survey->is_template ? 'Yes' : 'No') }}</span>
                    </div>
                    <div class="flex flex-col items-start">
                        <label for="contains-excel" class="text-sm">Contains excel questions</label>
                        <span id="contains-excel"
                            class="text-xs mt-1">{{ ucfirst($survey->excel_file ? 'Yes' : 'No') }}</span>
                    </div>
                </div>
            </div>
            <livewire:create-questions :survey="$survey" />
        </div>
    </div>
</x-app-layout>
