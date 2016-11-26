<div style="width:760px">	
	<div class="shadowthickblue"> 
		<div class="outter-border" style="height:475px"> 
			<div class="inner-border" style="height:475px">
				<div class="head">Select the friends you would like to send the [var.giftdesc] to!</div>
				<div style="padding-top:20px">
				<fb:serverFbml width="690px">
					<script type="text/fbml">
				        <fb:fbml>
			                <fb:request-form 
			                        action="[var.redirectURL]" 
			                        method="POST" 
			                        invite="true"
			                        type="Christian Life"
			                        content="Here is a small gift for your church. Could you help me by sending a gift back? [var.callbackURL]">  
			                        
			                        <div style="margin:10px;">
			                           <div style="float:left; width:220px;">
			                              <img class="centered" src="[var.image]"/>
			                              <h3>[var.giftdesc]</h3>
			                           </div>
			                           <div style="margin-left:230px;">
			                              <fb:multi-friend-selector 
												   condensed="true"
												   import_external_friends="false" 
												   email_invite="false"  
			                                       target="invite_result"   
			                                       showborder="false" 
			                                       actiontext="My Christian Life Gift request" 
 												   exclude_ids="[var.excludeids;noerr]"
													/>
			                              <div class="clearfix">
			                                   <fb:request-form-submit import_external_friends="false" />
			                              </div>
			                         	</div>
			                        </div>
			                </fb:request-form>
				        </fb:fbml>
					</script>
				</fb:serverFbml>
				(If you don't see a friend in the list, it is because you already sent him/her a gift today)
				</div>
			</div>
		</div>
    </div> 
</div>


