<?php
namespace App\Repositories;

use App\Models\Banks\Bank;
use App\Models\Banks\BankPayment;
use App\Models\Banks\BankPaymentRefund;
use App\Models\Banks\BankPaymentUnVerify;
use App\Models\Offs\CodeOff;
use App\Models\Offs\CodeOffStatus;
use App\Models\Orders\Order;
use App\Models\Orders\OrderBasket;
use App\Models\Panel\Admin;
use App\Models\Panel\AdminUser;
use App\Models\Panel\Panel;
use App\Models\Panel\PanelGroup;
use App\Models\Publics\Setting;
use App\Models\Subscribes\Subscribe;
use App\Models\Subscribes\SubscribePayment;
use App\Models\Users\Otp;
use App\Models\Users\User;
use App\Repositories\InterFaceRepositories\Banks\IBanckRepository;
use App\Repositories\InterFaceRepositories\Banks\IBankPaymentRefundRepository;
use App\Repositories\InterFaceRepositories\Banks\IBankPaymentRepository;
use App\Repositories\InterFaceRepositories\Banks\IBankPaymentUnVerifyRepository;
use App\Repositories\InterFaceRepositories\Offs\ICodeOffRepository;
use App\Repositories\InterFaceRepositories\Offs\ICodeOffStatusRepository;
use App\Repositories\InterFaceRepositories\Orders\IOrderBasketRepository;
use App\Repositories\InterFaceRepositories\Orders\IOrderRepository;
use App\Repositories\InterFaceRepositories\Panels\IAdminRepository;
use App\Repositories\InterFaceRepositories\Panels\IAdminUserRepository;
use App\Repositories\InterFaceRepositories\Panels\IPanelGroupRepository;
use App\Repositories\InterFaceRepositories\Panels\IPanelRepository;
use App\Repositories\InterFaceRepositories\PhoneStores\IPhoneStorePurchaseRepository;
use App\Repositories\InterFaceRepositories\PhoneStores\IPhoneStoreRepository;
use App\Repositories\InterFaceRepositories\PhoneStores\IPhoneStoreRequestTokenRepository;
use App\Repositories\InterFaceRepositories\PhoneStores\IPhoneStoreTokenRepository;
use App\Repositories\InterFaceRepositories\Publics\ISettingRepository;
use App\Repositories\InterFaceRepositories\Subscribes\ISubscribePaymentRepository;
use App\Repositories\InterFaceRepositories\Subscribes\ISubscribeRepository;
use App\Repositories\InterFaceRepositories\Users\IOtpRepository;
use App\Repositories\InterFaceRepositories\Users\IUserRepository;
use App\Repositories\ModelRepositories\Banks\BankPaymentRefundRepository;
use App\Repositories\ModelRepositories\Banks\BankPaymentRepository;
use App\Repositories\ModelRepositories\Banks\BankPaymentUnVerifyRepository;
use App\Repositories\ModelRepositories\Banks\BankRepository;
use App\Repositories\ModelRepositories\Offs\CodeOffRepository;
use App\Repositories\ModelRepositories\Offs\CodeOffStatusRepository;
use App\Repositories\ModelRepositories\Orders\OrderBasketRepository;
use App\Repositories\ModelRepositories\Orders\OrderRepository;
use App\Repositories\ModelRepositories\Panels\AdminRepository;
use App\Repositories\ModelRepositories\Panels\AdminUserRepository;
use App\Repositories\ModelRepositories\Panels\PanelGroupRepository;
use App\Repositories\ModelRepositories\Panels\PanelRepository;
use App\Repositories\ModelRepositories\Publics\SettingRepository;
use App\Repositories\ModelRepositories\Subscribes\SubscribePaymentRepository;
use App\Repositories\ModelRepositories\Subscribes\SubscribeRepository;
use App\Repositories\ModelRepositories\Users\OtpRepository;
use App\Repositories\ModelRepositories\Users\UserMessageRepository;
use App\Repositories\ModelRepositories\Users\UserRepository;
use Illuminate\Validation\Rule;


class ContextRepository{

    //// =============================================
    //// admin
    //// =============================================

    /**@var IAdminRepository<Admin> $adminRepository*/
    private static $adminRepository;

    /**@var IAdminUserRepository<AdminUser> $adminUserRepository*/
    private static $adminUserRepository;

    /**@var IPanelGroupRepository<PanelGroup> $panelGroupRepository*/
    private static $panelGroupRepository;

    /**@var IPanelRepository<Panel> $panelRepository*/
    private static $panelRepository;


    /**@return IAdminRepository<Admin> */
    public static function AdminRepository() : IAdminRepository
    {
        if (self::$adminRepository == null){
            self::$adminRepository = new AdminRepository();
        }
        return self::$adminRepository;
    }

    /**@return IAdminUserRepository<AdminUser> */
    public static function AdminUserRepository() : IAdminUserRepository
    {
        if (self::$adminUserRepository == null){
            self::$adminUserRepository = new AdminUserRepository();
        }
        return self::$adminUserRepository;
    }

    /**@return IPanelGroupRepository<PanelGroup> */
    public static function PanelGroupRepository() : IPanelGroupRepository
    {
        if (self::$panelGroupRepository == null){
            self::$panelGroupRepository = new PanelGroupRepository();
        }
        return self::$panelGroupRepository;
    }

    /**@return IPanelRepository<Panel> */
    public static function PanelRepository() : IPanelRepository
    {
        if (self::$panelRepository == null){
            self::$panelRepository = new PanelRepository();
        }
        return self::$panelRepository;
    }





    //// =============================================
    //// public
    //// =============================================

    /**@var ISettingRepository<Setting> $settingRepository*/
    private static $settingRepository;


    /**@return ISettingRepository<Setting> */
    public static function SettingRepository() : ISettingRepository
    {
        if (self::$settingRepository == null){
            self::$settingRepository = new SettingRepository();
        }
        return self::$settingRepository;
    }





    //// =============================================
    //// users
    //// =============================================
    /**@var IUserRepository<User> $userRepository*/
    private static $userRepository;


    /**@var IOtpRepository<Otp> $otpRepository*/
    private static $otpRepository;


    /**@return IUserRepository<User>>*/
    public static function UserRepository() : IUserRepository
    {
        if (self::$userRepository == null){
            self::$userRepository = new UserRepository();
        }
        return self::$userRepository;
    }



    /**@return IOtpRepository<Otp>*/
    public static function OtpRepository() : IOtpRepository
    {
        if (self::$otpRepository == null){
            self::$otpRepository = new OtpRepository();
        }
        return self::$otpRepository;
    }





    //// =============================================
    //// orders
    //// =============================================
    /**@var IOrderRepository<Order> $orderRepository*/
    private static $orderRepository;

    /**@var IOrderBasketRepository<OrderBasket> $orderBasketRepository*/
    private static $orderBasketRepository;

    /**@return IOrderRepository<Order>*/
    public static function OrderRepository() : IOrderRepository
    {
        if (self::$orderRepository == null){
            self::$orderRepository = new OrderRepository();
        }
        return self::$orderRepository;
    }

    /**@return IOrderBasketRepository<OrderBasket>*/
    public static function OrderBasketRepository() : IOrderBasketRepository
    {
        if (self::$orderBasketRepository == null){
            self::$orderBasketRepository = new OrderBasketRepository();
        }
        return self::$orderBasketRepository;
    }


    //// =============================================
    //// Banks
    //// =============================================
    /**@var IBanckRepository<Bank> $bankRepository*/
    private static $bankRepository;

    /**@var IBankPaymentRepository<BankPayment> $bankPaymentRepository*/
    private static $bankPaymentRepository;

    /**@var IBankPaymentRefundRepository<BankPaymentRefund> $bankPaymentRefoundRepository*/
    private static $bankPaymentRefoundRepository;

    /**@var IBankPaymentUnVerifyRepository<BankPaymentUnVerify> $bankPaymentUnVerifyRepository*/
    private static $bankPaymentUnVerifyRepository;


    /**@return IBanckRepository<Bank>*/
    public static function BankRepository() : IBanckRepository
    {
        if (self::$bankRepository == null){
            self::$bankRepository = new BankRepository();
        }
        return self::$bankRepository;
    }

    /**@return IBankPaymentRepository<BankPayment>*/
    public static function BankPaymentRepository() : IBankPaymentRepository
    {
        if (self::$bankPaymentRepository == null){
            self::$bankPaymentRepository = new BankPaymentRepository();
        }
        return self::$bankPaymentRepository;
    }

    /**@return IBankPaymentRefundRepository<BankPaymentRefund> */
    public static function BankPaymentRefundRepository() : IBankPaymentRefundRepository
    {
        if (self::$bankPaymentRefoundRepository == null){
            self::$bankPaymentRefoundRepository = new BankPaymentRefundRepository();
        }
        return self::$bankPaymentRefoundRepository;
    }

    /**@return IBankPaymentUnVerifyRepository<BankPaymentUnVerify> */
    public static function BankPaymentUnVerifyRepository() : IBankPaymentUnVerifyRepository
    {
        if (self::$bankPaymentUnVerifyRepository == null){
            self::$bankPaymentUnVerifyRepository = new BankPaymentUnVerifyRepository();
        }
        return self::$bankPaymentUnVerifyRepository;
    }




    //// =============================================
    //// subscribes
    //// =============================================
    /**@var ISubscribeRepository<Subscribe> $subscribeRepository*/
    private static $subscribeRepository;

    /**@var ISubscribePaymentRepository<SubscribePayment> $subscribePaymentRepository*/
    private static $subscribePaymentRepository;

    /**@return ISubscribeRepository<Subscribe>*/
    public static function SubscribeRepository() : ISubscribeRepository
    {
        if (self::$subscribeRepository == null){
            self::$subscribeRepository = new SubscribeRepository();
        }
        return self::$subscribeRepository;
    }

    /**@return ISubscribePaymentRepository<SubscribePayment>*/
    public static function SubscribePaymentRepository() : ISubscribePaymentRepository
    {
        if (self::$subscribePaymentRepository == null){
            self::$subscribePaymentRepository = new SubscribePaymentRepository();
        }
        return self::$subscribePaymentRepository;
    }




    //// =============================================
    //// offs
    //// =============================================
    /**@var ICodeOffStatusRepository<CodeOffStatus> $codeOffStatusRepository*/
    private static $codeOffStatusRepository;

    /**@var ICodeOffRepository<CodeOff> $codeOffRepository*/
    private static $codeOffRepository;


    /**@return ICodeOffStatusRepository<CodeOffStatus>*/
    public static function CodeOffStatusRepository() : ICodeOffStatusRepository
    {
        if (self::$codeOffStatusRepository == null){
            self::$codeOffStatusRepository = new CodeOffStatusRepository();
        }
        return self::$codeOffStatusRepository;
    }

    /**@return ICodeOffRepository<CodeOff>*/
    public static function CodeOffRepository() : ICodeOffRepository
    {
        if (self::$codeOffRepository == null){
            self::$codeOffRepository = new CodeOffRepository();
        }
        return self::$codeOffRepository;
    }




}
