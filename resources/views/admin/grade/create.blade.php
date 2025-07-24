<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a new grade</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/admin/grades/store" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                    <div>
                        <label for="grade" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grade/Class</label>
                        <select id="grade" name="grade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>

                    <div>
                        <label for="major" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Major/Department</label>
                        <select id="major_id" name="major_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach($majors as $major)
                                <option value="{{ $major->id }}">{{ $major->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="class_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class Number</label>
                        <select id="class_number" name="class_number" class="pointer-events-none cursor-not-allowed bg-gray-50 border border-gray-200 text-gray-500 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">

                        </select>
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Add Grade
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
            const selectedGrade = gradeDropdown.value;
            const selectedMajor = majorDropdown.value;
            classNumberDropdown.innerHTML = ''; // Clear dropdown options

            let highestNumber = 0;

            allClassNumbers.forEach(item => {
                if (item.grade === selectedGrade && item.major_id === selectedMajor) {
                    highestNumber = highestNumber < item.value ? item.value : highestNumber;
                }
            });

            highestNumber++;

            if (highestNumber > 0) {
                const option = document.createElement("option");
                option.value = highestNumber;
                option.textContent = highestNumber;
                classNumberDropdown.appendChild(option);
                classNumberDropdown.value = option.value;
            }
        }


        // Apply filtering when grade or major changes
        gradeDropdown.addEventListener("change", filterClassNumbers);
        majorDropdown.addEventListener("change", filterClassNumbers);

        // Run once on page load to set the correct state
        filterClassNumbers();
    });
</script>
