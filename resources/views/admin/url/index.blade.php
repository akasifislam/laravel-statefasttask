<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-bold">Url</h2>
                        <!-- Create Button -->
                        <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            href="{{ route('urls.create') }}">
                            Create
                        </a>
                    </div>
                    <table class="min-w-full table-auto bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">Original Url</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">short Code</th>
                                <th class="px-4 py-2 text-left text-gray-600 font-medium">click_count</th>
                                <th class="px-4 py-2 text-center text-gray-600 font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Row -->
                            @foreach ($urls as $url)
                                <tr class="border-t">
                                    <td class="px-4 py-2">
                                        {{ $url->original_url }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <a target="_blank" href="{{ url($url->short_code) }}"
                                            class="text-blue-600 hover:underline">
                                            {{ $url->short_code }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-2">
                                        {{ $url->click_count }}
                                    </td>
                                    <td class="px-4 py-2 text-center">
                                        <form action="{{ route('urls.destroy', $url) }}" method="POST"
                                            class="inline-block ml-4">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- More rows can be added here -->
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
