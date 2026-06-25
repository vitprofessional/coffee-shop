<div style="border:1px solid #e5e7eb;padding:12px;border-radius:8px;background:#ffffff;color:#111827;">
    <h3 style="margin:0 0 8px 0;font-size:16px;font-weight:600;">Dashboard Actions</h3>
    <ul style="list-style:none;padding:0;margin:0;">
        @foreach(($items ?? []) as $item)
            <li style="padding:8px 0;border-top:1px solid #f3f4f6;display:flex;justify-content:space-between;align-items:center;">
                <a href="{{ $item['url'] }}" style="color:#111827;text-decoration:none;font-weight:500;">{{ $item['label'] }}</a>
                <span style="color:#6b7280;font-size:13px;">{{ $item['value'] }}</span>
            </li>
        @endforeach
    </ul>
</div>
