<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/menu.css">
    <title>cecypape</title>
</head>
<body>
    <img class="gob" src="imagenes/gobierno.jpg" width="290px">
    <p class="anto">BIENVENIDO A:</p>
        <a href="login.php">
        <img title="(PRESIONE) CERRAR SECION" class="menu" src="imagenes/logcecy.jpg" onclick="<?php session_destroy();?>" width="70px">
        </a>
    <header class="cecypa">
        <img src="imagenes/principalverde.jpg" alt="imagen no encontrada" width="100%"></img>
    </header>
    <nav><b>
        <a href="Index.php" style="color: black;">Principal</a>
        <a href="Horario.php">Horario</a>
        <a href="Servicios.php">Servicios</a>
        <a href="Nosotros.php">Nosotros</a>
        <a href="Productos.php">Productos</a>
    </b></nav>
    <br>
    <br>
    <main>
        <center>
        <form action="" method="post">
            <div class="Material">
                <label for="busqueda">Material:</label>
                <input type="text" id="material" name="busquedamaterial" placeholder="Ingresa el nombre del material que requieres" required>
                <button class="rowm" type="text">Buscar</button>
            </div>
        </form>
    </center>
        <br>
        <div id=tablas>
        <section>
            <table border="4" id=tablas1>
                <center>
                <tr>
                    <td><img src="imagenes/plumas.jpg" alt="imagen no encontrada" width="220px"></img>Plumas<br>$20
                    <br><div class=botonimg>
                            <form action="Productos.php">
                                <button type="text">Más</button>
                            </form>
                        </div></td>
                    <td><img src="imagenes/gato.jpg" alt="imagen no encontrada"></img>producto2<br>$precio$
                    <br><div class=botonimg>
                            <form action="Productos.php">
                                <button type="text">Más</button>
                            </form>
                        </div></td>
                </tr>
                <tr>
                    <td><img src="imagenes/gato.jpg" alt="imagen no encontrada"></img>producto5<br>$precio$
                    <br><div class=botonimg>
                            <form action="Productos.php">
                                <button type="text">Más</button>
                            </form>
                        </div></td>
                    <td><img src="imagenes/gato.jpg" alt="imagen no encontrada"></img>producto6<br>$precio$
                    <br><div class=botonimg>
                            <form action="Productos.php">
                                <button type="text">Más</button>
                            </form>
                        </div></td>
                </tr>
            </center></table>
        </section>
        <aside>
            <table border="4" id=tablas2><center>
                <tr>
                    <td><img src="imagenes/gato.jpg" alt="imagen no encontrada"></img>producto3<br>$precio$
                    <br><div class=botonimg>
                            <form action="Productos.php">
                                <button type="text">Más</button>
                            </form>
                        </div></td>
                    <td><img src="imagenes/gato.jpg" alt="imagen no encontrada"></img>producto4<br>$precio$
                    <br><div class=botonimg>
                            <form action="Productos.php">
                                <button type="text">Más</button>
                            </form>
                        </div></td>
                </tr>
                <tr>
                    <td><img src="imagenes/gato.jpg" alt="imagen no encontrada"></img>producto7<br>$precio$
                    <br><div class=botonimg>
                            <form action="Productos.php">
                                <button type="text">Más</button>
                            </form>
                        </div></td>
                    <td><img src="imagenes/gato.jpg" alt="imagen no encontrada"></img>producto8<br>$precio$
                    <br><div class=botonimg>
                            <form action="Productos.php">
                                <button type="text">Más</button>
                            </form>
                        </div></td>
                </tr>
            </center></table>
        </aside>
        </div>
    </main>
    <br>
    <footer>
        <h5>Gracias por visitar nuestra página, esperamos que nos visites pronto</h5>
    </footer>
</body>
</html>