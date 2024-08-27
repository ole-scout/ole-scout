<?php

namespace App\Filesystem;

use Composer\Downloader\FilesystemException;
use Illuminate\Http\Testing\MimeType;
use League\Flysystem\Config;
use League\Flysystem\FileAttributes;
use League\Flysystem\FilesystemAdapter;
use League\Flysystem\StorageAttributes;
use League\Flysystem\UnableToCheckExistence;
use League\Flysystem\UnableToCopyFile;
use League\Flysystem\UnableToCreateDirectory;
use League\Flysystem\UnableToDeleteDirectory;
use League\Flysystem\UnableToMoveFile;
use League\Flysystem\UnableToSetVisibility;

class FakeAdapter implements FilesystemAdapter
{
    /**
     * @throws FilesystemException
     * @throws UnableToCheckExistence
     */
    public function fileExists(string $path): bool
    {
        return true;
    }

    /**
     * @throws FilesystemException
     * @throws UnableToCheckExistence
     */
    public function directoryExists(string $path): bool
    {
        throw new FilesystemException('Adapter does not support directory operations.');
    }

    /**
     * @throws UnableToWriteFile
     * @throws FilesystemException
     */
    public function write(string $path, string $contents, Config $config): void
    {
        //
    }

    /**
     * @param resource $contents
     *
     * @throws UnableToWriteFile
     * @throws FilesystemException
     */
    public function writeStream(string $path, $contents, Config $config): void
    {
        $this->write($path, stream_get_contents($contents), $config);
    }

    /**
     * @throws UnableToReadFile
     * @throws FilesystemException
     */
    public function read(string $path): string
    {
        return $path;
    }

    /**
     * @return resource
     *
     * @throws UnableToReadFile
     * @throws FilesystemException
     */
    public function readStream(string $path)
    {
        $stream = fopen('php://temp', 'r+');
        fwrite($stream, $this->read($path));
        rewind($stream);
        return $stream;
    }

    /**
     * @throws UnableToDeleteFile
     * @throws FilesystemException
     */
    public function delete(string $path): void
    {
        //
    }

    /**
     * @throws UnableToDeleteDirectory
     * @throws FilesystemException
     */
    public function deleteDirectory(string $path): void
    {
        //
    }

    /**
     * @throws UnableToCreateDirectory
     * @throws FilesystemException
     */
    public function createDirectory(string $path, Config $config): void
    {
        throw new FilesystemException('Adapter does not support directory operations.');
    }

    /**
     * @throws InvalidVisibilityProvided
     * @throws FilesystemException
     */
    public function setVisibility(string $path, string $visibility): void
    {
        throw UnableToSetVisibility::atLocation($path, 'Adapter does not support visibility controls.');
    }

    /**
     * @throws UnableToRetrieveMetadata
     * @throws FilesystemException
     */
    public function visibility(string $path): FileAttributes
    {
        return new FileAttributes($path);
    }

    /**
     * @throws UnableToRetrieveMetadata
     * @throws FilesystemException
     */
    public function mimeType(string $path): FileAttributes
    {
        $matches = preg_match('/^data:([^;]+);base64/', $path);
        if ($matches) return $matches[0];
        return new FileAttributes($path, mimeType: MimeType::from($path));
    }

    /**
     * @throws UnableToRetrieveMetadata
     * @throws FilesystemException
     */
    public function lastModified(string $path): FileAttributes
    {
        return new FileAttributes($path, lastModified: time());
    }

    /**
     * @throws UnableToRetrieveMetadata
     * @throws FilesystemException
     */
    public function fileSize(string $path): FileAttributes
    {
        $matches = preg_match('/^data:[^;]+;base64,(.+)$/', $path);
        if ($matches) return strlen(base64_decode($matches[0]));
        return new FileAttributes($path, fileSize: strlen($path));
    }

    /**
     * @return iterable<StorageAttributes>
     *
     * @throws FilesystemException
     */
    public function listContents(string $path, bool $deep): iterable
    {
        throw new FilesystemException('Adapter does not support directory operations.');
    }

    /**
     * @throws UnableToMoveFile
     * @throws FilesystemException
     */
    public function move(string $source, string $destination, Config $config): void
    {
        throw UnableToMoveFile::because(
            'Adapter does not support directory operations.',
            sourcePath: $source,
            destinationPath: $destination,
        );
    }

    /**
     * @throws UnableToCopyFile
     * @throws FilesystemException
     */
    public function copy(string $source, string $destination, Config $config): void
    {
        throw UnableToCopyFile::because(
            'Adapter does not support directory operations.',
            sourcePath: $source,
            destinationPath: $destination,
        );
    }

    public function getUrl(string $path): string
    {
        return $path;
    }
}
