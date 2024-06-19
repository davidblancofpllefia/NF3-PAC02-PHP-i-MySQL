<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));

$query = "SELECT m.movie_name, d.people_fullname AS director_name, a.people_fullname AS actor_name
          FROM movie m
          JOIN people d ON m.movie_director = d.people_id
          JOIN people a ON m.movie_leadactor = a.people_id";

$result = mysqli_query($db, $query) or die(mysqli_error($db));

echo '<h2>Películas y sus Directores y Protagonistas</h2>';
echo '<table border="1">';
echo '<tr><th>Película</th><th>Director</th><th>Protagonista</th></tr>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['movie_name'] . '</td>';
    echo '<td>' . $row['director_name'] . '</td>';
    echo '<td>' . $row['actor_name'] . '</td>';
    echo '</tr>';
}

echo '</table>';