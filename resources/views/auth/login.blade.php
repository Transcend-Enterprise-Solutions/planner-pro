<x-authentication-layout>
    <style>
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            gap: 0.75rem;
        }

        @keyframes fadeInUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-fade-in-up-delay-1 {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out 0.1s forwards;
        }

        .animate-fade-in-up-delay-2 {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out 0.2s forwards;
        }

        .animate-fade-in-up-delay-3 {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out 0.3s forwards;
        }

        .animate-scale-in {
            opacity: 0;
            animation: scaleIn 0.5s ease-out 0.4s forwards;
        }

        /* Modern form input styling */
        .glass-input {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            transition: all 0.3s ease;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-2px);
        }

        .glass-input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        /* Modern label styling */
        .glass-label {
            color: rgba(255, 255, 255, 0.9);
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
            transition: color 0.3s ease;
        }

        /* Modern button styling */
        .glass-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            padding: 0.875rem 2rem;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            position: relative;
            overflow: hidden;
        }

        .glass-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .glass-button:hover::before {
            left: 100%;
        }

        .glass-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
        }

        .glass-button:active {
            transform: translateY(0);
        }

        .glass-button-secondary {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: white;
            font-weight: 500;
            padding: 0.875rem 2rem;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .glass-button-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        /* Checkbox styling */
        .glass-checkbox {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 4px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .glass-checkbox:checked {
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-color: #667eea;
        }

        .glass-checkbox:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        /* Links */
        .glass-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: underline;
            text-decoration-color: rgba(255, 255, 255, 0.4);
            transition: all 0.3s ease;
        }

        .glass-link:hover {
            color: white;
            text-decoration-color: white;
        }

        /* Status and error messages */
        .success-message {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.2);
            border-radius: 8px;
            padding: 0.75rem;
            color: rgba(34, 197, 94, 0.9);
            backdrop-filter: blur(10px);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 8px;
            padding: 0.75rem;
            backdrop-filter: blur(10px);
        }

        /* Password visibility toggle */
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
            font-size: 1.1rem;
            transition: color 0.3s ease;
            z-index: 10;
        }

        .password-toggle:hover {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Form spacing */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-actions {
            margin-top: 2rem;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #ff6b6b, #4ecdc4);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
            box-shadow: 0 10px 30px rgba(255, 107, 107, 0.3);
        }
    </style>

    <!-- Logo -->
    <div class="logo-container">
        <div class="logo-icon">
            <i class="bi bi-diagram-3"></i>
        </div>
        <span class="brand-text">PlannerPro</span>
    </div>

    <!-- Form Header -->
    <h2 class="form-title">Welcome Back</h2>
    <p class="form-subtitle text-sm" style="margin-top:-10px">Sign in to continue to your projects</p>

    @if (session('status'))
        <!-- Status Message -->
        <div class="success-message animate-fade-in-up">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('status') }}
        </div>
    @endif

    <!-- Form -->
    <form method="POST" wire:submit.prevent='login' class="animate-fade-in-up-delay-1">
        @csrf
        <div class="space-y-6">
            <!-- Email Field -->
            <div class="form-group animate-fade-in-up-delay-1">
                <label for="email" class="glass-label text-sm">
                    <i class="bi bi-envelope me-2"></i>Email Address
                </label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus 
                    placeholder="Enter your email"
                    class="text-sm glass-input w-full h-12 px-4 py-3"
                />
                @error('email')
                    <div class="error-message mt-2 text-xs text-white">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group animate-fade-in-up-delay-2" x-data="{ showPassword: false }">
                <label for="password" class="glass-label text-sm">
                    <i class="bi bi-lock me-2"></i>Password
                </label>
                <div class="relative">
                    <input 
                        id="password" 
                        x-bind:type="showPassword ? 'text' : 'password'" 
                        name="password" 
                        required
                        autocomplete="current-password" 
                        wire:model.live="password"
                        placeholder="Enter your password"
                        class="text-sm glass-input w-full h-12 px-4 py-3 pr-12"
                    />
                    <button 
                        type="button" 
                        class="password-toggle"
                        @click="showPassword = !showPassword"
                    >
                        <i x-bind:class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                    </button>
                </div>
                @error('password')
                    <div class="error-message mt-2 text-xs text-white">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between animate-fade-in-up-delay-2">
                <div class="flex items-center">
                    <input
                        id="remember_me"
                        type="checkbox"
                        wire:model.defer="remember"
                        class="glass-checkbox"
                    />
                    <label for="remember_me" class="glass-link ml-3 text-sm">
                        Remember me
                    </label>
                </div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="glass-link text-sm">
                        <i class="bi bi-question-circle me-1"></i>Forgot password?
                    </a>
                @endif
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions animate-fade-in-up-delay-3">
            <div class="flex flex-col sm:flex-row gap-4">
                <button type="submit" class="glass-button flex-1">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Sign In
                </button>
                
                <a href="{{ route('register') }}" class="glass-button-secondary flex-1">
                    <i class="bi bi-person-plus me-2"></i>
                    Create Account
                </a>
            </div>
        </div>
    </form>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="error-message mt-4 animate-fade-in-up-delay-3">
            <div class="font-medium text-sm text-white">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Please correct the following errors:
            </div>
            <ul class="mt-2 list-disc list-inside text-xs text-white">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @error('login')
        <div class="error-message mt-4 animate-fade-in-up-delay-3">
            <i class="bi bi-x-circle me-2"></i>
            {{ $message }}
        </div>
    @enderror

</x-authentication-layout>