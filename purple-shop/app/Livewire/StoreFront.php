namespace App\Livewire;

use Livewire\Component;

class StoreFront extends Component
{
    public $search = '';
    public $selectedCategory = 'All';
    public $cartCount = 0;

    public $categories = ['All', 'Audio', 'Wearables', 'Gaming', 'Accessories'];

    public function addToCart($productId)
    {
        $this->cartCount++;
        // Dispatch an event for Alpine micro-interactions / notifications
        $this->dispatch('item-added', id: $productId);
    }

    public function render()
    {
        return view('livewire.store-front');
    }
}