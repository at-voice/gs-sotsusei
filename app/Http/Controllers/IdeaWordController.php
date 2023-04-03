<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdeaWord; //ファン会員の投稿データを扱う
use Illuminate\Support\Facades\Auth;

class IdeaWordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_for_fan()
    {
        //
        $idea_words = IdeaWord::where('user_id', Auth::id())->latest()->get();
        return view('for_fan.netacho.index', compact('idea_words'));
    }
    //ファン会員のnetacho/indexに一覧表示する

    public function index_for_comedian(Request $request)
    {
        $order = $request->input('order');

        if ($order === 'random') {
            // 芸人向けの一覧はランダム順で表示し、すべての投稿を取得
            $idea_words = IdeaWord::inRandomOrder()->paginate(10);
        } else {
            // 芸人向けの一覧は最新順で表示し、すべての投稿を取得
            $idea_words = IdeaWord::latest()->paginate(10);
        }
        return view('for_comedian.netacho.index', compact(
            'idea_words',
            'order'
        ));
    }
    //芸人会員のnetacho/indexに一覧表示する（新着順・ランダム）

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'content' => 'required'
        ]);

        IdeaWord::create([
            'content' => $request->content,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('idea_words.index_for_fan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $idea_word = IdeaWord::findOrFail($id);
        return view('for_fan.netacho.show', compact('idea_word'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
