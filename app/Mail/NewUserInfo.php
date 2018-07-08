<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserInfo extends Mailable
{
	use Queueable, SerializesModels;
	
	public $email;
	public $password;
	public $role;
	
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct( $email, $password, $role )
	{
		$this->email    = $email;
		$this->password = $password;
		$this->role     = $role;
	}
	
	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->subject( "Polovni automobili - Podaci za pristup sajtu" )->view( 'emails.user_info' );
	}
}
