<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use Illuminate\Support\Facades\DB;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with('models')->get();

        return view('applications.index', compact('applications'));
    }

    public function create()
    {
        return view('applications.form');
    }

    public function store(StoreApplicationRequest $request)
    {
        $application = DB::transaction(function () use ($request) {
            $application = Application::create($request->validated());
            $models = $request->validated('models') ?? [];

            foreach ($models as $model) {
                $application->models()->create($model);
            }

            return $application;
        });

        return redirect()->route('applications.show', $application);
    }

    public function show(Application $application)
    {
        return view('applications.show', compact('application'));
    }

    public function profile(Application $application)
    {
        $context = request()->header('JsonLdContext');

        return response($application->profile(compact('context')))
            ->withHeaders(['Content-Type' => 'application/ld+json']);
    }

    public function accessDescriptionSet(Application $application)
    {
        $context = request()->header('JsonLdContext');

        return response($application->accessDescriptionSet(compact('context')))
            ->withHeaders(['Content-Type' => 'application/ld+json']);
    }

    public function accessNeedGroup(Application $application)
    {
        $context = request()->header('JsonLdContext');

        return response($application->accessNeedGroup(compact('context')))
            ->withHeaders(['Content-Type' => 'application/ld+json']);
    }

    public function edit(Application $application)
    {
        return view('applications.form', compact('application'));
    }

    public function update(UpdateApplicationRequest $request, Application $application)
    {
        DB::transaction(function () use ($request, $application) {
            $application->update($request->validated());
            $newModels = collect($request->validated('models') ?? [])->keyBy('name');
            $oldModels = $application->models->keyBy('name');

            foreach ($newModels as $name => $newModel) {
                if ($oldModels->has($name)) {
                    $oldModels->get($name)->update($newModel);
                    $oldModels->offsetUnset($name);

                    continue;
                }

                $application->models()->create($newModel);
            }

            foreach ($oldModels as $oldModel) {
                $oldModel->delete();
            }
        });

        return redirect()->route('applications.show', $application);
    }

    public function destroy(Application $application)
    {
        // TODO auth policies

        $application->delete();

        return redirect()->route('applications.index');
    }
}
