<?php
	session_start();
	include_once 'include/dbinfo.php';
	$dbh = new PDO("mysql:host=$servername;dbname=$dbname; charset=utf8mb4", $dbuser, $dbpassword);
?>
<!doctype html>
<html lang="se">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Jörgens Kärleksäventyr - Redigera</title>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link href="https://fonts.googleapis.com/css?family=Merriweather%7CMerriweather+Sans" rel="stylesheet">
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
				<a class="nav-link" href="play.php">Spela</a>	
			</li>			
			<li class="nav-item">
				<a class="nav-link active" href="edit.php">Redigera</a>	
			</li>			
		</ul>
		
		</div>
		
		<a class="navbar-brand"><img src="JorgensKarleksaventyr.png" alt=""></a>
		
	</nav>
<main class="content">
		<div class="containter">
			<div class="row">
				<div class="col-1">
				</div>				
				<div class="col-10">
				<h1>Redigera</h1>
				</div>
				<div class="col-1">
				</div>
			</div>
			<div class="row">
				<div class="col-1">
				</div>
			<div class="col-10">
			<table>
			<tr>
				<th>ID</th>
				<th>Text</th>
				<th>Place</th>
				<th></th>
			</tr>
<?php
// TODO protect with your login
// add, edit, delete pages & events
// skriv ut en lista över sidor

	if(isset($_GET['delete'])) {
		$filteredId = filter_input(INPUT_GET, "delete", FILTER_VALIDATE_INT);
		$stmt = $dbh->prepare("DELETE FROM story WHERE id = :id");
		$stmt->bindParam(':id', $filteredId);
		$stmt->execute(); //Kör "Delete"
		echo "deleted id: " . $filteredId;
		echo "<meta http-equiv=refresh content=\"0; URL=edit.php\">";
	}

	$stmt = $dbh->prepare("SELECT * FROM story");
	$stmt->execute();
	$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

	foreach ($row as $value) {
		echo "<tr>";
		echo "<td>" . $value['id'] . "</td>";
		echo "<td>" . substr($value['text'], 0, 42) . "...</td>"; // substr pajjar teckenkodning?
		echo "<td>" . $value['place'] . "</td>";
		echo "<td><a href=\"edit.php?edit=" . $value['id'] . "\"><i class=\"material-icons\">edit</i></a>";
		echo "<a href=\"edit.php?delete=" . $value['id'] . "\"><i class=\"material-icons\">delete_forever</i></a></td>";
		echo "</tr>";
	}	
?>
				</table>
			</div>
			<div class="col-1">
			</div>
		</div>
	
	<div class="row">
		<div class="col-1">
		</div>
		<div class="col-10">
			<form action="edit.php" method="post">
				<div class="form-group">
					<label for="textarea">Story</label>
				</div>
				<div class="form-group">	
					<textarea name="text" id="textarea" rows="5" cols="50">
<?php
	if(isset($_GET['edit'])) {
		$filteredId = filter_input(INPUT_GET, "edit", FILTER_VALIDATE_INT);
		$stmt = $dbh->prepare("SELECT * FROM story WHERE id = :id");
		$stmt->bindParam(':id', $filteredId);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		echo $row['text'];

	}
	echo "</textarea>";
	echo "</div>";
	echo "<label for=\"place\">Place</label>";
	if(isset($_GET['edit'])) {
		echo "<div class=\"form-group\">";
			echo "<input type=\"text\" name=\"place\" id=\"place\" value=\"" . $row['place'] . "\">";
		echo "</div>";
		echo "<div class=\"form-group\">";
			echo "<input type=\"hidden\" name=\"id\" id=\"id\" value=\"" . $row['id'] . "\">";
		echo "</div>";
		echo "<div class=\"form-group\">";
			echo "<button type=\"submit\" name=\"update\" id=\"insert\">Uppdatera</button>";
		echo "</div>";

			
	}
	else {
		echo "<div class=\"form-group\">";
			echo "<input type=\"text\" name=\"place\" id=\"place\">";
		echo "</div>";
		echo "<div class=\"form-group\">";
			echo "<input type=\"submit\" name=\"insert\" id=\"insert\" value=\"Lägg till\">";
		echo "</div>";
	}

	echo "</form>";
	echo "</div>";
	echo "</div>";
	echo "</div>";


	if (isset($_POST['insert'])) {
		$filteredText = filter_input(INPUT_POST, "text", FILTER_SANITIZE_SPECIAL_CHARS);	
		$filteredPlace = filter_input(INPUT_POST, "place", FILTER_SANITIZE_SPECIAL_CHARS);

		$stmt = $dbh->prepare("INSERT INTO story (text, place) VALUES (:text, :place)");
		$stmt->bindParam(':text', $filteredText);
		$stmt->bindParam(':place', $filteredPlace);
		$stmt->execute(); //Kör "add"

		echo "<meta http-equiv=refresh content=\"0; URL=edit.php\">";

	}	elseif(isset($_POST['update'])) {
			$filteredText= filter_input(INPUT_POST, "text", FILTER_SANITIZE_SPECIAL_CHARS);
			$filteredPlace = filter_input(INPUT_POST, "place", FILTER_SANITIZE_SPECIAL_CHARS);
			$filteredId = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
			$stmt = $dbh->prepare("UPDATE story SET text = :text, place = :place WHERE id = :id");
			$stmt->bindParam(':text', $filteredText);
			$stmt->bindParam(':place', $filteredPlace);
			$stmt->bindParam(':id', $filteredId);
			$stmt->execute();
			echo "<meta http-equiv=refresh content=\"0; URL=edit.php\">";
	}
?>
</main>
</body>
</html>