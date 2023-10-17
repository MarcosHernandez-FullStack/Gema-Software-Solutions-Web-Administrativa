<div>
	<div class="login-screen">
		<div class="app-title">
			<h1>Login</h1>
		</div>

		<div class="login-form">
			<div class="control-group">
			<input type="text" class="login-field"  placeholder="username" id="login-name" wire:model="email">
			<label class="login-field-icon fui-user" for="login-name"></label>
			@error('email')
			<span class="text-danger">{{ $message }}</span>
			@enderror
			</div>

			<div class="control-group">
			<input type="password" class="login-field" placeholder="password" id="login-pass" wire:model="password">
			<label class="login-field-icon fui-lock" for="login-pass"></label>
			@error('password')
			<span class="text-danger">{{ $message }}</span>
			@enderror
			</div>

			<button type="submit" class="btn btn-primary" wire:click="login()">Iniciar Sesion</button>
			<a class="login-link" href="#">Lost your password?</a>
		</div>
	</div>
</div>