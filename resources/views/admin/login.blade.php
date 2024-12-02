<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Admin Login</title>
	@include("includes.head")
</head>

<body>
	<main>
		<div class="grid min-h-screen grid-cols-2">
			<div class="flex h-full items-center justify-center bg-cyan-800 text-white">
				<img src="/images/logo-white.png" alt="Logo">
			</div>
			<div class="flex flex-col justify-center bg-white p-5">
				@auth("admin")
					<h1 class="mb-5 text-center font-display text-5xl font-bold">Auth</h1>
				@endauth
				@guest("admin")
					<h1 class="mb-5 text-center font-display text-5xl font-bold">Guest</h1>
				@endguest
				<form action="{{ route("admin.index") }}" method="POST">
					@csrf
					<div class="mb-5">
						<label class="block py-1 text-sm" for="email">Email</label>
						<input class="block h-12 w-full rounded border-0 bg-gray-200 transition-background focus:bg-gray-100 focus:outline-none focus:ring-0" id="email" name="email" type="text" placeholder="Enter email here...">
					</div>
					<div class="mb-5">
						<label class="block py-1 text-sm" for="password">Password</label>
						<input class="block h-12 w-full rounded border-0 bg-gray-200 transition-background focus:bg-gray-100 focus:outline-none focus:ring-0" id="password" name="password" type="password" placeholder="********">
					</div>
					<div class="mb-5 flex">
						<label class="block select-none py-1 text-sm" for="remember"><input class="focus:outline-none focus:ring-0" id="remember" name="remember" type="checkbox"> Remember Me?</label>
					</div>
					<div>
						<button class="block h-12 w-full rounded bg-cyan-600 font-bold text-white transition-all hover:bg-cyan-500">Login</button>
					</div>
				</form>
			</div>
		</div>
	</main>
</body>

</html>
