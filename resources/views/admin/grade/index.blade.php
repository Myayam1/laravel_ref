<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-admin-table>
        <x-slot:form>
            <form class="flex items-center justify-end">
                <div class="px-2">
                    <select id="grade" name="grade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="">All grades   </option>
                        <option value="10" {{ request()->input('grade') == '10' ? 'selected' : '' }}>10</option>
                        <option value="11" {{ request()->input('grade') == '11' ? 'selected' : '' }}>11</option>
                        <option value="12" {{ request()->input('grade') == '12' ? 'selected' : '' }}>12</option>
                    </select>
                </div>
                <div class="px-2">
                    <select id="major" name="major" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option value="">All majors   </option>
                        <option value="PPLG" {{ request()->input('major') == 'PPLG' ? 'selected' : '' }}>PPLG</option>
                        <option value="Animasi 3D" {{ request()->input('major') == 'Animasi 3D' ? 'selected' : '' }}>Animasi 3D</option>
                        <option value="Animasi 2D" {{ request()->input('major') == 'Animasi 2D' ? 'selected' : '' }}>Animasi 2D</option>
                        <option value="DKV DG" {{ request()->input('major') == 'DKV DG' ? 'selected' : '' }}>DKV DG</option>
                        <option value="DKV TG" {{ request()->input('major') == 'DKV TG' ? 'selected' : '' }}>DKV TG</option>
                    </select>
                </div>
            </form>
        </x-slot>
        <x-slot:route>{{ "grades" }}</x-slot>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr class="border-b border-gray-200 dark:border-gray-600">
                <th class="px-4 py-3">No</th>
                <th class="px-4 py-3">Nama Kelas</th>
                <th class="px-4 py-3">Jurusan</th>
                <th class="px-4 py-3">Jumlah Murid</th>
                <th class="px-4 py-3">Tanggal Dibuat</th>
                <th class="px-4 py-3">Actions</th>
            </tr>
        </thead>
        <tbody id="table-body">
            @foreach ($grades as $index => $grade)
            <x-admin-table-row
                data-nama="{{ $grade->grade }} {{ $grade->major->nama }} {{ $grade->class_number }}"
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
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="p-4 text-center">
                    {{ $grades->links() }}
                </td>
            </tr>
        </tfoot>
    </x-admin-table>
</x-admin-layout>

<script>
    function fetchFilteredProducts() {
        var grade = $('#grade').val();
        var major = $('#major').val();

        $.ajax({
            url: "{{ route('admin.grades.index') }}", // Send request to the same route
            method: 'GET',
            data: {
                grade: grade,
                major: major
            },
            success: function(response) {
                console.log(response)
                $('#table-body').html(response);
            }
        });
    }

    $('#grade').on('change', function() {
        fetchFilteredProducts(); // Trigger the AJAX request when the category dropdown value changes
    });

    $('#major').on('change', function() {
        fetchFilteredProducts(); // Trigger the AJAX request when the price range dropdown value changes
    });

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.modalDetailBtn').forEach(button => {
            button.addEventListener('click', function () {
                const name = button.getAttribute('data-nama');
                const major = button.getAttribute('data-major');
                const studentCount = button.getAttribute('data-student-count');
                const id = button.getAttribute('data-id');

                document.getElementById('modalGradeName').innerText = name;
                document.getElementById('modalGradeMajor').innerText = major;
                document.getElementById('modalStudentsCount').innerText = studentCount;

                const editLink = document.getElementById('editLink');
                editLink.setAttribute('href', `grades/edit/${id}`);
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
        form.action = '/admin/grades/delete/' + idToDelete;

        // Submit the form to delete the record
        form.submit();
    });
</script>
