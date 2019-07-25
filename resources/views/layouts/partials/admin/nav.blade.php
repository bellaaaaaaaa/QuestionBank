
<nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent mt-0" id="nav-item-color" style="border-bottom: 1px solid #ddd;">
 <div class="container-fluid">
   <div class="navbar-wrapper">
     <div class="navbar-toggle">
       <button type="button" class="navbar-toggler">
         <span class="navbar-toggler-bar bar1"></span>
         <span class="navbar-toggler-bar bar2"></span>
         <span class="navbar-toggler-bar bar3"></span>
       </button>
     </div>
   </div>
   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
     <span class="navbar-toggler-bar navbar-kebab"></span>
     <span class="navbar-toggler-bar navbar-kebab"></span>
     <span class="navbar-toggler-bar navbar-kebab"></span>
   </button>
   <div class="collapse navbar-collapse justify-content-end" id="navigation">
     <ul class="navbar-nav">
       <li class="nav-item">
         <a class="nav-link btn-magnify" href="{{ route('admin.dashboard') }}">
           <i class="nc-icon nc-layout-11"></i>
           <p>
             <span class="d-lg-none d-md-block">Dashboard</span>
           </p>
         </a>
       </li>
       <li class="nav-item btn-rotate dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i class="nc-icon nc-settings-gear-65"></i>
           <p>
             <span class="d-lg-none d-md-block">Some Actions</span>
           </p>
         </a>
         <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
           <a class="dropdown-item" href="{{ route('admin.account.show') }}">Edit Profile</a>
           <a class="dropdown-item" href="{{ route('admin.logout') }}">Log Out</a>
         </div>
       </li>
     </ul>
   </div>
 </div>
</nav>



