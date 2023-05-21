<?php
namespace App\Tools\Models\Repositories\Users;

class ModelInfoUserMessage{

   private $messageTitle = "";
   private $messageText = "";



    /**
     * @return string
     */
    public function getMessageTitle()
    {
        return $this->messageTitle;
    }

    /**
     * @param string $messageTitle
     */
    public function setMessageTitle( $messageTitle)
    {
        $this->messageTitle = $messageTitle;
    }




    /**
     * @return string
     */
    public function getMessageText()
    {
        return $this->messageText;
    }

    /**
     * @param string $messageText
     */
    public function setMessageText( $messageText)
    {
        $this->messageText = $messageText;
    }



}