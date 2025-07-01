<x-app-layout>

<!-- Preloader -->
<div id="preloader" class="fixed inset-0 z-50 flex items-center justify-center bg-gradient-to-br from-[#1d3557] to-[#394967]">
  <div class="text-center">
    <img src="{{ asset('images/tvf-logo1.png') }}" alt="Logo" class="mx-auto w-32 h-auto mb-6 animate-bounce">
    <div class="loader ease-linear rounded-full border-8 border-t-8 border-gold h-16 w-16 mx-auto animate-spin"></div>
  </div>
</div>

<div class="min-h-screen bg-gradient-to-br from-[#1d3557] to-[#394967]">

  <!-- Hero Section -->
  <section class="relative min-h-screen bg-cover bg-[right_top]" style="background-image: url('{{ asset('images/church-hero1.png') }}');">
    <div class="absolute inset-0 bg-gradient-to-br from-[#1d3557] to-[#394967] opacity-80"></div>
    <div class="relative container mx-auto text-center text-white flex flex-col justify-center items-center min-h-screen">
      <h1 class="text-5xl font-bold mb-4">
        <span id="typed"></span>
      </h1>
      <p class="text-xl mb-8 text-gray-300">Join us in worship and fellowship. All are welcome!</p>
      <a href="/about" class="bg-gold text-navy font-bold py-3 px-6 rounded-lg hover:bg-gold-dark hover:text-white transition duration-300 hover:shadow-lg hover:shadow-gold/50">
        Learn More
      </a>
    </div>
  </section>

<!-- About Us Section - Left Aligned -->
<section class="py-16 bg-white text-navy">
  <div class="container mx-auto px-4">
    <div class="max-w-4xl mx-auto" data-aos="fade-up">
      <div class="text-left mb-8">
        <h2 class="text-4xl font-bold mb-2">Who We Are</h2>
        <div class="w-24 h-1 bg-gold mb-6"></div>
        <h3 class="text-3xl font-semibold">About Us</h3>
      </div>

      <div class="flex flex-col lg:flex-row items-center gap-12">
        <!-- Text -->
        <div class="lg:w-1/2" data-aos="fade-right">
          <div class="text-left space-y-6 text-gray-700">
            <p class="text-lg leading-relaxed">
            TVF is a dynamic Pentecostal Christian church founded by Pastor Ikem Nwokike, built on unwavering faith and total trust in God. We are a growing family of believers passionate about living by the Word, walking in the power of the Holy Spirit, and reflecting the love of Christ. At TVF, we don’t just believe — we surrender fully, trusting God's plan, promises, and timing in every area of our lives. Together, we are building a community rooted in deep faith, empowered for purpose, and committed to transformation.
            </p>
            <a href="/about" class="bg-gold text-white font-bold py-3 px-8 rounded-lg hover:bg-gold-dark transition duration-300 inline-block mt-4">
              Read More
            </a>
          </div>
        </div>

        <!-- Image -->
        <div class="lg:w-1/2" data-aos="fade-left">
          <div class="relative rounded-lg overflow-hidden shadow-xl">
            <img src="{{ asset('images/ikem2.jpeg') }}" alt="[Founder's Name]" class="w-full h-auto">
            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6 text-white">
              <h4 class="text-xl font-bold">Pastor Ikem Nwokike</h4>
              <p class="text-gold">Founder & Senior Pastor</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- Upcoming Events Section -->
<section class="py-24 bg-white text-navy" data-aos="fade-up">
  <div class="container mx-auto px-6 text-center">
    <h2 class="text-5xl font-extrabold mb-12 tracking-wide">Upcoming Events</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
      @foreach($events as $event)
      <div class="bg-white border border-gray-200 rounded-2xl p-6 shadow-lg hover:shadow-2xl hover:scale-[1.02] transition-all duration-300 text-left relative" data-aos="zoom-in" data-aos-delay="100">

        <!-- Status Badge -->
        @if($event->status)
        <div class="absolute -top-3 -right-3">
            @switch(strtolower($event->status))
                @case('live')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800">
                        <span class="w-2 h-2 mr-1 bg-red-500 rounded-full animate-pulse"></span>
                        LIVE NOW
                    </span>
                    @break
                @case('finished')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-gray-100 text-gray-800">
                        FINISHED
                    </span>
                    @break
                @case('not_started')
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-blue-100 text-blue-800">
                        COMING SOON
                    </span>
                    @break
                @default
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-yellow-100 text-yellow-800">
                        SCHEDULED
                    </span>
            @endswitch
        </div>
        @endif

        <h3 class="text-2xl font-bold mb-2 text-gold">{{ $event->title }}</h3>

        <!-- Date Display -->
        <div class="flex items-center gap-2 text-gray-600 mb-1">
          <svg class="h-5 w-5 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 4h10a2 2 0 012 2v10a2 2 0 01-2 2H7a2 2 0 01-2-2V9a2 2 0 012-2z" />
          </svg>
          <span><strong>Date:</strong> 
            @if($event->is_recurring && $event->next_occurrence)
              {{ $event->next_occurrence->format('F j, Y') }}
              <span class="text-xs text-gray-500">(Next occurrence)</span>
            @else
              {{ $event->start_time->format('F j, Y') }}
            @endif
          </span>
        </div>

        <!-- Time Display -->
        <div class="flex items-center gap-2 text-gray-600 mb-4">
          <svg class="h-5 w-5 text-gold" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
          </svg>
          <span><strong>Time:</strong> 
            @if($event->is_recurring && $event->next_occurrence)
              {{ $event->start_time->format('h:i A') }} (Duration: {{ $event->start_time->diffForHumans($event->end_time, true) }})
            @else
              {{ $event->start_time->format('h:i A') }} - {{ $event->end_time->format('h:i A') }}
            @endif
          </span>
        </div>

        <!-- Recurrence Info -->
        @if($event->is_recurring)
        <div class="text-sm text-gray-500 mb-3">
          <svg class="h-4 w-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
          Repeats {{ $event->recurrence_interval > 1 ? 'every '.$event->recurrence_interval.' '.str_plural($event->recurrence) : $event->recurrence }}
        </div>
        @endif

        <a href="{{ route('events.show', $event->id) }}" class="inline-block mt-3 bg-gold text-white font-semibold py-2 px-4 rounded-lg hover:bg-gold-dark transition duration-300">
          View Event
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>
  <!-- Sermons Section -->
  <section class="py-24 bg-white text-navy" data-aos="fade-up">
  <div class="container mx-auto px-6 text-center">
    <h2 class="text-5xl font-extrabold mb-12 tracking-wide">The Watchtower</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
      @foreach($sermons as $sermon)
      <div class="relative bg-white border border-gray-200 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300 group" data-aos="zoom-in" data-aos-delay="100">
        
        <!-- Image with overlay -->
        <div class="relative">
          <img src="{{ $sermon->cover_image ?? '/images/watchtower.jpg' }}" alt="{{ $sermon->title }}" class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">
          <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
            <svg class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-4.586-2.65A1 1 0 009 9.383v5.234a1 1 0 001.166.965l4.586-2.65a1 1 0 000-1.764z" />
            </svg>
          </div>
        </div>

        <!-- Content -->
        <div class="p-6 text-left">
          <h3 class="text-2xl font-semibold mb-2 text-navy group-hover:text-gold transition duration-300">{{ $sermon->title }}</h3>
          <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $sermon->description }}</p>
          <a href="/sermons/{{ $sermon->id }}" class="inline-block mt-2 text-sm font-bold bg-gold text-white py-2 px-5 rounded-lg hover:bg-gold-dark transition duration-300">
            Listen Now
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>


  <!-- Blog Section -->
  <section class="py-24 bg-white">
  <div class="container mx-auto px-6">
    <h2 class="text-4xl font-bold text-center text-navy mb-14">The Vine Journal</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
      @foreach($posts->take(3) as $post)
      <div class="bg-white border border-gray-100 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
        @if($post->featured_image)
        <div class="h-44 bg-gray-100">
          <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
        </div>
        @endif

        <div class="p-6 flex flex-col h-full">
          <div class="text-xs text-navy bg-gold px-3 py-1 rounded-full w-max mb-3 flex items-center gap-2">
            <svg class="w-4 h-4 text-navy" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 4h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            {{ $post->created_at->format('d M Y') }}
          </div>

          <h3 class="text-lg font-semibold text-navy mb-3 leading-snug">
            {{ \Illuminate\Support\Str::limit($post->title, 60) }}
          </h3>

          <div class="mt-auto">
            <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center text-gold font-semibold hover:text-gold-dark transition text-sm">
              Read More
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
              </svg>
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>

    <!-- View All Link -->
    <div class="text-center mt-12">
      <a href="{{ route('blog.index') }}" class="text-gold font-semibold hover:text-gold-dark inline-flex items-center transition">
        View All Posts
        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
        </svg>
      </a>
    </div>
  </div>
</section>


  <!-- Call-to-Action Section with Background Video -->
  <section class="py-20 bg-white text-center" data-aos="fade-up">
  <div class="container mx-auto px-4">
    <h2 class="text-4xl font-bold mb-4 text-navy">Join Us This Sunday</h2>
    <p class="text-xl mb-8 text-gray-600">Experience the love of Christ in our community.</p>
    <a href="/contact" class="bg-gold text-white font-bold py-3 px-6 rounded-lg hover:bg-gold-dark transition duration-300 shadow-md">
      Get in Touch
    </a>
  </div>
</section>


</div>

<!-- AOS -->
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init();
</script>

<!-- Typed.js -->
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
  var typed = new Typed('#typed', {
    strings: ["Welcome to Our Church", "Experience God's Love", "Join Our Family Today"],
    typeSpeed: 50,
    backSpeed: 30,
    backDelay: 2000,
    loop: true
  });
</script>

<!-- Fancy Preloader Script -->
<script>
  window.addEventListener('load', () => {
    const preloader = document.getElementById('preloader');
    if (preloader) {
      preloader.style.transition = 'opacity 0.5s ease';
      preloader.style.opacity = '0';
      setTimeout(() => preloader.remove(), 500);
    }
  });
</script>

<!-- Spinner Style -->
<style>
  .loader {
    border-top-color: #FFD700;
  }
</style>

</x-app-layout>
