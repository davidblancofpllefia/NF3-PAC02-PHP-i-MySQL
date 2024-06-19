<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));

$query = "INSERT INTO movie (movie_name, movie_type, movie_year, movie_leadactor, movie_director) 
          VALUES
          ('El Padrino', 1, 1972, 1, 2),
          ('Star Wars', 2, 1977, 3, 4),
          ('Titanic', 3, 1997, 5, 6)";
mysqli_query($db, $query) or die(mysqli_error($db));

$query = "INSERT INTO movietype (movietype_label) 
          VALUES
          ('Drama'),
          ('Ciencia Ficción'),
          ('Romance')";
mysqli_query($db, $query) or die(mysqli_error($db));

$query = "INSERT INTO people (people_fullname, people_isactor, people_isdirector) 
          VALUES
          ('Marlon Brando', 1, 0),
          ('Harrison Ford', 1, 0),
          ('Leonardo DiCaprio', 1, 0),
          ('Francis Ford Coppola', 0, 1),
          ('George Lucas', 0, 1),
          ('James Cameron', 0, 1)";
mysqli_query($db, $query) or die(mysqli_error($db));

echo 'datos insertados';
?>