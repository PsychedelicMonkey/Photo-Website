<?php

namespace App\Http\Controllers;

use App\Models\Portfolio\Album;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AlbumController extends Controller
{
    public function index(): View
    {
        $albums = Album::query()
            ->with(['media', 'tags'])
            ->withCount(['media'])
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('album.index', compact('albums'));
    }

    public function show(Album $album): View
    {
        if (! $album->isVisible()) {
            throw new NotFoundHttpException;
        }

        $album->load(['media', 'tags']);

        return view('album.show', compact('album'));
    }
}
