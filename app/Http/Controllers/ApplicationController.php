<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use App\Models\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Laravel\Facades\Image;

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
            $application = new Application($request->validated());
            $models = $request->validated('models') ?? [];

            $this->updateApplicationLogo($application, $request->has('logo_clear'));

            $application->save();

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
            $application->fill($request->validated());
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

            if ($application->isDirty('slug')) {
                rename(
                    storage_path("app/public/img/applications/{$application->getOriginal('slug')}.png"),
                    storage_path("app/public/img/applications/{$application->slug}.png")
                );
            }

            $this->updateApplicationLogo($application, $request->has('logo_clear'));

            $application->save();
        });

        return redirect()->route('applications.show', $application);
    }

    public function destroy(Application $application)
    {
        // TODO auth policies

        $application->delete();

        return redirect()->route('applications.index');
    }

    protected function updateApplicationLogo(Application $application, bool $clear)
    {
        if ($clear) {
            unlink(storage_path("app/public/img/applications/{$application->slug}.png"));

            $application->setAttribute('has_logo', false);

            return;
        }

        if (!request()->has('logo')) {
            return;
        }


        if (!request()->file('logo')->isValid()) {
            $application->setAttribute('has_logo', false);

            return;
        }

        File::ensureDirectoryExists(storage_path('app/public/img/applications'));

        Image::read(request()->file('logo'))
            ->cover(512, 512)
            ->toPng()
            ->save(storage_path("app/public/img/applications/{$application->slug}.png"));

        $application->setAttribute('has_logo', true);
    }
}
