<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\File;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'logo' => [
                File::image()->max('1000')
            ]
        ]);

        // TASK: change the below line so that $filename would contain only filename
        // The same filename as the original uploaded file
        $filename = $request->file('logo')->getClientOriginalName();
        $request->file('logo')->storeAs('logos', $filename);

        Project::create([
            'name' => $request->name,
            'logo' => $filename,
        ]);

        return 'Success';
    }
}
