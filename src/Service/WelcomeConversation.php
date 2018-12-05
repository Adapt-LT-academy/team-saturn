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
                Button::create('Quit')->value('startQuit'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }

            if ($answer == 'dog') {
                $this->selectDogKind();
            //    return $this->species = $answer;
            } else if ($answer == 'cat') {
                $this->species = $answer;
                $this->selectCatKind();
            //    return $this->species = $answer;
            } else {
                $this->runQuit();
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
        $question = Question::create('Please select dog kind')
            ->addButtons([
                Button::create('Bulldog')->value('bulldog'),
                Button::create('Beagle')->value('begle'),
                Button::create('Poodle')->value('poodle'),
                Button::create('Chihuahua')->value('chihuahua'),
                Button::create('Dobermann')->value('dobermann'),
                Button::create('Quit')->value('startQuit'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }

            switch ($answer) {
                case 'bulldog':
                    $this->kind = $answer;
                    $this->additionalInfo();
                    break;
                case 'begle':
                    $this->kind = $answer;
                    $this->additionalInfo();
                    break;
                case 'poodle':
                    $this->kind = $answer;
                    $this->additionalInfo();
                    break;
                case 'chihuahua':
                    $this->kind = $answer;
                    $this->additionalInfo();
                    break;
                case 'dobermann':
                    $this->kind = $answer;
                    $this->additionalInfo();
                    break;
                case 'startQuit':
                    $this->runQuit();
                    break;
            }
        });
    }

    public function selectCatKind()
    {
        $question = Question::create('Please select cat kind')
            ->addButtons([
                Button::create('Ragdoll')->value('ragdoll'),
                Button::create('Sphynx')->value('sphynx'),
                Button::create('Bengal')->value('bengal'),
                Button::create('Siberian')->value('siberian'),
                Button::create('Chartreux')->value('chartreux'),
                Button::create('Quit')->value('startQuit'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }

            switch ($answer) {
                case 'ragdoll':
                    $this->kind = $answer;
                    $this->additionalInfo();
                    break;
                case 'sphynx':
                    $this->kind = $answer;
                    $this->additionalInfo();
                    break;
                case 'bengal':
                    $this->kind = $answer;
                    $this->additionalInfo();
                    break;
                case 'siberian':
                    $this->kind = $answer;
                    $this->additionalInfo();
                    break;
                case 'chartreux':
                    $this->kind = $answer;
                    $this->additionalInfo();
                    break;
                case 'startQuit':
                    $this->additionalInfo();
                    break;
            }
        });
    }

    public function additionalInfo()
    {
        $question = Question::create('What pet would you prefer?')
            ->addButtons([
                Button::create('Dog')->value('dog'),
                Button::create('Cat')->value('cat'),
                Button::create('Quit')->value('startQuit'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }

            if ($answer == 'dog') {
                $this->selectDogKind();
                //    return $this->species = $answer;
            } else if ($answer == 'cat') {
                $this->species = $answer;
                $this->selectCatKind();
                //    return $this->species = $answer;
            } else {
                $this->runQuit();
            }
        });
    }
}
