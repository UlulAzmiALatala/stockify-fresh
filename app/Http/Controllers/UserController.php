<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna dengan paginasi dan pencarian.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Logika pencarian berdasarkan nama atau email
        if ($request->filled('search')) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm);
            });
        }

        $users = $query->latest()->paginate(10);

        return view('app.pages.users.index', compact('users'));
    }

    /**
     * Menyimpan pengguna baru ke dalam database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:Admin,Manajer Gudang,Staff Gudang'], // Sesuaikan dengan enum di database
        ]);

        // Membuat user baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Password di-hash demi keamanan
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    /**
     * Memperbarui data pengguna.
     */
    public function update(Request $request, User $user)
    {
        // Validasi input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class . ',email,' . $user->id],
            'role' => ['required', 'in:Admin,Manajer Gudang,Staff Gudang'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()], // Password opsional
        ]);

        // Menyiapkan data untuk di-update
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Jika password diisi, update passwordnya
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        return redirect()->route('users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna dari database.
     */
    public function destroy(User $user)
    {
        // Mencegah pengguna menghapus dirinya sendiri
        if (auth()->id() == $user->id) {
            return redirect()->route('users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
