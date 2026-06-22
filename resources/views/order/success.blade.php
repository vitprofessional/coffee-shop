@extends('layouts.app')
@section('title', 'Order Confirmed — Mausé Reserve')
@section('content')
  <section class="max-w-7xl mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-lg p-8">
      <h1 class="text-3xl font-heading text-[var(--brand-brown)] mb-4">Order Confirmed</h1>
      <p class="text-sm text-gray-600 mb-6">Thank you — your order has been received. We're roasting and preparing your selection.</p>

      @if(isset($order))
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
          <div>
            <h3 class="font-semibold">Order Number</h3>
            <div class="text-lg font-mono my-2">{{ $order->order_number }}</div>

            <h4 class="font-semibold mt-4">Customer</h4>
            <div class="my-2">{{ $order->customer_name }}</div>

            <h4 class="font-semibold mt-4">Order Details</h4>
            <div class="my-2 text-sm text-gray-700">
              <div><strong>Type:</strong> {{ ucfirst($order->order_type) }}</div>
              <div><strong>Payment:</strong> {{ ucfirst(str_replace('_',' ', $order->payment_method)) }}</div>
            </div>
          </div>

          <div>
            <h4 class="font-semibold">Total</h4>
            <div class="text-2xl font-bold text-[var(--brand-brown)] my-2">${{ number_format($order->total,2) }}</div>

            @if($order->notes)
              <h5 class="font-semibold mt-4">Notes</h5>
              <div class="text-sm text-gray-700">{{ $order->notes }}</div>
            @endif
          </div>
        </div>

        <div class="mb-6">
          <h4 class="font-semibold mb-3">Items</h4>
          <div class="space-y-3">
            @foreach($order->items as $it)
              <div class="p-3 bg-gray-50 rounded flex items-center justify-between">
                <div>
                  <div class="font-medium">{{ $it->item_name }}</div>
                  <div class="text-sm text-gray-500">{{ $it->quantity }} × ${{ number_format($it->price,2) }}</div>
                </div>
                <div class="font-semibold">${{ number_format($it->subtotal,2) }}</div>
              </div>
            @endforeach
          </div>
        </div>
      @else
        <div class="text-sm text-gray-600">Order information not available.</div>
      @endif

      <div class="mt-6 flex gap-4">
        <a href="{{ route('menu.index') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-lg bg-[var(--brand-brown)] text-[var(--brand-cream)] font-medium shadow">Continue Shopping</a>
        <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-6 py-3 rounded-lg border border-gray-200 text-gray-800">Back to Home</a>
      </div>
    </div>
  </section>
@endsection
