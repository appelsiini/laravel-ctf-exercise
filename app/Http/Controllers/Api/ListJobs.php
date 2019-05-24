<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListJobs extends Controller
{
    public function __invoke(Request $request)
    {
        // Intentionally SQL injectable query, for demonstration purposes super easy to exploit with eg. sqlmap
        $orderParam = $request->get('sort');

        $jobs = $orderParam ?
            DB::select(DB::raw("select * from jobs order by $orderParam desc")) :
            Job::all();

        return response()->json($jobs);
    }
}
