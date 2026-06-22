@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
  <!-- Hero -->
  <div class="mb-8 bg-[var(--brand-cream)] rounded-xl p-8 shadow-md">
    <div class="max-w-4xl mx-auto text-center">
      <h1 class="text-3xl md:text-4xl font-heading text-[var(--brand-brown)] font-semibold">Your Cart</h1>
      <p class="mt-2 text-sm md:text-base text-[var(--brand-brown)]/80">Review your curated selections before checkout.</p>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <!-- Items column -->
    <section>
      @if(!empty($cart) && count($cart))
        <form method="POST" action="{{ route('cart.update') }}" id="cart-update-form">
          @csrf
          <div class="space-y-4">
            @php $subtotal = 0; @endphp
            @foreach($cart as $id => $row)
              @php $subtotal += $row['subtotal'] ?? ($row['price'] * $row['quantity']); @endphp
              <article class="flex items-center gap-4 bg-white rounded-lg p-4 shadow-sm">
                <div class="w-24 h-24 bg-gray-100 rounded overflow-hidden flex-shrink-0">
                  @if(!empty($row['image']))
                    <img src="{{ $row['image'] }}" alt="{{ $row['name'] }}" class="w-full h-full object-cover">
                  @else
                    <img src="/images/placeholders/coffee.png" alt="{{ $row['name'] }}" class="w-full h-full object-cover">
                  @endif
                </div>
                <div class="flex-1">
                  <div class="flex items-start justify-between">
                    <div>
                      <h3 class="font-medium text-[var(--brand-brown)]">{{ $row['name'] }}</h3>
                      @if(!empty($row['meta']))
                        <div class="text-xs text-gray-500">{{ $row['meta'] }}</div>
                      @endif
                      <div class="text-sm text-gray-500">${{ number_format($row['price'],2) }}</div>
                    </div>
                    <div class="text-sm font-semibold">${{ number_format($row['subtotal'],2) }}</div>
                  </div>

                  <div class="mt-3 flex items-center gap-3">
                    <div class="inline-flex items-center rounded-md overflow-hidden border">
                      <button type="button" class="px-3 py-1 bg-white text-[var(--brand-brown)] hover:bg-[var(--brand-cream)]" data-decr data-id="{{ $id }}">−</button>
                      <input aria-label="quantity" type="number" name="items[{{ $id }}]" value="{{ $row['quantity'] }}" min="0" class="w-16 text-center border-0" data-qty data-id="{{ $id }}">
                      <button type="button" class="px-3 py-1 bg-white text-[var(--brand-brown)] hover:bg-[var(--brand-cream)]" data-incr data-id="{{ $id }}">+</button>
                    </div>

                    <button type="button" class="text-sm text-red-600 hover:underline ml-3" data-remove-id="{{ $id }}">Remove</button>
                  </div>
                </div>
              </article>
            @endforeach
          </div>

          <div class="mt-6">
            <button type="submit" class="px-4 py-2 rounded bg-[var(--brand-brown)] text-[var(--brand-cream)]">Update cart</button>
          </div>
        </form>
      @else
        <div class="text-center py-20 bg-white rounded-lg shadow-md">
          <!-- Premium empty illustration -->
          <svg width="120" height="120" viewBox="0 0 24 24" class="mx-auto text-[var(--brand-brown)] mb-6" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 3h18v2H3z" fill="currentColor" opacity="0.08"/>
            <path d="M8 7h8v6a4 4 0 11-8 0V7z" stroke="currentColor" stroke-width="0.8" fill="none"/>
            <path d="M6 20h12" stroke="currentColor" stroke-width="0.8"/>
          </svg>
          <h3 class="text-xl font-semibold text-[var(--brand-brown)]">Your cart is currently empty.</h3>
          <p class="mt-2 text-sm text-gray-500">Explore our collection and add premium selections to your cart.</p>
          <div class="mt-4">
            <a href="{{ route('menu.index') }}" class="inline-block px-5 py-2 rounded bg-[var(--brand-gold)] text-[var(--brand-espresso)] font-semibold">Explore Coffee Collection</a>
          </div>
        </div>
      @endif
    </section>

    <!-- Summary column -->
    <aside class="lg:sticky top-24">
      <div class="bg-white rounded-lg p-6 shadow-md">
        <h4 class="font-semibold text-[var(--brand-brown)]">Order Summary</h4>
        <div class="mt-4 space-y-2 text-sm">
          <div class="flex justify-between text-gray-600"><span>Subtotal</span><span>${{ number_format($subtotal ?? 0,2) }}</span></div>
          <div class="flex justify-between text-gray-600"><span>Tax (demo)</span><span>${{ number_format((($subtotal ?? 0) * 0.07),2) }}</span></div>
          <div class="flex justify-between text-gray-600"><span>Service Charge (demo)</span><span>${{ number_format((($subtotal ?? 0) * 0.05),2) }}</span></div>
          <div class="border-t pt-3 flex justify-between font-semibold text-[var(--brand-brown)]"><span>Grand Total</span><span>${{ number_format((($subtotal ?? 0) * 1.12),2) }}</span></div>
        </div>

        <div class="mt-6 space-y-3">
          <a href="{{ route('checkout.index') }}" class="block w-full text-center px-4 py-3 rounded bg-[var(--brand-brown)] text-[var(--brand-cream)] font-semibold">Proceed To Checkout</a>
          <a href="{{ route('menu.index') }}" class="block w-full text-center px-4 py-3 rounded border border-[var(--brand-brown)] text-[var(--brand-brown)]">Continue Shopping</a>
        </div>
      </div>
    </aside>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('click', function(e){
  const decr = e.target.closest('[data-decr]');
  const incr = e.target.closest('[data-incr]');
  const rem = e.target.closest('[data-remove-id]');
  if(decr || incr){
    const id = (decr||incr).getAttribute('data-id');
    const input = document.querySelector('input[data-qty][data-id="'+id+'"]');
    if(!input) return;
    let val = parseInt(input.value||0,10);
    if(decr){ val = Math.max(0, val-1); }
    if(incr){ val = val+1; }
    input.value = val;
  }

  if(rem){
    const id = rem.getAttribute('data-remove-id');
    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    const token = tokenMeta ? tokenMeta.getAttribute('content') : '';
    const url = "{{ route('cart.remove') }}";
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = url;
    const csrf = document.createElement('input'); csrf.type = 'hidden'; csrf.name = '_token'; csrf.value = token; form.appendChild(csrf);
    const idInput = document.createElement('input'); idInput.type = 'hidden'; idInput.name = 'id'; idInput.value = id; form.appendChild(idInput);
    document.body.appendChild(form);
    form.submit();
  }
});
</script>
@endpush

@endsection
