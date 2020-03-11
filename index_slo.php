<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Preveri UMCN</title>
</head>
<body>
<form action="" method="POST">
        <label for="UMCN">UMCN:</label><input name="UMCN" type="text" maxlength="13" minlength="12" value='<?php if(isset($_POST['UMCN'])) echo $_POST['UMCN'];?>' required>
        <input type="submit" value="Preveri!">
    </form>
    <p>
        <?php
if(isset($_POST['UMCN']))
{
    $UMCN_vpis=$_POST['UMCN'];
    $ok=true;
}
else{
    $ok=false;
}

if($ok)
{
    $c = curl_init("https://www.dev.nikigre.si/UMCN/api.php?UMCN=" . $UMCN_vpis);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);

    $html = curl_exec($c);

    if (curl_error($c))
        die(curl_error($c));

    // Get the status code
    $status = curl_getinfo($c, CURLINFO_HTTP_CODE);

    curl_close($c);
	
    echo "<pre>" . $html . "</pre>";
    
    $json= json_decode($html, true);


    if ($json[0]['Valid'] == "True") {
        echo "<p style='color:green'>Vpisan UMCN je veljaven in pravilen!</p>";
    }else if($json[0]['ErrorNumber'] == "0") {
        echo "<p style='color:red'>Vpisan UMCN ni veljaven, saj datum rojstva in kontrolna vsota nista pravilna!</p>";
    }else if($json[0]['ErrorNumber'] == "1") {
        echo "<p style='color:red'>Vpisan UMCN je veljaven, vendar datum ni pravilen!</p>";
    }else if($json[0]['ErrorNumber'] == "2") {
        echo "<p style='color:red'>Kontrolna vsota UMCN ni pravilna!</p>";   
    }else if($json[0]['ErrorNumber'] == "3") {
        echo "<p style='color:red'>Datum rojstva ni pravilen!</p>";
    }else{
        echo "<p style='color:red'>Napaka pri preverjanju številke UMCN.</p>";   
    }
}
?>
</body>
</html>