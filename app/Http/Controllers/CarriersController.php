<?php

namespace App\Http\Controllers;

use App\Models\Carriers;
use Illuminate\Http\Request;

class CarriersController extends Controller
{
    private $carriers;

    public function __construct(Carriers $carriers)
    {
        $this->carriers = $carriers;
    }

    public function index()
    {
        $collection = $this->carriers->orderBy('name','ASC')->paginate(10);
        return view ('logistics.carriers.index', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Carriers $carriers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carriers $carriers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carriers $carriers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carriers $carriers)
    {
        //
    }
}
