<?php
include 'Bootstrap.php';

$url = '../data/rss2.xml';

$feedparser = new \RSS\FeedParser();

$feed = $feedparser->parse($url);

var_dump($feed);
