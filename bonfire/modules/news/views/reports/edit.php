<?php

if (validation_errors()) :
?>
<div class='alert alert-block alert-danger fade in'>
    <a class='close' data-dismiss='alert'>&times;</a>
    <h4 class='alert-heading'>
        <?php echo lang('news_errors_message'); ?>
    </h4>
    <?php echo validation_errors(); ?>
</div>
<?php
endif;

$id = isset($news->id) ? $news->id : '';

?>
<div class='admin-box'>
    <h3>News</h3>
    <?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
        <fieldset>
            

            <div class="control-group<?php echo form_error('author') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_author') . lang('bf_form_label_required'), 'author', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='author' type='text' required='required' name='author' maxlength='11' value="<?php echo set_value('author', isset($news->author) ? $news->author : ''); ?>" />
                    <span class='help-block'><?php echo form_error('author'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('title') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_title') . lang('bf_form_label_required'), 'title', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='title' type='text' required='required' name='title' maxlength='255' value="<?php echo set_value('title', isset($news->title) ? $news->title : ''); ?>" />
                    <span class='help-block'><?php echo form_error('title'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('date') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_date'), 'date', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='date' type='text' name='date' maxlength='11' value="<?php echo set_value('date', isset($news->date) ? $news->date : ''); ?>" />
                    <span class='help-block'><?php echo form_error('date'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('body') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_body'), 'body', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <?php echo form_textarea(array('name' => 'body', 'id' => 'body', 'rows' => '5', 'cols' => '80', 'value' => set_value('body', isset($news->body) ? $news->body : ''))); ?>
                    <span class='help-block'><?php echo form_error('body'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('attachment') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_attachment'), 'attachment', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='attachment' type='text' name='attachment' maxlength='1000' value="<?php echo set_value('attachment', isset($news->attachment) ? $news->attachment : ''); ?>" />
                    <span class='help-block'><?php echo form_error('attachment'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('image_align') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_image_align'), 'image_align', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='image_align' type='text' name='image_align' maxlength='255' value="<?php echo set_value('image_align', isset($news->image_align) ? $news->image_align : ''); ?>" />
                    <span class='help-block'><?php echo form_error('image_align'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('image_caption') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_image_caption'), 'image_caption', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='image_caption' type='text' name='image_caption' maxlength='255' value="<?php echo set_value('image_caption', isset($news->image_caption) ? $news->image_caption : ''); ?>" />
                    <span class='help-block'><?php echo form_error('image_caption'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('tags') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_tags'), 'tags', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='tags' type='text' name='tags' maxlength='255' value="<?php echo set_value('tags', isset($news->tags) ? $news->tags : ''); ?>" />
                    <span class='help-block'><?php echo form_error('tags'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('created_on') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_created_on'), 'created_on', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='created_on' type='text' name='created_on' maxlength='11' value="<?php echo set_value('created_on', isset($news->created_on) ? $news->created_on : ''); ?>" />
                    <span class='help-block'><?php echo form_error('created_on'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('created_by') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_created_by'), 'created_by', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='created_by' type='text' name='created_by' maxlength='11' value="<?php echo set_value('created_by', isset($news->created_by) ? $news->created_by : ''); ?>" />
                    <span class='help-block'><?php echo form_error('created_by'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('modified_on') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_modified_on'), 'modified_on', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='modified_on' type='text' name='modified_on' maxlength='11' value="<?php echo set_value('modified_on', isset($news->modified_on) ? $news->modified_on : ''); ?>" />
                    <span class='help-block'><?php echo form_error('modified_on'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('modified_by') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_modified_by'), 'modified_by', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='modified_by' type='text' name='modified_by' maxlength='11' value="<?php echo set_value('modified_by', isset($news->modified_by) ? $news->modified_by : ''); ?>" />
                    <span class='help-block'><?php echo form_error('modified_by'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('status_id') ? ' error' : ''; ?>">
                <div class='controls'>
                    <label class='checkbox' for='status_id'>
                        <input type='checkbox' id='status_id' name='status_id'  value='1' <?php echo set_checkbox('status_id', 1, isset($news->status_id) && $news->status_id == 1); ?> />
                        <?php echo lang('news_field_status_id'); ?>
                    </label>
                    <span class='help-block'><?php echo form_error('status_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('category_id') ? ' error' : ''; ?>">
                <div class='controls'>
                    <label class='checkbox' for='category_id'>
                        <input type='checkbox' id='category_id' name='category_id'  value='1' <?php echo set_checkbox('category_id', 1, isset($news->category_id) && $news->category_id == 1); ?> />
                        <?php echo lang('news_field_category_id'); ?>
                    </label>
                    <span class='help-block'><?php echo form_error('category_id'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('date_published') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_date_published'), 'date_published', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='date_published' type='text' name='date_published' maxlength='11' value="<?php echo set_value('date_published', isset($news->date_published) ? $news->date_published : ''); ?>" />
                    <span class='help-block'><?php echo form_error('date_published'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('deleted') ? ' error' : ''; ?>">
                <div class='controls'>
                    <label class='checkbox' for='deleted'>
                        <input type='checkbox' id='deleted' name='deleted'  value='1' <?php echo set_checkbox('deleted', 1, isset($news->deleted) && $news->deleted == 1); ?> />
                        <?php echo lang('news_field_deleted'); ?>
                    </label>
                    <span class='help-block'><?php echo form_error('deleted'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('image_alttag') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_image_alttag'), 'image_alttag', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='image_alttag' type='text' name='image_alttag' maxlength='255' value="<?php echo set_value('image_alttag', isset($news->image_alttag) ? $news->image_alttag : ''); ?>" />
                    <span class='help-block'><?php echo form_error('image_alttag'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('image_title') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_image_title'), 'image_title', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='image_title' type='text' name='image_title' maxlength='255' value="<?php echo set_value('image_title', isset($news->image_title) ? $news->image_title : ''); ?>" />
                    <span class='help-block'><?php echo form_error('image_title'); ?></span>
                </div>
            </div>

            <div class="control-group<?php echo form_error('comments_thread_id') ? ' error' : ''; ?>">
                <?php echo form_label(lang('news_field_comments_thread_id'), 'comments_thread_id', array('class' => 'control-label')); ?>
                <div class='controls'>
                    <input id='comments_thread_id' type='text' name='comments_thread_id' maxlength='11' value="<?php echo set_value('comments_thread_id', isset($news->comments_thread_id) ? $news->comments_thread_id : ''); ?>" />
                    <span class='help-block'><?php echo form_error('comments_thread_id'); ?></span>
                </div>
            </div>
        </fieldset>
        <fieldset class='form-actions'>
            <input type='submit' name='save' class='btn btn-primary' value="<?php echo lang('news_action_edit'); ?>" />
            <?php echo lang('bf_or'); ?>
            <?php echo anchor(SITE_AREA . '/reports/news', lang('news_cancel'), 'class="btn btn-warning"'); ?>
            
            <?php if ($this->auth->has_permission('News.Reports.Delete')) : ?>
                <?php echo lang('bf_or'); ?>
                <button type='submit' name='delete' formnovalidate class='btn btn-danger' id='delete-me' onclick="return confirm('<?php e(js_escape(lang('news_delete_confirm'))); ?>');">
                    <span class='icon-trash icon-white'></span>&nbsp;<?php echo lang('news_delete_record'); ?>
                </button>
            <?php endif; ?>
        </fieldset>
    <?php echo form_close(); ?>
</div>