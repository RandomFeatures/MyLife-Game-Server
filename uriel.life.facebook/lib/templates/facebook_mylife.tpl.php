<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link href="http://[var.myserver]/uriel.life.facebook/public/css/main.css" rel="stylesheet" type=text/css>
    <link href="http://[var.myserver]/uriel.life.common/public/css/buy.css" rel="stylesheet" type="text/css"/>
    <title></title>
    <!--js for flash-->
    <script src="http://[var.myserver]/uriel.life.common/public/scripts/swfobject.js" type="text/javascript"></script>
    <!-- end of js for flash-->
    <!--js libs-->
    <script type="text/javascript" src="http://[var.myserver]/uriel.life.facebook/public/scripts/install_plane.js"></script>
    <script type="text/javascript" src="http://[var.myserver]/uriel.life.facebook/public/scripts/application.js"></script>
    <script type="text/javascript" src="http://[var.myserver]/uriel.life.common/public/scripts/jquery-1.3.2.min.js"></script>
    <!-- end of js libs-->
    <script type="text/javascript">
	 	 fb_params =
		 {
		        app_id:'[var.app_id]',
				url:'[var.canvas_base_url]',
				uid:'[var.facebookID;noerr]',
				gameserver:'http://[var.myserver]',
				session:'[var.encodesession;noerr]',
				invite_result:'invite_result.php'
		 };
	 	
		
		var flash_vars = {
					[var.dynamicvars;htmlconv=no;protect=no;noerr]
					baseurl: fb_params.aleserver 
			};
		var flash_params = {
				menu: "false",
				scale: "noScale",
				allowFullscreen: "true",
				allowScriptAccess: "always",
				bgcolor: "#FFFFFF",
				wmode: "transparent"
			};
	 	var flash_attributes = {
				id:"MyChristianLife",
				name:"MyChristianLife"
			};
		
		//swfobject.embedSWF(fb_params.gameserver + "[var.currentswf]", "altContent", "760", "590", "9.0.0", fb_params.gameserver + "[var.altswf]", flash_vars, flash_params, flash_attributes);
	
	</script>


	<script type="text/javascript">
     $(document).ready(function()
     {
		//mouse move events
        $(".step_buttons").bind('mouseover',function()
        {
            $(this).addClass('button_over');
        });

        $(".step_buttons").bind('mouseout',function()
        {
            $(this).removeClass('button_over');
        });

        //Install Panel
        $('#bookmark_button').bind('click', function()
        {
            FB.ui({ method: 'bookmark.add' }, function(){});
        });

        $('#review_button').bind('click', function()
		{
        	 as.review();
        });

        $('#permissions_button').bind('click', function()
        {
           FB.login(install_panel.permissionsCheck,{perms:'read_stream,publish_stream'});
        });
        
        $('#fan_button').bind('click', function()
        {
           $("#like_container").show();
           FB.XFBML.parse(document.getElementById('like_container'));
        });

        $('#like_close').bind('click', function()
        {
          $("#like_container").hide();
            install_panel.fanCheck();
        });

        $('#reward_button').bind('click', function()
        {
            as.showReward();
        });

        $('#locked_button').bind('click', function()
        {
           as.popup('Sorry! You have to complete the rest of the setup process first!');
        });
        
        $('#wall_button').bind('click',function()
        {
            as.writeOnTheWall('test test...');

        });
		//Tab Menu
        $('#play_button').bind('click', function()
        {
           as.play();
        });

        $('#invite_button').bind('click',function()
        {
             as.inviteFriends();
        });

        $('#buy_button').bind('click',function()
        {
             as.buyBookmarks();
        });

        $('#gifts_button').bind('click',function()
        {
            as.showGiftList();
        });
    	// if user clicked on button, the overlay layer or the dialogbox, close the dialog	
    	$('a.btn-ok, #dialog-overlay, #dialog-box').click(function () {		
    		$('#dialog-overlay, #dialog-box').hide();		
    		return false;
    	});
    });

 	//dynamic script written by sever as needed
   ds = {
        onLogin:function()
        {
    		[var.onlogin;noerr]
        }
    };
    		     
  </script>
</head>
<body>
    <div id="fb-root"></div>
	<!--
    <script type="text/javascript" src="http://connect.facebook.net/en_US/all.js"></script> 
 	-->
    <script type="text/javascript">
		window.fbAsyncInit = function() {
		    FB.init({
		        appId   : fb_params.app_id,
		        session : fb_params.session, // don't refetch the session when PHP already has it
		        status  : true, // check login status
		        cookie : true, // enable cookies to allow the server to access the session
		        xfbml   : false // parse XFBML
		    });
		
		    FB.Canvas.setAutoResize();
		 	FB.getLoginStatus(as.login);
			
		 };
		
		(function() {
		    var e = document.createElement('script');
		    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
		    e.async = true;
		    document.getElementById('fb-root').appendChild(e);
		}());
    </script>
    
    
    
	<div id="application" class="container">
		<script type="text/javascript">
			$('#application').hide();
		</script>
		<!-- Game Logo -->
        <img style="border:0;display:block;margin-left:auto;margin-right:auto" src="http://[var.myserver]/uriel.life.common/public/images/logo.jpg" />
		<!-- Install Status -->
        <div class="container">
            <div class="step_container" style="display:block;margin-left:auto;margin-right:auto">
                <div id="step_buttons_container">
                    <div class="not_active">
                         <div class="number not_active_number">
                            1
                        </div>
                        <div class="applay"></div>
                        <div class="button_name"> Logged in!</div>
                    </div>

                    <div id="fan_button" class="step_buttons">
                        <div class="number">
                            2
                        </div>
                        <div class="empty"></div>
                        <div class="button_name">Like</div>
                    </div>

                    <div id="like_container">
                        <div id="like_close_container">
                            <div id="like_close">X</div>
                        </div>
                        <div>
                            <fb:like-box profile_id="[var.app_id]" width="300" height="100" connections="0" stream="false" header="false"></fb:like-box>
                        </div>
                    </div>
                    <div id="review_button" class="step_buttons">
                         <div class="number">
                            3
                        </div>
                        <div class="empty"></div>
                        <div class="button_name">Review</div>
                    </div>

                    <div id="permissions_button" class="step_buttons">
                        <div class="number">
                            4
                        </div>
                        <div class="empty"></div>
                        <div class="button_name">Permissions</div>
                    </div>
                    <div id="locked_button" class="step_buttons">
                        <div class="number"> 
                        	5 
                        </div>
                        <div class="empty"></div>
                        <div class="button_name">Locked</div>
                    </div>
                    <div id="reward_button" class="step_buttons">
                        <div class="number"> 
                        	5 
                        </div>
                        <div class="empty"></div>
                        <div class="button_name">Claim Reward</div>
                    </div>
                </div>
            </div>
        </div>
		<!-- Progress Bar -->        
		<div class="container">
            <div class="progress_container"  style="display:block;margin-left:auto;margin-right:auto">
                <div id="progress_logo"></div>
                <div id="progress_install">
                </div>
            </div>
        </div>
    	<div class="clearfix"></div>
    	
    
	    <div class="container">
			<!-- Menu -->
	        <div id="nav_menu" class="container"  style="display:block;margin-left:auto;margin-right:auto">
	            <div id="nav">
				<ul class="tabs">
				<li style="display:inline"> 
					<div id="gifts_button" class="menu_tab inactive" > 
					  <span>Free Gifts</span> 
					</div> 
				</li> 
				<li style="display:inline"> 
					<div id="play_button" class="menu_tab active"> 
					  <span>Play</span> 
					</div> 
				</li> 
				<li style="display:inline"> 
					<div  id="invite_button" class="menu_tab inactive"> 
					  <span>Invite Friends</span> 
					  </div>
				</li> 
				<li style="display:inline"> 
					<div id="buy_button" class="menu_tab inactive"> 
					  <span>Add Bookmarks</span> 
					  </div>
				</li> 
				</ul>
				</div>
	        </div>
	        
			<!--  Gift Frame  -->
			<div id="gift_window" class="container">
				<img style="padding:10px;border:0;display: block;margin-left: auto;margin-right: auto" src="http://[var.myserver]/uriel.life.facebook/public/images/ajax-loader.gif" />
			</div>
			
			<!--  Game Frame  -->
			<div id="game_window" class="container">
				<div id="altContent">
					<p>Alternative content</p>
					<p> <a href="http://www.adobe.com/go/getflashplayer">
							<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" 
								 alt="Get Adobe Flash player" />
						</a>
					</p>
				</div>
			</div>
			<!--  Bookmarks  -->
			<div id="bookmarks_window" class="container">
				<img style="padding:10px;border:0;display: block;margin-left: auto;margin-right: auto" src="http://[var.myserver]/uriel.life.facebook/public/images/ajax-loader.gif" />
			</div>
			<!--  Invite Friends  -->
			<div id="invite_window" class="container">
				<img style="padding:10px;border:0;display: block;margin-left: auto;margin-right: auto" src="http://[var.myserver]/uriel.life.facebook/public/images/ajax-loader.gif" />
			</div>
			<!--  claim reward  -->
			<div id="reward_window" class="container">
				<img style="padding:10px;border:0;display: block;margin-left: auto;margin-right: auto" src="http://[var.myserver]/uriel.life.facebook/public/images/ajax-loader.gif" />
			</div>
			<!--  accept requests  -->
			<div id="accept_window" class="container">
				[onload;file=[var.giftaccepted;noerr];htmlconv=no;protect=no;noerr]
			</div>
			<div class="container">
			    <iframe id="invite_result" name="invite_result" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>
			</div>
		</div>
	</div>
	
	<div id="dialog-overlay"></div>
	<div id="dialog-box">
		<div class="dialog-content">
			<div id="dialog-message"></div>
			<a href="#" class="button">Close</a>
		</div>
	</div>
	
</body>
</html>
