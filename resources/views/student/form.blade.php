<div x-show="openCreate" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white p-8 rounded-2xl w-full max-w-lg overflow-y-auto max-h-[90vh]">
        <h2 class="text-2xl font-bold mb-4">Tambah Data Mahasiswa</h2>
        <form action="{{ route('student.store') }}" method="POST">
            @csrf
            <input type="text" name="npm" placeholder="NPM (Contoh: 22082010001)" class="w-full border p-3 rounded-lg mb-4" required>
            
            <input type="text" name="name" placeholder="Nama Lengkap" class="w-full border p-3 rounded-lg mb-4" required>
            
            <input type="email" name="email" placeholder="Email" class="w-full border p-3 rounded-lg mb-4" required>

            <select name="prodi" class="w-full border p-3 rounded-lg mb-4" required>
                <option value="">Pilih Program Studi</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
                <option value="Informatika">Informatika</option>
                <option value="Sains Data">Sains Data</option>
                <option value="Bisnis Digital">Bisnis Digital</option>
            </select>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <input type="number" name="angkatan" placeholder="Angkatan (Tahun)" class="border p-3 rounded-lg" required>
                <select name="gender" class="border p-3 rounded-lg" required>
                    <option value="">Pilih Gender</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>

            <select name="status" class="w-full border p-3 rounded-lg mb-4" required>
                <option value="aktif">Aktif</option>
                <option value="cuti">Cuti</option>
                <option value="lulus">Lulus</option>
            </select>

            <div class="flex justify-end gap-3 mt-4">
                <button type="button" @click="openCreate = false" class="bg-gray-300 px-4 py-2 rounded-lg">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div x-show="openEdit" class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-8 overflow-y-auto max-h-[90vh]">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Ubah Data Mahasiswa</h2>
            <button @click="openEdit = false" class="text-2xl text-gray-500 hover:text-gray-700">&times;</button>
        </div>

        <form :action="'/student/' + student.id" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-medium mb-1">NPM</label>
                <input type="text" name="npm" x-model="student.npm" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama</label>
                <input type="text" name="name" x-model="student.name" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" x-model="student.email" class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Prodi</label>
                    <select name="prodi" x-model="student.prodi" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Informatika">Informatika</option>
                        <option value="Sains Data">Sains Data</option>
                        <option value="Bisnis Digital">Bisnis Digital</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Angkatan</label>
                    <input type="number" name="angkatan" x-model="student.angkatan" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Gender</label>
                    <select name="gender" x-model="student.gender" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <option value="Laki-laki">Laki-laki</option>
                        <option value="Perempuan">Perempuan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Status</label>
                    <select name="status" x-model="student.status" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                        <option value="aktif">Aktif</option>
                        <option value="cuti">Cuti</option>
                        <option value="lulus">Lulus</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" @click="openEdit = false" class="bg-gray-300 hover:bg-gray-400 px-5 py-2 rounded-lg">Batal</button>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">Simpan</button>
            </div>
        </form>
    </div>
</div>