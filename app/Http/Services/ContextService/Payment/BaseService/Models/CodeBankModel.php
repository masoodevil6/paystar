<?php
namespace App\Http\Services\ContextService\Payment\BaseService\Models;

class CodeBankModel{

    private $code = 0;
    private $messagesEn = "";
    private $messagesFa = "";
    private $public = false;
    private $continue = false;


    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    protected function setCode($code)
    {
        $this->code = $code;
    }






    /**
     * @return string
     */
    public function getMessagesEn()
    {
        return $this->messagesEn;
    }

    /**
     * @param string $messagesEn
     */
    protected function setMessagesEn($messagesEn)
    {
        $this->messagesEn = $messagesEn;
    }






    /**
     * @return string
     */
    public function getMessagesFa()
    {
        return $this->messagesFa;
    }

    /**
     * @param string $messagesFa
     */
    protected function setMessagesFa($messagesFa)
    {
        $this->messagesFa = $messagesFa;
    }






    /**
     * @return bool
     */
    public function isPublic()
    {
        return $this->public;
    }

    /**
     * @param bool $public
     */
    protected function setPublic($public)
    {
        $this->public = $public;
    }




    /**
     * @return bool
     */
    public function isContinue()
    {
        return $this->continue;
    }

    /**
     * @param bool $continue
     */
    protected function setContinue($continue)
    {
        $this->continue = $continue;
    }



}
