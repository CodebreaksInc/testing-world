<?php

namespace spec;

use Post;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use StorageRepository;
use NotificationRepository;
use Auth;
class PostSpec extends ObjectBehavior
{
	public function let(StorageRepository $storage, NotificationRepository $notification, Auth $auth)
	{
		$this->beConstructedWith($storage, $notification, $auth);
	}

    function it_is_initializable()
    {
        $this->shouldHaveType(Post::class);
    }

    public function it_publish_new_post(StorageRepository $storage, NotificationRepository $notification, Auth $auth)
    {
    	$data = ["title"=>"Mon nouveau titre", "body"=>"Du texte"];
        $auth->check()->willReturn(true);
    	$storage->save($data)->shouldBeCalled();
    	$notification->notify()->shouldBeCalled();
    	$this->publish($data);
    }

    public function it_allows_authorized_users_to_publish_post(StorageRepository $storage, NotificationRepository $notification, Auth $auth)
    {
        $data = ["title"=>"Mon nouveau titre", "body"=>"Du texte"];
        $auth->check()->willReturn(true);
        $storage->save($data)->shouldBeCalled();
        $notification->notify()->shouldBeCalled();
        $this->publish($data)->shouldReturn(true);
    }

    public function it_blocks_unauthorized_users_from_publishing_post(Auth $auth)
    {
        $data = ["title"=>"Mon nouveau titre", "body"=>"Du texte"];
        $auth->check()->willReturn(false);
        $this->publish($data)->shouldReturn(false);
    }
    
}
