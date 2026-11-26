<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Support\CicImageCatalog;
use Illuminate\Contracts\View\View;

class ProgramsController extends Controller
{
    public function index(): View
    {
        $programs = Program::query()->where('is_published', true)->orderBy('name')->get();

        return view('programs.index', compact('programs'));
    }

    public function show(Program $program): View
    {
        abort_unless($program->is_published, 404);
        $facilityImages = CicImageCatalog::forProgram($program->slug);

        $suggestedPrograms = Program::query()
            ->where('is_published', true)
            ->whereKeyNot($program->getKey())
            ->orderBy('name')
            ->limit(3)
            ->get();

        return view('programs.show', compact('program', 'facilityImages', 'suggestedPrograms'));
    }
}
