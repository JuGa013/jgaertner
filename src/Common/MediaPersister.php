<?php

/**
 * © Infostrates
 * Par Julien
 * Le 29/05/2020
 */

declare(strict_types=1);

namespace App\Common;

use App\Domain\Whoami\Entities\Person;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

final class MediaPersister
{
    private const PERSON_AVATAR_PATH = 'uploads/persons/';

    private Filesystem $filesystem;

    private string $storageFolder;

    public function __construct(Filesystem $filesystem, string $webRootDir)
    {
        $this->filesystem = $filesystem;
        $this->storageFolder = $webRootDir;
    }

    public function getPersonImage(Person $person): ?File
    {
        $storageFolder = $this->storageFolder . self::PERSON_AVATAR_PATH;
        if (!$this->filesystem->exists($storageFolder)) {
            return null;
        }
        $scandir = scandir($storageFolder);
        if (!$scandir) {
            return null;
        }
        foreach (array_slice($scandir, 2) as $row) {
            $filename = pathinfo($row, PATHINFO_FILENAME);
            if ($filename === $person->id) {
                return new File(self::PERSON_AVATAR_PATH . $row);
            }
        }

        return null;
    }

    public function storePersonImage(Person $person, File $file)
    {
        $this->storageFolder = $this->storageFolder . self::PERSON_AVATAR_PATH;
        $this->filesystem->mkdir($this->storageFolder);
        $this->upload($file, $person->id . '.' . $file->guessExtension());
    }

    public function upload(File $file, ?string $filename = null): string
    {
        $filename = $filename ?? $file->getClientOriginalName();
        $file->move($this->storageFolder, $filename);

        return (string) $filename;
    }
}
