<?php
/**
 * Created by PhpStorm.
 * User: igrec
 * Date: 28.01.19
 * Time: 17:30
 */

use PHPUnit\Framework\TestCase;
use App\User\Validators\UserValidator;

class UserValidatorTest extends TestCase
{
    /**
     * @var UserValidator
     */

    protected $validator;

    public function setUp()
    {
        $this->validator = new UserValidator();
    }

    /**
     * @dataProvider loginProvider
     * @param $value
     * @param $expected
     */
    public function testLoginValidator($value, $expected): void
    {
        $result = $this->validator->validateLogin($value);

        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider emailProvider
     * @param $value
     * @param $expected
     */
    public function testEmailValidator($value, $expected): void
    {
        $result = $this->validator->validateEmail($value);

        $this->assertEquals($expected, $result);
    }

    /**
     * @dataProvider passwordProvider
     * @param $value
     * @param $expected
     */
    public function testPasswordValidator($value, $expected): void
    {
        $result = $this->validator->validatePassword($value);

        $this->assertEquals($expected, $result);
    }

    public function emailProvider()
    {
        return [
            ['igrec', ['emailError' => 'Enter correct email']],
            ['hello@world.com', []],
            ['hello@world', ['emailError' => 'Enter correct email']],
            ['hello@world.', ['emailError' => 'Enter correct email']],
            ['myworld@gmail.com.ua', []]
        ];
    }

    public function loginProvider()
    {
        return [
            ['Igrec', []],
            ['hi', ['loginCount' => 'Login must have min 4 and max 12 symbols']],
            ['hello,world', ['loginError' => 'Login must include only numbers or english characters']],
            ['helloworld', []],
            ['', ['loginError' => 'Login must include only numbers or english characters',
                'loginCount' => 'Login must have min 4 and max 12 symbols'
            ]]
        ];
    }

    public function passwordProvider()
    {
        return [
            ['Igrecdsadasd', []],
            ['hi', ['passwordCount' => 'Password must have min 8 and max 20 symbols']],
            ['throngest_password', ['passwordError' => 'Password must include only numbers, english characters, $, % or #']],
            ['thestrongest2passw%', []],
            ['####$$$$%%%%', []]
        ];
    }
}
