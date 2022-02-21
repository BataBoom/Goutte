<?php
require __DIR__ . '/../vendor/autoload.php';
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

$client = new Client();
$crawler = $client->request('GET', 'https://www.sherdog.com/events/UFC-271-Adesanya-vs-Whittaker-2-90742');
// Get the latest post in this category and display the titles
for ($i = 2; $i < 11; ++$i) {
$crawler->filter('tr:nth-of-type('.$i.') .left span[itemprop="name"]')->each(function ($node) {
//    print $node->text();
$inp = file_get_contents('winners.json');
$tempArray = json_decode($inp);
array_push($tempArray, $node->text());
$jsonData = json_encode($tempArray);
file_put_contents('winners.json', $jsonData);
});
}
