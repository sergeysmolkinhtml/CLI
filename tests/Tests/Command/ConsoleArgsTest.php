<?php

declare(strict_types=1);

namespace Tests\Command;

use Main\Command\FileStringCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\InputInterface;


require 'tests/Tests/Command/File.php';

class ConsoleArgsTest extends TestCase
{
    //Tests should have mocks for reading a file and working with passed parameters.
    protected $inputFile;

    protected function setUp(): void
    {
        $this->obj = (new FileStringCommand())->configure();

    }

    /**
     * @dataProvider provideDefaultvalues
     */

    public function testArguments($input)
    {
        $mockedArgs = $this->createMock(FileStringCommand::class);
        $mockedArgs->expects($this->once())->method('configure')
                                           ->willReturn($input);

        $this->assertSame($input, $mockedArgs->configure());
    }

    public function provideDefaultvalues(): array
    {
        return array(
            'data_1' => ["--string"],
            'data_2' => ["--file"]
        );
    }
    /**
     * @dataProvider provideFileData
     */
    public function testReadingAFile($file)
    {
        $mockFile = $this->createMock(File::class);
        $mockFile->expects($this->once())->method('read')
            ->with($file)->willReturn(true);
        $this->assertEquals($mockFile->read($file),true);
    }

    public function provideFileData()
    {
        return array(
            'data_1' => ["cache.json"],
            'data_2' => ['strings.json']
        );
    }

    public function testProcess()
    {
        $mock = $this->createMock(FileStringCommand::class);

        $mock->method('configure')
            ->will($this->returnSelf());

        $this->assertSame($mock,$mock->configure());
    }



}



