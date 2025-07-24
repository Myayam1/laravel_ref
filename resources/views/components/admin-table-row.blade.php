<tr class="border-b border-gray-200 dark:border-gray-600">
    {{ $slot }}
    <td class="flex justify-start px-4 py-3">
        <div class="flex space-x-2">
            <button
                id="modalDetail"
                class="modalDetailBtn"
                {{ $attributes }}
                type="button">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-width="1" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                    <path stroke="currentColor" stroke-width="1" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>
            </button>
            <a href="{{ $route }}/edit/{{ $id }}">
                <svg class="w-6 h-6 text-gray-500 dark:text-white hover:text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                </svg>
            </a>
            <button id="deleteButton" data-id="{{$id}}" class="modalDeleteBtn text-red-600 hover:text-red-800">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                </svg>
            </button>
        </div>
    </td>
</tr>

<!-- Student detail modal -->
<div id="readStudentModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Name</dt>
                <dd id="modalStudentName" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>

                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Grade</dt>
                <dd id="modalStudentGrade" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>

                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Major</dt>
                <dd id="modalStudentMajor" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>

                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Email</dt>
                <dd id="modalStudentEmail" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>

                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Address</dt>
                <dd id="modalStudentAddress" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>
            </dl>
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <a id="editLinkStudent" type="button" href="/admin/{{ $route }}/edit/{{ $id }}" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grade detail modal -->
<div id="readGradeModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Name</dt>
                <dd id="modalGradeName" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>

                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Major</dt>
                <dd id="modalGradeMajor" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>

                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Students Count</dt>
                <dd id="modalStudentsCount" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>
            </dl>
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <a id="editLinkGrade" type="button" href="/admin/{{ $route }}/edit/{{ $id }}" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="readMajorModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
            <!-- Modal header -->
            <dl>
                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Name</dt>
                <dd id="modalMajorName" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>

                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Description</dt>
                <dd id="modalMajorDesc" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>

                <dt class="mb-2 font-semibold leading-none text-gray-900 dark:text-white">Grade Count</dt>
                <dd id="modalGradeCount" class="mb-4 font-light text-gray-500 sm:mb-5 dark:text-gray-400"></dd>
            </dl>
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <a id="editLinkMajor" type="button" href="/admin/{{ $route }}/edit/{{ $id }}" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg aria-hidden="true" class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path><path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path></svg>
                        Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden flex justify-center items-center bg-gray-800 bg-opacity-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
        <h3 class="text-lg font-semibold text-gray-800">Apakah anda yakin untuk menghapus data ini?</h3>
        <p class="text-sm text-gray-600 mt-2">Data tidak bisa dikembalikan setelah dihapus.</p>
        <div class="mt-4 flex justify-end space-x-4">
            <!-- Tombol Cancel -->
            <button id="cancelDelete" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">Batal</button>
            <!-- Tombol Confirm -->
            <button id="confirmDelete" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">Hapus</button>
        </div>
    </div>
</div>

<!-- Form for DELETE Request -->
<form id="deleteForm" action="/admin/{{ $route }}/delete/{{ $id }}" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>
