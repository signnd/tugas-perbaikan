<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePerbaikanRequest;
use App\Http\Requests\UpdatePerbaikanRequest;
use App\Models\Perbaikan;
use App\Models\Eviden;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        // $perbaikanId = $perbaikan->id;
        
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
        //    $uploadPath = 'storage/eviden/';
        //    $i = 1;
        //    foreach($request->file('photo') as $photo) {
        //        $extension = $photo->getClientOriginalExtension();
        //        $filename = time().$i++.'.'.$extension;
        //        $photo->move($uploadPath, $filename);
        //        $finalPhotoPath = $uploadPath.$filename;
        //        $newEviden = new Eviden();
        //        $newEviden->filename = $finalPhotoPath;
        //        $newEviden->perbaikan_id = $perbaikanId;
        //        $newEviden->save();
        //    }
        //}
        // insert eviden
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
    public function update(UpdatePerbaikanRequest $request, Perbaikan $perbaikan): RedirectResponse
    {
        // // validasi data
        // $perbaikan = Perbaikan::findOrFail($id);
        $validData = $request->validated();
        $request->validate(
            [
                'judul' => $validData['judul'],
                'keterangan' => $validData['keterangan'],
            ]
        );
    
        // insert eviden
        // if($perbaikan->update($validData)) {
        //    $perbaikan->eviden()->sync($validData['perbaikan_id']);
        //    return redirect(route('perbaikan.index'))->with('success', 'Data perbaikan berhasil diinput');
        // }
        
        $perbaikan->update($request->all());
        return redirect(route('perbaikan.index'))->with('success', 'Data perbaikan berhasil diinput'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $data = Perbaikan::findOrFail($id);
        if ($data->delete()) {
            return redirect(route('perbaikan.index'))->with('success', 'Data berhasil dihapus');
        } else {
            return redirect(route('perbaikan.index'))->with('error', 'Maaf, data belum berhasil dihapus');
        }
    }
}
