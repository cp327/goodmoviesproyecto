
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOODMOVIES</title>
    <link rel="icon" href="../../public/img/logo/logoGM.png" type="image/x-icon">
    <link rel="stylesheet" href="../../public/css/template.css">
    <link rel="stylesheet" href="../../public/libs/line-awesome/css/line-awesome.css">
</head>
<body>
    <input type="checkbox" id="menu-toggle">
    <div class="sidebar">
        <div class="side-header">
            <h3>M<span>enú</span></h3>
        </div>
        
        <div class="side-content">
            <div class="profile">
                <div class="profile-img bg-img" style="background-image: url(../../public/img/logo/logoGM.png)"></div>
                <h4><?php echo $_SESSION['correo'] ?></h4>
                <small>Administrador</small>
            </div>

            <div class="side-menu">
                <ul>
                <li>
                        <a href="home.php" class="">
                            <span class="las la-home"></span>
                            <small>Hogar</small>
                        </a>
                    </li>

                    <li>
                        <a href="empleados.php" class="">
                            <span class="las la-users-cog"></span>
                            <small>Empleados</small>
                        </a>
                    </li>

                    <li>
                        <a href="peliculas.php" class="">
                            <span class="las la-video"></span>
                            <small>Peliculas</small>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="main-content">
        <header>
            <div class="header-content">
                <label for="menu-toggle">
                    <span class="las la-bars"></span>
                </label>

                <div class="header-menu">

                    <div class="user">
                        <span class="las la-power-off"></span>
                        <span><a href="../../auth/models/verificacion.php?salir=1">Salir</a></span>
                    </div>
                </div>
            </div>
        </header>

        <main>
            
        </main>
        
    </div>

    <script>
        // Función para agregar la clase "active" al enlace correspondiente
        function setActiveLink() {
            // Obtiene la URL actual
            var currentUrl = window.location.href;

            // Obtiene todos los enlaces <a> en el menú
            var links = document.querySelectorAll('.side-menu a');

            // Itera sobre cada enlace y verifica si la URL coincide
            links.forEach(function(link) {
                var linkUrl = link.href;

                // Compara la URL actual con la URL del enlace
                if (currentUrl === linkUrl) {
                    link.classList.add('active'); // Agrega la clase "active"
                } else {
                    link.classList.remove('active'); // Elimina la clase "active" si no coincide
                }
            });
        }

        // Llama a la función al cargar la página
        window.onload = setActiveLink;
    </script>
    
</body>



</html>