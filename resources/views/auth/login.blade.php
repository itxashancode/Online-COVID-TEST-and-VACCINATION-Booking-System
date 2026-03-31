{{-- Enhanced Login Page with Floating Card Design --}}
<x-guest-layout>
    <!-- CONTAINER: Full viewport height with centered content -->
    <!-- Why? Creates a focused, distraction-free login experience -->
    <div class="container-fluid d-flex align-items-center justify-content-center min-vh-100 py-4">
        <div class="row w-100 justify-content-center">
            <div class="col-md-6 col-lg-5 col-xl-4">
                <!-- FLOATING CARD: This creates the floating card effect -->
                <!-- Why border-0? Clean borderless design looks more modern -->
                <!-- Why shadow-lg? Large shadow creates depth, making card appear to float -->
                <!-- Why rounded-4? Soft corners (1rem) are inviting and friendly -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <!-- CARD HEADER: Blue gradient background -->
                    <div class="bg-gradient d-block py-4 px-5 text-center" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);">
                        <!-- LUCIDE ICON: shield-check - Why? Security, protection, trust -->
                        <i data-lucide="shield-check" class="text-white mb-3" style="width: 64px; height: 64px;"></i>
                        <h3 class="text-white fw-bold mb-1">Welcome Back</h3>
                        <p class="text-white-50 mb-0 small">Sign in to your COVID Booking account</p>
                    </div>

                    <!-- CARD BODY: Form content -->
                    <div class="card-body p-5">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address Field -->
                            <div class="mb-3">
                                <x-input-label for="email" :value="__('Email Address')" class="fw-medium" />
                                <!-- Why rounded-2? Slight rounding (0.5rem) is modern and professional -->
                                <x-text-input
                                    id="email"
                                    class="form-control rounded-2 mt-1"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="you@example.com" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password Field -->
                            <div class="mb-3">
                                <x-input-label for="password" :value="__('Password')" class="fw-medium" />
                                <x-text-input
                                    id="password"
                                    class="form-control rounded-2 mt-1"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Enter your password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Remember Me + Forgot Password Row -->
                            <div class="row align-items-center mb-4">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input
                                            id="remember_me"
                                            type="checkbox"
                                            class="form-check-input rounded"
                                            name="remember"
                                            style="border-radius: 4px;">
                                        <label class="form-check-label ms-2 small" for="remember_me">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-6 text-end">
                                    @if (Route::has('password.request'))
                                        <a class="text-decoration-none small" href="{{ route('password.request') }}">
                                            Forgot password?
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <!-- Why btn-lg? Larger text (1rem) makes CTA more prominent -->
                            <!-- Why w-100? Full width is easier to tap on mobile -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary btn-lg w-100 rounded-2 shadow-sm fw-semibold">
                                    Sign In
                                </button>
                            </div>
                        </form>

                        <!-- Divider with "or" text -->
                        <div class="text-center position-relative my-4">
                            <hr class="text-muted opacity-25">
                            <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 small text-muted">or</span>
                        </div>

                        <!-- Register Link -->
                        <!-- Why? Separate section to avoid confusion with login -->
                        <div class="text-center">
                            <p class="text-muted small mb-3">
                                Don't have an account?
                            </p>
                            <a href="{{ route('register') }}" class="btn btn-outline-primary w-100 rounded-2 fw-medium">
                                <i data-lucide="user-plus" class="me-2" style="width: 18px; height: 18px;"></i>
                                Create Account
                            </a>
                            <p class="text-muted small mt-3 mb-0">
                                Register as Patient, Hospital, or Admin
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Footer text -->
                <div class="text-center mt-4">
                    <p class="text-muted small opacity-75">
                        © 2024 COVID Booking System. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Why no guest-layout wrapper content? The <x-guest-layout> is still used for Laravel inertia, but we're overriding the full content with our floating card design -->
</x-guest-layout>
