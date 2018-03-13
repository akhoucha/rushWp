<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'db_database');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '123456');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'iw-`iqJV9=9Q,`PL00}+~nk3vwvSEx0z66ouTZtRp6;d/a8JEBt(sm&~}U,71m!_');
define('SECURE_AUTH_KEY',  '1b3Uo&d;)fe7|J#Jbc{9lcrDG81?m=fnz>P<[:[fHYcZsbNA&v^].!-:RgQomhk~');
define('LOGGED_IN_KEY',    'S[7>2aLqtOm@yQ_/9n}P4:];PGZb1X`G-$Z5< 6yz@py~wKfJ#(w^6,%E?v:Ed#Y');
define('NONCE_KEY',        '3(o%M%1wqz>5PX/x=1t93Fl%=-6;vp<bE^qu1}3s_H_|; =^OwyxjIR(2JAd/S>v');
define('AUTH_SALT',        '*=U`i%T6q7jG,>.1Qm(1!Jt^2+mX|.D}1{KmwKam^45zK-MX?8N_WsImf& &{pUF');
define('SECURE_AUTH_SALT', 'hgS^M4_H1c1}u<G-YHW:xCsLYW3dc-4L&l4G`o!:>G`hS(cls:GAA#vdOTmOd<zP');
define('LOGGED_IN_SALT',   'KV;RoPjHd?F:sGmWMe~pRCZaW@)5)vu1#,J4<T4`*(:bbp8>+wSWQ@B3&-8_ozGs');
define('NONCE_SALT',       'e^n[!BS4<<^q~a>F=% r[J)Y;0PHL55lTU^v1SCEcT-_Gds{P5(9^G$q2WWmi:OY');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');