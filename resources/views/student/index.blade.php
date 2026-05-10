<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIAkad: Sistem Informasi Akademik</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="bg-gray-100 min-h-screen">

        {{-- x-data is an Alpine.js directive
        it can change the 'parameter' such as openCreate from false to true and fill the student object --}}
        <div x-data="{
            openCreate: false,
            openEdit: false,
            openShow: false,

            student: { id: '', name: '', email: '' }
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
                                    student.name = '{{ $student->name }}';
                                    student.email = '{{ $student->email }}';"
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

            {{-- Modal --}}
            @include('student.form')

        </div>
        
    </body>
</html>