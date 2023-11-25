<?php
    $jcub_actions = $this->recommended_actions;
    $jcub_actions_todo = get_option('jcub_recommended_actions', false);
?>
<div id="recommended_actions" class="jcub-tab-pane panel-close">
	<div class="action-list">
		<?php if ($jcub_actions): foreach ($jcub_actions as $key => $jcub_actionVal): ?>
		<div class="action" id="<?php echo esc_attr($jcub_actionVal['id']); ?>">
			<div class="action-watch">
			<?php if (!$jcub_actionVal['is_done']): ?>
				<?php if (!isset($jcub_actions_todo[$jcub_actionVal['id']]) || !$jcub_actions_todo[$jcub_actionVal['id']]): ?>
					<span class="dashicons dashicons-visibility"></span>
				<?php else: ?>
					<span class="dashicons dashicons-hidden"></span>
				<?php endif; ?>
			<?php else: ?>
				<span class="dashicons dashicons-yes"></span>
			<?php endif; ?>
			</div>
			<div class="action-inner">
				<h3 class="action-title"><?php echo esc_html($jcub_actionVal['title']); ?></h3>
				<div class="action-desc"><?php echo esc_html($jcub_actionVal['desc']); ?></div>
				<?php echo wp_kses_post($jcub_actionVal['link']); ?>
			</div>
		</div>
		<?php endforeach; endif; ?>
	</div>
</div>