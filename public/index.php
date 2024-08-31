<?php


require __DIR__.'/../src/vendor/autoload.php';

use Predis\Client;
use Dotenv\Dotenv;

// Carregue as variáveis de ambiente - safe
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

// Crie uma nova instância do cliente Predis
$redis = new Client([
    'scheme'    => $_ENV['REDIS_SCHEME'],    // Utilizar variáveis de ambiente diretamente
    'host'      => $_ENV['REDIS_HOST'],
    'port'      => $_ENV['REDIS_PORT'],
    'password'  => $_ENV['REDIS_PASSWORD'],  // Corrija o caminho se necessário
]);

// Teste a conexão
try {
    $redis->ping();
    echo "Conexão bem-sucedida!";

   
    //insere um valor no redis
    $redis->set('name', 'Redis');
    
    //recupera o valor do redis
    $value = $redis->get('name');
    echo "Valor do Redis: " . $value;

} catch (Exception $e) {
    echo "Falha na conexão: " . $e->getMessage();
}


?>