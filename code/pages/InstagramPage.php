<?php

/**
 * Defines the InstagramPage page type
 */

class InstagramPage extends Page {

	private static $add_action = 'a Instagram Page';
	private static $allowed_children = "none";

	private static $db = array(
		'InstagramLink' => 'Varchar(255)',
		'InstagramSearchTerm' => 'Varchar(255)',
		'InstagramItemsCount' => 'Int',
		'InstagramApiKey' => 'Varchar(255)',
		'InstagramApiSecret' => 'Varchar(255)',
		'InstagramApiCallback' => 'Varchar(255)'
	);

	private static $has_one = array();

	private static $defaults = array (
		'InstagramApiCallback' => '/',
		'InstagramItemsCount' => '26',
		'InstagramSearchTerm' => 'beach'
	);

	function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab("Root.Settings", new TextField('InstagramSearchTerm', 'Instagram Search Term'));
		$fields->addFieldToTab("Root.Settings", new TextField('InstagramItemsCount', 'Instagram Items Count'));

		$fields->addFieldToTab("Root.Settings", new TextField('InstagramApiKey', 'Instagram ApiKey'));
		$fields->addFieldToTab("Root.Settings", new TextField('InstagramApiSecret', 'Instagram ApiSecret'));
		$fields->addFieldToTab("Root.Settings", new TextField('InstagramApiCallback', 'Instagram ApiCallback'));

		return $fields;
	}

}

class InstagramPage_Controller extends Page_Controller {

	public static $allowed_actions = array();

	function init(){
		parent::init();
	}

	public function InstaTagMedia($tag=false , $num=false, $shuffle=true) {
		$instagram = new Instagram(array(
			'apiKey' => $this->InstagramApiKey,
			'apiSecret' => $this->InstagramApiSecret,
			'apiCallback' => $this->InstagramApiCallback
		));

		if (!$tag) {
			$tag = $this->InstagramSearchTerm;
		}
		if (!$num) {
			$tag = $this->InstagramItemsCount;
		}

		$media = false;
		$output = false;
		$out = array();

		try {
			$media = $instagram->getTagMedia($tag, 50);
		} catch (Exception $e) {
			SS_Log::log(new Exception(print_r($e, true)), SS_Log::ERR);
		}

		if ($media) {
			foreach ($media->data as $data) {
				$item = array(
					'caption' => $data->caption->text,
					'thumb' => $data->images->thumbnail->url,
					'image' => $data->images->standard_resolution->url,
					'username' => $data->user->username
				);
				array_push($out, $item);
			}

			if ($shuffle) {
				shuffle($out);
			}

			$output = ArrayList::create($out);
			$output = $output->limit($num);
		}

		return $output;
	}

	public function CacheTimedReset($min=5) {
		return (int)(time() / 60 / $min); // Returns a new number every five minutes
	}


}
