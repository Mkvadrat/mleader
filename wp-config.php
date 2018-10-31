<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'mleader');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '1234');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

//папка загрузки xml
define('WP_EXPORT', 'http://' . $_SERVER['HTTP_HOST'] . '/wp-export/export.xml');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/MtLtJmLRMA3mO=>@#@Gx/OD,3Nan}TDJn-:bN_*Sk)M<y}[ri|`T-B8]).%n4I]');
define('SECURE_AUTH_KEY',  'U+u=TlU}&eA5-X z6>(0H%9]`CB)c]<{yWFfE]s-m9E(*ca^vyQ$vrHHAG93,8kg');
define('LOGGED_IN_KEY',    'aET}3fh&Ryn-AdbTlyOgFb+ O!>_tSiY~ra{Ky}JojxY1;ErlbXZR&&EUrl9#@zu');
define('NONCE_KEY',        'N83wC r&(nV*t$}SBtA~HQ4^eJPm(l}0uj9D1d4p$?,=5bu ,}WQ:RMgR]a*n2S ');
define('AUTH_SALT',        'ZC}V:t.SK-h8K$|85L7MiG^.|[qe6LaP-UC[86-+<RT^C:)6z,::s<2;+$8Thyu`');
define('SECURE_AUTH_SALT', '$rn?WCpiCq5/)l3M=Q$^tLqK9XIZ{5,J=y:0c0HOD_7ihA(/rroNKAxcwP4)*wST');
define('LOGGED_IN_SALT',   '.M8*)#Cz^OaIzw0r/Aig_4-iOAE1=qztu-FdvB+a?^EZTzRiU<gGgwzvc9BMOQ]%');
define('NONCE_SALT',       'JZ?&@B<F3m[Y79q5~QV24$G<l/u&BQeFIJxxpGq0:^@j5FhU8tt1kRYS2V9R7hNK');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'mldr_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
