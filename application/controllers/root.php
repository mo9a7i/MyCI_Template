<?php
/**
* F6sny.com 
* ===========
* Coded by: 	Mohannad Otaibi
* Email: 		mohannad.otaibi@gmail.com
* Website:		http://www.mohannadotaibi.com
* Date:			3/20/2012 *My 26th Birthday
*/
class Root extends CI_Controller{

	var $file;
	var $path;
	
	function test_xml()
	{
		echo $this->mo9a7i_model->run_cronjobs();
	}
	
	function reset_all_users($offset = 0)
	{
		$limit = 50;
		$this->load->library('ion_auth');
		#get user information
		$this->db->order_by('users.id','desc');
		$this->db->limit($limit, $offset);
		$results = $this->db->get('users')->result();
		
		foreach($results as $user)
		{
			$identity = $user->email;
			$key = $this->ion_auth->hash_password(microtime().$identity);
			$forgotten_password_code = $key;
			$this->db->update('users', array('forgotten_password_code' => $key), array('email' => $identity));
			$reset_link = "http://www.f6sny.com/auth/reset_password/".$forgotten_password_code;

			echo "Emailing ".$user->username." ....done<br>";
			
			$message = '<html dir="rtl">
			<head></head><body>
			<table style="font-family:arial;font-weight:bold;font-size:16px;" dir="rtl" width="100%" border="0" cellspacing="0" cellpadding="0"> 
			<tr><td><p>سلام '.$user->username.'
			<br><br>حبينا نقول لك إننا فتحنا الموقع من جديد (فطسني.كوم) وغيرنا البرمجة ونظفناه وضبطناه حبتين وبنضبط فيه أكثر وأكثر الأيام الجاية
			<br>نبي نشكرك مرررررة مرة على مشاركتك معنا قبل بالموقع ونتمناك ترجع وتشارك معنا مرة ثانية</p>
			<p>الباسوردات القديمة للأسف ماتقدرون تستخدمونها<br>لكن تقدر تسوي تحديث للباسورد حقك بكل سهولة وتقدر تسوي تحديث للملف الشخصي حقك برضه بالضغط على الرابط التالي:
			</p><p><br><a href="'.$reset_link.'">إستعادة كلمة المرور</a><br><span style="font-family:tahoma;font-size:13px;font-weight:normal;">أول ماتضغط, بتجيك رسالة ثانية على إيميلك فيها الباسورد الجديد, إدخل وغيره على طول</span></p><br><p>ملاحظة:<span style="font-weight:normal;">الحين, لتسجيل الدخول, بدال ما تحط يوزرك, حط إيميلك</span></p>
			<p>إذا إحتجت أي مساعدة, بلغنا ومالك إلا طيبة الخاطر, بكل بساطة رد على هالإيميل</p>
			<br><p>نشوفك على خير,</p><p>تحياتي,<br>موصاحي</p>
		</td></tr></table></body></html>';
		
			$this->mo9a7i_model->send_email("F6sny.com فطسني.كوم" , "admin@f6sny.com" , $user->email, "فطسني.كوم عاد إليكم من جديد", $message);
		}

		$offset = $offset + $limit;
		redirect(base_url()."root/reset_all_users/".$offset);
	}
	
	
	function create_sitemap()
	{
		$this->load->library('sitemaps');
		//assuming a hypothetical posts_model
		
		$posts = $this->mo9a7i_model->get_posts(array('status_id'=>1,'nolimit'=>TRUE,'include_all'=>TRUE));
		
		foreach ($posts AS $post)
		{
			$item = array(
				"loc" => site_url("jokes/" . urlencode($post->slug)),
				"lastmod" => date("c", strtotime($post->date_added)),
				"changefreq" => "daily",
				"priority" => "0.8"
			);

			$this->sitemaps->add_item($item);
		}
		echo "Got ".count($posts)." Jokes and added them <br>";
		
		$pages = $this->mo9a7i_model->get_pages(array('status_id'=>1,'nolimit'=>TRUE,'include_all'=>TRUE));
		foreach ($pages AS $page)
		{
			$item = array(
				"loc" => site_url("page/" . urlencode($page->slug)),
				"lastmod" => date("c", strtotime($page->date_added)),
				"changefreq" => "monthly",
				"priority" => "0.3"
			);

			$this->sitemaps->add_item($item);
		}
		echo "Got ".count($pages)." pages and added them <br>";
		
		$members = $this->mo9a7i_model->get_users(array('status_id'=>1,'nolimit'=>TRUE,'include_all'=>TRUE));
		foreach ($members AS $member)
		{
			$item = array(
				"loc" => site_url("members/" . urlencode($member->username)),
				"lastmod" => date("c", strtotime($member->created_on)),
				"changefreq" => "never",
				"priority" => "0.5"
			);

			$this->sitemaps->add_item($item);
		}
		echo "Got ".count($members)." members and added them <br>";
		
		// file name may change due to compression
		
		$file_name = $this->sitemaps->build("sitemap_blog.xml");
		echo "Created and compressed sitemap <br>";
		$reponses = $this->sitemaps->ping(site_url($file_name));
		echo "Pinged search engines";

	}
	
	function set_post_modified()
	{
		$posts = $this->db->get('posts')->result();
		$counter = 0;
		foreach ($posts as $post)
		{
			if(empty($post->date_modified))
			{
				$date_modified = $post->date_added;
				//echo $slug; die();
				$this->db->where('posts.id', $post->id);
				$this->db->update('posts',array('date_modified'=>$date_modified));
				echo $post->id . " updated <br>";
				$counter++;
			}
		}
		echo $counter.":".count($posts);
	}
	
	
	function set_posts_slugs()
	{
		$this->db->update('posts',array('slug'=>'null'));
		$posts = $this->db->get('posts')->result();
		$counter = 0;
		foreach ($posts as $post)
		{
			if($post->slug == "null")
			{
				$slug = $this->mo9a7i_model->create_slug($post->content);
				//echo $slug; die();
				$this->db->where('posts.id', $post->id);
				$this->db->update('posts',array('slug'=>$slug));
				echo $post->id . " updated <br>";
				$counter++;
			}
		}
		echo $counter.":".count($posts);
	}
	
	function reset_posts_titles()
	{
		$this->db->update('posts',array('title'=>'null'));
		$posts = $this->db->get('posts')->result();
		$counter = 0;
		foreach ($posts as $post)
		{
			if($post->title == "null")
			{
				$title = $this->mo9a7i_model->create_slug($post->content);
				$title = str_replace('-',' ',$title);
				//echo $slug; die();
				$this->db->where('posts.id', $post->id);
				$this->db->update('posts',array('title'=>$title));
				echo $post->id . " updated <br>";
				$counter++;
			}
		}
		echo $counter.":".count($posts);
	}
	
	function test_send_mail()
	{
		$this->mo9a7i_model->send_email("DoIt" , "Mohannad.otaibi@gmail.com" , "Mohannad.otaibi@gmail.com", "Testy", "ياسلام عليك");
	}
	
	function test_sanitize()
	{
		$text = "يقول لك, مرة فيه واحد جاب العيد وراح للمكان الغلط, وذاك اليوم عاد ماصار حظه زين";
		echo $this->mo9a7i_model->sanitize_text($text);
		echo "<br>";
		$slug = $this->mo9a7i_model->create_slug($text);
		echo $slug;
		echo "<br>";
		echo $this->mo9a7i_model->get_unique_slug(array('table'=>'posts','slug'=>$slug));
	}
	
	function reset_admin()
	{
		$salty = $this->ion_auth_model->salt();
		$password = $this->ion_auth_model->hash_password('12345678',$salty);
		$data = array(
			'password' => $password,
			'salt' => $salty
		);
		$this->db->where('id', 1);
		$this->db->update('users', $data); 
	}
	
	function move_users()
	{
		echo "<pre>";
		$this->add_remarks();
		$this->db_old = $this->load->database('old', TRUE); 
		
		//Move Users
		$this->db->truncate('users');
		$this->db->truncate('users_groups');
		$this->db->truncate('meta');
		$this->db_old->select('*');
		$this->db_old->order_by('id');
		$records = $this->db_old->get('users')->result();
		foreach ($records as $record)
		{
			$salty = $this->ion_auth_model->salt();
			$password = $this->ion_auth_model->hash_password($record->user_pass,$salty);
			$data = array(
				'id' => $record->ID,
				'username' => $record->user_login,
				'password' => $password, 
				'salt' => $salty,
				'email' => $record->user_email,
				'created_on' => $record->user_registered,
				'active' => ($record->user_status == 0 ? 1 : 2),
				'convert_remarks' => serialize($record)
			);
			
			$this->db->insert('users',$data);
			$user_id = $this->db->insert_id();

			//add meta
			$first_name = $this->db_old->get_where('usermeta', array('meta_key' => "first_name" , 'user_id' => $user_id))->row();
			$last_name = $this->db_old->get_where('usermeta', array('meta_key' => "last_name" , 'user_id' => $user_id))->row();
			$user_level = $this->db_old->get_where('usermeta', array('meta_key' => "user_level" , 'user_id' => $user_id))->row();
			
			if( !empty($first_name->meta_value) OR !empty($last_name->meta_value))
			{
				$meta['user_id'] = $user_id;
				if( !empty($first_name->meta_value))
				{
					$meta['first_name'] = $first_name->meta_value;
				}
				if( !empty($last_name->meta_value))
				{
					$meta['last_name'] = $last_name->meta_value;
				}
			$this->mo9a7i_model->add_meta($meta);
			}
			
			//add to group
			if(!empty($user_level->meta_value) AND $user_level->meta_value == 10)
			{
				$this->ion_auth->add_to_group(1, $user_id);
			}
			else
			{
				$this->ion_auth->add_to_group(2, $user_id);
			}
		//End foreach user
		}
	}
	
	
	function move_posts()
	{
		echo "<pre>";
		$this->add_remarks();
		$this->db_old = $this->load->database('old', TRUE); 
		
		//Move Posts
		$this->db->truncate('posts');
		$this->db_old->select('*');
		$this->db_old->order_by('id');
		$records = $this->db_old->get_where('posts', array('post_type' => "post"))->result();
		foreach ($records as $record)
		{
			//print_r($record);
			//die();
			switch($record->post_status)
			{
				case "publish" 	: $post_status = 1 ; break;
				case "draft" 	: $post_status = 4 ; break;
				case "trash" 	: $post_status = 3 ; break;
				default 		: $post_status = 4 ; break;
			
			}
			$data = array(
				'id' => $record->ID,
				'title' => $record->post_title,
				'content' => $record->post_content,
				'date_added' => $record->post_date,
				'date_modified' => $record->post_modified,
				//'cat_id' => 1,
				'user_id' => $record->post_author,
				'status_id' => $post_status,
				'convert_remarks' => serialize($record)
			);
			$this->db->insert('posts',$data);
			$post_id = $this->db->insert_id();
			
			$ips = $this->db_old->get_where('postmeta', array('meta_key' => "post_moder_ips" , 'post_id' => $post_id))->row();
			if(!empty($ips))
			{
				$ips = explode(',',$ips->meta_value);
				foreach($ips as $ip)
				{
					$data = array(
					'post_id' => $post_id,
					'ip_address' => $ip,
					);
					$this->db->insert('posts_moderation',$data);
				}
				//print_r($ips);
				//die();
			}
			
		}
	}
	
	
	function move_comments()
	{
		echo "<pre>";
		$this->add_remarks();
		$this->db_old = $this->load->database('old', TRUE); 
		
		//Move Comments
		$this->db->truncate('replies');
		$this->db_old->select('*');
		$this->db_old->order_by('comment_ID');
		$records = $this->db_old->get('comments')->result();
		foreach ($records as $record)
		{
			$data = array(
				'id' => $record->comment_ID,
				'title' => 'Comment',
				'content' => $record->comment_content,
				'date_added' => $record->comment_date,
				'resource_id' => ($record->comment_parent == 0 ? $record->comment_post_ID : $record->comment_parent ),
				'resource_type' => ($record->comment_parent == 0 ? 2 : 10 ),
				'user_id' => $record->user_id,
				'status_id' => ($record->comment_approved == 1 ? 1 : 3 ),
				'convert_remarks' => serialize($record)
				);
			if($record->user_id == 0)
			{
				$data['author'] = $record->comment_author;
				$data['author_email'] = $record->comment_author_email;
				$data['author_url'] = $record->comment_author_url;
				$data['author_ip'] = $record->comment_author_IP;
			}
			$this->db->insert('replies',$data);
		}	
	}
	
	function move_tags()
	{
		echo "<pre>";
		$this->add_remarks();
		$this->db_old = $this->load->database('old', TRUE); 
		
		//Move tags
		$this->db->truncate('tags');
		$this->db->truncate('tags_relations');
		
		$this->db_old->select('*');
		$this->db_old->from('terms');
		$this->db_old->join('term_taxonomy', 'term_taxonomy.term_id = terms.term_id');
		$this->db_old->where('taxonomy', 'post_tag'); 
		$this->db_old->order_by('terms.term_id');
		$records = $this->db_old->get()->result();
		
		foreach ($records as $record)
		{
			$data = array(
				'id' => $record->term_id,
				'title' => $record->name,
				'slug' => $record->slug,
				'description' => $record->description,
				'count' => $record->count,
				'convert_remarks' => serialize($record)
				);
			$this->db->insert('tags',$data);
		}
		
		$this->db_old->select('*');
		$records = $this->db_old->get('term_relationships')->result();
		foreach ($records as $record)
		{
			$data = array(
				'resource_id' => $record->object_id,
				'resource_type' => 2,
				'tag_id' => $record->term_taxonomy_id,
				'convert_remarks' => serialize($record)
				);
			$this->db->insert('tags_relations',$data);
		}
	}
	
	function migrate()
	{
		echo "<pre>";
		$this->add_remarks();
		$this->db_old = $this->load->database('old', TRUE); 
		
		die();
		
		
		//move Rating questions
		$this->db_old->select('*');
		$this->db_old->order_by('id');
		$evals = $this->db_old->get('ratingmain')->result();
		
		$this->db->empty_table('evaluation_questions');
		foreach ($evals as $eval)
		{
			$data = array(
				'id' => $eval->ID,
				'question' => $eval->title,
				'evaluation_type' => 1,
				'convert_remarks' => serialize($eval)
			);
			$this->db->insert('evaluation_questions',$data);
		}
		
		
		//move Rating answers
		$this->db_old->select('*');
		$this->db_old->order_by('id');
		$answers = $this->db_old->get('ratingsub')->result();
		
		$this->db->empty_table('evaluation_answers');

		foreach ($answers as $answer)
		{
			$data = array(
				'id' => $answer->ID,
				'answer' => $answer->title,
				'value' => $answer->value,
				'question_id' => $answer->id_main,
				'convert_remarks' => serialize($answer)
			);
			if(!is_null($answer->value))
				$this->db->insert('evaluation_answers',$data);
		}

		//move universities
		$this->db_old->select('univ.*,city.title as city,area.title as area');
		$this->db_old->join('city','univ.city_id = city.id');
		$this->db_old->join('area','univ.area_id = area.id');
		$this->db_old->order_by('univ.id');
		$universities = $this->db_old->get('univ')->result();
		
		$this->db->empty_table('institutes');
		foreach ($universities as $university)
		{
			$data = array(
				'id' => $university->ID,
				'name' => $university->title,
				'address' => $university->area . ' ' .$university->city,
				'date_added' => date('Y-m-d H:i:s'),
				'country_id' => '1',
				'institute_level_id' => 3,
				'convert_remarks' => serialize($university)
			);
			$this->db->insert('institutes',$data);
		}

		
		//move members
		$this->db_old->select('*');
		$this->db_old->order_by('id');
		$members = $this->db_old->get('member')->result();
		
		$this->db->empty_table('users');
		$this->db->empty_table('users_groups');
		$this->db->empty_table('meta');
		
		foreach ($members as $member)
		{
			$salty = $this->ion_auth_model->salt();
			$password = $this->ion_auth_model->hash_password($member->password,$salty);
			$data = array(
				'id' => $member->ID,
				'username' => $member->username,
				'email' => $member->email,
				'active' => 1,
				'salt' => $salty,
				'password' => $password, 
				'created_on' => $member->reg_date,
				'convert_remarks' => serialize($member)
			);
			
			$this->db->insert('users',$data);
			$user_id = $this->db->insert_id();

			//add meta
			$meta = array(
				'user_id' => $user_id,
				'first_name' => $member->firstname,
				'last_name' => $member->lastname,
				'institute_id' => $member->univ_id,
			);
			$this->mo9a7i_model->add_meta($meta);
			
			
			//add to group
			if($member->mode === 'admin')
			{
				$this->ion_auth->add_to_group(1, $user_id);
			}
			else
			{
				$this->ion_auth->add_to_group(2, $user_id);
			}
			
		}
		
		
		//Move professors
		$this->db_old->select('*');
		$this->db_old->order_by('id');
		$profs = $this->db_old->get('prof')->result();
		
		$this->db->empty_table('evaluations');
		$this->db->empty_table('replies');
		$this->db->empty_table('grades');
		foreach ($profs as $prof)
		{
			$salty = $this->ion_auth_model->salt();
			$password = $this->ion_auth_model->hash_password('1',$salty);
			$this->load->helper('string');
			$data = array(
				'username' => $prof->titleen,
				'email' => random_string('alnum', 10)."@".random_string('alnum', 10).".com",
				'active' => 2,
				'salt' => $salty,
				'password' => $password, 
				'created_on' => $prof->date,
				'convert_remarks' => serialize($prof)
			);
			
			$this->db->insert('users',$data);
			$prof_id = $this->db->insert_id();

			//add meta
			$meta = array(
				'user_id' => $prof_id,
				'first_name' => $prof->title,
				'middle_name' => $prof->lastname,
				'last_name' => $prof->familyname,
				'bio' => $prof->nation . (!empty($prof->info)? ": " . $prof->info : '') ,
				'referrer_id' => $prof->userid,
				'institute_id' => $prof->univ_id
			);
			////////////////////////////////////////////////////Here
			
			$this->db_old->where('id',$prof->spac);
			$spac_array = $this->db_old->get("spec")->result();
			$spac = $spac_array[0]->title;

			$this->db->where('name',$spac);
			$query = $this->db->get("departments");
			if ($query->num_rows() > 0)
			{
				$meta['department_id'] = $query->row()->id;
			}
			else
			{
				$this->db->insert('departments',array('name'=>$spac,'convert_remarks'=>'moved from old db in june 2012'));
				$meta['department_id'] = $this->db->insert_id() ;
			}
			//Check if they are assigned to eachother, if not assign them
			
			$this->mo9a7i_model->add_meta($meta);
			$this->mo9a7i_model->link_departments_institutes($meta['institute_id'],$meta['department_id']);
			
			//Professor Comments
			$this->db_old->select('*');
			$this->db_old->where('prof_id',$prof->ID);
			$prof_comments = $this->db_old->get('rating_com')->result();
			
			
			foreach ($prof_comments as $prof_comment)
			{
				$replies = array(
					'id' => $prof_comment->ID,
					'title' => 'Comment on Professor',
					'content' => $prof_comment->comment,
					'resource_id' => $prof_id,
					'resource_type' => 1,
					'user_id' => $prof_comment->userid,
					'status_id' => 1,
					'date_added' => $prof_comment->date,
					'convert_remarks' => serialize($prof_comment)
					);
				//print_r($replies);
				if(!empty($prof_comment->comment))
				{
					//echo "<br />";
					$this->db->insert('replies',$replies);
					//echo "comment inserted with id: ".$this->db->insert_id();
					//echo "<br />";
				}
			}	
			
			//Professor grades
			$this->db_old->select('*');
			$this->db_old->where('prof_id',$prof->ID);
			$prof_grades = $this->db_old->get('rating_com')->result();
			
			foreach ($prof_grades as $prof_grade)
			{
				$grades = array(
					'id' => $prof_grade->ID,
					'grade' => $prof_grade->mat_num,
					'subject' => $prof_grade->mat_name,
					'resource_id' => $prof_id,
					'resource_type' => 1,
					'user_id' => $prof_grade->userid,
					'status_id' => ($prof_grade->view_de === "YES" ? 1 : 2 ),
					'date_added' => $prof_grade->date,
					'convert_remarks' => serialize($prof_grade)
					);
				
				//print_r($grades);
				if(!empty($prof_grade->mat_num))
				{
					//echo "<br />";
					$this->db->insert('grades',$grades);
					//echo "grade inserted with id: ".$this->db->insert_id();
					//echo "<br />";
				}
			}
			
			
			//Professor rating
			$this->db_old->select('*');
			$this->db_old->where('prof_id',$prof->ID);
			$rates = $this->db_old->get('rating')->result();
			
			
			foreach ($rates as $rate)
			{
				$rating = array(
					'id' => $rate->ID,
					'evaluation_question' => $rate->rating_main,
					'resource_id' => $prof_id,
					'user_id' => $rate->userid,
					'evaluation_value' => $rate->value,
					'date_added' => date('Y-m-d H:i:s'),
					'convert_remarks' => serialize($rate)
					);
				//print_r($rating);
				//echo "<br />";
				$this->db->insert('evaluations',$rating);
				//echo "inserted with id: ".$this->db->insert_id();
				//echo "<br />";
			}	
				
			//add to group
			$this->ion_auth->add_to_group(3, $prof_id);
			
			//add link
			if(!$prof->website === 'http://www.')
			{
				set_urls('Faculty website' , $prof->website, $prof_id , 1);
			}
		}

		//move contactus forms
		// $this->db_old->select('*');
		// $this->db_old->order_by('id');
		// $contactuses = $this->db_old->get('contact')->result();
		
		// $cats = $this->db->get('contactus_categories')->result();
		// $this->db->empty_table('contactus_categories');
		// $this->db->empty_table('contactus_messages');
		
		// $this->db->delete('replies',array('resource_type'=>5));
		
		// foreach ($contactuses as $contactus)
		// {
			// $data = array(
				// 'id' => $contactus->ID,
				// 'title' => $contactus->title,
				// 'content' => $contactus->body,
				// 'email_address' => $contactus->email,
				// 'date_added' => $contactus->add_date,
				// 'status_id' => 1,
				// 'convert_remarks' => serialize($contactus)
			// );
			
			// $this->db->where('name',$contactus->type);
			// $query = $this->db->get("contactus_categories");
			// if ($query->num_rows() > 0)
			// {
				// $data['category_id'] = $query->row()->id;
			// }
			// else
			// {
				// $this->db->insert('contactus_categories',array('name'=>$contactus->type));
				// $data['category_id'] = $this->db->insert_id();
			// }
			
			// $this->db->insert('contactus_messages',$data);
			// $contactus_id = $this->db->insert_id();
			//move it's replies
			// if(!$contactus->replay_date == null)
			// {
				// $reply = array(
					// 'title' => 'RE: '.$contactus->title,
					// 'content' => $contactus->reply,
					// 'date_added' => $contactus->replay_date,
					// 'resource_id' => $contactus_id,
					// 'resource_type' => 5,
					// 'user_id' => 1,
					// 'status_id' => 1
				// );
				// $this->db->insert('replies',$reply);	
			// }
		// }
		
		
		
		
		//move pages
		$this->db_old->select('*');
		$this->db_old->order_by('id');
		$pages = $this->db_old->get('pages')->result();
		
		$this->db->empty_table('pages');
		foreach ($pages as $page)
		{
			$data = array(
				'id' => $page->ID,
				'title' => $page->title,
				'content' => $page->body,
				'date_added' => $page->add_date,
				'status_id' => ($page->active === 'YES' ? 1 : 2 ),
				'convert_remarks' => serialize($page)
			);
			$this->db->insert('pages',$data);
			$page_id = $this->db->insert_id();
			$views = array(
				'count' => $page->view,
				'resource_id' => $page_id,
				'resource_type' => 3
			);
			
			$this->db->insert('views',$views);
		}
		//move News Categories
		$this->db_old->select('*');
		$this->db_old->order_by('id');
		$this->db_old->where('type','articles');
		$ncats = $this->db_old->get('cat')->result();
		
		$this->db->empty_table('news_categories');
		foreach ($ncats as $ncat)
		{
			$data = array(
				'id' => $ncat->ID,
				'name' => $ncat->title,
				'convert_remarks' => serialize($ncat)
			);
			$this->db->insert('news_categories',$data);
		}
		
		//move News
		$this->db_old->select('*');
		$this->db_old->order_by('id');
		$news = $this->db_old->get('articles')->result();
		
		$this->db->empty_table('news');
		foreach ($news as $new)
		{
			$data = array(
				'id' => $new->ID,
				'title' => $new->title,
				'content' => $new->body,
				'date_added' => $new->add_date,
				'cat_id' => $new->cat,
				'user_id' => $new->meb_id,
				'status_id' => ($new->active === 'YES' ? 1 : 2 ),
				'convert_remarks' => serialize($new)
			);
			$this->db->insert('news',$data);
			$news_id = $this->db->insert_id();
			$data = array(
					'image_name' => $new->images,
					'server_name' => $new->images,
					'date_added' =>  $new->add_date,
					'user_id' => $new->meb_id,
					'resource_id' => $news_id,
					'resource_type' => 2
				);
				$image_id = $this->mo9a7i_model->add_images($data);
			
			$views = array(
				'count' => $new->view,
				'resource_id' => $news_id,
				'resource_type' => 2
			);
			
			$this->db->insert('views',$views);
		}
		
		//$res = $this->db->get('institutes')->result();
		//print_r($res);
		
		$this->reset_admin();
	}
	
	
	function Root()
	{
		parent::__construct();
		$this->path = "databases" . DIRECTORY_SEPARATOR;
		$this->file =  $this->path . "database.sql";
	}
	
	function index()
	{
		echo "You are not allowed to view this page!";
	}
	
	function insall()
	{
		//Restore the backed up database from dump() method
		//It is mainly intended for installation purposes
	}
	

	function dump()
	{
		// Load the DB utility class
		$this->load->dbutil();
		
		// Backup your entire database and assign it to a variable
		$prefs = array('format'=> 'txt','add_drop'=> TRUE,'add_insert'=> TRUE,'newline'=> "\n");
		$backup =& $this->dbutil->backup($prefs); 
		
		// Load the file helper and write the file to your server
		write_file($this->file, $backup);
		echo "dumped successfully to ".$this->file;
	}
	
	function test()
	{
		// mysqldump --default-character-set=latin1 --skip-set-charset -d jam3tkc_jam3tkc  > jam3tkc_jam3tkc_schema.sql
		// mysqldump --default-character-set=latin1 --skip-set-charset -t  jam3tkc_jam3tkc > jam3tkc_jam3tkc_data.sql
		// iconv -f windows-1256 -t utf8 jam3tkc_jam3tkc_schema.sql > jam3tkc_jam3tkc_schema_utf8.sql
		// iconv -f windows-1256 -t utf8 jam3tkc_jam3tkc_data.sql > jam3tkc_jam3tkc_data_utf8.sql
		// sed -i -e s:DEFAULT CHARSET=latin1:DEFAULT CHARSET=utf8:g jam3tkc_jam3tkc_schema.sql
		// mysql -e 'CREATE DATABASE jam3tkc_new DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci'
		// mysql --default-character-set=utf8 jam3tkc_new < jam3tkc_jam3tkc_schema_utf8.sql
		// mysql --default-character-set=utf8  jam3tkc_new < jam3tkc_jam3tkc_data_utf8.sql

		// echo "<pre dir=ltr>";
		
		// $this->db_old = $this->load->database('old', TRUE); 
		// $query = $this->db_old->query('select count(*) from prof where LENGTH(lastname) != CHAR_LENGTH(lastname)');
		// print_r($query->result());
		// echo "<br />";
		
		// $this->db_old->query('SET NAMES latin1');
		// $query = $this->db_old->query('select lastname,HEX(lastname) from prof');
		// print_r($query->result());
		// echo "<br />";
		
		// $this->db_old->query('SET NAMES utf8');
		// $query = $this->db_old->query('select lastname,HEX(lastname) from prof');
		// print_r($query->result());
		// echo "<br />";
		
		//$query = $this->db_old->query('create table temptable (select * from prof where LENGTH(lastname) != CHAR_LENGTH(lastname))');
		//print_r($query->result());
		//echo "<br />";
		
		//$query = $this->db_old->query('alter table temptable modify temptable.title varchar(250) CHARACTER SET latin1');
		
		//$query = $this->db_old->query('alter table temptable modify temptable.title blob');
		
		//$query = $this->db_old->query('alter table temptable modify temptable.title varchar(250) character set utf8');
		
		
		// $tables = $this->db_old->list_tables();
		
		// foreach ($tables as $table)
		// {
			// $fields = $this->db_old->field_data($table);

			// foreach ($fields as $field)
			// {
				
			   // echo $table . "." . $field->name . " ".$field->type; 
			   // echo !empty($field->max_length) ? "(".  $field->max_length . ")" : ""; 
			   // echo "<br />";
			// }
			// echo "<br />";
		   
		// }
	}
	
	
	function add_remarks()
	{
		$this->load->dbforge();
		$tables = $this->db->list_tables();
		$fields = array(
                        'convert_remarks' => array(
                                                 'type' => 'TEXT',
                                                 'constraint' => 99999999,
												 'null' => true,
                                          )
                );
				
		foreach ($tables as $table)
		{	
			if (!$this->db->field_exists('convert_remarks', $table))
			{
				$this->dbforge->add_column($table,$fields);
				echo "Created ".$table.".convert_remarks"."<br />";
			} 
		}
	}
	
}