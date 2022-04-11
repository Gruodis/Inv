<?php

$errors = [];
$errorMessage = '';

$secret = '6LcgzV4fAAAAAJNcQqNa2HaFisaTUebJItjwR9ts';

$kids = isset($_POST['kids']) ? "Taip" : "Ne";

if (!empty($_POST)) {
    $name = $_POST['name'];
    $guest = $_POST['guest'];
//	$kids = $_POST['kids'];
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
//		    if (empty($kids)) {
//        $kids = 'Ne';
//    }

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
        $toEmail = 'nrg@dit.lt, agne.mita@gmail.com';
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

        *,
        body,
        html {
            /*			font-family: 'Open Sans', sans-serif;*/
            font-family: 'Oswald', sans-serif;
            font-size: 1.2rem;
            letter-spacing: .1rem;
        }

        h1,
        h2,
        h3 {
            font-family: 'Amatic SC', cursive;
        }

        h1 {
            font-size: 3.2rem;
        }
		h1:first-of-type {
			padding-top: 20vh;
		}
		.container {
			max-width: 100%
		}

        .huge {
            font-size: 4.2rem;
        }


        .border-custom {
            border: solid 2px #333;
            margin: 2em auto;
			max-width: 992px;
            padding: 0 1em;
    		border-top-right-radius: 10vh;

/*			background-image: url("https://draugiskigyvunams.lt/wp-content/uploads/2017/04/downtownforesthotel.jpg");*/
        }

        .center-custom {
            max-width: 42em;
			position: relative;
        }
		
		.text-content-agne {
			position: absolute;
			color: #fff;
			top: 200px;
			width: 20vw;
			padding: .6em;
			border-radius: 2vh 0 2vh 0;
			background-color: #EE4266;
			opacity: 0;
			left: 75%;
			transform: translateX(-50%);
			z-index: 99999999;
		}
		.text-content-aurelijus {
			position: absolute;
			color: #fff;
			top: 150px;
			width: 20vw;
			padding: .6em;
			border-radius: 0 2vh 0 2vh;
			background-color:#2a9fba;
			opacity: 0;
			left: 25%;
			transform: translateX(-50%);
			z-index: 99999999;
		}
/*
		.text-content-aurelijus::after {
			content: "\F5E3";
			color: #2a9fba;
			position: absolute;
			display: inline-block;
			font-family: bootstrap-icons !important;
			font-style: normal;
			font-weight: normal !important;
			font-variant: normal;
			text-transform: none;
			line-height: 1;
			vertical-align: -0.125em;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
			right: -17px;
			bottom: 3px;
			transform: rotate(-30deg);
			
		}
*/
		
		.text-agne-smagu {
			-webkit-animation-name: talk;
			-webkit-animation-duration: 4s;
			-webkit-animation-delay: 2s;
			/* Standard syntax */
			animation-name: talk;
			animation-duration: 4s;
			animation-delay: 4s;
			
		}
		.text-agne-lauksime {
			-webkit-animation-name: talk;
			-webkit-animation-duration: 4s;
			-webkit-animation-delay: 2s;
			/* Standard syntax */
			animation-name: talk;
			animation-duration: 4s;
			animation-delay: 8s;
/*			animation-fill-mode: forwards;*/
			
		}
		.text-agne-iki {
			-webkit-animation-name: talk;
			-webkit-animation-duration: 4s;
			-webkit-animation-delay: 2s;
			/* Standard syntax */
			animation-name: talkEnd;
			animation-duration: 6s;
			animation-delay: 12s;
			animation-fill-mode: forwards;
			
		}
		.text-aurelijus-labas {
			-webkit-animation-name: talk;
			-webkit-animation-duration: 4s;
			-webkit-animation-delay: 2s;
			/* Standard syntax */
			animation-name: talk;
			animation-duration: 4s;
			animation-delay: 2s;

		}
		
		.text-aurelijus-kvieciame {
			-webkit-animation-name: talk;
			-webkit-animation-duration: 4s;
			-webkit-animation-delay: 2s;
			/* Standard syntax */
			animation-name: talk;
			animation-duration: 4s;
			animation-delay: 6s;
/*			animation-fill-mode: forwards;*/

		}
		.text-aurelijus-detales {
			-webkit-animation-name: talk;
			-webkit-animation-duration: 4s;
			-webkit-animation-delay: 2s;
			/* Standard syntax */
			animation-name: talkEnd;
			animation-duration: 8s;
			animation-delay: 10s;
			animation-fill-mode: forwards;

		}

        @media (min-width: 968px) {
            .content-center {
                max-width: 42vw;

            }
        }
		@media (max-width: 576px) {
				.text-content-agne {
				top: 200px;
				width: 30vw;
				font-size: 1rem;
				padding: 0.3em;
				border-radius: 2vh 0 2vh 0;
				left: 85%;
				transform: translateX(-50%);
				bottom: 50vh;
				top: auto;

}
			.text-content-aurelijus {
				top: 210px;
				width: 30vw;
				font-size: 1rem;
				padding: 0.3em;
				left: 15%;
				bottom: 55vh;
				top: auto;
				
}
        }

        .content-center {
            margin: 2em auto;
            padding-left: 1em;
            padding-right: 1em;
			z-index: 99999;
        }

        .respinsive-img {
            max-height: 80vh;
			opacity: 1;
			animation: rectFade  2s forwards;
        }
.forestas {
	border-radius: 50%;
	max-width: 80%;
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
	color: #fff;
}

.light-bg {
	background-color: #E8EDDF;
	
}

.grad-bg {
	background-image: linear-gradient(45deg, #fddb92 0%, #d1fdff 100%);


}

.form-check-input:checked {
	background-color: #EA1F4B;
	border-color: #F37C96;
}

.globe {
	position: relative;
	overflow: hidden;
}

.globe::before {
	content: url(https://slibinukas.lt/img/cloud.svg);
	width: 30vw;
	/* height: 100vh; */
	position: absolute;
	bottom: 0vh;
	left: -100%;
	z-index: 2;
	animation: clouds 30s infinite linear;
	animation-delay: 4s;
}


.globe::after {
	content: url(https://slibinukas.lt/img/earth.svg);
	width: 200vw;
	/* height: 100vh; */
	position: absolute;
	top: 20vw;
	left: -50vw;
	z-index: -1;
	animation: rotation 100s infinite linear;
	animation-delay: 2s;
}
		.cloud-1 {
	background-image: url(https://slibinukas.lt/img/cloud.svg);
	background-position: center;
	background-repeat: no-repeat;
	width: 30vw;
	height: 30vh; 
	position: absolute;
	bottom: 40vh;
	left: -50%;
	z-index: 0;
	animation: clouds 60s infinite linear;
	animation-delay: 12s;
}
.cloud-2 {
	background-image: url(https://slibinukas.lt/img/cloud.svg);
	background-position: center;
	background-repeat: no-repeat;
	width: 60vw;
	height: 60vh; 
	position: absolute;
	bottom: 40vh;
	left: -80%;
	z-index: 0;
	transform: rotateY(180deg);
	animation: clouds 45s infinite linear;
	animation-delay: 2s;
}
.border-bottom {
	position: absolute;
	width: 200vw;
	height: 100%;
	background-color: #fff;
	left: -50%;
	bottom: -90%;
	border-radius: 50%;
	transform: translate(-50%, -50%);

}
.center-image {
	margin: 10vh 0;
}
@media (max-width: 1200px) {
		.globe::after {
		top: 50vw;
		left: -50vw;
		}
	.globe::before {
		bottom: 3vh;
		left: -100%;
		width: 50vw;
		}
}
@media (max-width: 768px) {
		.globe::after {
		top: 100vw;
		left: -50vw;
}
}		
@keyframes clouds {
  0%
   {
	left: -50%;
  }

  100% {
	left: 150%;
  }
}
@keyframes rotation {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}
@keyframes rectFade{
 0% {
    transform: scale(0.1);
  }
/*
  40% {
    transform: scale(1) rotateY(0deg);
  }
  50% {
    transform: scale(1) rotateY(90deg); 
  }
	750% {
    transform: scale(1) rotateY(-90deg); 

  }*/
  100% {
    transform: scale(1);
  }
}

@keyframes talk{
	0% { opacity: 0;
	}
	5% {
	 opacity:1;

	}
	95% {
	 opacity: 1;

	}
	100% {
	 opacity: 0;
	}
}
@keyframes talkEnd{
	0% { opacity: 0;
	}
	5% {
	 opacity:1;

	}
	100% {
	 opacity: 1;
	}
}

       
    </style>
</head>

<body class="d-flex h-100 text-center">


    <script src="https://www.google.com/recaptcha/api.js?hl=lt"></script>
    <!--	<script src="https://www.google.com/recaptcha/api.js" async defer></script>-->
    <!--	.container-->
    <div class="container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <div class="row">
            <?php echo((!empty($errorMessage)) ? $errorMessage : '') ?>
            <div class="col-lg-12 globe">
				<div class="cloud-1"></div>
				<div class="cloud-2"></div>
                <div class="center-custom d-flex mx-auto flex-column">
                    <h1 class="p-3">[ Agnytė ir Aurelijus ]</h1>
					<div class="text-content-aurelijus text-aurelijus-labas">Labas</div>
					<div class="text-content-aurelijus text-aurelijus-kvieciame">Birželio 18d. pranašauja puikią dieną</div>
					<div class="text-content-aurelijus text-aurelijus-detales">Detales rasi žemiau</div>
					<div class="text-content-agne text-agne-smagu">Ačiū, kad užsukai</div>
					<div class="text-content-agne text-agne-lauksime">Susitinkam?</div>
					<div class="text-content-agne text-agne-iki">Labai lauksime Tavo atsakymo, čiūz</div>
                    <img class="respinsive-img" src="https://slibinukas.lt/img/atvirute.svg" alt="My Happy SVG" />
                </div>
<!--				<div class="border-bottom"></div>-->
            </div>
        </div>
        <!--	startas start	.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="border-custom">
					<h1 class="hello">Startas</h1>
					<h1 class="hello">2022-06-18</h1>

                    					<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDM4LjUxNSAzOC41NDIiIGhlaWdodD0iMzguNTQycHgiIGlkPSJMYXllcl8xIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCAzOC41MTUgMzguNTQyIiB3aWR0aD0iMzguNTE1cHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxnPjxnPjxnPjxwYXRoIGQ9Ik0xMy4xODIsMzguNTQyQzguNDY3LDM4LjU0MywyLjM0NSwzNC43MTUsMC40MTEsMjguMzI1Yy0xLjYwNS01LjMwMiwxLjc0LTExLjgsNS43Ni0xNC43ODEgICAgIGM0Ljc4NS0zLjU0MywxNC4yNS0xLjk4MSwxOC4wODcsMi45ODdjMC4yNTMsMC4zMjcsMC4xOTIsMC43OTktMC4xMzUsMS4wNTJzLTAuNzk5LDAuMTkyLTEuMDUyLTAuMTM2ICAgICBjLTMuMzQyLTQuMzI3LTExLjg2OS01Ljc2My0xNi4wMDYtMi42OThDMy40NTIsMTcuNDI3LDAuNDMsMjMuMjEzLDEuODQ2LDI3Ljg5YzEuNzE0LDUuNjYzLDcuMzM5LDkuMjg1LDExLjU5Myw5LjE0OCAgICAgYzQtMC4xNDgsNy40NjUtMS41OTgsOS43NTktNC4wODFjMi4xNzEtMi4zNTMsMy4yMzctNS41MTEsMy4wODItOS4xMzRjLTAuMDMyLTAuNzU4LTAuMjctMS41MzItMC41MjItMi4zNTMgICAgIGMtMC4xMjQtMC40MDItMC4yNDctMC44MDUtMC4zNDgtMS4yMDljLTAuMTAxLTAuNDAxLDAuMTQ0LTAuODA5LDAuNTQ1LTAuOTA5YzAuNDAzLTAuMTA0LDAuODEsMC4xNDUsMC45MSwwLjU0NiAgICAgYzAuMDk1LDAuMzc4LDAuMjExLDAuNzU1LDAuMzI3LDEuMTMzYzAuMjY5LDAuODc0LDAuNTQ2LDEuNzc4LDAuNTg3LDIuNzI4YzAuMTcyLDQuMDMxLTEuMDMxLDcuNTYzLTMuNDc5LDEwLjIxNiAgICAgYy0yLjU2NiwyLjc3OS02LjQwNCw0LjM5OS0xMC44MDYsNC41NjJDMTMuMzkxLDM4LjU0MSwxMy4yODYsMzguNTQyLDEzLjE4MiwzOC41NDJ6Ii8+PC9nPjwvZz48Zz48Zz48cGF0aCBkPSJNMjcuMDI2LDM4LjA1OWMtMS4yOTEsMC0yLjY3NC0wLjE4OC00LjE2MS0wLjU1OWMtMC40MDItMC4xMDEtMC42NDYtMC41MDgtMC41NDYtMC45MDkgICAgIGMwLjEtMC40MDEsMC41MDYtMC42NTEsMC45MDktMC41NDZjNC45NTgsMS4yMzcsOC40NTMsMC4yNzIsMTEuMzM5LTMuMTI3YzIuMjkxLTIuNjk5LDMuMDI2LTUuOTc5LDIuMDE4LTguOTk5ICAgICBjLTAuOTkzLTIuOTc1LTMuNTA5LTUuMTIxLTYuOTA0LTUuODkxYy02LjE2LTEuMzkzLTEwLjY0LDEuMjkyLTExLjk4Niw3LjE4OGMtMC4yNzUsMS4yMDUsMC4yMDgsMi43MjcsMC42NzQsNC4xOTdsMC4xOTcsMC42MjggICAgIGMwLjE0OSwwLjQ4NSwwLjU2OSwwLjk2MSwxLjAxMywxLjQ2NWMwLjIzMSwwLjI2MywwLjQ2MywwLjUyNiwwLjY2NywwLjc5OGMwLjI0OSwwLjMzMiwwLjE4MSwwLjgwMi0wLjE1LDEuMDUgICAgIGMtMC4zMzEsMC4yNS0wLjgwMSwwLjE4My0xLjA1LTAuMTQ5Yy0wLjE4MS0wLjI0MS0wLjM4Ni0wLjQ3NC0wLjU5Mi0wLjcwN2MtMC41MjktMC42LTEuMDc3LTEuMjIxLTEuMzIxLTIuMDE1bC0wLjE5My0wLjYxNiAgICAgYy0wLjUwMy0xLjU4NS0xLjA3My0zLjM4MS0wLjcwNy00Ljk4NGMxLjUzMi02LjcwNiw2LjgxMS05Ljg5NiwxMy43NzktOC4zMTZjMy45MTgsMC44ODgsNi44MzMsMy4zOTUsNy45OTYsNi44NzggICAgIGMxLjE2MSwzLjQ3OCwwLjMwMiw3LjM4My0yLjI5NywxMC40NDVDMzMuMzMzLDM2LjY5MSwzMC41MTUsMzguMDU5LDI3LjAyNiwzOC4wNTl6Ii8+PC9nPjwvZz48Zz48Zz48cGF0aCBkPSJNMjcuNjAxLDEzLjY3M2MwLDAtMC4wMDEsMC0wLjAwMiwwYy0wLjQ2LDAtMC45LTAuMjE5LTEuMjA4LTAuNTk5bC02LjcxLTguMjg4Yy0wLjE0OC0wLjE4Mi0wLjE5Ni0wLjQxMy0wLjE1MS0wLjYyNiAgICAgYy0wLjA0MS0wLjE5NC0wLjAwNS0wLjQwNCwwLjExNy0wLjU4MWMwLjkwNS0xLjMxMiwxLjkzNS0yLjU1NywzLjMyNy0yLjc4N2MxLjA4My0wLjE3OCwyLjIzOCwwLjI0NCwzLjc1LDEuMzY4ICAgICBjMC4xODgsMC4xNCwwLjUzMSwwLjE1MywwLjcwNSwwLjAyNmwyLjQwNy0xLjc1YzAuNjg5LTAuNSwxLjc2Mi0wLjU4MSwyLjQ5NS0wLjE5YzEuODE0LDAuOTcxLDIuNjU3LDEuNzc1LDIuOTEsMi43NzcgICAgIGMwLjI3NSwxLjA5LTAuMjg0LDIuMTI1LTAuODAxLDIuOTA2Yy0xLjE3MywxLjc3MS0yLjUwNCwzLjM3NC00LjA0NSw1LjIyOWMtMC41MDgsMC42MTEtMS4wMzUsMS4yNDUtMS41OCwxLjkxNiAgICAgQzI4LjUwMiwxMy40NTYsMjguMDYxLDEzLjY3MywyNy42MDEsMTMuNjczeiBNMjEuMDg2LDQuMTM5bDYuNDcxLDcuOTkyYzAuNjQxLTAuNjc3LDEuMTcxLTEuMzE1LDEuNjgxLTEuOTMgICAgIGMxLjUxNC0xLjgyMywyLjgyMS0zLjM5NywzLjk1LTUuMWMwLjY2Ny0xLjAwNywwLjY2LTEuNDU4LDAuNTk2LTEuNzFjLTAuMTMyLTAuNTI0LTAuODE5LTEuMTAzLTIuMTYyLTEuODIyICAgICBjLTAuMjI2LTAuMTIxLTAuNjg0LTAuMDgtMC45MDYsMC4wODFMMjguMzExLDMuNGMtMC43MDIsMC41MTEtMS43NzEsMC40OTYtMi40ODQtMC4wMzZjLTEuMTQyLTAuODUtMS45NjYtMS4xOTUtMi42MDktMS4wOTEgICAgIEMyMi41OTYsMi4zNzUsMjEuOTUsMi45MzgsMjEuMDg2LDQuMTM5eiIvPjwvZz48L2c+PC9nPjwvc3ZnPg==" width="200" class="center-image" />
					
					<h2 class="huge">Santuokų rūmai</h2>

                    

                    <ul class="list-unstyled content-center">

                        <li><strong>Vieta:</strong> K. Kalinausko g. 21, Vilnius 03107</li>
						<li><hr /></li>
                        <li><strong>Laikas:</strong> 13:40</li>
                    </ul>
                    <iframe class="respinsive-iframe"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2306.5099988784036!2d25.26703851605848!3d54.68305248144755!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46dd94123975488b%3A0xc010691f7f2b690e!2sVilniaus%20m.%20civilin%C4%97s%20metrikacijos%20skyrius!5e0!3m2!1slt!2slt!4v1649509375728!5m2!1slt!2slt"
                        width="100%" height="" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <!--			.column-->
        </div>
        <!--	startas end	.row-->
 <!--	forest start	.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="border-custom light-bg">

                    <h1 class="hello">Pratęsimas</h1>
					<h2 class="huge">„Down Town Forest“</h2>
					<h3>su  arielka ir lengvais užkandžiais</h3>
<!--
                    <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgZGF0YS1uYW1lPSJMYXllciAxIiBpZD0iTGF5ZXJfMSIgdmlld0JveD0iMCAwIDEyOCAxMjgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHRpdGxlLz48cGF0aCBkPSJNNjIuNTIsNTEuNDUsMjcuODEsNDYuMzJhMSwxLDAsMCwwLTEuMTMuODRMMjQuMTIsNjQuNEExOC41MSwxOC41MSwwLDAsMCwzOC44OSw4NS4xNGwtMy4wOSwyMi4xLTE1LjEyLDMuNjFhMSwxLDAsMCwwLC4wOSwyTDUwLjM1LDExN2guMTRhMSwxLDAsMCwwLC41LTEuODdsLTEzLjIzLTcuNSwzLjExLTIyLjIxYy41OCwwLDEuMTYuMDksMS43NC4wOUExOC4zOSwxOC4zOSwwLDAsMCw2MC44LDY5LjgybDIuNTYtMTcuMjRhMSwxLDAsMCwwLS4xOS0uNzRBMSwxLDAsMCwwLDYyLjUyLDUxLjQ1Wm0tMzQtMywzMi43Miw0LjgzLTEuMzMsOUwyNy4xOCw1Ny4zOFptLTIuMjQsNjMuMTIsMTAuMS0yLjQxLDksNS4xM1ptMjYuMS0zMS4yNkExNi42LDE2LjYsMCwwLDEsMjYuMSw2NC42OWwuNzktNS4zMywzMi43Miw0Ljg2LS43OSw1LjNBMTYuMjksMTYuMjksMCwwLDEsNTIuMzcsODAuMzFaIi8+PHBhdGggZD0iTTM3LjY2LDc3LjYyYy04LjQ5LTQuMjQtNi41NC0xMy44NS02LjQ1LTE0LjI2YTEsMSwwLDAsMC0yLS40M2MwLC4xMi0yLjM4LDExLjU0LDcuNTIsMTYuNDhhMSwxLDAsMCwwLC40NS4xMSwxLDEsMCwwLDAsLjg5LS41NUExLDEsMCwwLDAsMzcuNjYsNzcuNjJaIi8+PHBhdGggZD0iTTkxLjI1LDc5LjUyYS45My45MywwLDAsMCwuNS0uMTRjOS4zOC01LjQyLDctMTYuMzQsNy0xNi40NWExLDEsMCwxLDAtMiwuNDRjLjA5LjM5LDIsOS42LTYsMTQuMjhhMSwxLDAsMCwwLC41LDEuODdaIi8+PHBhdGggZD0iTTU0LjI1LDI2LjdhMSwxLDAsMCwwLS41MywxLjkzYy4wOCwwLDcuOTMsMi4yMyw4LjM1LDEwLjI3YTEsMSwwLDAsMCwxLDFoMGExLDEsMCwwLDAsLjk1LTEuMDVDNjMuNTcsMjkuMzMsNTQuMzQsMjYuNzIsNTQuMjUsMjYuN1oiLz48cGF0aCBkPSJNODMuMTcsMzIuOGExLDEsMCwwLDAtMS0xYy0uMTMsMC0xMywuMTMtMTQuNSwxMC42NGExLDEsMCwwLDAsLjg1LDEuMTNoLjE0YTEsMSwwLDAsMCwxLS44NWMxLjI1LTguOCwxMi4wNi04LjkzLDEyLjUyLTguOTNBMSwxLDAsMCwwLDgzLjE3LDMyLjhaIi8+PHBhdGggZD0iTTc0LjI0LDQyLjQ4YTEsMSwwLDAsMCwuODUsMS4xM2guMTRhMSwxLDAsMCwwLDEtLjg2Yy4zNC0yLjQyLDMuNDktMi40NywzLjYyLTIuNDdhMSwxLDAsMCwwLDAtMkM3OC4xMSwzOC4yOSw3NC43MSwzOS4xNiw3NC4yNCw0Mi40OFoiLz48cGF0aCBkPSJNMTA3LjMyLDExMC44NSw5Mi4yLDEwNy4yNGwtMy4wOS0yMi4xQTE4LjUxLDE4LjUxLDAsMCwwLDEwMy44OCw2NC40bC0yLjU2LTE3LjI0YTEsMSwwLDAsMC0xLjEzLS44NEw2NS40OCw1MS40NWExLDEsMCwwLDAtLjY1LjM5LDEsMSwwLDAsMC0uMTkuNzRMNjcuMiw2OS44MUExOC4zOSwxOC4zOSwwLDAsMCw4NS4zOSw4NS41M2MuNTgsMCwxLjE2LDAsMS43NC0uMDlsMy4xMSwyMi4yMUw3NywxMTUuMTVhMSwxLDAsMCwwLC41LDEuODdoLjE0bDI5LjU4LTQuMmExLDEsMCwwLDAsLjA5LTJabS03LjgzLTYyLjQsMS4zMyw4LjkzTDY4LjEsNjIuMjVsLTEuMzMtOVpNNzUuNjMsODAuMzFhMTYuMjksMTYuMjksMCwwLDEtNi40NS0xMC43OWwtLjc5LTUuMywzMi43Mi00Ljg2Ljc5LDUuMzNBMTYuNiwxNi42LDAsMCwxLDc1LjYzLDgwLjMxWm03LDM0LDktNS4xMywxMC4xLDIuNDFaIi8+PHBhdGggZD0iTTY4LDQ4YTEsMSwwLDAsMCwwLTJoMGExLDEsMCwxLDAsMCwyWiIvPjxwYXRoIGQ9Ik01MC43NSwyOC4wOGExLDEsMCwwLDAsMC0yaDBhMSwxLDAsMCwwLTEsMUExLDEsMCwwLDAsNTAuNzUsMjguMDhaIi8+PHBhdGggZD0iTTQ4LjA2LDMyLjEzYTEsMSwwLDAsMCwxLjE3LS43OSwxLDEsMCwwLDAtLjc3LTEuMTdjLS4xNCwwLTMuMzYtLjY3LTUuNTMuNTRhMSwxLDAsMCwwLS4zOSwxLjM2LDEsMSwwLDAsMCwuODcuNTEsMS4wNywxLjA3LDAsMCwwLC40OS0uMTJBNy4xOSw3LjE5LDAsMCwxLDQ4LjA2LDMyLjEzWiIvPjxwYXRoIGQ9Ik03Ny44NSwyMmMwLS4wNS4xMS0uMy4xMy0uMzdsLjEtLjMzYTYuNTIsNi41MiwwLDAsMC0uNTctNC43OSw1Ljg2LDUuODYsMCwwLDAtMy42OS0yLjkyLDYsNiwwLDAsMC01LjM5LDEuMyw2LDYsMCwwLDAtNC4wNy0zLjc1LDYuMjQsNi4yNCwwLDAsMC03LjQ4LDQuNzFjMCwuMDYtLjA1LjIzLS4wNy4zMnMtLjA1LjMtLjA2LjM0Yy0uODIsNSw2LjM5LDEyLjY3LDcuMjEsMTMuNTNhMSwxLDAsMCwwLC43Mi4zMSwxLDEsMCwwLDAsLjMsMEM2Ni4xMiwzMCw3Ni4xNiwyNi43NSw3Ny44NSwyMlpNNzYsMjEuMzRjLTEuMDgsMy03LjgyLDUuODMtMTEsNi45QzYyLjcyLDI1Ljc2LDU4LjIsMjAsNTguNzMsMTYuODVsLjEtLjUyQTQuMzQsNC4zNCwwLDAsMSw2Mi45MSwxM2EzLjQ1LDMuNDUsMCwwLDEsMSwuMTMsNC4xMyw0LjEzLDAsMCwxLDMsNC4xMSwxLDEsMCwwLDAsMS44Ny40OSw0LjEzLDQuMTMsMCwwLDEsNC42MS0yLjE1LDMuOTIsMy45MiwwLDAsMSwyLjQ0LDEuOTQsNC41OCw0LjU4LDAsMCwxLC4zOSwzLjMybC0uMDcuMjNTNzYsMjEuMjgsNzYsMjEuMzRaIi8+PHBhdGggZD0iTTQ1LDQzLjc2bC4xNS4yM2MyLDIuODEsOS4wNywzLDkuODcsMy4wN2gwYTEsMSwwLDAsMCwuODktLjU0Yy4zNy0uNywzLjU5LTcsMi4xMi0xMC4wOWwtLjEzLS4yN0w1Ny44MiwzNmwwLDBhNC40Myw0LjQzLDAsMCwwLTYtMS43Miw0LjE5LDQuMTksMCwwLDAtMiwyLjksNC4yNCw0LjI0LDAsMCwwLTMuNTEuMzQsNC4xNiw0LjE2LDAsMCwwLTIsMi43Miw0LjUsNC41LDAsMCwwLC41MSwzLjNBMi4yNywyLjI3LDAsMCwwLDQ1LDQzLjc2Wm0xLjI5LTMuMTFhMi4xMywyLjEzLDAsMCwxLDIuMTEtMS43MywyLjUsMi41LDAsMCwxLDEuNzcuNzYsMSwxLDAsMCwwLDEuMjIuMTcsMSwxLDAsMCwwLC40NS0xLjE1LDIuMzYsMi4zNiwwLDAsMSwxLTIuNzMsMi40NCwyLjQ0LDAsMCwxLDMuMjcsMWwuODYtLjUxLS44Ni41Mi4xNC4yN2MuNzQsMS41Ni0uNjEsNS4zNy0xLjc5LDcuNzgtMi42Ny0uMTUtNi42Ni0uODItNy42Ni0yLjIybC0uMTgtLjI2QTIuNTgsMi41OCwwLDAsMSw0Ni4yOCw0MC42NVoiLz48L3N2Zz4="
                        width="200" />
-->
<!--					<img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjwhRE9DVFlQRSBzdmcgIFBVQkxJQyAnLS8vVzNDLy9EVEQgU1ZHIDEuMS8vRU4nICAnaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkJz48c3ZnIGVuYWJsZS1iYWNrZ3JvdW5kPSJuZXcgMCAwIDMzLjMxNSAzOC43NSIgaGVpZ2h0PSIzOC43NXB4IiBpZD0iTGF5ZXJfMSIgdmVyc2lvbj0iMS4xIiB2aWV3Qm94PSIwIDAgMzMuMzE1IDM4Ljc1IiB3aWR0aD0iMzMuMzE1cHgiIHhtbDpzcGFjZT0icHJlc2VydmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPjxnPjxnPjxnPjxwYXRoIGQ9Ik03LjMwMiwyNi4wNzdjLTAuMDIyLDAtMC4wNDQsMC0wLjA2NiwwYy0yLjQ2Mi0wLjAyMS02Ljg1My0zLjQ5MS02Ljg5MS01Ljk5NUMwLjI3NCwxNS40NTYsMC4yODcsMTAuNzI3LDAuMyw2LjE1NCAgICAgTDAuMzA5LDEuNzVDMC4zMDksMC43ODUsMS4wOTMsMCwyLjA1OCwwaDExLjcxYzAuNDc3LDAsMC45MTUsMC4xODgsMS4yMzUsMC41MjhzMC40OCwwLjc5MSwwLjQ1MSwxLjI2NkwxNS4xLDcuNDQzICAgICBjLTAuMDAyLDAuMDM3LTAuMDA3LDAuMDcyLTAuMDE0LDAuMTA3YzAuMDA5LDAuMDQzLDAuMDE0LDAuMDg4LDAuMDE2LDAuMTM1YzAuMDMsMS4xODEsMC4wNzYsMi4zNjEsMC4xMjEsMy41NDIgICAgIGMwLjEwNCwyLjY5OSwwLjIxMSw1LjQ5MSwwLjEzOCw4LjI0M0MxNS4yNywyMi44ODIsMTEuMzYzLDI2LjA3Niw3LjMwMiwyNi4wNzd6IE0yLjA1OCwxLjVjLTAuMTM4LDAtMC4yNDksMC4xMTItMC4yNDksMC4yNSAgICAgTDEuOCw2LjE1OGMtMC4wMTMsNC43NzctMC4wMjUsOS4yODksMC4wNDUsMTMuOTAxYzAuMDIyLDEuNTA0LDMuNjA4LDQuNTAxLDUuNDA0LDQuNTE3YzMuMTksMC4wNTYsNi41NDQtMi41NjksNi42MTEtNS4xNDUgICAgIGMwLjA3Mi0yLjcwNC0wLjAzMy01LjQ3LTAuMTM3LTguMTQ2Yy0wLjA0NS0xLjE4Ny0wLjA5MS0yLjM3NC0wLjEyMi0zLjU2MWMtMC4wMDEtMC4wNiwwLjAwNC0wLjExOCwwLjAxNi0wLjE3NCAgICAgYy0wLjAxNC0wLjA2NC0wLjAxOS0wLjEzMi0wLjAxNC0wLjIwMWwwLjM1NC01LjY0OGMwLjAwNC0wLjA3NC0wLjAyMy0wLjEyLTAuMDQ4LTAuMTQ2QzEzLjg4NiwxLjUzLDEzLjg0MiwxLjUsMTMuNzY4LDEuNUgyLjA1OCAgICAgeiIvPjwvZz48L2c+PGc+PGc+PHBhdGggZD0iTTI1Ljc5OCwyNS43NjRjLTEuODIyLDAtMy42NzctMC41NTktNS4xMjMtMS42MDNjLTEuNDkyLTEuMDc3LTIuMzM5LTIuNTIzLTIuMzg0LTQuMDcxICAgICBjLTAuMTMtNC41MTMtMC4xMDMtOS4xMjYtMC4wNzUtMTMuNTg4YzAuMDA5LTEuNTc3LDAuMDE5LTMuMTYxLDAuMDIxLTQuNzUzQzE4LjIzOSwwLjc4NSwxOS4wMjQsMCwxOS45ODgsMGgxMS4wNDggICAgIGMwLjQ3NSwwLDAuOTEzLDAuMTg3LDEuMjM0LDAuNTI2YzAuMzIxLDAuMzM5LDAuNDg1LDAuNzg3LDAuNDYsMS4yNjJsLTAuMzE4LDUuOTU4Yy0wLjAwMiwwLjA0LTAuMDA3LDAuMDc4LTAuMDE2LDAuMTE1ICAgICBjMC4wMDcsMC4wMjksMC4wMTEsMC4wNTgsMC4wMTQsMC4wODdjMC4wOTQsMS4wNCwwLjIwMSwyLjA3OCwwLjMwOSwzLjExN2MwLjI0LDIuMzI4LDAuNDg5LDQuNzM2LDAuNTgzLDcuMTIzICAgICBjMC4xNjcsNC4xNTgtMS4xNzcsNi4wNTItNS4xMzQsNy4yMzhDMjcuNDEsMjUuNjUzLDI2LjYwNywyNS43NjQsMjUuNzk4LDI1Ljc2NHogTTE5Ljk4OCwxLjVjLTAuMTM4LDAtMC4yNTEsMC4xMTMtMC4yNTEsMC4yNTEgICAgIGMtMC4wMDMsMS41OTQtMC4wMTMsMy4xOC0wLjAyMSw0Ljc1OWMtMC4wMjgsNC42NTMtMC4wNTUsOS4wNDksMC4wNzUsMTMuNTM2YzAuMDMsMS4wNywwLjY1NiwyLjEsMS43NjIsMi44OTcgICAgIGMxLjcyNSwxLjI0NCw0LjE0OSwxLjY1Niw2LjE4NCwxLjA0NWMzLjI5My0wLjk4Nyw0LjIwNi0yLjI3NSw0LjA2Ny01Ljc0MmMtMC4wOTMtMi4zNC0wLjMzOS00LjcyNC0wLjU3Ny03LjAyOSAgICAgYy0wLjEwNy0xLjA0NS0wLjIxNi0yLjA5LTAuMzExLTMuMTM1Yy0wLjAwNy0wLjA3Ny0wLjAwMi0wLjE1MiwwLjAxMy0wLjIyM2MtMC4wMTMtMC4wNjMtMC4wMTktMC4xMjgtMC4wMTUtMC4xOTVsMC4zMTgtNS45NTcgICAgIGMwLjAwNC0wLjA3Ni0wLjAyNS0wLjEyNC0wLjA1MS0wLjE1QzMxLjE1NywxLjUzMSwzMS4xMTEsMS41LDMxLjAzNiwxLjVIMTkuOTg4eiIvPjwvZz48L2c+PGc+PGc+PHBhdGggZD0iTTcuNTUxLDIzLjYwNGMtMC4zMjQsMC0wLjYyMi0wLjIxMS0wLjcxOS0wLjUzN2MtMC4xMTgtMC4zOTcsMC4xMDgtMC44MTQsMC41MDYtMC45MzIgICAgIGMzLjU5MS0xLjA2Myw0LjA1MS0xLjY0Myw0LjA5Ni01LjE2NWMwLjAxNy0xLjI3MSwwLjAxMi0yLjU0MiwwLjAwOC0zLjgxM2wtMC4wMDQtMS43NDFjMC0wLjQxNCwwLjMzNi0wLjc1LDAuNzUtMC43NSAgICAgczAuNzUsMC4zMzYsMC43NSwwLjc1bDAuMDA0LDEuNzM2YzAuMDA0LDEuMjc5LDAuMDA4LDIuNTU4LTAuMDA4LDMuODM2Yy0wLjA1NCw0LjE3Mi0wLjk3Miw1LjM0MS01LjE3LDYuNTg0ICAgICBDNy42OTIsMjMuNTk0LDcuNjIxLDIzLjYwNCw3LjU1MSwyMy42MDR6Ii8+PC9nPjwvZz48Zz48Zz48cGF0aCBkPSJNMTQuMDQyLDguMTQ2Yy0wLjAwNiwwLTAuMDEzLDAtMC4wMTksMEwxLjY1OCw3LjgzOEMxLjI0NCw3LjgyNywwLjkxNyw3LjQ4MywwLjkyNyw3LjA2OSAgICAgYzAuMDExLTAuNDA4LDAuMzQ0LTAuNzMxLDAuNzUtMC43MzFjMC4wMDYsMCwwLjAxMywwLDAuMDE5LDBsMTIuMzY1LDAuMzA5YzAuNDE0LDAuMDExLDAuNzQxLDAuMzU0LDAuNzMxLDAuNzY5ICAgICBDMTQuNzgxLDcuODIzLDE0LjQ0OCw4LjE0NiwxNC4wNDIsOC4xNDZ6Ii8+PC9nPjwvZz48Zz48Zz48cGF0aCBkPSJNMzEuMzUzLDguNDU1Yy0wLjAwNiwwLTAuMDEzLDAtMC4wMiwwTDE5LjU4Nyw4LjE0NmMtMC40MTQtMC4wMTEtMC43NDEtMC4zNTUtMC43My0wLjc3ICAgICBjMC4wMTEtMC40MTUsMC4zNjEtMC43NTIsMC43Ny0wLjcyOWwxMS43NDYsMC4zMDljMC40MTQsMC4wMTEsMC43NDEsMC4zNTUsMC43MywwLjc2OUMzMi4wOTIsOC4xMzIsMzEuNzU4LDguNDU1LDMxLjM1Myw4LjQ1NXoiLz48L2c+PC9nPjxnPjxnPjxwYXRoIGQ9Ik0yNS43ODgsMzcuODIyYy0wLjM5NiwwLTAuNzI3LTAuMzExLTAuNzQ4LTAuNzFsLTAuNjE4LTExLjc0N2MtMC4wMjEtMC40MTQsMC4yOTYtMC43NjcsMC43MS0wLjc4OCAgICAgYzAuNDAxLTAuMDIxLDAuNzY2LDAuMjk1LDAuNzg4LDAuNzFsMC42MTgsMTEuNzQ2YzAuMDIxLDAuNDE0LTAuMjk2LDAuNzY3LTAuNzEsMC43ODkgICAgIEMyNS44MTUsMzcuODIyLDI1LjgwMiwzNy44MjIsMjUuNzg4LDM3LjgyMnoiLz48L2c+PC9nPjxnPjxnPjxwYXRoIGQ9Ik0yNi4yNjEsMjIuOTg3Yy0wLjA2MywwLTAuMTI1LTAuMDAxLTAuMTg4LTAuMDAzYy0wLjQxNC0wLjAxNC0wLjczOC0wLjM2MS0wLjcyNS0wLjc3NSAgICAgYzAuMDE0LTAuNDA1LDAuMzQ3LTAuNzI1LDAuNzUtMC43MjVjMC4wMDgsMCwwLjAxNywwLDAuMDI1LDBjMS40OTYsMC4wNDcsMi4zNzUtMC42NzIsMi41OTUtMi4xNDggICAgIGMwLjI0OS0xLjY4NiwwLjM3LTMuNDM2LDAuNDg3LTUuMTI4YzAuMDUxLTAuNzQ2LDAuMTAzLTEuNDkyLDAuMTY1LTIuMjM3YzAuMDM0LTAuNDEzLDAuNC0wLjcxLDAuODEtMC42ODUgICAgIGMwLjQxMiwwLjAzNSwwLjcyLDAuMzk3LDAuNjg1LDAuODFjLTAuMDYyLDAuNzM3LTAuMTEyLDEuNDc3LTAuMTYzLDIuMjE2Yy0wLjExOSwxLjcyMS0wLjI0MiwzLjUtMC40OTksNS4yNDQgICAgIEMyOS44ODIsMjEuNzE2LDI4LjQxNCwyMi45ODcsMjYuMjYxLDIyLjk4N3oiLz48L2c+PC9nPjxnPjxnPjxwYXRoIGQ9Ik03LjU1MSwzNy44MjJjLTAuNDA1LDAtMC43MzgtMC4zMjItMC43NS0wLjcyOUw2LjQ5MiwyNS42NTVjLTAuMDExLTAuNDE0LDAuMzE1LTAuNzU5LDAuNzI5LTAuNzcgICAgIGMwLjM5OC0wLjA0LDAuNzYsMC4zMTUsMC43NzEsMC43MjlsMC4zMDksMTEuNDM3YzAuMDExLDAuNDE0LTAuMzE1LDAuNzU5LTAuNzI5LDAuNzdDNy41NjQsMzcuODIyLDcuNTU4LDM3LjgyMiw3LjU1MSwzNy44MjJ6Ii8+PC9nPjwvZz48Zz48Zz48cGF0aCBkPSJNMTQuOTY5LDM4LjQ0MUgwLjc1Yy0wLjQxNCwwLTAuNzUtMC4zMzYtMC43NS0wLjc1czAuMzM2LTAuNzUsMC43NS0wLjc1aDE0LjIxOWMwLjQxNCwwLDAuNzUsMC4zMzYsMC43NSwwLjc1ICAgICBTMTUuMzgzLDM4LjQ0MSwxNC45NjksMzguNDQxeiIvPjwvZz48L2c+PGc+PGc+PHBhdGggZD0iTTE4LjY4LDM4Ljc1Yy0wLjQwNiwwLTAuNzQtMC4zMjUtMC43NS0wLjczM2MtMC4wMDktMC40MTQsMC4zMTktMC43NTcsMC43MzMtMC43NjdsMTMuNjAxLTAuMzA5ICAgICBjMC40NTYsMC4wMTgsMC43NTcsMC4zMTksMC43NjcsMC43MzNjMC4wMDksMC40MTQtMC4zMTksMC43NTctMC43MzMsMC43NjdMMTguNjk2LDM4Ljc1QzE4LjY5LDM4Ljc1LDE4LjY4NiwzOC43NSwxOC42OCwzOC43NXoiLz48L2c+PC9nPjwvZz48L3N2Zz4=" width="200" class="center-image" />-->


                    <img class="forestas" src="https://slibinukas.lt/img/forest1.jpg" />

                    
<img src="https://slibinukas.lt/img/sneakers.png"
                        width="300" />
<!--					<h2 class="huge">Kedai + Pieva = <i class="bi bi-emoji-sunglasses huge"></i></h2>-->
					<h1>Kedai + Pieva</h1>
                    <ul class="list-unstyled content-center">

                        <li><strong>Vieta:</strong> Paupio g. 31А, Vilnius 11341</li>
						<li><hr /></li>
                        <li><strong>Laikas:</strong> 16:00</li>
                    </ul>
<iframe class="respinsive-iframe" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9227.21224589478!2d25.3022342!3d54.6778946!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xfc90938118d926d9!2sDowntown%20Forest%20Hostel%20%26%20Camping!5e0!3m2!1slt!2slt!4v1649624507612!5m2!1slt!2slt" width="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <!--			.column-->
        </div>
        <!--	forest end	.row-->

        <!-- forma start -->
        <div class="row">
            <div class="col-lg-12">
                <h1>Pranešk mums ar atvyksi</h1>
                <form action="/index.php" method="post" id="contact-form" class="content-center" autocomplete="off">

                    <div class="form-floating mb-3">

                        <input name="name" id="name" class="form-control" type="text" autocomplete="off"
                            placeholder="Jūsų vardas:">
                        <label for="name" class="floatingInput">Tavo vardas:</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input name="guest" class="form-control" id="guest" type="text" autocomplete="off"
                            placeholder="Poros vardas:">
                        <label for="guest" class="floatingInput">Tavo poros vardas:</label>
                    </div>
                    <div class="form-check mb-5 mt-5 text-start">
                        <input class="form-check-input" type="checkbox" name="kids" value="Taip" id="kids">
                        <label class="form-check-label" for="kids">
                            Atkeliausime su vaiku/vaikais
                        </label>
                    </div>
                    <hr class="mb-5"  />
                    <h2 class="text-start">Kur pasimatysime?</h2>
                    <div class="form-check mb-3 text-start">
                        <input class="form-check-input" type="radio" name="valio" value="Santuokų rūmmai" id="startas">
                        <label class="form-check-label" for="startas">
                            Startas - Santuokų rūmai
                        </label>
                    </div>

                    <div class="form-check mb-3 text-start">
                        <input class="form-check-input" type="radio" name="valio" value="Vakarėlis terasoje"
                            id="terasa">
                        <label class="form-check-label" for="terasa">
                            Pratęsimas terasoje
                        </label>
                    </div>
                    <div class="form-check mb-5 text-start">
                        <input class="form-check-input" type="radio" checked name="valio" value="Nuo pradžių iki galo"
                            id="valio">
                        <label class="form-check-label" for="valio">
                            Nuo starto iki finišo!
                        </label>
                    </div>
					<hr />
                    <div class="mb-3 mt-5">
						
                        <textarea name="message" class="form-control" id="message" autocomplete="off"
                            placeholder="Komentaras:"  rows="4" cols="50"></textarea>
                        
                    </div>

                    <div class="mb-5 mt-5">
                        <button class="g-recaptcha btn btn-custom btn-lg" type="submit"
                            data-sitekey="6LcgzV4fAAAAAMYhauELG8W8LLnsTrAK0P3028jy" data-callback='onRecaptchaSuccess'>
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
                presence: {
                    allowEmpty: false
                }
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

        function onRecaptchaSuccess() {
            document.getElementById('contact-form').submit()
        }
    </script>
</body>

</html>
