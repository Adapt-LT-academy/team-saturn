<?php

namespace App\Service;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Traits\ContainerAwareConversationTrait;

/**
 * Class TestConversation
 * @property  startConversation
 */
class PetOrder extends Conversation
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

    public function run()
    {
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
        $this->say(' ');
    }

    /**
     *
     */
    public function runQuit()
    {
        $question = Question::create('Would you like start another order?')
            ->addButtons([
                Button::create('Yes')->value('yes'),
                Button::create('No')->value('no'),
            ]);

        $this->ask(/**
         * @param Answer $answer
         */
            $question, function (Answer $answer) {
            if($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }
            if($answer == 'yes')
            {
                $this->run();
            } else
            {
                $this->say('Order procedure stoped. Type "hi" to start over again');
            }
        });

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
                    $this->selectSize();
                    break;
                case 'begle':
                    $this->kind = $answer;
                    $this->selectSize();
                    break;
                case 'poodle':
                    $this->kind = $answer;
                    $this->selectSize();
                    break;
                case 'chihuahua':
                    $this->kind = $answer;
                    $this->selectSize();
                    break;
                case 'dobermann':
                    $this->kind = $answer;
                    $this->selectSize();
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
                    $this->selectSize();
                    break;
                case 'sphynx':
                    $this->kind = $answer;
                    $this->selectSize();
                    break;
                case 'bengal':
                    $this->kind = $answer;
                    $this->selectSize();
                    break;
                case 'siberian':
                    $this->kind = $answer;
                    $this->selectSize();
                    break;
                case 'chartreux':
                    $this->kind = $answer;
                    $this->selectSize();
                    break;
                case 'startQuit':
                    $this->runQuit();
                    break;
            }
        });
    }

    public function selectSize()
    {
        $question = Question::create('Please select age range')
            ->addButtons([
                Button::create('Less than a year')->value('year'),
                Button::create('One to five years')->value('5years'),
                Button::create('More than five years')->value('5+years'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->size = $answer->getValue();

            }

        });
        $this->selectGender();
    }

    public function selectGender()
    {
        $question = Question::create('Please select gender')
            ->addButtons([
                Button::create('Male')->value('male'),
                Button::create('Female')->value('female'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->size = $answer->getValue();
                $this->askName();
            }

        });

    }

    public function askName()
    {
        $this->ask('Whats is your first name?', function (Answer $response) {
        $this->name = $response->getText();
        $this->askSurname();
    });
    }

    public function askSurname()
    {
        $this->ask('Great, and your last name?', function (Answer $response) {
           $this->name = $response->getText();
           $this->askStreet();
        });
    }

    public function askStreet()
    {
        $this->ask('Got it! Now we need a location. Let start with street name.', function (Answer $response) {
            $this->name = $response->getText();
            $this->askAppartmentNumber();
        });
    }

    public function askAppartmentNumber()
    {
        $this->ask('Now enter apartment number.', function (Answer $response) {
            $this->name = $response->getText();
            $this->askCity();
        });
    }

    public function askCity()
    {
        $this->ask('Oh and city?', function (Answer $response) {
            $this->name = $response->getText();
            $this->customerDataValidation();
        });
    }

    public function customerDataValidation() {
        $this->say('Got it. Please check collected data before going further.');
    }
}
