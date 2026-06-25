<div class="space-y-2">
@foreach($rows as $row)
    <div class="flex justify-between bg-white p-2 rounded">
        <div class="text-sm">{{ $row['label'] }}</div>
        <div class="font-semibold">{{ $row['value'] }}</div>
    </div>
@endforeach
</div>
