<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/stylelogin.css">
	<!-- Agrega los enlaces de SweetAlert -->
	<!-- link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" -->
	<!-- script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<style>
		body {
			background: #40CFFF;
			background: linear-gradient(to right, #0000FF, #40CFFF);
		}

		.bg {
			background-image: url(photos/GoFastLogo.png);
			background-position: center center;
		}
	</style>
</head>

<body>

	<div class="container w-75 bg-primary mt-5 rounded shadow">
		<div class="row align-items-stretch">
			<div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">

			</div>
			<div class="col bg-white p-5 rounded-end">
				<div class="text-end">
				</div>

				<h2 class="fw-bold text-center py-5">Welcome</h2>

				<!--LOGIN-->

				<form action="logingofast.php" method="post">
					<div class="mb-4">
						<label for="email" class="form-label">Username</label>
						<input type="text" class="form-control" name="username">
					</div>
					<div class="mb-4">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" name="password">
					</div>
					<div class="mb-4 form-check">
						<input type="checkbox" name="connected" class="form-check-input">
						<label for="connected" class="form-check-label">Stay connected</label>
					</div>

					<div class="d-grid">
						<button type="submit" name="subs" value="Iniciar" class="btn btn-primary">Log In</button>
						<?php if (!empty($errores)) : ?>
							<div class="error">
								<ul>
									<?php echo $errores; ?>
								</ul>
							</div>
						<?php endif; ?>
					</div>

					<div class="my-3">
						<span>Don't have an account? <a href="registergofast.php">Register now</a></span>
						<span><a href="#"></a></span>
					</div>
				</form>

				<!--LOGIN-->

			</div>
		</div>
	</div>

	<script src="js/bootstrap.bundle.min.js.map"></script>
</body>

</html>