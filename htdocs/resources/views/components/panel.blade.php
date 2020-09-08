<div {{ $attributes->merge(['class' => 'p-6 rounded-lg shadow-lg']) }}>
    <div class="text-xl text-orange-500">{{ $title }}</div>
     <div class="mt-4">
         {{ $slot }}
     </div>
 </div>