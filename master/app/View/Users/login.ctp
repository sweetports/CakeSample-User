<!--<h2 class="bm-15px">Sample Management</h2>-->
<p class="txt-red"><?php echo $this->Session->flash(); ?></p>

<?php echo $this->Form->create('User', Array('url' => '/users/login','class'=>'form-signin','div'=>true,'role'=>'form'));?>
    <h2 class="form-signin-heading">Sample Management</h2>
<?php echo $this->Form->input('User.username',array('type'=>'text','label'=>false,'class'=>'form-control','placeholder'=>'Email address'))?>
<?php echo $this->Form->input('User.password',array('type'=>'password','label'=>false,'class'=>'form-control','placeholder'=>'Password'))?>

<!--    <input type="email" class="form-control" placeholder="Email address" required autofocus>-->
<!--    <input type="password" class="form-control" placeholder="Password" required>-->
    <label class="checkbox">
        <input type="checkbox" value="remember-me"> Remember me
    </label>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
<?php //echo $this->Form->end(__('ログイン'),array('div'=>false,'class'=>'btn btn-default btn-lg'));?>
</form>