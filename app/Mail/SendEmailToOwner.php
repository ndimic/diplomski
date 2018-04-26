<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailToOwner extends Mailable
{
	use Queueable, SerializesModels;
	
	public $car;
	public $sender;
	public $request;
	
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct( $car, $sender, $request )
	{
		$this->car     = $car;
		$this->sender  = $sender;
		$this->request = $request;
	}
	
	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->subject( "Polovni automobili - Nova poruka od zainteresovanih kupaca" )->view( 'emails.send_email_to_owner' );
	}
}
