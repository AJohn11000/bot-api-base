<?php

declare(strict_types=1);

namespace TgBotApi\BotApiBase\Tests\Type;

use TgBotApi\BotApiBase\Type\PhotoSizeType;
use TgBotApi\BotApiBase\Type\UserProfilePhotosType;

class UserProfilePhotosTypeTest extends TypeTestCase
{
    public function testEncode()
    {
        $result = [
            'total_count' => 1,
            'photos' => [
                [
                    [
                        'file_id' => 'AgADBQADyKcxG5hmrglZIi4CcakAAf4_7r0yAAQ735Gp9Icu6KADAQABAg',
                        'file_uniqueId' => 'fileUniqueId',
                        'file_size' => 91518,
                        'width' => 640,
                        'height' => 640,
                    ],
                    [
                        'file_id' => 'AgADBQADyKcxG5hmrglZIi4CcakAAf4_7r0yAASzMopVG_fq_qEDAQABAg',
                        'file_uniqueId' => 'fileUniqueId',
                        'file_size' => 219720,
                        'width' => 1050,
                        'height' => 1050,
                    ],
                ],
            ],
        ];

        $type = $this->getType($result);

        $this->assertEquals($type->totalCount, $result['total_count']);
        $this->assertEquals(\count($type->photos), 1);
        $this->assertEquals(\count($type->photos[0]), 2);
        $this->assertInstanceOf(PhotoSizeType::class, $type->photos[0][0]);
        $this->assertInstanceOf(PhotoSizeType::class, $type->photos[0][1]);
        $this->assertEquals($type->photos[0][0]->fileId, $result['photos'][0][0]['file_id']);
        $this->assertEquals($type->photos[0][0]->fileUniqueId, $result['photos'][0][0]['file_uniqueId']);
        $this->assertEquals($type->photos[0][0]->fileSize, $result['photos'][0][0]['file_size']);
        $this->assertEquals($type->photos[0][0]->width, $result['photos'][0][0]['width']);
        $this->assertEquals($type->photos[0][0]->height, $result['photos'][0][0]['height']);
        $this->assertEquals($type->photos[0][1]->fileId, $result['photos'][0][1]['file_id']);
        $this->assertEquals($type->photos[0][1]->fileUniqueId, $result['photos'][0][0]['file_uniqueId']);
        $this->assertEquals($type->photos[0][1]->fileSize, $result['photos'][0][1]['file_size']);
        $this->assertEquals($type->photos[0][1]->width, $result['photos'][0][1]['width']);
        $this->assertEquals($type->photos[0][1]->height, $result['photos'][0][1]['height']);
    }

    public function getType($result): UserProfilePhotosType
    {
        $botApi = $this->getBot($result);

        return $botApi->call($this->getMethod(), UserProfilePhotosType::class);
    }
}
