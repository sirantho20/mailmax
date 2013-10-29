<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    //'type'=>'inverse', // null or 'inverse'
    'brand'=>'<i class="icon-home"></i>',
    'brandUrl'=>  Yii::app()->baseUrl,
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
                    array(
                        'class'=>'bootstrap.widgets.TbMenu',
                        'htmlOptions'=>array('class'=>''),
                       /* 'items'=>array('---',
                            array('label'=>'Dashboard','url'=>$this->createUrl('dashboard/index')),
                            '---',
                            array('label'=>'Mail Boxes','url'=>$this->createUrl('account/emailaccounts')),
                            '---',
                            array('label'=>'Domains','url'=>$this->createUrl('account/domains')),
                        ), */
                    ),
                    array(
                        'class'=>'bootstrap.widgets.TbMenu',
                        'htmlOptions'=>array('class'=>'pull-right'),
                        'items'=>array(
                            '---',
                            array('label'=>'Sign In','url'=>'login/index'),
                            '---',
                            array('label'=>'Sign Up','url'=>  Yii::app()->createUrl('signup/index')),
                         /*   array('label'=>Yii::app()->user->firstname, 'url'=>'#', 'items'=>array(
                                array('label'=>'Options', 'url'=>'#'),
                                array('label'=>'Another action', 'url'=>'#'),
                                array('label'=>'Something else here', 'url'=>'#'),
                                '---',
                                array('label'=>'Logout', 'url'=>  Yii::app()->createUrl('logout/index')),
                            )), */
                        ),
                    ),
    ),
)); ?>
