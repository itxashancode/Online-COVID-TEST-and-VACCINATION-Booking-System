{{-- Premium Register Page: Glassmorphism + Dynamic Aesthetic --}}
<x-guest-layout>
    <style>
        /* RESET & BASE */
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 24px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .header-gradient {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%); /* Emerald for Register */
            padding: 40px 20px;
            text-align: center;
            color: white;
        }
        .input-group-custom {
            margin-bottom: 20px;
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
            border-color: #10b981;
            background: white;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }
        .btn-submit {
            background: #10b981;
            color: white;
            padding: 14px;
            border-radius: 12px;
            border: none;
            width: 100%;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);
        }
        .btn-submit:hover {
            background: #059669;
            transform: translateY(-2px);
        }
        .text-label {
            display: block;
            font-weight: 600;
            font-size: 0.875rem;
            color: #475569;
            margin-bottom: 6px;
        }
        .hidden { display: none; }
        .divider {
            height: 1px;
            background: #e2e8f0;
            width: 100%;
            margin: 24px 0;
        }
        .error-text {
            margin-top: 6px;
            color: #ef4444;
            font-size: 0.75rem;
            display: block;
        }
    </style>

    <div class="glass-card mx-auto" style="max-width: 700px; margin-bottom: 40px;">
        <!-- HEADER -->
        <div class="header-gradient">
            <i data-lucide="user-plus" style="width: 56px; height: 56px; margin: 0 auto 16px auto; display: block;"></i>
            <h2 style="font-size: 1.75rem; font-weight: 800; margin: 0;">Create Account</h2>
            <p style="color: rgba(255, 255, 255, 0.8); margin: 8px 0 0; font-size: 0.9rem;">Join the MED-Digi health network</p>
        </div>

        <!-- FORM BODY -->
        <div style="padding: 40px;">
            <form method="POST" action="{{ route('register') }}" x-data="{ submitting: false }" @submit="submitting = true">
                @csrf

                <!-- Full Name -->
                <div class="input-group-custom">
                    <label class="text-label">Full Name</label>
                    <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe" />
                    <x-input-error :messages="$errors->get('name')" class="error-text" />
                </div>

                <!-- Email Address -->
                <div class="input-group-custom">
                    <label class="text-label">Email Address</label>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required placeholder="name@example.com" />
                    <x-input-error :messages="$errors->get('email')" class="error-text" />
                </div>

                <!-- Role Selection -->
                <div class="input-group-custom">
                    <label class="text-label">Register As</label>
                    <select name="role" id="role" class="form-select" required>
                        <option value="">-- Select Membership Type --</option>
                        <option value="patient" {{ old('role') == 'patient' ? 'selected' : '' }}>Patient (Book Test/Vaccine)</option>
                        <option value="hospital" {{ old('role') == 'hospital' ? 'selected' : '' }}>Hospital (Provider Access)</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="error-text" />
                    <p style="font-size: 0.7rem; color: #94a3b8; margin-top: 6px;">* Hospitals require admin verification.</p>
                </div>

                <!-- Additional Fields for Hospital -->
                <div id="hospitalFields" class="hidden" style="background: #f1f5f9; padding: 20px; border-radius: 16px; margin-bottom: 20px;">
                    <div class="input-group-custom">
                        <label class="text-label">Hospital Name</label>
                        <input id="hospital_name" class="form-input" type="text" name="hospital_name" value="{{ old('hospital_name') }}" placeholder="City General Hospital" />
                        <x-input-error :messages="$errors->get('hospital_name')" class="error-text" />
                    </div>

                    <div class="input-group-custom">
                        <label class="text-label">Phone Number</label>
                        <input id="phone" class="form-input" type="text" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 000-0000" />
                        <x-input-error :messages="$errors->get('phone')" class="error-text" />
                    </div>

                    <div class="input-group-custom">
                        <label class="text-label">City</label>
                        <input id="city" class="form-input" type="text" name="city" value="{{ old('city') }}" placeholder="New York" />
                        <x-input-error :messages="$errors->get('city')" class="error-text" />
                    </div>

                    <div class="input-group-custom" style="margin-bottom: 0;">
                        <label class="text-label">Physical Address</label>
                        <textarea id="address" name="address" rows="2" class="form-input" style="height: auto;" placeholder="123 Health St...">{{ old('address') }}</textarea>
                        <x-input-error :messages="$errors->get('address')" class="error-text" />
                    </div>
                </div>

                <div class="row" style="display: flex; gap: 15px;">
                    <!-- Password -->
                    <div class="input-group-custom" style="flex: 1;">
                        <label class="text-label">Password</label>
                        <div style="position: relative;">
                            <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" style="padding-right: 40px;" />
                            <button type="button" onclick="togglePassword('password', 'eye-reg')" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b; padding: 0;">
                                <i data-lucide="eye" id="eye-reg" style="width: 20px; height: 20px;"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="error-text" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="input-group-custom" style="flex: 1;">
                        <label class="text-label">Confirm</label>
                        <div style="position: relative;">
                            <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" style="padding-right: 40px;" />
                            <button type="button" onclick="togglePassword('password_confirmation', 'eye-conf')" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: #64748b; padding: 0;">
                                <i data-lucide="eye" id="eye-conf" style="width: 20px; height: 20px;"></i>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="error-text" />
                    </div>
                </div>

                <!-- SUBMIT -->
                <button type="submit" class="btn-submit" style="margin-top: 10px;" :disabled="submitting">
                    <span x-show="!submitting">Register Now</span>
                    <span x-show="submitting" style="display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                        <div class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="width: 16px; height: 16px;"></div>
                        Processing...
                    </span>
                </button>
            </form>

            <div class="divider"></div>

            <!-- FOOTER LINKS -->
            <div style="text-align: center;">
                <p style="color: #64748b; font-size: 0.875rem; margin: 0;">Already have an account? <a href="{{ route('login') }}" style="color: #10b981; font-weight: 700; text-decoration: none;">Log in</a></p>
            </div>
        </div>
    </div>

    <!-- JavaScript for showing/hiding hospital fields -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
            
            const roleSelect = document.getElementById('role');
            const hospitalFields = document.getElementById('hospitalFields');

            roleSelect.addEventListener('change', function() {
                if (this.value === 'hospital') {
                    hospitalFields.classList.remove('hidden');
                } else {
                    hospitalFields.classList.add('hidden');
                }
            });

            // Show hospital fields if old input is 'hospital' (after validation error)
            if (roleSelect.value === 'hospital') {
                hospitalFields.classList.remove('hidden');
            }
        });

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
