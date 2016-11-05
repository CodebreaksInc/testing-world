<?php

namespace spec;

use Post;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use StorageRepository;
use NotificationRepository;
class PostSpec extends ObjectBehavior
{
	public function let(StorageRepository $storage, NotificationRepository $notification)
	{
		$this->beConstructedWith($storage, $notification);
	}

    function it_is_initializable()
    {
        $this->shouldHaveType(Post::class);
    }

    public function it_create_new_post(StorageRepository $storage, NotificationRepository $notification)
    {
    	$data = ["title"=>"Mon nouveau titre", "body"=>"Du texte"];
    	$notification->notify()->shouldBeCalled();
    	$this->publish($data);
        $storage->save($data)->shouldHaveBeenCalled();
    }
    
}
