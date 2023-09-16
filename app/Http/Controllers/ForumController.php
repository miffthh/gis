<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Forum;
use App\Models\Komentar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;


class ForumController extends Controller
{
    public function forum(Request $request)
    {
        // Mengambil nilai input judul dari form pencarian
        $judul = $request->input('judul');

        // Cek apakah ada input judul yang diberikan
        if ($judul) {
            // Jika ada input judul, gunakan pencarian berdasarkan judul
            $forum = Forum::where('judul', 'like', '%' . $judul . '%')->orderBy('created_at', 'desc')->with('user')->get();
        } else {
            // Jika tidak ada input judul, tampilkan semua forum
            $forum = Forum::orderBy('created_at', 'desc')->with('user')->get();
        }

        return view('forum.forum', compact('forum'))->with('title', 'Forum');
    }

    public function aksi_tambah_forum(Request $request)
    {
        $request->request->add(['nip' => auth()->user()->id]);
        $forum = Forum::create($request->all());

        Alert::success('Forum Berhasil di Tambahkan', 'Success.');
        return redirect()->back();
    }
    public function view($id)
    {
        $forum = Forum::with('komentar.user')->findOrFail($id);
        return view('forum.view', compact('forum'))->with('title', 'Detail Forum');
    }

    public function post_komentar(Request $request)
    {
        $request->request->add(['nip' => auth()->user()->id]);
        $komentar = Komentar::create($request->all());

        Alert::success('Komentar Berhasil di Tambahkan', 'Success.');
        return redirect()->back();
    }

    public function like(Request $request)
    {
        $forum = Forum::findOrFail($request->forum_id);

        // Periksa apakah pengguna sudah melakukan like sebelumnya
        if ($forum->isLikedByUser(auth()->user())) {
            // Pengguna telah melakukan like sebelumnya, maka lakukan unlike
            $forum->likes()->where('user_id', auth()->user()->id)->delete();
        } else {
            // Pengguna belum melakukan like, maka lakukan like baru
            $forum->likes()->create([
                'user_id' => optional(auth()->user())->id
            ]);
        }

        // Ambil jumlah total like setelah perubahan
        $totalLikes = $forum->likes()->count();

        return response()->json([
            'total_like' => $totalLikes
        ]);
    }
    public function edit_forum($id)
    {
        $forum = Forum::findOrFail($id);
        return view('forum.edit', compact('forum'))->with('title', 'Edit Forum');
    }

    public function aksi_edit_forum(Request $request, $id)
    {
        $forum = Forum::findOrFail($id);
        // Check if the current user is the owner of the forum or is an admin
        if (auth()->user()->id !== $forum->user_id && auth()->user()->role !== 'Admin') {
            // Redirect back with an error message or show an error page
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }
        $forum->update($request->all());

        Alert::success('Forum Berhasil di Edit', 'Success.');
        return redirect()->route('forum');
    }

    public function hapus_forum($id)
    {
        $forum = Forum::findOrFail($id);

        // Check if the current user is the owner of the forum or is an admin
        if (auth()->user()->id !== $forum->user_id && auth()->user()->role !== 'Admin') {
            // Redirect back with an error message or show an error page
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }

        $forum->delete();

        // Alert::success('Forum Berhasil di Hapus', 'Success.');
        return redirect()->route('forum');
    }

    public function edit_komentar($id)
    {
        $komentar = Komentar::findOrFail($id);

        // Periksa apakah pengguna yang sedang login adalah pemilik komentar atau admin
        if (auth()->user()->id !== $komentar->nip && auth()->user()->role !== 'Admin') {
            return redirect()->back()->with('error', 'You are not authorized to edit this comment.');
        }

        return view('forum.edit_komentar', compact('komentar'))->with('title', 'Edit Komentar');
    }

    public function aksi_edit_komentar(Request $request, $id)
    {
        $komentar = Komentar::findOrFail($id);

        // Periksa apakah pengguna yang sedang login adalah pemilik komentar atau admin
        if (auth()->user()->id !== $komentar->nip && auth()->user()->role !== 'Admin') {
            return redirect()->back()->with('error', 'You are not authorized to edit this comment.');
        }

        $komentar->update($request->all());

        return redirect()->route('forum.view', ['id' => $komentar->forum_id])->with('success', 'Comment updated successfully.');
    }

    public function hapus_komentar($id)
    {
        $komentar = Komentar::findOrFail($id);

        // Periksa apakah pengguna yang sedang login adalah pemilik komentar atau admin
        if (auth()->user()->id !== $komentar->nip && auth()->user()->role !== 'Admin') {
            return redirect()->back()->with('error', 'You are not authorized to delete this comment.');
        }

        $komentar->delete();

        return redirect()->route('forum.view', ['id' => $komentar->forum_id])->with('success', 'Comment deleted successfully.');
    }
}
