<?php
/**
 * sysPass
 *
 * @author    nuxsmin
 * @link      http://syspass.org
 * @copyright 2012-2017, Rubén Domínguez nuxsmin@$syspass.org
 *
 * This file is part of sysPass.
 *
 * sysPass is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * sysPass is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 *  along with sysPass.  If not, see <http://www.gnu.org/licenses/>.
 */

use SP\Bootstrap;

require __DIR__ . DIRECTORY_SEPARATOR . 'BaseFunctions.php';

defined('APP_ROOT') || die();
defined('APP_MODULE') || define('APP_MODULE', 'web');

define('BASE_PATH', __DIR__);
define('APP_PATH', APP_ROOT . DIRECTORY_SEPARATOR . 'app');

// Please, notice that this file should be outside the webserver root. You can move it and then update this path
define('CONFIG_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'config');

// Setup config files
define('CONFIG_FILE', CONFIG_PATH . DIRECTORY_SEPARATOR . 'config.xml');
define('ACTIONS_FILE', CONFIG_PATH . DIRECTORY_SEPARATOR . 'actions.xml');
define('OLD_CONFIG_FILE', CONFIG_PATH . DIRECTORY_SEPARATOR . 'config.php');
define('LOG_FILE', CONFIG_PATH . DIRECTORY_SEPARATOR . 'syspass.log');

// Setup application paths
define('MODULES_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'modules');
define('LOCALES_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'locales');
define('BACKUP_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'backup');
define('CACHE_PATH', APP_PATH . DIRECTORY_SEPARATOR . 'cache');

// Setup other paths
define('VENDOR_PATH', APP_ROOT . DIRECTORY_SEPARATOR . 'vendor');
define('SQL_PATH', APP_ROOT . DIRECTORY_SEPARATOR . 'schemas');
define('PUBLIC_PATH', APP_ROOT . DIRECTORY_SEPARATOR . 'public');

define('DEBUG', true);

// Empezar a calcular la memoria utilizada
$memInit = memory_get_usage();

require VENDOR_PATH . DIRECTORY_SEPARATOR . 'autoload.php';
require __DIR__ . DIRECTORY_SEPARATOR . 'SplClassLoader.php';

initModule(APP_MODULE);

try {
    (new Bootstrap())->initialize();
} catch (\Exception $e) {
    debugLog($e->getMessage());
    debugLog($e->getTraceAsString());

    die($e->getMessage());
} catch (\Psr\Container\ContainerExceptionInterface $e) {
    debugLog($e->getMessage());
    debugLog($e->getTraceAsString());

    die($e->getMessage());
}