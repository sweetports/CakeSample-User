<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h2 class="sub-header"><?php echo __('Information'); ?></h2>
    <div class="actions text-right">
        <?php echo $this->Html->link(__('<span class="glyphicon glyphicon-arrow-left"></span>&nbsp;Back'), array('action' => 'index'),array('class'=>"",'escape'=>false)); ?>
    </div>

    <?php echo $this->Form->create('Information',array('type'=>'file','role'=>'form')); ?>
	<?php
		echo $this->Form->input('id');
    ?>
    <div class="form-group input-group-lg">
    <label><?php echo __('Title'); ?></label>
    <?php echo $this->Form->input('Information.name',array('label'=>false,'class'=>'form-control'));?>
    </div>
    <div class="form-group input-group-lg">
        <label><?php echo __('Contents'); ?></label>
        <?php echo $this->Form->input('Information.content',array('label'=>false,'class'=>'form-control'));?>
    </div>
    <div class="form-group input-group-lg">
        <label><?php echo __('Image'); ?></label>

        <?php
            foreach($files as $img){

                if(!empty($img['Attachment']['photo_information'])){
                    echo '<img src="'.DS.'files'.DS.'attachment'.DS.'photo_information'.DS.$img['Attachment']['id'].DS.$img['Attachment']['photo_information'].'">';
                    echo $this->Form->input('Attachment.0.del_flg', array('type' => 'checkbox','label'=>false,'checked'=>false,'after'=>'Remove this image'));
                }else{
                    echo 'No image';
                }
            }
        ?>
        <?php echo $this->Form->input('Attachment.0.photo_information',array('type'=>'file','label'=>false,'class'=>'form-control'));?>
        <?php echo $this->Form->input('Attachment.0.model', array('type' => 'hidden','value'=>'Information')); ?>
        <?php echo $this->Form->input('Attachment.0.dir', array('type' => 'hidden')); ?>
    </div>
    <div class="form-group input-group-lg">
        <label><?php echo __('Status'); ?></label>
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
    <button class="btn btn-lg btn-primary" type="submit">Update</button>
    </form>
</div>