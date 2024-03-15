<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePerbaikanRequest;
use App\Http\Requests\UpdatePerbaikanRequest;
use App\Models\Perbaikan;
use App\Models\Eviden;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

class PerbaikanController extends Controller
{
    /**
     * Fungsi index() untuk memunculkan data dari database ke aplikasi
     */
    public function index()
    {
        $user = Auth::user();
        $page_meta = [
            'title' => 'Index',
        ];
        if ($user->role == 'admin') {
            $data = Perbaikan::with('eviden')->get();
        } else {
            $data = Perbaikan::with('eviden')->where('user_id', $user->id)->get();
        }
        return response(view('perbaikan.index', ['listperbaikan' => $data, 'meta' => $page_meta, 'user' => $user]));
    }

    /**
     * Fungsi create() untuk memungkinkan pengguna menambahkan data baru
     */
    public function create(): Response
    {
        $user = Auth::user();
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
        $user = Auth::user();
        // validasi data
        $validData = $request->validated();

        // insert perbaikan
        $perbaikan = Perbaikan::create([
            'judul' => $validData['judul'],
            'keterangan' => $validData['keterangan'],
            'user_id' => $user->id
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
        $user = Auth::user();
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
        $user = Auth::user();
        $page_meta = ['title' => 'Edit Data'];
        $data = Perbaikan::findOrFail($id);
        return response(view('perbaikan.edit', ['listperbaikan' => $data, 'meta' => $page_meta]));
    }

    /**
     * Fungsi update() agar data dapat diperbarui
     */
    public function update(UpdatePerbaikanRequest $request, string $id): RedirectResponse
    {
        $user = Auth::user();
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
        $user = Auth::user();
        $data = Perbaikan::findOrFail($id);
        Eviden::where('perbaikan_id', $id)->delete();
        
        if ($data->delete()) {
            return redirect(route('perbaikan.index'))->with('success', 'Data berhasil dihapus');
        } else {
            return redirect(route('perbaikan.index'))->with('error', 'Maaf, data belum berhasil dihapus');
        }
    }

    public function dashadmin() {
        $user = Auth::user();
        $page_meta = [
            'title' => 'Dashboard Admin',
        ];
        $data = Perbaikan::with('eviden')->get();
        return response(view('perbaikan.dashboard', ['meta' => $page_meta, 'user' => $user]));
    }

    public function dashpegawai() {
        $user = Auth::user();
        $page_meta = [
            'title' => 'Dashboard Pegawai',
        ];
        $data = Perbaikan::with('eviden')->get();
        return response(view('perbaikan.dashboardpegawai', ['meta' => $page_meta, 'user' => $user]));
    }
}
