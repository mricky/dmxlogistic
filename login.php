<style type="text/css">
<!--
body, td, th {
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #333;
}
body {
	background-color: #FFF;
	margin: 0;
}
a, a:visited {
	color: #000066;
	text-decoration: underline;
}
a:hover {
	text-decoration: none;
}
form {
	margin: 0;
	padding: 0;
}
input, select, textarea {
	font-family: Tahoma, Arial, Helvetica, sans-serif;
	font-size: 11px;
	padding: 3px;
}
#login_container {
	color: #333;
	background-color: #FFF;
	text-align: left;
	width: 330px;
	padding: 1px;
	margin: 20px auto 10px auto;
	border: 1px solid #CCCCCC;
}
#logo {
	text-align: center;
	margin: 0;
	padding: 50px 0 0 0;
}
#login_container #login {
	background-color: #EFEFEF;
	text-align: left;
	margin: 0;
	padding: 10px;
}
#login_container #login_failed {
    background-color: #FCF9D2;
    text-align: center;
    padding: 10px;
    margin: 0 0 1px 0;
}
#login_container #extra_info {
	background-color: #CCC;
	text-align: left;
	padding: 10px;
	margin: 1px 0 0 0;
}
-->
</style>
<!--<div id="logo"><img src="login_files/loginlogo.gif" alt="WHMCS" width="205" height="62"></div>
-->
<script type="text/javascript">
$(document).ready(function() {

	$().ajaxStart(function() {
		$('#loading').show();
		$('#result').hide();
	}).ajaxStop(function() {
		$('#loading').hide();
		$('#result').fadeIn('slow');
	});

	$('#frmlogin').submit(function() {
		$.ajax({
			type: 'POST',
			url: $(this).attr('action'),
			data: $(this).serialize(),
			success: function(data) {
				$('#result').html(data);
			}
		})
		return false;
	});
  $('#result').click(function(){
  $(this).hide();
  });
})
</script> 
<div id="loading" style="display:none;"><img src="images/loading.gif" alt="loading..." /></div>
<div id="result" style="display:none;"></div>
<div id="login_container">
  <div id="login"><h3 style="padding:0;margin:0;">Login Form</h3>
    <form action="dologin.php" method="post" name="frmlogin" id="frmlogin">
      <table width="100%" border="0" cellpadding="5" cellspacing="0">
        <tbody><tr>
          <td valign="middle" width="30%" align="right"><strong>Username</strong></td>
          <td valign="middle" align="left"><input name="username" size="30" type="text" autocomplete="off" ></td>
        </tr>
        <tr>
          <td valign="middle" width="30%" align="right"><strong>Password</strong></td>
          <td valign="middle" align="left"><input name="password" size="30" type="password" autocomplete="off" ></td>
        </tr>
        <tr>
          <td valign="middle" width="30%" align="right">&nbsp;</td>
          <td valign="middle" align="left"><input value="Login" class="button" type="submit"></td>
        </tr>
      </tbody></table>
    </form>
  </div>
</div>