<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'wp_gptrio' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ';T_4xzdB> :30a KM#B.yr{=|]=l-Dk/+INT_4pa]FKbpJ!tvK2B_bTBU1ogFI~R' );
define( 'SECURE_AUTH_KEY',  'hlpc)s?vACXb`sd$FZ?Qg|gc+97j|tg.EvgobhHC {n_:Sw.=;GGygXneu??kvY^' );
define( 'LOGGED_IN_KEY',    '&y+bF(X(lnbiGeg}EJcjLh=^J7Br@m)xmMc25fVrG8d^wU] 5lN-LgB]!Kw.|3XT' );
define( 'NONCE_KEY',        'W7aUhA6%9a!?Pn!=rW~Qk[Lz >4;RCNZDvlP<`#k(=EJn9=qaNih|8~Q28m>Sg#b' );
define( 'AUTH_SALT',        '8f?0!70!/mTMXk`*jBcqiQ~@8u5T3uik9PaYMc(?TvV%!b#>o;vEO3lJjW*Ox+(J' );
define( 'SECURE_AUTH_SALT', 'Nkxgy+fkt3<I9m8KnP_}Ojf#MRdVWbg_Bbc,Ra/P?!a8KsYv;V{>fEVvY>H-M2Xi' );
define( 'LOGGED_IN_SALT',   '*!1GpUHt>%)w+tM30yG0zN[v=}78 =^`Y|:av{!IpwZt|>R}7q]<FGkmtgd0,Vb[' );
define( 'NONCE_SALT',       ']<~}^P1`Bn7$S7J#_QI1fRrPE:FN1~;z9l|?4C>mH]2dGeH %IHoL{&=V+El/}]_' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
