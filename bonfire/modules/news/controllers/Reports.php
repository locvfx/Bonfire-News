<?php defined('BASEPATH') || exit('No direct script access allowed');

/**
 * Reports controller
 */
class Reports extends Admin_Controller
{
    protected $permissionCreate = 'News.Reports.Create';
    protected $permissionDelete = 'News.Reports.Delete';
    protected $permissionEdit   = 'News.Reports.Edit';
    protected $permissionView   = 'News.Reports.View';

    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->auth->restrict($this->permissionView);
        $this->load->model('news/news_model');
        $this->lang->load('news');
        
            $this->form_validation->set_error_delimiters("<span class='danger'>", "</span>");
        
        Template::set_block('sub_nav', 'reports/_sub_nav');

        Assets::add_module_js('news', 'news.js');
    }

    /**
     * Display a list of News data.
     *
     * @return void
     */
    public function index($offset = 0)
    {
        // Deleting anything?
        if (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);
            $checked = $this->input->post('checked');
            if (is_array($checked) && count($checked)) {

                // If any of the deletions fail, set the result to false, so
                // failure message is set if any of the attempts fail, not just
                // the last attempt

                $result = true;
                foreach ($checked as $pid) {
                    $deleted = $this->news_model->delete($pid);
                    if ($deleted == false) {
                        $result = false;
                    }
                }
                if ($result) {
                    Template::set_message(count($checked) . ' ' . lang('news_delete_success'), 'success');
                } else {
                    Template::set_message(lang('news_delete_failure') . $this->news_model->error, 'danger');
                }
            }
        }
        $pagerUriSegment = 5;
        $pagerBaseUrl = site_url(SITE_AREA . '/reports/news/index') . '/';
        
        $limit  = $this->settings_lib->item('site.list_limit') ?: 15;

        $this->load->library('pagination');
        $pager['base_url']    = $pagerBaseUrl;
        $pager['total_rows']  = $this->news_model->count_all();
        $pager['per_page']    = $limit;
        $pager['uri_segment'] = $pagerUriSegment;

        $this->pagination->initialize($pager);
        $this->news_model->limit($limit, $offset);
        
        $records = $this->news_model->find_all();

        Template::set('records', $records);
        
    Template::set('toolbar_title', lang('news_manage'));

        Template::render();
    }
    
    /**
     * Create a News object.
     *
     * @return void
     */
    public function create()
    {
        $this->auth->restrict($this->permissionCreate);
        
        if (isset($_POST['save'])) {
            if ($insert_id = $this->save_news()) {
                log_activity($this->auth->user_id(), lang('news_act_create_record') . ': ' . $insert_id . ' : ' . $this->input->ip_address(), 'news');
                Template::set_message(lang('news_create_success'), 'success');

                redirect(SITE_AREA . '/reports/news');
            }

            // Not validation error
            if ( ! empty($this->news_model->error)) {
                Template::set_message(lang('news_create_failure') . $this->news_model->error, 'danger');
            }
        }

        Template::set('toolbar_title', lang('news_action_create'));

        Template::render();
    }
    /**
     * Allows editing of News data.
     *
     * @return void
     */
    public function edit()
    {
        $id = $this->uri->segment(5);
        if (empty($id)) {
            Template::set_message(lang('news_invalid_id'), 'danger');

            redirect(SITE_AREA . '/reports/news');
        }
        
        if (isset($_POST['save'])) {
            $this->auth->restrict($this->permissionEdit);

            if ($this->save_news('update', $id)) {
                log_activity($this->auth->user_id(), lang('news_act_edit_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'news');
                Template::set_message(lang('news_edit_success'), 'success');
                redirect(SITE_AREA . '/reports/news');
            }

            // Not validation error
            if ( ! empty($this->news_model->error)) {
                Template::set_message(lang('news_edit_failure') . $this->news_model->error, 'danger');
            }
        }
        
        elseif (isset($_POST['delete'])) {
            $this->auth->restrict($this->permissionDelete);

            if ($this->news_model->delete($id)) {
                log_activity($this->auth->user_id(), lang('news_act_delete_record') . ': ' . $id . ' : ' . $this->input->ip_address(), 'news');
                Template::set_message(lang('news_delete_success'), 'success');

                redirect(SITE_AREA . '/reports/news');
            }

            Template::set_message(lang('news_delete_failure') . $this->news_model->error, 'danger');
        }
        
        Template::set('news', $this->news_model->find($id));

        Template::set('toolbar_title', lang('news_edit_heading'));
        Template::render();
    }

    //--------------------------------------------------------------------------
    // !PRIVATE METHODS
    //--------------------------------------------------------------------------

    /**
     * Save the data.
     *
     * @param string $type Either 'insert' or 'update'.
     * @param int    $id   The ID of the record to update, ignored on inserts.
     *
     * @return boolean|integer An ID for successful inserts, true for successful
     * updates, else false.
     */
    private function save_news($type = 'insert', $id = 0)
    {
        if ($type == 'update') {
            $_POST['id'] = $id;
        }

        // Validate the data
        $this->form_validation->set_rules($this->news_model->get_validation_rules());
        if ($this->form_validation->run() === false) {
            return false;
        }

        // Make sure we only pass in the fields we want
        
        $data = $this->news_model->prep_data($this->input->post());

        // Additional handling for default values should be added below,
        // or in the model's prep_data() method
        

        $return = false;
        if ($type == 'insert') {
            $id = $this->news_model->insert($data);

            if (is_numeric($id)) {
                $return = $id;
            }
        } elseif ($type == 'update') {
            $return = $this->news_model->update($id, $data);
        }

        return $return;
    }
}