<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Clanak</title>
    <meta charset="UTF-8">
    <meta name="keywords" content="PWA Projekt"/>
    <meta name="description" content="PWA Projekt">
    <meta name="author" content="Duje Smoljanović">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/43d37ac167.js" crossorigin="anonymous"></script>
</head>
<?php
    $dbc = mysqli_connect('127.0.0.1', 'root', '', 'projekt');
    $id = $_GET['id'];
    $naslov = mysqli_query( $dbc, "SELECT naslov FROM vijesti WHERE id = '$id'");
    $sazetak = mysqli_query( $dbc, "SELECT sazetak FROM vijesti WHERE id = '$id'");
    $sadrzaj = mysqli_query( $dbc, "SELECT sadrzaj FROM vijesti WHERE id = '$id'");
    $kategorije = mysqli_query( $dbc, "SELECT kategorija FROM vijesti WHERE id = '$id'");
    $naslovnaSlika = mysqli_query( $dbc, "SELECT slika FROM vijesti WHERE id = '$id'");
    $publishDate = mysqli_query( $dbc, "SELECT datum FROM vijesti WHERE id = '$id'");
    mysqli_close($dbc);
?>
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
    <div class="centriranje">
        <div class="kategorija">
            <div class="vijesti">
                <?php
                    $dbc = mysqli_connect('127.0.0.1', 'root', '', 'projekt');
                    $id = $_GET['id'];
                    if($dbc){
                    $query = "SELECT * FROM vijesti WHERE id = '$id'";
                    $result = mysqli_query($dbc,$query);
                    }
                    if($result){
                    while ($row = mysqli_fetch_array($result)){
                ?>
                    <article class="vijestClanak"> 
                    <h2><?=$row['kategorija'];?></h2>
                    <h1 class="tekstVijestClanak"><?=$row['naslov'];?></h1>
                    <div class="publishOkvir">
                        <p class="publish">Published: <?=$row['datum'];?></p>
                    </div>   
                    <div class="slikaOkvirClanak">
                        <img src="Slike/<?=$row['slika'];?>" class="slikaVijest" alt="<?=$row['slika'];?>">
                    </div>
                    <div class="glavniTekstOkvir">
                        <p class="glavniTekstPodnaslov"><?=$row['sazetak'];?></p>
                        <p class="glavniTekst"><?=$row['sadrzaj'];?></p>
                    </div>
                    </article>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </div>
    <footer>
        <div class="footer">
            <p>Les sites du réseau Groupe L'Express : Food avec Mycuisine.fr</p>
            <p>© L'Express -</p>
            <p>Duje Smoljanović, dsmoljano@tvz.hr, 2022</p>
        </div>
    </footer>
</body>
</html>
