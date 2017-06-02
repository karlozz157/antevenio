<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Antevenio - Login</title>
    <link rel="stylesheet" type="text/css" href="/antevenio/public/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="/antevenio/public/css/main.css" />
    <style type="text/css">
        .login {
            font-family: arial;
            margin: auto;
            text-align: center;
            width: 100%;
        }

        .login a {
            background-color: #e56e10;
            border-color: rgba(0,0,0,0.2);
            border-radius: 5px;
            color: #fff;
            display: block !important;
            margin-bottom: 10px;
            padding: 10px 1%;
            text-decoration: none;
        }

        .login p {
            background: whitesmoke;
            border-radius: 5px;
            font-size: 12px;
            padding: 10px 0;
        }
    </style>
</head>
<body>
    <div id="header">
        <img src="/antevenio/public/images/logo.png" />
    </div>
    <div class="login">
        <a href="/antevenio/index.php/login">ENTRA Y VOTA POR LAS 7 MARAVILLAS!</a>
    </div>
    <div id="wrapper">
        <?php if (isset($data['count']) && $data['count']): ?>
            <div id="tus-votos">
                <h1 class="thanks-title">Lo más votados: <?php if (isset($data['count']) && $data['count']): ?><?php echo $data['count']; ?> personas han realizado el quiz<?php endif; ?></h1>
            </div>
        <?php endif; ?>
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
                                    <?php echo $mostVoted['votes']; ?> votos
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
