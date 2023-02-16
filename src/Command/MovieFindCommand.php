<?php

namespace App\Command;

use App\Consumer\OmdbApiConsumer;
use App\Entity\Movie;
use App\Provider\MovieProvider;
use App\Repository\MovieRepository;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

#[AsCommand(
    name: 'app:movie:find',
    description: 'Add a short description for your command',
)]
class MovieFindCommand extends Command
{
    public function __construct(
        protected MovieProvider $provider,
        protected MovieRepository $repository
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('value', InputArgument::OPTIONAL, 'The movie\'s title or Imdb ID')
            ->addArgument('type', InputArgument::OPTIONAL, 'The type of the searched value (title or id)')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->io = $io = new SymfonyStyle($input, $output);
        $this->provider->setIo($io);

        $value = $input->getArgument('value');
        if (!$value) {
            $value = $io->ask('What is the title or Imdb ID or the movie you wish to import?');
        }

        $type = $input->getArgument('type');
        if (\in_array($type, ['title', 'id'])) {
            $type = substr($type, 0, 1);
        }
        if (!\in_array($type, [OmdbApiConsumer::MODE_ID, OmdbApiConsumer::MODE_ID])) {
            $type = $io->choice('What is the type of the value you entered?', ['i' => 'id', 't' => 'title']);
        }

        $io->section(sprintf("You are searching for a movie with a %s of \"%s\"", $type, $value));
        if ($type === OmdbApiConsumer::MODE_ID) {
            $movie = $this->repository->findOneBy(['imdbId' => $value]);
            if ($movie) {
                $io->note('Movie already in database!');
                $this->displayResult($movie);

                return Command::SUCCESS;
            }
        }

        try {
            $method = $type === OmdbApiConsumer::MODE_ID ? 'getMovieById' : 'getMovieByTitle';
            $movie = $this->provider->$method($value);
        } catch (NotFoundHttpException $e) {
            $io->error('Movie not found!');

            return Command::FAILURE;
        }

        $this->displayResult($movie);

        return Command::SUCCESS;
    }

    private function displayResult(Movie $movie)
    {
        $this->io->table(['Id', 'Imdb ID', 'Title', 'Rated'], [
            [$movie->getId(), $movie->getImdbId(), $movie->getTitle(), $movie->getRated()]
        ]);

        $this->io->success('Success!');
    }
}
