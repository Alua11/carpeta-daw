<?php

$array = [1,3,4,533];

?>

<form action="recoge_array1.php" method="post">
<?php

foreach ($array as $i => $value) {
    echo "<input type='hidden' id='dato_$i' name='dato_$i' value='$value'>";
}

?>
<input type="submit" value="Enviar Array">
</form>