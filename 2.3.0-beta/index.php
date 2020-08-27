<?php

	mb_internal_encoding("UTF-8");
	
	/* Message vars */
	$msg = '';				// pre správu
	$msgClass = '';			// Pre rozdielne farby výpsiu upozornenia
	$ochrana = "sirob";		// ochraný spam prvok
	
	
	
	
	
	/* Hľadanie premnennej submit - tlačidlo na potrvdenie odoslania mailu */
	if (filter_has_var(INPUT_POST, 'submit')) {
		
		// Uloženie dát do premmených
		$meno = htmlspecialchars($_POST["name"]);
		$email = htmlspecialchars($_POST["email"]);
		$spam_check = htmlspecialchars($_POST["spam_check"]);
		$sprava = htmlspecialchars($_POST["sprava"]);
		
		
		
		// Ak nie sú požadované premenné prázdne
		if( !empty($meno) && !empty($email) && !empty($spam_check) && !empty($sprava) ) {
			// Ak splnime, pokračujeme
			
			if (filter_var($email, FILTER_VALIDATE_EMAIL) === FALSE) {
				
				//Ak sa použije nesprávny tvar emailu.
				$msg = 'Prosím použite správny tvar emailu!';
				$msgClass = 'alert-danger'; 		// správa bude červená	(bootstrap)
			}
			
			else {
				
				
				/* Zistujeme či sa nejedná o spam */
				if ($spam_check == $ochrana) {
					
					// Splnené
					// Email - prijemcu
					// Spam ochrana - OK
					$toEmail = 'boris.belica2@gmail.com';
					$subject = '[SPRÁVA] - WEB BORIS BELICA - OD: '.$meno;
					$body = 'KONTAKTNÝ FORMULÁR - BORIS BELICA WEB'."\r \n".
							'- ODOSIELATEĽ - '."\r \n".$meno."\r \n".
							'- OBSAH SPRÁVY - '."\r \n".$sprava;	
				
				
					
					
					// Dodatočne Headers
					$headers .= "Od: ".$meno. "<" .$email. ">". "\r \n";
					
						if(mail($toEmail, $subject, $body, $headers)) {
							// Ak odošle email
							$msg = 'Správa úspešne odoslaná!';
							$msgClass = 'alert-success';						
						}
					
						else {
							// Ak email neodošle
							$msg = 'Tvoj email nebol odoslaný!';
							$msgClass = 'alert-danger';
						}
					}


				else {
							$msg = 'Zle zadaný ochranný provk!';
							$msgClass = 'alert-danger';		
					}
				
				}
			
			}
		
		else {
			/* Niektorá z položiek je prázdna */
			$msg = 'Prosím vyplnte všetky potrbené údaje!';
			$msgClass = 'alert-danger'; // správa bude červená	(bootstrap)
		}
			
		
	}
	
	
	/* Poznámka k DIV (napr.) */
	/* value="<?php echo isset($_POST['sprava']) ? $sprava : ''; ?> */
	/* Riadky uchovajú svoju hodnotu pri zadaní nesprávnej hodnoty. */

?>	

<!DOCTYPE html>

<html lang="sk">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- FONTS -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap&subset=latin-ext" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;400;700&display=swap&subset=latin-ext" rel="stylesheet" />
    <!-- FONTS -->

    <!-- ANIMATE CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- ANIMATE CSS -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Bootstrap CSS -->

    <!-- CSS / CSS -->
    <link rel="stylesheet" href="css/normalize.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <!-- CSS / CSS -->

    <!-- Bootstrap  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />
    <!-- Bootstrap  -->

    <!-- ICOS  -->
    <link rel="apple-touch-icon" sizes="57x57" href="img/icos/apple-icon-57x57.png">
    

    <link rel="apple-touch-icon" sizes="114x114" href="img/icos/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/icosimg/icos/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/icos/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icos/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icos/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="img/icos/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/icos/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="img/icos/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/icos/favicon-16x16.png">



    <link rel="manifest" href="img/icos/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="img/icos/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <!-- ICOS  -->

    <!-- META NADSTAVENIA -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2" />
    <meta name="description" content="Boris Belica Junior Web Developer, portfólio." />
    <meta name="author" content="Boris Belica" />
    <meta name="keywords" content="Programátor, developer, web, Javascript, PHP, HTML, CSS, junior, aplikácia, C++, freelancer" />
    <meta name="robots" content="index, follow" />
    <link rel="canonical" href="https://boris-belica.sk/" />

    <meta property="og:url" content="https://boris-belica.sk/" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="Boris Belica | Junior Web Developer" />
    <meta property="og:description" content="Boris Belica osobný web, junior web developer" />
    <meta property="og:image" content="beta.boris-belica.sk/img/etc/web-photo.JPG" />

    <title>Boris Belica | Developer</title>
</head>



<body>

    <nav class="navbar fixed-top navbar-expand-lg navbar-dark">
        <a href="#HEADER">
        <img class="navbar-brand" src="img/icos/favicon-32x32.png" alt="logo-boris-belica">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#MAIN-NAV" aria-controls="MAIN-NAV" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="MAIN-NAV">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#PROFIL">Kto som</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#PROJECTS">Projekty</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#CONTACT">Kontakt</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#PRESS">Zmienky</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#VIDEO-BANNER">Github</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#FOOTER">
                        <img src="img/etc/copyright.png" alt="">
                    </a>
                </li>
            </ul>
        </div>

    </nav>


    <header id="HEADER">
        <div class="texture"></div>

        <video loop autoplay muted preload="auto">
            <source src="video/video-bg.mp4" type="video/mp4" />
        </video>

        <div class="header-content">
            <h1>BORIS BELICA</h1>
            <h3>
                Nóóóó... konečne si tu!<br />
                Pokračuj dole..
            </h3>
        </div>

        <a href="#PROJECTS" class="header-btn" data-aos="fade-up" data-aos-duration="2000">Moje projekty</a>
    </header>

    <main id="PAGE-WRAPPER">
        <section id="PROFIL">
            <h2 class="text-center">Ja som Boris...</h2>

            <div class="line-post"></div>

            <div class="five-box">
                <div class="character-box" data-aos="flip-left" data-aos-duration="1000">
                    <img src="img/me-icons/productivity.webp" alt="logo produktivity" />
                    <h4>Produktívnosť</h4>
                    <p>Neustála potreba dosiahnuť stanovené ciele. Nadšený z nových úloh a výziev.</p>
                </div>

                <div class="character-box" data-aos="flip-left" data-aos-duration="1200">
                    <img src="img/me-icons/vision.webp" alt="ikona oka" />
                    <h4>Vizionár</h4>
                    <p>Pohľad do budúcnosti ma fascinuje a poháňa kupredu.</p>
                </div>

                <div class="character-box" data-aos="flip-left" data-aos-duration="1400">
                    <img src="img/me-icons/brain.webp" alt="ikona mozgu" />
                    <h4>Učenlivosť</h4>
                    <p>Schopnosť naučiť sa v krátkej dobe veľké množstvo nových zručností.</p>
                </div>

                <div class="character-box" data-aos="flip-left" data-aos-duration="1600">
                    <img src="img/me-icons/focus.webp" alt="ikona zamerania" />
                    <h4>Sústredenosť</h4>
                    <p>Keď ostatní začnú schádzať z cesty, som ten, ktorý nezabúda na cieľ.</p>
                </div>

                <div class="character-box" data-aos="flip-left" data-aos-duration="1800">
                    <img src="img/me-icons/good.webp" alt="ikona palca hore" />
                    <h4>Pozitívna myseľ</h4>
                    <p>Silné stabilné životné hodnoty, ktoré nie sú postavené na peniazoch a prestíži.</p>
                </div>
            </div>

            <p class="gallup">
                Mojich 5 najsilnejších stránok osobnosti vyhodnotených na základe uznávaného <a class="gallup" href="https://www.gallup.com/cliftonstrengths/en/home.aspx" target="_blank">CliftonStrengths</a> testu osobnosti od
                spoločnosti Gallup
            </p>

            <div class="two-box">
                <div class="photo-box" data-aos="fade-up" data-aos-duration="1500">
                    <img src="img/me/me-photo.webp" alt="moja profilová foto" />
                    <h4>Počuj, kto je to ten Boris, nevieš?</h4>

                    <p>
                        Viem!<br />
                        Úplne obyčajný chalan tak ako každý, nie je vôbec ničným výnimočný. Ha! Dokonca nemá ani vysokú školu, no a o jeho IQ... to sa ani radšej nebudeme baviť...
                    </p>

                    <p>Ja sa len snažím robiť to, čo ma baví. Najlepšie ako viem.</p>

                    <p>Občas som úplne trápny, no a? Kto nie? Ani neviem čo tu mám napísať, aj tak to nikto nečíta...</p>

                    <a class="btn btn-dark" href="mailto:boris.belica2@gmail.com">Konzultácia zadarmo</a>
                </div>

                <div class="tech-box">
                    <h4>Nebezpečné zručnosti</h4>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">CTRL + C / CTRL + V</div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 95%;" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">HTML / CSS</div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">Bootstrap</div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">C | C++ | C#</div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">Wordpress</div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100">SQL</div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">js</div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">PHP</div>
                    </div>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">VEGAS PRO</div>
                    </div>

                    <p>Veľmi náročná úloha, ohodnotiť samého seba... Kto to dokáže?</p>
                </div>
            </div>
        </section>

        <section id="PROJECTS">
            <h2 class="text-center">MOJE PROJEKTY</h2>

            <div class="line-post"></div>

            <div class="project-box">
                <div class="card" data-aos="flip-left" data-aos-duration="1100">
                    <img src="img/projects/bymijani.webp" class="card-img-top" alt="foto webu byMijani" />
                    <div class="card-body">
                        <h4>By Mijani</h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 60%; background-color: #fcba04;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">60%</div>
                        </div>
                        <p class="card-text">Eshop e-commerce stránka pre módnu značku by Mijani. Vytvorená pomocou redakčného systému Wordpress.</p>
                        <a href="https://bymijani.sk/" class="btn btn-primary" target="_blank">Nakupuj</a>
                    </div>
                </div>

                <div class="card" data-aos="fade-up" data-aos-duration="1100">
                    <img src="img/projects/dvabatohy.webp" class="card-img-top" alt="fotka webu Dva Batohy" />
                    <div class="card-body">
                        <h4>Dva Batohy</h4>

                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 30%; background-color: #a50104;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">30%</div>
                        </div>

                        <p class="card-text">
                            Náš nový pomaličky vznikajúci, rastúci cestovateľský projekt.
                        </p>
                        <a href="https://dvabatohy.sk/" class="btn btn-primary" target="_blank">Cestuj</a>
                    </div>
                </div>

                <div class="card" data-aos="flip-right" data-aos-duration="1100">
                    <img src="img/projects/prva-verzia.webp" class="card-img-top" alt="fotka prvého webu" />
                    <div class="card-body">
                        <h4>Môj web</h4>

                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">HOTOVO</div>
                        </div>

                        <p class="card-text">
                            Prvá verzia môjho osobného webu, ktorá fungovala od februára 2020 do augsta 2020.
                        </p>
                        <a href="http://prva-verzia.boris-belica.sk/" class="btn btn-primary" target="_blank">Zasmej sa</a>
                    </div>
                </div>
            </div>
        </section>



        <section id="VIDEO-BANNER"
        class="text-center">

        <div class="texture"></div>

        <video loop autoplay muted preload="auto">
            <source src="video/Bg2.mp4" type="video/mp4" />
        </video>

        <div class="header-content">
            <h2>GITHUB</h2>
            
            <h3>Všetky moje projekty a jednotlivé kódy sú verejne dostupné na mojom Github profile.</h3>
        </div>

        <a href="https://github.com/BorisBelica" target="_blank" class="header-btn" data-aos="fade-up" data-aos-duration="2000">No teda!</a>
            
        </section>



        <section id="CONTACT">
            <h2 class="text-center">Ako ma obťažovať...</h2>

            <div class="line-post"></div>

            <div class="form-box" data-aos="fade-up" data-aos-duration="1100">
			
                <h3 class="text-center">Kontaktný formulár</h3>

				<form method="POST" name="emailform" <?php echo $_SERVER['PHP_SELF']; ?> action="#CONTACT" >

                    <div class="form-group">
                        <label for="name">Meno a Priezvisko</label>
						<input type="text" class="form-control" name="name" id="nameid" placeholder="Meno a Priezvisko"
						value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
						

                        <label>E-mail</label>
						<input type="email" class="form-control" name="email" id="emailid" placeholder="adresa@email.com"
						value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
                    </div>

                    <div class="form-group text-center">
                        <label for="ochrana">Nezničiteľná spam ochrana</label>
                        <label for="ochrana">Napíš meno <b>boris</b> opačne, malým písmom</label>
						<input type="text" class="form-control" name="spam_check" id="spam_checkid" placeholder="Zadaj ochranný prvok"
						value="<?php echo isset($_POST['spam_check']) ? $spam_check : ''; ?>">
                    </div>

                    <div class="form-group">
                        <label for="messsage">Text správy</label>
						<textarea class="form-control" name="sprava" id="textareaid" rows="8" placeholder="Správa e-mailu"
						value="<?php echo isset($_POST['sprava']) ? $sprava : ''; ?>"> </textarea>
                    </div>

                    <div class="form-group">
						<input type="submit" name="submit"  class="btn btn-secondary" value="Odoslať">
                    </div>
                </form>
				
				<div class="container w-70 text-center">
					<?php if ($msg != ''): ?>
						<div class="alert <?php echo $msgClass; ?>">
							 <?php echo $msg; ?>
						</div>
					<?php endif; ?>
				</div>
				
				
				
				
				
				

                <p class="text-center">Píš mi ak máš niečo na srdci, ak ťa niečo zaujíma, ak chceš poradiť, ak chceš na niečom spolupracovať, možno to tak nevyzerá, ale budem ti vdačný!</p>
            </div>

            <div class="social-box text-center">
                <div>
                    <a href="https://www.facebook.com/Borickoo" target="_blank">
                        <img data-aos="flip-right" data-aos-duration="1000" src="img/social/facebook.webp" alt="logo facebook" /></a>
                    <a href="mailto:boris.belica2@gmail.com" target="_blank">
                        <img data-aos="flip-right" data-aos-duration="1200" src="img/social/gmail.webp" alt="logo gmail" /></a>
                </div>

                <div>
                    <a href="https://github.com/BorisBelica" target="_blank">
                        <img data-aos="flip-right" data-aos-duration="1400" src="img/social/github.webp" alt="logo github" /></a>
                    <a href="https://www.linkedin.com/in/boris-belica-0061631a1" target="_blank">
                        <img data-aos="flip-right" data-aos-duration="1600" src="img/social/linkedin.webp" alt="logo linkedin" /></a>
                </div>

                <div>
                    <a href="https://www.instagram.com/bor1cko" target="_blank">
                        <img data-aos="flip-left" data-aos-duration="1800" src="img/social/instagram.webp" alt="logo instagram" /></a>
                    <a href="https://www.youtube.com/user/BoBoO22595" target="_blank">
                        <img data-aos="flip-left" data-aos-duration="2000" src="img/social/youtube.webp" alt="logo youtube" /></a>
                </div>
            </div>
        </section>

        <section id="PRESS">
            <h2 class="text-center">Minúta slávy</h2>

            <div class="line-post"></div>

            <p class="text-center">Tak zatiaľ som nemal možnosť povedať "Ahoj mami, som v telke!", ale už sa mi (nám) dostalo kúsok pozornosti na internete...</p>

            <div class="press-box">
                <div>
                    <a href="https://seredsity.sk/ako-cestovat-sam-seredcania-adela-a-boris-budu-v-nasom-meste-prednasat-o-vyhodnom-a-lacnom-cestovani/" target="_blank">
                        <img data-aos="fade-down" src="img/press/press2.webp" alt="adel a boris" />
                    </a>

                    <a href="https://seredsity.sk/slovinsko-ako-novy-letny-hit-seredcania-adela-a-boris-pre-vas-pripravili-cely-itinerar-a-uzasny-vylet-mozete-zazit-aj-vy/" target="_blank">
                        <img data-aos="fade-down" src="img/press/press1.webp" alt="adel a boris" />
                    </a>
                </div>

                <div>
                    <a data-aos="fade-down" href="https://seredsity.sk/seredcania-adela-a-boris-navstevovali-cely-rok-jedno-miesto-v-seredi-aby-vytvorili-toto-unikatne-video/" target="_blank"><img src="img/press/press3.webp" alt="adel a boris" /> </a>

                    <a data-aos="fade-down" href="https://seredsity.sk/pozrite-si-nadherne-video-dvoch-seredcanov-aj-takto-vyzeraju-krasne-slovenske-lesy-ocami-adely-a-borisa/" target="_blank"><img src="img/press/press4.webp" alt="adel a boris" /> </a>
                </div>

                <div>
                    <p class="gallup text-center">Kliknutím na obrázok zobrazíš článok.</p>
                </div>
            </div>
        </section>

    

        <footer class="text-center" id="FOOTER">
            
            <picture>
                <source media="(max-width: 576px)" srcset="img/footer/footer-mob.JPG">
                <source media="(max-width: 768px)" srcset="img/footer/footer-760.JPG">
                <source media="(max-width: 1280px)" srcset="img/footer/footer-hd.JPG">
                
                <img src="img/footer/footer-fhd.JPG" alt="moj github">
            </picture>

            <div class="hero-box">

                <h2>© Boris Belica | 2020</h2>

                <p>"If you need inspiring words, don't do it."<br>
                - Elon Musk</p>

            </div>



        </footer>



    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>