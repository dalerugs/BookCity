<div class="col-md-10 color-white panel panel-default">
    
    <div class="row">
        <div class="col-md-12">
            
        </div>
    </div>
    
<!--    <div class="row">
        <div class="col-md-12">
            <h4 class="alert alert-danger">Sorry this page is still under construction!</h4>
        </div>
    </div>-->
    
    
    <div class="row">
        <div  class="col-md-4">
            <h3>Messages</h3>
            <table class="table table-hover">
                <?php foreach ($conversations as $convo){ ?>
                <tr onclick="location.href='?from_notif=1&id=<?php echo $convo->messenger_id; ?>&name=<?php echo $convo->name; ?>';" style="cursor:pointer">
                    <td>
                        <?php echo $convo->name; ?> <span style="background: #db2525" class="badge"><?php if($convo->mes_notif!=0){  echo $convo->mes_notif; }?></span>
                        <small class="pull-right text-muted">
                                    <span class="glyphicon glyphicon-time"></span> <?php echo date('m/d/y h:i A', strtotime($convo->last_modified)); ?></small>
                    </td>
                </tr>
                
                <?php  } ?>
            </table>
        </div>
        <div class="col-md-8">
            <h4><?php if(!empty($messages)) {echo 'Conversation with '.urldecode($_GET['name']); }?></h4>
            <div class="panel panel-default">
                <div id="message_body" class="panel-body">
                    <ul class="chat">
                        <?php if(!empty($messages)){ foreach ($messages as $mes){ if($mes->type=='seller'){ ?>
                        
                        <li class="right clearfix">
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span><?php echo date('d M Y h:i A', strtotime($mes->message_date)); ?></small>
                                    <strong class="pull-right primary-font"><?php echo $_SESSION['name'];  ?></strong>
                                </div><br>
                                <p style="margin-top:10px">
                                    <?php echo $mes->message; ?>
                                </p><br>
                                <?php if($mes->is_seen){ ?>
                                <small><span class="glyphicon glyphicon-ok-sign"></span><span style="color:gray">Seen</span></small>
                                <?php } ?>
                            </div>
                        </li>
                        <?php }else{ ?>
                        <li class="left clearfix">
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font"><?php echo urldecode($_GET['name']);  ?></strong> <small class="pull-right text-muted">
                                    <span class="glyphicon glyphicon-time"></span><?php echo date('d M Y h:i A', strtotime($mes->message_date)); ?></small>
                                </div>
                                <p style="margin-top:10px">
                                    <?php echo $mes->message; ?>
                                </p>
                            </div>
                        </li>
                        <?php }}} ?>
<!--                        <li class="left clearfix">
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>
                        <li class="right clearfix"><span class="chat-img pull-right">
                        </span>
                            <div class="chat-body clearfix">
                                <div class="header">
                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
                                </div>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
                                    dolor, quis ullamcorper ligula sodales.
                                </p>
                            </div>
                        </li>-->
                        
                    </ul>
                </div>
                <div class="panel-footer">
                    <?php if(!empty($messages)){ ?>
                    <form id="messageForm" method="POST">
                        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                        <input type="hidden" name="messenger_id" value="<?php echo $_GET['id']; ?>">
                        <input type="hidden" name="link" value="<?php echo '?id='.$_GET['id'].'&name='.$_GET['name']; ?>">
                    <div class="form-group">    
                    <div class="input-group">
                        <textarea placeholder="Type your message here..." class="form-control" rows="2" name="message"></textarea>
                        <span class="input-group-btn">
                            <input value="Send" name="send" type="submit" style="height:53px" class="btn btn-warning" id="btn-chat">
                                
                        </span>
                    </div>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    
    
</div>
</div>
</div>



<style type="text/css">
	

.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 10px;
    padding-bottom: 5px;
    border-bottom: 1px dotted #B3A9A9;
}

.chat li.left .chat-body
{
    
}

.chat li.right .chat-body
{
    
}


.chat li .chat-body p
{
    margin: 0;
    color: #777777;
}

.panel .slidedown .glyphicon, .chat .glyphicon
{
    margin-right: 5px;
}

.panel-body
{
    overflow-y: scroll;
    height: 400px;
}

::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}

</style>


<script type="text/javascript"> 
        $(document).ready( function (){
            var validator=$("#messageForm").bootstrapValidator({
                fields :{
                    message :{
                        validators :{
                            notEmpty :{
                                 message :"Please enter your message"
                            }
                        }
                    }
                    
                }
            });
        } );
</script>


<script type="text/javascript">
var objDiv = document.getElementById("message_body");
objDiv.scrollTop = objDiv.scrollHeight;
</script>