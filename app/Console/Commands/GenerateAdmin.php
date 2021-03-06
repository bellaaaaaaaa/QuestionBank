<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
class GenerateAdmin extends Command{
 /**
  * The name and signature of the console command.
  *
  * @var string
  */
 protected $signature = 'generate:admin';
 /**
  * The console command description.
  *
  * @var string
  */
 protected $description = 'Create a user with admin privileges access';
 /**
  * Create a new command instance.
  *
  * @return void
  */
 public function __construct()
 {
     parent::__construct();
 }
 /**
  * Execute the console command.
  *
  * @return mixed
  */
 public function handle(){
   $email = $this->ask('Enter admin email?');
   $password = $this->secret('Enter admin password?');
   $confirmPassword = $this->secret('Confirm password?');
   // Passwords don't match
   if ($password != $confirmPassword) {
     $this->error("Passwords don't match");
     return;
   }
   // Email has error
   if (!filter_var($email, FILTER_VALIDATE_EMAIL) || User::where('email', $email)->count() != 0) {
     $this->error("Email is invalid or has been taken");
     return;
   }
   $user = User::create([
       'email' => $email,
       'password' => Hash::make($password),
   ]);
   if(isset($user)){
     $this->info('A user with admin access has been created.');
   }else{
     $this->error("An error occurred, please try again later");
     return;
   }
 }
}






