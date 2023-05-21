<?php
namespace App\Repositories\ModelRepositories\Panels;

use App\Models\Panel\Admin;
use App\Repositories\InterFaceRepositories\Panels\IAdminRepository;
use App\Repositories\ModelRepositories\BaseRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @template-extends BaseRepository<Admin>
 * @template-implements  IAdminRepository<Admin>
 */
class AdminRepository extends BaseRepository implements IAdminRepository {

    public function __construct()
    {
        parent::__construct(new Admin());
    }

    /**
     * @inheritDoc
     */
    public function getLastAdminMain(int $pw)
    {
        return $this->model::where("main" , $pw)->orderBy("id" , "desc")->first();
    }

    /**
     * @inheritDoc
     */
    public function getListAdminMain(int $pw)
    {
        return  $this->model::where("main" , $pw)->get();
    }

    /**
     * @inheritDoc
     */
    public function AdminAttachPanel(Admin $admin ,int $panelId): void
    {
        $admin->panels()->attach($panelId);
    }

    /**
     * @inheritDoc
     */
    public function AdminAttachUser(Admin $admin, int $userId, string $password): void
    {
        $admin->users()->sync([$userId => ["status" => 1 , "password" => Hash::make($password)]]);
    }

    /**
     * @inheritDoc
     */
    function SyncPanelForAdminPanel(Admin $admin, array $data)
    {
        $admin->panels()->sync($data);
    }

    /**
     * @inheritDoc
     */
    function SearchAdminPanel(string $panelName, $numInPage = 15)
    {
        if ($panelName != ""){
            $this->model = $this->addSearcher("title" , $panelName);
        }

        return $this->model->paginate($numInPage);
    }
}
