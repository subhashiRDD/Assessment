<?php


include './request.php';
include './cache.php';

$photos = [];
$redisClient = new cacheService();
//$redisClient-> clearallCache();
$photos = $redisClient->getCache('photos');


if (!$photos) {

    echo "Displaying data from REST API server <br>";
    $photos = SimpleJsonRequest::get('https://jsonplaceholder.typicode.com/photos');
    $redisClient->setCache('photos', $photos, 60 * 60 * 24);

}

foreach($photos as $photo) {
    echo "<strong> albumId:</strong> $photo->albumId <br>";
    echo "<strong> id:</strong>  $photo->id <br>";
    echo "<strong> title:</strong>  $photo->title <br>";
    echo "<strong> url:</strong>  $photo->url <br>";
    echo "<strong> thumbnailUrl:</strong>  $photo->thumbnailUrl <br>";
    echo "<br>";
}
?>