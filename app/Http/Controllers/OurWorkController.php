<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkInfo;

class OurWorkController extends Controller
{
    //

    public function index()
    {
        $user_id = auth()->user()->id;
        $work_infos = WorkInfo::where('content1_posted_by', $user_id)
            ->orWhere('content2_posted_by', $user_id)
            ->orWhere('content3_posted_by', $user_id)
            ->orWhere('content4_posted_by', $user_id)
            ->orWhere('content5_posted_by', $user_id)
            ->get();

        return view('for_fan.our_work', ['work_infos' => $work_infos]);
    }
}
