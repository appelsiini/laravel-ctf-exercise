<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     * @throws \Exception
     */
    public function index()
    {
        if (!auth()->user()) {
            alert()->warning('Currently in beta, job listing is only available for authorized beta users.');

            return redirect()->back();
        }

        return view('job.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Job $job
     *
     * @return void
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Job $job
     *
     * @return void
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Job     $job
     *
     * @return void
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Job $job
     *
     * @return void
     */
    public function destroy(Job $job)
    {
        //
    }
}
