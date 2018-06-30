</head>
<body>

	<div id="wrapper clearfix">

		<!-- Navigation -->
		<nav class="navbar navbar-default navbar-static-top" 
			style="margin-bottom: 0">
			<div class="navbar-header col-md-12">
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<div class="col-md-4" style="padding: 10px">
					<a href="<?php echo site_url();?>"><img height="70"
						src="<?php //echo site_url("public/img/dfc-logo.png");?>"></a>
				</div>
                <div class="col-md-offset-10 col-md-2">
                    <?php if(isset($this->session->userdata['logged_in'])) { ?>
                        <a href="<?php echo site_url('/login/logout')?>">Logout</a>
                    <?php } else{ ?>
                        <a href="<?php echo site_url('/login/index')?>">Login</a> / <a href="<?php echo site_url('/register/index')?>">Register</a>
                    <?php } ?>
                </div>
			</div>

		</nav>
		

	</div>


		<!-- Page Content -->
	<div id="page-wrapper clearfix">
		<div class="container-fluid">
            <?php if(isset($this->session->userdata['logged_in'])) { ?>
                <div class="list-group row left col-sm-3 col-md-2">
                    <p class="list-group-item active">Game</p>
                    <a href="<?php echo site_url('/game/index')?>" class="list-group-item">Start a new game</a>
                    <a href="<?php echo site_url('/gallery/index')?>" class="list-group-item">Check the gallery</a>
                    <p class="list-group-item active">Results</p>
                    <a href="<?php echo site_url('/results/index')?>" class="list-group-item">Game results</a>
                    <a href="<?php echo site_url('/results/stats')?>" class="list-group-item">Game stats</a>
                </div>
            <?php } ?>

            <div class="row">
                <div class="left col-sm-9 col-md-10">