{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

@section('title') {{'Forgot Password'}}@endsection
<x-guest-layout>
    <!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="/">Home<i class="ti-arrow-right"></i></a></li>
                                <li><a href="{{route('login')}}">Login<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="#">Forgot Password</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->

		<!-- Shop forgot password -->
		<section class="shop login section">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 offset-lg-3 col-12" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 15px;">
						<div class="login-form" style="padding: 25px 10px; 25px 10px">
							<h3>Forgot Password</h3>
							<!-- Form -->
                            @if (session('status'))
                                <div class="mb-4 font-medium text-sm text-green-600" style="color: rgb(0, 231, 12);">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <x-jet-validation-errors class="mb-4" />
							<form class="form" method="POST" action="{{route('password.email')}}">
                                @csrf
								<div class="row">
									<div class="col-12">
										<div class="form-group">
											<label>Email Address:</label>
											<input type="email" name="email" placeholder="Type your email address" :value="old('email')" required autofocus>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group login-btn">
											<button class="btn" type="submit" value="Email Password Reset Link">Get Email Password Reset Link</button>
										</div>
									</div>
								</div>
							</form>
							<!--/ End Form -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End forgot password -->
</x-guest-layout>
