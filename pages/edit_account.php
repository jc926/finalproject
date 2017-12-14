put a page with in a form to edit an account

<!doctype html>

<html lang='en'>
<head>
    <meta charset='utf-8'>
    <title>Task system</title>
    <meta name='description' content='Sql Active Record'>
    <meta name='author' content='Kan'>
    <link rel='stylesheet' href='css/styles.css?v=1.0'>
</head>
<body>
<form action="index.php" method="post" enctype="multipart/form-data">

    <p>Create account:<?php foreach ($data as $key => $value) echo $value . "<br>";?></p>

    <input type="submit" value="Save Setting" name="submit">
    <input type="hidden" name="page" value="accounts">
    <input type="hidden" name="action" value="save">
    <input type="reset">
</form>

</body>
</html>
