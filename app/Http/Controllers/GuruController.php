<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Guru;

class GuruController extends Controller
{
    //menampilkan data guru
    public function index() {
        $guru = Guru::all();
        return view('guru', compact('guru'));
    }

    // hapus sementara
    public function hapus($id) {
        $guru = Guru::find($id);
        $guru->delete();

        return redirect('/guru');
    }

    // menmpilkan data guru yg sudah dihapus
    public function trash() {
        // mengambil data guru yg sudah dihapus
        $guru = Guru::onlyTrashed()->get();
        return view('guru_trash', compact('guru'));
    }

    // restore data guru dihapus
    public function kembalikan($id) {
        $guru = Guru::onlyTrashed()->where('id',$id);
        $guru->restore();
        return redirect('/guru/trash');
    }

    // restore semua data guru yg sudah dihapus
    public function kembalikan_semua() {
        $guru = Guru::onlyTrashed();
        $guru->restore();

        return redirect('/guru/trash');
    }

    // hapus permanen
    public function hapus_permanen($id) {

        // hapus permanen data guru
        $guru = Guru::onlyTrashed()->where('id',$id);
        $guru->forceDelete();

        return redirect('/guru/trash');

    }

    // hapus permanen semua guru yg sudah dihapus
    public function hapus_permanen_semua() {
        // hapus permanen semua data guru yg sudah dihapus
        $guru = Guru::onlyTrashed();
        $guru->forceDelete();

        return redirect('/guru/trash');
    }
}
