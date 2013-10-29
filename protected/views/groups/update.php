<?php
helper::showPageTitle('Update Group - '.$model->name);
helper::showFlash();
$this->renderPartial('_form',array('model'=>$model));
?>
