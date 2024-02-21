<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePerbaikanRequest;
use App\Http\Requests\UpdatePerbaikanRequest;
use App\Models\Perbaikan;
use App\Models\Eviden;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PerbaikanController extends Controller
{
    /**
     * Fungsi index() untuk memunculkan data dari database ke aplikasi
     */
    public function index()
    {
        $page_meta = [
            'title' => 'Index',
        ];
        $data = Perbaikan::with('eviden')->get();
        return response(view('perbaikan.index', ['listperbaikan' => $data, 'meta' => $page_meta]));
    }

    /**
     * Fungsi create() untuk memungkinkan pengguna menambahkan data baru
     */
    public function create(): Response
    {
        $page_meta = [
            'title' => 'Tambah Data Baru',
        ];
        return response(view('perbaikan.create', ['meta' => $page_meta]));
    }

    /**
     * Fungsi store() untuk menyimpan data yang dimasukkan pengguna
     */
    public function store(StorePerbaikanRequest $request): RedirectResponse
    {
        // validasi data
        $validData = $request->validated();

        // insert perbaikan
        $perbaikan = Perbaikan::create([
            'judul' => $validData['judul'],
            'keterangan' => $validData['keterangan'],
        ]);
        
        // upload file
        if ($request->hasFile('photo')) {
            $files = $request->file('photo');
            foreach ($files as $file) {
                $file->storeAs('public/eviden', $file->hashName());
                Eviden::create([
                    'perbaikan_id' => $perbaikan->id,
                    'filename' => $file->hashName()
                ]);
            }
        }
        if ($perbaikan) {
            return redirect(route('perbaikan.index'))->with('success', 'Data perbaikan berhasil diinput');
        }
    }

    /**
     * Fungsi show() untuk memunculkan informasi lebih lengkap mengenai sebuah data
     */
    public function show(Perbaikan $id): View
    {
        $evidens = Eviden::all();
        $page_meta = [
            'title' => 'Lihat Data',
        ];
        return view('perbaikan.show', [
            'listperbaikan' => $id,
            'eviden' => $evidens,
            'meta' => $page_meta
        ]);
    }

    /**
     * Fungsi edit() untuk memungkinkan pengguna mengedit data
     */
    public function edit(string $id): Response
    {
        $page_meta = ['title' => 'Edit Data'];
        $data = Perbaikan::findOrFail($id);
        return response(view('perbaikan.edit', ['listperbaikan' => $data, 'meta' => $page_meta]));
    }

    /**
     * Fungsi update() agar data dapat diperbarui
     */
    public function update(UpdatePerbaikanRequest $request, string $id): RedirectResponse
    {
        // validasi data
        $perbaikan = Perbaikan::findOrFail($id);
        if ($request->hasFile('photo')) {
            $files = $request->file('photo');
            foreach ($files as $file) {
                $file->storeAs('public/eviden', $file->hashName());
                Eviden::create([
                    'perbaikan_id' => $perbaikan->id,
                    'filename' => $file->hashName()
                ]);
            }
        }

        //$perbaikan->update($request->all());
        if ($perbaikan->update($request->validated())) {
            return redirect(route('perbaikan.index'))->with('success', 'Data perbaikan berhasil diinput'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $data = Perbaikan::findOrFail($id);
        Eviden::where('perbaikan_id', $id)->delete();
        
        if ($data->delete()) {
            return redirect(route('perbaikan.index'))->with('success', 'Data berhasil dihapus');
        } else {
            return redirect(route('perbaikan.index'))->with('error', 'Maaf, data belum berhasil dihapus');
        }
    }
}
