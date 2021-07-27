<?php

namespace App\Http\Controllers;

use App\Models\DetailPemeriksaan;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Pemeriksaan;
use App\Models\TipeTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PemeriksaanController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'Pemeriksaan';
        $this->param['pageTitle'] = 'Pemeriksaan';
        $this->param['pageIcon'] = 'notes-medical';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->param['btnRight']['text'] = 'Tambah Pemeriksaan';
        $this->param['btnRight']['link'] = route('pemeriksaan.create');

        try {
            $keyword = $request->get('keyword');
            $getPemeriksaan = DB::table('pemeriksaan')
                ->join('dokter', 'dokter.id_dokter', '=', 'pemeriksaan.id_dokter')
                ->join('pasien', 'pasien.id_pasien', '=', 'pemeriksaan.id_pasien')
                ->select('id_pemeriksaan', 'no_reg', 'nama_pasien', 'nama_dokter', 'tgl_pemeriksaan')
                ->orderByDesc('tgl_pemeriksaan')
            ;

            if ($keyword) {
                $getPemeriksaan->where('nama_dokter', 'LIKE', "%{$keyword}%")->orWhere('nama_pasien', 'LIKE', "%{$keyword}%")->orWhere('no_reg', 'LIKE', "%{$keyword}%");
            }

            $this->param['pemeriksaan'] = $getPemeriksaan->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('pemeriksaan.list-pemeriksaan', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('pemeriksaan.index');
        $this->param['findAllDokter'] = Dokter::all();
        $this->param['findAllTipe'] = TipeTest::all();
        $this->param['dataPemeriksaan'] = null;
        $this->param['detailPemeriksaan'] = null;
        $cookie = json_decode($request->cookie('lara_list'), true);
        if ($cookie && array_key_exists('data_pemeriksaan', $cookie)) {
            $this->param['dataPemeriksaan'] = $cookie['data_pemeriksaan'];
        }
        if ($cookie && array_key_exists('detail_pemeriksaan', $cookie)) {
            $this->param['detailPemeriksaan'] = $cookie['detail_pemeriksaan'];
        }

        return \view('pemeriksaan.tambah-pemeriksaan', $this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cookie = json_decode($request->cookie('lara_list'), true);
        if (
            $cookie
            && array_key_exists('data_pemeriksaan', $cookie)
            && array_key_exists('detail_pemeriksaan', $cookie)
        ) {
            try {
                DB::beginTransaction();
                $pasien = Pasien::create([
                    'nik' => $cookie['data_pemeriksaan']['nik'],
                    'nama_pasien' => $cookie['data_pemeriksaan']['name'],
                    'umur' => $cookie['data_pemeriksaan']['umur'],
                    'alamat' => $cookie['data_pemeriksaan']['alamat'],
                ]);

                $tgl_pemeriksaan = $cookie['data_pemeriksaan']['tgl_pemeriksaan'].' '.$cookie['data_pemeriksaan']['jam'];

                $dokter = Dokter::findOrFail($cookie['data_pemeriksaan']['dokter']);

                $pemeriksaan = new Pemeriksaan();
                $pemeriksaan->no_reg = $cookie['data_pemeriksaan']['no_reg'];
                $pemeriksaan->id_pasien = $pasien->id_pasien;
                $pemeriksaan->id_dokter = $dokter->id_dokter;
                $pemeriksaan->pengirim = $cookie['data_pemeriksaan']['pengirim'];
                $pemeriksaan->keterangan = $cookie['data_pemeriksaan']['keterangan'];
                $pemeriksaan->tgl_pemeriksaan = $tgl_pemeriksaan;
                $pemeriksaan->save();
                $id_pemeriksaan = $pemeriksaan->id_pemeriksaan;

                $detail_pemeriksaan = [];
                foreach ($cookie['detail_pemeriksaan'] as $item) {
                    $detail_pemeriksaan[] = [
                        'id_pemeriksaan' => $id_pemeriksaan,
                        'tipe_pemeriksaan' => $item['tipe_pemeriksaan'],
                        'hasil' => $item['hasil'],
                    ];
                }
                DetailPemeriksaan::insert($detail_pemeriksaan);
                DB::commit();
                Cookie::queue(
                    Cookie::forget('lara_list')
                );

                return redirect()
                    ->route('pemeriksaan.index')
                    ->with('status', 'Berhasil ditambah')
                ;
            } catch (\Exception $ex) {
                DB::rollback();
                Log::debug($ex);

                return redirect()->route('pemeriksaan.index')->withError('Terjadi kesalahan : '.$ex->getMessage());
            } catch (\Illuminate\Database\QueryException $ex) {
                DB::rollback();
                Log::debug($ex);

                return redirect()->route('pemeriksaan.index')->withError('Terjadi kesalahan pada database : '.$ex->getMessage());
            }
        }
    }

    public function storeDetail(Request $request, $id_pemeriksaan)
    {
        $validatedData = $request->validate(
            [
                'tipe_pemeriksaan' => 'required',
                'hasil' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'tipe_pemeriksaan' => 'Tipe pemeriksaan',
                'hasil' => 'Hasil',
            ]
        );

        try {
            $detail = DetailPemeriksaan::where([
                'id_pemeriksaan' => $id_pemeriksaan,
                'tipe_pemeriksaan' => $request->tipe_pemeriksaan,
            ]);
            if ($detail->exists()) {
                return redirect()
                    ->route('pemeriksaan.edit', $id_pemeriksaan)
                    ->with('error', 'Data sudah ada')
                ;
            }
            DetailPemeriksaan::create([
                'id_pemeriksaan' => $id_pemeriksaan,
                'tipe_pemeriksaan' => $request->tipe_pemeriksaan,
                'hasil' => $request->hasil,
            ]);

            return redirect()
                ->route('pemeriksaan.edit', $id_pemeriksaan)
                ->with('status', 'Berhasil ditambahkan')
                ;
        } catch (\Exception $ex) {
            DB::rollback();
            Log::debug($ex);

            return redirect()->route('pemeriksaan.edit', $id_pemeriksaan)->withError('Terjadi kesalahan : '.$ex->getMessage());
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollback();
            Log::debug($ex);

            return redirect()->route('pemeriksaan.edit', $id_pemeriksaan)->withError('Terjadi kesalahan pada database : '.$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Pemeriksaan $pemeriksaan)
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('pemeriksaan.index');
        $this->param['btnRight']['print'] = route('pemeriksaan.index');
        $this->param['btnRight']['text_print'] = 'Cetak';
        $this->param['pageTitle'] = 'Detail Pemeriksaan';
        $this->param['pageIcon'] = 'notes-medical';
        $this->param['pemeriksaan'] = $pemeriksaan->load('pasien', 'dokter');

        return view('pemeriksaan.detail-pemeriksaan', $this->param);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemeriksaan $pemeriksaan)
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('pemeriksaan.index');
        $this->param['findAllDokter'] = Dokter::all();
        $this->param['findAllTipe'] = TipeTest::all();
        $this->param['dataPemeriksaan'] = $pemeriksaan->load('details', 'pasien');
        // dd($this->param['dataPemeriksaan']->tgl_pemeriksaan);

        return \view('pemeriksaan.edit-pemeriksaan', $this->param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $validatedData = $request->validate(
            [
                'no_reg' => 'required',
                'pengirim' => 'required',
                'dokter' => 'required',
                'nik' => 'required',
                'name' => 'required',
                'umur' => 'required',
                'alamat' => 'required',
                'tgl_pemeriksaan' => 'required',
                'jam' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute telah terdaftar',
            ],
            [
                'no_reg' => 'No Registrasi',
                'pengirim' => 'Pengirim',
                'dokter' => 'Dokter',
                'nik' => 'NIK Pasien',
                'name' => 'Nama Pasien',
                'umur' => 'Umur',
                'alamat' => 'Alamat',
                'tgl_pemeriksaan' => 'Tanggal Pemeriksaan',
                'jam' => 'Jam Pemeriksaan',
            ]
        );

        try {
            DB::beginTransaction();
            $tgl_pemeriksaan = $request->tgl_pemeriksaan.' '.$request->jam;
            $pemeriksaan->no_reg = $request->no_reg;
            $pemeriksaan->id_dokter = $request->dokter;
            $pemeriksaan->pengirim = $request->pengirim;
            $pemeriksaan->keterangan = $request->keterangan;
            $pemeriksaan->tgl_pemeriksaan = $tgl_pemeriksaan;
            $pemeriksaan->save();
            $pasien = Pasien::findOrFail($pemeriksaan->id_pasien);
            $pasien->nik = $request->nik;
            $pasien->nama_pasien = $request->name;
            $pasien->umur = $request->umur;
            $pasien->alamat = $request->alamat;
            $pasien->save();
            DB::commit();

            return redirect()
                ->route('pemeriksaan.edit', $pemeriksaan->id_pemeriksaan)
            ;
        } catch (\Exception $e) {
            DB::rollback();
            Log::debug($e);

            return redirect()->route('pemeriksaan.edit', $pemeriksaan->id_pemeriksaan)->withError('Terjadi kesalahan. : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollback();
            Log::debug($e);

            return redirect()->route('pemeriksaan.edit', $pemeriksaan->id_pemeriksaan)->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemeriksaan $pemeriksaan)
    {
        try{
            $id = $pemeriksaan->id_pemeriksaan;

            // delete pasien
            Pasien::where('id_pasien', $pemeriksaan->id_pasien)->delete();

            // delete detail pemeriksaan
            DetailPemeriksaan::where('id_pemeriksaan', $id)->delete();

            $pemeriksaan->delete();

            return redirect()->route('pemeriksaan.index')->withStatus('Berhasil dihapus.');
        }
        catch (\Exception $e) {
            return redirect()->route('pemeriksaan.index')->withError('Terjadi kesalahan. : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('pemeriksaan.index')->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }

    public function destroyDetailPemeriksaan(DetailPemeriksaan $detail, $id_pemeriksaan)
    {
        try {
            $detail->delete();

            return redirect()->route('pemeriksaan.edit', $id_pemeriksaan)->withStatus('Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('pemeriksaan.edit', $id_pemeriksaan)->withError('Terjadi kesalahan. : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('pemeriksaan.edit', $id_pemeriksaan)->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }

    public function tambahPemeriksaan(Request $request)
    {
        $validatedData = $request->validate(
            [
                'no_reg' => 'required|unique:pemeriksaan,no_reg',
                'pengirim' => 'required',
                'dokter' => 'required',
                'nik' => 'required',
                'name' => 'required',
                'umur' => 'required',
                'alamat' => 'required',
                'tgl_pemeriksaan' => 'required',
                'jam' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'unique' => ':attribute telah terdaftar',
            ],
            [
                'no_reg' => 'No Registrasi',
                'pengirim' => 'Pengirim',
                'dokter' => 'Dokter',
                'nik' => 'NIK Pasien',
                'name' => 'Nama Pasien',
                'umur' => 'Umur',
                'alamat' => 'Alamat',
                'tgl_pemeriksaan' => 'Tanggal Pemeriksaan',
                'jam' => 'Jam Pemeriksaan',
            ]
        );

        try {
            $cookie = json_decode($request->cookie('lara_list'), true);
            $cookie_pemeriksaan = [
                'no_reg' => $request->no_reg,
                'pengirim' => $request->pengirim,
                'dokter' => $request->dokter,
                'nik' => $request->nik,
                'name' => $request->name,
                'umur' => $request->umur,
                'alamat' => $request->alamat,
                'tgl_pemeriksaan' => $request->tgl_pemeriksaan,
                'jam' => $request->jam,
                'keterangan' => $request->keterangan,
            ];
            $cookie['data_pemeriksaan'] = $cookie_pemeriksaan;
            $setCookie = cookie('lara_list', json_encode($cookie));

            return redirect()
                ->route('pemeriksaan.create')
                ->cookie($setCookie)
            ;
        } catch (\Exception $e) {
            return redirect()->route('pemeriksaan.create')->withError('Terjadi kesalahan. : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('pemeriksaan.create')->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }

    public function tambahDetailPemeriksaan(Request $request)
    {
        $validatedData = $request->validate(
            [
                'tipe_pemeriksaan' => 'required',
                'hasil' => 'required',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
            ],
            [
                'tipe_pemeriksaan' => 'Tipe pemeriksaan',
                'hasil' => 'Hasil',
            ]
        );
        $cookie = json_decode($request->cookie('lara_list'), true);
        $findTipeById = TipeTest::find($request->tipe_pemeriksaan);

        if ($cookie && array_key_exists('detail_pemeriksaan', $cookie)) {
            if (false !== array_search($findTipeById->tipe, array_column($cookie['detail_pemeriksaan'], 'pemeriksaan'))) {
                return redirect()
                    ->route('pemeriksaan.create')
                    ->with('error', 'Data '.$findTipeById->tipe.' sudah ada')
                ;
            }
            $obat_baru = [
                'tipe_pemeriksaan' => $findTipeById->id_tipe,
                'pemeriksaan' => $findTipeById->tipe,
                'hasil' => $request->hasil,
                'nilai_normal' => $findTipeById->nilai_normal,
            ];
            array_push($cookie['detail_pemeriksaan'], $obat_baru);
        } else {
            $cookie['detail_pemeriksaan'] = [[
                'tipe_pemeriksaan' => $findTipeById->id_tipe,
                'pemeriksaan' => $findTipeById->tipe,
                'hasil' => $request->hasil,
                'nilai_normal' => $findTipeById->nilai_normal,
            ]];
        }
        $setCookie = cookie('lara_list', json_encode($cookie));

        return redirect()
            ->route('pemeriksaan.create')
            ->cookie($setCookie)
            ->withStatus('Berhasil ditambahkan')
        ;
    }

    public function hapusDetailPemeriksaan($id)
    {
        $cookie = json_decode(Cookie::get('lara_list'), true);

        try {
            unset($cookie['detail_pemeriksaan'][$id]);

            $setCookie = cookie('lara_list', json_encode($cookie));

            return redirect()->route('pemeriksaan.create')->cookie($setCookie)->withStatus('Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('pemeriksaan.create')->withError('Terjadi kesalahan. : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('pemeriksaan.create')->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }

    public function print($id)
    {
        // $this->param['btnRight']['text'] = 'Lihat Data';
        // $this->param['btnRight']['link'] = route('pemeriksaan.index');
        // $this->param['btnRight']['print'] = route('pemeriksaan.index');
        // $this->param['btnRight']['text_print'] = 'Cetak';
        // $this->param['pageTitle'] = 'Detail Pemeriksaan';
        // $this->param['pageIcon'] = 'notes-medical';
        $this->param['pemeriksaan'] = Pemeriksaan::with('pasien', 'dokter')->find($id);

        return view('pemeriksaan.print-pemeriksaan', $this->param);
    }

    public function showHasil($id)
    {
        // $this->param['btnRight']['text'] = 'Lihat Data';
        // $this->param['btnRight']['link'] = route('pemeriksaan.index');
        // $this->param['btnRight']['print'] = route('pemeriksaan.index');
        // $this->param['btnRight']['text_print'] = 'Cetak';
        // $this->param['pageTitle'] = 'Detail Pemeriksaan';
        // $this->param['pageIcon'] = 'notes-medical';
        $this->param['pemeriksaan'] = Pemeriksaan::with('pasien', 'dokter')->find($id);

        return view('pemeriksaan.hasil-pemeriksaan', $this->param);
    }
}
