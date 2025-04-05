<x-app-layout>

@section('content')
<!-- Contact Us Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-8">Contact Us</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <h3 class="text-2xl font-bold mb-6">Send Us a Message</h3>
                <form action="/contact" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-gray-700 font-bold mb-2">Message</label>
                        <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg transition duration-300">Send Message</button>
                    </div>
                </form>
            </div>

            <!-- Church Address and Map -->
            <div>
                <h3 class="text-2xl font-bold mb-6">Our Location</h3>
                <div class="bg-white p-8 rounded-lg shadow-lg mb-8">
                    <p class="text-gray-700 mb-4"><strong>Address:</strong> 123 Church Street, City, Country</p>
                    <p class="text-gray-700 mb-4"><strong>Phone:</strong> +123 456 7890</p>
                    <p class="text-gray-700 mb-4"><strong>Email:</strong> info@churchwebsite.com</p>
                </div>
                <!-- Google Map -->
                <div class="rounded-lg overflow-hidden shadow-lg">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.8354345093747!2d144.9537353153166!3d-37.816279742021665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf577d0f5f5e5f5f5!2sChurch%20Street%2C%20City%2C%20Country!5e0!3m2!1sen!2sus!4v1633023226784!5m2!1sen!2sus"
                        width="100%"
                        height="300"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                    ></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
</x-app-layout>