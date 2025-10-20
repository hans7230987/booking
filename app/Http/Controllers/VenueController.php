<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    private $typeMap = [
        'badminton'  => '羽球',
        'basketball' => '籃球',
        'tabletennis' => '桌球',
    ];

    public function indexByType($slug)
    {
        $type = $this->typeMap[$slug] ?? null;

        if (!$type) abort(404, '球類不存在');

        $venues = Venue::whereHas('courts', fn($q) => $q->where('type', $type))->get();

        return view('sports.venues', compact('type', 'venues', 'slug'));
    }

    public function showByType($slug, Venue $venue)
    {
        $type = $this->typeMap[$slug] ?? null;

        if (!$type) abort(404, '球類不存在');

        $venue->load(['courts' => fn($q) => $q->where('type', $type)]);

        return view('sports.show', compact('type', 'venue', 'slug'));
    }

    public function index()
    {
        $venues = Venue::all();
        return view('venues.index', compact('venues'));
    }

    public function show(Venue $venue)
    {
        $venue->load('courts');
        return view('venues.show', compact('venue'));
    }
}
