@foreach ($grades as $index => $grade)
<x-admin-table-row
    data-nama="{{ $grade->nama }}"
    data-major="{{ $grade->major->nama }}"
    data-student-count="{{ $grade->students->count() }}"
    data-modal-target="readGradeModal"
    data-modal-toggle="readGradeModal"
    data-id="{{ $grade->id }}"
>
    <x-slot:route>{{ "grades" }}</x-slot>
    <x-slot:id>{{ $grade->id }}</x-slot>
    <td class="px-4 py-3">{{ $index + 1 }}</td>
    <td class="px-4 py-3">{{ $grade->grade }} {{ $grade->major->nama }} {{ $grade->class_number }}</td>
    <td class="px-4 py-3">{{ $grade->major->nama }}</td>
    <td class="px-4 py-3">
        @if ($grade->students->count() == 0)
        {{ "Tidak ada murid di kelas ini." }}
        @else
        {{ $grade->students->count() }}
        @endif
    </td>
    <td class="px-4 py-3">{{ $grade->created_at }}</td>
</x-admin-table-row>
@endforeach
