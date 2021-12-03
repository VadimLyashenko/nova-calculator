<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="excel-1" name="excel-1">
                        <br>
                        <button class="p-3 mt-3 bg-green-400 hover:bg-green-300 text-white shadow-sm">Import data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
