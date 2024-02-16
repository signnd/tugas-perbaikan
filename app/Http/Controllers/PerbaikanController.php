<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            [
                'id' => 1,
                'judul' => 'Perbaikan PC',
                'status' => 'closed',
                'tanggal' => '2024-02-01'
            ],
            [
                'id' => 2,
                'judul' => 'Perbaikan AC',
                'status' => 'open',
                'tanggal' => '2024-02-02'
            ],
            [
                'id' => 3,
                'judul' => 'Perbaikan AC',
                'status' => 'open',
                'tanggal' => '2024-02-02'
            ]
        ];
        return view('perbaikan.index', ['listperbaikan' => $data]);
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
    public function show(string $id)
    {
        echo $id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
