<div style="width:760px">	
	<div class="shadowthickblue"> 
		<div class="outter-border" style="height:475px"> 
			<div class="inner-border" style="height:475px">
				<div class="head">Invite your friends to join your church!</div>
				<div style="padding-top:20px">
					(If you don't see a friend in the list, it is because he or she is already your friend in My Christian Life)
					<fb:serverFbml width="690px">
						<script type="text/fbml">
						<fb:fbml>
					        <fb:request-form 
					                action="[var.redirectURL]" 
					                method="POST" 
					                invite="true"
					                type="Christian Life"
					                content="Would you like to join me in My Christian Life [var.callbackURL]">  
					                
					                <div style="margin:10px;">
					                   <div style="float:left; width:220px;">
					                      <img src="[var.image]"/>
					                      <h3>Add members to unlock new buildings, do more missions, and get more gifts.</h3>
					                   </div>
					                   <div style="margin-left:230px;">
					                      <fb:multi-friend-selector import_external_friends="false"
												   email_invite="false"  
					                               target="invite_result"   
					                               showborder="false" 
					                               actiontext="My Christian Life Invitations" 
					                               condensed="true" 
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
				</div>
			</div>
		</div>
    </div> 
</div>
