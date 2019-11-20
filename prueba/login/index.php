<?php
	session_start();
	session_destroy();
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login</title>

<link rel="stylesheet" type="text/css" href="../estilo/estilos.css"/>

<style>

body{background:#0B0B61 ;}

html,body{

    position: relative;

    height: 100%;

}



.login-container{

    position: relative;

    width: 300px;

    margin: 80px auto;

    padding: 20px 40px 40px;

    text-align: center;

    background: #0B0B61;

    border: 1px solid #ccc;

}



#output{

    position: absolute;

    width: 300px;

    top: -75px;

    left: 0;

    color: #FFF;

}



#output.alert-success{

    background: rgb(25, 204, 25);

}



#output.alert-danger{

    background: rgb(228, 105, 105);

}





.login-container::before,.login-container::after{

    content: "";

    position: absolute;

    width: 100%;height: 100%;

    top: 3.5px;left: 0;

    background: #CFCFF9;

    z-index: -1;

    -webkit-transform: rotateZ(4deg);

    -moz-transform: rotateZ(4deg);

    -ms-transform: rotateZ(4deg);

    border: 1px solid #ccc;



}



.login-container::after{

    top: 5px;

    z-index: -2;

    -webkit-transform: rotateZ(-2deg);

     -moz-transform: rotateZ(-2deg);

      -ms-transform: rotateZ(-2deg);



}



.avatar{

    width: 100px;height: 100px;

    margin: 10px auto 30px;

    border-radius: 100%;

    border: 2px solid #aaa;

    background-size: cover;

}



.form-box input{

    width: 100%;

    padding: 10px;

    text-align: center;

    height:40px;

    border: 1px solid #ccc;;

    background: #FFFFFF;

    transition:0.2s ease-in-out;



}



.form-box input:focus{

    outline: 0;

    background: #CFCFF9;

}



.form-box input[type="text"]{

    border-radius: 5px 5px 0 0;

    text-transform: lowercase;

}



.form-box input[type="password"]{

    border-radius: 0 0 5px 5px;

    border-top: 0;

}



.form-box button.login{

    margin-top:15px;

    padding: 10px 20px;

}



.animated {

  -webkit-animation-duration: 1s;

  animation-duration: 1s;

  -webkit-animation-fill-mode: both;

  animation-fill-mode: both;

}



@-webkit-keyframes fadeInUp {

  0% {

    opacity: 0;

    -webkit-transform: translateY(20px);

    transform: translateY(20px);

  }



  100% {

    opacity: 1;

    -webkit-transform: translateY(0);

    transform: translateY(0);

  }

}



@keyframes fadeInUp {

  0% {

    opacity: 0;

    -webkit-transform: translateY(20px);

    -ms-transform: translateY(20px);

    transform: translateY(20px);

  }



  100% {

    opacity: 1;

    -webkit-transform: translateY(0);

    -ms-transform: translateY(0);

    transform: translateY(0);

  }

}



.fadeInUp {

  -webkit-animation-name: fadeInUp;

  animation-name: fadeInUp;

}



</style>

<script>

$(function(){

var textfield = $("input[name=user]");

            $('button[type="submit"]').click(function(e) {

                e.preventDefault();

                if (textfield.val() != "") {

                    $("#output").addClass("alert alert-success animated fadeInUp").html("Selamün Aleyküm " + "<span style='text-transform:uppercase'>" + textfield.val() + "</span>");

                    $("#output").removeClass(' alert-danger');

                    $("input").css({

                    "height":"0",

                    "padding":"0",

                    "margin":"0",

                    "opacity":"0"

                    });

                    $('button[type="submit"]').html("Ileri")

                    .removeClass("btn-info")

                    .addClass("btn-default").click(function(){

                    $("input").css({

                    "height":"auto",

                    "padding":"10px",

                    "opacity":"1"

                    }).val("");

                    });

                    

                    $(".avatar").css({

                        "background-image": "url('http://i.hizliresim.com/0qW32V.png')"

                    });

                } else {

                    $("#output").removeClass(' alert alert-success');

                    $("#output").addClass("alert alert-danger animated fadeInUp").html("Haci Adini Yazmamissin ");

                }



            });

});

</script>

</head>

<body>

<div class="container">

	<div class="login-container">
      
        <div id="underline" style="background-color:#0B0B61" >

          <h1 class="underline">Login</h1>

          <p>
      
          </p>

         </div>         

          <div class="form-box">

                    <form action="validar.php" method="post" autocomplete="off" >

                        <input name="id" id="id" type="text" placeholder="Id" style="color:Navy ;">

                        <input type="password" name="clave" id="clave" placeholder="Password">

                        <button class="btn btn-info btn-block login" type="submit">Ingresar</button>

                  </form>

          </div>

  </div>

  
</div>

</body>

</html>

