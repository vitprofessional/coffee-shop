@extends('layouts.app')
@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="mb-8 bg-[var(--brand-cream)] rounded-xl p-8 shadow-md text-center">
        <h1 class="text-3xl md:text-4xl font-heading text-[var(--brand-brown)]">Secure Checkout</h1>
        <p class="mt-2 text-sm text-[var(--brand-brown)]/80">Complete your order and enjoy freshly roasted coffee.</p>
    </div>

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

                    <div class="form-group">
                        <label for="order_type" class="form-label">Order Type <span class="form-required">*</span></label>
                        <select id="order_type" name="order_type" class="form-input" required>
                            <option value="pickup" {{ old('order_type')=='pickup' ? 'selected' : '' }}>Pickup</option>
                            <option value="delivery" {{ old('order_type')=='delivery' ? 'selected' : '' }}>Delivery</option>
                            <option value="dine_in" {{ old('order_type')=='dine_in' ? 'selected' : '' }}>Dine In</option>
                        </select>
                        @error('order_type')<p class="form-error">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-group">
                        <label for="payment_method" class="form-label">Payment Method <span class="form-required">*</span></label>
                        <select id="payment_method" name="payment_method" class="form-input" required>
                            <option value="cash" {{ old('payment_method')=='cash' ? 'selected' : '' }}>Cash</option>
                            <option value="card" {{ old('payment_method')=='card' ? 'selected' : '' }}>Card</option>
                            <option value="mobile_banking" {{ old('payment_method')=='mobile_banking' ? 'selected' : '' }}>Mobile Banking</option>
                        </select>
                        @error('payment_method')<p class="form-error">{{ $message }}</p>@enderror
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
                    <div class="mt-4 text-sm text-gray-600"><div class="flex justify-between"><span>Subtotal</span><span>${{ number_format($total,2) }}</span></div>
                    <div class="flex justify-between"><span>Tax (demo)</span><span>${{ number_format($total*0.07,2) }}</span></div>
                    <div class="flex justify-between"><span>Service (demo)</span><span>${{ number_format($total*0.05,2) }}</span></div>
                    <div class="border-t pt-3 flex justify-between font-semibold text-[var(--brand-brown)]"><span>Grand Total</span><span>${{ number_format($total*1.12,2) }}</span></div></div>

                    <div class="mt-4 space-y-3">
                        <a href="{{ route('checkout.index') }}" class="hidden" aria-hidden>—</a>
                        <div class="flex flex-col gap-3">
                            <a href="{{ route('menu.index') }}" class="block w-full text-center px-4 py-3 rounded border border-[var(--brand-brown)] text-[var(--brand-brown)]">Continue Shopping</a>
                        </div>
                        <div class="mt-4 text-xs text-gray-500 space-y-2">
                            <div class="flex items-center gap-2"><svg class="w-4 h-4 text-green-600" fill="currentColor"><rect width="4" height="4"/></svg><span>Secure Checkout</span></div>
                            <div class="flex items-center gap-2"><svg class="w-4 h-4 text-yellow-500" fill="currentColor"><rect width="4" height="4"/></svg><span>Freshly Roasted</span></div>
                            <div class="flex items-center gap-2"><svg class="w-4 h-4 text-gray-600" fill="currentColor"><rect width="4" height="4"/></svg><span>Pickup Available</span></div>
                        </div>
                    </div>
                @else
                    <p>Your cart is empty.</p>
                @endif
            </div>
        </aside>
    </div>
</div>

@endsection
