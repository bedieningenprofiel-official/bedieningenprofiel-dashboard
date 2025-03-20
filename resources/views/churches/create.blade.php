<x-app-layout>
    <div class="p-4 ml-4">
        <h1 class="text-xl font-semibold">Create a new church</h1>

        <form action="{{ route('churches.store') }}" method="POST" class="w-1/3">
            <div class="space-y-2 mt-2">
                <input class="py-1 rounded-md w-full" name="church_name" placeholder="Name" />
                <input class="py-1 rounded-md w-full" name="church_email" placeholder="Email" />
                <input class="py-1 rounded-md w-full" name="church_address" placeholder="Address" />
            </div>

            <button type="submit"
                class="mt-2 bg-primary-full w-full py-1 rounded-sm text-white font-semibold hover:bg-slate-700">
                Create
            </button>
        </form>
    </div>
</x-app-layout>
