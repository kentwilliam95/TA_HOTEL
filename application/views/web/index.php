<!doctype html>
    <html>
        <head>
            <title>Hotel Bukit Surya</title>
            <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet">
            <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css');?>" rel="stylesheet">
        
            <link href="<?php echo base_url('assets/css/plugins/morris/morris-0.4.3.min.css');?>" rel="stylesheet">
            <link href="<?php echo base_url('assets/css/plugins/timeline/timeline.css');?>" rel="stylesheet">
        
            
            <script src="<?php echo base_url('assets/js/jquery.js');?>"></script>
            <script src="<?php echo base_url('assets/js/bootstrap.js');?>"></script>
            <script src="<?php echo base_url('assets/js/tinymce/tinymce.min.js');?>"></script>
            <script>
                    tinymce.init({selector:'textarea'});
            </script>

	<style type="text/css">
.navbar-header{
	padding-left:100px;
}
#place-nav {
  width:960px;
  height:20px;
  margin:63px 0 0 0;
}
#nav {
  height:35px;
}
#nav li {
  height:20px;
  float:left;
  display:inline;
  margin:0 5px;
  position:relative;
  font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
  z-index:1000;
}
#nav li a {
  float:left;
  display:inline;
  height:10px;
  padding:10px 8px 0 8px;
  font-size:36px;
  color:white;
  font-weight:bold;
  text-transform:uppercase;
  text-shadow:0 0 3px #c7c7c7;
}
#nav li:hover a {
  text-decoration:none;
  color:#505050;
}
#place-nav ul ul {
  position:absolute;
  z-index:1200;
  display:none;
  width:186px;
  margin: 0;
  top: 35px;
  left:0;
  background:grey;
  padding:0 0 2px 0;
}
#place-nav ul li ul li {
  display: inline;
  float: left;
  width:186px;
  height:auto;
  border-bottom:1px solid #085d93;
  float: left;
  padding: 0;
  position:relative;
  margin:0;
}
#place-nav ul ul ul {
  position:absolute;
  z-index:1300;
  display:none;
  width:186px;
  margin: 0;
  top: 0;
  left:183px;
  background:grey;
  border-left:1px solid #1479c3;
  padding:0;
}
#place-nav ul li ul li ul li {
  display: inline;
  float: left;
  padding: 0;
}
#place-nav #nav li:hover ul li a, #place-nav #nav li:hover ul li a:link, #place-nav #nav li:hover ul li a:visited {
  color:#fff;
  font-size:12px;
  width:170px;
  height:auto;
  text-transform:none;
  border:none;
  background: none;
  padding:9px 8px;
  text-shadow:none;
  margin:0;
  font-weight:lighter;
}
#place-nav #nav li:hover ul li a:hover, #place-nav #nav li ul li a:hover {
  text-decoration:none;
  color:#fff;
  background:#0f74bd;
}
.container{
	margin-left:475px;
}
body{
	background-image:url('<?php echo base_url("assets/img/kkk.jpg")?>');
	background-repeat:no-repeat;
}
div#place-nav li:hover ul ul,
div#place-nav li li:hover ul ul
{display:none;} div#place-nav li:hover ul,
div#place-nav li li:hover ul
{display:block;}
	</style>
        </head>
        <body>
            
            <!-- Static navbar -->
            <div class="navbar navbar-default">
                <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
               
		</ul>
		</div>
	
                </div><!--/.nav-collapse -->
                </div>
            </div>

            
            
            
            
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span class="glyphicon glyphicon-lock"></span> Login
                            </div>
                            <div class="panel-body">
                                <form class="form-horizontal" role="form" action="<?php echo site_url('web/proses');?>" method="post">
                                    <?php echo $this->session->flashdata('message');?>
									
									<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hotel Bukit Surya</h2>
									
									<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jl. Air Panas No.4,Padusan,Pacet,Mojokerto</h5>
									
									
									<br>
									
                                    <div class="form-group">
									
                                        <label for="inputEmail3" class="col-sm-3 control-label">
                                            Username</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="Username" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword3" class="col-sm-3 control-label">
                                            Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"/>
                                                    Remember me
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group last">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <button type="submit" class="btn btn-success btn-sm">
                                                Sign in</button>
                                                 <button type="reset" class="btn btn-default btn-sm">
                                                Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="panel-footer">
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
    
            
            
            <!-- Core Scripts - Include with every page -->
            <script src="<?php echo base_url('assets/js/holder.js');?>"></script>
    
            <script src="<?php echo base_url('assets/js/application.js');?>"></script>
            <script src="<?php echo base_url('assets/js/jquery-1.10.2.js');?>"></script>
            <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
            <script src="<?php echo base_url('assets/js/plugins/metisMenu/jquery.metisMenu.js');?>"></script>
            <script src="<?php echo base_url('assets/js/plugins/morris/raphael-2.1.0.min.js');?>"></script>
            <script src="<?php echo base_url('assets/js/plugins/morris/morris.js');?>"></script>
            <script src="<?php echo base_url('assets/js/sb-admin.js');?>"></script>
            <script src="<?php echo base_url('assets/js/demo/dashboard-demo.js');?>"></script>   
        </body>
    </html>