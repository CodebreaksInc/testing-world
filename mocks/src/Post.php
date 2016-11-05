<?php

class Post
{
	protected $storage;
	protected $notification;

    public function __construct(StorageRepository $storage , NotificationRepository $notification)
    {
		$this->storage = $storage;
		$this->notification = $notification;
    }

    public function publish($data)
    {
        $this->storage->save($data);
        $this->notification->notify();
    }
}
