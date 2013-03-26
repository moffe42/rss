<?php
namespace RSS;

class FeedParser
{
	public function parse($feedurl)
	{
		// Grab feed
		$feedcontent = file_get_contents($feedurl);
		$sxmle = new \SimpleXMLElement($feedcontent);

		$attributes = $sxmle->attributes();
		$version = (string)$attributes['version'];

		switch ($version) {
			case '2.0':
				$feed = $this->parseRSS20($sxmle);
				break;
			default:
				throw \RSS\Exception('RSS version not recognized');
		}

		return $feed;
	}

	public function parseRSS20(\SimpleXMLElement $sxmle)
	{
		// Validate feed
		// @TODO Not implemented yet 
		$validator = new \RSS\FeedValidator();
		if (!$validator->validate()) {
			return false;
		}

		// Parse feed info
		$feed = new \RSS\Feed();
		$feed->title	   = (string)$sxmle->channel->title;
		$feed->description = (string)$sxmle->channel->description;
		$feed->link		   = (string)$sxmle->channel->link;

		// Parse items
		$items = array();
		foreach ($sxmle->channel->item AS $item) {
			$newitem = new \RSS\Item();
			$newitem->title		  = (string)$item->title;
			$newitem->description = (string)$item->description;
			$newitem->link		  = (string)$item->link;
			$newitem->guid		  = (string)$item->guid;
			$items[] = $newitem;
		}
		$feed->items = $items;

		return $feed;
	}
}
