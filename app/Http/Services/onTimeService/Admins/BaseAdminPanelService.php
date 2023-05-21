<?php
namespace App\Http\Services\onTimeService\Admins;

use Illuminate\Support\Facades\Config;
use function Symfony\Component\Uid\Factory\getNamespace;

class BaseAdminPanelService
{

    private $panelGroupName = "";
    private $panelIcon = "";
    private $panelName = "";
    private $panelLink = "";



    protected function getPanelGroupName(): string
    {
        return $this->panelGroupName;
    }

    protected function setPanelGroupName(): void
    {
        foreach (Config::get("adminPanel.panels") as $panel){
            if ($panel["panel_class"] == $this::class){
                $this->panelGroupName = $panel["group_name"];
                break;
            }
        }
    }



    protected function getPanelIcon(): string
    {
        return $this->panelIcon;
    }

    protected function setPanelIcon(string $panelIcon): void
    {
        $this->panelIcon = $panelIcon;
    }




    protected function getPanelName(): string
    {
        return $this->panelName;
    }

    protected function setPanelName(string $panelName): void
    {
        $this->panelName = $panelName;
    }



    protected function getPanelLink(): string
    {
        return $this->panelLink;
    }

    protected function setPanelLink(string $panelLink): void
    {
        $this->panelLink = $panelLink;
    }




}
