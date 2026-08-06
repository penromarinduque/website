<?php

namespace App\Http\Traits\Gender;

use Crypt;
use Session;
use Storage;
use Illuminate\Http\Request;
use GuzzleHttp\Client as GuzzleHttpClient;
use App\Http\Controllers\Common\CommonServiceController as CommonService;

trait GenderCommonTrait
{
	public function gender_panel_detail_content($panelDetails)
	{
		if( $panelDetails->detail_type_id == '1' ) 
		{
			$DetailsContent = app('GenderPanelDetailsFiles')->where('file_id', $panelDetails->detail_content_id);
		} 
		else if ( $panelDetails->detail_type_id == '2' ) 
		{
			$DetailsContent = app('GenderPanelDetailsFrames')->where('frame_id', $panelDetails->detail_content_id);
		} 
		else if ( $panelDetails->detail_type_id == '3' ) 
		{
			$DetailsContent = app('GenderPanelDetailsLinks')->where('link_id', $panelDetails->detail_content_id);
		} 
		else if ( $panelDetails->detail_type_id == '4' ) 
		{
			$DetailsContent = app('GenderPanelDetailsPosts')->where('post_id', $panelDetails->detail_content_id);
		}
		return $DetailsContent;
	}

	public function youtube_video_thumbnail_api($url, $message = []) {

	    parse_str( parse_url( $url, PHP_URL_QUERY ), $parse );

	    if(collect($parse)->isNotEmpty()) {

	        if( array_key_exists('v', $parse) ) {

	            $id = $parse['v'];
	            $key = config('app.youtube');

	            $message['status'] = true;
	            $message['data'] = $this->youtube_video_thumbnail_api_json_result($id, $key);

	        } else {

	            $message['status'] = false;
	            $message['data'] = ['error' => 'Cannot find (YouTube Video ID) on this URL. Please try another one'];

	        } 

	    } else {

	        $message['status'] = false;
	        $message['data'] = 'Youtube url is not valid. ex:(https://www.youtube.com/watch?v=<= YOUTUBE VIDEO ID =>)';
	        
	    } 

	    return $message;

	}

	public function youtube_video_thumbnail_api_json_result($id, $key)
	{

		$url = 'https://www.googleapis.com/youtube/v3/videos?id=' . $id . '&key=' . $key . '&part=snippet,statistics&fields=items(id,snippet,statistics)';

		$client = new GuzzleHttpClient;

		$response = $client->request('GET', $url);

		$array_response = json_decode($response->getBody())->items; 

		$thumbnailUrl = $array_response[0]->snippet->thumbnails->high->url;

		return $this->youtube_video_thumbnail_api_copy_thumbnail($thumbnailUrl);

	}

	public function youtube_video_thumbnail_api_copy_thumbnail($url)
	{

		$genUrl = str_random(38);

		$copyFile = file_get_contents($url);

		$fieExtension = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);

		file_put_contents(storage_path('app/public/gender-storage/featured-videos/') . $genUrl . '.' . $fieExtension, $copyFile);

		return 'featured-videos/' . $genUrl . '.' . $fieExtension;

	}

}