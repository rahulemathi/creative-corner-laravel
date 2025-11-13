<footer class="bg-gradient-to-r from-pink-600 to-pink-700 text-white">
    <div class="container mx-auto px-4 py-12">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            
            <!-- Company Info -->
            <div class="space-y-4">
                <div class="flex items-center space-x-2">
                    <div class="bg-white p-2 rounded-lg">
                        <svg class="w-8 h-8 text-pink-600" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 9.74 9 11 5.16-1.26 9-5.45 9-11V7l-10-5z"/>
                            <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" fill="none"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold">Manhitha</h2>
                        <p class="text-pink-100 text-sm">Gift Shop</p>
                    </div>
                </div>
                <p class="text-pink-100 text-sm leading-relaxed">
                    Your one-stop destination for unique and thoughtful gifts. We specialize in creating memorable moments with our carefully curated collection of gifts for every occasion.
                </p>
                <div class="flex space-x-4">
                    <!-- Social Media Icons -->
                    <a href="https://www.facebook.com" target="_blank" class="bg-pink-500 hover:bg-pink-400 p-2 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="https://www.instagram.com" target="_blank" class="bg-pink-500 hover:bg-pink-400 p-2 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.621 5.367 11.988 11.988 11.988s11.987-5.367 11.987-11.988C24.004 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.321-1.297C4.256 14.794 3.766 13.643 3.766 12.346c0-1.297.49-2.448 1.297-3.321.873-.807 2.024-1.297 3.321-1.297s2.448.49 3.321 1.297c.807.873 1.297 2.024 1.297 3.321 0 1.297-.49 2.448-1.297 3.321-.873.873-2.024 1.297-3.321 1.297zm7.83-9.142c-.295 0-.588-.131-.785-.328-.197-.197-.328-.49-.328-.785s.131-.588.328-.785c.197-.197.49-.328.785-.328s.588.131.785.328c.197.197.328.49.328.785s-.131.588-.328.785c-.197.131-.49.328-.785.328z"/>
                        </svg>
                    </a>
                    <a href="https://wa.me/919449437255" target="_blank" class="bg-green-500 hover:bg-green-400 p-2 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 2.017A9.954 9.954 0 0 0 2.05 12.017c0 1.756.456 3.512 1.318 5.034L2.017 22.017l5.086-1.331a9.925 9.925 0 0 0 4.914 1.297c5.497 0 9.963-4.466 9.963-9.966S17.514 2.05 12.017 2.017zm5.106 14.441c-.218.608-1.286 1.166-1.644 1.217-.357.051-.757.103-2.462-.51-1.706-.613-3.412-2.364-4.956-4.208C6.617 11.208 6.096 9.645 6.096 8.05c0-1.595.218-2.39.588-2.717.37-.328.805-.41 1.073-.41.268 0 .536.013.77.025.218.013.51-.083.798.608.289.69.98 2.395 1.073 2.573.092.177.153.38.031.608-.123.229-.184.370-.369.574-.184.203-.387.454-.553.61-.184.17-.369.26-.16.51.21.25.93 1.54 2.002 2.5 1.38 1.23 2.533 1.61 2.896 1.787.363.178.574.148.786-.092.213-.24.905-1.054 1.146-1.421.24-.366.482-.307.813-.184.33.123 2.104 1.298 2.466 1.595.363.297.605.446.696.7.092.253.092.65-.125 1.26z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">Quick Links</h3>
                <ul class="space-y-2">
                    <li><a href="{{ url('/') }}" class="text-pink-100 hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ url('/about') }}" class="text-pink-100 hover:text-white transition-colors">About Us</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-pink-100 hover:text-white transition-colors">Products</a></li>
                    <li><a href="{{ url('/contact') }}" class="text-pink-100 hover:text-white transition-colors">Contact</a></li>
                    @auth
                        <li><a href="{{ route('orders.index') }}" class="text-pink-100 hover:text-white transition-colors">My Orders</a></li>
                        <li><a href="{{ route('profile.show') }}" class="text-pink-100 hover:text-white transition-colors">Profile</a></li>
                    @else
                        <li><a href="{{ route('login') }}" class="text-pink-100 hover:text-white transition-colors">Login</a></li>
                        <li><a href="{{ route('register') }}" class="text-pink-100 hover:text-white transition-colors">Register</a></li>
                    @endauth
                </ul>
            </div>

            <!-- Product Categories -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">Categories</h3>
                <ul class="space-y-2">
                    @php
                        $categories = \App\Models\Category::where('is_active', '1')->take(6)->get();
                    @endphp
                    @foreach($categories as $category)
                        <li><a href="{{ route('products.category', $category->slug) }}" class="text-pink-100 hover:text-white transition-colors">{{ $category->name }}</a></li>
                    @endforeach
                    <li><a href="{{ route('products.index') }}" class="text-pink-100 hover:text-white font-semibold">View All →</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold">Get in Touch</h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-pink-200 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <div class="text-sm">
                            <p class="text-pink-100">365 Kengeri Bazaar Street,</p>
                            <p class="text-pink-100">Kuvempu Rd, Kengeri</p>
                            <p class="text-pink-100">Karnataka 560060</p>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-pink-200 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:+919449437255" class="text-pink-100 hover:text-white transition-colors text-sm">+91 94494 37255</a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-pink-200 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:info@manhitha.com" class="text-pink-100 hover:text-white transition-colors text-sm">info@manhitha.com</a>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-pink-200 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="text-sm">
                            <p class="text-pink-100">Mon-Fri: 9AM-8PM</p>
                            <p class="text-pink-100">Sat-Sun: 10AM-9PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Newsletter Signup -->
        <div class="mt-12 pt-8 border-t border-pink-500">
            <div class="max-w-md mx-auto text-center">
                <h3 class="text-lg font-semibold mb-2">Stay Updated</h3>
                <p class="text-pink-100 text-sm mb-4">Subscribe to get special offers and latest updates</p>
                <form class="flex space-x-2" action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <input type="hidden" name="first_name" value="Newsletter">
                    <input type="hidden" name="last_name" value="Subscriber">
                    <input type="hidden" name="subject" value="general">
                    <input type="hidden" name="message" value="Please subscribe me to your newsletter.">
                    <input type="email" name="email" placeholder="Enter your email" required
                           class="flex-1 px-3 py-2 text-gray-900 bg-white rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-300">
                    <button type="submit" class="bg-pink-500 hover:bg-pink-400 px-4 py-2 rounded-lg font-medium transition-colors">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-12 pt-8 border-t border-pink-500">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-pink-100 text-sm mb-4 md:mb-0">
                    <p>&copy; {{ date('Y') }} Manhitha Gift Shop. All rights reserved.</p>
                </div>
                <div class="flex flex-wrap justify-center md:justify-end space-x-6 text-sm">
                    <a href="{{ route('privacy') }}" class="text-pink-100 hover:text-white transition-colors">Privacy Policy</a>
                    <a href="{{ route('terms') }}" class="text-pink-100 hover:text-white transition-colors">Terms of Service</a>
                    <a href="{{ route('refund') }}" class="text-pink-100 hover:text-white transition-colors">Refund Policy</a>
                    <a href="{{ route('shipping') }}" class="text-pink-100 hover:text-white transition-colors">Shipping Info</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Top Button -->
    <div class="fixed bottom-6 right-6 z-40">
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" 
                class="bg-pink-600 hover:bg-pink-700 text-white p-3 rounded-full shadow-lg transition-all duration-300 opacity-0"
                id="backToTop" aria-label="Back to top">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
            </svg>
        </button>
    </div>

    <script>
        // Back to top button functionality
        window.addEventListener('scroll', function() {
            const backToTop = document.getElementById('backToTop');
            if (window.pageYOffset > 300) {
                backToTop.style.opacity = '1';
            } else {
                backToTop.style.opacity = '0';
            }
        });
    </script>
</footer>