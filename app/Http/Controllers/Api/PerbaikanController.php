<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PerbaikanController as PerbaikanControl;
use App\Http\Requests\StorePerbaikanRequest;
use App\Http\Resources\PerbaikanResource;
use App\Models\Eviden;
use App\Models\Perbaikan;
// use Illuminate\Http\RedirectResponse;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PerbaikanController extends Controller
{
    public function index() {
        $perbaikan = Perbaikan::with('eviden')->get();
        // return response()->json($perbaikan);
        return new PerbaikanResource(true, 'list data', $perbaikan);
    }

    public function store(StorePerbaikanRequest $request)
    {
        // validasi data
        //$validData = $request->validated();

        // insert perbaikan
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:100',
            'keterangan' => 'required',
            //'user_id' => $user->id
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $perbaikan = Perbaikan::create([
            'judul' => $request->judul,
            'keterangan' => $request->keterangan,
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
            return new PerbaikanResource(true, 'Data berhasil diinput', $perbaikan);
        }
    }
}
