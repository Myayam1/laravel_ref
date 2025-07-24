<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">Nama</th>
                    <th class="py-3 px-6 text-left">Kelas</th>
                    <th class="py-3 px-6 text-left">Jurusan</th>
                    <th class="py-3 px-6 text-left">Email</th>
                    <th class="py-3 px-6 text-left">Alamat</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($students as $student)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $student->id }}</td>
                        <td class="py-3 px-6">{{ $student->nama }}</td>
                        <td class="py-3 px-6">{{ $student->grade->nama }}</td>
                        <td class="py-3 px-6">{{ $student->grade->major->nama }}</td>
                        <td class="py-3 px-6">{{ $student['email'] }}</td>
                        <td class="py-3 px-6">{{ $student['alamat'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
