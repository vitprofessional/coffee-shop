@extends('layouts.app')
@section('content')
<h1>Checkout</h1>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
  <div class="lg:col-span-2">
    <div class="form-card">
      @if(session('success'))
        <div class="form-success mb-4">{{ session('success') }}</div>
      @elseif(session('error'))
        <div class="form-error mb-4">{{ session('error') }}</div>
      @endif

      <form method="post" action="{{ route('order.store') }}" class="form-grid cols-2">@csrf
        <div class="form-group">
          <label for="customer_name" class="form-label">Full Name <span class="form-required">*</span></label>
          <input id="customer_name" name="customer_name" type="text" value="{{ old('customer_name') }}" required aria-required="true" class="form-input" />
          @error('customer_name')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
          <label for="email" class="form-label">Email Address <span class="form-required">*</span></label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" required aria-required="true" class="form-input" />
          @error('email')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
          <label for="phone" class="form-label">Phone Number <span class="form-required">*</span></label>
          <input id="phone" name="phone" type="tel" value="{{ old('phone') }}" required aria-required="true" class="form-input" />
          @error('phone')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
          <label for="address" class="form-label">Address</label>
          <input id="address" name="address" type="text" value="{{ old('address') }}" class="form-input" />
          @error('address')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
          <label for="city" class="form-label">City</label>
          <input id="city" name="city" type="text" value="{{ old('city') }}" class="form-input" />
          @error('city')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
          <label for="state" class="form-label">State / Province</label>
          <input id="state" name="state" type="text" value="{{ old('state') }}" class="form-input" />
          @error('state')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group">
          <label for="postal" class="form-label">Postal Code</label>
          <input id="postal" name="postal" type="text" value="{{ old('postal') }}" class="form-input" />
          @error('postal')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div class="form-group md:col-span-2">
          <label for="notes" class="form-label">Order Notes</label>
          <textarea id="notes" name="notes" rows="4" class="form-textarea" placeholder="Delivery instructions, etc.">{{ old('notes') }}</textarea>
          @error('notes')<p class="form-error">{{ $message }}</p>@enderror
        </div>

        <div class="md:col-span-2 mt-2">
          <button type="submit" class="form-submit" aria-label="Place order">Place Order</button>
        </div>
      </form>
    </div>
  </div>

  <aside class="lg:col-span-1">
    <div class="bg-white rounded-2xl shadow p-6">
      <h2 class="text-lg font-semibold mb-3">Order Summary</h2>
      @php $total = $cart? array_sum(array_column($cart,'subtotal')) : 0; @endphp
      @if(isset($cart) && $cart)
        <ul class="divide-y">
          @foreach($cart as $row)
            <li class="py-2 flex justify-between"><span>{{ $row['name'] }} x {{ $row['quantity'] }}</span><span>${{ number_format($row['subtotal'],2) }}</span></li>
          @endforeach
        </ul>
        <div class="mt-4 font-bold">Total: ${{ number_format($total,2) }}</div>
      @else
        <p>Your cart is empty.</p>
      @endif
    </div>
  </aside>
</div>

@endsection
