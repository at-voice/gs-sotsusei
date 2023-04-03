<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Memos') }}
        </h2>
    </x-slot>

    <!-- 芸人会員が自分が登録したワード一覧が表示される -->

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="list-padding-bottom">
                        <table class="text-center w-full border-collapse">
                            <thead>
                                <tr>
                                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">My Memos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($my_memos as $memo)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        <div class="flex items-center space-x-4">
                                            <input type="checkbox" name="selected_memos[]" value="{{ $memo->id }}" class="mt-1">
                                            <h3 class="text-left font-bold text-lg text-grey-dark">{{ $memo->content }}</h3>
                                            <div>
                                                <label for="remarks-{{ $memo->id }}" class="block text-sm font-bold">備考:</label>
                                                <textarea id="remarks-{{ $memo->id }}" name="remarks[{{ $memo->id }}]" rows="1" cols="30" class="w-full p-2 border rounded-md" readonly>{{ $memo->remarks }}</textarea>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>