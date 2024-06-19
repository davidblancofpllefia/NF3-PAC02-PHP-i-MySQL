<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'moviesite') or die(mysqli_error($db));

$recordsPerPage = 4; 
$page = 1;
if (isset($_GET['pagina'])) $page = $_GET['pagina']; 
$searchQuery = isset($_GET['searchs']) ? $_GET['searchs'] : ''; 

$start = ($page - 1) * $recordsPerPage;
$query = "SELECT m.movie_name, d.people_fullname AS director_name, a.people_fullname AS actor_name
          FROM movie m
          JOIN people d ON m.movie_director = d.people_id
          JOIN people a ON m.movie_leadactor = a.people_id
          WHERE m.movie_name LIKE '%$searchQuery%'
          LIMIT $start, $recordsPerPage";

$result = mysqli_query($db, $query) or die(mysqli_error($db));

echo "<table>";
while ($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td height=80 align=center>";
    echo $row['movie_name'] . "<br>";
    echo "</td>";
    echo "<td align=center>{$row['director_name']}</td>";
    echo "<td align=center>{$row['actor_name']}</td>";
    echo "</tr>";
}

$countQuery = "SELECT count(*) FROM movie WHERE movie_name LIKE '%$searchQuery%'";
$countResult = mysqli_query($db, $countQuery);
$countRow = mysqli_fetch_array($countResult);
$totalRecords = $countRow[0]; 
$totalPages = ceil($totalRecords / $recordsPerPage);
?>
<tr>
    <td colspan="3" align="center"><?php echo "<strong>Total records: </strong>" . $totalRecords; ?></td>
    <td colspan="2" align="center"><?php echo "<strong>Page: </strong>" . $page; ?></td>
</tr>
<tr bgcolor="f3f4f1">
    <td colspan="4" align="right"><strong>Page:
        <?php
        for ($i = 1; $i <= $totalPages; $i++) { 
            if ($i == $page)
                echo "<font color='red'>$i </font>"; 
            else
                echo "<a href=\"?pagina=" . $i . "&searchs=" . urlencode($searchQuery) . "\" style='color:#000;'> " . $i . "</a>";
        }
        ?>
        </strong></td>
</tr>
</table>

