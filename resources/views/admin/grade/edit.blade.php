<x-admin-layout>
    <x-slot:title>{{ $title }}</x-slot>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Grade</h2>
            <form action="/admin/grades/update/{{ $grade->id }}" method="POST">
                @csrf
                @method('PUT')  <!-- Method spoofing untuk PUT request -->
                <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">
                    <div>
                        <label for="grade" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grade/Class</label>
                        <select id="grade" name="grade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" data-grade="{{ $grade }}">
                            <option value="12" {{ old('grade', $grade->grade ?? '') == 12 ? 'selected' : '' }}>12</option>
                            <option value="11" {{ old('grade', $grade->grade ?? '') == 11 ? 'selected' : '' }}>11</option>
                            <option value="10" {{ old('grade', $grade->grade ?? '') == 10 ? 'selected' : '' }}>10</option>
                        </select>
                    </div>

                    <div>
                        <label for="major" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Major</label>
                        <select id="major_id" name="major_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach($grades as $gradeOption)
                                <option value="{{ $gradeOption->major_id }}"
                                    {{ old('major_id', $grade->major_id ?? '') == $gradeOption->major_id ? 'selected' : '' }}>
                                    {{ $gradeOption->major->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="class_number" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Class Number</label>
                        <select id="class_number" name="class_number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" data-selected-class="{{ old('class_number', $grade->class_number ?? '') }}">
                            <option value="1" {{ old('class_number', $grade->class_number ?? '') == 1 ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('class_number', $grade->class_number ?? '') == 2 ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('class_number', $grade->class_number ?? '') == 3 ? 'selected' : '' }}>3</option>
                            <option value="4" {{ old('class_number', $grade->class_number ?? '') == 4 ? 'selected' : '' }}>4</option>
                            <option value="5" {{ old('class_number', $grade->class_number ?? '') == 5 ? 'selected' : '' }}>5</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Update Grade
                </button>
            </form>
        </div>
    </section>
</x-admin-layout>
