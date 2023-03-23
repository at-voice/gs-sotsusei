<!-- resources/views/for_fan/netacho/index.blade.php -->

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
                    <!-- 投稿フォーム -->
                    <form action="{{ route('idea_words.store') }}" method="POST" class="form-container mb-8"> <!-- 修正箇所：CSSクラスを追加し、マージンを設定 -->
                        @csrf
                        <textarea class="w-full p-2 mb-4 border border-gray-300 rounded" name="content" rows="2" placeholder="Write your idea words here..."></textarea>
                        <button type="submit" class="px-4 py-2 font-semibold rounded transition duration-200 ease-in-out" style="background-color: #4F46E5; color: white;">
                            Post Idea Words
                        </button>
                    </form>

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

                </div>
            </div>
        </div>
    </div>
</x-app-layout>