<x-app-layout>
    <!-- Hero Section -->
    <section class="bg-cover bg-center py-20" style="background-image: url('{{ asset('images/church-hero.jpg') }}');">
        <div class="container mx-auto text-center text-white">
            <h1 class="text-5xl font-bold mb-4">Welcome to Our Church</h1>
            <p class="text-xl mb-8">Join us in worship and fellowship. All are welcome!</p>
            <a href="/about" class="bg-gold text-navy font-bold py-3 px-6 rounded-lg hover:bg-gold-dark transition duration-300">
                Learn More
            </a>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0">
                    <h2 class="text-4xl font-bold mb-4 text-navy">About Our Church</h2>
                    <p class="text-gray-700 mb-6">We are a community of believers dedicated to spreading the love of Christ.</p>
                    <a href="/about" class="bg-navy text-white font-bold py-2 px-4 rounded-lg hover:bg-navy-dark transition duration-300">
                        Read More
                    </a>
                </div>
                <div class="md:w-1/2">
                    <img src="/images/tvf.jpg" alt="Church Image" class="rounded-lg shadow-lg border-4 border-gold">
                </div>
            </div>
        </div>
    </section>

    <!-- Upcoming Events Section -->
    <section class="py-16 bg-navy text-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-8">Upcoming Events</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($events as $event)
                <div class="bg-white text-navy rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $event->title }}</h3>
                        <p class="text-gray-700 mb-4"><strong>Date:</strong> 
                            @isset($event->start_time)
                                {{ $event->start_time->format('F j, Y') }}
                            @endisset
                        </p>
                        <p class="text-gray-700 mb-4"><strong>Time:</strong> 
                            @isset($event->start_time)
                                {{ $event->start_time->format('h:i A') }}
                            @endisset
                        </p>
                        <a href="/events/{{ $event->id }}" class="bg-gold text-navy font-bold py-2 px-4 rounded-lg hover:bg-gold-dark transition duration-300">
                            View Event
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Sermons Section -->
    <section class="py-16 bg-gold">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-8 text-navy">Latest Sermons</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($sermons as $sermon)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-navy">{{ $sermon->title }}</h3>
                        <p class="text-gray-700 mb-4">{{ $sermon->description }}</p>
                        <a href="/sermons/{{ $sermon->id }}" class="bg-navy text-white font-bold py-2 px-4 rounded-lg hover:bg-navy-dark transition duration-300">
                            Listen Now
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-8 text-navy">Recent Blog Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200">
                    <img src="/images/tvf.jpg" alt="Blog Post 1" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2 text-navy">The Power of Faith</h3>
                        <p class="text-gray-700 mb-4">Discover how faith can transform your life.</p>
                        <a href="#" class="bg-gold text-navy font-bold py-2 px-4 rounded-lg hover:bg-gold-dark transition duration-300">
                            Read More
                        </a>
                    </div>
                </div>
                <!-- Repeat for other blog posts -->
            </div>
        </div>
    </section>


    <!-- Call-to-Action Section -->
    <section class="bg-cover bg-center py-20" style="background-image: url('/images/church-cta.jpg');">
        <div class="container mx-auto text-center text-white">
            <h2 class="text-4xl font-bold mb-4">Join Us This Sunday</h2>
            <p class="text-xl mb-8">Experience the love of Christ in our community.</p>
            <a href="/contact" class="bg-gold text-navy font-bold py-3 px-6 rounded-lg hover:bg-gold-dark transition duration-300">
                Get in Touch
            </a>
        </div>
    </section>
</x-app-layout>