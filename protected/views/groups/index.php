<?php

Yii::app()->clientScript->registerScript('checkUncheckCheckboxes', "
$('#submitMemberUpdate').on('click',function(){
$('#groupMembersUpdate').submit();
});

$('#createNewGroup').on('click',function(event){
event.preventDefault();
$('#myModalLabel').html('Create New Group');
$('#groupModal').modal({remote: '".Yii::app()->createUrl('groups/create')."'});
});

$('#groupModalSubmit').on('click',function(event){
event.preventDefault();
var name =  $('#groupModal form #groupName').val();
var email =  $('#groupModal form #groupEmail').val();
var oldLbl = $('#groupModalSubmit').html();
if(name !='' && email !='')
    {
        $.ajax({
            type: 'POST',
            url: $('#groupModal form').attr('action'),
            data: $('#groupModal form').serialize(),
            success: function(data){ location.reload(); },
            error: function(jq,status,err){ alert(jq.responseText);},
            beforeSend: function(){ $('#groupModalSubmit').removeClass('btn-primary').addClass('btn-warning').html('Please wait...');},
            complete: function(){ $('#groupModal').modal();}
            
        });
    }
    else 
    {
        alert('Please fill in all fields.');
    }
});



");

?>
<div class="row-fluid " style="margin-bottom: 5px;">
    <div class="offset5 span6">
    <?php echo CHtml::button('Save Changes', array('class'=>'btn btn-info btn-small hidden','id'=>'submitMemberUpdate')) ?>
    </div>
    </div>
<div class="clear"></div>
<div class="row-fluid">
    <?php helper::showFlash(); ?>
    <div class="span3" style="border: 1px solid lightgray; border-radius: 5px;">
        <center><?php helper::showPageTitle('Groups'); ?></center>
        <table class="table table-hover table-condensed" id="groupTable">
            <?php foreach($groups as $key=>$value){
            echo '<tr><td>'.CHtml::ajaxLink('<i class="icon-remove"></i>', Yii::app()->createUrl('groups/remove'), array(
                'type'=>'GET',
                'data'=>array('id'=>$key),
                'beforeSend'=>'function(){ $(".modal-header").remove(); $(".modal-footer").remove(); $(".modal-body").html(\'<center><img src="'.Yii::app()->baseUrl.'/images/preloader.gif" /><br />Please wait</center>\'); $("#groupModal").modal(); }',
                'success'=>'function(){ location.reload();}',
                'data'=>array('id'=>$key),
                'error'=>'function(jq){ alert(jq.responseText); location.reload();}'
            ),
            array('confirm'=>'Really wanna delete?')
            ).'</td><td>'.CHtml::ajaxLink($value, Yii::app()->createUrl('groups/PopulateGroupMembers'),array(
                'type'=>'GET',
                'beforeSend'=>'function(){$("#loadingImg").html(\'loading <img src="'.Yii::app()->baseUrl.'/images/preloader.gif" />\'); $("#memberFormContent").html(\'<center><img src="'.Yii::app()->baseUrl.'/images/preloader.gif" /></center>\'); $("#submitMemberUpdate").addClass("hidden");}',
                'success'=>'function(data){$("#loadingImg").html(\'<img src="'.Yii::app()->baseUrl.'/images/check.png" />\'); $("#memberFormContent").html(data); $("checkAll").removeClass("hidden"); $("#submitMemberUpdate").removeClass("hidden");}',
                'data'=>array('group'=>$key),
            ),array('id'=>$key,'class'=>$key)).'</td></tr>';
            }?>
        </table>
    </div>
    <div class="span2" style="padding-top: 90px;"><center id="loadingImg"></center></div>
    <div class="span6" style="border: 1px solid lightgray; border-radius: 5px; min-height: 200px;">
       <center id="membersTitle"><?php helper::showPageTitle('Members'); ?></center>
       <?php echo CHtml::checkBox('checkAll',false,array('id'=>'checkAll','class'=>'hidden')); ?>
       <div class="form" style=" max-height: 500px;overflow-y: scroll;">
           <?php $this->beginWidget('CActiveForm', array(
                'id'=>'groupMembersUpdate',
                'enableAjaxValidation'=>FALSE,
                'enableClientValidation'=>FALSE,
            )); ?>
           <div id="memberFormContent"><center><span class="label label-info"><< Click a group from left to view members</span></center></div>
           
           <?php $this->endWidget(); ?>
       </div>
    </div>
</div>



<div id="groupModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h3 id="myModalLabel">Modal header</h3>
</div>
<div class="modal-body">
<p>Loading...</p>
</div>
<div class="modal-footer">
<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
<button class="btn btn-primary" id="groupModalSubmit">Save changes</button>
</div>