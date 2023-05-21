<?php

namespace App\Http\Services\ContextService\BaseService;

use App\Http\Services\ContextService\BaseService\Models\PublicMessageModel;

class PublicToolsMessageService
{
    protected $listPublicMessages = [];

    protected function getTextPublicMessage($titleMessage) : string|null{
        /**@var PublicMessageModel $itemMessage*/
        foreach ($this->listPublicMessages As $itemMessage){
            if ($titleMessage == $itemMessage->getTitle()){
                return $itemMessage->getMessages();
            }
        }
        return null;
    }

}
