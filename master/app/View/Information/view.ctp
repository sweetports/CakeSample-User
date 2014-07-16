<h2><?php echo __('レクチャー'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($information['Information']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($information['Information']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($information['Information']['content']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Imgpath'); ?></dt>
		<dd>
			<?php echo h($information['Information']['imgpath']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url'); ?></dt>
		<dd>
			<?php echo h($information['Information']['url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($information['Information']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($information['Information']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Del Flg'); ?></dt>
		<dd>
			<?php echo h($information['Information']['del_flg']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($information['Information']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Photo'); ?></dt>
		<dd>
			<?php echo h($information['Information']['photo']); ?>
			&nbsp;
		</dd>
	</dl>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Information'), array('action' => 'edit', $information['Information']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Information'), array('action' => 'delete', $information['Information']['id']), null, __('Are you sure you want to delete # %s?', $information['Information']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Information'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Information'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
