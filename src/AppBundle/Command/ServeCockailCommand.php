<?php

namespace AppBundle\Command;

use AppBundle\Entity\Cocktail;
use AppBundle\Handler\CocktailHandler;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ServeCockailCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:serve:cockail')
            ->setAliases(['bwaaar'])
            ->setDescription('Se servir un cocktail')
            ->addArgument('id', InputArgument::OPTIONAL, 'Id du cocktail à servir', false)
            ->addOption('name', null, InputOption::VALUE_REQUIRED, 'Nom du cocktail')
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cocktailRepository = $this
            ->getContainer()
            ->get('doctrine')
            ->getRepository(Cocktail::class);

        if ($cocktailId = $input->getArgument('id')) {
            $cocktail = $cocktailRepository->find($cocktailId);
        }

        if ($cocktailId === false) {
            $cocktail = $cocktailRepository->findOneBy(['name' => $input->getOption('name')]);
        }

        $io = new SymfonyStyle($input, $output);
        if (!isset($cocktail) || !$cocktail) {
            $io->error('Cocktail non trouvé');
            return;
        }

        $io->title(sprintf('Préparation du cocktail "%s" en cours...', $cocktail->getName()));

        $progressBar = $io->createProgressBar();
        $progressBar->start();

        $cocktailHandler = $this->getContainer()->get('cocktail_handler');
        $cocktailHandler->setProgressBar($progressBar);

        $response = $cocktailHandler->serveCocktail($cocktail->getDoses());

        $progressBar->finish();
        $io->newLine(2);

        $result = json_decode($response->getContent());
        if ($result->success) {
            $io->success('Cocktail terminé !');
        } else {
            $io->error($result->message);
        }
    }
}
