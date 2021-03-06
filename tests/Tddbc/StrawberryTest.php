<?php

namespace Tddbc;

use PHPUnit\Framework\TestCase;
use Tddbc\Strawberry;

class StrawberryTest extends TestCase
{
    /**
     * @test
     * @testdox 品種="とちおとめ", サイズ="M" の Strawberry インスタンスをつくる
     */
    public function とちおとめM()
    {
        $tochiotome = Strawberry::constructWithWeight(Brand::TOCHIOTOME, 19);
        $this->assertNotNull($tochiotome);
        return $tochiotome;
    }

    /**
     * @test
     * @depends とちおとめM
     * @testdox 品種="とちおとめ", サイズ="M" のサイズは「M」
     */
    public function とちおとめMのサイズはM(Strawberry $tochiotome)
    {
        $this->assertSame('M', $tochiotome->getSize());
    }

    /**
     * @test
     * @depends とちおとめM
     * @testdox 品種="とちおとめ", サイズ="M" の品種は「とちおとめ」
     */
    public function とちおとめMの品種はとちおとめ(Strawberry $tochiotome)
    {
        $this->assertSame('とちおとめ', $tochiotome->getBrand());
    }

    /**
     * @test
     * @depends とちおとめM
     * @testdox 品種="とちおとめ", サイズ="M" の文字列表現は「とちおとめ: M」
     */
    public function とちおとめMの文字列表現(Strawberry $tochiotome)
    {
        $this->assertSame('とちおとめ: M', $tochiotome->toString());
    }

    /**
     * @test
     * @testdox 品種="あまおう", サイズ="S" の Strawberry インスタンスをつくる
     */
    public function あまおうS()
    {
        $amaou = Strawberry::constructWithWeight(Brand::AMAOU, 9);
        $this->assertNotNull($amaou);
        return $amaou;
    }

    /**
     * @test
     * @depends あまおうS
     * @testdox 品種="あまおう", サイズ="S" のサイズは「S」
     */
    public function あまおうSのサイズはS(Strawberry $amaou)
    {
        $this->assertSame('S', $amaou->getSize());
    }

    /**
     * @test
     * @depends あまおうS
     * @testdox 品種="あまおう", サイズ="S" の品種は「あまおう」
     */
    public function あまおうSの品種はあまおう(Strawberry $amaou)
    {
        $this->assertSame('あまおう', $amaou->getBrand());
    }

    /**
     * @test
     * @depends あまおうS
     * @testdox 品種="あまおう", サイズ="S" の文字列表現は「あまおう: S」
     */
    public function あまおうSの文字列表現(Strawberry $amaou)
    {
        $this->assertSame('あまおう: S', $amaou->toString());
    }

    /**
     * @test
     * @testdox 品種と重さを与えていちごをつくる 10g 未満
     */
    public function 品種と重さを与えていちごをつくる()
    {
        $amaou = Strawberry::constructWithWeight('あまおう', 8);
        $this->assertNotNull($amaou);
        $this->assertSame(8, $amaou->getWeight());
    }

    /**
     * @test
     * @testdox 重さ0gで例外がスローされる
     */
    public function 重さ0gで例外がスローされる()
    {
        try {
            Strawberry::constructWithWeight(Brand::TOCHIOTOME, 0);
            $this->fail('例外が出るはず');
        } catch (\InvalidArgumentException $expected) {
            $this->assertSame('重さは1g未満ではいけません', $expected->getMessage());
        }
    }

    // /**
    //  * @test
    //  * @dataProvider 任意のいちごを作成
    //  */
    // public function いちごは重さでサイズが自動的に決まる(Brand $brand, int $weight, string $expectedSize, string $expectedStringValue)
    // {
    //     $amaou = Strawberry::constructWithWeight($brand->value(), $weight);
    //     $this->assertSame($expectedSize, $amaou->getSize());
    //     $this->assertSame($expectedStringValue, $amaou->toString());
    // }

    // // 品種、重さ、サイズ期待値
    // public function 任意のいちごを作成()
    // {
    //     return [
    //         'あまおうS' => [Brand::AMAOU(), 1, Size::S, 'あまおう: S'],
    //         // 'あまおうM' => [Brand::AMAOU(), 10, Size::M],
    //         // 'あまおうL' => [Brand::AMAOU(), 20, Size::L],
    //         // 'あまおうLL' => [Brand::AMAOU(), 25, Size::LL],
    //     ];
    // }

    public function 重さとサイズの関係()
    {
        return [
            'もういっこS' => [1, Size::S],
            'もういっこM' => [10, Size::M],
            'もういっこL' => [20, Size::L],
            'もういっこLL' => [25, Size::LL],
        ];
    }

    /**
     * @test
     * @dataProvider 重さとサイズの関係
     */
    public function いちごは重さでサイズが自動的に決まる(int $weight, string $expected)
    {
        $amaou = Strawberry::constructWithWeight(Brand::MOUIKKO, $weight);
        $this->assertSame($expected, $amaou->getSize());
    }

    public function 重さと文字列表現の組み合わせ()
    {
        return [
            'もういっこS' => [1, 'もういっこ: S'],
            'もういっこM' => [10, 'もういっこ: M'],
            'もういっこL' => [20, 'もういっこ: L'],
            'もういっこLL' => [25, 'もういっこ: LL'],
        ];
    }

    /**
     * @test
     * @dataProvider 重さと文字列表現の組み合わせ
     */
    public function 重さと文字列表現の関係(int $weight, string $expected)
    {
        $amaou = Strawberry::constructWithWeight(Brand::MOUIKKO, $weight);
        $this->assertSame($expected, $amaou->toString());
    }





    public function testEnumの学習テストをこっそり()
    {
        $this->assertSame('もういっこ', Brand::MOUIKKO);
        $this->assertEquals(new Size(Size::S), Size::S());
        $this->assertEquals(new Brand(Brand::AMAOU), Brand::AMAOU());
        $this->assertEquals('あまおう', Brand::AMAOU()->value());
        $this->assertEquals('とちおとめ', (string)Brand::TOCHIOTOME);
        try {
            new Brand("ほげほげ");
            $this->fail();
        } catch (\InvalidArgumentException $expected) {
            $this->assertSame('value [ほげほげ] is not defined', $expected->getMessage());
        }
    }
}
