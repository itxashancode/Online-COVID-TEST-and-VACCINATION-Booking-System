{{-- Premium Reset Password Page: Glassmorphism --}}
<x-guest-layout>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .header-gradient {
            background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }
        .form-input, .form-select {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            background: #f8fafc;
            transition: all 0.3s;
            font-size: 0.9rem;
        }
        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: #8b5cf6;
            background: white;
            box-shadow: 0 0 0 4px rgba(139, 92, 246, 0.1);
        }
        .btn-submit {
            background: #8b5cf6;
            color: white;
            padding: 14px;
            border-radius: 12px;
            border: none;
            width: 100%;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 15px -3px rgba(139, 92, 246, 0.3);
        }
        .btn-submit:hover {
            background: #7c3aed;
            transform: translateY(-2px);
        }
        .btn-submit:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }
        .text-label {
            display: block;
            font-weight: 600;
            font-size: 0.875rem;
            color: #475569;
            margin-bottom: 6px;
        }
        .error-text {
            margin-top: 6px;
            color: #ef4444;
            font-size: 0.75rem;
        }
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #64748b;
            padding: 0;
        }
    </style>

    <div class="glass-card mx-auto" style="max-width: 500px; margin-top: 40px; margin-bottom: 40px;">
        <!-- HEADER -->
        <div class="header-gradient">
            <i data-lucide="lock" style="width: 56px; height: 56px; margin: 0 auto 16px auto; display: block;"></i>
            <h2 style="font-size: 1.75rem; font-weight: 800; margin: 0;">Reset Password</h2>
            <p style="color: rgba(255, 255, 255, 0.7); margin: 8px 0 0; font-size: 0.9rem;">Enter your new password below</p>
        </div>

        <!-- FORM BODY -->
        <div style="padding: 40px;">
            <form method="POST" action="{{ route('password.store') }}" x-data="{ submitting: false }" @submit="submitting = true">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="mb-3">
                    <label class="text-label" for="email">Email Address</label>
                    <input id="email" class="form-input" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" placeholder="name@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="error-text" />
                </div>

                <!-- Password -->
                <div class="mb-3" style="position: relative;">
                    <label class="text-label" for="password">New Password</label>
                    <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" style="padding-right: 40px;" />
                    <button type="button" onclick="togglePassword('password', 'eye-pass')" class="password-toggle">
                        <i data-lucide="eye" id="eye-pass" style="width: 20px; height: 20px;"></i>
                    </button>
                    <x-input-error :messages="$errors->get('password')" class="error-text" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-3" style="position: relative;">
                    <label class="text-label" for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" style="padding-right: 40px;" />
                    <button type="button" onclick="togglePassword('password_confirmation', 'eye-conf')" class="password-toggle">
                        <i data-lucide="eye" id="eye-conf" style="width: 20px; height: 20px;"></i>
                    </button>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="error-text" />
                </div>

                <!-- SUBMIT -->
                <button type="submit" class="btn-submit" :disabled="submitting">
                    <span x-show="!submitting">Reset Password</span>
                    <span x-show="submitting" style="display: inline-flex; align-items: center; gap: 8px;">
                        <div class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="width: 16px; height: 16px;"></div>
                        Resetting...
                    </span>
                </button>
            </form>

            <div style="margin-top: 20px; text-align: center;">
                <a href="{{ route('login') }}" style="color: #8b5cf6; text-decoration: none; font-weight: 600;">
                    <i data-lucide="arrow-left" style="width: 16px; height: 16px; vertical-align: middle;"></i>
                    Back to Login
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }
            lucide.createIcons();
        }
    </script>
</x-guest-layout>
