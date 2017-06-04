<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Antevenio</title>
    <link rel="stylesheet" type="text/css" href="/antevenio/public/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/antevenio/public/css/main.css" />
</head>
<body>
    <div id="lightbox"></div>
    <div id="header">
        <img src="/antevenio/public/images/logo.png" />
    </div>
    <div id="wrapper">
        <form id="form-profile">
            <div class="body">
                <div class="description">
                    <h1>Vota por tus favoritas</h1>
                    <p>Haz click sobre las imágenes para seleccionar tus 7 maravillas favoritas</p> 
                </div>
                <div id="answers">
                </div>
            </div>
            <div class="separator">
                <div class="triangle"></div>
            </div>
            <div class="footer">
                <div>
                    <h2>¡Regístrate aquí y Vota!</h2>
                    <input type="text" name="name" id="name" placeholder="Tu Nombre" required/>
                    <input type="email" name="email" id="email" placeholder="Tu Email" required/>
                    <select name=day"" id="day" class="day" required>
                        <option>Día</option>
                        <?php foreach (range(1, 31) as $day): ?>
                            <option value=""><?php echo $day; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="month" id="month" class="month" required>
                        <option>Mes</option>
                        <option value="january">Enero</option>
                        <option value="february">Febrero</option>
                        <option value="march">Marzo</option>
                        <option value="april">Abril</option>
                        <option value="may">Mayo</option>
                        <option value="june">Junio</option>
                        <option value="july">Julio</option>
                        <option value="august">Agosto</option>
                        <option value="september">Septiembre</option>
                        <option value="octuber">Octubre</option>
                        <option value="november">Noviembre</option>
                        <option value="december">Diciembre</option>
                    </select>
                    <select name="year" id="year" class="year" required>
                        <option>Año</option>
                        <?php foreach (range(1970, date('Y')) as $year): ?>
                            <option value=""><?php echo $year; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select name="gender" id="gender" class="gender" required>
                        <option>Sexo</option>
                        <option value="male">Hombre</option>
                        <option value="female">Mujer</option>
                    </select>
                    <button type="submit">VOTA AQUÍ</button>
                </div>
            </div>
        </form>
    </div>
    <script type="text/javascript" src="/antevenio/public/js/main.js"></script>
    <script type="text/javascript">
        AntevenioApp.init();
        Lightbox.init();
    </script>
</body>
</html>