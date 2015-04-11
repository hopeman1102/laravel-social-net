<?php namespace App\Commands;

use App\Commands\Command;
use App\User;
use Auth;
use Illuminate\Contracts\Bus\SelfHandling;

class LogoutUserCommand extends Command implements SelfHandling {

	/**
	 * @var User
	 */
	public $user;

	/**
	 * Create a new command instance.
	 *
	 * @param int $userId
	 *
	 * @return void
	 */
	public function __construct($userId)
	{
		$this->user = User::find($userId);
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$this->user->updateOnlineStatus(0);
		// $friendsUserIds = $this->user->friends()->where('onlinestatus', 1)->lists('requester_id');
		// $relatedToId = $this->user->id;
		// $this->socketClient->updateChatStatusBar($friendsUserIds, 22, $relatedToId, false);
		Auth::logout();

		return Auth::check();
	}

}
