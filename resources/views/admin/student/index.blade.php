<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <x-admin-table>
        <x-slot:route>{{ "students" }}</x-slot>
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
                <div class="w-full md:w-1/2 px-2">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" id="search" value="{{ request()->input('search') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
                    </div>
                </div>
            </form>
        </x-slot>
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <th scope="col" class="px-4 py-3">No</th>
            <th scope="col" class="px-4 py-3">Nama</th>
            <th scope="col" class="px-4 py-3">Kelas</th>
            <th scope="col" class="px-4 py-3">Jurusan</th>
            <th scope="col" class="px-4 py-3">Email</th>
            <th scope="col" class="px-4 py-3">Alamat</th>
            <th scope="col" class="px-4 py-3">Actions</th>
        </thead>
        <tbody id="table-body">
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
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="p-4 text-center">
                    {{ $students->links() }}
                </td>
            </tr>
        </tfoot>
    </x-admin-table>
</x-admin-layout>

<script>
    function fetchFilteredProducts() {
            var search = $('#search').val();
            var grade = $('#grade').val();
            var major = $('#major').val();

            console.log("http://127.0.0.1:8000/admin/students?search="+search+"&grade="+grade+"&major="+major)

            $.ajax({
                url: "{{ route('admin.students.index') }}", // Send request to the same route
                method: 'GET',
                data: {
                    search: search,
                    grade: grade,
                    major: major
                },
                success: function(response) {
                    console.log(response)
                    $('#table-body').html(response);  // This will replace the entire HTML
                }
            });
        }

        // Event listeners for the input and dropdowns
        $('#search').on('input', function() {
            fetchFilteredProducts(); // Trigger the AJAX request when the user types in the search input
        });

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
                const grade = button.getAttribute('data-grade');
                const major = button.getAttribute('data-major');
                const email = button.getAttribute('data-email');
                const address = button.getAttribute('data-alamat');
                const id = button.getAttribute('data-id');

                document.getElementById('modalStudentName').innerText = name;
                document.getElementById('modalStudentGrade').innerText = grade;
                document.getElementById('modalStudentMajor').innerText = major;
                document.getElementById('modalStudentEmail').innerText = email;
                document.getElementById('modalStudentAddress').innerText = address;

                const editLink = document.getElementById('editLinkStudent');
                editLink.setAttribute('href', `students/edit/${id}`);
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
    let studentIdToDelete = null;

    // Ketika tombol delete ditekan
    deleteButtons.forEach(deleteButton => {
        deleteButton.addEventListener('click', function () {
            studentIdToDelete = deleteButton.getAttribute('data-id');

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
        form.action = '/admin/students/delete/' + studentIdToDelete;

        // Submit the form to delete the record
        form.submit();
    });
</script>
