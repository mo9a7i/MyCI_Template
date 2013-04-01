<?php
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/

/**
* All Shared Functions will be located here
* for app specific functions, check app_model.php
*/
class Mo9a7i_model extends CI_Model{
	
	#Application level variables should be set here.
	function __construct()
    {
        parent::__construct();
		
		//Load application settings in $this->settings array.
        $CI = &get_instance();
		$settings = array();
        if ($this->config->item("useDatabaseConfig")) {
            $settings = $this->db->get("settings")->result();     
            foreach($settings as $setting)
            {
                $settings[addslashes($setting->var_name)] = addslashes($setting->value);
            }       
        }
        else
        {
            $settings = (object) $CI->config->config;
        }
		
        $CI->Settings = (object) $settings;
		$tags = $this->get_tags(array('nolimit'=>TRUE));
		$CI->tags = (object) $tags;  
		
		$latest_replies = $this->get_latest_replies(10);
		$CI->latest_replies = (object) $latest_replies;
		
		
		$this->run_cronjobs();
		
		$statistics = $this->get_statistics();
		
		$CI->statistics = (object) $statistics;
		//print_r($statistics);die();
    }
	
	function get_statistics()
	{
		
		$string = read_file('statistics.txt');
		return json_decode($string);
		
	}
	
	function run_cronjobs()
	{
		
		#Read file timstamp, if more than 30 seconds, update, if not, do nothing
		if(!is_file(FCPATH .'/statistics.txt'))
		{
			
			write_file('statistics.txt', '');
		}
		else
		{
			
			$string = read_file('statistics.txt');
			$stats = json_decode($string);
			if(isset($stats->date_modified))
			{
				
				// one day 86400
				if(($stats->date_modified + (60*60)) < date(now()))
				{
					$total_users = $this->db->count_all_results('users');
		
					$this->db->where('status_id',1);
					$total_active_jokes = $this->db->count_all_results('posts');
					
					$this->db->where('status_id',4);
					$total_pending_jokes = $this->db->count_all_results('posts');
					
					$this->db->where('status_id',3);
					$total_deleted_jokes = $this->db->count_all_results('posts');

					$total_replies = $this->db->count_all_results('replies');
					$visits = $this->get_views(array('resource_id'=>0,'resource_type'=>3));
					
					$statistics = array(
									'total_users' => $total_users,
									'total_active_jokes' => $total_active_jokes,
									'total_pending_jokes' => $total_pending_jokes,
									'total_deleted_jokes' => $total_deleted_jokes,
									'total_replies' => $total_replies,
									'visits' => $visits,
									'date_modified' => date(now())
									);
					write_file('statistics.txt', json_encode($statistics));
				}
			}
			else
			{
				$total_users = $this->db->count_all_results('users');
		
					$this->db->where('status_id',1);
					$total_active_jokes = $this->db->count_all_results('posts');
					
					$this->db->where('status_id',4);
					$total_pending_jokes = $this->db->count_all_results('posts');
					
					$this->db->where('status_id',3);
					$total_deleted_jokes = $this->db->count_all_results('posts');

					$total_replies = $this->db->count_all_results('replies');
					
					$visits = $this->get_views(array('resource_id'=>0,'resource_type'=>3));
					
					$statistics = array(
									'total_users' => $total_users,
									'total_active_jokes' => $total_active_jokes,
									'total_pending_jokes' => $total_pending_jokes,
									'total_deleted_jokes' => $total_deleted_jokes,
									'total_replies' => $total_replies,
									'visits' => $visits,
									'date_modified' => date(now())
									);
					write_file('statistics.txt', json_encode($statistics));
			}
		}
	}
	
	
	function update_settings($data)
	{
		foreach($data as $key=>$value)
		{
			$this->db->where('var_name', $key);
			$this->db->update('settings', array('value' => $value)); 
		}
	}
	
	
	
	#Settings Management
	function set_setting($options = array())
	{
		$this->db->where('var_name', $options->var_name);
		$this->db->update('value', $options->value); 
	}
	
	function get_setting($options = array())
	{
		$q = $this->db->select('value')->where('var_name', $options['var_name'])->get('settings');
		if($q->num_rows()>0)
		{
			$row = $q->row_array();
		}
		return $row['value'];
	}
	
	#Users Management
	function add_user($data)
	{
		$this->db->insert('users',$data);
		return $this->db->insert_id();
	}
	
	function get_username($id)
	{
		//echo $id;
		if(is_null($id) OR $id == 0)
		{	$id=88;
			$this->db->select('username');
			return $this->db->get_where('users',array('users.id'=>$id))->ROW()->username;
			
		}
		else
		{
			$this->db->select('username');
			return $this->db->get_where('users',array('users.id'=>$id))->ROW()->username;
			//return FALSE;
		}
	}
	
	
	function get_users($options = array())
	{
		#Default Values
		$options = $this->_default(array('order_column' =>'users.id','order_direction'=> 'desc'), $options);

		#############################################
		if(isset($options['user_id']))
		{
			$this->db->where('users.id', $options['user_id']);
			$this->db->select('users.id as id,ip_address,username,password,salt,
							email,activation_code,forgotten_password_code,remember_code,
							created_on,last_login,active,first_name,middle_name,
							last_name,date_of_birth,meta.phone,bio,countries.name as country_name
							,nationality,country,bb_pin,adult_content,gender,groups.name as group_name,
							groups.id as group_id,show_bb_pin,show_phone,show_email');
		}
		elseif(isset($options['username']))
		{
			$this->db->where('users.username', $options['username']);
			$this->db->select('users.id as id,ip_address,username,password,salt,
							email,activation_code,forgotten_password_code,remember_code,
							created_on,last_login,active,first_name,middle_name,
							last_name,date_of_birth,meta.phone,bio,countries.name as country_name
							,nationality,country,bb_pin,adult_content,gender,groups.name as group_name,
							groups.id as group_id,show_bb_pin,show_phone,show_email');
		}
		elseif(isset($options['nolimit']))
		{
		
			if(isset($options['include_all']))
			{
				$this->db->select('users.id as id,ip_address,username,password,salt,
							email,activation_code,forgotten_password_code,remember_code,
							created_on,last_login,active,first_name,middle_name,
							last_name,date_of_birth,meta.phone,bio,countries.name as country_name
							,nationality,country,bb_pin,adult_content,gender,groups.name as group_name,
							groups.id as group_id,show_bb_pin,show_phone,show_email');
			}
			else
			{
				$this->db->select('users.id');
			}
			
		}
		else
		{
			//If is the segment is number or is not set, limit to the number of pagination per page set globally, and start with the index of the segment.
			$limit 	= ((isset($options['limit'])) ? $options['limit'] : $this->pagination->per_page );
			$offset = ((isset($options['offset'])) ? $options['offset'] : $this->uri->segment($this->pagination->uri_segment) );
			
			if(is_numeric($this->uri->segment($this->pagination->uri_segment))  OR  ($this->uri->segment($this->pagination->uri_segment)) == null)
				$this->db->limit($limit, $offset);
			$this->db->select('users.id as id,ip_address,username,password,salt,
							email,activation_code,forgotten_password_code,remember_code,
							created_on,last_login,active,first_name,middle_name,
							last_name,date_of_birth,meta.phone,bio,countries.name as country_name
							,nationality,country,bb_pin,adult_content,gender,groups.name as group_name,
							groups.id as group_id,show_bb_pin,show_phone,show_email');
		}

		$this->db->join('meta','meta.user_id = users.id','left');
		$this->db->join('users_groups','users_groups.user_id = users.id','left');
		$this->db->join('groups','users_groups.group_id = groups.id','left');
		$this->db->join('countries','countries.id = meta.country','left');
		
		if(isset($options['status_id']))
		{
			$this->db->where_in('users.active', $options['status_id']);
		}
		else
		{
			//$user
			if (isset($options['user_view']) AND $options['user_view'] )
			{			
				$this->db->where('users.active', 1);
			}
		}

		#Order Statement
		$this->db->order_by($options['order_column'], $options['order_direction']);
		
		return $this->db->get('users')->result();
	}
	
	function edit_user($data,$id)
	{
		$this->db->where('id', $id);
		return $this->db->update('users', $data); 
	}
	
	function delete_user($id = null)
	{
		$this->db->where('id', $id);
		return $this->db->update('users', array('active' => 3)); 
	}
	
	function get_user_from_session($session_id)
	{
		return $this->db->get_where('ci_sessions', array('session_id' => $session_id))->result();
	}
	
	function check_user_availbility($username)
	{
		$userExistance = $this->db->get_where('users', array('username' => $username));
		if($userExistance->num_rows() == 0)
			return 1;
		else
			return 0;
	}
	
	function check_email_availbility($email)
	{
		$EmailExistance = $this->db->get_where('users', array('email' => $email));
		if($EmailExistance->num_rows() == 0)
			return 1;
		else
			return 0;
	}
		
	function user_allows_adult_content($user_id = null)
	{
		if(is_null($user_id))
		{
			$user_id = $this->get_user_id();
		}
		$this->db->where('user_id',$user_id);
		return $this->db->get('meta')->ROW()->adult_content;
	}
	
	function activate_user($id = null)
	{
		$this->db->where('id',$id['id']);
		$this->db->update('users', array('active' => 1)); 
	}
	
	function activate_post($id = null)
	{
		$this->db->where('id',$id['id']);
		$this->db->update('posts', array('active' => 1)); 
	}
	
	function activate_reply($id = null)
	{
		$this->db->where('id',$id['id']);
		$this->db->update('replies', array('active' => 1)); 
	}
	
	function get_user_id()
	{
		return (empty($this->ion_auth->user()->row()->id) ? 0 : $this->ion_auth->user()->row()->id );
	}
	
	
	#Meta Management
	function add_meta($data)
	{
		$this->db->insert('meta',$data);
		return $this->db->insert_id();
	}
	
	function edit_meta($data,$id)
	{
		$this->db->where('user_id', $id);
		return $this->db->update('meta', $data); 
	}
	
	
	#Groups Management
	function add_groups($data)
	{
		$this->db->insert('groups',$data);
		return $this->db->insert_id();
	}

	function edit_groups($data,$id)
	{
		$this->db->where('id', $id);
		return $this->db->update('groups', $data); 
	}
	
	function get_users_groups($id = null)
	{
		$this->db->select('groups.*,count(users_groups.group_id) as count');
		$this->db->join('users_groups','users_groups.group_id = groups.id','left');
		$this->db->group_by('groups.id');
		if (!is_null($id)) $this->db->where('groups.id', $id);
			$this->db->order_by('groups.id', 'desc');
		return $this->db->get('groups')->result();
	}
	
	function edit_users_groups($data,$id)
	{
		$this->db->where('user_id', $id);
		return $this->db->update('users_groups', $data); 
	}
	
	function delete_groups($id)
	{
		return $this->db->delete('groups', $id); 
	}
	

	#Images Management
	function add_images($data)
	{
		$this->db->insert('images',$data);
		return $this->db->insert_id();
	}
	
	//$resource_id,$resource_type)
	function get_image($options = array())
	{
		#Default Values
		$options = $this->_default(array('resource_type' =>1), $options);
		return $this->db->get_where('images', array('resource_id' => $options['resource_id'],'resource_type'=>$options['resource_type']))->result();
	}
	
	function get_image_name($id)
	{
		$image = $this->db->get_where('images', array('id' => $id))->result();
		return $image[0];
	}
	
	function delete_thumbnail($id)
	{
		$my_image = $this->get_image_name($id);
		$this->db->where('id', $id);
		$this->db->update('images', array('resource_id'=>'','resource_type'=>'','convert_remarks'=> $my_image->convert_remarks.',Deleted: Resource_id='.$my_image->resource_id.' Resource_type='.$my_image->resource_type));
	}
	
	function sanitize_text($text)
	{
		$text = preg_replace('/\s\s+/', ' ', $text);
		$text = str_replace("ـ","",$text);
		$text = str_replace(","," ",$text);
		$text = str_replace("،"," ",$text);
		$text = str_replace(":"," ",$text);
		$text = str_replace("."," ",$text);
		$text = str_replace("="," ",$text);
		$text = str_replace(")"," ",$text);
		$text = str_replace("("," ",$text);
		$text = str_replace("\""," ",$text);
		$text = str_replace('\''," ",$text);
		$text = nl2br($text);
		$text = $this->br2nl($text);
		$text = str_replace("يقول لك","",$text);
		$text = preg_replace(array('/\s{2,}/', '/[\t\n]/'), ' ', $text);
		$text = trim($text);
		return $text;
	}
	
	function br2nl($text)
	{
		return preg_replace('/<br(\s+)?\/?>/i', "\n", $text);
	}
	
	#Posts Managemnt
	function create_slug($text)
	{
		$text = $this->sanitize_text($text);
		
		$text = mb_substr( strip_tags($text) , 0,50 ,'utf-8' );
		$text = trim($text);
		$text = str_replace(" ","-",$text);
		
		return $text;
	}
	
	function get_unique_slug($options = array())
	{
		if(isset($options['table']) AND isset($options['slug']))
		{
			
			$this->db->like('slug',$options['slug']);
			$query = $this->db->get($options['table']);
			//echo $query->num_rows();
			if($query->num_rows() == 0)
			{
				
				return $options['slug'];
			}
			elseif($query->num_rows() == 1)
			{
				
				return $options['slug'].'-1';
			}
			else
			{
				$slugs = array();
				foreach($query->result() as $slug)
				{
					$slugs[] = str_replace("-","",str_replace($options['slug'],"",$slug->slug));
				}
				return $options['slug'].'-'.(max($slugs)+1);
			}
		}
	}
	
	function add_posts($data)
	{
		if(!isset($data['slug']))
		{
			$slug = $this->create_slug($data['content']);
			$slug = $this->get_unique_slug(array('table'=>'posts','slug'=>$slug));
			$data['slug'] = $slug;
		}
		$this->db->insert('posts',$data);
		return $this->db->insert_id();
	}

	function edit_posts($data,$id)
	{
		$this->db->where('id', $id);
		$data['date_modified'] = date('Y-m-d H:i:s');
		return $this->db->update('posts', $data); 
	}
	
	//function get_posts($id = null,$tag_id=null,$user = FALSE,$status=null)
	function get_post_slug($id)
	{
		
		$this->db->select('slug');
		$res = $this->db->get_where('posts',array('posts.id'=>$id))->result();
		//print_r($res[0]->slug);die();
		return $res[0];
	}
	
	function get_tagid_by_slug($slug)
	{
		$this->db->select('id');
		$res = $this->db->get_where('tags',array('slug'=>$slug))->result();
		return $res[0];
	}
	function get_posts($options = array())
	{
		$options = $this->_default(array('limit'=>20,'offset'=>0,'order_column' =>'posts.date_modified','order_direction'=> 'desc'), $options);
		
		if($this->filter_status())
		{
			$filtered_tags_posts = $this->get_filtered_posts_array();
		}
		
		if(isset($options['tag_id']))
		{
			$this->db->where('tag_id',$options['tag_id']);
			$this->db->where('resource_type',2);
			$posts_in_tag = $this->db->get('tags_relations')->result();
			$posts_ids = array();
			foreach($posts_in_tag as $post_id)
			{
				$posts_ids[] = $post_id->resource_id;
			}
		}

		if(!empty($filtered_tags_posts))
		{
			$this->db->where_not_in('posts.id', $filtered_tags_posts);
		}
		
		if(!empty($posts_ids))
		{
			$this->db->where_in('posts.id',$posts_ids);
		}
		
		if(isset($options['user_id']))
		{
			$this->db->where('posts.user_id',$options['user_id']);
		}
		
		if(isset($options['status_id']))
		{
			$this->db->where('posts.status_id', $options['status_id']);
		}
		
		
		
		
		if (isset($options['post_id']))
		{
			
			$this->db->where('posts.id', $options['post_id']);
			$this->db->select('posts.id,posts.title,posts.content,posts.date_added,posts.user_id,posts.status_id,posts.date_modified,posts.slug,users.username as username');
			$options['limit'] = 1;
		}
		elseif(isset($options['slug']))
		{
			$this->db->where('posts.slug', $options['slug']);
			$this->db->select('posts.id,posts.title,posts.content,posts.date_added,posts.user_id,posts.status_id,posts.date_modified,posts.slug,users.username as username');
			$options['limit'] = 1;
		}
		elseif(isset($options['nolimit']))
		{
			if(isset($options['include_all']))
			{
				$this->db->select('posts.id,posts.title,posts.content,posts.date_added,posts.user_id,posts.status_id,posts.date_modified,posts.slug,users.username as username');
			}
			else
			{
				$this->db->select('posts.id');
			}
		}
		else
		{
			//If is the segment is number or is not set, limit to the number of pagination per page set globally, and start with the index of the segment.
			//$limit 	= ((isset($options['limit'])) ? $options['limit'] : $this->pagination->per_page );
			//$offset = ((isset($options['offset'])) ? $options['offset'] : $this->uri->segment($this->pagination->uri_segment) );
			if(is_numeric($this->uri->segment($this->pagination->uri_segment)))
			{
				$options['limit'] = $this->pagination->per_page;
				$options['offset'] = $this->uri->segment($this->pagination->uri_segment);//= $this->db->limit($limit, $offset);
			}
			$this->db->limit($options['limit'], $options['offset']);//$this->db->limit($limit, $offset);
			
			$this->db->select('posts.id,posts.title,posts.content,posts.date_added,posts.user_id,posts.status_id,posts.date_modified,posts.slug,users.username as username');
		}
		
		
		$this->db->join('users','posts.user_id = users.id','inner');
		
		$this->db->order_by($options['order_column'], $options['order_direction']);
		$res = $this->db->get('posts')->result();
		
		if(!isset($options['nolimit']) AND !isset($options['moderate']))
		{
			$counter = 0;
			foreach($res as $re)
			{

				$image = $this->get_image(array('resource_id'=>$re->user_id));
				if(empty($image))
					$image[0]->server_name = null;
				else
					$re->image = $image[0]->server_name;
				
				$re->views = $this->get_views(array('resource_id'=>$re->id,'resource_type'=>2));
				$re->tags = $this->get_post_tags($re->id,2);
				$re->comments_count = count($this->get_replies(array('resource_id'=>$re->id)));
				
				$counter++;
				
			}
		}

		return $res;
	}
	
	function get_filtered_posts_array()
	{
		$filtered_tags = $this->get_filtered_tags();
		if(!empty($filtered_tags))
		$this->db->where_in('tag_id',$filtered_tags);
		$this->db->where('resource_type',2);
		$filtered_tags_query =  $this->db->get('tags_relations')->result();
		$filtered_tags_posts = array();
		foreach($filtered_tags_query as $filtered_row)
		{
			$filtered_tags_posts[] = $filtered_row->resource_id;
		}
		return $filtered_tags_posts;
	}
	
	function delete_posts($id = null)
	{
		$this->db->where('id', $id);
		return $this->db->update('posts', array('status_id' => 3)); 

		//return $this->db->delete('posts', $id); 
	}
	
	//from moderation page only.
	function get_posts_to_skip()
	{
		$moderated_ips = $this->mo9a7i_model->get_moderation_ips();
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$posts_to_skip = array();
		
		//Added from moderation table by visitor iP
		foreach($moderated_ips as $ip)
		{
			if($ip->ip_address == $ip_address)
			{
				$posts_to_skip[] = $ip->post_id;
			}
		}
		
		//Added from cookie values of visitor's browser
		$cookie = $this->input->cookie('moderated_posts');
		if(!empty($cookie))
		{
			$moderated_cookie = explode(',',$cookie);
			$posts_to_skip = array_merge($posts_to_skip,$moderated_cookie);
		}
		
		return array_unique($posts_to_skip);
	}
	
	
	#Tags Management
	function update_tag_count($id)
	{
		$query = $this->db->get_where('tags_relations', array('tag_id'=>$id));
		$count = $query->num_rows();
		$this->db->where('id', $id);
		return $this->db->update('tags', array('count'=>$count)); 
	}
	
	function add_tags($data)
	{
		$this->db->insert('tags',$data);
		return $this->db->insert_id();
	}
	
	function add_post_tags($resource_id,$resource_type,$data)
	{
		foreach($data as $tag)
		{
			$this->db->insert('tags_relations',array('tag_id'=>$tag,'resource_id'=>$resource_id, 'resource_type' => $resource_type));
			$this->update_tag_count($tag);
		}
		
		return 1;
	}
	
	function delete_post_tags($resource_id,$resource_type,$id)
	{
	
		$this->db->delete('tags_relations', array('tag_id'=>$id,'resource_id'=>$resource_id, 'resource_type' => $resource_type)); 
	}
	
	function get_post_tags($resource_id,$resource_type)
	{
		$this->db->where(array('tags_relations.resource_id'=> $resource_id,'tags_relations.resource_type'=>	$resource_type));
		$this->db->order_by('tags.count', 'desc');
		$this->db->join('tags','tags_relations.tag_id = tags.id');
		$results = $this->db->get('tags_relations')->result();
		return $results;
		
	}
	
	function edit_tags($data,$id)
	{
		$this->db->where('id', $id);
		return $this->db->update('tags', $data); 
	}
	
	function get_filtered_tags()
	{
		$this->db->where('filtered =', '1');
		$query = $this->db->get('tags')->result();
		$tags = array();
		foreach($query as $row)
		{
			$tags[] = $row->id;
		}
		return $tags;
	}
	
	//$id = null)
	function get_tags($options = array())
	{
		#Default Values
		$options = $this->_default(array('order_column' =>'tags.count','order_direction'=> 'desc'), $options);
		
		#Filter Check
		if ($this->filter_status())
		{
			$this->db->where('filtered !=', '1');
		}
		
		#Limits Section
		if (isset($options['tag_id']))
		{
			$this->db->where('tags.id', $options['tag_id']);
		}
		elseif(isset($options['slug']))
		{
			$this->db->where('tags.slug', $options['slug']);
		}
		elseif(isset($options['nolimit']))
		{
			//$this->db->select('tags.id');
		}
		else
		{
			//If is the segment is number or is not set, limit to the number of pagination per page set globally, and start with the index of the segment.
			$limit 	= ((isset($options['limit'])) ? $options['limit'] : $this->pagination->per_page );
			$offset = ((isset($options['offset'])) ? $options['offset'] : $this->uri->segment($this->pagination->uri_segment) );
			
			if(is_numeric($this->uri->segment($this->pagination->uri_segment))  OR  ($this->uri->segment($this->pagination->uri_segment)) == null)
			$this->db->limit($limit, $offset);
		}

		#Order Statement
		$this->db->order_by($options['order_column'], $options['order_direction']);
		
		$res = $this->db->get('tags')->result();
		return $res;
	}
	
	function delete_tags($id)
	{
		$this->db->where('id', $id);
		return $this->db->update('tags', array('status_id' => 3)); 

		//$this->db->where('tag_id',$id);
		//$this->db->delete('tags_relations');
		//return $this->db->delete('tags', array('id'=>$id)); 
	}
	
	
	#Replies Management
	function add_replies($data)
	{
		$this->db->insert('replies',$data);
		return $this->db->insert_id();
	}
	
	function get_latest_replies($count)
	{
		if($this->filter_status())
		{
			$filtered_posts = $this->get_filtered_posts_array();
		}
		if(!empty($filtered_posts))
		{
			$this->db->where_not_in('resource_id',$filtered_posts);
		}
		$this->db->limit($count);
		$this->db->select('replies.*,users.username,users.id as user_id,users.username as username');
		$this->db->join('users','users.id = replies.user_id','left');
		$this->db->order_by('replies.id','desc');
		$replies = $this->db->get_where('replies', array('resource_type' => 2,'status_id'=>1))->result();
		foreach ($replies as $reply)
		{
			if($reply->user_id==0)
			{
				if($reply->author_url)
				{
					$author_link = '<a rel="nofollow" href="'.$reply->author_url.'" class="author-link">'.$reply->author.'</a>';
				}
				else
				{
					$author_link = $reply->author;
				}
				
			}
			else
			{
				$author_link = '<a href="'.base_url().'members/'.$reply->username.'" class="author-link">'.$reply->username.'</a>';
			}
			
			$reply->author_link = $author_link;
		}
		return $replies;
	}
	
	//$resource_id,$resource_type)
	function get_replies($options = array())
	{
		#Default Values
		$options = $this->_default(array('resource_type'=>2,'status_id'=>1,'order_column' =>'replies.id','order_direction'=> 'desc','offset'=>0), $options);
		
		$this->db->select('*');
		//$this->db->join('users','users.id = replies.user_id','left');
		
		$this->db->where(array('resource_type' => $options['resource_type'],'status_id'=>$options['status_id']));
		
		if(isset($options['id']))
		{
			$this->db->where('id',$options['id']);
		}
		
		if(isset($options['resource_id']))
		{
			$this->db->where('resource_id',$options['resource_id']);
		}
		
		if(isset($options['limit']))
		{
			$this->db->limit($options['limit'],$options['offset']);
		}
		
		if(isset($options['user_id']))
		{
			$this->db->where('replies.user_id',$options['user_id']);
		}
		
		#Order Statement
		$this->db->order_by($options['order_column'], $options['order_direction']);
		
		$replies = $this->db->get('replies')->result();

		foreach ($replies as $reply)
		{
			$reply->content = strip_tags($reply->content);
			$reply->username = $this->get_username($reply->user_id);
			$reply->author_link = $this->get_author_link($reply);
		}
		return $replies;
	}
	
	function get_author_link($reply)
	{
		if($reply->user_id==0)
		{
			if($reply->author_url)
			{
				$author_link = '<a href="'.$reply->author_url.'" class="author author-link" itemprop="creator">'.$reply->author.'</a>';
			}
			else
			{
				$author_link = $reply->author;
			}
		}
		else
		{
			$author_link = '<a href="'.base_url().'members/'.$reply->username.'" class="author-link">'.$reply->username.'</a>';
		}
		
		return $author_link;
	}
	
	function edit_replies($data,$id)
	{
		$this->db->where('id', $id);
		//$data['date_modified'] = date('Y-m-d H:i:s');
		return $this->db->update('replies', $data); 
	}
	
	function delete_replies($id)
	{
		$this->db->where('id', $id);
		return $this->db->update('replies', array('status_id' => 3)); 
	}
	
	#URLS Management
	function set_urls($name = '' ,$link = '' ,$resource_id = 0 ,$resource_type = 4)
	{
		$data = array(
			'name' => $name,
			'link' => $link,
			'date_added' => date('Y-m-d H:i:s'),
			'user_id' => $this->get_user_id(),
			'resource_id' => $resource_id,
			'resource_type' => $resource_type
		);
		$this->db->insert('urls',$data);
		return $this->db->insert_id();
	}
	
	function get_urls($resource_id,$resource_type)
	{
		return $this->db->get_where('urls', array('resource_id' => $resource_id,'resource_type'=> $resource_type))->result();
	}
	
	function delete_urls($id = null)
	{
		$this->db->where('id', $id);
		return $this->db->update('urls', array('status_id' => 3)); 
	}
	
	
	#Views Management
	//$resource_id, $resource_type)
	function get_views($options = array())
	{
		//Get current value
		$query = $this->db->get_where('views', array('resource_id' => $options['resource_id'],'resource_type' => $options['resource_type']));
		if($query->num_rows() == 0)
		{
			return 0;
		}
		return $query->row('count');	
	}
	
	//$resource_id,$resource_type)
	function set_views($options=array())
	{
		//Get current value
		$query = $this->db->get_where('views', array('resource_id' => $options['resource_id'],'resource_type' => $options['resource_type']));
		if($query->num_rows() == 0)
		{
			$data = array(
				'resource_id' => $options['resource_id'],
				'resource_type' => $options['resource_type'],
				'count' => 1,
			);
			$this->db->insert('views',$data);
		}
		else
		{
			$counter = $query->row('count');
			$counter++; 
			$this->db->where(array('resource_id' => $options['resource_id'],'resource_type' => $options['resource_type']));
			$this->db->update('views',array('count' => $counter));
		}	
	}

	
	#Files and Uploader Management
	function add_files_categories($data)
	{
		$this->db->insert('files_categories',$data);
		return $this->db->insert_id();
	}
	
	function edit_files_categories($data,$id)
	{
		$this->db->where('id', $id);
		return $this->db->update('files_categories', $data); 
	}
	
	function get_files_categories($id = null)
	{
		if (!is_null($id)) $this->db->where('files_categories.id', $id);
			$this->db->order_by('files_categories.id', 'desc');
		return $this->db->get('files_categories')->result();
	}
	
	function delete_files_categories($id)
	{
		return $this->db->delete('files_categories', $id); 
	}
	
	function add_files($data)
	{
		$this->db->insert('files',$data);
		return $this->db->insert_id();
	}
	
	function get_files($id = null)
	{
		$this->db->select('files.*,files_categories.name');
		$this->db->from('files');
		$this->db->join('files_categories','files_categories.id = files.cat_id');
		if (!is_null($id)) $this->db->where('files.id', $id);
			$this->db->order_by('files.id', 'desc');
		return $this->db->get()->result();
	}
	
	function delete_files($id = null)
	{
		$file = $this->get_files($id['id']);
		if (!$this->db->delete('files', $id))
		{
			return FALSE;
		}
		unlink(realpath(APPPATH . '../uploads/files/').'/' . $file[0]->server_name);	
		return TRUE;
	}
	
	
	#Pages Management
	function add_pages($data)
	{
		$this->db->insert('pages',$data);
		return $this->db->insert_id();
	}
	
	function edit_pages($data,$id)
	{
		$this->db->where('id', $id);
		return $this->db->update('pages', $data); 
	}
	
	function get_pages($options = array())
	{
		#Default Values
		$options = $this->_default(array('limit'=>20,'offset'=>0,'order_column' =>'pages.id','order_direction'=> 'desc'), $options);

		if (isset($options['page_id']))
		{
			$this->db->where('pages.id', $options['page_id']);
		}
		elseif(isset($options['slug']))
		{
			$this->db->where('pages.slug', $options['slug']);
		}
		elseif(isset($options['nolimit']))
		{
			if(isset($options['include_all']))
			{
				$this->db->select('*');
			}
			else
			{
				$this->db->select('pages.id');
			}
		}
		else
		{
			if(is_numeric($this->uri->segment($this->pagination->uri_segment)))
			{
				$options['limit'] = $this->pagination->per_page;
				$options['offset'] = $this->uri->segment($this->pagination->uri_segment);//= $this->db->limit($limit, $offset);
			}
			$this->db->limit($options['limit'], $options['offset']);
		}
		
		#Order Statement
		$this->db->order_by($options['order_column'], $options['order_direction']);

		return $this->db->get('pages')->result();
	}
		
	function delete_pages($id = null)
	{
		$this->db->where('id', $id);
		return $this->db->update('pages', array('status_id' => 3)); 
	}
	
	
	#Announcments Management
	function get_annoucements($id = null,$status_id = null)
	{
		$this->db->select('annoucements.*');		
		if (!is_null($id)) $this->db->where('annoucements.id', $id);
		else
		{
			if(is_numeric($this->uri->segment($this->pagination->uri_segment))  OR  ($this->uri->segment($this->pagination->uri_segment)) == null)
			$this->db->limit($this->pagination->per_page, $this->uri->segment($this->pagination->uri_segment));
		}
		if($status_id)
		{
			$this->db->where('status_id',$status_id);
		}
		
			$this->db->order_by('annoucements.id', 'desc');
		$res = $this->db->get('annoucements');
		
		return $res;
	}
	
	function delete_annoucements($id = null)
	{
		$this->db->where('id', $id);
		return $this->db->update('annoucements', array('status_id' => 3)); 
	}
	
	function add_annoucements($data)
	{
		$this->db->insert('annoucements',$data);
		return $this->db->insert_id();
	}

	function edit_annoucements($data,$id)
	{
		$this->db->where('id', $id);
		return $this->db->update('annoucements', $data); 
	}
	
	
	#Contact Us Management
	function contactus_message_add($data)
	{
		$this->db->insert('contactus_messages',$data);
		return $this->db->insert_id();
	}

	function contactus_message_reply($data)
	{
		$data['resource_type'] = 5;
		$this->db->insert('replies',$data);
		return $this->db->insert_id();
	}

	
	#Cookies Management
	function show_welcome()
	{
		if(!$this->Settings->welcome_message)
		{
			return FALSE;
		}
		if(!$this->get_user_id() == 0)
		{
			return FALSE;
		}
		else
		{
			$cookie_value = $this->input->cookie('welcome');
			if(!empty($cookie_value))
				return FALSE;
			else
			{
				return TRUE;
			}
		}
	}
	
	function disable_welcome()
	{
		$this->input->set_cookie("welcome",1,"432000000");
	}
	
	function filter_status()
	{
		if($this->ion_auth->is_admin())
		{
			return false;
		}
		elseif((($this->get_user_id() == 0)  AND ($this->input->cookie('AdultFilter')==1)) OR ((!$this->get_user_id() == 0) AND ($this->user_allows_adult_content($this->get_user_id()))))
		{
			
			return FALSE;
		}
		else
		{
			
			return TRUE;
		}
	}
	
	function enable_filter()
	{
		if(!$this->get_user_id() == 0)
		{
			$this->db->where('user_id',$this->get_user_id());
			$this->db->update('meta',array('adult_content'=>0));
		}
		$this->input->set_cookie("AdultFilter",0,"-1");
		session_destroy();
	}
	
	function disable_filter()
	{	
		if(!$this->get_user_id() == 0)
		{
			$this->db->where('user_id',$this->get_user_id());
			$this->db->update('meta',array('adult_content' =>1));
		}
		$this->input->set_cookie("AdultFilter",1,'4320000000');
	}
	
	function set_votes($resource_id, $resource_type, $value)
	{
		if($this->get_user_id() == 0)
		{
			$cookie_value = $this->input->cookie('votes');
			$value_array = json_decode($cookie_value);
			if(!empty($value_array))
			{
				array_push($value_array,$resource_id."-".$resource_type);
			}
			else
			{
				$value_array = array();
				array_push($value_array,$resource_id."-".$resource_type);
			}
			
			$cookie_value = json_encode($value_array);
			
			$cookie = array(
				'name'   => 'votes',
				'value'  => $cookie_value,
				'expire' => '4320000',
				'domain' => $_SERVER['HTTP_HOST'],
				'path'   => '/',
				'secure' => FALSE
			);
			
			$this->input->set_cookie($cookie);
		}
		$data = array(
			'value' => $value,
			'date_added' => date('Y-m-d H:i:s'),
			'user_id' => $this->get_user_id(),
			'resource_id' => $resource_id,
			'resource_type' => $resource_type
		);
		$this->db->insert('votes',$data);
		return $this->db->insert_id();
	}
	
	function add_moderation_ip($post_id,$ip_address,$user_id)
	{
		$this->db->insert('posts_moderation',array('post_id'=>$post_id,'ip_address'=>$ip_address,'date_added'=>date('Y-m-d H:i:s'),'user_id'=>$user_id));
		return $this->db->insert_id();
	}
	
	function get_moderation_ips($post_id = null)
	{
		if(isset($post_id))
		{
			$this->db->where(array('post_id' => $post_id));
			$this->db->select('ip_address');
		}
		return $this->db->get('posts_moderation')->result();
	}
	
	function navbar_moderation_number()
	{
		$posts = $this->mo9a7i_model->get_posts(array('status_id'=>4,'nolimit'=>true));
		$posts_to_skip = $this->get_posts_to_skip();
		foreach($posts as $key => $post)
		{
			if(in_array($post->id,$posts_to_skip))
			{
				unset($posts[$key]);
			}
		}
		
		return ((count($posts)>0)? count($posts) : "");
	}
	
	
	#Votes Management
	function get_votes($resource_id, $resource_type,$value)
	{
		$this->db->select_sum('value');
		$this->db->where(array('resource_type' => $resource_type,'resource_id'=>$resource_id,'value'=>$value));
		$query = $this->db->get('votes')->result();
		return (empty($query[0]->value) ? 0 : $query[0]->value );
	}
	
	function user_voted($user_id,$resource_id,$resource_type)
	{		
		if($user_id == 0)
		{
			$cookie = $this->input->cookie('votes');
			if(!empty($cookie))
			{ 
				$values = $cookie;
				$values_array = json_decode($values);
				if(in_array($resource_id."-".$resource_type,$values_array))
					return TRUE;
				else
					return FALSE;
			}
			else
			{
				return FALSE;
			}
		}
		else
		{
		if($this->db->get_where('votes', array('resource_id' => $resource_id,'resource_type' => $resource_type,'user_id' => $user_id))->num_rows() > 0)
			return TRUE;
		else
			return FALSE;
		}
	}
	
	
	#Reports Management
	function add_report($data)
	{
		$this->db->insert('reports',$data);
		return $this->db->insert_id();
	}
	
	//$resource_id = null, $resource_type = null)
	function get_reports($options = array())
	{
	
		#Default Values
		$options = $this->_default(array('status_id'=> 1,'order_column' =>'reports.id','order_direction'=> 'desc'), $options);

		#Limits section
		if (isset($options['resource_id']) AND isset($options['resource_type']))
		{
			$this->db->where(array('resource_type' => $options['resource_type'],'resource_id'=>$options['resource_id']));
			$this->db->select('reports.*,users.username,resource_types.name as resource_type,reports_categories.name as report_category');
		}
		elseif(isset($options['nolimit']))
		{
			$this->db->select('reports.id');
		}
		else
		{
			//If is the segment is number or is not set, limit to the number of pagination per page set globally, and start with the index of the segment.
			$limit 	= ((isset($options['limit'])) ? $options['limit'] : $this->pagination->per_page );
			$offset = ((isset($options['offset'])) ? $options['offset'] : $this->uri->segment($this->pagination->uri_segment) );
			
			if(is_numeric($this->uri->segment($this->pagination->uri_segment))  OR  ($this->uri->segment($this->pagination->uri_segment)) == null)
				$this->db->limit($limit, $offset);
			$this->db->select('reports.*,users.username,resource_types.name as resource_type,reports_categories.name as report_category');
		}
	
		$this->db->join('users','users.id = reports.user_id','left');
		$this->db->join('reports_categories','reports_categories.id = reports.report_category','left');
		$this->db->join('resource_types','resource_types.id = reports.resource_type','left');
		
		$this->db->where(array('reports.status_id' => $options['status_id']));
		
		#Order Statement
		$this->db->order_by($options['order_column'], $options['order_direction']);
		
		$res = $this->db->get('reports')->result();
		return $res;
	}
	
	function get_report_by_id($id = null)
	{
		if(isset($id))
			$this->db->where(array('id' => $id));
		$res = $this->db->get('reports')->result();
		return $res;
	}
	
	function delete_report($id = null)
	{
		if(isset($id))
		{
			//print_r($id);
			$this->db->where('id', $id);
			return $this->db->update('reports', array('status_id' => 3));
		}

	}
	
	
	#Contact us Managment
	function contactus_message_delete($id=null)
	{
		return $this->db->delete('contactus_messages', $id); 
	}
	
	function get_contactus($id = null)
	{
		$this->db->select('*,(select count(*) from replies where resource_id=contactus_messages.id and resource_type=5) as replies');
		if (!is_null($id)) $this->db->where('contactus_messages.id', $id);
		else
		{
			if(is_numeric($this->uri->segment($this->pagination->uri_segment))  OR  ($this->uri->segment($this->pagination->uri_segment)) == null)
			$this->db->limit($this->pagination->per_page, $this->uri->segment($this->pagination->uri_segment));
		}
			$this->db->order_by('contactus_messages.id', 'desc');
		return $this->db->get('contactus_messages')->result();
	}

	function get_contactus_replies($id = null)
	{
		$this->db->where(array('resource_id'=> $id,'resource_type'=>5));
		$this->db->order_by('id', 'desc');
		return  $this->db->get('replies')->result();
	}

	
	#Search Management
	function search_posts($keyword)
	{
		$this->db->like('title', $keyword); 
		$this->db->or_like('content', $keyword); 
		$this->db->order_by('id', 'desc');
		return $this->db->get('posts')->result();
	}
	
	function search_users($keyword,$faculty)
	{
		$names = explode(" ",$keyword);
		
		$this->db->select('users.id as id,ip_address,username,password,salt,email,activation_code,forgotten_password_code,remember_code,created_on,last_login,active,
							first_name,middle_name,last_name,date_of_birth,meta.phone,bio,
							countries.name as country_name,nationality,country,
							gender,
							groups.name as group_name,
							groups.id as group_id');
		$this->db->join('meta','meta.user_id = users.id','left');
		$this->db->join('users_groups','users_groups.user_id = users.id','left');
		$this->db->join('groups','users_groups.group_id = groups.id','left');
		$this->db->join('countries','countries.id = meta.country','left');

		if($faculty)
		{
			$this->db->where('users_groups.group_id', '3');
		}
		else
		{
			$this->db->where('users_groups.group_id !=', '3');
		}
		$imploded_names = implode(",",$names);
		
		$where = "(username IN ('$imploded_names') OR first_name IN ('$imploded_names') OR middle_name IN ('$imploded_names') OR last_name IN ('$imploded_names'))";
		
		$this->db->where($where); 	
		$this->db->order_by('users.id', 'desc');
		return $this->db->get('users')->result();
	}
	
	
	#General Use Functions
	##########################################################################################
	##########################################################################################
	##########################################################################################
	
	#Communication Managment
	//Emails Communication
	function email_not_active_user($email)
	{
		$content = "شكراً لتسجيلك معنا في جامعتك.كوم, عضويتك بإنتظار التفعيل من قبل إدارة الموقع. ستصلك رسالة إلى بريدك الإلكتروني قريباً عند التفعيل";
		$this->send_email($this->Settings->site_title, $this->Settings->admin_email, $email, 'عضويتك بإنتظار التفعيل', $content);
	}
	
	function email_activated_user($email)
	{
		$content = "تم تفعيل عضويتك بموقع جامعتك.كوم من قبل الإدارة, تفضل بزيارتنا وتسجيل الدخول والمشاركة الآن";
		$this->send_email($this->Settings->site_title, $this->Settings->admin_email, $email, 'عضويتك بإنتظار التفعيل', $content);
	}
	
	function send_email($from , $from_email , $to, $title, $content)
	{
		$this->email->clear();
		
		$this->email->from($from_email, $from);
		$this->email->to($to);
		$this->email->reply_to($from_email, $from);
		$this->email->subject($title);		
		
		$email['message'] = $content;
		$content = $this->load->view('includes/email_templates/normal', $email, TRUE); 
		$this->email->message($content);
		$this->email->set_alt_message($content);
		
		
		return $this->email->send();
	}
	
	//Twitter Communication
	function tweet($post_id)
	{
		if(!is_null($post_id))
		{
			$tweet_text = $this->mo9a7i_model->get_posts(array('post_id'=>$post_id));
			$tweet_text = $tweet_text[0];
			$my_text = $tweet_text->content;
			$my_text = $this->mo9a7i_model->sanitize_text($my_text);
			$characters_count = mb_strlen($my_text,'utf-8');
			
			if($characters_count >140 )
			{
				return "error1";
			}
			else
			{
			
				//Add laugh at end if joke is short
				
				//if($characters_count <137)
				//{
				//	$my_text = $my_text . " ";
				//	for($i= $characters_count;i <= 140;$i++)
				//	{
				//		$my_text = $my_text . "ه";
				//	}
				//}
			
				if($this->twitter->is_logged_in()) 
				{
					$this->twitter->post_tweet($my_text);
				}
				return "ok";
			}
		}
		else
		{
			return "error2";
		}
	}
	
	function get_categories_dropdown($table = 'groups')
	{
		$groups = $this->db->get($table)->result();
		$options = array();
		foreach($groups as $group)
		{
			$options[$group->id] = $group->name;
		}
		
		return $options;
	}

	function strip_html_tags( $text )
	{
		$text = preg_replace(
			array(
			  // Remove invisible content
				'@<head[^>]*?>.*?</head>@siu',
				'@<style[^>]*?>.*?</style>@siu',
				'@<script[^>]*?.*?</script>@siu',
				'@<object[^>]*?.*?</object>@siu',
				'@<embed[^>]*?.*?</embed>@siu',
				'@<applet[^>]*?.*?</applet>@siu',
				'@<noframes[^>]*?.*?</noframes>@siu',
				'@<noscript[^>]*?.*?</noscript>@siu',
				'@<noembed[^>]*?.*?</noembed>@siu',
			  // Add line breaks before and after blocks
				'@</?((address)|(blockquote)|(center)|(del))@iu',
				'@</?((div)|(h[1-9])|(ins)|(isindex)|(p)|(pre))@iu',
				'@</?((dir)|(dl)|(dt)|(dd)|(li)|(menu)|(ol)|(ul))@iu',
				'@</?((table)|(th)|(td)|(caption))@iu',
				'@</?((form)|(button)|(fieldset)|(legend)|(input))@iu',
				'@</?((label)|(select)|(optgroup)|(option)|(textarea))@iu',
				'@</?((frameset)|(frame)|(iframe))@iu',
			),
			array(
				' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ', ' ',
				"\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0", "\n\$0",
				"\n\$0", "\n\$0",
			),
			$text );
		return strip_tags( $text );
	}
	
	function add_blank_option($options, $blank_option = '') 
	{
		if (is_array($options) AND is_string($blank_option))
		{
		   if (empty($blank_option))
		   {
			  $blank_option = array( NULL => '--');
		   }
		   else
		   {
			  $blank_option = array( NULL => $blank_option);
		   }
		   $options = $blank_option + $options;
		   return $options;
		}
		else
		{
		   show_error("Wrong options array passed");
		}
	}

	function get_timestamp($date)
	{
		$a = '44';//strptime($date, 'd/m/Y');
		$timestamp = mktime(0, 0, 0, $a['tm_mon']+1, $a['tm_mday'], $a['tm_year']+1900);
		return $a;
	}

	function appendstr($string1,$string2){
		if((!empty($string2))){
			if(empty($string1)){
				$string1 = $string2;
			}
			else{
				$string1 = $string1 . ',' . $string2;
			}
		}
		return $string1;
	}
	
	//Send a file to the browser
	function send_to_browser($name,$file) 
	{
		force_download( $name , read_file($file) );
	}

	function dump_database($location = 'databases/database.sql')
	{
		// Load the DB utility class
		$this->load->dbutil();
		
		// Backup your entire database and assign it to a variable
		$prefs = array('format'=> 'txt','add_drop'=> TRUE,'add_insert'=> TRUE,'newline'=> "\n");
		$backup =& $this->dbutil->backup($prefs); 
		
		// Load the file helper and write the file to your server
		write_file($location, $backup);
		return "dumped successfully to ".$location;
	}
	
	// _default method combines the options array with a set of defaults giving the values in the options array priority.
	function _default($defaults, $options)
	{
		return array_merge($defaults, $options);
	}
	// _required method returns false if the $data array does not contain all of the keys assigned by the $required array.
	function _required($required, $data)
	{
		foreach($required as $field) if(!isset($data[$field])) return false;
		return true;
	}
	// Create an array with key/value pairs from an array of objects/arrays.
    function dropdown_array($array, $key, $value = null, $keep_empty_values = FALSE) 
	{
        if(!is_array($array)) { $array = array($array); }
        $ret = array('' => '&nbsp;');
        
        $key     = explode('|', $key);
        $value     = is_null($value) ? null : explode('|', $value);
        
        foreach($array as $item) {
            $bInclude = TRUE;
            $item = (array) $item;
            
            // Build the key
            $key_val = '';
            foreach($key as $k) {
                if(!isset($item[$k])) { $bInclude = FALSE; }
                else { $key_val .= $item[$k] . ' - '; }
            }
            $key_val = substr($key_val, 0, strlen($key_val) - 3);
            
            // Build the value
            $value_val = '';
            if(!is_null($value)) {
                foreach($value as $v) {
                    if(!isset($item[$v])) { $bInclude = FALSE; }
                    else { $value_val .= $item[$v] . ' - '; }
                }
            }
            $value_val = substr($value_val, 0, strlen($value_val) - 3);
            
            if($bInclude AND $keep_empty_values OR is_null($value) OR !empty($value_val)) {
                $ret[$key_val] = !is_null($value) ? $value_val : $item;
            }
        }
        
        return $ret;
    }

}
/* End of file mo9a7i_model.php */
/* Location: ./application/models/mo9a7i_model.php */