<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOODMOVIES</title>
    <link rel="stylesheet" href="../../public/css/styles_compra.css">
    <link rel="stylesheet" href="../../public/css/styles_compra_responsive.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://www.paypal.com/sdk/js?client-id=AWmsv5MfSca25jfYdO5HYVwWnu3SP1MgbUPsI5l7PIVmqkpVEYzJZNZh07iSZYY7Oa2eKJv9JJtAR1rh&currency=USD"></script>
    <link rel="icon" href="../../public/img/logo/logoGM.png" type="image/x-icon">

</head>


<body>


    <canvas id="galaxyCanvas"></canvas>

    <header class="header">
        <a href="../../../index.php" style="--i:2;"><img class="logo" src="../../public/img/logo/logo.png" alt=""> </a>
        <input type="checkbox" name="" id="check">
        <label for="check" class="icons">
        </label>
        <nav class="navbar">
        </nav>
    </header>

    <!-- <marquee behavior="" direction="right"><img src="" alt="">HOLA</marquee> -->

    <div class="cont">

        <div class="con-inf">
            <img src="../../public/img/logo/logo.png" alt="">

            <div class="cont-txtt one">
                <h1>GOOD PLAN</h1>
            </div>

            <div class="cont-txt">
                <span>- Hasta 4 dispositivos en vista simultánea</span>
            </div>

            <div class="cont-txt">
                <span>- Hasta 4 perfiles personalizables</span>
            </div>

            <div class="cont-txt">
                <span>- Resolucion 1440p - 2160p</span>
            </div>

            <div class="cont-txt">
                <span>- Descargar peliculas en 4K</span>
            </div>

            <div>
                <a href="../models/procesar_compra.php"><button class="realizar">Realizar compra</button></a>
            </div>

            <div>
                <a href="../../../index.php"><button class="auno">Aun no quiero realizar la compra</button></a>
            </div>

        </div>
    </div>

    <script src="../../public/js/starsAnimation.js"></script>


    <!-- <div class="boton-paypal" id="paypal-button-container"> -->
        <!-- <script>
            paypal.Buttons({
                style:{
                    color: 'blue',
                    shape: 'pill',
                    label: 'pay',
                    layout: 'vertical'
                },
                createOrder: function(data, actions){
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: 10
                            }
                        }]
                    });
                },

                onApprove: function(data, actions){
                    actions.order.capture().then(function (detalles){
                        window.location.href="../../../index.php"
                    });
                },

                onCancel: function(data){
                    alert("Pago cancelado");
                    console.log(data)
                }
            }).render('#paypal-button-container');
        </script> -->
</body>

</html>