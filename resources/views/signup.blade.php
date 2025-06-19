<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}?v={{ time() }}" type="image/x-icon">
    <link rel="stylesheet" href="https://rekruitmen-karyawan-production.up.railway.app/build/assets/app-29d60af5.css">
    <script src="https://rekruitmen-karyawan-production.up.railway.app/build/assets/app-7efdc69a.js" defer></script>
    <style>
      .signup-fade-in {
        opacity: 0;
        transform: translateY(40px);
        animation: signupFadeIn 1s cubic-bezier(0.23, 1, 0.32, 1) 0.2s forwards;
      }
      @keyframes signupFadeIn {
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      @keyframes pulse {
        0%, 100% { box-shadow: 0 0 0 0 #a78bfa44; }
        50% { box-shadow: 0 0 0 12px #a78bfa11; }
      }
      .circle-animate {
        animation: pulse 2s infinite;
      }
      /* Staggered fade-in */
      .stagger { opacity: 0; transform: translateY(30px); }
      .stagger.show { opacity: 1; transform: translateY(0); transition: all 0.7s cubic-bezier(0.23, 1, 0.32, 1); }
      .typing {
        border-right: 2px solid #333;
        white-space: nowrap;
        overflow: hidden;
        width: 0;
        animation: typing 1.2s steps(20, end) forwards, blink 0.7s step-end infinite alternate;
      }
      @keyframes typing {
        from { width: 0; }
        to { width: 100%; }
      }
      @keyframes blink {
        50% { border-color: transparent; }
      }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center transition-colors duration-300" style="background: linear-gradient(90deg, #120622 50%, #885175 50%); font-family: 'Share Tech Mono', monospace;">
  <div class="flex w-full min-h-screen items-center justify-center">
    <!-- Left Illustration -->
    <div class="hidden md:flex flex-1 items-center justify-center">
      <img src="{{ asset('images/login-amico.png') }}" alt="Signup Illustration" class="w-80 max-w-xs md:max-w-md" loading="lazy">
    </div>
    <!-- Signup Card -->
    <div class="relative flex-1 flex items-center justify-center">
      <div id="signup-card" class="relative bg-gray-100 dark:bg-gray-800 rounded-2xl shadow-2xl px-8 py-10 w-full max-w-md mx-auto signup-fade-in transition-transform duration-300">
        <!-- Circle Accent -->
        <div class="absolute -top-6 right-6 w-10 h-10 rounded-full border-4 border-white dark:border-gray-800 bg-purple-500 circle-animate"></div>
        <h2 class="text-2xl md:text-3xl font-bold text-left mb-1 tracking-widest text-gray-800 dark:text-white" style="font-family: 'Share Tech Mono', monospace;">
          <span id="typing-title" class="typing"></span>
        </h2>
        <p class="text-left text-gray-600 dark:text-gray-300 mb-6 text-sm stagger">Create your account</p>
        
        @if ($errors->any())
        <div class="bg-red-50 text-red-500 p-3 rounded-lg mb-4 text-sm">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <form method="POST" action="{{ route('register.submit') }}">
          @csrf
          <h3 class="text-lg font-semibold border-b border-gray-200 pb-2 mb-3 text-gray-700 dark:text-gray-200 stagger">Informasi Akun</h3>
          <input type="text" name="name" placeholder="Full Name" value="{{ old('name') }}" class="w-full mb-4 px-5 py-3 rounded-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-300 text-gray-700 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 text-base transition focus:shadow-lg stagger" required />
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="w-full mb-4 px-5 py-3 rounded-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-300 text-gray-700 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 text-base transition focus:shadow-lg stagger" required />
          <input type="text" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" class="w-full mb-4 px-5 py-3 rounded-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-300 text-gray-700 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 text-base transition focus:shadow-lg stagger" required />
          <input type="password" name="password" placeholder="Password" class="w-full mb-4 px-5 py-3 rounded-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-300 text-gray-700 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 text-base transition focus:shadow-lg stagger" required />
          <input type="password" name="password_confirmation" placeholder="Confirm Password" class="w-full mb-6 px-5 py-3 rounded-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-purple-300 text-gray-700 dark:text-gray-200 placeholder-gray-400 dark:placeholder-gray-500 text-base transition focus:shadow-lg stagger" required />
          
          <div class="flex items-center mb-6 stagger">
            <label class="flex items-center text-xs text-gray-600 dark:text-gray-300">
              <input type="checkbox" name="terms" class="mr-2 rounded border-gray-300 dark:border-gray-600 focus:ring-purple-400" required />
              I agree to the <a href="#" class="text-pink-500 hover:underline ml-1">Terms and Conditions</a>
            </label>
          </div>
          <button type="submit" class="w-full bg-black dark:bg-gray-700 text-white dark:text-gray-200 py-3 rounded-full font-semibold text-base shadow hover:bg-gray-900 dark:hover:bg-gray-600 transition-all hover:scale-105 active:scale-95 hover:shadow-2xl stagger">Register</button>
        </form>
        <p class="text-center text-xs text-gray-700 dark:text-gray-300 mt-6 stagger">Already have an account? <a href="/login" class="text-pink-500 hover:underline">Login</a></p>
      </div>
    </div>
  </div>
  <script>
    // Staggered fade-in for form elements
    window.addEventListener('DOMContentLoaded', () => {
      setTimeout(() => {
        document.querySelectorAll('.stagger').forEach((el, idx) => {
          setTimeout(() => el.classList.add('show'), 200 + idx * 120);
        });
        
        const titleElement = document.getElementById('typing-title');
        titleElement.textContent = 'SIGNUP'; // Set the text content
      }, 800);
    });

    // Parallax card effect
    const card = document.getElementById('signup-card');
    card.addEventListener('mousemove', (e) => {
      const rect = card.getBoundingClientRect();
      const x = e.clientX - rect.left;
      const y = e.clientY - rect.top;
      const centerX = rect.width / 2;
      const centerY = rect.height / 2;
      const rotateX = (y - centerY) / 18;
      const rotateY = (x - centerX) / 18;
      card.style.transform = `rotateX(${-rotateX}deg) rotateY(${rotateY}deg)`;
    });
    card.addEventListener('mouseleave', () => {
      card.style.transform = '';
    });

    // Typing effect for title (looping)
    const titleText = 'Hello World!';
    const typingTitle = document.getElementById('typing-title');
    let i = 0;
    let typingForward = true;
    function typeTitleLoop() {
      if (typingForward) {
        if (i <= titleText.length) {
          typingTitle.textContent = titleText.slice(0, i);
          i++;
          setTimeout(typeTitleLoop, 70);
        } else {
          typingForward = false;
          setTimeout(typeTitleLoop, 1200);
        }
      } else {
        if (i >= 0) {
          typingTitle.textContent = titleText.slice(0, i);
          i--;
          setTimeout(typeTitleLoop, 30);
        } else {
          typingForward = true;
          setTimeout(typeTitleLoop, 500);
        }
      }
    }
    typeTitleLoop();
  </script>
</body>
</html>