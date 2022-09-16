<?php
namespace Tests\Feature\Livewire;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Support\Str;
use App\Http\Livewire\FormPasswordGenerator;

class PasswordGeneratorTest extends TestCase
{
    /** @test  */
    public function the_component_can_render()
    {
        Livewire::test(FormPasswordGenerator::class)
            ->assertStatus(200);
    }
 
    /** @test  */
    public function can_generate_password()
    {
        $password = Livewire::test(FormPasswordGenerator::class)
            ->set('length', 15)
            ->set('includes', ['uppercase', 'lowercase', 'numbers', 'symbols'])
            ->call('handle')
            ->get('password');

        $this->assertTrue(!empty($password));
    }
 
    /** @test  */
    public function includes_is_required()
    {
        Livewire::test(FormPasswordGenerator::class)
            ->set('includes', [])
            ->call('handle')
            ->assertHasErrors(['includes' => 'required']);
    }
 
    /** @test  */
    public function length_is_required()
    {
        Livewire::test(FormPasswordGenerator::class)
            ->set('length', null)
            ->call('handle')
            ->assertHasErrors(['length' => 'required']);
    }
 
    /** @test  */
    public function length_is_min_4()
    {
        Livewire::test(FormPasswordGenerator::class)
            ->set('length', 3)
            ->call('handle')
            ->assertHasErrors(['length' => 'min']);
    }
 
    /** @test  */
    public function length_is_max_30()
    {
        Livewire::test(FormPasswordGenerator::class)
            ->set('length', 31)
            ->call('handle')
            ->assertHasErrors(['length' => 'max']);
    }
 
    /** @test  */
    public function have_the_correct_length()
    {
        $length = rand(4, 30);

        $password = Livewire::test(FormPasswordGenerator::class)
            ->set('length', $length)
            ->set('includes', ['uppercase', 'lowercase', 'numbers', 'symbols'])
            ->call('handle')
            ->get('password');

        $this->assertTrue(Str::length($password) === $length);
    }
 
    /** @test  */
    public function has_at_least_one_uppercase()
    {
        $length = rand(4, 30);

        $password = Livewire::test(FormPasswordGenerator::class)
            ->set('length', $length)
            ->set('includes', ['uppercase', 'lowercase', 'numbers', 'symbols'])
            ->call('handle')
            ->get('password');
        
        $this->assertMatchesRegularExpression('/[A-Z]/', $password);
    }
 
    /** @test  */
    public function has_at_least_one_lowercase()
    {
        $length = rand(4, 30);

        $password = Livewire::test(FormPasswordGenerator::class)
            ->set('length', $length)
            ->set('includes', ['uppercase', 'lowercase', 'numbers', 'symbols'])
            ->call('handle')
            ->get('password');
        
        $this->assertMatchesRegularExpression('/[a-z]/', $password);
    }
 
    /** @test  */
    public function has_at_least_one_number()
    {
        $length = rand(4, 30);

        $password = Livewire::test(FormPasswordGenerator::class)
            ->set('length', $length)
            ->set('includes', ['uppercase', 'lowercase', 'numbers', 'symbols'])
            ->call('handle')
            ->get('password');
        
        $this->assertMatchesRegularExpression('/[0-9]/', $password);
    }
 
    /** @test  */
    public function has_at_least_one_symbol()
    {
        $length = rand(4, 30);

        $password = Livewire::test(FormPasswordGenerator::class)
            ->set('length', $length)
            ->set('includes', ['uppercase', 'lowercase', 'numbers', 'symbols'])
            ->call('handle')
            ->get('password');

        $this->assertMatchesRegularExpression('/[!@$%^&*()<>]/', $password);
    }
 
    /** @test  */
    public function it_has_no_uppercase()
    {
        $length = rand(4, 30);

        $password = Livewire::test(FormPasswordGenerator::class)
            ->set('length', $length)
            ->set('includes', ['lowercase', 'numbers', 'symbols'])
            ->call('handle')
            ->get('password');
        
        $this->assertDoesNotMatchRegularExpression('/[A-Z]/', $password);
    }
 
    /** @test  */
    public function it_has_no_lowercase()
    {
        $length = rand(4, 30);

        $password = Livewire::test(FormPasswordGenerator::class)
            ->set('length', $length)
            ->set('includes', ['uppercase', 'numbers', 'symbols'])
            ->call('handle')
            ->get('password');
        
        $this->assertDoesNotMatchRegularExpression('/[a-z]/', $password);
    }
 
    /** @test  */
    public function it_has_no_number()
    {
        $length = rand(4, 30);

        $password = Livewire::test(FormPasswordGenerator::class)
            ->set('length', $length)
            ->set('includes', ['uppercase', 'lowercase', 'symbols'])
            ->call('handle')
            ->get('password');
                
        $this->assertDoesNotMatchRegularExpression('/[0-9]/', $password);
    }
 
    /** @test  */
    public function it_has_no_symbol()
    {
        $length = rand(4, 30);

        $password = Livewire::test(FormPasswordGenerator::class)
            ->set('length', $length)
            ->set('includes', ['uppercase', 'lowercase', 'numbers'])
            ->call('handle')
            ->get('password');

        $this->assertDoesNotMatchRegularExpression('/[!@$%^&*()<>]/', $password);
    }
}
