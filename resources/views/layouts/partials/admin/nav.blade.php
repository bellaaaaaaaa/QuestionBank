
<nav class="navbar navbar-expand-lg navbar-absolute navbar-light mt-0" id="nav-item-color">
 <div class="container-fluid">
   <div class="navbar-wrapper">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
   </div>

   <div class="collapse navbar-collapse justify-content-end" id="navigation">
     <ul class="navbar-nav">
       <li class="nav-item mobile-log">
         <a class="nav-link btn-magnify" href="{{ route('admin.dashboard') }}">
           <i class="fa fa-bars"></i>
           <p>
             <span class="d-lg-none d-md-block">Dashboard</span>
           </p>
         </a>
       </li>
       <li class="nav-item btn-rotate dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i class="fa fa-cog"></i><span>Settings</span>
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



