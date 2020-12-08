<header class="py-sm-3 pt-3 pb-2" id="home">
	<div class="container">
		<!-- nav -->
		<div class="top d-md-flex">
			<div id="logo">
				<h1> <a href="index.html"><span class="fa fa-meetup"></span> Furnish</a></h1>
			</div>
			<div class="search-form mx-md-auto">
				<div class="n-right-w3ls">
					<form action="#" method="post" class="newsletter">
						<input class="search" type="text" placeholder="Search..." required="">
						<button class="form-control btn" value=""><span class="fa fa-search"></span></button>
					</form>
				</div>
			</div>
			<div class="forms mt-md-0 mt-2">
				<a href="login.html" class="btn"><span class="fa fa-user-circle-o"></span> Sign In</a>
				<a href="register.html" class="btn"><span class="fa fa-pencil-square-o"></span> Create Account</a>
			</div>
		</div>
		<nav class="text-center">
			<label for="drop" class="toggle"><span class="fa fa-bars"></span></label>
			<input type="checkbox" id="drop" />
			<ul class="menu">
				<li class="mr-lg-4 mr-2 active"><a href="index.html">Home</a></li>
                <li class="mr-lg-4 mr-2 dropdown">
                    <a href="about.html" class="dropdown-toggle" data-toggle="dropdown">Regions</a>
                    <ul class="dropdown-menu">
                        <?php
                            $regions = $this->crud_model->get_data('region');
                            foreach($regions as $region){
                        ?>
                        <li class="mr-lg-4 mr-2 dropright dropdown-item" >
                            <a class="dropdown-toggle " data-toggle="dropdown" ><?=$region['region_name']?></a>
                              
                            <div class="dropdown-menu">
                            <?php
                                $states = $this->db->get_where('state',array('region_id'=>$region['region_id']))->result_array();
                                foreach($states as $state){
                            ?> 
                                <a href="<?=base_url().$state['slug']?>"><?=$state['state_name']?></a>
                            <?php
                                }
                            ?>
                            </div>
                        </li>
                        <?php
                            }?>

                        
                    </ul>
                </li>
				<li class="mr-lg-4 mr-2"><a href="services.html">Services</a></li>
				<li class="mr-lg-4 mr-2"><a href="categories.html">Categories</a></li>
				<li class="mr-lg-4 mr-2"><a href="blog.html">Blog</a></li>
				<li class=""><a href="contact.html">Contact</a></li>
			</ul>
		</nav>
		<!-- //nav -->
	</div>
</header>