<!-- resources/views/for_fan/our_work.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Work Info Index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- 投稿一覧 -->
                    <div class="list-padding-bottom">
                        <table class="text-center w-full border-collapse">
                            <thead>
                                <tr>
                                    <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">Work Info</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($work_infos as $work_info)
                                @for ($i = 1; $i <= 5; $i++) @if ($work_info["content{$i}_posted_by"]==auth()->user()->id)
                                    <tr class="hover:bg-grey-lighter">
                                        <td class="py-4 px-6 border-b border-grey-light">
                                            @php
                                            $content = $work_info->{"content{$i}"}->content ?? '';
                                            @endphp
                                            <h3 class="text-left font-bold text-lg text-grey-dark">{{ $content }}>>>{{ $work_info->title }}</h3>
                                            @php
                                            $video_id = '';
                                            if (preg_match('/(?:\?v=|\/embed\/|\.be\/)([\w-]+)?/', $work_info->video_url, $matches)) {
                                            $video_id = $matches[1];
                                            }
                                            @endphp

                                            <div class="flex justify-center">
                                                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $video_id }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                                            </div>

                                            <h3 class="text-center font-bold text-lg text-grey-dark">披露イベント情報</h3>
                                            <div class="w-full">
                                                <table class="w-full table-fixed border-collapse border border-gray-300">
                                                    <tbody>
                                                        <tr class="border-b border-gray-300">
                                                            <td class="w-1/6 p-2 font-bold">イベント名:</td>
                                                            <td class="w-5/6 p-2">{{ $work_info->event_name }}</td>
                                                        </tr>
                                                        <tr class="border-b border-gray-300">
                                                            <td class="w-1/6 p-2 font-bold">日時:</td>
                                                            <td class="w-5/6 p-2">{{ $work_info->event_date }}</td>
                                                        </tr>
                                                        <tr class="border-b border-gray-300">
                                                            <td class="w-1/6 p-2 font-bold">場所:</td>
                                                            <td class="w-5/6 p-2">{{ $work_info->event_location }}</td>
                                                        </tr>
                                                        <tr class="border-b border-gray-300">
                                                            <td class="w-1/6 p-2 font-bold">URL:</td>
                                                            <td class="w-5/6 p-2"><a href="{{ $work_info->event_info_url }}" class="text-blue-500">{{ $work_info->event_info_url }}</a></td>
                                                        </tr>
                                                        <tr class="border-b border-gray-300">
                                                            <td class="w-1/6 p-2 font-bold">種類:</td>
                                                            <td class="w-5/6 p-2">{{ $work_info->event_type }}</td>
                                                        </tr>
                                                        <tr class="border-b border-gray-300">
                                                            <td class="w-1/6 p-2 font-bold">主催:</td>
                                                            <td class="w-5/6 p-2">{{ $work_info->event_organizer }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            @php
                                            $content = $work_info->{"content{$i}"}->content ?? '';
                                            @endphp
                                            <p>{{ $content }}</p>
                                        </td>
                                    </tr>
                                    @endif
                                    @endfor
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>