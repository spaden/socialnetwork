<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <link rel="stylesheet" href="style.css">
    <title>Title</title>
   <style> 
     .dont {
         display: none;
     }
   </style>
</head>


<body>
    <?php 
    $cookie_name = "sename";
    $reff=$_COOKIE[$cookie_name];

    echo "<p class='dont' id='hideme'>$reff</p>";
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/js/bootstrap.min.js"></script>
    <script>
        window.onload = function() {
            alert("Group name"+ document.getElementById("hideme").innerText);
            localStorage.setItem("grpname", document.getElementById("hideme").innerText);
            window.location.href = "frp.html";
        };
    </script>
</body>

</html>