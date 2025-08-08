<!-- navlink component -->
@props(['active'])
<li>
    <a {{ $attributes->merge(['class'=>'block py-2 px-3 text-white bg-pink-800 rounded-sm md:bg-transparent md:text-pink-800 md:p-0 dark:text-white md:dark:text-pink-500']) }}
        >{{ $slot }}</a>
</li>
