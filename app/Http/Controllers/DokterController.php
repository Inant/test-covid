<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Dokter';
        $this->param['pageTitle'] = 'Dokter';
        $this->param['pageIcon'] = 'user-nurse';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnRight']['text'] = 'Tambah Dokter';
        $this->param['btnRight']['link'] = route('dokter.create');

        try {
            $keyword = $request->get('keyword');
            $getDokters = Dokter::orderBy('nama_dokter', 'ASC');

            if ($keyword) {
                $getDokters->where('nama_dokter', 'LIKE', "%{$keyword}%");
            }

            $this->param['dokter'] = $getDokters->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('dokter.list-dokter', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('user.index');

        return \view('dokter.tambah-dokter', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'name' => 'Nama Dokter',
            ]
        );

        try {
            $newUser = new Dokter();

            $newUser->nama_dokter = $request->get('name');
            $newUser->save();

            return redirect()->route('dokter.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('dokter.index')->withError('Terjadi kesalahan. : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('dokter.index')->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $this->param['title'] = 'Dokter';
            $this->param['pageTitle'] = 'Dokter';
            $this->param['pageIcon'] = 'user-nurse';
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('dokter.index');
            $this->param['dokter'] = Dokter::find($id);

            return \view('dokter.edit-dokter', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dokter = Dokter::find($id);

        $validatedData = $request->validate(
            [
                'name' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'name' => 'Nama Dokter',
            ]
        );

        try {
            $dokter->nama_dokter = $request->get('name');
            $dokter->save();

            return redirect()->route('dokter.index')->withStatus('Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $dokter = Dokter::findOrFail($id);

            $dokter->delete();

            return redirect()->route('dokter.index')->withStatus('Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('dokter.index')->withError('Terjadi kesalahan : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('dokter.index')->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }
}
