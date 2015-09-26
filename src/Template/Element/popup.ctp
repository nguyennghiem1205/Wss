<a href="" onclick="Core.FloatBox.show('boxSignup');return false;"><?= __('signup') ?></a>
|
<a href="" onclick="Core.FloatBox.show('boxLogin');return false;">Login</a>

<div id="boxLogin" class="hw-floatbox">
    <div class="custom_css">
        <h1><?= __('login') ?></h1>
        
        <?= $this->Form->create('',['url'=>['controller'=>'users','action'=>'ajax_login'],'class'=>'hw-ajax']); ?>
            <table>
                <tr>
                    <td><?= $this->Form->input('email',['type'=>'text','label'=>false,'div'=>false,'required'=>false,'placeholder'=>__('email')]); ?></td>
                </tr>
                <tr>
                    <td>
                        <?= $this->Form->input('password',['type'=>'password','label'=>false,'div'=>false,'required'=>false,'placeholder'=>__('password')]); ?>
                        <div class="height10"></div>
                        <a href="" style="color: #666" onclick="Core.FloatBox.hide('boxLogin');Core.FloatBox.show('boxForgot');return false;"><?= __('forgot your password') ?></a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button type="submit"><?= __('login') ?></button>
                        <p></p>
                        <div><span>OR</span></div>
                    </td>
                </tr>
                <tr>
                    <td><button type="button" class="hw-fb-login" href="<?= $this->Url->build(['plugin'=>'social','controller'=>'users','action'=>'facebook_login']); ?>"><span><?= __('login with facebook') ?></span></button></td>
                </tr>
            </table>
        <?= $this->Form->end(); ?>
        <div class="textBotoom"><?= __("dont have an account") ?> <a href="" onclick="Core.FloatBox.hide('boxLogin');Core.FloatBox.show('boxSignup');return false;"><?= __('create a free account') ?></a></div>
    </div>
</div>

<div id="boxSignup" class="hw-floatbox">
    <div class="custom_css">
        <h1><?= __('signup') ?></h1>
        <?= $this->Form->create(null,['url'=>['controller'=>'Users','action'=>'ajax_signup'],'class'=>'hw-ajax']); ?>
            <table>
                <tr><td><?= $this->Form->input('first_name',['div'=>false,'label'=>false,'required'=>false,'placeholder'=>__('first name')]); ?></td></tr>
                <tr><td><?= $this->Form->input('last_name',['div'=>false,'label'=>false,'required'=>false,'placeholder'=>__('last name')]); ?></td></tr>
                <tr><td><?= $this->Form->input('email',['type'=>'text','div'=>false,'label'=>false,'required'=>false,'placeholder'=>__('email')]); ?></td></tr>
                <tr><td><?= $this->Form->input('password',['type'=>'password','div'=>false,'label'=>false,'required'=>false,'placeholder'=>__('password')]); ?></td></tr>
                <tr>
                    <td>
                        <button type="submit"><?= __('create new account') ?></button>
                        <p>By signing up you agree to our <?= $this->Html->link(__('teams of use'),'/page/'.PAGE_TERMS_OF_USE,['target'=>'_blank']) ?><br>and <?= $this->Html->link(__('privacy policy'),'/page/'.PAGE_PRIVACY_POLICY,['target'=>'_blank']) ?></p>
                        <div><span>OR</span></div>
                    </td>
                </tr>
                <tr>
                    <td><button type="button" onclick="location.href='<?= $this->Url->build(['plugin'=>'social','controller'=>'users','action'=>'facebook_login']); ?>';"><span><?= __('login with facebook') ?></span></button></td>
                </tr>
            </table>
        <?= $this->Form->end(); ?>

        <div class="textBotoom"><?= __('already have an account') ?> <a href="" onclick="Core.FloatBox.hide('boxSignup');Core.FloatBox.show('boxLogin');return false;"><?= __('signin') ?></a></div>
    </div>
</div>

<div id="boxForgot" class="hw-floatbox">
    <div class="custom_css">
        <h1><?= __('send a link to reset your password') ?></h1>
        <?= $this->Form->create(null,['url'=>['controller'=>'Users','action'=>'ajax_forgot'],'class'=>'hw-ajax']); ?>
            <table>
                <tr>
                    <td><?= $this->Form->input('email',['type'=>'text','label'=>false,'div'=>false,'required'=>false,'placeholder'=>__('email')]); ?></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btnSubmit"><?= __('send password') ?></button></td>
                </tr>
            </table>
        <?= $this->Form->end(); ?>
        <div class="textBotoom">
            <?= __('try to ') ?> <a href="#" onclick="Core.FloatBox.hide('boxForgot');Core.FloatBox.show('boxLogin');"><?= __('signin') ?></a>?
            <div class="height10"></div>
            <?= __("dont have an account") ?> <a href="#" onclick="Core.FloatBox.hide('boxForgot');Core.FloatBox.show('boxSignup');"><?= __('create a free account') ?></a>
        </div>
    </div>
</div>