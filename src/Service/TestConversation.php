<?php

namespace App\Service;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\IncomingMessage;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Service\OptionsService;
use App\Traits\ContainerAwareConversationTrait;

/**
 * Class TestConversation
 */
class TestConversation extends Conversation {
    
    use ContainerAwareConversationTrait;

    protected $firstname;
    protected $testItem;
    protected $address;

    public function run() {

        $this->ask (
            'Hello! What is your first name?',
            function (Answer $answer) {
                $this->firstname = $answer->getText();
                $this->say('Nice to meet you ' . $this->firstname);
                $this->nextDialog();
            }
        );
    }

    public function nextDialog()
    {
        $testItems = $this->getContainer()->get(OptionsService::class)->getTestItems();

        $buttons = [];

        foreach ($testItems as $item)
        {
            $buttons[] = Button::create($item->getSpecies())->value($item->getId());
        }

        $question = Question::create('What animal do you want?');
        $question->addButtons(
            $buttons
        );
        $this->ask(
            $question,
            function ($answer) {
                $this->testItem = $answer->getText();
                $this->askAddress();
            }
        );
    }

    public function askAddress() {
        $this->say('Chosen animal id: '.$this->testItem);
    }

}
