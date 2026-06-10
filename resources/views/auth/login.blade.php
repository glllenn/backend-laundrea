<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In — Laundrea Admin</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        /* Menggunakan font premium modern Plus Jakarta Sans */
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        :root {
            --autumn-orange: #E07B39;
            --autumn-dark: #C45E20;
            --autumn-bg: #F7F4F0;
            --autumn-border: #EDE9E3;
            --autumn-card: #FFFFFF;
            --autumn-text: #1E1A17;
            --autumn-muted: #7A6F68;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--autumn-bg);
            color: var(--autumn-text);
        }

        /* Menetralkan warna background bawaan Google Chrome Autofill */
        input:-webkit-autofill,
        input:-webkit-autofill:hover, 
        input:-webkit-autofill:focus, 
        input:-webkit-autofill:active {
            -webkit-box-shadow: 0 0 0 30px var(--autumn-card) inset !important;
            -webkit-text-fill-color: var(--autumn-text) !important;
        }

        /* Efek bayangan halus premium untuk kartu login melayang */
        .autumn-shadow {
            box-shadow: 0 20px 40px -15px rgba(224, 123, 57, 0.08), 
                        0 30px 60px -20px rgba(30, 26, 23, 0.04);
        }
    </style>
</head>
<body class="relative flex items-center justify-center min-h-screen p-4 antialiased selection:bg-[#E07B39] selection:text-white overflow-hidden">

    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-[#E07B39]/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -right-40 w-[500px] h-[500px] bg-[#E07B39]/5 rounded-full blur-3xl"></div>
        
        <div class="absolute top-[10%] left-[5%] w-6 h-6 bg-[#E07B39]/10 rounded-full"></div>
        <div class="absolute top-[25%] left-[12%] w-3 h-3 bg-[#E07B39]/20 rounded-full"></div>
        <div class="absolute top-[8%] left-[22%] w-4 h-4 bg-[#E07B39]/15 rounded-full"></div>
        
        <div class="absolute bottom-[15%] left-[8%] w-8 h-8 bg-[#E07B39]/10 rounded-full"></div>
        <div class="absolute bottom-[30%] left-[4%] w-4 h-4 bg-[#E07B39]/15 rounded-full"></div>
        <div class="absolute bottom-[8%] left-[18%] w-5 h-5 bg-[#E07B39]/20 rounded-full"></div>

        <div class="absolute top-[15%] right-[7%] w-8 h-8 bg-[#E07B39]/10 rounded-full"></div>
        <div class="absolute top-[5%] right-[15%] w-4 h-4 bg-[#E07B39]/20 rounded-full"></div>
        <div class="absolute top-[28%] right-[4%] w-5 h-5 bg-[#E07B39]/15 rounded-full"></div>

        <div class="absolute bottom-[12%] right-[10%] w-6 h-6 bg-[#E07B39]/15 rounded-full"></div>
        <div class="absolute bottom-[28%] right-[15%] w-3 h-3 bg-[#E07B39]/25 rounded-full"></div>
        <div class="absolute bottom-[5%] right-[5%] w-7 h-7 bg-[#E07B39]/10 rounded-full"></div>
        
        <div class="absolute top-[45%] left-[15%] w-4 h-4 bg-[#E07B39]/10 rounded-full hidden md:block"></div>
        <div class="absolute bottom-[40%] right-[12%] w-5 h-5 bg-[#E07B39]/10 rounded-full hidden md:block"></div>
    </div>
    <div class="relative w-full max-w-[440px] view-sec animate-[vFade_0.25s_ease-out] z-10">
        
        <div class="bg-white/95 backdrop-blur-md border border-[#EDE9E3] rounded-2xl autumn-shadow p-8 sm:p-10 flex flex-col items-center">
            
            <div class="mb-5">
                <img 
                    src="{{ asset('img/laundreaa.png') }}" 
                    alt="Logo Laundrea" 
                    class="w-14 h-14 object-contain rounded-xl"
                    onerror="this.outerHTML='<div class=\'w-14 h-14 bg-[#FEF3EA] text-[#E07B39] rounded-xl flex items-center justify-center font-bold text-xl\'>LA</div>'"
                >
            </div>

            <h1 class="text-2xl font-bold text-slate-800 tracking-tight mb-1.5">
                Sign In Admin
            </h1>
            
            <p class="text-xs text-[#7A6F68] font-medium mb-8">
                Gunakan akses kredensial Anda yang terdaftar
            </p>

            <form id="loginForm" class="w-full space-y-4">
                
                <div class="w-full">
                    <label for="email" class="block text-[10px] font-bold uppercase tracking-wider text-[#7A6F68] mb-1.5 px-1">
                        Email Address
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        required 
                        placeholder="admin@laundrea.com" 
                        class="w-full px-4 py-3 bg-[#FFFBF7] border border-[#EDE9E3] rounded-xl focus:ring-2 focus:ring-[#E07B39]/10 focus:border-[#E07B39] focus:bg-white outline-none transition-all placeholder:text-slate-400 text-slate-800 font-medium text-sm"
                    >
                </div>

                <div class="w-full relative">
                    <div class="flex justify-between items-center mb-1.5 px-1">
                        <label for="password" class="block text-[10px] font-bold uppercase tracking-wider text-[#7A6F68]">
                            Password
                        </label>
                        <a href="#" class="text-[10px] font-bold text-[#7A6F68] hover:text-[#E07B39] transition-colors">
                            Lupa?
                        </a>
                    </div>
                    
                    <div class="relative w-full">
                        <input 
                            type="password" 
                            id="password" 
                            required 
                            placeholder="••••••••" 
                            class="w-full px-4 py-3 bg-[#FFFBF7] border border-[#EDE9E3] rounded-xl focus:ring-2 focus:ring-[#E07B39]/10 focus:border-[#E07B39] focus:bg-white outline-none transition-all placeholder:text-slate-400 text-slate-800 font-medium text-sm pr-11"
                        >
                        
                        <button 
                            type="button" 
                            id="togglePassword" 
                            class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-[#E07B39] outline-none transition-colors p-1"
                            aria-label="Toggle Password Display"
                        >
                            <svg id="eyeClosed" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"></path>
                            </svg>
                            
                            <svg id="eyeOpen" class="w-4 h-4 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <button 
                    type="submit" 
                    id="btnSubmit" 
                    class="w-full py-3.5 mt-4 bg-[#E07B39] hover:bg-[#C45E20] text-white font-semibold rounded-xl shadow-md shadow-[#E07B39]/15 transition-all transform active:scale-[0.99] flex justify-center items-center gap-2 text-xs tracking-wider uppercase"
                >
                    <span id="btnText">Sign In</span>
                    
                    <div id="btnSpinner" class="hidden w-4 h-4 border-2 border-white/20 border-t-white rounded-full animate-spin"></div>
                </button>
            </form>

        </div>

        <div class="text-center mt-6 text-[11px] text-[#7A6F68] font-medium tracking-wide">
            &copy; 2025-2026 Laundrea Inc. &bull; Admin Portal System
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // --------------------------------------------------
            // 1. LOGIKA INTERAKSI MATA PASSWORD
            // --------------------------------------------------
            const togglePasswordBtn = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eyeOpen');
            const eyeClosed = document.getElementById('eyeClosed');

            if (togglePasswordBtn && passwordInput) {
                togglePasswordBtn.addEventListener('click', function () {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    
                    if (isPassword) {
                        passwordInput.setAttribute('type', 'text');
                        eyeClosed.classList.add('hidden');
                        eyeOpen.classList.remove('hidden');
                    } else {
                        passwordInput.setAttribute('type', 'password');
                        eyeOpen.classList.add('hidden');
                        eyeClosed.classList.remove('hidden');
                    }
                });
            }

            // --------------------------------------------------
            // 2. INTERKONEKSI API LOGIN KE LARAVEL
            // --------------------------------------------------
            const loginForm = document.getElementById('loginForm');
            const btnSubmit = document.getElementById('btnSubmit');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');

            if (loginForm) {
                loginForm.addEventListener('submit', async function(event) {
                    event.preventDefault();

                    // --- INITIALIZE UI LOADING FEEDBACK ---
                    btnSubmit.disabled = true;
                    btnText.innerText = 'MEMVERIFIKASI...';
                    btnSpinner.classList.remove('hidden');
                    btnSubmit.classList.add('opacity-85', 'cursor-not-allowed');

                    const email = document.getElementById('email').value;
                    const passwordValue = document.getElementById('password').value;

                    try {
                        const response = await fetch('/api/login', {
                            method: 'POST',
                            headers: { 
                                'Content-Type': 'application/json', 
                                'Accept': 'application/json' 
                            },
                            body: JSON.stringify({ 
                                email: email, 
                                password: passwordValue 
                            })
                        });

                        const res = await response.json();

                        if (res.success) {
                            localStorage.setItem('token', res.access_token);
                            localStorage.setItem('user', JSON.stringify(res.data));
                            
                            Swal.fire({
                                icon: 'success',
                                title: 'Autentikasi Berhasil',
                                text: 'Selamat bekerja kembali di admin panel.',
                                timer: 1300,
                                showConfirmButton: false,
                                background: '#FFFFFF',
                                color: '#1E1A17',
                                iconColor: '#16A34A'
                            }).then(function() {
                                window.location.href = '/dashboard';
                            });

                        } else {
                            throw new Error(res.message || 'Kredensial salah atau tidak cocok.');
                        }
                        
                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Masuk',
                            text: error.message || 'Koneksi jaringan server terputus.',
                            confirmButtonColor: '#E07B39',
                            confirmButtonText: 'Coba Lagi',
                            background: '#FFFFFF',
                            color: '#1E1A17'
                        });
                        
                    } finally {
                        // --- TEARDOWN UI LOADING FEEDBACK (RESET) ---
                        btnSubmit.disabled = false;
                        btnText.innerText = 'Sign In';
                        btnSpinner.classList.add('hidden');
                        btnSubmit.classList.remove('opacity-85', 'cursor-not-allowed');
                    }
                });
            }
            
        });
    </script>
</body>
</html>