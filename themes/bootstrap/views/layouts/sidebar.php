<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
    <div class="container-fluid">
    <div class="row-fluid">
        <div class="span2">
            <?php echo $this->sidebar; ?>
        </div>
        <div class="span10">
        <?php 
        echo $content;
        ?>
        </div>
    </div>
    </div>
<?php $this->endContent(); ?>