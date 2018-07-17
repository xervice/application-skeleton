<?php


namespace App\Console;


use Xervice\Console\ConsoleDependencyProvider as XerviceConsoleDependencyProvider;
use Xervice\Database\Command\ConfigGenerateCommand;
use Xervice\Database\Command\MigrateCommand;
use Xervice\Database\Command\ModelBuildCommand;
use Xervice\DataProvider\Console\GenerateCommand;
use Xervice\Development\Command\GenerateAutoCompleteCommand;
use Xervice\Development\Generator\AutoCompleteGenerator;

class ConsoleDependencyProvider extends XerviceConsoleDependencyProvider
{
    /**
     * @return array
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    protected function getCommandList(): array
    {
        return array_merge(
            [
                new GenerateCommand(),
                new MigrateCommand(),
                new ModelBuildCommand(),
                new ConfigGenerateCommand()
            ],
            $this->getDevCommands()
        );
    }

    /**
     * @return array
     * @throws \Symfony\Component\Console\Exception\LogicException
     */
    protected function getDevCommands(): array
    {
        if (class_exists(GenerateAutoCompleteCommand::class)) {
            return [
                new GenerateAutoCompleteCommand()
            ];
        }

        return [];
    }

}