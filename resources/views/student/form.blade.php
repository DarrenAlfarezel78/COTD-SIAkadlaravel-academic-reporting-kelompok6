<div
    x-show="openCreate"
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-white p-8 rounded-2xl w-full max-w-lg">

        <h2 class="text-2xl font-bold mb-4">
            Tambah Data Mahasiswa
        </h2>

        <form action="{{ route('student.store') }}" method="POST">
            @csrf

            <input type="text"
                name="name"
                placeholder="Name"
                class="w-full border p-3 rounded-lg mb-4">

            <input type="email"
                name="email"
                placeholder="Email"
                class="w-full border p-3 rounded-lg mb-4">

            <div class="flex justify-end gap-3">

                <button
                    type="button"
                    @click="openCreate = false"
                    class="bg-gray-300 px-4 py-2 rounded-lg">
                        Batal
                </button>

                <button
                    type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Simpan
                </button>

            </div>

        </form>
    </div>

</div>

<!-- EDIT MODAL -->
<div
    x-show="openEdit"
    class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">

    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl p-8">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold text-gray-800">
                Ubah Data Mahasiswa
            </h2>

            <button
                @click="openEdit = false"
                class="text-2xl text-gray-500 hover:text-gray-700">
                &times;
            </button>

        </div>

        <!-- Form -->
        <form
            :action="'/students/' + student.id"
            method="POST"
            class="space-y-5">

            @csrf
            @method('PUT')

            <!-- Name -->
            <div>

                <label class="block text-gray-700 font-medium mb-2">
                    Nama
                </label>

                <input
                    type="text"
                    name="name"
                    x-model="student.name" // fill the name field
                    class="w-full border border-gray-300 rounded-lg px-4 py-3">

            </div>

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-medium mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    x-model="student.email" // fill the email field
                    class="w-full border border-gray-300 rounded-lg px-4 py-3">
            </div>

            <!-- Footer -->
            <div class="flex justify-end gap-3 pt-4">

                <button
                    type="button"
                    @click="openEdit = false"
                    class="bg-gray-300 hover:bg-gray-400 px-5 py-2 rounded-lg">
                        Batal
                </button>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                    Simpan
                </button>

            </div>

        </form>

    </div>

</div>