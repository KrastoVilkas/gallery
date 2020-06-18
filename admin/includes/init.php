<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT','C:'. DS . 'xampp' . DS. 'htdocs' . DS. 'gallery');
define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');
define('IMAGES_PATH', SITE_ROOT.DS.'admin'.DS.'images');

require_once(INCLUDES_PATH.DS."functions.php");
require_once(INCLUDES_PATH.DS."new_config.php");
require_once(INCLUDES_PATH.DS."database.php");
require_once(INCLUDES_PATH.DS."db_object.php");
//User class still good because of the functions.php included first (when it was commented out)
require_once(INCLUDES_PATH.DS."photo.php");
require_once(INCLUDES_PATH.DS."user.php");
require_once(INCLUDES_PATH.DS."comment.php");
require_once(INCLUDES_PATH.DS."session.php");
require_once(INCLUDES_PATH.DS."paginate.php");





 ?>
