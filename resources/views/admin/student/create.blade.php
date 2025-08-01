<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new student</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/admin/students/store" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                    <!-- Nama -->
                    <div class="sm:col-span-3">
                        <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="nama" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type student name" required="">
                    </div>

                    <!-- Kelas -->
                    <div>
                        <label for="grade" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grade/Class</label>
                        <select id="grade" name="grade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>

                    <div>
                        <label for="major" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Major</label>
                        <select id="major_id" name="major_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <?php $majors = []; ?>
                            @foreach($grades as $grade)
                                @if (!in_array($grade->major->nama, $majors))
                                    <?php array_push($majors, $grade->major->nama); ?>
                                    <option value="{{ $grade->major_id }}", data-major-id="{{ $grade->major_id }}">{{ $grade->major->nama }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="class_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class Number</label>
                        <select id="class_number" name="class_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                        </select>
                    </div>

                    <!-- Email & Alamat -->
                    <div class="sm:col-span-3">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Type your email" required="">
                    </div>

                    <div class="sm:col-span-3">
                        <label for="alamat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <textarea id="alamat" name="alamat" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your address here"></textarea>
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Add Student
                </button>
            </form>
        </div>
    </section>
</x-admin-layout>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const gradeDropdown = document.getElementById("grade");
        const majorDropdown = document.getElementById("major_id");
        const classNumberDropdown = document.getElementById("class_number");

        // Store the original list of class numbers
        const allClassNumbers = [
            @foreach($grades as $grade)
            {
                value: "{{ $grade->class_number }}",
                grade: "{{ $grade->grade }}",
                major_id: "{{ $grade->major_id }}"
            },
            @endforeach
        ];

        function filterClassNumbers() {
            console.log("ello");
            const selectedGrade = gradeDropdown.value;
            const selectedMajor = majorDropdown.value;
            classNumberDropdown.innerHTML = ''

            // Filter and add matching options
            allClassNumbers.forEach(item => {
                if (item.grade === selectedGrade && item.major_id === selectedMajor) {
                    const option = document.createElement("option");
                    option.value = item.value;
                    option.textContent = item.value;
                    classNumberDropdown.appendChild(option);
                }
            });

            // Reset selection if no options are available
            if (classNumberDropdown.options.length === 1) {
                classNumberDropdown.value = "";
            }
        }

        // Apply filtering when grade or major changes
        gradeDropdown.addEventListener("change", filterClassNumbers);
        majorDropdown.addEventListener("change", filterClassNumbers);

        // Run once on page load to set the correct state
        filterClassNumbers();
    });
</script>
