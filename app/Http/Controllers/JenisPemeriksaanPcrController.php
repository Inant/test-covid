<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\TipePcr;

class JenisPemeriksaanPcrController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Jenis Pemeriksaan PCR';
        $this->param['pageTitle'] = 'Jenis Pemeriksaan PCR';
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
        $this->param['btnRight']['link'] = route('jenis-pemeriksaan-pcr.create');

        try {
            $keyword = $request->get('keyword');
            $getJenisPemeriksaan = TipePcr::orderBy('tipe_pcr', 'ASC');

            if ($keyword) {
                $getJenisPemeriksaan->where('tipe_pcr', 'LIKE', "%{$keyword}%");
            }

            $this->param['jenisPemeriksaan'] = $getJenisPemeriksaan->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan ' . $e->getMessage());
        }

        return \view('jenis-pemeriksaan-pcr.list-jenis-pemeriksaan-pcr', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('jenis-pemeriksaan-pcr.index');

        return \view('jenis-pemeriksaan-pcr.tambah-jenis-pemeriksaan-pcr', $this->param);
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
                'tipe_pcr' => 'required',
                'nilai_rujukan' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'tipe_pcr' => 'Jenis pemeriksaan PCR',
                'nilai_rujukan' => 'Nilai normal',
            ]
        );

        try {
            $newJenisPemeriksaan = new TipePcr;

            $newJenisPemeriksaan->tipe_pcr = $request->get('tipe_pcr');
            $newJenisPemeriksaan->nilai_rujukan = $request->get('nilai_rujukan');
            $newJenisPemeriksaan->save();

            return redirect()->route('jenis-pemeriksaan-pcr.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('jenis-pemeriksaan-pcr.index')->withError('Terjadi kesalahan. : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('jenis-pemeriksaan-pcr.index')->withError('Terjadi kesalahan pada database : '.$e->getMessage());
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
            $this->param['btnRight']['link'] = route('jenis-pemeriksaan-pcr.index');
            $this->param['jenisPemeriksaan'] = TipePcr::find($id);

            return \view('jenis-pemeriksaan-pcr.edit-jenis-pemeriksaan-pcr', $this->param);
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
                'tipe_pcr' => 'required',
                'nilai_rujukan' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'tipe_pcr' => 'Jenis pemeriksaan PCR',
                'nilai_rujukan' => 'Nilai normal',
            ]
        );

        try {
            $jenisPemeriksaan = TipePcr::find($id);
            $jenisPemeriksaan->tipe_pcr = $request->get('tipe_pcr');
            $jenisPemeriksaan->nilai_rujukan = $request->get('nilai_rujukan');
            $jenisPemeriksaan->save();

            return redirect()->route('jenis-pemeriksaan-pcr.index')->withStatus('Data berhasil diperbarui.');
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
            $jenisPemeriksaan = TipePcr::findOrFail($id);

            $jenisPemeriksaan->delete();

            return redirect()->route('jenis-pemeriksaan-pcr.index')->withStatus('Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('jenis-pemeriksaan-pcr.index')->withError('Terjadi kesalahan : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('jenis-pemeriksaan-pcr.index')->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }
}
