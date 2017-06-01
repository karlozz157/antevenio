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
            <h1 class="thanks-title">Los más votados</h1>
            <div class="body">
                <div id="thanks">
                    <div id="voted-answers">
                        <?php if (isset($data['mostVoted'])): ?>
                            <?php foreach($data['mostVoted'] as $key => $mostVoted): ?>        
                                <div class="voted-answer">
                                    <div class="voted-answer-description">
                                        <?php echo $mostVoted['description']; ?>
                                    </div>
                                    <img src="/antevenio/public/images/<?php echo $mostVoted['image']; ?>.jpg" class="voted-answer-img"/>
                                    <div class="voted-answer-title">
                                        <?php echo $mostVoted['title']; ?><br />
                                        <small><?php echo $mostVoted['votes']; ?> votos</small>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="description">
                    <h2>Vota por tus favoritas</h2>
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
                    <h2>¡Regístrate y Vota!</h2>
                    <input type="text" name="name" id="name" placeholder="Tu Nombre" required/>
                    <input type="email" name="email" id="email" placeholder="Tu Email" required/>
                    <input type="text" name="birthdate" id="birthdate" onfocus="(this.type='date')" placeholder="Tu Fecha de Nacimiento" required>
                    <button type="submit">VOTAR</button>
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