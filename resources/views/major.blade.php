<x-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">No</th>
                    <th class="py-3 px-6 text-left">Nama Jurusan</th>
                    <th class="py-3 px-6 text-left">Kelas</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach ($majors as $major)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">{{ $major->id }}</td>
                        <td class="py-3 px-6">{{ $major->nama }}</td>
                        <td class="py-3 px-6">
                            @foreach ($major->grades as $grade)
                                <ul>
                                    <li>{{ $grade->nama }}</li>
                                </ul>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
