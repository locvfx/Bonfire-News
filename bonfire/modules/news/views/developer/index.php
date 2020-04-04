<?php

$num_columns	= 19;
$can_delete	= $this->auth->has_permission('News.Developer.Delete');
$can_edit		= $this->auth->has_permission('News.Developer.Edit');
$has_records	= isset($records) && is_array($records) && count($records);

if ($can_delete) {
    $num_columns++;
}
?>
<div class='admin-box'>
	<h3>
		<?php echo lang('news_area_title'); ?>
	</h3>
	<?php echo form_open($this->uri->uri_string()); ?>
		<table class='table table-striped'>
			<thead>
				<tr>
					<?php if ($can_delete && $has_records) : ?>
					<th class='column-check'><input class='check-all' type='checkbox' /></th>
					<?php endif;?>
					
					<th><?php echo lang('news_field_author'); ?></th>
					<th><?php echo lang('news_field_title'); ?></th>
					<th><?php echo lang('news_field_date'); ?></th>
					<th><?php echo lang('news_field_body'); ?></th>
					<th><?php echo lang('news_field_attachment'); ?></th>
					<th><?php echo lang('news_field_image_align'); ?></th>
					<th><?php echo lang('news_field_image_caption'); ?></th>
					<th><?php echo lang('news_field_tags'); ?></th>
					<th><?php echo lang('news_field_created_on'); ?></th>
					<th><?php echo lang('news_field_created_by'); ?></th>
					<th><?php echo lang('news_field_modified_on'); ?></th>
					<th><?php echo lang('news_field_modified_by'); ?></th>
					<th><?php echo lang('news_field_status_id'); ?></th>
					<th><?php echo lang('news_field_category_id'); ?></th>
					<th><?php echo lang('news_field_date_published'); ?></th>
					<th><?php echo lang('news_field_deleted'); ?></th>
					<th><?php echo lang('news_field_image_alttag'); ?></th>
					<th><?php echo lang('news_field_image_title'); ?></th>
					<th><?php echo lang('news_field_comments_thread_id'); ?></th>
				</tr>
			</thead>
			<?php if ($has_records) : ?>
			<tfoot>
				<?php if ($can_delete) : ?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'>
						<?php echo lang('bf_with_selected'); ?>
						<input type='submit' name='delete' id='delete-me' class='btn btn-danger' value="<?php echo lang('bf_action_delete'); ?>" onclick="return confirm('<?php e(js_escape(lang('news_delete_confirm'))); ?>')" />
					</td>
				</tr>
				<?php endif; ?>
			</tfoot>
			<?php endif; ?>
			<tbody>
				<?php
				if ($has_records) :
					foreach ($records as $record) :
				?>
				<tr>
					<?php if ($can_delete) : ?>
					<td class='column-check'><input type='checkbox' name='checked[]' value='<?php echo $record->id; ?>' /></td>
					<?php endif;?>
					
				<?php if ($can_edit) : ?>
					<td><?php echo anchor(SITE_AREA . '/developer/news/edit/' . $record->id, '<span class="icon-pencil"></span> ' .  $record->author); ?></td>
				<?php else : ?>
					<td><?php e($record->author); ?></td>
				<?php endif; ?>
					<td><?php e($record->title); ?></td>
					<td><?php e($record->date); ?></td>
					<td><?php e($record->body); ?></td>
					<td><?php e($record->attachment); ?></td>
					<td><?php e($record->image_align); ?></td>
					<td><?php e($record->image_caption); ?></td>
					<td><?php e($record->tags); ?></td>
					<td><?php e($record->created_on); ?></td>
					<td><?php e($record->created_by); ?></td>
					<td><?php e($record->modified_on); ?></td>
					<td><?php e($record->modified_by); ?></td>
					<td><?php e($record->status_id); ?></td>
					<td><?php e($record->category_id); ?></td>
					<td><?php e($record->date_published); ?></td>
					<td><?php echo $record->deleted > 0 ? lang('news_true') : lang('news_false'); ?></td>
					<td><?php e($record->image_alttag); ?></td>
					<td><?php e($record->image_title); ?></td>
					<td><?php e($record->comments_thread_id); ?></td>
				</tr>
				<?php
					endforeach;
				else:
				?>
				<tr>
					<td colspan='<?php echo $num_columns; ?>'><?php echo lang('news_records_empty'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
	<?php
    echo form_close();
    
    echo $this->pagination->create_links();
    ?>
</div>