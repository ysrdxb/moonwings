<div class="app-sidebar-menu">
	<div class="h-100" data-simplebar>

		<!--- Sidemenu -->
		<div id="sidebar-menu">

			<div class="logo-box">
				<a class='logo logo-light' href="{{ route('admin.dashboard') }}">
					<span class="logo-sm">
						<img src="{{ asset('admin/images/logo-transparent.png') }}" alt="" height="22">
					</span>
					<span class="logo-lg">
						<img src="{{ asset('admin/images/logo-transparent.png') }}" alt="" height="24">
					</span>
				</a>
				<a class='logo logo-dark' href="{{ route('admin.dashboard') }}">
					<span class="logo-sm">
						<img src="{{ asset('admin/images/logo-transparent.png') }}" alt="" height="22">
					</span>
					<span class="logo-lg">
						<img src="{{ asset('admin/images/logo.png') }}" alt="" height="65">
					</span>
				</a>
			</div>

			<ul id="side-menu">
	
				<!-- <li>
					<a href="landing.html" target="_blank">
						<i data-feather="globe"></i>
						<span> Landing </span>
					</a>
				</li> -->

				<li>
					<a href="#sidebarAuth" data-bs-toggle="collapse">
						<i data-feather="settings"></i>
						<span> Settings </span>
						<span class="menu-arrow"></span>
					</a>
					<div class="collapse" id="sidebarAuth">
						<ul class="nav-second-level">
							<li>
								<a class="tp-link" href="{{ route('admin.settings') }}">General Setting</a>
							</li>
							<li class="nav-item">
								<a class="tp-link" href="{{ route('admin.countries') }}">Countries</a>
							</li>
							<li class="nav-item">
								<a class="tp-link" href="{{ route('admin.cities') }}">Cities</a>
							</li>
							<li class="nav-item">
								<a class="tp-link" href="{{ route('admin.locations') }}">Locations</a>
							</li>								
							<li class="nav-item">
								<a class="tp-link" href="{{ route('admin.languages') }}">Languages</a>
							</li>
							<li class="nav-item">
								<a class="tp-link" href="{{ route('admin.currencies') }}">Currencies</a>
							</li>
						</ul>
					</div>
				</li>

				<li>
					<a href="#sidebarCMS" data-bs-toggle="collapse">
						<i data-feather="layout"></i>
						<span> CMS </span>
						<span class="menu-arrow"></span>
					</a>
					<div class="collapse" id="sidebarCMS">
						<ul class="nav-second-level">
							<li>
								<a class='tp-link' href="{{ route('admin.page') }}">Pages</a>
							</li>
							<li>
								<a class='tp-link' href="{{ route('admin.menu') }}">Menus</a>
							</li>
						</ul>
					</div>
				</li>				

				<li>
					<a href="#sidebarBaseui" data-bs-toggle="collapse">
						<i data-feather="key"></i>
						<span> Hotels </span>
						<span class="menu-arrow"></span>
					</a>
					<div class="collapse" id="sidebarBaseui">
						<ul class="nav-second-level">
							<li>
								<a class="tp-link" href="{{ route('admin.hotel.amenity') }}">Hotel Amenities</a>
							</li>		
							<li>
								<a class="tp-link" href="{{ route('admin.hotel') }}">Hotel List</a>
							</li>
						</ul>
					</div>
				</li>

				<li>
					<a href="#sidebarCar" data-bs-toggle="collapse">
						<i data-feather="truck"></i>
						<span> Cars </span>
						<span class="menu-arrow"></span>
					</a>
					<div class="collapse" id="sidebarCar">
						<ul class="nav-second-level">
							<li>
								<a class="tp-link" href="{{ route('admin.car.category') }}">Car Categories</a>
							</li>
							<li>
								<a class="tp-link" href="{{ route('admin.car.make') }}">Car Make</a>
							</li>
							<li>
								<a class="tp-link" href="{{ route('admin.car.model') }}">Car Model</a>
							</li>			
							<li>
								<a class="tp-link" href="{{ route('admin.car') }}">Car List</a>
							</li>
						</ul>
					</div>
				</li>                            

				<li>
					<a href="#sidebarBlogs" data-bs-toggle="collapse">
						<i data-feather="file-text"></i>
						<span> Blog </span>
						<span class="menu-arrow"></span>
					</a>
					<div class="collapse" id="sidebarBlogs">
						<ul class="nav-second-level">
							<li>
								<a class="tp-link" href="{{ route('admin.blog.category') }}">Blog Categories</a>
							</li>
							<li>
								<a class="tp-link" href="{{ route('admin.blog.category.create') }}">Add Blog Category</a>
							</li>								
							<li>
								<a class="tp-link" href="{{ route('admin.blog') }}">Blost Posts</a>
							</li>
							<li>
								<a class="tp-link" href="{{ route('admin.blog.create') }}">Add Blog Post</a>
							</li>
						</ul>
					</div>
				</li>

				<li>
					<a href="#sidebarModule" data-bs-toggle="collapse">
						<i data-feather="box"></i>
						<span> Modules </span>
						<span class="menu-arrow"></span>
					</a>
					<div class="collapse" id="sidebarModule">
						<ul class="nav-second-level">
							<li>
								<a class="tp-link" href="{{ route('admin.modules') }}">Modules List</a>
							</li>
						</ul>
					</div>
				</li>				

				<li>
					<a href="#sidebarUsers" data-bs-toggle="collapse">
						<i data-feather="users"></i>
						<span> Users </span>
						<span class="menu-arrow"></span>
					</a>
					<div class="collapse" id="sidebarUsers">
						<ul class="nav-second-level">
							<li>
								<a class="tp-link" href="{{ route('admin.user') }}">Users List</a>
							</li>
							<li>
								<a class="tp-link" href="{{ route('admin.user.create') }}">Add User</a>
							</li>
						</ul>
					</div>
				</li>

			</ul>

		</div>
		<!-- End Sidebar -->

		<div class="clearfix"></div>

	</div>
</div>