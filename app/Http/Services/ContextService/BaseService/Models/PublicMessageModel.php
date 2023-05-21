<?php

namespace App\Http\Services\ContextService\BaseService\Models;

class PublicMessageModel
{

    private $title = "";
    private $messages = "";

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getMessages(): string
    {
        return $this->messages;
    }

    /**
     * @param string $messages
     */
    public function setMessages(string $messages): void
    {
        $this->messages = $messages;
    }


}
