@extends('layouts.admin')
@section('page-title', 'Manajemen Pengguna')
@section('page-subtitle', 'Daftar semua pengguna')

@section('content')
<form action="{{ route('admin.users.index') }}" method="GET" class="flex items-center gap-2 mb-6">
    <div class="relative">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..."
               class="pl-9 pr-4 py-2 rounded-lg border border-gray-200 text-sm w-64">
        <svg class="absolute left-3 top-2.5 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    </div>
    <select name="role" onchange="this.form.submit()" class="px-3 py-2 rounded-lg border border-gray-200 text-sm bg-white">
        <option value="">Semua Role</option>
        <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
        <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
    </select>
</form>

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Pengguna</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Email</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Telepon</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Role</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Terdaftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-t border-gray-100 hover:bg-gray-50">
                    <td class="py-3 px-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary-400 to-accent-400 flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                                @if($user->avatar)
                                    <img src="{{ asset('storage/' . $user->avatar) }}" class="w-full h-full object-cover rounded-full">
                                @else
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                @endif
                            </div>
                            <span class="font-medium text-gray-800">{{ $user->name }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-4 text-gray-600">{{ $user->email }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $user->phone ?? '-' }}</td>
                    <td class="py-3 px-4">
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">{{ ucfirst($user->role) }}</span>
                    </td>
                    <td class="py-3 px-4 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-10 text-gray-400">Belum ada pengguna.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $users->links() }}</div>
@endsection
