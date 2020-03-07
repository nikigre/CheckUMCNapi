<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Preveri EMŠO</title>
</head>
<body>
<form action="" method="POST">
        <label for="EMSO">EMŠO:</label><input name="EMSO" type="text" maxlength="13" minlength="12" value='<?php if(isset($_POST['EMSO'])) echo $_POST['EMSO'];?>' required>
        <input type="submit" value="Preveri!">
    </form>
    <p>
        <?php
if(isset($_POST['EMSO']))
{
    $EMSO_vpis=$_POST['EMSO'];
    $ok=true;
}
else{
    $ok=false;
}

if($ok)
{
    $c = curl_init("https://www.dev.nikigre.si/EMSO/api.php?emso=" . $EMSO_vpis);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

    $html = curl_exec($c);

    if (curl_error($c))
        die(curl_error($c));

    // Get the status code
    $status = curl_getinfo($c, CURLINFO_HTTP_CODE);

    curl_close($c);
	
    echo "<pre>" . $html . "</pre>";
    
    $json= json_decode($html, true);


    if ($json['Valid'] == "True") {
        echo "<p style='color:green'>Vpisan EMŠO je veljaven in pravilen!</p>";
    }else if($json['ErrorNumber'] == "0") {
        echo "<p style='color:red'>Vpisan EMŠO ni veljaven, saj datum rojstva in kontrolna vsota nista pravilna!</p>";
    }else if($json['ErrorNumber'] == "1") {
        echo "<p style='color:red'>Vpisan EMŠO je veljaven, vendar datum ni pravilen!</p>";
    }else if($json['ErrorNumber'] == "2") {
        echo "<p style='color:red'>Kontrolna vsota EMŠO ni pravilna!</p>";   
    }else if($json['ErrorNumber'] == "3") {
        echo "<p style='color:red'>Datum rojstva ni pravilen!</p>";
    }else{
        echo "<p style='color:red'>Napaka pri preverjanju številke EMŠO.</p>";   
    }
}
?>
</body>
</html>