<?php

namespace App\Service;

use App\Controller\IndexController;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Service\OptionsService;
use App\Traits\ContainerAwareConversationTrait;

/**
 * Class TestConversation
 * @property  startConversation
 */
class WelcomeConversation extends Conversation
{

    use ContainerAwareConversationTrait;

    protected $species;
    protected $kind;
    protected $size;
    protected $sex;
    protected $price;
    protected $name;
    protected $surname;
    protected $street;
    protected $city;
    protected $postal;

    public function run()
    {
        //   $this->ask('Select one of above');
        $question = Question::create('Select one of above')
            ->addButtons([
                Button::create('Browse')->value('startBrowse'),
                Button::create('Random')->value('startRandom'),
                Button::create('Quit')->value('startQuit'),
            ]);

        $this->ask($question, function (Answer $answer) {
            // Detect if button was clicked:
            if ($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }

            switch ($answer) {
                case 'startBrowse':
                    $this->runBrowse();
                    break;

                case 'startRandom':
                    $this->runRandom();
                    break;

                case 'startQuit':
                    $this->runQuit();
                    break;
            }
        });
    }


    public function runBrowse()
    {
        // $this->say('runBrowse executed');
        $question = Question::create('What pet would you prefer?')
            ->addButtons([
                Button::create('Dog')->value('dog'),
                Button::create('Cat')->value('cat'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }

            if ($answer == 'dog') {
                $this->species = $answer;
                $this->selectDogKind();
            } else {
                $this->species = $answer;
                $this->selectCatKind();
            }
        });
    }

    public function runRandom()
    {
        $this->say('runRandom executed');
    }

    public function runQuit()
    {
        $this->say('Service stopped');
    }

    public function selectDogKind()
    {
        $this->say('selectDogKind executed..');
    }

    public function selectCatKind()
    {
        $this->say('selectCatKind executed..');
    }
}
