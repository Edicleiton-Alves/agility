<?php
$conDB = new Classes\ConDB;
$getConf = new Classes\Metodos($conDB);

$getConf = $getConf
	->table('tb_configuracoes')
	->get();

define('CONFIGURACAO', [
	'cnpj' => $getConf[0]->cnpj,
	'email' => $getConf[0]->email,
	'facebook' => $getConf[0]->facebook,
	'instagram' => $getConf[0]->instagram,
	'linkedin' => $getConf[0]->linkedin,
	'youtube' => $getConf[0]->youtube,
	'google_play' => $getConf[0]->google_play,
	'app_store' => $getConf[0]->app_store,
	'area_cliente' => $getConf[0]->area_cliente,
	'whatsapp' => $getConf[0]->whatsapp
]);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="theme-color" content="#075600">
	<meta name="apple-mobile-web-app-status-bar-style" content="#075600">
	<meta name="msapplication-navbutton-color" content="#075600">
	<meta name="facebook-domain-verification" content="5oorqct37lonfv00350tyf6duzunui" />
	<link rel="icon" href="/img/favicon.png" type="image/x-icon">
	<title>Início | Agility Telecom</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Manrope:wght@200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	<style>
		<?php
		require 'header/css/header.css';
		require 'main/css/main.css';
		require 'footer/css/footer.css';
		?>
	</style>
</head>

<body>
	<?php
	require_once 'header/header.php';
	require_once 'main/main.php';
	require_once 'footer/footer.php';
	?>
	<script type="text/javascript" src="/js/jquery-3.6.1.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript" src="/js/swiper-bundle.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAip-QesZTgTNaIZ21zKK4cv9GspTQA6p0" defer></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
	<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
	<script>
		! function(f, b, e, v, n, t, s) {
			if (f.fbq) return;
			n = f.fbq = function() {
				n.callMethod ?
					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n;
			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement(e);
			t.async = !0;
			t.src = v;
			s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1349392152818432');
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
			src="https://www.facebook.com/tr?id=1349392152818432&ev=PageView&noscript=1" /></noscript>
	<script>
		new window.VLibras.Widget('https://vlibras.gov.br/app');
	</script>

	<script type="text/javascript">
		"use strict";
		$(document).ready(function() {
			<?php
			require 'header/js/header.js';
			require 'main/js/main.js';
			require 'footer/js/footer.js';
			?>
		});
	</script>

</body>

</html>