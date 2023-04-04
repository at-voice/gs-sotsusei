<?php

namespace App\Http\Controllers;

use App\Models\WorkInfo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;


class WorkInfoController extends Controller
{
    // public function store(Request $request)
    // {
    //     Log::info('store method called');


    //     // バリデーション
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'content_ids' => 'required|string',
    //         'content_posted_by' => 'required|string',
    //         'video_url' => 'nullable|string',
    //         'event_name' => 'nullable|string',
    //         'event_date' => 'nullable|date',
    //         'event_location' => 'nullable|string',
    //         'event_info_url' => 'nullable|string',
    //         'event_type' => 'nullable|string',
    //         'event_organizer' => 'nullable|string',
    //     ]);

    //     // ログインユーザーのIDを取得
    //     $user_id = auth()->id();

    //     // content_idsとcontent_posted_byを取得
    //     $contentIds = array_map('intval', explode(',', $request->input('content_ids')));
    //     $contentPostedBy = array_map('intval', explode(',', $request->input('content_posted_by')));

    //     Log::info('Request data:', $request->all());
    //     Log::info('Creating work info with data:', [
    //         'user_id' => $user_id,
    //         'contentIds' => $contentIds,
    //         'contentPostedBy' => $contentPostedBy,
    //     ]);

    //     // ネタ情報を保存
    //     $workInfo = WorkInfo::create([
    //         'user_id' => $user_id,
    //         'title' => $request->input('title'),
    //         'content1_id' => $contentIds[0] ?? null,
    //         'content2_id' => $contentIds[1] ?? null,
    //         'content3_id' => $contentIds[2] ?? null,
    //         'content4_id' => $contentIds[3] ?? null,
    //         'content5_id' => $contentIds[4] ?? null,
    //         'content1_posted_by' => $contentPostedBy[0] ?? null,
    //         'content2_posted_by' => $contentPostedBy[1] ?? null,
    //         'content3_posted_by' => $contentPostedBy[2] ?? null,
    //         'content4_posted_by' => $contentPostedBy[3] ?? null,
    //         'content5_posted_by' => $contentPostedBy[4] ?? null,
    //         'video_url' => $request->input('video_url'),
    //         'event_name' => $request->input('event_name'),
    //         'event_date' => $request->input('event_date'),
    //         'event_location' => $request->input('event_location'),
    //         'event_info_url' => $request->input('event_info_url'),
    //         'event_type' => $request->input('event_type'),
    //         'event_organizer' => $request->input('event_organizer'),
    //     ]);

    //     Log::info('Work info created:', $workInfo->toArray());


    //     // リダイレクト
    //     return redirect()->route('neta_memos.my_memos_for_comedian')->with('success', 'ネタ情報が登録されました');
    // }

    public function store(Request $request)
    {
        // Log::info('store method called');
        // Log::info('Request data:', $request->all());

        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'content_ids' => 'required|string',
            'content_posted_by' => 'required|string',
            'video_url' => 'nullable|string',
            'event_name' => 'nullable|string',
            'event_date' => 'nullable|date',
            'event_location' => 'nullable|string',
            'event_info_url' => 'nullable|string',
            'event_type' => 'nullable|string',
            'event_organizer' => 'nullable|string',
        ]);

        // ログインユーザーのIDを取得
        $user_id = auth()->id();

        try {
            $work_info = new WorkInfo();
            $work_info->user_id = auth()->id();
            $work_info->title = $request->input('title');
            $work_info->video_url = $request->input('video_url');
            $work_info->event_name = $request->input('event_name');
            $work_info->event_date = $request->input('event_date');
            $work_info->event_location = $request->input('event_location');
            $work_info->event_info_url = $request->input('event_info_url');
            $work_info->event_type = $request->input('event_type');
            $work_info->event_organizer = $request->input('event_organizer');

            $content_ids = explode(',', $request->input('content_ids'));
            $content_posted_by = explode(',', $request->input('content_posted_by'));

            for ($i = 0; $i < 5; $i++) {
                if (isset($content_ids[$i])) {
                    $work_info["content" . ($i + 1) . "_id"] = $content_ids[$i];
                    $work_info["content" . ($i + 1) . "_posted_by"] = $content_posted_by[$i];
                } else {
                    $work_info["content" . ($i + 1) . "_id"] = null;
                    $work_info["content" . ($i + 1) . "_posted_by"] = null;
                }
            }

            $work_info->save();

            // Log::info('WorkInfo saved', ['work_info' => $work_info]);

            return redirect()->route('neta_memos.my_memos_for_comedian')
                ->with('success', 'データが登録されました。');
        } catch (\Exception $e) {
            Log::error('Failed to save WorkInfo', ['error' => $e->getMessage()]);
            return back()->withInput()->withErrors(['error' => 'データの登録に失敗しました。']);
        }
    }
}
