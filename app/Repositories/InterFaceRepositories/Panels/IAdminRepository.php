<?php

namespace App\Repositories\InterFaceRepositories\Panels;

use App\Models\Panel\Admin;
use App\Repositories\InterFaceRepositories\IBaseRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

/**
 * @template T
 * @template-extends IBaseRepository<T>
 */
interface IAdminRepository extends IBaseRepository {

    /**
     * @return  T
     */
    function getListAdminMain(int $pw);

    /**
     * @return  Collection<T>
     */
    function getLastAdminMain(int $pw);

    /**
     * @return  void
     */
    function AdminAttachPanel(Admin $admin , int $panelId);

    /**
     * @return  array
     */
    function AdminAttachUser(Admin $admin , int $userId , string $password);

    /**
     * @return  array
     */
    function SyncPanelForAdminPanel(Admin $admin , array $data);

    /**
     * @return  LengthAwarePaginator
     */
    function SearchAdminPanel(string $panelName ,$numInPage = 15);

}
