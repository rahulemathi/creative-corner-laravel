<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
@php
    // Preload mini cart data server-side to avoid empty sidebar on first load
    $cookieSvc = app(\App\Services\CookieCart::class);
    $rawCart = $cookieSvc->all();
    $preloadedItems = [];
    if (!empty($rawCart)) {
        $products = \App\Models\Product::whereIn('id', array_keys($rawCart))->get()->keyBy('id');
        foreach ($rawCart as $pid => $qty) {
            if (isset($products[$pid])) {
                $p = $products[$pid];
                $price = $p->sale_price ?? $p->price;
                $thumb = null;
                if (is_array($p->images) && !empty($p->images)) {
                    $thumb = asset('storage/' . $p->images[0]);
                }
                $preloadedItems[] = [
                    'id' => $pid,
                    'name' => $p->name,
                    'quantity' => $qty,
                    'price' => (float)$price,
                    'subtotal' => (float)($price * $qty),
                    'image' => $thumb,
                    'url' => route('products.show', $p->slug),
                ];
            }
        }
    }
@endphp
<body class="bg-red-100 relative">
    <x-navbar></x-navbar>

    <!-- Cart Sidebar Trigger (floating) -->
    <button x-data x-on:click="$dispatch('toggle-cart-sidebar')"
        class="fixed top-1/2 right-0 z-40 -translate-y-1/2 bg-pink-600 text-white px-3 py-3 rounded-l-lg shadow-lg hover:bg-pink-700 transition flex flex-col items-center"
        aria-label="Open cart" id="cart-sidebar-trigger">
        <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4Zm-8 2a2 2 0 11-4 0 2 2 0 014 0Z" />
        </svg>
        <span id="cart-count" class="text-xs font-semibold">{{ array_sum(array_column($preloadedItems, 'quantity')) }}</span>
    </button>

    <!-- Cart Sidebar -->
    <div x-data="cartSidebar()" x-init="init()" x-on:toggle-cart-sidebar.window="open = !open"
        x-bind:class="open ? 'translate-x-0' : 'translate-x-full'"
        class="fixed top-0 right-0 h-full w-80 bg-white dark:bg-gray-800 shadow-2xl z-50 transform transition-transform duration-300 flex flex-col">
        <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-lg font-semibold text-pink-600 dark:text-pink-400">Your Cart</h2>
            <button x-on:click="open=false" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200" aria-label="Close">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <div class="flex-1 overflow-y-auto" x-ref="itemsContainer">
            <template x-if="loading">
                <div class="p-4 space-y-3" aria-busy="true" aria-live="polite">
                    <div class="animate-pulse flex items-center space-x-3" role="status">
                        <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded"></div>
                        <div class="flex-1 space-y-2">
                            <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-3/4"></div>
                            <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-1/2"></div>
                        </div>
                    </div>
                    <div class="animate-pulse flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gray-200 dark:bg-gray-700 rounded"></div>
                        <div class="flex-1 space-y-2">
                            <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-2/3"></div>
                            <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-1/3"></div>
                        </div>
                    </div>
                </div>
            </template>
            <template x-if="!loading && items.length === 0">
                <div class="p-4 text-sm text-gray-600 dark:text-gray-300">Your cart is empty.</div>
            </template>
            <ul class="divide-y divide-gray-200 dark:divide-gray-700" x-show="items.length > 0">
                <template x-for="item in items" :key="item.id">
                    <li class="p-4 flex items-center space-x-3">
                        <a :href="item.url" class="block">
                            <img :src="item.image || 'https://placehold.co/64x64?text=No+Image'" :alt="item.name" class="w-12 h-12 object-cover rounded shadow">
                        </a>
                        <div class="flex-1">
                            <a :href="item.url" class="text-sm font-semibold text-gray-800 dark:text-gray-100 hover:text-pink-600 dark:hover:text-pink-400" x-text="item.name"></a>
                            <div class="flex items-center space-x-2 mt-1">
                                <div class="flex items-center bg-gray-100 dark:bg-gray-700 rounded px-2 py-1 space-x-1">
                                    <button x-on:click="decrementServer(item)" class="text-gray-600 dark:text-gray-300 hover:text-pink-600" :disabled="item.quantity <= 1" aria-label="Decrease quantity">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6"/></svg>
                                    </button>
                                    <span class="text-xs font-medium" x-text="item.quantity"></span>
                                    <button x-on:click="incrementServer(item)" class="text-gray-600 dark:text-gray-300 hover:text-pink-600" aria-label="Increase quantity">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m6-6H6"/></svg>
                                    </button>
                                </div>
                                <button x-on:click="removeServer(item)" class="text-red-600 hover:text-red-700" aria-label="Remove">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1" x-text="'₹'+item.subtotal.toFixed(2)"></p>
                        </div>
                    </li>
                </template>
            </ul>
        </div>
        <div class="border-t border-gray-200 dark:border-gray-700 p-4 space-y-3">
            <div class="flex justify-between text-sm">
                <span class="text-gray-600 dark:text-gray-300">Subtotal</span>
                <span class="font-semibold text-gray-800 dark:text-gray-100" x-text="'₹'+subtotal().toFixed(2)"></span>
            </div>
            <a href="{{ route('cart.index') }}" class="block w-full text-center bg-pink-600 hover:bg-pink-700 text-white text-sm font-semibold py-2 rounded-lg transition">Go to Cart</a>
            <template x-if="items.length > 0">
                <a href="{{ auth()->check() ? route('cart.payment') : route('login') }}" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white text-sm font-semibold py-2 rounded-lg transition">Checkout</a>
            </template>
        </div>
    </div>

    {{ $slot }}

    <x-footer></x-footer>

    @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script>
        // Server preloaded mini cart data (fallback to fetch if empty)
        window.__MINI_CART_DATA__ = @json($preloadedItems);
        function cartSidebar() {
            return {
                open: false,
                items: [],
                loading: false,
                init(){
                    this.items = window.__MINI_CART_DATA__ || [];
                    this.updateBadge();
                    this.load();
                },
                load() {
                    // If we already have items from server preload, skip initial fetch
                    if (this.items.length === 0) {
                        this.loading = true;
                        fetch('{{ route('cart.mini') }}', { headers: { 'Accept': 'application/json' }})
                            .then(r => r.json())
                            .then(data => {
                                this.items = data.items || [];
                                this.updateBadge(data.count || 0);
                                this.loading = false;
                            })
                            .catch(() => { this.loading=false; });
                    }
                },
                updateBadge(count){
                    if(typeof count === 'number') {
                        document.getElementById('cart-count').textContent = count;
                        return;
                    }
                    const c = this.items.reduce((a,i)=>a+i.quantity,0);
                    document.getElementById('cart-count').textContent = c;
                },
                subtotal(){
                    return this.items.reduce((a,i)=> a + i.subtotal, 0);
                },
                incrementServer(item){ this.updateServer(item.id, item.quantity + 1); },
                decrementServer(item){ if(item.quantity>1) this.updateServer(item.id, item.quantity - 1); },
                removeServer(item){ this.updateServer(item.id, 0); },
                updateServer(id, newQty){
                    this.loading = true;
                    fetch('/cart/update/'+id, {method:'PATCH', headers:{'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]').content,'Accept':'application/json','Content-Type':'application/json'}, body: JSON.stringify({quantity:newQty})})
                        .then(r=>{ if(!r.ok) throw new Error(); return r.text(); })
                        .catch(()=>{})
                        .finally(()=>{ this.loading=false; this.load(); });
                },
                persist(){
                    const compact = {}; this.items.forEach(i=> compact[i.id]=i.quantity);
                    document.cookie = 'cart='+encodeURIComponent(JSON.stringify(compact))+';path=/;max-age='+(60*60*24*30)+';SameSite=Lax';
                    this.updateBadge();
                }
            }
        }
        document.addEventListener('alpine:init', () => {
            const root = document.querySelector('[x-data]');
            // Refresh mini cart after any page navigation via event
            window.addEventListener('cart:refresh', ()=> {
                const el = document.querySelector('[x-data="cartSidebar()"]');
                if(el){ Alpine.$data(el).load(); }
            });
        });
    </script>
</body>
</html>