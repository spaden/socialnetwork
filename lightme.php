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
        body {
            background-color: #7697BA;
        }
        
        .tos {
            margin-top: 9em;
        }
        
        .top {
            margin-top: 6em;
        }
        
        .top1 {
            margin-top: 3em;
        }
        .dont {
            display: none;
        }
    </style>
</head>

<body>

    <?php
        if(isset($_REQUEST["usname"])){
            $reff=$_REQUEST["usname"];
         echo "<p class='dont' id='hideme'>$reff</p>";
        }else {
         echo "<p class='dont' id='hideme'>noreff</p>";
        }
 
     ?>
        <div class="container">
            <div class="row tos">
                <span class="col-md-1 col-lg-1 col-xl-1"></span>
                <div class="card col-md-10 col-lg-10 col-xl-10 col-sm-10 col-xs-10">
                    <div class="card-body">
                        <h5><i>Say what you think about me, don't hesitate. It's completely annonymous</i></h5>
                    </div>
                </div>
            </div>
            <div class="row top">
                <span class="col-md-1 col-lg-1 col-xl-1"></span>
                <div class="form-group col-md-10 col-lg-10 col-xl-10 col-sm-10 col-xs-10">
                    <label for="comment" style="color: #641E16;">It's gonna be between you and god, no one else is gonna no about this:</label>
                    <hr>
                    <textarea placeholder="type your thoughts in here" class="form-control" rows="8" id="smsg"></textarea>
                </div>
            </div>
            <div class="row top1">
                <span class="col-md-2 col-lg-2 col-xl-2"></span>
                <button class="btn btn-dark col-md-8 col-lg-8 col-xl-8 col-sm-8 col-xs-8" id="psthg">Post this!</button>
                <span class="col-md-2 col-lg-2 col-xl-2"></span>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/umd/popper.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/js/bootstrap.min.js"></script>
        <script>
            window.onload = function() {
                document.getElementById("psthg").onclick = function() {
                    //alert(document.getElementById("smsg").value);
                    flagme();
                };
            };

            function flagme() {
                var xmlhttp = new XMLHttpRequest();
                var msg = document.getElementById("smsg").value;
                var usuqnm = document.getElementById("hideme").innerHTML;
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        alert(this.responseText);
                    }
                };
                xmlhttp.open("GET", "puresp.php?mesg=" + msg + "&usuqnm=" + usuqnm, true);
                xmlhttp.send();
            }
        </script>
</body>

</html>