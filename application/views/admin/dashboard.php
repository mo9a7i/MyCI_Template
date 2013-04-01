<div id="body">
	<div class="page-header ">	
		<h1>مرحباً بك في لوحة التحكم</h1>
		<p>أختر من القائمة على يمين الشاشة لبدء إدارة الموقع. سيتم إعادة بناء هذه الصفحة لاحقاً على حسب طلب الإداريين</p>
	</div>
	<div class="row-fluid">
		<div class="span12">
			<h4>إحصائيات</h4>
		</div>
	</div>
	<div class="row-fluid">

		<div class="span3">
			<ul class="unstyled well well-small">
				<li><strong>الأعضاء المفعلين:</strong> <?php $this->db->where('active',1); echo $this->db->count_all_results('users');?></li>
				<li><strong>الأعضاء بإنتظار التفعيل:</strong> <?php $this->db->where('active',4); echo $this->db->count_all_results('users');?></li>
				<li><strong>الأعضاء الغير مفعلين:</strong> <?php $this->db->where('active',2); echo $this->db->count_all_results('users');?></li>
				<li><strong>الأعضاء المحذوفين:</strong> <?php $this->db->where('active',3); echo $this->db->count_all_results('users');?></li>
			</ul>
		</div>
		<div class="span3">
			<ul class="unstyled well well-small">
				<li><strong>النكت المفعلة:</strong> <?php $this->db->where('status_id',1); echo $this->db->count_all_results('posts');?></li>
				<li><strong>النكت بإنتظار التفعيل:</strong> <?php $this->db->where('status_id',4); echo $this->db->count_all_results('posts');?></li>
				<li><strong>النكت الغير مفعلة:</strong> <?php $this->db->where('status_id',2); echo $this->db->count_all_results('posts');?></li>
				<li><strong>النكت المحذوفة:</strong> <?php $this->db->where('status_id',3); echo $this->db->count_all_results('posts');?></li>
			</ul>
		</div>
		<div class="span3">
			<ul class="unstyled well well-small">
				<li><strong>التعليقات المفعلة:</strong> <?php $this->db->where('status_id',1); echo $this->db->count_all_results('replies');?></li>
				<li><strong>التعليقات بإنتظار التفعيل:</strong> <?php $this->db->where('status_id',4); echo $this->db->count_all_results('replies');?></li>
				<li><strong>التعليقات الغير مفعلة:</strong> <?php $this->db->where('status_id',2); echo $this->db->count_all_results('replies');?></li>
				<li><strong>التعليقات المحذوفة:</strong> <?php $this->db->where('status_id',3); echo $this->db->count_all_results('replies');?></li>
			</ul>
		</div>
		<div class="span3">
			<ul class="unstyled well well-small">
				<li><strong>الصفحات :</strong> <?=$this->db->count_all('pages');?></li>
				<li><strong>التبليغات :</strong> <?=$this->db->count_all('reports');?></li>
				<li><strong>إتصل بنا :</strong> <?=$this->db->count_all('contactus_messages');?></li>
			</ul>
		</div>
	</div>
</div>