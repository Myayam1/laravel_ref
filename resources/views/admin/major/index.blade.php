<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-admin-table>
        <x-slot:route>{{ "majors" }}</x-slot>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <th scope="col" class="px-4 py-3">No</th>
            <th scope="col" class="px-4 py-3">Nama Jurusan</th>
            <th scope="col" class="px-4 py-3">Deskripsi</th>
            <th scope="col" class="px-4 py-3">Jumlah Kelas</th>
            <th scope="col" class="px-4 py-3">Actions</th>
        </thead>
        <tbody>
            @foreach ($majors as $major)
            <x-admin-table-row
                data-nama="{{ $major->nama }}"
                data-desc="{{ $major->desc }}"
                data-id="{{ $major->id }}"
                data-grade-count="{{ $major->grades->count() }}"
                data-modal-target="readMajorModal"
                data-modal-toggle="readMajorModal"
            >
            <x-slot:route>{{ "majors" }}</x-slot>
            <x-slot:id>{{ $major->id }}</x-slot>
                <td class="py-4 px-3">{{ $major->id }}</td>
                <td class="py-4 px-3">{{ $major->nama }}</td>
                <td class="py-4 px-3">{{ $major->desc }}</td>
                <td class="py-4 px-3">
                    @if ($major->grades->count() == 0)
                        {{ "Tidak ada kelas di jurusan ini" }}
                    @else
                        {{ $major->grades->count() }}
                    @endif
                </td>
            </x-admin-table-row>
            @endforeach
        </tbody>
    </x-admin-table>
</x-admin-layout>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.modalDetailBtn').forEach(button => {
            button.addEventListener('click', function () {
                const name = button.getAttribute('data-nama');
                const desc = button.getAttribute('data-desc');
                const gradeCount = button.getAttribute('data-grade-count');
                const id = button.getAttribute('data-id');

                document.getElementById('modalMajorName').innerText = name;
                document.getElementById('modalMajorDesc').innerText = desc;
                document.getElementById('modalGradeCount').innerText = gradeCount;

                const editLink = document.getElementById('editLinkMajor');
                editLink.setAttribute('href', `majors/edit/${id}`);
            });
        });
    });

    //script untuk modal delete
    // Ambil elemen modal dan tombol delete
    const deleteModal = document.getElementById('deleteModal');
    const deleteButtons = document.querySelectorAll('#deleteButton');
    const confirmDeleteButton = document.getElementById('confirmDelete');
    const cancelDeleteButton = document.getElementById('cancelDelete');

    // Variable untuk menyimpan ID yang ingin dihapus
    let idToDelete = null;

    // Ketika tombol delete ditekan
    deleteButtons.forEach(deleteButton => {
        deleteButton.addEventListener('click', function () {
            idToDelete = deleteButton.getAttribute('data-id');

            deleteModal.classList.remove('hidden');
        });
    });

    // Close delete modal on cancel
    cancelDeleteButton.addEventListener('click', function () {
        deleteModal.classList.add('hidden');
    });

    // Confirm delete action
    confirmDeleteButton.addEventListener('click', function () {
        console.log("hello");
        // Find the form and set the action for deletion
        const form = document.getElementById('deleteForm');
        form.action = '/admin/majors/delete/' + idToDelete;

        // Submit the form to delete the record
        form.submit();
    });
</script>