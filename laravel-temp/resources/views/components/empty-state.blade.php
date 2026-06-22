@props(['title'=>'No items yet','description'=>null])
<div class="text-center py-12">
    <div class="mx-auto w-40 h-40 rounded-full bg-gray-100 flex items-center justify-center mb-4">
        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 0 0 2 2h14"></path></svg>
    </div>
    <h3 class="text-lg font-semibold font-body">{{ $title }}</h3>
    @if($description)
        <p class="mt-2 text-sm text-gray-500">{{ $description }}</p>
    @endif
</div>
