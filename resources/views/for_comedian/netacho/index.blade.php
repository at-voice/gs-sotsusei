<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Idea Words Index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- 並べ替えボタン -->
                    <div class="mb-4">
                        <a href="{{ route('idea_words.index_for_comedian', ['order' => 'latest']) }}" class="px-4 py-2 mr-4 font-semibold rounded transition duration-200 ease-in-out" style="background-color: #4F46E5; color: white;">
                            最新順
                        </a>
                        <a href="{{ route('idea_words.index_for_comedian', ['order' => 'random']) }}" class="px-4 py-2 font-semibold rounded transition duration-200 ease-in-out" style="background-color: #4F46E5; color: white;">
                            ランダム順
                        </a>
                    </div>

                    <!-- 投稿一覧 -->
                    <div class="list-padding-bottom">
                        <table class="text-center w-full border-collapse">
                            <thead>
                                <tr>
                                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">Idea Words</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($idea_words as $idea_word)
                                <tr class="hover:bg-grey-lighter">
                                    <td class="py-4 px-6 border-b border-grey-light">
                                        <h3 class="text-left font-bold text-lg text-grey-dark">{{$idea_word->content}}</h3>
                                        <div class="flex">
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- ネタ帳に書き込むボタン -->
                    <button type="button" class="mt-4 px-4 py-2 font-semibold rounded transition duration-200 ease-in-out" style="background-color: #4F46E5; color: white;">
                        ネタ帳に書き込む
                    </button>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>