<?php

$errors = [];
$errorMessage = '';

$secret = '6LcgzV4fAAAAAJNcQqNa2HaFisaTUebJItjwR9ts';

if (!empty($_POST)) {
    $name = $_POST['name'];
    $guest = $_POST['guest'];
	$kids = $_POST['kids'];
    $message = $_POST['message'];
//	$startas = $_POST['startas'];
//	$terasa = $_POST['terasa'];
	$valio = $_POST['valio'];
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $recaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$recaptchaResponse}";
    $verify = json_decode(file_get_contents($recaptchaUrl));

    if (!$verify->success) {
      $errors[] = 'Google nepavyko patvirtinti formos pateikimo.';
    }

    if (empty($name)) {
        $errors[] = 'Neužpildytas laukas: Jūsų vardas';
    }
	
//	    if (empty($startas)) {
//        $startas = 'Ne';
//    }
//	
//	    if (empty($terasa)) {
//        $terasa = 'Ne';
//    }
//	
//	    if (empty($valio)) {
//        $valio = 'Ne';
//    }
		    if (empty($kids)) {
        $kids = 'Ne';
    }

//    if (empty($guest)) {
//        $errors[] = 'Email is empty';
//    } else if (!filter_var($guest, FILTER_VALIDATE_EMAIL)) {
//        $errors[] = 'Email is invalid';
//    }
//
//    if (empty($message)) {
//        $errors[] = 'Message is empty';
//    }


    if (!empty($errors)) {
        $allErrors = join('<hr />', $errors);
        $errorMessage = "<div class='invalid-tooltip' style='display: block; position: relative; font-size: 2rem;'>{$allErrors}</div>";
    } else {
        $toEmail = 'nrg@dit.lt';
        $emailSubject = 'Gavote svečio laišką'; 
        $headers = ['From' => $name . '.rezervacija@slibinukas.lt', 'Reply-To' => $name .'.rezervacija@slibinukas.lt', 'Content-type' => 'text/html; charset=UTF-8'];

        $bodyParagraphs = ["Svečio vardas: <strong>{$name}</strong> <br />", 
						   "Poros vardas: <strong>{$guest}</strong> <br />",
						   "Šventėje su vaiku/vaikais: <strong>{$kids}</strong> <br />",
//						   "Startas: <strong>{$startas}</strong> <br />",
//						   "Poros vardas: <strong>{$terasa}</strong> <br />",
						   "Dalyvausim: <strong>{$valio}</strong> <br />",
						   "Komentaras:", $message];
        $body = join(PHP_EOL, $bodyParagraphs);

        if (mail($toEmail, $emailSubject, $body, $headers)) {
            header('Location: woohoo.html');
        } else {
            $errorMessage = "<p style='color: red;'>Nepavyko išsiųsti. Nenusimikite ir pabandykite dar kartą.</p>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kvietimas</title>
	    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!--    <script src="from_scratch.js" defer></script>-->
    <style type="text/css">
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css");
		@import url('https://fonts.googleapis.com/css2?family=Amatic+SC:wght@700&family=Fira+Sans:ital,wght@1,600&family=Poppins&display=swap');
/*		@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');*/
		@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap');
		
		*, body, html {
/*			font-family: 'Open Sans', sans-serif;*/
			font-family: 'Oswald', sans-serif;
			font-size: 1.2rem;
			letter-spacing: .1rem;
		}
		
		h1, h2, h3 {
		font-family: 'Amatic SC', cursive;
		}
		h1 {
			font-size: 3.2rem;
			padding-top: 20vh;
		}
		.huge {
			font-size: 4.2rem;
		}
		.border-custom {
			border: solid 2px #333;
			margin: 2em 0;
			padding: 0 1em;
		}
		.center-custom {
			max-width: 42em;
		}
		@media (min-width: 968px) {
					.content-center {
			max-width: 42vw;

			}
		}
		.content-center {
			margin: 2em auto;
			padding-left: 1em;
			padding-right: 1em;
		}
		.respinsive-img {
			max-height: 80vh;
		}
		.respinsive-iframe {
			height: 80vh;
			max-height: 80vh;
			padding-bottom: 2em;
		}
		.btn-custom {
			background-color: #EE4266;
			border-color: #EE4266;
			color: #fff;
		}
		.btn-custom:hover {
			background-color: #EA1F4B;
			border-color: #F37C96;
			color:#fff;
		}
		.light-bg {
			background-color:  #E8EDDF
		}
		.grad-bg {
			background-image: linear-gradient(45deg, #fddb92 0%, #d1fdff 100%);


		}
		.form-check-input:checked {
    background-color: #EA1F4B;
    border-color: #F37C96;
}
		@import url("https://fonts.googleapis.com/css2?family=Pacifico&display=swap");

[class^=firework-] {
  position: absolute;
  width: 0.2rem;
  height: 0.2rem;
  border-radius: 50%;
}

.firework-1 {
  -webkit-animation: firework-md 1.2s both infinite;
          animation: firework-md 1.2s both infinite;
  -webkit-animation-delay: 1.4s;
          animation-delay: 1.4s;
  top: 60%;
  left: 45%;
}

.firework-2 {
  -webkit-animation: firework-lg 1.2s both infinite;
          animation: firework-lg 1.2s both infinite;
  -webkit-animation-delay: 0.4s;
          animation-delay: 0.4s;
  top: 80%;
  left: 80%;
}

.firework-3 {
  -webkit-animation: firework-lg 1.2s both infinite;
          animation: firework-lg 1.2s both infinite;
  -webkit-animation-delay: 1s;
          animation-delay: 1s;
  top: 55%;
  left: 30%;
}

.firework-4 {
  -webkit-animation: firework-lg 1.2s both infinite;
          animation: firework-lg 1.2s both infinite;
  -webkit-animation-delay: 1.4s;
          animation-delay: 1.4s;
  top: 50%;
  left: 85%;
}

.firework-5 {
  -webkit-animation: firework-lg 1.2s both infinite;
          animation: firework-lg 1.2s both infinite;
  -webkit-animation-delay: 1.3s;
          animation-delay: 1.3s;
  top: 15%;
  left: 65%;
}

.firework-6 {
  -webkit-animation: firework-md 1.2s both infinite;
          animation: firework-md 1.2s both infinite;
  -webkit-animation-delay: 1.4s;
          animation-delay: 1.4s;
  top: 30%;
  left: 55%;
}

.firework-7 {
  -webkit-animation: firework-md 1.2s both infinite;
          animation: firework-md 1.2s both infinite;
  -webkit-animation-delay: 0.6s;
          animation-delay: 0.6s;
  top: 85%;
  left: 50%;
}

.firework-8 {
  -webkit-animation: firework-md 1.2s both infinite;
          animation: firework-md 1.2s both infinite;
  -webkit-animation-delay: 0.2s;
          animation-delay: 0.2s;
  top: 70%;
  left: 35%;
}

.firework-9 {
  -webkit-animation: firework-lg 1.2s both infinite;
          animation: firework-lg 1.2s both infinite;
  -webkit-animation-delay: 0.1s;
          animation-delay: 0.1s;
  top: 65%;
  left: 30%;
}

.firework-10 {
  -webkit-animation: firework-md 1.2s both infinite;
          animation: firework-md 1.2s both infinite;
  -webkit-animation-delay: 1.5s;
          animation-delay: 1.5s;
  top: 65%;
  left: 65%;
}

.firework-11 {
  -webkit-animation: firework-lg 1.2s both infinite;
          animation: firework-lg 1.2s both infinite;
  -webkit-animation-delay: 1.1s;
          animation-delay: 1.1s;
  top: 55%;
  left: 40%;
}

.firework-12 {
  -webkit-animation: firework-md 1.2s both infinite;
          animation: firework-md 1.2s both infinite;
  -webkit-animation-delay: 1s;
          animation-delay: 1s;
  top: 45%;
  left: 40%;
}

.firework-13 {
  -webkit-animation: firework-lg 1.2s both infinite;
          animation: firework-lg 1.2s both infinite;
  -webkit-animation-delay: 1s;
          animation-delay: 1s;
  top: 25%;
  left: 85%;
}

.firework-14 {
  -webkit-animation: firework-sm 1.2s both infinite;
          animation: firework-sm 1.2s both infinite;
  -webkit-animation-delay: 1.1s;
          animation-delay: 1.1s;
  top: 50%;
  left: 15%;
}

.firework-15 {
  -webkit-animation: firework-lg 1.2s both infinite;
          animation: firework-lg 1.2s both infinite;
  -webkit-animation-delay: 0.6s;
          animation-delay: 0.6s;
  top: 55%;
  left: 85%;
}

@-webkit-keyframes firework-sm {
  0%, 100% {
    opacity: 0;
  }
  10%, 70% {
    opacity: 1;
  }
  100% {
    box-shadow: -0.5rem 0rem 0 #F37C96, 0.5rem 0rem 0 #F37C96, 0rem -0.5rem 0 #F37C96, 0rem 0.5rem 0 #F37C96, 0.35rem -0.35rem 0 #F37C96, 0.35rem 0.35rem 0 #F37C96, -0.35rem -0.35rem 0 #F37C96, -0.35rem 0.35rem 0 #F37C96;
  }
}

@keyframes firework-sm {
  0%, 100% {
    opacity: 0;
  }
  10%, 70% {
    opacity: 1;
  }
  100% {
    box-shadow: -0.5rem 0rem 0 #F37C96, 0.5rem 0rem 0 #F37C96, 0rem -0.5rem 0 #F37C96, 0rem 0.5rem 0 #F37C96, 0.35rem -0.35rem 0 #F37C96, 0.35rem 0.35rem 0 #F37C96, -0.35rem -0.35rem 0 #F37C96, -0.35rem 0.35rem 0 #F37C96;
  }
}
@-webkit-keyframes firework-md {
  0%, 100% {
    opacity: 0;
  }
  10%, 70% {
    opacity: 1;
  }
  100% {
    box-shadow: -0.7rem 0rem 0 #F37C96, 0.7rem 0rem 0 #F37C96, 0rem -0.7rem 0 #F37C96, 0rem 0.7rem 0 #F37C96, 0.49rem -0.49rem 0 #F37C96, 0.49rem 0.49rem 0 #F37C96, -0.49rem -0.49rem 0 #F37C96, -0.49rem 0.49rem 0 #F37C96;
  }
}
@keyframes firework-md {
  0%, 100% {
    opacity: 0;
  }
  10%, 70% {
    opacity: 1;
  }
  100% {
    box-shadow: -0.7rem 0rem 0 #F37C96, 0.7rem 0rem 0 #F37C96, 0rem -0.7rem 0 #F37C96, 0rem 0.7rem 0 #F37C96, 0.49rem -0.49rem 0 #F37C96, 0.49rem 0.49rem 0 #F37C96, -0.49rem -0.49rem 0 #F37C96, -0.49rem 0.49rem 0 #F37C96;
  }
}
@-webkit-keyframes firework-lg {
  0%, 100% {
    opacity: 0;
  }
  10%, 70% {
    opacity: 1;
  }
  100% {
    box-shadow: -0.9rem 0rem 0 #F37C96, 0.9rem 0rem 0 #F37C96, 0rem -0.9rem 0 #F37C96, 0rem 0.9rem 0 #F37C96, 0.63rem -0.63rem 0 #F37C96, 0.63rem 0.63rem 0 #F37C96, -0.63rem -0.63rem 0 #F37C96, -0.63rem 0.63rem 0 #F37C96;
  }
}
@keyframes firework-lg {
  0%, 100% {
    opacity: 0;
  }
  10%, 70% {
    opacity: 1;
  }
  100% {
    box-shadow: -0.9rem 0rem 0 #F37C96, 0.9rem 0rem 0 #F37C96, 0rem -0.9rem 0 #F37C96, 0rem 0.9rem 0 #F37C96, 0.63rem -0.63rem 0 #F37C96, 0.63rem 0.63rem 0 #F37C96, -0.63rem -0.63rem 0 #F37C96, -0.63rem 0.63rem 0 #F37C96;
  }
}
    </style>
</head>
<body class="d-flex h-100 text-center">

	    
  <script src="https://www.google.com/recaptcha/api.js"></script>
<!--	<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
<!--	.container-->
		<div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
			<div class="row">
				<?php echo((!empty($errorMessage)) ? $errorMessage : '') ?>
				<div class="col-lg-12 ">
				<div class="center-custom d-flex mx-auto flex-column">
				<h1 class="p-3">[ Agnytė ir Aurelijus ]</h1>
				<img class="respinsive-img" src="https://slibinukas.lt/img/atvirute.svg" alt="My Happy SVG" />
					
										<div class="firework-1"></div>
<div class="firework-2"></div>
<div class="firework-3"></div>
<div class="firework-4"></div>
<div class="firework-5"></div>
<div class="firework-6"></div>
<div class="firework-7"></div>
<div class="firework-8"></div>
<div class="firework-9"></div>
<div class="firework-10"></div>
<div class="firework-11"></div>
<div class="firework-12"></div>
<div class="firework-13"></div>
<div class="firework-14"></div>
<div class="firework-15"></div>
				</div>
				</div>
		</div>
<!--	startas start	.row-->
		<div class="row">
            <div class="col-lg-12">
				<div class="border-custom">

				<h1 class="hello">Startas 2022-06-18</h1>
								<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgZGF0YS1uYW1lPSJMYXllciAxIiBpZD0iTGF5ZXJfMSIgdmlld0JveD0iMCAwIDEyOCAxMjgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHRpdGxlLz48cGF0aCBkPSJNNjIuNTIsNTEuNDUsMjcuODEsNDYuMzJhMSwxLDAsMCwwLTEuMTMuODRMMjQuMTIsNjQuNEExOC41MSwxOC41MSwwLDAsMCwzOC44OSw4NS4xNGwtMy4wOSwyMi4xLTE1LjEyLDMuNjFhMSwxLDAsMCwwLC4wOSwyTDUwLjM1LDExN2guMTRhMSwxLDAsMCwwLC41LTEuODdsLTEzLjIzLTcuNSwzLjExLTIyLjIxYy41OCwwLDEuMTYuMDksMS43NC4wOUExOC4zOSwxOC4zOSwwLDAsMCw2MC44LDY5LjgybDIuNTYtMTcuMjRhMSwxLDAsMCwwLS4xOS0uNzRBMSwxLDAsMCwwLDYyLjUyLDUxLjQ1Wm0tMzQtMywzMi43Miw0LjgzLTEuMzMsOUwyNy4xOCw1Ny4zOFptLTIuMjQsNjMuMTIsMTAuMS0yLjQxLDksNS4xM1ptMjYuMS0zMS4yNkExNi42LDE2LjYsMCwwLDEsMjYuMSw2NC42OWwuNzktNS4zMywzMi43Miw0Ljg2LS43OSw1LjNBMTYuMjksMTYuMjksMCwwLDEsNTIuMzcsODAuMzFaIi8+PHBhdGggZD0iTTM3LjY2LDc3LjYyYy04LjQ5LTQuMjQtNi41NC0xMy44NS02LjQ1LTE0LjI2YTEsMSwwLDAsMC0yLS40M2MwLC4xMi0yLjM4LDExLjU0LDcuNTIsMTYuNDhhMSwxLDAsMCwwLC40NS4xMSwxLDEsMCwwLDAsLjg5LS41NUExLDEsMCwwLDAsMzcuNjYsNzcuNjJaIi8+PHBhdGggZD0iTTkxLjI1LDc5LjUyYS45My45MywwLDAsMCwuNS0uMTRjOS4zOC01LjQyLDctMTYuMzQsNy0xNi40NWExLDEsMCwxLDAtMiwuNDRjLjA5LjM5LDIsOS42LTYsMTQuMjhhMSwxLDAsMCwwLC41LDEuODdaIi8+PHBhdGggZD0iTTU0LjI1LDI2LjdhMSwxLDAsMCwwLS41MywxLjkzYy4wOCwwLDcuOTMsMi4yMyw4LjM1LDEwLjI3YTEsMSwwLDAsMCwxLDFoMGExLDEsMCwwLDAsLjk1LTEuMDVDNjMuNTcsMjkuMzMsNTQuMzQsMjYuNzIsNTQuMjUsMjYuN1oiLz48cGF0aCBkPSJNODMuMTcsMzIuOGExLDEsMCwwLDAtMS0xYy0uMTMsMC0xMywuMTMtMTQuNSwxMC42NGExLDEsMCwwLDAsLjg1LDEuMTNoLjE0YTEsMSwwLDAsMCwxLS44NWMxLjI1LTguOCwxMi4wNi04LjkzLDEyLjUyLTguOTNBMSwxLDAsMCwwLDgzLjE3LDMyLjhaIi8+PHBhdGggZD0iTTc0LjI0LDQyLjQ4YTEsMSwwLDAsMCwuODUsMS4xM2guMTRhMSwxLDAsMCwwLDEtLjg2Yy4zNC0yLjQyLDMuNDktMi40NywzLjYyLTIuNDdhMSwxLDAsMCwwLDAtMkM3OC4xMSwzOC4yOSw3NC43MSwzOS4xNiw3NC4yNCw0Mi40OFoiLz48cGF0aCBkPSJNMTA3LjMyLDExMC44NSw5Mi4yLDEwNy4yNGwtMy4wOS0yMi4xQTE4LjUxLDE4LjUxLDAsMCwwLDEwMy44OCw2NC40bC0yLjU2LTE3LjI0YTEsMSwwLDAsMC0xLjEzLS44NEw2NS40OCw1MS40NWExLDEsMCwwLDAtLjY1LjM5LDEsMSwwLDAsMC0uMTkuNzRMNjcuMiw2OS44MUExOC4zOSwxOC4zOSwwLDAsMCw4NS4zOSw4NS41M2MuNTgsMCwxLjE2LDAsMS43NC0uMDlsMy4xMSwyMi4yMUw3NywxMTUuMTVhMSwxLDAsMCwwLC41LDEuODdoLjE0bDI5LjU4LTQuMmExLDEsMCwwLDAsLjA5LTJabS03LjgzLTYyLjQsMS4zMyw4LjkzTDY4LjEsNjIuMjVsLTEuMzMtOVpNNzUuNjMsODAuMzFhMTYuMjksMTYuMjksMCwwLDEtNi40NS0xMC43OWwtLjc5LTUuMywzMi43Mi00Ljg2Ljc5LDUuMzNBMTYuNiwxNi42LDAsMCwxLDc1LjYzLDgwLjMxWm03LDM0LDktNS4xMywxMC4xLDIuNDFaIi8+PHBhdGggZD0iTTY4LDQ4YTEsMSwwLDAsMCwwLTJoMGExLDEsMCwxLDAsMCwyWiIvPjxwYXRoIGQ9Ik01MC43NSwyOC4wOGExLDEsMCwwLDAsMC0yaDBhMSwxLDAsMCwwLTEsMUExLDEsMCwwLDAsNTAuNzUsMjguMDhaIi8+PHBhdGggZD0iTTQ4LjA2LDMyLjEzYTEsMSwwLDAsMCwxLjE3LS43OSwxLDEsMCwwLDAtLjc3LTEuMTdjLS4xNCwwLTMuMzYtLjY3LTUuNTMuNTRhMSwxLDAsMCwwLS4zOSwxLjM2LDEsMSwwLDAsMCwuODcuNTEsMS4wNywxLjA3LDAsMCwwLC40OS0uMTJBNy4xOSw3LjE5LDAsMCwxLDQ4LjA2LDMyLjEzWiIvPjxwYXRoIGQ9Ik03Ny44NSwyMmMwLS4wNS4xMS0uMy4xMy0uMzdsLjEtLjMzYTYuNTIsNi41MiwwLDAsMC0uNTctNC43OSw1Ljg2LDUuODYsMCwwLDAtMy42OS0yLjkyLDYsNiwwLDAsMC01LjM5LDEuMyw2LDYsMCwwLDAtNC4wNy0zLjc1LDYuMjQsNi4yNCwwLDAsMC03LjQ4LDQuNzFjMCwuMDYtLjA1LjIzLS4wNy4zMnMtLjA1LjMtLjA2LjM0Yy0uODIsNSw2LjM5LDEyLjY3LDcuMjEsMTMuNTNhMSwxLDAsMCwwLC43Mi4zMSwxLDEsMCwwLDAsLjMsMEM2Ni4xMiwzMCw3Ni4xNiwyNi43NSw3Ny44NSwyMlpNNzYsMjEuMzRjLTEuMDgsMy03LjgyLDUuODMtMTEsNi45QzYyLjcyLDI1Ljc2LDU4LjIsMjAsNTguNzMsMTYuODVsLjEtLjUyQTQuMzQsNC4zNCwwLDAsMSw2Mi45MSwxM2EzLjQ1LDMuNDUsMCwwLDEsMSwuMTMsNC4xMyw0LjEzLDAsMCwxLDMsNC4xMSwxLDEsMCwwLDAsMS44Ny40OSw0LjEzLDQuMTMsMCwwLDEsNC42MS0yLjE1LDMuOTIsMy45MiwwLDAsMSwyLjQ0LDEuOTQsNC41OCw0LjU4LDAsMCwxLC4zOSwzLjMybC0uMDcuMjNTNzYsMjEuMjgsNzYsMjEuMzRaIi8+PHBhdGggZD0iTTQ1LDQzLjc2bC4xNS4yM2MyLDIuODEsOS4wNywzLDkuODcsMy4wN2gwYTEsMSwwLDAsMCwuODktLjU0Yy4zNy0uNywzLjU5LTcsMi4xMi0xMC4wOWwtLjEzLS4yN0w1Ny44MiwzNmwwLDBhNC40Myw0LjQzLDAsMCwwLTYtMS43Miw0LjE5LDQuMTksMCwwLDAtMiwyLjksNC4yNCw0LjI0LDAsMCwwLTMuNTEuMzQsNC4xNiw0LjE2LDAsMCwwLTIsMi43Miw0LjUsNC41LDAsMCwwLC41MSwzLjNBMi4yNywyLjI3LDAsMCwwLDQ1LDQzLjc2Wm0xLjI5LTMuMTFhMi4xMywyLjEzLDAsMCwxLDIuMTEtMS43MywyLjUsMi41LDAsMCwxLDEuNzcuNzYsMSwxLDAsMCwwLDEuMjIuMTcsMSwxLDAsMCwwLC40NS0xLjE1LDIuMzYsMi4zNiwwLDAsMSwxLTIuNzMsMi40NCwyLjQ0LDAsMCwxLDMuMjcsMWwuODYtLjUxLS44Ni41Mi4xNC4yN2MuNzQsMS41Ni0uNjEsNS4zNy0xLjc5LDcuNzgtMi42Ny0uMTUtNi42Ni0uODItNy42Ni0yLjIybC0uMTgtLjI2QTIuNTgsMi41OCwwLDAsMSw0Ni4yOCw0MC42NVoiLz48L3N2Zz4=" width="200" />
				<h2 class="huge">Santuokų rūmai</h2>

				<ul class="list-unstyled content-center">
				
					<li><strong>Vieta:</strong> K. Kalinausko g. 21, Vilnius 03107</li>
					<li><strong>Laikas:</strong> 13:40</li>
				</ul>
				<iframe class="respinsive-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2306.5099988784036!2d25.26703851605848!3d54.68305248144755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dd94123975488b%3A0xc010691f7f2b690e!2sVilniaus%20m.%20civilin%C4%97s%20metrikacijos%20skyrius!5e0!3m2!1slt!2slt!4v1649509375728!5m2!1slt!2slt" width="100%" height="" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
<!--			.column-->
		</div>
<!--	startas end	.row-->
			
<!-- forma start -->
        <div class="row light-bg">
			<div class="col-lg-12" >
				<h1>Pranešk mums ar atvyksi</h1>
  <form action="/index.php" method="post" id="contact-form" class="content-center">
    
    <div class="form-floating mb-3">

      <input name="name" id="name" class="form-control" type="text" autocomplete="off" placeholder="Jūsų vardas:">
	<label for="name" class="floatingInput">Tavo vardas:</label>	      
    </div>
    <div class="form-floating mb-3">
      <input name="guest" class="form-control" id="guest" type="text" autocomplete="off" placeholder="Poros vardas:">
		<label for="guest" class="floatingInput">Tavo poros vardas:</label>
    </div>
	  <div class="form-check mb-3 text-start">
  <input class="form-check-input" type="checkbox" name="kids" value="Taip" id="kids">
  <label class="form-check-label" for="kids">
    Atkeliausime su vaiku/vaikais
  </label>
</div>
	  <hr />
<h2 class="text-start">Kur pasitysime?</h2>
<div class="form-check mb-3 text-start">
  <input class="form-check-input" type="radio" name="valio" value="Santuokų rūmmai" id="startas">
  <label class="form-check-label" for="startas">
    Startas - Santuokų rūmai
  </label>
</div>
	  
<div class="form-check mb-3 text-start">
  <input class="form-check-input" type="radio" name="valio" value="Vakarėlis terasoje" id="terasa">
  <label class="form-check-label" for="terasa">
    Pratęsimas terasoje
  </label>
</div>
<div class="form-check mb-3 text-start">
  <input class="form-check-input" type="radio" checked name="valio" value="Nuo pradžių iki galo" id="valio">
  <label class="form-check-label" for="valio">
    Nuo starto iki finišo!
  </label>
</div>
    <div class="form-floating mb-3">
      <textarea name="message" class="form-control" id="message" autocomplete="off" placeholder="Komentaras:"></textarea>
		<label for="message" class="floatingInput">Komentaras:</label>
    </div>  
	  
    <div class="mb-3">
      <button
        class="g-recaptcha btn btn-custom btn-lg"
        type="submit"
        data-sitekey="6LcgzV4fAAAAAMYhauELG8W8LLnsTrAK0P3028jy"
        data-callback='onRecaptchaSuccess'
      >
        Siųsti
      </button>
    </div>
  </form>
</div>
</div>
			<!-- forma end -->

	</div> 
<!--	.container-->
<script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>
  <script>
      const constraints = {
          name: {
              presence: {allowEmpty: false}
          }
//          guest: {
//              presence: {allowEmpty: false},
//              guest: true
//          },
//          message: {
//              presence: {allowEmpty: false}
//          }
      };

      const form = document.getElementById('contact-form');

      form.addEventListener('submit', function (event) {
          const formValues = {
              name: form.elements.name.value,
//              guest: form.elements.guest.value,
//              message: form.elements.message.value
          };

          const errors = validate(formValues, constraints);

          if (errors) {
              event.preventDefault();
              const errorMessage = Object
                  .values(errors)
                  .map(function (fieldValues) {
                      return fieldValues.join(', ')
                  })
                  .join("\n");

              alert(errorMessage);
          }
      }, false);

      function onRecaptchaSuccess () {
          document.getElementById('contact-form').submit()
      }
  </script>
</body>
</html>
