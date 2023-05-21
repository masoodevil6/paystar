<?php
namespace App\Repositories\InterFaceRepositories\Panels;

use App\Models\Panel\Admin;
use App\Repositories\InterFaceRepositories\IBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IAdminUserRepository extends IBaseRepository {

    /**
     * @return  T
     */
    function getLoginClientToPanelAdmin();

    /**
     * @return  void
     */
    function LoginUserAdmin(int $id);

    /**
     * @return  T
     */
    function GetUserAdminAuth();

    /**
     * @return  int
     */
    function GetUserIdAdminAuth();

    /**
     * @return  Admin
     */
    function GetPanelUserAdminAuth($adminUser);

    /**
     * @return  string
     */
    function GetEmailAdminAuth($password);


    /**
     * @return  void
     */
    function LogoutAuthAdminPanel();

    /**
     * @return  LengthAwarePaginator
     */
    function SearchAdminUser($userName ="" , $userEmail="" , $panelSearcher = 0, $numInPage = 15);

    /**
     * @return  array
     */
    function SearchPanelAdmin(string $panelName="");
}
