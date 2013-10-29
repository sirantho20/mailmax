
<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;

?>
<!--<div class="row-fluid">
<div class="well well-small offset2 span8"><h3>Why use our service?</h3>
    <p>Our services are carefully tailored for your business needs. We provide add-on services which is unmatched by our competitors.</p>
</div>
</div> -->

<div class="row-fluid">
    <a id="features"></a>
    <div class="row-fluid features" style="margin-top: 30px; border: 0px solid red; font-family: Arial;">
        <div class="offset2 section" style="font-size: 24px; padding: 15px 0px;">Features</div>
        
            <div class="row-fluid" style="background-color: #FAFAFA;">
                <div class="offset2 span8"> 
                    <div class="span5" style="overflow: hidden;"><img style="margin-top: -40px;" src="/images/email.png" /></div>
                <div class="span7 container-fluid content">          <h6>Email</h6>
            Easily manage and search large inboxes of emails using folders, tags, filters and conversation views in a rich, innovative user interface. Say goodbye to spam emails.
                </div>
                </div>
                
            </div>
            <div class="row-fluid">
                <div class="offset2 span8"> 
                    <div class="span7"><h6>Manage Contacts</h6>
                    Create business contacts that can be shared with others across your organisation. You are in control. Decide which contacts to share with others.
                </div>
                <div class="span5"><img style="margin-top: 15px;" src="/images/contacts.jpg" /></div>
                </div>
            </div>
        <div class="row-fluid" style="background-color: /*#F8EFFB;*/#FBF8EF;">
            <div class="offset2 span8">
            <div class="span7"><h6>Calendar</h6>
            Become more productive with a robust calendar that allows you to stay on top of your schedules. It includes a group scheduling feature that allows you to quickly find the optimum time for large meetings.
            </div>
            <div class="span5" style="overflow: hidden;"><img style="margin-top: -55px;" src="/images/calendar.png" /></div>
            </div>
        </div>
        
        <div class="row-fluid">
            <div class="offset2 span8">
                <div class="span4" style="overflow: hidden;"><img style="margin-top: -30px; margin-bottom: -55px; " src="/images/email-phone1.jpg" /></div>
                <div class="span8">
                <h6>Get Mobile</h6>
                Carry all the great features around on any mobile or table device anytime anywhere. Ever loose touch of your team when out of office. It feels just like being in the comfort of your office.
                
                </div>
                
            </div>
        </div>
            <div class="row-fluid" style="background-color: #FAFAFA;">
                <div class="offset2 span8">
                    <div class="span7">
                    <h6>Simplified Administration</h6>
                    A modern task-oriented ajax administration interface allows you to manage your email accounts and perform all email related tasks without difficulties.
                    </div>
                    <div class="span5">
                       <img style="margin-top: -40px;" src="/images/email-in.jpg" />
                    </div>
                </div>
            </div>
            <div class="row-fluid">
             <div class="offset2 span8">
                 <div class="span5"><img style="margin-top: 10px;" src="/images/desktop_clients.png" /></div>
                 <div class="span7">
                    <h6>Desktop Clients</h6>
                    Take your mail to your desktop. Our email server supports all desktop email clients available. So whether you use Mac, Linux or Windows, you can still have your email in your favourite desktop client.
                 </div>
                 </div>
            </div>
        
    </div>
</div>
<a id="pricing"></a>
<div class="offset2 section" style="font-size: 24px; padding: 15px 0px; margin-top: 35px;">Pricing</div>
<div class="divider" style="background-image: url(/images/divider.png); height: 15px; background-position: center center; background-repeat: no-repeat; margin: 10px 0px;"></div>
<div class="row-fluid">
    
    <div id="pricing-table" class="clear">
    <div class="plan">
        <h3>Starter<span>GHC 225/<small>yr</small></span></h3>
        <a class="signup" id="signLink" href="<?php echo Yii::app()->createUrl('signup/index',array('ch'=>1)); ?>">Sign up</a>         
        <ul>
            <li><b>5</b> Mailboxes</li>
            <li><b>5GB</b> Disk Space</li>
            <li><b>99.99%</b> Guaranteed Uptime</li>
            <li><b><span class="label"><i class="icon-remove icon-white"></i></span></b> Free Email Migration</li>
            <li><b><i class="icon-ok"></i></b> Daily Backup</li>
	    <li><b><i class="icon-ok"></i></b> Mailing Lists</li>
            <li><b><i class="icon-ok"></i></b> 24/7 Support</li>
            
        </ul> 
    </div>
    <div class="plan">
        <h3>Basic<span>GHC 625/<small>yr</small></span></h3>
        <a class="signup" id="signLink" href="<?php echo Yii::app()->createUrl('signup/index',array('ch'=>1)); ?>" >Sign up</a>         
        <ul>
            <li><b>15</b> Mailboxes</li>
            <li><b>15GB</b> Disk Space</li>
            <li><b>99.99%</b> Guaranteed Uptime</li>
            <li><b><span class="label"><i class="icon-remove icon-white"></i></span></b> Free Email Migration</li>
            <li><b><i class="icon-ok"></i></b> Daily Backup</li>
	    <li><b><i class="icon-ok"></i></b> Mailing Lists</li>
            <li><b><i class="icon-ok"></i></b> 24/7 Support</li>		
        </ul> 
    </div>
    <div class="plan" id="most-popular">
        <h3>Standard<span>GHC 1045/<small>yr</small></span></h3>
        <a class="signup" href="<?php echo Yii::app()->createUrl('signup/index',array('ch'=>1)); ?>" id="signLink">Sign up</a>         
        <ul>
            <li><b>25</b> Mailboxes</li>
            <li><b>50GB</b> Disk Space</li>
            <li><b>99.99%</b> Guaranteed Uptime</li>
            <li><b><span class="label label-success"><i class="icon-ok icon-white"></i></span></b> Free Email Migration</li>
            <li><b><i class="icon-ok"></i></b> Daily Backup</li>
	    <li><b><i class="icon-ok"></i></b> Mailing Lists</li>
            <li><b><i class="icon-ok"></i></b> 24/7 Support</li>			
        </ul> 
    </div>
    <div class="plan">
        <h3>Premium<span>GHC 2025/<small>yr</small></span></h3>
        <a class="signup" id="signLink" href="<?php echo Yii::app()->createUrl('signup/index',array('ch'=>1)); ?>" >Sign up</a>         
        <ul>
            <li><b>60</b> Mailboxes</li>
            <li><b>75GB</b> Disk Space</li>
            <li><b>99.99%</b> Guaranteed Uptime</li>
            <li><b><span class="label label-success"><i class="icon-ok icon-white"></i></span></b> Free Email Migration</li>
            <li><b><i class="icon-ok"></i></b> Daily Backup</li>
	    <li><b><i class="icon-ok"></i></b> Mailing Lists</li>
            <li><b><i class="icon-ok"></i></b> 24/7 Support</li>			
        </ul> 
    </div>
    
</div>
    
    
</div>


<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header" style="">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<center><h4 id="myModalLabel">Email Quick Signup</h4></center>
</div>
<div class="modal-body">
<p></p>
</div>
</div>