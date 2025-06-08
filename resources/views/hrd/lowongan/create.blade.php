@extends('layouts.hrd')

@section('title', 'Tambah Lowongan')

@section('header', 'Tambah Lowongan')

@section('content')
<div class="bg-white rounded-lg shadow-sm p-6">
    <form action="{{ route('hrd.lowongan.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="grid grid-cols-2 gap-6">
            <!-- Judul -->
            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Lowongan</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                    class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                @error('judul')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Posisi -->
            <div>
                <label for="posisi" class="block text-sm font-medium text-gray-700 mb-1">Posisi</label>
                <input type="text" name="posisi" id="posisi" value="{{ old('posisi') }}" required
                    class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                @error('posisi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tipe Pekerjaan -->
            <div>
                <label for="tipe_pekerjaan" class="block text-sm font-medium text-gray-700 mb-1">Tipe Pekerjaan</label>
                <select name="tipe_pekerjaan" id="tipe_pekerjaan" required
                    class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                    <option value="">Pilih Tipe</option>
                    <option value="Full-time" {{ old('tipe_pekerjaan') === 'Full-time' ? 'selected' : '' }}>Full-time</option>
                    <option value="Part-time" {{ old('tipe_pekerjaan') === 'Part-time' ? 'selected' : '' }}>Part-time</option>
                    <option value="Contract" {{ old('tipe_pekerjaan') === 'Contract' ? 'selected' : '' }}>Contract</option>
                    <option value="Internship" {{ old('tipe_pekerjaan') === 'Internship' ? 'selected' : '' }}>Internship</option>
                </select>
                @error('tipe_pekerjaan')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Lokasi -->
            <div>
                <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" required
                    class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                @error('lokasi')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Gaji -->
            <div>
                <label for="gaji_min" class="block text-sm font-medium text-gray-700 mb-1">Gaji Minimum</label>
                <input type="number" name="gaji_min" id="gaji_min" value="{{ old('gaji_min') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                @error('gaji_min')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="gaji_max" class="block text-sm font-medium text-gray-700 mb-1">Gaji Maximum</label>
                <input type="number" name="gaji_max" id="gaji_max" value="{{ old('gaji_max') }}"
                    class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                @error('gaji_max')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Tanggal Tutup -->
            <div>
                <label for="tanggal_tutup" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Tutup</label>
                <input type="date" name="tanggal_tutup" id="tanggal_tutup" value="{{ old('tanggal_tutup') }}" required
                    class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                @error('tanggal_tutup')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status" id="status" required
                    class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">
                    <option value="1" {{ old('status', '1') === '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>Draft</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" required
                class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">{{ old('deskripsi') }}</textarea>
            @error('deskripsi')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Persyaratan -->
        <div>
            <label for="persyaratan" class="block text-sm font-medium text-gray-700 mb-1">Persyaratan</label>
            <textarea name="persyaratan" id="persyaratan" rows="4" required
                class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">{{ old('persyaratan') }}</textarea>
            @error('persyaratan')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tanggung Jawab -->
        <div>
            <label for="tanggung_jawab" class="block text-sm font-medium text-gray-700 mb-1">Tanggung Jawab</label>
            <textarea name="tanggung_jawab" id="tanggung_jawab" rows="4" required
                class="w-full rounded-lg border-gray-300 focus:border-purple-500 focus:ring-purple-500">{{ old('tanggung_jawab') }}</textarea>
            @error('tanggung_jawab')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('hrd.lowongan') }}" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                Batal
            </a>
            <button type="submit" class="px-4 py-2 text-white bg-purple-600 rounded-lg hover:bg-purple-700">
                Simpan Lowongan
            </button>
        </div>
    </form>
</div>
@endsection 