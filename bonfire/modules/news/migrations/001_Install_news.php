<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_news extends Migration {

    private $permission_array = array(
        'News.Content.Manage' => 'Manage News Content.',
        'News.Content.Add' => 'Add News Content.',
        'News.Content.Delete' => 'Delete News Content.',
    );

    public function up()
	{
		$prefix = $this->db->dbprefix;

        foreach ($this->permission_array as $name => $description)
        {
            $this->db->query("INSERT INTO {$prefix}permissions(name, description) VALUES('".$name."', '".$description."')");
            // give current role (or administrators if fresh install) full right to manage permissions
            $this->db->query("INSERT INTO {$prefix}role_permissions VALUES(1,".$this->db->insert_id().")");
        }
		// News Articles
                $sql = "CREATE TABLE `bf_news_articles` ( `id` int(11) NOT NULL AUTO_INCREMENT, `author` int(11) NOT NULL DEFAULT '-1', `title` varchar(255) NOT NULL, `date` int(11) DEFAULT NULL, `body` longtext, `attachment` varchar(1000) NOT NULL, `image_align` varchar(255) NOT NULL, `image_caption` varchar(255) NOT NULL, `tags` varchar(255) NOT NULL, `created_on` int(11) NOT NULL DEFAULT '0', `created_by` int(11) NOT NULL DEFAULT '-1', `modified_on` int(11) NOT NULL DEFAULT '0', `modified_by` int(11) NOT NULL DEFAULT '-1', `status_id` tinyint(1) NOT NULL DEFAULT '0', `category_id` tinyint(1) NOT NULL DEFAULT '0', `date_published` int(11) DEFAULT NULL, `deleted` tinyint(1) NOT NULL DEFAULT '0' , primary key (id) ) DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci";
		$this->db->query($sql);

                $sql = "CREATE TABLE `bf_news_categories` ( `id` int(11) NOT NULL AUTO_INCREMENT, `category` varchar(50) NOT NULL, `default` tinyint(1) NOT NULL DEFAULT '0' , primary key (id) ) DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci";
		$this->db->query($sql);
                
                $sql = "CREATE TABLE `bf_news_status` ( `id` int(11) NOT NULL AUTO_INCREMENT, `status` varchar(50) NOT NULL, `default` tinyint(1) NOT NULL DEFAULT '0' , primary key (id) ) DEFAULT CHARACTER SET = utf8 COLLATE = utf8_general_ci";
		$this->db->query($sql);
                
		$this->db->query("INSERT INTO {$prefix}news_categories VALUES(-1, 'Unknown', 0)");
		$this->db->query("INSERT INTO {$prefix}news_categories VALUES(1, 'Default', 1)");
			
		$this->db->query("INSERT INTO {$prefix}news_status VALUES(-1, 'Unknown', 0)");
		$this->db->query("INSERT INTO {$prefix}news_status VALUES(1, 'Draft', 1)");
		$this->db->query("INSERT INTO {$prefix}news_status VALUES(2, 'In Review', 0)");
		$this->db->query("INSERT INTO {$prefix}news_status VALUES(3, 'Published', 0)");
		$this->db->query("INSERT INTO {$prefix}news_status VALUES(4, 'Archived', 0)");
		$this->db->query("INSERT INTO {$prefix}news_status VALUES(5, 'Rejected', 0)");

        $default_settings = "
			INSERT INTO `{$prefix}settings` (`name`, `module`, `value`) VALUES
			 ('news.allow_attachments', 'news', '1'),
			 ('news.upload_dir_path', 'news', ''),
			 ('news.upload_dir_url', 'news', ''),
			 ('news.max_img_size', 'news', '125000'),
			 ('news.max_img_width', 'news', '1024'),
			 ('news.max_img_disp_width', 'news', '200'),
			 ('news.max_img_height', 'news', '768'),
			 ('news.max_img_disp_height', 'news', '200');
		";
        $this->db->query($default_settings);
	}
	
	//--------------------------------------------------------------------
	
	public function down() 
	{
        $prefix = $this->db->dbprefix;

        $this->dbforge->drop_table('news_articles');
		$this->dbforge->drop_table('news_categories');
		$this->dbforge->drop_table('news_status');
        $this->db->query("DELETE FROM {$prefix}settings WHERE (module = 'news')");

        foreach ($this->permission_array as $name => $description)
        {
            $query = $this->db->query("SELECT permission_id FROM {$prefix}permissions WHERE name = '".$name."'");
            foreach ($query->result_array() as $row)
            {
                $permission_id = $row['permission_id'];
                $this->db->query("DELETE FROM {$prefix}role_permissions WHERE permission_id='$permission_id';");
            }
            //delete the role
            $this->db->query("DELETE FROM {$prefix}permissions WHERE (name = '".$name."')");
        }
    }
	
	//--------------------------------------------------------------------
	
}
