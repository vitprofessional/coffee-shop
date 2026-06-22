@extends('layouts.app')
@section('title','Contact — Mausé Reserve')
@section('content')
    <section class="py-16">
        <x-section-header title="Contact" subtitle="We'd love to hear from you" />
        <div class="max-w-3xl mx-auto px-4 grid grid-cols-1 gap-6">
            <form action="{{ route('contact') }}" method="POST" class="space-y-4 bg-white p-6 rounded-lg shadow-sm font-body">
                @csrf
                <div>
                    <label class="block text-sm">Name</label>
                    <input name="name" class="mt-1 block w-full rounded-md border px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm">Email</label>
                    <input name="email" type="email" class="mt-1 block w-full rounded-md border px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-sm">Subject</label>
                    <input name="subject" class="mt-1 block w-full rounded-md border px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm">Message</label>
                    <textarea name="message" class="mt-1 block w-full rounded-md border px-3 py-2" rows="5" required></textarea>
                </div>
                <div class="flex items-center gap-3">
                    <button class="px-4 py-2 bg-[var(--brand-brown)] text-[var(--brand-cream)] rounded-md transition-smooth focus-ring">Send Message</button>
                    <a href="https://wa.me/" class="text-[var(--brand-brown)]">WhatsApp</a>
                </div>
            </form>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h4 class="font-semibold">Business Info</h4>
                <p class="mt-2 text-sm">Email: hello@mause-reserve.test</p>
                <p class="mt-1 text-sm">Phone: +123456789</p>
                <div class="mt-4 bg-gray-100 h-48 rounded flex items-center justify-center">Map placeholder</div>
            </div>
        </div>
    </section>
@endsection
