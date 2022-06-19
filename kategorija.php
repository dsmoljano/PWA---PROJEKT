<!DOCTYPE html>
<html lang="fr">
<head>
    <title>PWA Projekt</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="PWA Projekt"/>
    <meta name="description" content="PWA Projekt">
    <meta name="author" content="Duje Smoljanović">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/43d37ac167.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="Slike/LExpressLogo.png" class="logoSlika" alt="Logo">
        </div>
        <nav>
            <div class="navigacija">
                <ul>
                    <li><a href="index.php"> HOME </a></li>
                    <li><a href="kategorija.php?idk=Sport">SPORT</a></li>
                    <li><a href="kategorija.php?idk=Zabava">ZABAVA</a></li>
                    <li><a href="kategorija.php?idk=Politika">POLITIKA</a></li>
                    <li><a href="administracija.php"> ADMINISTRACIJA </a></li>
                    <li><a href="unos.php"> UNOS </a></li>
                    <li><a href="registracija.php"> REGISTRACIJA </a></li>
                </ul>
            </div>
        </nav>
        <div class="pravokutnik"></div>
    </header>
    <?php 
        $idk = $_GET['idk'];
        $dbc = mysqli_connect('127.0.0.1', 'root', '', 'projekt');
        if($dbc){
        $query = "SELECT * FROM vijesti WHERE kategorija='$idk'AND prikaz > 0 ";
        $result = mysqli_query($dbc,$query);
        }
        if($result){
            $pomoc = 0;
            while ($row = mysqli_fetch_array($result)){
                $pomoc = $pomoc + 1;
            }
        }
        if($pomoc > 0){ ?>
            <div class="centriranje">
            <section class="kategorija">
            <div class="vijesti">
                <?php
                    $dbc = mysqli_connect('127.0.0.1', 'root', '', 'projekt');
                    if($dbc){
                    $query = "SELECT * FROM vijesti WHERE kategorija='$idk'AND prikaz > 0 ";
                    $result = mysqli_query($dbc,$query);
                    }
                    if($result){
                    while ($row = mysqli_fetch_array($result)){
                ?>
                    <article class="PrvaVijestKategorija"> 
                    <div class="PrvaSlikaOkvir">
                        <img src="Slike/<?=$row['slika'];?>" class="slikaVijest" alt="<?=$row['slika'];?>">
                    </div>
                    <h2><?=$row['datum'];?></h2> 
                    <a href="clanak.php?id=<?php echo $row['id'];?>"><p class="tekstVijest"><?=$row['naslov'];?></p></a>
                    </article>
                <?php
                        }
                    }
                    mysqli_close($dbc);
                ?>
            </div>
        </section>
    </div>
    <?php
        }
    ?> 
    <footer>
        <div class="footer">
            <p>Les sites du réseau Groupe L'Express : Food avec Mycuisine.fr</p>
            <p>© L'Express -</p>
            <p>Duje Smoljanović, dsmoljano@tvz.hr, 2022</p>
        </div>
    </footer>
</body>

</html>