<?php
	session_start();
?>
<!doctype html>
<html lang="se">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  
	<title>Soloäventyr - Spela</title>
	<link href="https://fonts.googleapis.com/css?family=Merriweather|Merriweather+Sans" rel="stylesheet">
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
				<a class="nav-link" href="index.php">Hem</a>	
			</li>
			<li class="nav-item">
				<a class="nav-link active" href="play.php?page=7">Spela</a>	
			</li>			
			<li class="nav-item">
				<a class="nav-link" href="edit.php">Redigera</a>	
			</li>			
		</ul>
		
		</div>
		
		<a class="navbar-brand"><img src="JorgensKarleksaventyr.png"></a>
		
	</nav>
<main class="content">
	<section>
		<h1>Spela</h1>

<?php
	include_once 'include/dbinfo.php';

	// PDO
	$dbh = new PDO('mysql:host=localhost;dbname=te16;charset=utf8mb4', $dbuser, $dbpassword);

	if (isset($_GET['page'])) {
		// TODO load requested page from DB using GET
		$filteredPage = filter_input(INPUT_GET, "page", FILTER_VALIDATE_INT);

		$stmt = $dbh->prepare("SELECT * FROM story WHERE id = :id");
		$stmt->bindParam(':id', $filteredPage);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		//echo "<pre>" . print_r($row,1) . "</pre>";

		echo "<p id=\"storyText\">" . $row['text'] . "</p>";

		$stmt = $dbh->prepare("SELECT * FROM storylinks WHERE storyid = :id");
		$stmt->bindParam(':id', $filteredPage);
		$stmt->execute();

		$row = $stmt->fetchAll(PDO::FETCH_ASSOC);	

		echo "<section class=\"alternativ\">";
		foreach ($row as $val) {
			echo "<a class=\"link\" href=\"?page=" . $val['target'] . "\">" . $val['text'] . "</a>";
		}

		echo "</section>";

	} elseif(isset($_SESSION['page'])) {
		// TODO load page from db
		// use for returning player / cookie
	} else {
		// TODO load start of story from DB
	}

?>
</section> 	
</main>
<script src="js/navbar.js"></script>
</body>
</html>