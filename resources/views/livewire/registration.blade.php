<div class="w-full">
    <style>
        /* Form-specific animations and styles */
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

        .animate-fade-in-up-delay-4 {
            opacity: 0;
            animation: fadeInUp 0.6s ease-out 0.4s forwards;
        }

        .animate-scale-in {
            opacity: 0;
            animation: scaleIn 0.5s ease-out 0.5s forwards;
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
            font-size: 0.875rem;
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

        /* Password strength indicator */
        .password-strength {
            margin-top: 0.5rem;
            height: 4px;
            border-radius: 2px;
            background: rgba(255, 255, 255, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .password-strength-bar {
            height: 100%;
            transition: width 0.3s ease, background-color 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #ef4444; width: 25%; }
        .strength-fair { background: #f59e0b; width: 50%; }
        .strength-good { background: #10b981; width: 75%; }
        .strength-strong { background: #22c55e; width: 100%; }

        /* Links */
        .glass-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: underline;
            text-decoration-color: rgba(255, 255, 255, 0.4);
            transition: all 0.3s ease;
            font-size: 0.875rem;
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
            font-size: 0.875rem;
            backdrop-filter: blur(10px);
        }

        .error-message {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            border-radius: 8px;
            padding: 0.75rem;
            color: rgba(239, 68, 68, 0.9);
            font-size: 0.875rem;
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

        /* Password match indicator */
        .password-match {
            display: flex;
            align-items: center;
            margin-top: 0.5rem;
            font-size: 0.75rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .password-match.show {
            opacity: 1;
        }

        .match-success {
            color: #22c55e;
        }

        .match-error {
            color: #ef4444;
        }
    </style>

    <!-- Form -->
    <div class="animate-fade-in-up-delay-1">
        @csrf
        <div class="space-y-6">
            <!-- Name Field -->
            <div class="form-group animate-fade-in-up-delay-1">
                <label for="name" class="glass-label text-sm">
                    <i class="bi bi-person me-2"></i>Full Name
                </label>
                <input 
                    id="name" 
                    type="text" 
                    name="name" 
                    wire:model.live="name"
                    value="{{ old('name') }}" 
                    required 
                    autofocus 
                    placeholder="Enter your full name"
                    class="glass-input w-full h-12 px-4 py-3 text-sm"
                />
                @error('name')
                    <div class="error-message mt-2 text-xs">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="form-group animate-fade-in-up-delay-2">
                <label for="email" class="glass-label text-sm">
                    <i class="bi bi-envelope me-2"></i>Email Address
                </label>
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    wire:model.live="email"
                    value="{{ old('email') }}" 
                    required 
                    placeholder="Enter your email address"
                    class="glass-input w-full h-12 px-4 py-3 text-sm"
                />
                @error('email')
                    <div class="error-message mt-2 text-xs">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="form-group animate-fade-in-up-delay-3">
                <label for="password" class="glass-label text-sm">
                    <i class="bi bi-lock me-2"></i>Password
                </label>
                <div class="relative">
                    <input 
                        id="password" 
                        x-bind:type="showPassword ? 'text' : 'password'" 
                        name="password" 
                        wire:model.live="password"
                        required
                        placeholder="Create a secure password"
                        class="glass-input w-full h-12 px-4 py-3 pr-12 text-sm"
                        x-on:input="checkPasswordStrength($event.target.value)"
                    />
                    <button 
                        type="button" 
                        class="password-toggle"
                        @click="showPassword = !showPassword"
                    >
                        <i x-bind:class="showPassword ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                    </button>
                </div>
                <!-- Password Strength Indicator -->
                <div class="password-strength" x-show="password.length > 0">
                    <div class="password-strength-bar" x-bind:class="passwordStrengthClass"></div>
                </div>
                <div class="text-xs mt-1 text-white opacity-60" x-show="password.length > 0">
                    Password strength: <span x-text="passwordStrengthText" x-bind:class="passwordStrengthClass"></span>
                </div>
                @error('password')
                    <div class="error-message mt-2 text-xs">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password Field -->
            <div class="form-group animate-fade-in-up-delay-4">
                <label for="password_confirmation" class="glass-label text-sm">
                    <i class="bi bi-shield-check me-2"></i>Confirm Password
                </label>
                <div class="relative">
                    <input 
                        id="password_confirmation" 
                        x-bind:type="showConfirmPassword ? 'text' : 'password'" 
                        name="password_confirmation" 
                        wire:model.live="password_confirmation"
                        required
                        placeholder="Confirm your password"
                        class="glass-input w-full h-12 px-4 py-3 pr-12 text-sm"
                        x-on:input="checkPasswordMatch()"
                    />
                    <button 
                        type="button" 
                        class="password-toggle"
                        @click="showConfirmPassword = !showConfirmPassword"
                    >
                        <i x-bind:class="showConfirmPassword ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
                    </button>
                </div>
                <!-- Password Match Indicator -->
                <div class="password-match text-sm" x-bind:class="{ 'show': passwordConfirmation.length > 0 }">
                    <i x-bind:class="passwordsMatch ? 'bi bi-check-circle match-success' : 'bi bi-x-circle match-error'" class="me-2"></i>
                    <span x-text="passwordsMatch ? 'Passwords match' : 'Passwords do not match'" x-bind:class="passwordsMatch ? 'match-success' : 'match-error'"></span>
                </div>
                @error('password_confirmation')
                    <div class="error-message mt-2 text-xs">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions animate-fade-in-up-delay-4">
            <div class="flex flex-col sm:flex-row gap-4">
                <button wire:click='register' class="glass-button flex-1" x-bind:disabled="!canSubmit">
                    <i class="bi bi-person-plus me-2"></i>
                    Create Account
                </button>
                
                <a href="{{ route('login') }}" class="glass-button-secondary flex-1">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Sign In Instead
                </a>
            </div>
        </div>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="error-message mt-4 animate-fade-in-up-delay-4">
            <div class="font-medium">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Please correct the following errors:
            </div>
            <ul class="mt-2 list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script>
        function registrationForm() {
            return {
                showPassword: false,
                showConfirmPassword: false,
                password: '',
                passwordConfirmation: '',
                passwordStrength: 0,
                passwordStrengthText: '',
                passwordStrengthClass: '',
                passwordsMatch: false,
                
                get canSubmit() {
                    return this.password.length >= 8 && 
                           this.passwordsMatch && 
                           this.passwordStrength >= 2;
                },

                checkPasswordStrength(password) {
                    this.password = password;
                    let score = 0;
                    
                    if (password.length >= 8) score++;
                    if (/[a-z]/.test(password)) score++;
                    if (/[A-Z]/.test(password)) score++;
                    if (/[0-9]/.test(password)) score++;
                    if (/[^A-Za-z0-9]/.test(password)) score++;

                    this.passwordStrength = score;

                    if (score < 2) {
                        this.passwordStrengthText = 'Weak';
                        this.passwordStrengthClass = 'strength-weak';
                    } else if (score < 3) {
                        this.passwordStrengthText = 'Fair';
                        this.passwordStrengthClass = 'strength-fair';
                    } else if (score < 4) {
                        this.passwordStrengthText = 'Good';
                        this.passwordStrengthClass = 'strength-good';
                    } else {
                        this.passwordStrengthText = 'Strong';
                        this.passwordStrengthClass = 'strength-strong';
                    }

                    this.checkPasswordMatch();
                },

                checkPasswordMatch() {
                    this.passwordsMatch = this.password === this.passwordConfirmation && 
                                        this.password.length > 0 && 
                                        this.passwordConfirmation.length > 0;
                }
            }
        }
    </script>

</div>