<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('ネタ帳') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- 並べ替えボタン -->
                    <div class="mb-4">
                        <a href="{{ route('neta_memos.my_memos_for_comedian', ['order' => 'new_to_old']) }}" class="px-4 py-2 mr-4 font-semibold rounded transition duration-200 ease-in-out" style="background-color: #4F46E5; color: white;">
                            登録した順(new→old)
                        </a>
                        <a href="{{ route('neta_memos.my_memos_for_comedian', ['order' => 'old_to_new']) }}" class="px-4 py-2 mr-4 font-semibold rounded transition duration-200 ease-in-out" style="background-color: #4F46E5; color: white;">
                            登録した順(old→new)
                        </a>
                        <a href="{{ route('neta_memos.my_memos_for_comedian', ['order' => 'random']) }}" class="px-4 py-2 font-semibold rounded transition duration-200 ease-in-out" style="background-color: #4F46E5; color: white;">
                            ランダム順
                        </a>
                    </div>


                    <!-- 投稿一覧 -->
                    <form action="{{ route('neta_memos.store') }}" method="POST">
                        @csrf
                        <div class="list-padding-bottom">
                            <table class="text-center w-full border-collapse">
                                <thead>
                                    <tr>
                                        <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">Idea Words</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($neta_memos as $neta_memo)
                                    @if ($neta_memo->user_id == auth()->user()->id)
                                    <tr class="hover:bg-grey-lighter">
                                        <td class="py-4 px-6 border-b border-grey-light">
                                            <div class="flex items-center space-x-4">
                                                <!-- <input type="checkbox" name="neta_memo_ids[]" value="{{ $neta_memo->id }}" class="mt-1" onclick="addContentToNetaInfo(this, `{!! addslashes($neta_memo->content) !!}`, '{{ $neta_memo->id }}', '{{ $neta_memo->posted_by }}')"> -->
                                                <input type="checkbox" class="form-check-input neta-checkbox" data-idea-word-id="{{ $neta_memo->idea_word_id }}" data-posted-by="{{ $neta_memo->posted_by }}" id="netaCheckbox{{ $neta_memo->id }}" onchange="checkboxOnChange(this)">

                                                <h3 class="text-left font-bold text-lg text-grey-dark">{{ $neta_memo->content }}</h3>
                                                <div>
                                                    <textarea id="remarks-{{ $neta_memo->id }}" name="remarks[{{ $neta_memo->id }}]" placeholder="メモ" rows="1" cols="30" class="w-full p-2 border rounded-md">{{ $neta_memo->remarks }}</textarea>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>


                            </table>
                        </div>

                        <!-- ネタ帳に書き込むボタン -->
                        <!-- <button type="submit" class="mt-4 px-4 py-2 font-semibold rounded transition duration-200 ease-in-out" style="background-color: #4F46E5; color: white;">
                            ネタ帳に書き込む
                        </button> -->
                    </form>

                    <!-- ネタ情報登録フォーム -->
                    <form action="{{ route('work_infos.store') }}" method="post" class="mt-8 p-4 bg-white shadow-md">
                        @csrf
                        <div class="mb-4">
                            <label for="selected_contents" class="block mb-2">チェックしたコンテンツ:</label>
                            <textarea name="selected_contents" id="selected_contents" class="flex-grow border-none rounded py-2 px-3 mr-4" style="border:none; width: calc(100% - 160px);" readonly></textarea>
                            <input type="hidden" name="content_ids" id="content_ids">
                            <input type="hidden" name="content_posted_by" id="content_posted_by">
                        </div>


                        <div class="mb-4">
                            <label for="title" class="block mb-2">タイトル:</label>
                            <input type="text" name="title" id="title" class="w-full border rounded py-2 px-3" placeholder="タイトルを入力してください">
                        </div>

                        <div class="mb-4">
                            <label for="video_url" class="block mb-2">YouTube URL:</label>
                            <input type="text" name="video_url" id="video_url" class="w-full border rounded py-2 px-3" placeholder="YouTube URLを入力してください">
                        </div>
                        <!-- 以下、イベント情報関連の入力フィールドを追加 -->
                        <div class="mb-4">
                            <label for="event_name" class="block mb-2">イベント名:</label>
                            <input type="text" name="event_name" id="event_name" class="w-full border rounded py-2 px-3" placeholder="イベント名を入力してください">
                        </div>
                        <div class="mb-4">
                            <label for="event_date" class="block mb-2">イベント日時:</label>
                            <input type="datetime-local" name="event_date" id="event_date" class="w-full border rounded py-2 px-3">
                        </div>
                        <div class="mb-4">
                            <label for="event_location" class="block mb-2">イベント場所:</label>
                            <input type="text" name="event_location" id="event_location" class="w-full border rounded py-2 px-3" placeholder="イベント場所を入力してください">
                        </div>
                        <div class="mb-4">
                            <label for="event_info_url" class="block mb-2">イベント情報URL:</label>
                            <input type="text" name="event_info_url" id="event_info_url" class="w-full border rounded py-2 px-3" placeholder="イベント情報URLを入力してください">
                        </div>
                        <div class="mb-4">
                            <label for="event_type" class="block mb-2">イベントタイプ:</label>
                            <input type="text" name="event_type" id="event_type" class="w-full border rounded py-2 px-3" placeholder="イベントタイプを入力してください">
                        </div>
                        <div class="mb-4">
                            <label for="event_organizer" class="block mb-2">イベント主催者:</label>
                            <input type="text" name="event_organizer" id="event_organizer" class="w-full border rounded py-2 px-3" placeholder="イベント主催者を入力してください">
                        </div>

                        <!-- 送信ボタン -->
                        <div class="flex items-center justify-between">
                            <button type="submit" class="mt-4 px-4 py-2 font-semibold rounded transition duration-200 ease-in-out" style="background-color: #4F46E5; color: white;">
                                ネタ情報を登録
                            </button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        // function addContentToNetaInfo(checkbox, content, contentId, postedBy) {
        //     const selectedContentsTextarea = document.getElementById("selected_contents");
        //     const contentIdsInput = document.getElementById("content_ids");
        //     const contentPostedByInput = document.getElementById("content_posted_by");

        //     if (checkbox.checked) {
        //         // チェックされた場合、contentを追加
        //         if (selectedContentsTextarea.value === '') {
        //             selectedContentsTextarea.value = content;
        //             contentIdsInput.value = contentId;
        //             contentPostedByInput.value = postedBy;
        //         } else {
        //             selectedContentsTextarea.value += '\n' + content;
        //             contentIdsInput.value += ',' + contentId; // 修正された箇所
        //             contentPostedByInput.value += ',' + postedBy;
        //         }
        //     } else {
        //         // チェックが外された場合、contentを削除
        //         const contents = selectedContentsTextarea.value.split('\n');
        //         const contentIds = contentIdsInput.value.split(',');
        //         const contentPostedBys = contentPostedByInput.value.split(',');

        //         const index = contentIds.indexOf(contentId.toString()); // 変更
        //         if (index > -1) {
        //             contents.splice(index, 1);
        //             contentIds.splice(index, 1);
        //             contentPostedBys.splice(index, 1);
        //         }

        //         selectedContentsTextarea.value = contents.join('\n');
        //         contentIdsInput.value = contentIds.join(',');
        //         contentPostedByInput.value = contentPostedBys.join(',');
        //     }

        //     console.log('contentIds:', contentIdsInput.value);
        //     console.log('contentPostedBys:', contentPostedByInput.value);
        //     console.log('contentId:', contentId);
        //     console.log('postedBy:', postedBy); // contentPostedBys ではなく postedBy に変更

        // }

        let contentIds = [];
        let contentPostedBys = [];
        const contentIdsInput = document.getElementById("content_ids");
        const contentPostedByInput = document.getElementById("content_posted_by");

        function checkboxOnChange(checkboxElem) {
            // チェックボックスの data-idea-word-id と data-posted-by 属性から値を取得
            const contentId = checkboxElem.dataset.ideaWordId;
            const postedBy = checkboxElem.dataset.postedBy;
            const content = checkboxElem.parentElement.querySelector("h3").textContent;
            const selectedContentsTextarea = document.getElementById("selected_contents");

            if (checkboxElem.checked) {
                contentIds.push(contentId);
                contentPostedBys.push(postedBy);

                // チェックされた場合、contentを追加
                if (selectedContentsTextarea.value === '') {
                    selectedContentsTextarea.value = content;
                } else {
                    selectedContentsTextarea.value += '\n' + content;
                }
            } else {
                contentIds = contentIds.filter(id => id !== contentId);
                contentPostedBys = contentPostedBys.filter(id => id !== postedBy);

                // チェックが外された場合、contentを削除
                const contents = selectedContentsTextarea.value.split('\n');
                const index = contents.indexOf(content);
                if (index > -1) {
                    contents.splice(index, 1);
                }
                selectedContentsTextarea.value = contents.join('\n');
            }

            contentIdsInput.value = contentIds.join(',');
            contentPostedByInput.value = contentPostedBys.join(',');

            console.log('contentId:', contentId);
            console.log('contentIds:', contentIdsInput.value);

            console.log('postedBy:', postedBy);
            console.log('contentPostedBys:', contentPostedByInput.value);
        }
    </script>


</x-app-layout>