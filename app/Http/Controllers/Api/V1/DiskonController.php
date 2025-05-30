<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Diskon;
use Illuminate\Http\Request;

class DiskonController extends Controller
{
    public function index() {
        $diskonList = Diskon::all();
        return view('admin.alldiskon', compact('diskonList'));
    }

    public function create() {
        return view('admin.adddiskon');
    }

    public function store(Request $request) {
        $request->validate([
            'nama' => 'required|string|max:100',
            'persentase' => 'required|integer|min:0|max:100',
        ]);
        Diskon::create($request->all());
        return redirect()->route('alldiskon')->with('message', 'Diskon berhasil ditambahkan!');
    }

    public function edit($id) {
        $diskon = Diskon::findOrFail($id);
        return view('admin.editdiskon', compact('diskon'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama' => 'required|string|max:100',
            'persentase' => 'required|integer|min:0|max:100',
        ]);
        $diskon = Diskon::findOrFail($id);
        $diskon->update($request->all());
        return redirect()->route('alldiskon')->with('message', 'Diskon berhasil diupdate!');
    }

    public function destroy($id) {
        $diskon = Diskon::findOrFail($id);
        $diskon->delete();
        return redirect()->route('alldiskon')->with('message', 'Diskon berhasil dihapus!');
    }
}
