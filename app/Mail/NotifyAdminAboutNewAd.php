<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyAdminAboutNewAd extends Mailable
{
	use Queueable, SerializesModels;
	
	public $user;
	public $car;
	
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct( $user, $car )
	{
		$this->user = $user;
		$this->car  = $car;
	}
	
	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->subject( "Polovni automobili - Imate nove oglase u listi za odobravanje" )->view( 'emails.approve_ad' );
	}
}
