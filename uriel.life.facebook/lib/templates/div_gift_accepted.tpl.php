<div style="width:760px">	
	<div class="shadowthickblue"> 
		<div class="outter-border" style="height:400px"> 
			<div class="inner-border" style="height:400px">
				<form id="frmAccept" action="">					
					<div class="head">[var.headmessage]</div>
					<div style="padding:10px">
						<div class="center" style="padding-left:125px;">
							<table border="0" bordercolor=""  width="400" cellpadding="0" cellspacing="0">
								<tr height="200">
									<td valign="middle" align="center">
										<div class="block" style="float:left;width:100px;">
											<img class="shadow" src="[var.giftImage]" />
											<div style="padding:5px;text-align:center">
												[var.giftDesc]
											</div>
										</div>
									</td>
									<td valign="middle" align="center">From</td>
									<td valign="middle" align="center">
										<div class="block" style="float:right;width:100px;">
											<img class="shadow" src="[var.friendImage]" />
											<div style="padding:5px;text-align:center">
												[var.friendName]
											</div>
										</div>	
									</td>
								</tr>
								<tr>
									<td align="center" colspan="3">Do you have more requests to accept?</td>
								</tr>
								<tr>
							  		<td align="center" colspan="3">
										<input type="button" onClick="parent.location='http://www.facebook.com/games';" class="giftsubmit" value="Yes" name="">
										<input type="button" onClick="as.play();" class="giftsubmit" value="No" name="">
									</td>
								</tr>
							</table>
						</div>	
					</div>
				</form>
			</div>
		</div>
    </div> 
</div>
