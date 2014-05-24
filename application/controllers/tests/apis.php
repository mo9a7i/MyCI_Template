<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apis extends CI_Controller {


	public function instagram()
	{
		$provider = 'instagram';
		$provider = $this->oauth2->provider($provider, array(
            'id' => 'd3da492ee2864d66814e45c12389d28b',
            'secret' => '811a167774c848cc9456cafa897ea8dc',
			'redirect_uri' => 'http://localhost/Template/index.php/apis/instagram'
        ));
		
		try
		{
			
			echo "<pre>";
			$url = 'https://api.instagram.com/v1/users/self/feed?'.http_build_query(array('access_token' => '229495498.d3da492.e25a101a492e4fb5a61027d3394eafb1','count'=>'100'	));
	
			var_dump(json_decode(file_get_contents($url))->data);
		}
		catch (OAuth2_Exception $e)
		{
			show_error('That didnt work: '.$e);
		}
	}
	
	public function getTokenFQ()
	{
		
		$provider = $this->oauth2->provider("Foursquare", array(
            'id' => 'T5I5X1W11VNLPX2KGUCNEBDN3TSCOOM3YUFXJGAH3SA4PTON',
            'secret' => 'ZKDBYX5X2RXVNKLDFVTYIG410TH3X5L2FKLPUWBNZFPC3SLR',
        ));

        if ( ! $this->input->get('code'))
        {
            // By sending no options it'll come back here
            $provider->authorize();
        }
        else
        {
            // Howzit?
            try
            {
                $token = $provider->access($_GET['code']);
				echo $token;
                $user = $provider->get_user_info($token);

                // Here you should use this information to A) look for a user B) help a new user sign up with existing data.
                // If you store it all in a cookie and redirect to a registration page this is crazy-simple.
                echo "<pre>Tokens: ";
                var_dump($token);

                echo "\n\nUser Info: ";
                var_dump($user);
            }

            catch (OAuth2_Exception $e)
            {
                show_error('That didnt work: '.$e);
            }

        }
	}
	
	
	public function Foursquare()
	{
		$data['title'] = "Foursquare";
		$data['main_content'] = 'apis';
		
		$parameters = array(
				'oauth_token' => '4FNTG50JIU5WK0PNMWL43KKNZXILQBWXDIQAYQSNJTDGZ1P0',
				'v' => '20140115',
				);
		
		
		try
		{
			$url = 'https://api.foursquare.com/v2/users/72234774?'.http_build_query($parameters);
			$result =  json_decode(file_get_contents($url))->response;
			echo "<pre>";
			var_dump($result);
			die();
			//$friendsIds = array();
			foreach ($result as $res)
			{
				if($res->gender == "female")
				{
					array_push($friendsIds,$res->id);
					$url = 'https://api.foursquare.com/v2/users/'.$res->id.'/friends?'.http_build_query($parameters);
					$rezy =  json_decode(file_get_contents($url))->response->friends->items;
					
					
					
				}
			}
			
			
			
			
			//var_dump($friendsIds);
			die();
			
			$toBeFriends;
			
			
		}
		catch (OAuth2_Exception $e)
		{
			show_error('That didnt work: '.$e);
		}
		$data['api'] = $result;
		$this->load->view('template/template', $data);
	}
	
	public function Twitter()
	{
	
	}
}
