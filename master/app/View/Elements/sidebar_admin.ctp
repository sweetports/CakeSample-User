<div class="col-sm-3 col-md-2 sidebar">
    <ul class="nav nav-sidebar">
        <li><?php echo $this->Html->link(__('<span class="fa fa-users fa-2x"></span>&nbsp;User'), array('controller'=>'users','action' => 'index','div'=>false),array('escape'=>false)); ?></li>
        <li><?php echo $this->Html->link(__('<span class="fa fa-comments fa-2x"></span>&nbsp;Community'), array('controller'=>'community','action' => 'index','div'=>false),array('escape'=>false)); ?></li>
        <li><?php echo $this->Html->link(__('<span class="fa fa-info-circle fa-2x"></span>&nbsp;Information'), array('controller'=>'information','action' => 'index','div'=>false),array('escape'=>false)); ?></li>
        <li class="divider"></li>
        <li><?php echo $this->Html->link(__('<span class="fa fa-user fa-2x"></span>&nbsp;Admin'), array('controller'=>'admins','action' => 'index','div'=>false),array('escape'=>false)); ?></li>
    </ul>
</div>
