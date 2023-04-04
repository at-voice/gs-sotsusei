<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NetaMemo;
use App\Models\IdeaWord;
use Illuminate\Support\Facades\Auth;


class NetaMemoController extends Controller
{
    public function store(Request $request)
    {
        // バリデーション(データや情報が正しい形式であるかどうかを確認するプロセス)
        $request->validate([
            'idea_word_ids' => 'required|array',
            'idea_word_ids.*' => 'integer',
            'remarks' => 'nullable|array',
            'remarks.*' => 'nullable|string|max:255',
        ]);

        // ログインユーザーのIDを取得
        $user_id = auth()->id();
        $ideaWordIds = $request->input('idea_word_ids');
        $remarks = $request->input('remarks');

        // 選択されたアイデアをネタ帳に保存
        foreach ($ideaWordIds as $index => $idea_word_id) {
            // アイデアワードを取得
            $idea_word = IdeaWord::find($idea_word_id);

            // ネタ帳に追加
            NetaMemo::create([
                'user_id' => $user_id, // ログインユーザーのID
                'idea_word_id' => $idea_word_id,
                'content' => $idea_word->content,
                'posted_by' => $idea_word->user_id, //アイディアワード投稿ユーザーのid
                'remarks' => isset($remarks[$idea_word_id]) ? $remarks[$idea_word_id] : null,
                // $remarks 配列のキーとして投稿のID ($idea_word_id) を使用して、各投稿に関連する remarks を取得.
                // もし、$remarks 配列にその投稿のIDが存在すれば、$remarks[$idea_word_id] をそのまま使用
                // もし存在しなければ、null を代入。
                // (条件式) ? (条件が真の場合の値) : (条件が偽の場合の値);

            ]);
        }

        // リダイレクト
        return redirect()->route('idea_words.index_for_comedian')->with('success', 'ネタメモが登録されました');
    }

    public function index_for_comedian(Request $request)
    {
        $order = $request->input('order', 'latest');

        if ($order === 'random') {
            $idea_words = IdeaWord::inRandomOrder()->paginate(10);
        } else {
            $idea_words = IdeaWord::latest()->paginate(10);
        }

        return view('for_comedian.netacho.index', compact('idea_words'));
    }

    // my memosを一覧表示
    public function my_memos_for_comedian(Request $request)
    {
        $user_id = auth()->id(); // 現在のログインユーザーのIDを取得
        $order = $request->input('order', 'new_to_old'); // デフォルトの並べ替え方法を'new_to_old'に設定

        if ($order === 'old_to_new') {
            $neta_memos = NetaMemo::where('user_id', $user_id)->orderBy('created_at', 'asc')->get();
        } elseif ($order === 'random') {
            $neta_memos = NetaMemo::where('user_id', $user_id)->inRandomOrder()->get();
        } else {
            $neta_memos = NetaMemo::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        }

        return view('for_comedian.netacho.my_memos', compact('neta_memos')); // my_memosビューにデータを渡す
    }
}
