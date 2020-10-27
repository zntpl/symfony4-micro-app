<?php

namespace App\Bus\Domain\Repositories\Conf;

use Illuminate\Support\Collection;
use ZnCore\Base\Exceptions\NotFoundException;
use ZnCore\Base\Legacy\Yii\Helpers\ArrayHelper;
use ZnCore\Base\Legacy\Yii\Helpers\FileHelper;
use ZnCore\Domain\Helpers\EntityHelper;
use ZnCore\Domain\Libs\Query;
use ZnCrypt\Base\Domain\Enums\HashAlgoEnum;
use ZnLib\Db\Base\BaseEloquentCrudRepository;
use App\Bus\Domain\Entities\ServerEntity;
use App\Bus\Domain\Helpers\ConfParser;

class ServerRepository
{

    private $directory;
    private $hostsRepository;

    public function __construct(string $directory, HostsRepository $hostsRepository)
    {
        $this->directory = $directory;
        $this->hostsRepository = $hostsRepository;
    }

    public function oneByName(string $name)
    {
        $collection = $this->getIndexedCollection();
        if (!$collection->has($name)) {
            throw new NotFoundException('Server not found!');
        }
        return $collection->get($name);
    }

    /**
     * @return Collection | ServerEntity[]
     */
    private function getIndexedCollection(): Collection
    {
        $commonTagCollection = ConfParser::readServerConfig($this->directory);
        $commonTagCollection = ArrayHelper::index($commonTagCollection, 'config.ServerName');
        /** @var Collection | ServerEntity[] $collection */
        $collection = EntityHelper::createEntityCollection(ServerEntity::class, $commonTagCollection);
        foreach ($collection as $serverEntity) {
            try {
                $serverEntity->setHosts($this->hostsRepository->oneByName($serverEntity->getServerName()));
            } catch (NotFoundException $e) {}
        }
        return $collection;
    }

    function all(): array
    {
        $commonTagCollection = $this->getIndexedCollection();
        $links = [];
        foreach ($commonTagCollection as $tagEntity) {
            if ($tagEntity->getTagName() == 'VirtualHost' && !empty($tagEntity->getServerName())) {
                $hostName = $tagEntity->getServerName();
                $documentRoot = $tagEntity->getDocumentRoot();
                $hostArray = explode('.', $hostName);
                $categoryName = ArrayHelper::last($hostArray);
                $categoryHash = hash(HashAlgoEnum::CRC32B, $categoryName);

                $links[$categoryHash]['title'] = ($categoryName);
                $links[$categoryHash]['items'][] = [
                    'server' => $tagEntity,
//                    'name' => $hostName,
//                    'url' => "http://{$hostName}",
//                    'title' => $hostName,
//                    'description' => $this->getTitleFromReadme($documentRoot) ?: $this->getTitleFromReadme(FileHelper::up($documentRoot)) ?: $this->getTitleFromReadme(FileHelper::up($documentRoot, 2)),
//                    'category_name' => $categoryName,
//                    'directory_exists' => file_exists(realpath($documentRoot)) ? true : false,
//                    'htaccess_exists' => file_exists(realpath($documentRoot) . '/' . '.htaccess') ? true : false,
                ];
            }
        }
        return $links;
    }

    private function getTitleFromReadme(string $documentRoot): string
    {
        $readmeMd = $documentRoot . '/README.md';
        $readmeMdTitle = '';
        if (file_exists($readmeMd)) {
            $readmeMdLines = file($readmeMd);
            $readmeMdTitle = ltrim($readmeMdLines[0], ' #');
            $readmeMdTitle = trim($readmeMdTitle);
        }
        return $readmeMdTitle;
    }

}
