<?php

// PolicyController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class PolicyController extends Controller
{
    public function show()
    {
        $policy = File::get(resource_path('markdown/policy.md')); // Suponiendo que los términos están en un archivo .md
        return view('policy', compact('policy'));
    }
}
