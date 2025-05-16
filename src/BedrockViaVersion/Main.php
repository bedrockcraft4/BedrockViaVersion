<?php

namespace BedrockViaVersion;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\player\Player;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getLogger()->info("BedrockViaVersion plugin enabled!");
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onPlayerPreLogin(PlayerPreLoginEvent $event): void {
        $playerInfo = $event->getPlayerInfo();
        $protocol = $playerInfo->getProtocolVersion();

        $this->getLogger()->info("{$playerInfo->getUsername()} joined with protocol: {$protocol}");

        // Accept only 1.21.50–1.21.80 (example: 639–641)
        if ($protocol < 639 || $protocol > 641) {
            $event->setKickReason(PlayerPreLoginEvent::KICK_REASON_SERVER_ERROR, "Only versions 1.21.50 to 1.21.80 are supported.");
        }
    }
}
