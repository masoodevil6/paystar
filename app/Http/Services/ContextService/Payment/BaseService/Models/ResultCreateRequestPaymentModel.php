<?php

namespace App\Http\Services\ContextService\Payment\BaseService\Models;


class ResultCreateRequestPaymentModel
{

    private $status = false;
    private $msg = "";
    private $redirect = null ;


    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg): void
    {
        $this->msg = $msg;
    }

    /**
     * @return null
     */
    public function getRedirect()
    {
        return $this->redirect;
    }

    /**
     * @param null $redirect
     */
    public function setRedirect($redirect): void
    {
        $this->redirect = $redirect;
    }







}
