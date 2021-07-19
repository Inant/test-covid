<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $param;

    public function __construct()
    {
        $this->param['title'] = 'User';
        $this->param['pageTitle'] = 'User';
        $this->param['pageIcon'] = 'users';
    }

    public function index(Request $request)
    {
        $this->param['btnRight']['text'] = 'Tambah User';
        $this->param['btnRight']['link'] = route('user.create');

        try {
            $keyword = $request->get('keyword');
            $getUsers = User::orderBy('name', 'ASC');

            if ($keyword) {
                $getUsers->where('name', 'LIKE', "%{$keyword}%")->orWhere('email', 'LIKE', "%{$keyword}%");
            }

            $this->param['user'] = $getUsers->paginate(10);
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withStatus('Terjadi Kesalahan');
        }

        return \view('user.list-user', $this->param);
    }

    public function create()
    {
        $this->param['btnRight']['text'] = 'Lihat Data';
        $this->param['btnRight']['link'] = route('user.index');

        return \view('user.tambah-user', $this->param);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email|unique:users',
            ],
            [
                'required' => ':attribute tidak boleh kosong.',
                'email' => 'Masukan email yang valid.',
                'unique' => ':attribute telah terdaftar',
            ],
            [
                'name' => 'Nama',
                'email' => 'Email',
            ]
        );

        try {
            $newUser = new User();

            $newUser->name = $request->get('name');
            $newUser->email = $request->get('email');
            $newUser->password = \Hash::make($request->get('email'));

            $newUser->save();

            return redirect()->route('user.index')->withStatus('Data berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->withError('Terjadi kesalahan. : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('user.index')->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            $this->param['title'] = 'User';
            $this->param['pageTitle'] = 'User';
            $this->param['pageIcon'] = 'users';
            $this->param['btnRight']['text'] = 'Lihat Data';
            $this->param['btnRight']['link'] = route('user.index');
            $this->param['user'] = User::find($id);

            return \view('user.edit-user', $this->param);
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $isUnique = $user->email == $request->email ? '' : '|unique:users';
        $validatedData = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email'.$isUnique,
            ],
            [
                'name.required' => ':attribute tidak boleh kosong.',
                'email.required' => ':attribute tidak boleh kosong.',
            ],
            [
                'name' => 'Nama',
                'email' => 'Email',
            ]
        );

        try {
            $user->name = $request->get('name');
            $user->email = $request->get('email');
            $user->save();

            return redirect()->route('user.index')->withStatus('Data berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->withError('Terjadi kesalahan : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();

            return redirect()->route('user.index')->withStatus('Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->withError('Terjadi kesalahan : '.$e->getMessage());
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('user.index')->withError('Terjadi kesalahan pada database : '.$e->getMessage());
        }
    }
}
