<x-layout>
    <x-slot:title>{{$title}}</x-slot>
    <ul>
        <li>{{ $nama }}</li>
        <li>{{ $kelas }}</li>
        <li><a href="{{ $linkedin }}">LinkedIn Page</a></li>
        <li><a href="{{ $github }}">Github Page</a></li>
    </ul>
</x-layout>
