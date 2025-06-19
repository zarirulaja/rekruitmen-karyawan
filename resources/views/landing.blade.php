<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Winni Code - We Are Hiring | Tech Careers & Opportunities</title>
  <meta name="description" content="Join Winni Code - We're hiring talented developers and designers. Explore our open positions and grow your career with us.">
  <meta name="keywords" content="hiring, jobs, careers, tech jobs, developer jobs, web development careers">
  <meta property="og:title" content="Winni Code - We Are Hiring">
  <meta property="og:description" content="Join our dynamic team and grow your career with Winni Code">
  <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="https://rekruitmen-karyawan-production.up.railway.app/build/assets/app-29d60af5.css">
    <script src="https://rekruitmen-karyawan-production.up.railway.app/build/assets/app-7efdc69a.js" defer></script>
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body class="bg-gray-50 font-sans">

  <!-- Navbar -->
  <nav class="bg-white px-6 md:px-10 py-4 flex items-center justify-between shadow-md sticky top-0 z-50">
    <div class="flex items-center gap-2">
      <img src="{{ asset('images/banner-logo.png') }}" alt="Winni Code Logo" class="w-44 h-20 object-contain logo-animate transition-transform duration-300 ease-in-out hover:scale-110 hover:rotate-6" loading="lazy">
    </div>
    
    <!-- Desktop Navigation -->
    <div class="hidden md:flex items-center gap-8 lg:gap-12">
      <a href="#home" class="text-black text-lg font-medium hover:text-blue-500 transition nav-link">Home</a>
      <a href="#about" class="text-black text-lg font-medium hover:text-blue-500 transition nav-link">About Us</a>
      <a href="#contact" class="text-black text-lg font-medium hover:text-blue-500 transition nav-link">Contact Us</a>
      <a href="/login" class="bg-blue-500 text-white px-5 py-1.5 rounded-full text-lg font-semibold shadow hover:bg-blue-600 transition">Login</a>
    </div>
    
    <!-- Mobile Menu Button -->
    <button class="md:hidden text-gray-700 focus:outline-none" id="mobile-menu-button" aria-expanded="false">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </button>
  </nav>

  <!-- Mobile Menu -->
  <div class="md:hidden hidden bg-white shadow-lg py-2 px-4 absolute w-full z-40" id="mobile-menu">
    <a href="#home" class="block py-2 text-gray-800 hover:text-blue-500 nav-link">Home</a>
    <a href="#about" class="block py-2 text-gray-800 hover:text-blue-500 nav-link">About Us</a>
    <a href="#contact" class="block py-2 text-gray-800 hover:text-blue-500 nav-link">Contact Us</a>
    <a href="/login" class="block bg-blue-500 text-white px-4 py-2 rounded-full text-center font-semibold my-2 hover:bg-blue-600">Login</a>
  </div>

  <!-- Hero Section -->
  <section id="home" class="relative flex flex-col md:flex-row items-center justify-between px-6 md:px-24 py-16 md:py-24 min-h-[70vh] overflow-hidden animated-gradient reveal">
    <!-- Background Gradient Shape -->
    <div class="absolute inset-0 -z-10 bg-gradient-to-tr from-blue-50 via-white to-pink-50 opacity-80"></div>
    
    <!-- Text -->
    <div class="max-w-lg mb-10 md:mb-0 animate-fadeInUp reveal">
      <h1 class="text-4xl md:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
        We Are<br>Hiring.
      </h1>
      <p class="text-gray-600 text-base md:text-lg mb-8">
        Join our dynamic team and grow your career with us.<br>
        Explore exciting opportunities and be part of something impactful.
      </p>
      <a href="#positions" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-semibold px-6 py-3 rounded-full shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 text-lg transition-transform duration-300 hover:scale-105 hover:shadow-2xl">See Open Positions</a>
    </div>
    
    <!-- Illustration -->
    <div class="animate-fadeInUp reveal">
      <img src="{{ asset('images/resume.png') }}" alt="Hero Image" class="w-[300px] md:w-[400px] drop-shadow-xl hover:drop-shadow-2xl transition-all floating" loading="lazy">
    </div>
  </section>

  <!-- About Us Section -->
  <section id="about" class="relative bg-white py-16 md:py-20 px-6 md:px-24 overflow-hidden border-b border-gray-200 reveal">
    <!-- Decorative background circles -->
    <div class="absolute left-0 top-0 w-32 h-32 md:w-48 md:h-48 bg-pink-100 rounded-full opacity-30 -z-10"></div>
    <div class="absolute right-0 bottom-0 w-48 h-48 md:w-72 md:h-72 bg-purple-100 rounded-full opacity-30 -z-10"></div>
    
    <div class="max-w-6xl h-full flex flex-col md:flex-row items-center justify-between gap-8 md:gap-12 relative z-10">
      <!-- Left: About and Values -->
      <div class="flex-1 min-w-[280px] md:min-w-[320px]">
        <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-2 text-left">About Us</h2>
        <div class="flex items-center mb-6">
          <span class="h-2 w-12 md:w-16 bg-pink-400 rounded-full mr-2"></span>
          <span class="h-2 w-8 md:w-10 bg-blue-400 rounded-full"></span>
        </div>
        <p class="text-gray-700 text-base md:text-lg mb-8 max-w-xl text-left">
          Winni Code is a dynamic tech company passionate about creating innovative solutions that make a difference. Founded in 2020, we specialize in web development, mobile applications, and custom software solutions that help businesses thrive in the digital age.
        </p>
        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 text-left">Our Values</h3>
        <ul class="space-y-4 md:space-y-6">
          <li class="flex items-start gap-3 md:gap-4 hover:bg-purple-50 p-3 rounded-lg transition">
            <span class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 rounded-full bg-pink-400 flex items-center justify-center text-white text-xl md:text-2xl hover:scale-110 transition">
              <svg xmlns='http://www.w3.org/2000/svg' class="w-5 md:w-6 h-5 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
            </span>
            <div>
              <span class="font-bold text-base md:text-lg text-gray-900">Innovation</span>
              <div class="text-gray-600">We push boundaries to create cutting-edge solutions</div>
            </div>
          </li>
          <li class="flex items-start gap-3 md:gap-4 hover:bg-blue-50 p-3 rounded-lg transition">
            <span class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 rounded-full bg-blue-400 flex items-center justify-center text-white text-xl md:text-2xl hover:scale-110 transition">
              <svg xmlns='http://www.w3.org/2000/svg' class="w-5 md:w-6 h-5 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
            </span>
            <div>
              <span class="font-bold text-base md:text-lg text-gray-900">Excellence</span>
              <div class="text-gray-600">We deliver high-quality work that exceeds expectations</div>
            </div>
          </li>
          <li class="flex items-start gap-3 md:gap-4 hover:bg-purple-50 p-3 rounded-lg transition">
            <span class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 rounded-full bg-pink-400 flex items-center justify-center text-white text-xl md:text-2xl hover:scale-110 transition">
              <svg xmlns='http://www.w3.org/2000/svg' class="w-5 md:w-6 h-5 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg>
            </span>
            <div>
              <span class="font-bold text-base md:text-lg text-gray-900">Collaboration</span>
              <div class="text-gray-600">We believe in the power of teamwork and partnership</div>
            </div>
          </li>
        </ul>
      </div>
      
      <!-- Right: Team and Stats -->
      <div class="ml-auto flex flex-col items-center justify-center max-w-xs w-full mt-8 md:mt-0">
        <div class="flex gap-3 md:gap-4 mb-4">
          <span class="w-12 h-12 md:w-16 md:h-16 rounded-full border-2 border-purple-200 flex items-center justify-center bg-white hover:bg-purple-50 transition floating">
            <svg xmlns='http://www.w3.org/2000/svg' class="w-8 md:w-10 h-8 md:h-10 text-blue-400" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M12 14c-4.418 0-8 1.79-8 4v2h16v-2c0-2.21-3.582-4-8-4z"/></svg>
          </span>
          <span class="w-12 h-12 md:w-16 md:h-16 rounded-full border-2 border-purple-200 flex items-center justify-center bg-white hover:bg-purple-50 transition floating">
            <svg xmlns='http://www.w3.org/2000/svg' class="w-8 md:w-10 h-8 md:h-10 text-pink-400" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M12 14c-4.418 0-8 1.79-8 4v2h16v-2c0-2.21-3.582-4-8-4z"/></svg>
          </span>
          <span class="w-12 h-12 md:w-16 md:h-16 rounded-full border-2 border-purple-200 flex items-center justify-center bg-white hover:bg-purple-50 transition floating">
            <svg xmlns='http://www.w3.org/2000/svg' class="w-8 md:w-10 h-8 md:h-10 text-blue-400" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M12 14c-4.418 0-8 1.79-8 4v2h16v-2c0-2.21-3.582-4-8-4z"/></svg>
          </span>
        </div>
        <div class="font-bold text-lg md:text-xl text-gray-900 mb-6 md:mb-8">Our Team</div>
        <div class="flex gap-4 md:gap-6">
          <div class="bg-white border-2 border-purple-100 rounded-xl px-4 py-3 md:px-6 md:py-4 text-center shadow-sm hover:shadow-md transition">
            <div class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-1">50+</div>
            <div class="text-gray-500 text-sm md:text-base">Projects</div>
          </div>
          <div class="bg-white border-2 border-purple-100 rounded-xl px-4 py-3 md:px-6 md:py-4 text-center shadow-sm hover:shadow-md transition">
            <div class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-1">15+</div>
            <div class="text-gray-500 text-sm md:text-base">Experts</div>
          </div>
          <div class="bg-white border-2 border-purple-100 rounded-xl px-4 py-3 md:px-6 md:py-4 text-center shadow-sm hover:shadow-md transition">
            <div class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-1">8+</div>
            <div class="text-gray-500 text-sm md:text-base">Years</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Open Positions Section -->
  <section id="positions" class="bg-white py-16 px-6 md:px-24 reveal">
    <div class="max-w-4xl mx-auto text-center mb-10">
      <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Open Positions</h2>
      <div class="flex items-center justify-center mb-6">
        <span class="h-2 w-12 md:w-16 bg-pink-400 rounded-full mr-2"></span>
        <span class="h-2 w-8 md:w-10 bg-blue-400 rounded-full"></span>
      </div>
      <p class="text-gray-600 text-lg">Join our passionate team and help us build the future of tech. Explore our current openings below!</p>
    </div>
    <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
      <!-- Position Card -->
      <div class="bg-purple-50 border border-purple-200 rounded-xl p-6 shadow hover:shadow-lg transition reveal" style="animation-delay:0.1s">
        <h3 class="text-xl font-bold text-gray-900 mb-2">Frontend Developer</h3>
        <p class="text-gray-600 mb-4">React, Tailwind CSS, REST API</p>
        <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
          <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full">Remote</span>
          <span class="bg-pink-100 text-pink-600 px-3 py-1 rounded-full">Full Time</span>
        </div>
        <a href="mailto:hr@winnicode.com?subject=Frontend%20Developer%20Application" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-semibold px-5 py-2 rounded-full transition-all hover:scale-105">Apply Now</a>
      </div>
      <!-- Position Card -->
      <div class="bg-purple-50 border border-purple-200 rounded-xl p-6 shadow hover:shadow-lg transition reveal" style="animation-delay:0.2s">
        <h3 class="text-xl font-bold text-gray-900 mb-2">UI/UX Designer</h3>
        <p class="text-gray-600 mb-4">Figma, Design System, Prototyping</p>
        <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
          <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full">Onsite</span>
          <span class="bg-pink-100 text-pink-600 px-3 py-1 rounded-full">Internship</span>
        </div>
        <a href="mailto:hr@winnicode.com?subject=UI%2FUX%20Designer%20Application" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-semibold px-5 py-2 rounded-full transition-all hover:scale-105">Apply Now</a>
      </div>
      <!-- Position Card -->
      <div class="bg-purple-50 border border-purple-200 rounded-xl p-6 shadow hover:shadow-lg transition reveal" style="animation-delay:0.3s">
        <h3 class="text-xl font-bold text-gray-900 mb-2">Backend Engineer</h3>
        <p class="text-gray-600 mb-4">Laravel, Node.js, MySQL, API</p>
        <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
          <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full">Remote</span>
          <span class="bg-pink-100 text-pink-600 px-3 py-1 rounded-full">Full Time</span>
        </div>
        <a href="mailto:hr@winnicode.com?subject=Backend%20Engineer%20Application" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-semibold px-5 py-2 rounded-full transition-all hover:scale-105">Apply Now</a>
      </div>
      <!-- Position Card -->
      <div class="bg-purple-50 border border-purple-200 rounded-xl p-6 shadow hover:shadow-lg transition reveal" style="animation-delay:0.4s">
        <h3 class="text-xl font-bold text-gray-900 mb-2">Mobile App Developer</h3>
        <p class="text-gray-600 mb-4">Flutter, Kotlin, Swift</p>
        <div class="flex items-center gap-4 text-sm text-gray-500 mb-4">
          <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full">Remote</span>
          <span class="bg-pink-100 text-pink-600 px-3 py-1 rounded-full">Contract</span>
        </div>
        <a href="mailto:hr@winnicode.com?subject=Mobile%20App%20Developer%20Application" class="inline-block bg-pink-500 hover:bg-pink-600 text-white font-semibold px-5 py-2 rounded-full transition-all hover:scale-105">Apply Now</a>
      </div>
    </div>
  </section>

  <!-- Contact Us Section -->
  <section id="contact" class="relative bg-white py-16 md:py-20 px-6 md:px-24 overflow-hidden reveal">
    <!-- Decorative background circles -->
    <div class="absolute left-0 bottom-0 w-40 h-40 md:w-56 md:h-56 bg-purple-100 rounded-full opacity-30 -z-10"></div>
    <div class="absolute right-0 top-0 w-40 h-40 md:w-56 md:h-56 bg-purple-100 rounded-full opacity-30 -z-10"></div>
    
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-start justify-between gap-8 md:gap-12 relative z-10">
      <!-- Left: Contact Form -->
      <div class="flex-1 min-w-[280px] md:min-w-[320px]">
        <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-2">Contact Us</h2>
        <div class="flex items-center mb-6 md:mb-8">
          <span class="h-2 w-12 md:w-16 bg-blue-400 rounded-full mr-2"></span>
          <span class="h-2 w-12 md:w-16 bg-pink-400 rounded-full"></span>
        </div>
        <form class="bg-purple-50 border border-purple-200 rounded-2xl p-6 md:p-8 shadow-md hover:shadow-lg transition flex flex-col gap-4 md:gap-5">
          <input type="text" placeholder="Your Name" class="px-4 py-2 md:py-3 rounded-lg border border-purple-200 bg-white focus:outline-none focus:ring-2 focus:ring-pink-200 text-base md:text-lg placeholder-gray-400 hover:border-purple-300 transition" required>
          <input type="email" placeholder="Email Address" class="px-4 py-2 md:py-3 rounded-lg border border-purple-200 bg-white focus:outline-none focus:ring-2 focus:ring-pink-200 text-base md:text-lg placeholder-gray-400 hover:border-purple-300 transition" required>
          <input type="text" placeholder="Subject" class="px-4 py-2 md:py-3 rounded-lg border border-purple-200 bg-white focus:outline-none focus:ring-2 focus:ring-pink-200 text-base md:text-lg placeholder-gray-400 hover:border-purple-300 transition" required>
          <textarea placeholder="Your Message" rows="4" class="px-4 py-2 md:py-3 rounded-lg border border-purple-200 bg-white focus:outline-none focus:ring-2 focus:ring-pink-200 text-base md:text-lg placeholder-gray-400 resize-none hover:border-purple-300 transition" required></textarea>
          <button type="submit" class="w-36 md:w-40 mt-2 bg-pink-400 hover:bg-pink-500 text-white font-semibold py-2 md:py-3 rounded-full transition-all transform hover:scale-105 text-base md:text-lg shadow hover:shadow-md">Send Message</button>
        </form>
      </div>
      
      <!-- Right: Contact Info -->
      <div class="flex-1 flex flex-col items-center md:items-start min-w-[280px] md:min-w-[320px] mt-12 md:mt-[72px]">
        <div class="w-full max-w-md">
          <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">Get In Touch</h3>
          <p class="text-gray-600 mb-6">We'd love to hear from you. Reach out to us anytime.</p>
          <ul class="space-y-4 md:space-y-5 mb-8">
            <li class="flex items-center gap-3 md:gap-4 hover:bg-gray-50 p-2 rounded-lg transition">
              <span class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-pink-400 flex items-center justify-center text-white text-xl md:text-2xl hover:scale-110 transition">
                <svg xmlns='http://www.w3.org/2000/svg' class="w-5 md:w-6 h-5 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0zm0 0v1a4 4 0 01-8 0v-1" /></svg>
              </span>
              <div>
                <span class="font-bold text-base md:text-lg text-gray-900">Email</span><br>
                <span class="text-gray-600">info@winnicode.com</span>
              </div>
            </li>
            <li class="flex items-center gap-3 md:gap-4 hover:bg-gray-50 p-2 rounded-lg transition">
              <span class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-blue-400 flex items-center justify-center text-white text-xl md:text-2xl hover:scale-110 transition">
                <svg xmlns='http://www.w3.org/2000/svg' class="w-5 md:w-6 h-5 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2V5zm0 10a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2v-2zm10-10a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zm0 10a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>
              </span>
              <div>
                <span class="font-bold text-base md:text-lg text-gray-900">Phone</span><br>
                <span class="text-gray-600">+1 (555) 123-4567</span>
              </div>
            </li>
            <li class="flex items-center gap-3 md:gap-4 hover:bg-gray-50 p-2 rounded-lg transition">
              <span class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-pink-400 flex items-center justify-center text-white text-xl md:text-2xl hover:scale-110 transition">
                <svg xmlns='http://www.w3.org/2000/svg' class="w-5 md:w-6 h-5 md:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12.414a8 8 0 111.414-1.414l4.243 4.243a1 1 0 01-1.414 1.414z" /></svg>
              </span>
              <div>
                <span class="font-bold text-base md:text-lg text-gray-900">Address</span><br>
                <span class="text-gray-600">123 Tech Avenue, San Francisco, CA 94107</span>
              </div>
            </li>
          </ul>
          <div class="mb-2 font-bold text-base md:text-lg text-gray-900">Connect With Us</div>
          <div class="flex gap-3 md:gap-4">
            <a href="#" class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-blue-400 flex items-center justify-center text-white text-lg md:text-xl hover:bg-blue-500 transition transform hover:-translate-y-1" aria-label="Facebook">
              <svg xmlns='http://www.w3.org/2000/svg' class="w-4 md:w-5 h-4 md:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.408.595 24 1.326 24h11.495v-9.294H9.691v-3.622h3.13V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.408 24 22.674V1.326C24 .592 23.406 0 22.675 0"/></svg>
            </a>
            <a href="#" class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-pink-400 flex items-center justify-center text-white text-lg md:text-xl hover:bg-pink-500 transition transform hover:-translate-y-1" aria-label="Instagram">
              <svg xmlns='http://www.w3.org/2000/svg' class="w-4 md:w-5 h-4 md:h-5" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M16 8a6 6 0 01-8 0" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
            </a>
            <a href="#" class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-blue-400 flex items-center justify-center text-white text-lg md:text-xl hover:bg-blue-500 transition transform hover:-translate-y-1" aria-label="Twitter">
              <svg xmlns='http://www.w3.org/2000/svg' class="w-4 md:w-5 h-4 md:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.616 3.184A9.953 9.953 0 0012 0C5.373 0 0 5.373 0 12c0 4.991 3.657 9.128 8.438 9.877v-6.987h-2.54v-2.89h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.261c-1.243 0-1.631.771-1.631 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C20.343 21.128 24 16.991 24 12c0-2.137-.672-4.122-1.816-5.816z"/></svg>
            </a>
            <a href="#" class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-pink-400 flex items-center justify-center text-white text-lg md:text-xl hover:bg-pink-500 transition transform hover:-translate-y-1" aria-label="LinkedIn">
              <svg xmlns='http://www.w3.org/2000/svg' class="w-4 md:w-5 h-4 md:h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-8 right-8 w-12 h-12 bg-blue-500 text-white rounded-full shadow-lg hover:bg-blue-600 transition hidden items-center justify-center z-50">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
      </svg>
    </button>
    
    <!-- Decorative arc -->
    <svg class="absolute right-10 bottom-10 w-20 h-14 md:w-24 md:h-16 -z-10" fill="none" viewBox="0 0 96 64"><path d="M8 56c16-32 64-32 80 0" stroke="#a5b4fc" stroke-width="4" stroke-linecap="round"/></svg>
  </section>

  <!-- Footer -->
  <footer class="bg-white border-t py-6 text-center text-gray-500 text-sm">
    &copy; {{ date('Y') }} Winni Code. All rights reserved.
  </footer>

  <!-- Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-XXXXX-Y"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-XXXXX-Y');
  </script>

  <script src="{{ asset('js/landing.js') }}"></script>
</body>
</html>