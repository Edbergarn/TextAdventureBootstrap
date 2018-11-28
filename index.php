<?php
	session_start();
?>
<!doctype html>
<html lang="se">
<head>
	<title>Jörgens Kärleksäventyr</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  

	<link href="https://fonts.googleapis.com/css?family=Merriweather%7CMerriweather+Sans" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
		<button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="collapse_target">
			

		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link active" href="index.php">Hem</a>	
			</li>
			<li class="nav-item">
				<a class="nav-link" href="play.php">Spela</a>	
			</li>			
			<li class="nav-item">
				<a class="nav-link" href="edit.php">Redigera</a>	
			</li>			
		</ul>
		
		</div>
		
		<a class="navbar-brand"><img src="JorgensKarleksaventyr.png" alt="placeholder"></a>
		
	</nav>	
<main class="content">
	
		<div class="container">
			<div class="row">
				<div class="col-3">
				</div>
				<div class="col-6">
					<img class="img-fluid" src="JorgensKarleksaventyrBig.png" alt="">
					<p>Häng med Jörgen på hans resa genom kärlekens alla problem.</p>
				</div>
			</div>
		</div>

</main>
<script src="js/navbar.js"></script>
</body>
</html>