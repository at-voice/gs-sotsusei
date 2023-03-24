<!-- resources/views/for_comedian/netacho/index.blade.php -->

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
                    <!-- 投稿一覧 -->
                    <div class="list-padding-bottom">
                        <div class="grid grid-cols-1 gap-4">
                            @foreach ($idea_words as $idea_word)
                            <div class="border-2 border-blue-600 rounded-2xl p-4 cursor-pointer select-none idea-word" data-id="{{ $idea_word->id }}" data-user-id="{{ $idea_word->user_id }}" onclick="toggleSelected(this)">
                                <h3 class="text-left font-bold text-lg text-grey-dark">{{ $idea_word->content }}</h3>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- ネタ帳に書くボタン -->
                    <div class="mt-6">
                        <button class="px-4 py-2 font-semibold rounded transition duration-200 ease-in-out" style="background-color: #4F46E5; color: white;" onclick="addToMyNetacho()">
                            ネタ帳に書く
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('scripts')

    <script>
        let selected = [];

        function toggleSelected(element) {
            const isSelected = element.classList.contains('bg-blue-600');
            const maxSelections = 5;

            if (isSelected) {
                element.classList.remove('bg-blue-600');
                element.classList.remove('text-white');
                selected = selected.filter(e => e.id !== element.dataset.id);
            } else {
                if (selected.length < maxSelections) {
                    element.classList.add('bg-blue-600');
                    element.classList.add('text-white');
                    selected.push({
                        id: element.dataset.id,
                        user_id: element.dataset.userId
                    });
                }
            }
        }

        async function addToMyNetacho() {
            const url = '/my_netacho_lists'; // このURLを実際のルートに置き換えてください
            const currentDate = new Date().toISOString().slice(0, 10);
            const loggedInUserId = "{{ Auth::id() }}";

            try {
                const promises = selected.map(ideaWord => {
                    return fetch(url, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            idea_word_id: ideaWord.id,
                            idea_word_user_id: ideaWord.user_id,
                            written_date: currentDate,
                            user_id: loggedInUserId
                        })
                    });
                });

                await Promise.all(promises);
                alert('ネタ帳に追加しました。 ');
            } catch (error) {
                console.error(error);
                alert('エラーが発生しました。もう一度お試しください。');
            }
        }
    </script>
    @endsection

    @section('styles')
    <style>
        .idea-word:hover {
            background-color: rgba(75, 85, 99, 0.1);
        }

        .bg-blue-600.text-white:hover {
            background-color: #4F46E5;
        }
    </style>
    @endsection

</x-app-layout>