<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Show extends Component
{
    public $post;
    public function __construct(Post $post)
    {
        dd($this->post);
        $this->post = $post;
    }

    public function changeTitle(): void {
        $this->post->title = 'New Title';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.blog.post.show');
    }
}
