{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

@section('title') {{'Login'}}@endsection
<x-guest-layout>
    <!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="{{route('login')}}">Login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->

		<!-- Shop Login -->
		<section class="shop login section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-12" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 15px;">
                        <div align="center">
                            <a href="/">
                                <img src="{{asset('assets/images/favicon.png')}}" style="width: 220px; padding-top: 25px;" alt="VITZARD Computer Group">
                            </a>
                        </div>
						<div class="login-form" style="padding: 25px 10px; 25px 10px">
							<h2>Login</h2>
							<p>กรุณาเข้าสู่ระบบเพื่อซื้อสินค้าในเว็บไซต์</p>
							<!-- Form -->
                            <x-jet-validation-errors class="mb-4" />
							<form class="form" method="POST" action="{{route('login')}}">
                                @csrf
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label>Your Email<span>*</span></label>
											<input type="email" name="email" placeholder="Type your email address" :value="old('email')" required autofocus>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<label>Your Password<span>*</span></label>
											<input id="password-field" class="tpwd" type="password" name="password" placeholder="Password" required autocomplete="current-password">
                                            <div class="checkbox">
                                                <label class="checkbox-inline"><input type="checkbox" onclick="togglePass()">Show Password</label>
                                            </div>
                                        </div>
									</div>
									<div class="col-12">
										<div class="form-group login-btn">
											<button class="btn" type="submit" value="Login">Login</button>
											<a href="{{Route('register')}}" class="btn">Don't have an account yet? Register</a>
										</div>
										<div class="checkbox">
											<label class="checkbox-inline" for="2"><input name="remember" id="2" value="forever" type="checkbox">Remember me</label>
										</div>
										<a href="{{ route('password.request')}}" class="lost-pass">Fogot your password?</a>
									</div>
								</div>
							</form>
							<!--/ End Form -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Login -->
</x-guest-layout>
