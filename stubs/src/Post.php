<?php

class Post
{
	protected $storage;
	protected $notification;
    protected $guard;

    public function __construct(StorageRepository $storage , NotificationRepository $notification , Auth $guard)
    {
		$this->storage = $storage;
		$this->notification = $notification;
        $this->guard = $guard;
    }

    public function publish($data)
    {
        if (! $this->guard->check()) return false;
        $this->storage->save($data);
        $this->notification->notify();
        return true;
    }
}
