<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::all();

        return view('applications.index', compact('applications'));
    }

    public function create()
    {
        return view('applications.form');
    }

    public function store(StoreApplicationRequest $request)
    {
        $application = Application::create($request->validated());

        return redirect()->route('applications.show', $application);
    }

    public function show(Application $application)
    {
        if (request()->wantsJsonLD()) {
            $context = request()->header('JsonLdContext');

            return response($application->profileDocument(compact('context')))
                ->withHeaders(['Content-Type' => 'application/ld+json']);
        }

        return view('applications.show', compact('application'));
    }

    public function edit(Application $application)
    {
        return view('applications.form', compact('application'));
    }

    public function update(UpdateApplicationRequest $request, Application $application)
    {
        $application->update($request->validated());

        return redirect()->route('applications.show', $application);
    }

    public function destroy(Application $application)
    {
        // TODO auth policies

        $application->delete();

        return redirect()->route('applications.index');
    }
}
