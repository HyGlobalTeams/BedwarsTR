<?php

/////////////////////////////////////

///// I N D E V E L O P M E N T/////

/////////////////////////////////////

namespace BedwarsTR;

use pocketmine\plugin\PluginBase;

use pocketmine\event\Listener;

use pocketmine\command\Command;

use pocketmine\command\CommandSender;

use pocketmine\event\player\PlayerDeathEvent;

use pocketmine\event\player\PlayerRespawnEvent;

use pocketmine\event\player\PlayerDamageEvent;

use pocketmine\scheduler\CallbackTask;

use pocketmine\scheduler\PluginTask;

use pockrtmine\event\block\BlockBreakEvent;

use pocketmine\event\block\BlockPlaceEvent;

use pocketmine\plugin;

use pocketmine\player;

use pocketmine\level\Level;

use pocketmine\level\Position;

use pocketmine\math\Vector3;

use pocketmine\command\ConsoleCommandSender;

use pocketmine\level\sound\ClickSound;

use pocketmine\level\sound\PopSound;

use pocketmine\level\sound\FizzSound;

use pocketmine\level\particle\DustParticle;

use pocketmine\level\particle\PortalParticle;

use pocketmine\utils\Config;

use pocketmine\utils\TextFormat as Renk;

class Bedwars extends PluginBase implements Listener{

public $kteam = array();

public $mteam = array();

public $steam = array();

public $yteam = array();

public $prefix = Renk::DARK_GRAY . "[" . Renk::RED . "Bed" . Renk::DARK_RED . "Wars" . Renk::WHITE . "TR" . Renk::DARK_GRAY . "]" . Renk::GRAY;

public function onEnable(){

$this->getLogger()->info("§8[§cBed§4Wars§8]§a Plugin Enabled!");

$this->getScheduler()->schedulerRepeatingTask(new CallbackTask([$this,"lobbysan"]),20);

@mkdir($this->getDataFolder(), 0777, true);

$this->config=new Config($this->getDataFolder() . "config.yml", Config::YAML, array());

$this->saniye=0;

$this->players = array();

if(!$this->config->exists("bwlobby")){

$this->config->set("bwlobby","bw");

}

if(!$this->config->exists("zaman")){

$this->config->set("zaman","60");

}

//ve fazlası eklenebilir

}

public function OnDisable(){

$this->getLogger()->info("§8[§cBed§4Wars§8]§c Plugin Deaktifleştirildi");

$this->getScheduler()->getschedulerRepeatingTask(new CallbackTask([$this,"lobbysan"]),20);

$this->config->save();

}

public function onCommand(CommandSender $sender, Command $cmd, $label, array $args){

switch($cmd->getName()){

case "bw":

$sender->sendMessage("§6=== §fTüm Komutlar§6 ===");

$sender->sendMessage("§a - §e/§6bw başlat §b:§f Oyunu Başlatır (Adminler İçin)");

$sender->sendMessage("§a- §e/§6bw katıl §b:§f BedWarsa Katılınılır.");

$sender->sendMessage(TextFormat::GOLD."/bw :" .TextFormat::YELLOW. "Lobbye İsinlar.");

$sender->sendMessage("§6©===========================©");

break;

case "başlat":

$this->saniye=10;

$this->lobbysan;

case "katıl":

$this->lobbysan;

$this->saniye=60;

break;

}

}

public function lobbysan(){

$this->saniye--;

switch($this->saniye){

case 1:

case 2:

case 3:

case 4:

case 5:

case 6:

case 7:

case 8:

case 9:

case 10:

$this->sendMessage($this->prefix . Renk::GOLD . "Oyunun Başlamasına " . Renk::YELLOW . $this->saniye . Renk::GOLD . " saniye" . Renk::YELLOW . "...");

//$p->getLevel()->addSound(new ClickSound($p)); Yakinda!

//$p->getLevel()->addParticle(new DustParticle(new Position($p))); Yakinda!

break;

case 30:

$this->sendMessage($this->prefix . Renk::GOLD . "Oyunun Başlamasına" . Renk::YELLOW . "30" . Renk::GOLD . "saniye");

break;

case 60:

$this->sendMessage($this->prefix . Renk::GOLD . "Oyunun Başlamasına" . Renk::YELLOW . "1" . Renk::GOLD . "dakika");

break;

case 0:

$this->sendMessage($this->prefix . Renk::GOLD . "Oyunun Başladı! Yatağını Kapatmaya Başla!");

//$p->teleport(new Vector3(0,0,0)); Yakinda!

}

}

public function sendMessage($msg){

//Mesajlar sadece Consolda Gozukucektir!!! [SİMDİLİK]

$this->getServer()->getLogger()->info($msg);

}

}

?>
