<?php
namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('kelas')->paginate(10);
        return view('admin.akun.index', compact('users'));
    }

    public function edit(User $user)
    {
        $kelas = Kelas::all();
        return view('admin.akun.edit', compact('user', 'kelas'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:murid,guru,admin',
            'kelas_id' => 'nullable|exists:kelas,id'
        ]);

        $user->update([
            'role' => $request->role,
            'kelas_id' => $request->kelas_id
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Akun berhasil diperbarui.');
    }
}
