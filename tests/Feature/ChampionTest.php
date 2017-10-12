<?php
namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Src\Kody\Lol\Champion;
class ChampionTest extends TestCase
{
	protected static $champion;
    protected function setUp(){
        parent::setUp();
        self::$champion = new Champion();
    }

    protected function tearDown(){
        self::$champion = null;
        parent::tearDown();
    }
    public function testSend(){
    	$key = self::$champion ->whereRegion('na1')
    					->whereChampionId(86)
    					->withTag('all')
    					->send();
        //$this->assertEquals(86, $key);
    	$this->assertEquals(86, self::$champion->getId());
    	$this->assertEquals('Garen', self::$champion->getKey());
    	$this->assertEquals('Garen', self::$champion->getName());
    	$this->assertEquals('The Might of Demacia', self::$champion->getTitle());
    	$passive = self::$champion->getPassive();
    	$this->assertEquals('Perseverance', $passive->getName());
		$this->assertEquals('If Garen has not recently been struck by damage or enemy abilities, he regenerates a percentage of his total health each second. Minion damage does not stop Perseverance.', $passive->getDescription());

    	$this->assertTrue(count(self::$champion->getSpells())==4);

    	$spellQ = self::$champion->getSpells()[0];
    	$this->assertEquals('Decisive Strike', $spellQ->getName());
		$this->assertEquals('Garen breaks free from all slows affecting him, and gains 30% movement speed for 1.5/2/2.5/3/3.5 seconds.<br><br>His next basic attack within 4.5 seconds deals 30/55/80/105/130 <span class="colorFF8C00">(+)</span> physical damage and silences his target for 1.5 seconds.', $spellQ->getToolTip());
		$this->assertEquals('physicalDamage ', $spellQ->getDemageType());
    	$this->assertEquals('Courage', self::$champion->getSpells()[1]->getName());
    	$this->assertEquals('Judgment', self::$champion->getSpells()[2]->getName());
    	$this->assertEquals('Demacian Justice', self::$champion->getSpells()[3]->getName());
    }
}
