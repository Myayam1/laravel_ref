@foreach ($students as $student)
<x-admin-table-row
    data-nama="{{  $student->nama }}"
    data-grade="{{ $student->grade->nama }}"
    data-major="{{ $student->grade->major->nama }}"
    data-email="{{ $student->email }}"
    data-alamat="{{ $student->alamat }}"
    data-id="{{ $student->id }}"
    data-modal-target="readStudentModal"
    data-modal-toggle="readStudentModal"
>
    <x-slot:route>{{ "students" }}</x-slot>
    <x-slot:id>{{ $student->id }}</x-slot>

    <td class="px-4 py-3">{{ $student->id }}</td>
    <td class="px-4 py-3">{{ $student->nama }}</td>
    <td class="px-4 py-3">{{ $student->grade->grade }} {{ $student->grade->major->nama }} {{ $student->grade->class_number }}</td>
    <td class="px-4 py-3">{{ $student->grade->major->nama }}</td>
    <td class="px-4 py-3">{{ $student->email }}</td>
    <td class="px-4 py-3">{{ $student->alamat }}</td>
</x-admin-table-row>
@endforeach
