<?php


declare(strict_types=1);

namespace App\Common\Commands;

use App\Domain\Admin\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class CreateUserCommand extends Command
{
    public const FIELDS_TO_CREATE_ACCOUNT = [
        'email' => null,
        'firstname' => null,
        'lastname' => null,
        'password' => 'hidden',
    ];

    public const AVAILABLE_ROLES = [
        'ROLE_ADMIN',
    ];

    /**
     * @var EntityManagerInterface
     */
    private $emn;

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    public function __construct(EntityManagerInterface $emn, EncoderFactoryInterface $encoder, ?string $name = null)
    {
        $this->emn = $emn;
        $this->encoderFactory = $encoder;
        parent::__construct($name);
    }

    /**
     * Configure command.
     */
    protected function configure()
    {
        $this
            ->setName('app:create:user')
            ->setDescription('Allow to create an account to access admin');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|void|null
     *
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $results = [];

        foreach (self::FIELDS_TO_CREATE_ACCOUNT as $field => $value) {
            $question = new Question(sprintf('Sélectionnez un %s:', $field));
            if ('hidden' === $value) {
                $question->setHidden(true);
            }
            $results[$field] = $this->getHelperQuestion()->ask($input, $output, $question);
        }
        $helper = $this->getHelper('question');
        $question = new ChoiceQuestion(
            'Choisir un rôle pour l\'utilisateur',
            self::AVAILABLE_ROLES,
            0
        );
        $role = $helper->ask($input, $output, $question);

        $encoder = $this->encoderFactory->getEncoder(User::class);

        $user = new User(
            $results['email'],
            $results['firstname'],
            $results['lastname'],
            $encoder->encodePassword($results['password'], ''),
            [$role]
        );

        $this->emn->persist($user);
        $this->emn->flush();

        return 0;
    }

    /**
     * @return mixed
     */
    private function getHelperQuestion()
    {
        return $this->getHelper('question');
    }
}
