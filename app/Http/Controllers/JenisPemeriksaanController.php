<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\TipeTest;
class JenisPemeriksaanController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Jenis Pemeriksaan';
        $this->param['pageTitle'] = 'Jenis Pemeriksaan';
        $this->param['pageIcon'] = 'stethoscope';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnRight']['text'] = 'Tambah Jenis Pemeriksaan';
        $this->param['btnRight']['link'] = route('jenis-pemeriksaan.create');

        try {
            $keyword = $request->get('keyword');
            $getJenisPemeriksaan = TipeTest::orderBy('tipe', 'ASC');

            if ($keyword) {
                $getJenisPemeriksaan->where('tipe', 'LIKE', "%{$keyword}%");
            }

            $this->param['jenisPemeriksaan'] = $getJenisPemeriksaan->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('jenis-pemeriksaan.list-jenis-pemeriksaan', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('jenis-pemeriksaan.index');

        return \view('jenis-pemeriksaan.tambah-jenis-pemeriksaan', $this->param);
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
                'tipe' => 'required',
                'nilai_normal' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'tipe' => 'Jenis pemeriksaan',
                'nilai_normal' => 'Nilai normal',
            ]
        );

        try {
            $newJenisPemeriksaan = new TipeTest;

            $newJenisPemeriksaan->tipe = $request->get('tipe');
            $newJenisPemeriksaan->nilai_normal = $request->get('nilai_normal');
            $newJenisPemeriksaan->save();

            return redirect()->route('jenis-pemeriksaan.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('jenis-pemeriksaan.index')->withError('Terjadi kesalahan. : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('jenis-pemeriksaan.index')->withError('Terjadi kesalahan pada database : '.$e->getMessage());
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
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('jenis-pemeriksaan.index');
            $this->param['jenisPemeriksaan'] = TipeTest::find($id);

            return \view('jenis-pemeriksaan.edit-jenis-pemeriksaan', $this->param);
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
        $validatedData = $request->validate(
            [
                'tipe' => 'required',
                'nilai_normal' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'tipe' => 'Jenis pemeriksaan',
                'nilai_normal' => 'Nilai normal',
            ]
        );

        try {
            $jenisPemeriksaan = TipeTest::find($id);
            $jenisPemeriksaan->tipe = $request->get('tipe');
            $jenisPemeriksaan->nilai_normal = $request->get('nilai_normal');
            $jenisPemeriksaan->save();

            return redirect()->route('jenis-pemeriksaan.index')->withStatus('Data berhasil diperbarui.');
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
            $jenisPemeriksaan = TipeTest::findOrFail($id);

            $jenisPemeriksaan->delete();

            return redirect()->route('jenis-pemeriksaan.index')->withStatus('Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('jenis-pemeriksaan.index')->withError('Terjadi kesalahan : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('jenis-pemeriksaan.index')->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }
}
