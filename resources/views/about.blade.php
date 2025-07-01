<x-app-layout>

    <!-- Hero Section -->
    <section class="py-16 bg-white text-navy">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-8">
                    <h2 class="text-4xl font-bold mb-2">Who We Are</h2>
                    <div class="w-24 h-1 bg-gold mx-auto mb-6"></div>
                    <p class="text-xl">A family of faith rooted in Christ's love.</p>
                </div>
                <div class="mt-10">
                    <img 
                        src="{{ asset('images/tvf-logo1.png') }}" 
                        alt="TVF Church" 
                        class="mx-auto rounded-lg shadow-xl w-full max-w-4xl object-cover h-64 md:h-96"
                    >
                </div>
            </div>
        </div>
    </section>

    <!-- Our Mission -->
    <section class="py-16 bg-white text-navy">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-left mb-8">
                    <h2 class="text-4xl font-bold mb-2">Our Mission</h2>
                    <div class="w-24 h-1 bg-gold mb-6"></div>
                </div>
                <p class="text-lg leading-relaxed">
                    At TVF Church, we exist to glorify God, make disciples, and serve our community in love.
                </p>
                <div class="mt-8">
                    <span class="inline-block text-blue-600 font-medium">Matthew 28:19</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Core Beliefs -->
    <section class="py-16 bg-white text-navy">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-left mb-8">
                    <h2 class="text-4xl font-bold mb-2">Our Core Beliefs</h2>
                    <div class="w-24 h-1 bg-gold mb-6"></div>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Belief 1 -->
                    <div class="bg-white p-6 rounded-lg shadow-md text-center border border-gray-100">
                        <div class="text-blue-600 mb-4">
                            <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Bible-Based Teaching</h3>
                        <p class="text-gray-600">We ground everything in the truth of Scripture.</p>
                    </div>

                    <!-- Belief 2 -->
                    <div class="bg-white p-6 rounded-lg shadow-md text-center border border-gray-100">
                        <div class="text-blue-600 mb-4">
                            <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Faith in Action</h3>
                        <p class="text-gray-600">Love demonstrated through service.</p>
                    </div>

                    <!-- Belief 3 -->
                    <div class="bg-white p-6 rounded-lg shadow-md text-center border border-gray-100">
                        <div class="text-blue-600 mb-4">
                            <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Love for All</h3>
                        <p class="text-gray-600">Everyone is welcome in God's house.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-16 bg-white text-navy">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-left mb-8">
                    <h2 class="text-4xl font-bold mb-2">Our Story</h2>
                    <div class="w-24 h-1 bg-gold mb-6"></div>
                </div>
                <div class="prose max-w-none text-gray-600">
                    <p>
                        Founded in 2004, TVF Church began as a small Bible study in a living room. 
                        Through God's faithfulness, we grew into a vibrant community serving in Enugu. 
                        Today, we gather weekly to worship, learn, and share the hope of Christ.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Meet the Leaders -->
    <section class="py-16 bg-white text-navy">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="text-left mb-8">
                    <h2 class="text-4xl font-bold mb-2">Meet Our Leader</h2>
                    <div class="w-24 h-1 bg-gold mb-6"></div>
                </div>
                <div class="flex flex-col md:flex-row justify-center gap-8">
                    <!-- Pastor Card -->
                    <div class="bg-white p-6 rounded-lg shadow-md text-center flex-1 max-w-md border border-gray-100">
                        <img 
                            src="{{ asset('images/ikem2.jpeg') }}" 
                            alt="Pastor Ikem" 
                            class="w-32 h-32 rounded-full mx-auto mb-4 object-cover"
                        >
                        <h3 class="text-xl font-semibold">Pastor Ikem Nnwokike</h3>
                        <p class="text-blue-600 mb-3">Lead Pastor</p>
                        <p class="text-gray-600">
                            With over 15 years of ministry experience, Pastor Ikem loves sharing the Gospel 
                            and mentoring believers. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA to Visit -->
    <section class="py-16 bg-white text-navy">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-4">Join Us This Sunday!</h2>
                <p class="text-xl mb-8">We'd love to welcome you home.</p>
                <a 
                    href="{{ route('contact') }}" 
                    class="inline-block bg-gold text-navy px-6 py-3 rounded-lg font-medium hover:bg-gold-dark hover:text-white transition shadow-md"
                >
                    Plan Your Visit
                </a>
            </div>
        </div>
    </section>

</x-app-layout>