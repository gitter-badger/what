<?php 
defined('_JEXEC') or die;
require_once('_define.php');
require_once('vendor/autoload.php');

use Antfuentes\Titan\Joomla;
use Antfuentes\Titan\Framework;
use Pelago\Emogrifier;
use MatthiasMullie\Minify;

$minifier = new Minify\JS(__DIR__.'/bower/jquery/dist/jquery.min.js');
$minifier->add(__DIR__.'/bower/matchHeight/jquery.matchHeight-min.js');
$minifier->add(__DIR__.'/bower/jquery.tap/jquery.tap.min.js');
$minifier->add(__DIR__.'/bower/gsap/src/minified/jquery.gsap.min.js');
$minifier->add(__DIR__.'/bower/gsap/src/minified/easing/EasePack.min.js');
$minifier->add(__DIR__.'/bower/gsap/src/minified/plugins/CSSPlugin.min.js');
$minifier->add(__DIR__.'/bower/gsap/src/minified/TweenLite.min.js');
$minifier->add(__DIR__.'/bower/leviathan/src/js/init.js');
$minifier->add(__DIR__.'/scripts/app.js');

$minifier->minify(__DIR__.'/scripts/load.js');

$router = new Joomla\Router();
$menu = new Joomla\Menu();
$db = new Joomla\Database();
$emogrifier = new Pelago\Emogrifier();
$string = new Framework\String();

$router->load(JRequest::getVar('id'), ROUTE, JRequest::getVar('option'), JRequest::getVar('view'), JRequest::getVar('layout'), JFactory::getConfig(), JUri::getInstance(), JURI::base());
$emogrifier->setHtml($router->init());
$emogrifier->setCss(file_get_contents(__DIR__.'/css/load.css'));
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<?php
		$router->meta();
	?>
  </head>
  <body>
    <?php
		if($router->routerView <> 'categories'){
			$menu->build('intromenu', 'i', 1);
			$db->tables();
			$result = $db->q("SELECT * FROM $db->categories WHERE id = '$router->categoryParentId'");
			$menu->build($result[0]['alias'], 'i', $router->routerId);
		}
		echo $emogrifier->emogrify();
	?>
	<script>
		<?php echo file_get_contents(__DIR__.'/scripts/load.js'); ?>
	</script>
  </body>
</html>