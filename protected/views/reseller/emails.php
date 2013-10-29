<p><?php
echo CHtml::linkButton('Create New Account', array('href'=>$this->createUrl('account/newemail')));
?>
</p>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$provider,
    //'filter'=> (new EmailAccounts()),
    'itemsCssClass'=>'table table-striped table-hover table-condensed table-bordered',
    'htmlOptions'=>array('class'=>''),
    'columns'=>array(
        'first_name',
        'last_name',
        'email',
        array(            // display 'create_time' using an expression
            'header'=>'<a>Account Status<a/>',
            'value'=>array($this,'getAccountStatus'),
        ),
        
    ),
));
?>