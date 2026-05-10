<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIAkad: Sistem Informasi Akademik</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>

    <body class="bg-gray-100 min-h-screen">

        {{-- x-data is an Alpine.js directive
        it can change the 'parameter' such as openCreate from false to true and fill the student object --}}
        <div x-data="{
        openCreate: false,
        openEdit: false,
        student: { id: '', npm: '', name: '', email: '', prodi: '', angkatan: '', status: '', gender: '' }
    }">
            <div class="max-w-4xl mx-auto py-10 px-6">

            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-4xl font-bold text-gray-800">
                        SIAkad
                    </h1>
                    <p class="text-gray-500 mt-2">
                        Sistem Informasi Akademik
                    </p>
                </div>

                <button
                    @click="openCreate = true"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-3 rounded-lg">
                    + Add Student
                </button>
            </div>
        
            <!-- Card -->
            <div class="bg-white rounded-2xl shadow-md overflow-hidden">

                <!-- Table Header -->
                <div class="grid grid-cols-3 bg-gray-50 border-b px-6 py-4 font-semibold text-gray-700">
                    <div>Name</div>
                    <div>Email</div>
                    <div class="text-center">Action</div>
                </div>

                <!-- Student Data -->
                @foreach($students as $student)
                    <div class="grid grid-cols-3 items-center px-6 py-4 border-b hover:bg-gray-50 transition">

                        <!-- Name -->
                        <div class="font-medium text-gray-800">
                            {{ $student->name }}
                        </div>

                        <!-- Email -->
                        <div class="text-gray-600">
                            {{ $student->email }}
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-center gap-3">

                            <!-- Edit -->
                            <button 
                                @click="
                                openEdit = true;
                                    student.id = '{{ $student->id }}';
                                    student.npm = '{{ $student->npm }}';
                                    student.name = '{{ $student->name }}';
                                    student.email = '{{ $student->email }}';
                                    student.prodi = '{{ $student->prodi }}';
                                    student.angkatan = '{{ $student->angkatan }}';
                                    student.status = '{{ $student->status }}';
                                    student.gender = '{{ $student->gender }}';"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg transition">
                                Ubah Data
                            </button>

                            <!-- Delete -->
                            <form
                                action="{{ route('student.destroy', $student->id) }}"
                                method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this student?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </div>
                @endforeach
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-10 mb-12">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 text-center">Mahasiswa per Program Studi</h3>
                    <canvas id="prodiChart"></canvas>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 text-center">Pertumbuhan Mahasiswa per Angkatan</h3>
                    <canvas id="angkatanChart"></canvas>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 text-center">Mahasiswa Lulus per Angkatan</h3>
                    <canvas id="lulusChart"></canvas>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4 text-center">Rasio Gender Mahasiswa</h3>
                    <div class="max-w-75px mx-auto">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
            </div>
            {{-- Modal --}}
            @include('student.form')

        </div>
        <script>
            // Konfigurasi Warna
            const blueColor = '#3b82f6';
            const pinkColor = '#ec4899';
            const colors = ['#6366f1', '#8b5cf6', '#d946ef', '#f43f5e', '#f59e0b'];

            // 1. Bar Chart: Jumlah Mahasiswa tiap Prodi [cite: 119]
            new Chart(document.getElementById('prodiChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($prodiData->pluck('prodi')) !!},
                    datasets: [{
                        label: 'Jumlah Mahasiswa',
                        data: {!! json_encode($prodiData->pluck('total')) !!},
                        backgroundColor: blueColor,
                        borderRadius: 8
                    }]
                },
                options: { responsive: true, plugins: { legend: { display: false } } }
            });

            // 2. Line Chart: Jumlah Mahasiswa tiap Angkatan [cite: 120]
            new Chart(document.getElementById('angkatanChart'), {
                type: 'line',
                data: {
                    labels: {!! json_encode($angkatanData->pluck('angkatan')) !!},
                    datasets: [{
                        label: 'Total Mahasiswa',
                        data: {!! json_encode($angkatanData->pluck('total')) !!},
                        borderColor: '#10b981',
                        backgroundColor: '#10b981',
                        tension: 0.4,
                        fill: false
                    }]
                }
            });

            // 3. Bar/Line Chart: Mahasiswa Lulus tiap Angkatan [cite: 120]
            new Chart(document.getElementById('lulusChart'), {
                type: 'bar',
                data: {
                    labels: {!! json_encode($lulusData->pluck('angkatan')) !!},
                    datasets: [{
                        label: 'Mahasiswa Lulus',
                        data: {!! json_encode($lulusData->pluck('total')) !!},
                        backgroundColor: '#f59e0b',
                        borderRadius: 8
                    }]
                }
            });

            // 4. Pie Chart: Rasio Gender Mahasiswa [cite: 121]
            new Chart(document.getElementById('genderChart'), {
                type: 'pie',
                data: {
                    labels: {!! json_encode($genderData->pluck('gender')) !!},
                    datasets: [{
                        data: {!! json_encode($genderData->pluck('total')) !!},
                        backgroundColor: [blueColor, pinkColor],
                        hoverOffset: 4
                    }]
                },
                options: { responsive: true }
            });
        </script>
    </body>
</html>