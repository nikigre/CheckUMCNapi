<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Check UMCN</title>
</head>
<body>
<form action="" method="POST">
        <label for="EMSO">UMCN:</label><input name="EMSO" type="text" maxlength="13" minlength="12" value='<?php if(isset($_POST['EMSO'])) echo $_POST['EMSO'];?>' required>
        <input type="submit" value="Check!">
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
        echo "<p style='color:green'>Entered UMCN is valid and correct!</p>";
    }else if($json['ErrorNumber'] == "0") {
        echo "<p style='color:red'>Date of birth and checksum is not correct!</p>";
    }else if($json['ErrorNumber'] == "1") {
        echo "<p style='color:red'>Date of birth is not correct.</p>";
    }else if($json['ErrorNumber'] == "2") {
        echo "<p style='color:red'>Checksum is not correct.</p>";   
    }else if($json['ErrorNumber'] == "3") {
        echo "<p style='color:red'>Date of birth is not correct.</p>";
    }else{
        echo "<p style='color:red'>Error while checking UMCN!</p>";   
    }
}
?>
</body>
</html>