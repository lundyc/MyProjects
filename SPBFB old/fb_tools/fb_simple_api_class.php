<?php

   # ========================================================================#
   #
   #  Author:    Jarrod Oberto
   #  Version:	 1.1
   #  Date:      Jul 11
   #  Purpose:   Provides album gallery functionality
   #  Project:	 Facebook Graph API	
   #  Param In:  See functions.
   #  Param Out: n/a
   #  Requires : 
   #
   # ========================================================================#

require_once('fb_core/fb_wrapper_class.php');

class FacebookSimpleAPI extends FaceBookWrapper
{
	
	
## _____________________________________________________________________________	
## ________                _____________________________________________________
## ________ PUBLIC METHODS _____________________________________________________
## _____________________________________________________________________________
##	
	
	public function __construct($appId, $secretId, $redirectURL, $userId = 'me', $publicUserIs=null, $cookies = true) {
		parent::__construct($appId, $secretId, $redirectURL, $userId, $publicUserIs, $cookies);
	}
	
	
	
/*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* 
 *	Profile data
 * 	
 */	
		
	
	public function getProfileInfoRaw()
	{
		return $this->_profileDataArray;	
	}
	
	## --------------------------------------------------------
	
	public function getFirstName() 
	#	Return first name
	{
		return $this->_getProfileSnippet('first_name');
	}
	
	## --------------------------------------------------------
	
	public function getLastName() 
	#	Return last name
	{
		return $this->_getProfileSnippet('last_name');
	}	
	
	## --------------------------------------------------------
	
	public function getName() 
	#	Return first and last name
	{
		return $this->_getProfileSnippet('name');
	}	
	
	## --------------------------------------------------------
	
	public function getProfilePageURL() 
	#	Return the URL to your profile page
	{
		return $this->_getProfileSnippet('link');
	}		
	
	## --------------------------------------------------------
	
	public function getGender() 
	#	Return  gender
	{
		return $this->_getProfileSnippet('gender');
	}	

	## --------------------------------------------------------
	
	public function getBirthday() 
	#	Return birthday
	{
		return $this->_getProfileSnippet('birthday');
	}	
	
	## --------------------------------------------------------
	
	public function getEmail() 
	#	Return email address
	{
		return $this->_getProfileSnippet('email');
	}	
	
	## --------------------------------------------------------
	
	public function getBio() 
	#	Return bio
	{
		return $this->_getProfileSnippet('bio');
	}		

	## --------------------------------------------------------
	
	public function getFacebookId() 
	#	Return bio
	{
		return $this->_getProfileSnippet('id');
	}
	
	## --------------------------------------------------------
	
	public function getRelationshipStatus()
	#	Return relationship status
	{
		return $this->_getProfileSnippet('relationship_status');
	}
	
	## --------------------------------------------------------
	
	public function getSignificantOther()
	#	Return significant other name
	{
		$sigOtherArray = $this->_getProfileSnippet('significant_other');
		if(is_array($sigOtherArray) && isset($sigOtherArray['name'])) {
			return $sigOtherArray['name'];
		} else {
			return '';
		}
	}
	
	
	
/*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* 
 *	Friend data
 * 	
 */
		
	public function getFriendList()
	#
	#	Author:		Jarrod Oberto
	#	Date:		Jul 11
	#	Purpose:	Get a list of all your friends
	#	Params in:
	#	Params out:	(flat array) list of friends
	#	Notes:	
	#
	{
		$friendListArray = array();
		$friendDataRawArray = $this->_getFriendsRaw();

		if (count($friendDataRawArray['data']) > 0) {
			foreach ( $friendDataRawArray['data'] as $friend) {
				$friendListArray[] = $friend['name'];
			}
		}
		
		sort($friendListArray);
		
		return $friendListArray;
	}
	
	## --------------------------------------------------------
	
	public function getFriendCount()
	#	Return the count of friends
	{
		return count($this->getFriendList());
	}
	
	## --------------------------------------------------------
	
	public function getFriendsPhoto($friend='', $amount=0, $size='square', $forceArray=true)
	#
	#	Author:		Jarrod Oberto
	#	Date:		Jul 11
	#	Purpose:	Get the 
	#	Params in:	(str) $friend (optional). You can specify what friends are
	#				to be returned, or if left blank, all friends will be
	#				returned
	#	Params out:	(mixed) If more than one friend is requested then the type
	#				is array. If only one friend is requested then a string of 
	#				the URL is returned (unless $forceArray is true).
	#				
	#	Notes:	
	#
	{
		
		$friendPhotoArray = array();
		$friendDataRawArray = $this->_getFriendsRaw();

		$friendArray = $this->_prepInput($friend);
	
		$size = $this->_resolveImageSize($size);

		// *** Make sure we got some data from Facebook
		if (count($friendDataRawArray['data']) > 0) {
			
			// *** Loop, loop, loop! Loop throught each friend on Facebook...
			foreach ( $friendDataRawArray['data'] as $f) {
				
				$name = $f['name'];
				$id = $f['id'];
				$friendArray = array_map("strToLower", $friendArray);
				
				// *** If only one friend name has been requested (via $friend)
				if (count($friendArray) == 1) {
					
					// *** ...and the name we're currently checking was requested 
					if (in_array(strToLower($name), $friendArray)) {
						if ($forceArray) {
							$friendPhotoArray[$id]['name'] = $name;
							$friendPhotoArray[$id]['photo'] = 'http://graph.facebook.com/' . $id . '/picture?type=' . $size;
						} else {
							$friendPhotoArray = 'http://graph.facebook.com/' . $id . '/picture?type=' . $size;
						}					
					}				
				
				// *** If more than one name was requested	
				} else if (count($friendArray) > 1) {
					
					// *** ...and the name we're currently checking was one of the requested 
					if (in_array(strToLower($name), $friendArray)) {
						
						$friendPhotoArray[$id]['name'] = $name;
						$friendPhotoArray[$id]['photo'] = 'http://graph.facebook.com/' . $id . '/picture?type=' . $size;
					}
					
				// *** No names were requested, return the lot 	
				} else {
					
					// *** If we didn't pass in anything	
					$id = $f['id'];
					$friendPhotoArray[$id]['name'] = $name;
					$friendPhotoArray[$id]['photo'] = 'http://graph.facebook.com/' . $id . '/picture?type=' . $size;					
					
				}				
			}
		}		
		
		
		// *** Get a random amout of friends (if $amount is supplied)
		if ($amount > 0 && $amount <= count($friendPhotoArray)) {

			$keysArray = array_rand($friendPhotoArray, $amount);
			
			$friendPhotoArrayTemp = $friendPhotoArray;
			$friendPhotoArray = array();
			
			if (count($keysArray) > 0) {
				foreach ($keysArray as $key => $friendKey) {
					$friendPhotoArray[$friendKey] = $friendPhotoArrayTemp[$friendKey];
				}
			}
		}
		
		
		return $friendPhotoArray;
	}
	
	## --------------------------------------------------------
	
	public function getFriendsPhotoHTML($friend='', $amount=0)
	#
	#	Author:		Jarrod Oberto
	#	Date:		Jul 11
	#	Purpose:	Return friend name and image wrapped in HTML for easy formatting
	#	Params in:	(mixed) $friend - either an empty string for all friends, or,
	#				you can specify the friends to return.
	#	Params out:	HTML of friends name and profile image
	#	Notes:		CSS tags:
	#						div.fb-friend 	
	#						img.fb-friend-img 	
	#						span.fb-friend-name 	
	#
	{
		
		$friendDataRawArray = $this->getFriendsPhoto($friend, $amount, 'square', true);
		$html = '';
			
		if (count($friendDataRawArray) > 0) {
			foreach ( $friendDataRawArray as $id => $friend) {
		
				$name = $friend['name'];
				$photo = $friend['photo'];
			
				$html .= '<div class="fb-friend"><img src="' . $photo . '" alt="" class="fb-friend-img" /><span class="fb-friend-name">' . $name . '</span></div>';
			}
		}

		return $html;	
	}
	
	## --------------------------------------------------------
	
	public function getFriendsDataRaw()
	{
		return $this->_getFriendsRaw();
	}
	

	
/*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* 
 *	Status data
 * 	
 */
	
	public function getStatusInfo($amount=1, $formatDate=true)
	#
	#	Author:		Jarrod Oberto
	#	Date:		Jul 11
	#	Purpose:	Get the status and accompanying info.
	#	Params in:	(int) The number of statuses to return
	#	Params out: (multi array) array of status information including:
	#					- status 
	#					- time 
	#					- from 
	#					- commentCount 
	#	Notes:	
	#
	{
		$statusesArray = array();
		$statusDataRawArray = $this->_getStatusRaw();
			
		if (count($statusDataRawArray['data']) > 0) {
			
			foreach ($statusDataRawArray['data'] as $key => $status) {
				
				$id = $status['id'];
				
				$statusesArray[$id]['status'] = $status['message'];
				$statusesArray[$id]['date'] = $status['updated_time'];
				$statusesArray[$id]['from'] = $status['from']['name'];
				
				if ($formatDate) {
					$statusesArray[$id]['date'] = date(DATE_FORMAT, $statusesArray[$id]['date']);
				}
				
				$commentCount = 0;
				if (isset($status['comments']['data'])) {
					$commentCount = count($status['comments']['data']);
				}	
				
				$statusesArray[$id]['commentCount'] = $commentCount;
			}
		}
		
		if ($amount)
		return array_slice($statusesArray, 0, $amount);
	}
	
	## --------------------------------------------------------
	
	public function getStatus($amount=1)
	{
		$statusesArray = array();
		$statusDataRawArray = $this->_getStatusRaw();
			
		if (count($statusDataRawArray['data']) > 0) {
			
			foreach ($statusDataRawArray['data'] as $key => $status) {
				$statusesArray[] = $status['message'];
			}
		}
		return array_slice($statusesArray, 0, $amount);
	}	

	
	## --------------------------------------------------------
	
	public function getStatusHTML($amount=1)
	#
	#	Author:		Jarrod Oberto
	#	Date:		Jul 11
	#	Purpose:	
	#	Params in:	
	#				
	#	Params out:	HTML of 
	#	Notes:		CSS tags:
	#						div.fb-status-box	
	#						span.fb-status-box	
	#						span.fb-status-attributes 	
	#	
	{
		$statusesArray = $this->getStatusInfo($amount);

		$statusesArray = array_slice($statusesArray, 0, $amount);
		
		$statusHTML = '';
		
		
		$lastClass = '';
		foreach ($statusesArray as $statusArray) {
			$statusHTML .= '<div class="fb-status-box ' . $lastClass . '"><span class="fb-status">' . $statusArray['status'] . '</span><span class="fb-status-attributes">' . $statusArray['date'] . '</span></div>';
		}	
		
		return $statusHTML;
	}	
	
	## --------------------------------------------------------
	
	public function getStatusRaw()
	{
		return $this->_getStatusRaw();
	}
	
	
	
/*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* 
 *	Feed data
 * 	
 */	
	
	public function getFeed($amount=1, $formatDate=true)
	#	type: status, photo, link, link-events								
	{
		$feedArray = array();
		$feedDataRawArray = $this->_getFeedRaw();

		$acceptedTypes = array('status', 'photo', 'link', 'link-events');
		

		if (count($feedDataRawArray['data']) > 0) {
				
			foreach ($feedDataRawArray['data'] as $key => $feedDataArray) {
			
				$type = $feedDataArray['type'];
				
				// *** We have a "Link" type but to be more specific, links can come from applications, such as events. 
				if ($type == 'link') {
					if (isset($feedDataArray['application']['name']) && strtolower($feedDataArray['application']['name']) == 'events') {
						$type .= '-events';
					}
				}
				
				
				if (in_array($type, $acceptedTypes)) {
				
					$id = $feedDataArray['id'];

					$feedArray[$id]['name'] = $feedDataArray['from']['name'];
					$feedArray[$id]['type'] = $type;

					if ($formatDate) {
						$feedArray[$id]['date'] = date(DATE_FORMAT, $feedDataArray['created_time']);					
					} else {
						$feedArray[$id]['date'] = $feedDataArray['created_time'];
					}

					switch ($feedDataArray['type']) {
						case 'status':
							$feedArray[$id]['contents'] = $feedDataArray['message'];
							break;
						case 'photo':
							$feedArray[$id]['contents'] = $feedDataArray['picture'];
							$feedArray[$id]['caption'] = $feedDataArray['caption'];
							$feedArray[$id]['albumName'] = $feedDataArray['name'];
							$feedArray[$id]['icon'] = $feedDataArray['icon'];
							break;
						case 'link':
							$feedArray[$id]['contents'] = $feedDataArray['picture'];
							$feedArray[$id]['icon'] = $feedDataArray['icon'];
							$feedArray[$id]['text1'] = $feedDataArray['properties'][0]['text'];
							$feedArray[$id]['text2'] = $feedDataArray['properties'][1]['text'];
							$feedArray[$id]['linkName'] = $feedDataArray['name'];
							break;	
						case 'link-events':
							$feedArray[$id]['contents'] = $feedDataArray['picture'];
							$feedArray[$id]['icon'] = $feedDataArray['icon'];
							$feedArray[$id]['location'] = $feedDataArray['properties'][0]['text'];
							$feedArray[$id]['time'] = $feedDataArray['properties'][1]['text'];
							$feedArray[$id]['linkName'] = $feedDataArray['name'];
							break;							
						default:
							break;
					}

					// *** Get the privacy setting
					if (isset($feedDataArray['privacy']['value'])) {
						$feedArray[$id]['privacy'] = $feedDataArray['privacy']['value'];
					}

					// *** Get the comments
					if (isset($feedDataArray['comments']['data'])) {

						foreach ($feedDataArray['comments']['data'] as $key => $commentsArray) {
							$feedArray[$id]['comments'][$key]['name'] = $commentsArray['from']['name'];
							$feedArray[$id]['comments'][$key]['comment'] = $commentsArray['message'];

							if ($formatDate) {
								$feedArray[$id]['comments'][$key]['date'] = date(DATE_FORMAT, $commentsArray['created_time']);					
							} else {
								$feedArray[$id]['comments'][$key]['date'] = $commentsArray['created_time'];
							}

							$feedArray[$id]['comments'][$key]['id'] = $commentsArray['from']['id'];

						}
					}

					// *** Get comment count
					if (isset($feedDataArray['comments']['count'])) {
						$feedArray[$id]['commentCount'] = $feedDataArray['comments']['count'];
					}
				
				}
			}
			
		}

		return array_slice($feedArray, 0, $amount);
	}	
	
	## --------------------------------------------------------
	
	public function getFeedHTML($amount=1, $displayComments=true, $displayPrivate=false)
	#	fb-feed-wrapper
	{
		
		$profileImage = $this->getProfileImageURL('square');
		$feedArray = $this->getFeed($amount);
		
		$HTML = '';
		
		// *** Loop through each feed article
		foreach ($feedArray as $feed) {
				
			// *** Create "content" HTML based on the type of article
			switch ($feed['type']) {
				case 'status':
					$contents = $feed['contents'];
					$date = $feed['date'];
					$caption =  '<span class="fb-name">' . $feed['name'] . '</span>';
					break;
				
				case 'photo':
					$contents = '<img src="' . $feed['contents'] . '" alt="" />';
					$date = '<img src="' . $feed['icon'] . '" alt="" /> ' . $feed['date'];
					$caption =  '<span class="fb-name">' . $feed['name'] . '</span> added ' . $feed['caption'] . ' to the album ' . $feed['albumName'] ;
					break;
				case 'link':
					$contents = '<div>
								 <img class="fb-link-img" src="' . $feed['contents'] . '" alt="" />
								 
									<span class="fb-content-title">' .$feed['linkName'] . '</span><br />
									<div class="fb-content-line">' .$feed['text1'] . '</div><br />
									<div class="fb-content-line">' .$feed['text2'] . '</div>
								
								 </div>';
					$date = '<img src="' . $feed['icon'] . '" alt="" /> ' . $feed['date'];
					$caption =  '<span class="fb-name">' . $feed['name'] . '</span> added ' . $feed['caption'] . ' to the album ' . $feed['albumName'] ;					
					break;	
				case 'link-events':
					$contents = '<div>
								 <img class="fb-link-img" src="' . $feed['contents'] . '" alt="" />
								 
									<span class="fb-content-title"> ' .$feed['linkName'] . '</span><br />
									<div class="fb-content-line">Location: <span>' .$feed['text1'] . '</span></div><br />
									<div class="fb-content-line">Time: <span>' .$feed['text2'] . '</span></div>
								
								 </div>';
					$date = '<img src="' . $feed['icon'] . '" alt="" /> ' . $feed['date'];
					$caption =  '<span class="fb-name">' . $feed['name'] . '</span> added ' . $feed['caption'] . ' to the album ' . $feed['albumName'] ;					
					break;					

				default:
					break;
			}
			
			$comment = '';
			if (isset($feed['comments'])) {
				
				foreach ($feed['comments'] as $commentArray) {
					$img = '';
					//$img = $this->getFriendsPhoto($commentArray['name'], false);
					//$img = '<img src="' . $img . '" alt="" >';
					$comment .= '<div class="fb-comment">' . $img . '<span class="fb-name">' . $commentArray['name'] . '</span> ' . $commentArray['comment'] . '</span><span class=fb-date>' . $commentArray['date'] . '</span></div>';
				}
			} 
					
			// *** The overall structure of the feed
			$html .=<<<HTML
			<div class="fb-feed-wrapper">
				<img src="$profileImage" alt="" />
				<div class="fb-feed-body">
					<span class="fb-caption">$caption</span>
					<span class="fb-contents">$contents</span>
					<span class="fb-date">$date</span>
					$comment
				</div>
			</div>
HTML;
			
		}
		
		return $html;
		
	}
	
	## --------------------------------------------------------
	
	public function getFeedRaw()
	{
		return $this->_getFeedRaw();
	}
	
	
/*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-* 
 *	Events data
 * 	
 */	
	
	
	public function getEvents($amount=1)
	{
		$feedArray = array();
		$feedDataRawArray = $this->_getEventsRaw();		
	}
	
	## --------------------------------------------------------
	
	public function getEventsRaw()
	{
		return $this->_getEventsRaw();
	}
	
## _____________________________________________________________________________	
## ________                 ____________________________________________________
## ________ PRIVATE METHODS ____________________________________________________
## _____________________________________________________________________________
##		
	
	private function _prepInput($input)
	#
	#	Author:		Jarrod Oberto
	#	Date:		Jul 11
	#	Purpose:	Processors a value (string or array) and returns an array
	#	Params in:	(mixed) array of names, or comma seperated string
	#	Params out: (array) flat array of names
	#	Notes:	
	#
	{
		
		if (is_array($input)) { # If input is an array
			
			// *** If the array has some data
			if (count($input) > 0) {

				// *** Return array
				return $input;
			}		
			
		} else if (is_string($input)) { # If input is as string
			
			if ($input != '') { 
	
				if (strstr($input, ',')) {				

					$arrayTemp = explode(',', $input);
					$arrayTemp = array_map("trim", $arrayTemp);
							
					// *** Return array (multi elements)
					return $arrayTemp;
				} else {
					
					// *** Return array (single element)
					return array($input);
				}
			}

		}
		
		// *** Return empty array
		return array();
	}
	
	## --------------------------------------------------------
	
	private function _getProfileSnippet($value)
	{
		if (isset($this->_profileDataArray[$value])) {		
			return $this->_profileDataArray[$value];
		} else {
			return '';
		}		
	}
	
	## --------------------------------------------------------
}
?>
