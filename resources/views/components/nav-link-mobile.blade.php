<a {{ $attributes }}
    class="{{ $active ? 'block rounded-md bg-gray-900' :  'block text-gray-300 hover:bg-gray-700 hover:text-white'}} px-3 py-2 text-base font-medium text-white"
    aria-current="{{ $active ? 'page' : '' }}">{{ $slot }}
</a>
