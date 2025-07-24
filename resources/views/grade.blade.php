<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-300 text-gray-800 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left border-b border-gray-400">No</th>
                    <th class="py-3 px-6 text-left border-b border-gray-400">Nama Kelas</th>
                    <th class="py-3 px-6 text-left border-b border-gray-400">Jurusan</th>
                    <th class="py-3 px-6 text-left border-b border-gray-400">Murid</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 text-sm font-light">
                @foreach ($grades as $index => $grade)
                    <tr class="border-b border-gray-300 hover:bg-gray-200 transition-colors duration-300">
                        <td class="py-3 px-6">{{ $index + 1 }}</td>
                        <td class="py-3 px-6">{{ $grade->nama }}</td>
                        <td class="py-3 px-6">{{ $grade->major->nama }}</td>
                        <td class="py-3 px-6">
                            <ul class="list-disc list-inside">
                                @foreach ($grade->students as $student)
                                    <li>{{ $student->nama }}</li>
                                @endforeach
                                @if ($grade->students->isEmpty())
                                    <li class="italic text-gray-500">No students enrolled</li>
                                @endif
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
