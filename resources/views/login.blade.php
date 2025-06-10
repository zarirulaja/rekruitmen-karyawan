<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <style>
      .login-fade-in {
        opacity: 0;
        transform: translateY(40px);
        animation: loginFadeIn 1s cubic-bezier(0.23, 1, 0.32, 1) 0.2s forwards;
      }
      @keyframes loginFadeIn {
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
      /* Circle accent pulse */
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
      /* Typing effect */
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
<body class="min-h-screen flex items-center justify-center" style="background: linear-gradient(90deg, #120622 50%, #885175 50%); font-family: 'Share Tech Mono', monospace;">
  <div class="relative flex items-center justify-center w-full min-h-screen">
    <!-- Login Card -->
    <div id="login-card" class="relative bg-gray-100 rounded-2xl shadow-2xl px-8 py-10 w-full max-w-md mx-auto login-fade-in transition-transform duration-300">
      <!-- Circle Accent -->
      <div class="absolute -top-6 left-6 w-10 h-10 rounded-full border-4 border-white bg-purple-500 circle-animate"></div>
      <h2 class="text-2xl md:text-3xl font-bold text-center mb-2 tracking-widest" style="font-family: 'Share Tech Mono', monospace;">
        <span id="typing-title" class="typing"></span>
      </h2>
      <p class="text-center text-gray-500 mb-6 text-sm stagger">Login with your details</p>
      
      @if ($errors->any())
      <div class="bg-red-50 text-red-500 p-3 rounded-lg mb-4 text-sm">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="w-full mb-4 px-5 py-3 rounded-full bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-300 text-gray-700 placeholder-gray-400 text-base transition focus:shadow-lg" required />
        <input type="password" name="password" placeholder="Password" class="w-full mb-4 px-5 py-3 rounded-full bg-white border border-gray-200 focus:outline-none focus:ring-2 focus:ring-purple-300 text-gray-700 placeholder-gray-400 text-base transition focus:shadow-lg" required />
        <div class="flex items-center justify-between mb-6 stagger">
          <label class="flex items-center text-xs text-gray-600">
            <input type="checkbox" name="remember" class="mr-2 rounded border-gray-300 focus:ring-purple-400" />
            Remember me
          </label>
          <a href="{{ route('password.request') }}" class="text-xs text-pink-500 hover:underline">Forgot Password</a>
        </div>
        <button type="submit" class="w-full bg-black text-white py-3 rounded-full font-semibold text-base shadow hover:bg-gray-900 transition-all hover:scale-105 active:scale-95 hover:shadow-2xl stagger">Login</button>
      </form>
      <p class="text-center text-xs text-gray-700 mt-6 stagger">Don't have an account? <a href="/signup" class="text-pink-500 hover:underline">Signup</a></p>
    </div>
  </div>
  <script>
    // Typing effect for title
    const titleText = 'Hello World!';
    const typingTitle = document.getElementById('typing-title');
    let i = 0;
    function typeTitle() {
      if (i <= titleText.length) {
        typingTitle.textContent = titleText.slice(0, i);
        i++;
        setTimeout(typeTitle, 60);
      }
    }
    typeTitle();

    // Staggered fade-in for form elements
    window.addEventListener('DOMContentLoaded', () => {
      setTimeout(() => {
        document.querySelectorAll('.stagger').forEach((el, idx) => {
          setTimeout(() => el.classList.add('show'), 200 + idx * 120);
        });
      }, 800);
    });

    // Parallax card effect
    const card = document.getElementById('login-card');
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
  </script>
</body>
</html>