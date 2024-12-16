<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationModel;

class ApplicationModelController extends Controller
{
    public function classDescription(Application $application, ApplicationModel $model)
    {
        $context = request()->header('JsonLdContext');

        return response($model->classDescription(compact('context')))
            ->withHeaders(['Content-Type' => 'application/ld+json']);
    }

    public function accessNeed(Application $application, ApplicationModel $model)
    {
        $context = request()->header('JsonLdContext');

        return response($model->accessNeed(compact('context')))
            ->withHeaders(['Content-Type' => 'application/ld+json']);
    }
}
