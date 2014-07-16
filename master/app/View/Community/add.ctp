<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h2 class="sub-header"><?php echo __('お知らせ'); ?></h2>
    <?php echo $this->Form->create('Community',array('type'=>'file','role'=>'form')); ?>
    <div class="form-group input-group-lg">
        <label>タイトル</label>
        <?php echo $this->Form->input('Community.name',array('label'=>false,'class'=>'form-control'));?>
    </div>
    <div class="form-group input-group-lg">
        <label>コンテンツ</label>
        <?php echo $this->Form->input('Community.content',array('label'=>false,'class'=>'form-control'));?>
    </div>
    <div class="form-group input-group-lg">
        <label>画像</label>
        <?php echo $this->Form->input('Attachment.0.photo_community',array('type'=>'file','label'=>false,'class'=>'form-control'));?>
        <?php echo $this->Form->input('Attachment.0.model', array('type' => 'hidden','value'=>'Community')); ?>
        <?php echo $this->Form->input('Attachment.0.dir', array('type' => 'hidden','value'=>'Community')); ?>
    </div>
    <div class="form-group input-group-lg">
        <label>ステータス</label>
        <?php
        echo $this->Form->input('status',array(
                'type' => 'select',
                'options' => $select_status,
                'label'=>false,
                'class'=>'form-control'
            )
        );
        ?>
    </div>
    <button class="btn btn-lg btn-primary" type="submit">登録する</button>
    </form>
    <div class="actions">
        <h3><?php echo __('Actions'); ?></h3>
        <ul>
            <li><?php echo $this->Html->link(__('List Community'), array('action' => 'index')); ?></li>
        </ul>
    </div>
</div>