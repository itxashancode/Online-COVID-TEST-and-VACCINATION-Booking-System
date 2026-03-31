{{-- Premium Login Page: Glassmorphism + Dynamic Aesthetic --}}
<x-guest-layout>
    <style>
        /* RESET & BASE */
        .min-vh-100 { min-height: 100vh; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .header-gradient {
            background: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }
        .input-group-custom {
            margin-bottom: 20px;
        }
        .form-input {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 1.5px solid #e2e8f0;
            background: #f8fafc;
            transition: all 0.3s;
        }
        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .btn-submit {
            background: #2563eb;
            color: white;
            padding: 14px;
            border-radius: 12px;
            border: none;
            width: 100%;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        }
        .btn-submit:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(37, 99, 235, 0.2);
        }
        .btn-outline {
            border: 2px solid #e2e8f0;
            background: transparent;
            padding: 12px;
            border-radius: 12px;
            width: 100%;
            font-weight: 600;
            color: #475569;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.3s;
        }
        .btn-outline:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: #1e293b;
        }
        .divider {
            height: 1px;
            background: #e2e8f0;
            width: 100%;
            margin: 24px 0;
            position: relative;
        }
        .divider::after {
            content: "or";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 0 12px;
            color: #94a3b8;
            font-size: 0.8rem;
        }
    </style>

    <div class="glass-card mx-auto" style="max-width: 450px;">
        <!-- HEADER -->
        <div class="header-gradient">
            <i data-lucide="shield-plus" style="width: 56px; height: 56px; margin-bottom: 16px;"></i>
            <h2 style="font-size: 1.75rem; font-weight: 800; margin: 0;">Welcome Back</h2>
            <p style="color: rgba(255, 255, 255, 0.7); margin: 8px 0 0; font-size: 0.9rem;">Access your MED-Digi health profile</p>
        </div>

        <!-- FORM BODY -->
        <div style="padding: 40px;">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="input-group-custom">
                    <label style="display: block; font-weight: 600; font-size: 0.875rem; color: #475569; margin-bottom: 6px;">Email Address</label>
                    <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="name@example.com" />
                    <x-input-error :messages="$errors->get('email')" style="margin-top: 8px; color: #ef4444; font-size: 0.8rem;" />
                </div>

                <!-- Password -->
                <div class="input-group-custom">
                    <label style="display: block; font-weight: 600; font-size: 0.875rem; color: #475569; margin-bottom: 6px;">Password</label>
                    <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                    <x-input-error :messages="$errors->get('password')" style="margin-top: 8px; color: #ef4444; font-size: 0.8rem;" />
                </div>

                <!-- REMEMBER & FORGOT -->
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
                    <label style="display: flex; align-items: center; gap: 8px; font-size: 0.875rem; color: #64748b; cursor: pointer;">
                        <input id="remember_me" type="checkbox" name="remember" style="width: 16px; height: 16px; border-radius: 4px;">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="font-size: 0.875rem; color: #2563eb; text-decoration: none; font-weight: 500;">Forgot?</a>
                    @endif
                </div>

                <!-- SUBMIT -->
                <button type="submit" class="btn-submit">
                    Sign In
                </button>
            </form>

            <div class="divider"></div>

            <!-- FOOTER LINKS -->
            <div style="text-align: center;">
                <p style="color: #64748b; font-size: 0.875rem; margin-bottom: 16px;">Don't have an account?</p>
                <a href="{{ route('register') }}" class="btn-outline">
                    <i data-lucide="user-plus" style="width: 18px; height: 18px;"></i>
                    Create New Account
                </a>
                <p style="margin-top: 20px; font-size: 0.75rem; color: #94a3b8;">&copy; {{ date('Y') }} MED-Digi Healthcare</p>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</x-guest-layout>
