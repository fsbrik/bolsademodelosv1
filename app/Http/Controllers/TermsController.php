<?php

// TermsController.php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class TermsController extends Controller
{
    public function show()
    {
        $terms = File::get(resource_path('markdown/terms.md')); // Suponiendo que los términos están en un archivo .md
        return view('terms', compact('terms'));
    }
}
